<?php

class Participants extends Controller{
    public function index(){
        $data = self::model('users')->getPart($_SESSION['USER_ID']);
        self::view('participants/index',$data);
    }
}