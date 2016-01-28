<?php

?>
<div class="row">
    <div class="col-lg-12 registration">
        <h1>WELCOME TO REGISTRATION PAGE FOR <?php echo $data[0]['tou_title'] ?></h1>
        <form action="/costs" method="post">
            <input type="hidden" name="tcode" value="<?php echo $data[0]['tou_code']; ?>">
            <input type="hidden" name="members" value="<?php echo $data[1]; ?>">
        <div class="col-lg-12 reg-part">
            <h3>INFORMATION ABOUT PARENT</h3>
            <div class="col-lg-4">
                <div class="well">
                <h4>Personal information</h4>
                                <label>Username*</label>
                                <input type="text" name="username" class="form-control" required="">
                                <label>Password*</label>
                                <input type="password" name="password" class="form-control" required="">
                                <label>First Name*</label>
                                <input type="text" name="firstname" class="form-control" required="">
                                <label>Last Name*</label>
                                <input type="text" name="lastname" class="form-control" required="">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="well">
                <h4>Contact informations</h4>
                                <label>Home phone*</label>
                                <input type="text" name="homephone" class="form-control" required="">
                                <label>Mobile phone</label>
                                <input type="text" name="mobilephone" class="form-control">
                                <label>Email*</label>
                                <input type="email" name="email" class="form-control" required="">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="well">
                <h4>Location</h4>
                                <label>Address 1*</label>
                                <input type="text" name="address1" class="form-control" required="">
                                <label>Address 2</label>
                                <input type="text" name="address2" class="form-control">
                                <label>City/Town*</label>
                                <input type="text" name="city" class="form-control" required="">
                                <label>State*</label>
                                <input type="text" name="state" class="form-control" required="">
                                <label>Zip code*</label>
                                <input type="text" name="zipcode" class="form-control" required="">
                </div>
            </div>
                            </div>
       
    <div class="col-lg-12"><hr></div>
        <div class="col-lg-12 reg-part">
            <div class="col-lg-12">
            <h3>INFORMATION ABOUT STUDENT/S</h3>
            <?php for($i=1;$i<=$data[1];$i++){?>
            <div class="<?php if($data[1]>2){ echo 'col-lg-3';}else{echo 'col-lg-6';}?>">
                <div class="well">
                        <h4><strong>Student <?php echo $i; ?></strong></h4>
                        <label>First name*</label>
                        <input type="text" name="stu_firstname_<?php echo $i;?>" class="form-control" required="">
                        <label>Last name*</label>
                        <input type="text" name="stu_lastname_<?php echo $i;?>" class="form-control" required="">
                        <label>Gender*</label>
                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="stu_gender_<?php echo $i;?>" value="M" checked="">
                        Male</label>
                        </div><div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="stu_gender_<?php echo $i;?>" value="F">                        
                        Female</label>
                        </div>
                        <label>Date of birth*</label>
                        <div class="datepick">
                        <?php $cal1 = new Calendar('b', 1); $cal1->draw(); ?>
                            <input type="hidden" name="stu_dob_<?php echo $i;?>" required="">
                        </div>
                </div>
                    </div>
            <?php } ?>
        </div>
        </div>
        
        <input type="hidden" name="school_id" value="<?php echo $data[0]['tou_school_id']; ?>">
        <input type="hidden" name="tour_id" value="<?php echo $data[0]['tou_id']; ?>">

        <div class="col-lg-12">
            <h1><input type="submit" value="SAVE AND GO TO NEXT PAGE" class="btn btn-default"></h1>
        </div>
    </form>
    </div>
    </div>
</div>