<?php

$q = new Query;
$q->where = array('lea_tour_id'=>$data[0]);
$res = $q->inner_join('groupleaders', 'users', array('lea_user_id','id'));
?>
<div id="mailtogl-body">
<form action="" method="post" id="mailtogl">
    <p><strong>Recipient : </strong><?php echo $res[0]['firstname'].' '.$res[0]['lastname']; ?></p>
    <input type="hidden" name="email" value="<?php echo $res[0]['email']; ?>">
    <input type="hidden" name="sender" value="<?php echo $data[1]['firstname'].' '.$data[1]['lastname']; ?>">
    <input type="hidden" name="senderemail" value="<?php echo $data[1]['email']; ?>">
    <label>Subject</label>
    <input type="text" name="subject" class="form-control" required="">
    <label>Message</label>
    <textarea name="message" rows="10" class="form-control" required=""></textarea>
    <hr>
    <input type="submit" value="SEND MAIL" class="btn btn-primary">
</form>
</div>
