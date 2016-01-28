<?php

class Calendar{
    private $type; //params: 'b' for year range 1930-now; 'p' for year range now-+10years
    private $zone; //params: '0' for non american date; '1' for american date
    
    public function __construct($type, $zone) {
        $this->type = $type;
        $this->zone = $zone;
    }
    
    public function draw(){
        switch ($this->type){
            case 'b':
               $this->birth();
                break;
            default :
                $this->present();
        }
    }
    private function birth(){
        $str = '';
        if($this->zone==0){
            $str .= $this->days();
            $str .= $this->months();
        }else{
            $str .= $this->months();
            $str .= $this->days();
        }
        $str .= '<select class="dpyear" style="width:28%;font-size:14px;display:inline-block;margin-right:10px;padding:4px 0px;">';
        
        for($i=1960;$i<=date('Y'); $i++){
            $str .= '<option value="'.$i.'">'.$i.'</option>';
        }
        $str .= '</select>';
        
        echo $str;
    }
    private function present(){
        $str = '';
        if($this->zone==0){
            $str .= $this->days();
            $str .= $this->months();
        }else{
            $str .= $this->months();
            $str .= $this->days();
        }
        $str .= '<select class="dpyear" style="width:28%;font-size:14px;display:inline-block;margin-right:10px;padding:4px 0px;">';
        $d = date('Y')+10;
        for($i=date('Y');$i<=$d; $i++){
            $str .= '<option value="'.$i.'">'.$i.'</option>';
        }
        $str .= '</select>';
        
        echo $str;
    }
    private function days(){
        $str = '<select class="dpday" style="width:28%;font-size:14px;display:inline-block;margin-right:10px;padding:4px 0px;">';
        for($i=1; $i<=31; $i++){
            $str .= '<option value="';
            if($i<10){
                $str .= '0'.$i;
            }else{
                $str .= $i;
            }
            $str .= '">'.$i.'</option>';
        }
        $str .= '</select>';
        return $str;
    }
    private function months(){
        $str = '<select class="dpmonth" style="width:28%;font-size:14px;display:inline-block;margin-right:10px;padding:4px 0px;">';
        $str .= '<option value="01">Jan</option>';
        $str .= '<option value="02">Feb</option>';
        $str .= '<option value="03">Mar</option>';
        $str .= '<option value="04">Apr</option>';
        $str .= '<option value="05">May</option>';
        $str .= '<option value="06">Jun</option>';
        $str .= '<option value="07">Jul</option>';
        $str .= '<option value="08">Aug</option>';
        $str .= '<option value="09">Sep</option>';
        $str .= '<option value="10">Oct</option>';
        $str .= '<option value="11">Nov</option>';
        $str .= '<option value="12">Dec</option>';
        $str .= '</select>';
        return $str;
    }
}

