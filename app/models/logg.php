<?php

class Logg extends Model{
    public function checkTourcode($post){
        $q = new Query();
        $q->table = 'tours';
        $q->where = array('tou_code'=>$post['tcode']);
        $res = $q->read();
        
        if(count($res)>0){
            return '';
        }else{
            return 'c';
        }
    }
    public function checkExPart($post){
        return '';
    }
    public function logAuth($post){
        $q = new Query();
        $q->table = 'users';
        $q->where = array('username'=>$post['username'],'password'=>md5($post['password']));
        $res = $q->read();
        
        if(count($res)>0){
            session_start();
            session_regenerate_id();
            
            $_SESSION['USER_ID'] = $res[0]['id'];
            $_SESSION['USER_ROLE'] = $res[0]['role'];
            
            if($res[0]['role']==='U'){
                header('Location: /myprofile');
            }elseif($res[0]['role']==='G'){
                header('Location: /leaders');
            }else{
                header('Location: /admin-main');
            }
            
        }else{
            header('Location: /home/e');
        }
    }
}

