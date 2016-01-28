<?php

class Home extends Controller{
    public function index($s=null){
        if(null!==$s){
            $data = $s;
        }else{
            $data = '';
        }
        self::view('logg/index', $data);
    }
    public function logAuth(){
        if(null!==filter_input_array(INPUT_POST)){
            $post = filter_input_array(INPUT_POST);
            self::model('logg')->logAuth($post);
        }
    }
    public function logout(){
        session_start();
        session_regenerate_id();
        session_unset();
        session_destroy();
        
        header('Location: /');
    }

    public function register($p=null,$t=null,$m=null){
        if(null!==  filter_input_array(INPUT_POST)){
            $post =  filter_input_array(INPUT_POST);
            $st = self::model('logg')->checkTourcode($post);
            if($st!==''){
                header('Location: /home/'.$st);
            }else{
                $data = array(self::model('registration')->getFirstPage($post['tcode']), $post['members']);
                self::view('logg/page1', $data);
            }
        }else{
            $data = array(self::model('registration')->getFirstPage($t), $m, $p);
                self::view('logg/page1', $data);
        }
    }
    public function costs(){
        if(null!==  filter_input_array(INPUT_POST)){
           $post =  filter_input_array(INPUT_POST);
           $st = self::model('logg')->checkExPart($post);
           if($st!==''){
               header('Location:/register/'.$st.'/'.$post['tcode'].'/'.$post['members']);
           }else{
            $last = self::model('registration')->insertPersonal($post);
           
            $data = self::model('registration')->getSecondPage($last, $post['tour_id'], $post['members']);
            self::view('logg/page2', $data);
           }
        }
    }
    public function payment(){
        if(null!==  filter_input(INPUT_POST, 'confirmpay')){
           $post =  filter_input_array(INPUT_POST);
           $last = self::model('registration')->enroll($post);
           
           $data = array($post['user_id'], $post['tour_id'], $post['members'], $last, $post['tour_full_pay']);
           self::view('logg/page3', $data);
        }elseif(null!==  filter_input(INPUT_POST, 'tryagain')){
           $post =  filter_input_array(INPUT_POST);
           
           $data = array($post['user_id'], $post['tour_id'], $post['members'], $post['enroll_id'], $post['tour_full']);
           self::view('logg/page3', $data); 
        }
    }

    public function success(){
        if(null!==  filter_input_array(INPUT_POST)){
           $post =  filter_input_array(INPUT_POST);
           $data = $post;
           self::view('logg/page4', $data);  
        }
    }
    public function enrollmentform($uid,$tid,$eid,$mem){
        $data = array(
            'user_id'=>$uid,
            'tour_id'=>$tid,
            'enroll_id'=>$eid,
            'members'=>$mem
        );
        $c='y';
        self::view('/documentation/enrollment', $data, $c);
    }
}

