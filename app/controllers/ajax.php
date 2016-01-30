<?php

class Ajax extends Controller{
    public function index(){
        
    }
    public function showStuDet(){
        $stid = filter_input(INPUT_POST, 'stid');
        $res = q_custom("SELECT * FROM students "
                . "INNER JOIN users ON stu_user_id=id "
                . "AND stu_id=".$stid);
        $str = '<table class="table">';
        $str .= '<tr style="background:#ccc;"><th colspan="2">Student</td></tr>';
        $str .= '<tr><td>Name :</td><td>'.$res[0]['stu_firstname'].' '.$res[0]['stu_lastname'].'</td></tr>';
        $str .= '<tr><td>Date of birth :</td><td>'.date('m-d-Y', strtotime($res[0]['stu_dob'])).'</td></tr>';
        if($res[0]['stu_gender']==='M'){
            $str .= '<tr><td>Gender :</td><td>Male</td></tr>';
        }else{
            $str .= '<tr><td>Gender :</td><td>Female</td></tr>';
        }
        $str .= '<tr style="background:#ccc;"><th colspan="2">Parent</th></tr>';
        $str .= '<tr><td>Name :</td><td>'.$res[0]['firstname'].' '.$res[0]['lastname'].'</td></tr>';
        $str .= '<tr><td>Address :</td><td>'.$res[0]['address1'].', '.$res[0]['city'].', '.$res[0]['state'].'</td></tr>';
        $str .= '<tr><td>Home Phone :</td><td>'.$res[0]['homephone'].'</td></tr>';
        $str .= '<tr><td>Mobile Phone :</td><td>'.$res[0]['mobilephone'].'</td></tr>';
        $str .= '</table>';
        
        echo $str;
    }
}