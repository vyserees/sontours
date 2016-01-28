<?php

class Query extends Model {

    public $table;
    public $insertarray = array();
    public $updatearray = array();
    public $where = array();
    public $limit;
    public $order = array();
    public $ascdesc;
    public $between = array();

public function change(){
    $upstr = '';
    $upstrvals = array();
    foreach($this->updatearray as $name => $val){
        $upstr .= ' '.$name.'= :'.$name.',';
        $upstrvals[':'.$name] = $val;
    }
    $upstr = rtrim($upstr, ',');
    $sql = "UPDATE ".$this->table." SET".$upstr." ".$this->where_to_string(false);
    $stmt = parent::prepare($sql);
    $stmt->execute($upstrvals);
}

/*Function that pulls ALL data from specific table in database*/
public function readAll(){
    $all = array();
    $ret = parent::prepare("SELECT * FROM ".$this->table);
    $ret->execute();
    while($res = $ret->fetch()){
        array_push($all, $res);
    }
    return $all;
}

/*Function that pulls data from ONE specific table with condition(s) given by $where, $limit attribute*/
public function read(){
    $all = array();
    $ret = parent::prepare("SELECT * FROM ".$this->table." ".$this->where_to_string(false)." ".$this->between_to_string()." ".$this->order_to_string()." ".$this->limit_to_string());
    $ret->execute($this->where);
    while($res = $ret->fetch()){
        array_push($all, $res);
    }
    return $all;
}

/*Function that puts data to row into specific table in database*/
public function insert(){
    $fields = array_keys($this->insertarray);
    $sql = "INSERT INTO ".$this->table." (" . implode( ",", $fields ) . ") VALUES (:" . implode( ", :", $fields ) . " )";
    $stmt = parent::prepare($sql);
    foreach($this->insertarray as $name => $val){
        $stmt->bindParam(':'.$name, $this->insertarray[$name]);
    }
    $stmt->execute();
}

/*Function that deletes specific row in specific table by criteria given in array of $where attribute*/
public function delete(){
    $sql = "DELETE FROM ".$this->table." ".$this->where_to_string(false);
    $stmt = parent::prepare($sql);
    foreach($this->where as $name => $val){
        $stmt->bindParam(':'.$name, $this->where[$name]);
    }
    $stmt->execute();
}

/*Function that prepares string for WHERE part of query. Input parameter
$join checks if JOIN statement is used.*/
private function where_to_string($join){
    if(count($this->where)>0){
    /*if $join is true, prepare string for JOIN statement. Otherwise, normal statement is used.*/
        if($join){
            $str = "AND "; 
            foreach($this->where as $name=>$value){
                $str .= " ".$name."=".$value." AND";
            }
            $str = rtrim($str, " AND");
            return $str;
        }else{
            $str = "WHERE ";
            foreach($this->where as $name=>$value){
                $str .= " ".$name."=:".$name." AND";
            }
            $str = rtrim($str, "AND");
            return $str;
        }
        
    }else{
        return '';
    }
}

/*Function that prepares string for LIMIT part of query.*/
private function limit_to_string(){
    if(isset($this->limit)){
        $str = "LIMIT ".$this->limit;
        return $str;
    }else{
        return '';
    }
}

/*Function that prepares string for ORDER BY part of query with ASC|DESC apendix*/
private function order_to_string(){
    if(count($this->order)>0){
        $str = "ORDER BY ".implode(',', $this->order);
        $str .= " ".$this->ascdesc;
        return $str;
    }else{
        return '';
    }
}

/*Function that prepares string for range calculation - BETWEEN*/
private function between_to_string(){
    if(count($this->between)>0){
        $arr = $this->between;
        if(count($this->where)>0){
            $str = "AND";
        }else{
            $str = "WHERE";
        }
        for($i=0; $i<count($arr); $i++){
            $str .= " ".$arr[$i][0]." BETWEEN ".$arr[$i][1]." AND ".$arr[$i][2]." AND";
        }
        $str = rtrim($str, "AND");
        return $str;
    }else{
        return '';
    }
}
/*Function that prepares string for grouping*/
public function group_to_string(){
    if(count($this->group)>0){
        $g = "GROUP BY ".implode(',', $this->group);
        return $g;
    }else{
        return '';
    }
}

public function inner_join($ltable, $rtable, $on){
    $q = parent::prepare("SELECT * FROM ".$ltable." INNER JOIN ".$rtable." ON ".$on[0]."=".$on[1]." ".$this->where_to_string(true)." ".$this->group_to_string()." ".$this->between_to_string()." ".$this->order_to_string()." ".$this->limit_to_string());
    $q->execute();
    
    return $res = $q->fetchAll();
}


/*Function that executes SQL functions. Accepts name of function as first parameter,
name of column as second and returns single value as result of execution. Uses con-
ditionl statements to filter result set.*/
public function sql_function($function, $column){
    $ret = parent::prepare("SELECT ".$function."(".$column.")"." FROM ".$this->table." ".$this->where_to_string(false)." ".$this->between_to_string()." ".$this->order_to_string()." ".$this->limit_to_string());
    $ret->execute();
    $res = $ret->fetch();
    return $res[0];
}

}