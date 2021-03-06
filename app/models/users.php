<?php

class Users extends Model{
    public function getPart($uid){
        $ret = array('parent'=>array(),'students'=>array(), 'leaders'=>array());
        $q = parent::prepare("SELECT * FROM users "
                . "INNER JOIN enroll_full ON id=enf_user_id "
                . "AND users.id=".$uid);
        $q->execute();
        $resp = $q->fetchAll();
        $ret['parent'] = $resp[0];
        
        $q2 = parent::prepare("SELECT * FROM students "
                . "INNER JOIN tours ON tou_id=stu_tour_id "
                . "JOIN paymen_shema ON psc_tour_id=stu_tour_id "
                . "AND students.stu_user_id=".$uid);
        $q2->execute();
        $ress = $q2->fetchAll();
        $ret['students'] = $ress;
        
        $q3 = parent::prepare("SELECT * FROM users "
                . "INNER JOIN groupleaders ON id=lea_user_id "
                . "JOIN schools ON lea_school_id=sch_id "
                . "AND users.role='G' AND lea_tour_id='".$ress[0]['tou_id']."'");
        $q3->execute();
        $resl = $q3->fetchAll();
        $ret['leaders'] = $resl[0];
        
        return $ret;
    }
    public function getLeader($uid){
        $ret = array('leader'=>array(),'students'=>array(),'tour'=>array(),'data');
        $l = parent::prepare("SELECT * FROM users "
                . "INNER JOIN groupleaders ON id=lea_user_id "
                . "AND id=".$uid);
        $l->execute();
        $resl = $l->fetchAll();
        $ret['leader'] = $resl[0];
        
        $q = parent::prepare("SELECT * FROM tours "
                . "INNER JOIN schools ON tou_school_id=sch_id "
                . "AND tours.tou_id='".$resl[0]['lea_tour_id']."'");
        $q->execute();
        $rest = $q->fetchAll();
        $ret['tour'] = $rest[0];
        
        $q2 = parent::prepare("SELECT * FROM students "
                . "INNER JOIN users ON stu_user_id=id "
                . "JOIN enroll_full ON enf_user_id=stu_user_id "
                . "AND students.stu_tour_id='".$resl[0]['lea_tour_id']."' "
                . "AND enroll_full.enf_status='C' ORDER BY students.stu_lastname,stu_firstname");
        $q2->execute();
        $ress = $q2->fetchAll();
        $ret['students'] = $ress;
        
        $ret['data'] = count($ress);
        
        return $ret;
    }
    public function leadersSentEmail($post){
        $le = q_custom("SELECT * FROM groupleaders "
                . "INNER JOIN users ON lea_user_id=id "
                . "JOIN tours ON lea_tour_id=tou_id "
                . "AND lea_id=".$post['glid']);
        
        if($post['emailto']==='all'){
            $pa = q_custom("SELECT * FROM enroll_full "
                    . "INNER JOIN users ON enf_user_id=id "
                    . "AND enf_status='C' AND enf_tour_id=".$le[0]['lea_tour_id']);
            foreach ($pa as $p){
                $message = '<strong>'.$le[0]['firstname'].' '.$le[0]['lastname'].', group leader of '.$le[0]['tou_title'].' sent you the message:</strong>';
                $message .= '<article><em>'.$post['text'].'</em></article>';
                mailing($p['email'], $post['emailfrom'], 'Message from groupleader', $message);
            }
            
        }else{
            $message = '<strong>'.$le[0]['firstname'].' '.$le[0]['lastname'].', group leader of '.$le[0]['tou_title'].' sent you the message:</strong>';
            $message .= '<article><em>'.$post['text'].'</em></article>';
            mailing($post['emailto'], $post['emailfrom'], 'Message from groupleader', $message);
        }
    }
}
