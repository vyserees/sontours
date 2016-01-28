<?php

?>
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="col-lg-5">
            <div class="login-form">
                <form action="/logauth" method="post">
                    <h2>LOGIN FORM</h2>
                    <?php if($data==='e'){
                        echo '<p class="msg-warning">Wrong username and/or password!</p>';                        
                    } ?>
                    <label>Username</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-user" aria-hidden="true"></span></span>
                        <input name="username" type="text" class="form-control" required="">
                    </div>
                    <label>Password</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-lock" aria-hidden="true"></span></span>
                        <input type="password" name="password" class="form-control" required="">
                    </div>
                    <hr>
                    <input type="submit" value="LOG IN" class="btn btn-primary btn-lg">
                </form>
            </div>
        </div>
        <div class="col-lg-6 col-lg-offset-1">
            <div class="reg-form">
                <form action="/register" method="post">
                    <h2>REGISTRATION</h2>
                    <?php if($data==='c'){
                       echo '<p class="msg-warning">You have entered wrong tour code.<br>If you forgot or lost your tour code, please contact us on 777-7777-777.</p>'; 
                    } ?>
                    <p>Etiam sit amet nulla at est mattis luctus. Mauris in nulla et velit mollis ornare. Nunc sollicitudin justo id eros pretium sollicitudin. In dignissim quam eget convallis commodo. Pellentesque ornare urna tellus, et feugiat orci commodo bibendum. Nulla facilisi. Donec lobortis eget nunc maximus convallis.</p>
                    <hr>
                    <label>Enter Tour Code</label>
                    <input type="text" name="tcode" class="form-control" required="">
                    <label>Select nuber of participants</label>
                    <select name="members" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                    <hr>
                    <input type="submit" value="REGISTER" class="btn btn-success btn-lg">
                </form>
            </div>
        </div>
    </div>
</div>

