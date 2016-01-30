<?php

class Groupleaders extends Controller{
    public function index(){
        $data = self::model('users')->getLeader($_SESSION['USER_ID']);
        self::view('groupleaders/index',$data);
    }
    public function emailto($parent,$to,$s=null){
        $data = array($parent,$to,$s);
        self::view('groupleaders/mailto',$data);
    }
    public function emSent(){
        $post = filter_input_array(INPUT_POST);
        self::model('users')->leadersSentEmail($post);
        self::view('groupleaders/emsent');
    }
}

