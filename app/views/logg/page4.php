<?php
	
$p = new Paypal('test');
$res = $p->payment($data);
if(is_array($res)){
    $suc = true;
}else{
    $suc = false;
}



if($suc){
self::model('registration')->confirmReg($data);

?>
<div class="row">
    <div class="registration">
        <h1>THANK YOU FOR REGISTRATION</h1>
        <br>
        <button class="btn btn-default" onclick="JavaScript:newPopup('/enrollmentform/<?php echo $data['user_id'].'/'.$data['tour_id'].'/'.$data['enroll_id'].'/'.$data['members'];?>');">ENROLLMENT FORM</button>
    </div>
</div>
<?php }else{?>
<div class="row">
    <div class="registration">
        <h1>ERROR OCCURRED DURING PAYMENT PROCESS</h1>
        <p style="padding: 20px 0; text-align: center; background: #ff0000; color: #fff; font-size: 16px;">
            <?php echo $res; ?>
        </p>
        <form action="/payment" method="post">
            <input type="hidden" name="user_id" value="<?php echo $data[0]; ?>">
                <input type="hidden" name="tour_id" value="<?php echo $data[1]; ?>">
                <input type="hidden" name="members" value="<?php echo $data[2]; ?>">
                <input type="hidden" name="enroll_id" value="<?php echo $data[3]; ?>">
                <input type="hidden" name="tour_full" value="<?php echo $data[4]; ?>">
                <h2 style="text-align: center;">
                    <input type="submit" value="TRY AGAIN" name="tryagain" class="btn btn-default btn-lg">
                </h2>
        </form>
    </div>
</div>

<?php } 

echo 'aaaaaaaaaaaaa';
var_dump($res);
?>
<script>
    
    function newPopup(url) {
	popupWindow = window.open(
		url,"popUpWindow","");
	}
    </script>