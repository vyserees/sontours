<?php

class Registration extends Model{
    public function getFirstPage($tc){
        $q = parent::prepare("SELECT * FROM tours "
                . "INNER JOIN schools ON tou_school_id=sch_id "
                . "AND tours.tou_code='".$tc."'");
        $q->execute();
        $res = $q->fetchAll();
        return $res[0];
    }
    public function insertPersonal($post){
        $post = filter_input_array(INPUT_POST);
        $q = new Query();
        $q->table = 'users';
        $q->insertarray = array(
            'username'=>$post['username'],
            'password'=>md5($post['password']),
            'firstname'=>$post['firstname'],
            'lastname'=>$post['lastname'],
            'homephone'=>$post['homephone'],
            'mobilephone'=>$post['mobilephone'],
            'email'=>$post['email'],
            'address1'=>$post['address1'],
            'address2'=>$post['address2'],
            'zipcode'=>$post['zipcode'],
            'city'=>$post['city'],
            'state'=>$post['state'],
            'role'=>'P',
            'payment_structure'=>'F'
        );
        $q->insert();
        $uid = $q->lastInsertId();
        
        $q2 = new Query();
        
        for($i=1;$i<=$post['members'];$i++){
            $q2->table = 'students';
            $q2->insertarray = array(
                'stu_firstname'=>$post['stu_firstname_'.$i],
                'stu_lastname'=>$post['stu_lastname_'.$i],
                'stu_gender'=>$post['stu_gender_'.$i],
                'stu_dob'=>date('Y-m-d', strtotime($post['stu_dob_'.$i])),
                'stu_user_id'=>$uid,
                'stu_school_id'=>$post['school_id'],
                'stu_tour_id'=>$post['tour_id']
            );
            $q2->insert();
        }
        return $uid;
    }
    public function getSecondPage($last, $tour, $mem){
        $q = new Query();
        $q->where = array('tou_id'=>$tour);
        $res = $q->inner_join('tours', 'paymen_shema', array('tou_id', 'psc_tour_id'));
        
        return array($res[0], $last, $mem);
    }
    public function enroll($post){
        $q3=new Query();
        /*
        if($post['payment_structure']==='F'){
            $q3->table = 'enroll_full';
            $q3->insertarray = array(
                'enf_code'=>  rand(100000, 999999),
                'enf_tour_id'=>$post['tour_id'],
                'enf_user_id'=>$uid,
                'enf_amount'=>$post['tour_full_pay'],
                'enf_occ'=>$post['tour_occupancy'],
                'enf_hfr'=>$post['tour_hfr']
            );
            $q3->insert();
        }else{
            
        }
         */
        
        $q3->table = 'enroll_full';
            $q3->insertarray = array(
                'enf_code'=>  rand(100000, 999999),
                'enf_tour_id'=>$post['tour_id'],
                'enf_user_id'=>$post['user_id'],
                'enf_amount'=>$post['tour_full_pay'],
                'enf_occ'=>$post['tour_occupancy'],
                'enf_hfr'=>$post['tour_hfr']
            );
            $q3->insert();
          $last = $q3->lastInsertId();
          
          return $last;
    }
    public function confirmReg($post){
        $q = new Query();
        $q->table = 'users';
        $q->where = array('id'=>$post['user_id']);
        $q->updatearray = array('id'=>$post['user_id'], 'active'=>'Y');
        $q->change();
        
        $q->table = 'enroll_full';
        $q->where = array('enf_id'=>$post['enroll_id']);
        $q->updatearray = array('enf_id'=>$post['enroll_id'], 'enf_status'=>'C');
        $q->change();
    }
    public function getEnrollmentForm($uid,$tid,$eid,$mem){
        $ret=array('personal'=>array(),'tour'=>array(),'enroll'=>array(), 'members'=>$mem);
        
        $p = parent::prepare("SELECT * FROM users "
                . "INNER JOIN students ON id=stu_user_id "
                . "AND users.id=".$uid);
        $p->execute();
        $ret['personal'] = $p->fetchAll();
        
        $q=new Query();
        $q->where = array('tou_id'=>$tid);
        $rest = $q->inner_join('tours', 'paymen_shema', array('tou_id', 'psc_tour_id'));
        $ret['tour'] = $rest[0];
        
        $q->table = 'enroll_full';
        $q->where = array('enf_id'=>$eid);
        $rese = $q->read();
        $ret['enroll'] = $rese[0];
        
        return $ret;
    }
    
}

