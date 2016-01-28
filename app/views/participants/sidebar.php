<?php
$mem = count($data['students']);
?>
<div class="part-main-sidebar">
    <h4>STUDENTS</h4>
    <?php $c=1;foreach($data['students'] as $st){?>
    <p><?php echo $c.'. '.$st['stu_firstname'].' '.$st['stu_lastname'];$c++; ?></p>
    <?php }?>
    <h4>PAYMENTS</h4>
    <p>You paid full amount of costs for the tour.</p>
    <p><strong>Tour fee: </strong><br>for <?php echo $mem;?> student/s - $<?php echo $mem*$data['students'][0]['psc_full']; ?></p>
    <p><strong>Hassle Free Refund(HFR):</strong><br>for <?php echo $mem;?> student/s - $<?php if($data['students'][0]['enf_hfr']==='n'){echo '0';}else{echo $mem*$data['students'][0]['tou_hfr'];} ?></p>
    <p><strong>Occupancy:</strong><br>for <?php echo $mem;?> student/s - $
        <?php switch($data['parent']['enf_occ']){case 'T': $html = 'Triple';$occ=$mem*$data['students'][0]['tou_triple']; break; case 'D': $html = 'Double';$occ=$mem*$data['students'][0]['tou_double'];break; case 'S': $html = 'Single';$occ=$mem*$data['students'][0]['tou_single']; break; default : $html = 'Quadruple';$occ=0;} ?>
        <?php echo $occ.' - '.$html; ?>
    </p>
    <p style="font-size: 16px;border-top:2px solid #777;border-bottom: 2px solid #777;padding: 5px 15px;">
        <strong>Total (+4% fee) : $<?php echo $data['parent']['enf_amount']; ?></strong>
    </p>
    <h4>SCHOOL</h4>
    <p style="font-size: 16px;"><strong><?php echo $data['leaders']['sch_name']; ?></strong></p>
    <p><strong>Address:</strong> <?php echo $data['leaders']['sch_address'].'<br>'.$data['leaders']['sch_city'].', '.$data['leaders']['sch_state'] ?></p>
    <p><strong>Phone:</strong> <?php echo $data['leaders']['sch_phone']; ?></p>
    <hr>
    <p style="font-size: 16px;"><strong>Group Leader: </strong><?php echo $data['leaders']['firstname'].' '.$data['leaders']['lastname']; ?></p>
    <p><strong>Address:</strong> <?php echo $data['leaders']['address'].'<br>'.$data['leaders']['city'].', '.$data['leaders']['state'] ?></p>
    <p><strong>Phones:</strong> <?php echo $data['leaders']['homephone'].' '.$data['leaders']['mobilephone']; ?></p>
</div>

