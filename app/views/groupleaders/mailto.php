<?php
$param = explode('=', $data[1]);
$l = selection('users', array('id'=>$param[1]));
$emailfrom = $l[0]['email'];
if($data[0]>0){
   $par = selection('users', array('id'=>$data[0])); 
}

switch($param[0]){
    case 'tost':
        $title = 'TO SON TOURS';
        $emailto = 'son-tours@gmail.com';
        break;
    case 'topar':
        $title = 'TO PARENT '.$par[0]['firstname'].' '.$par[0]['lastname'];
        $emailto = $par[0]['email'];
        break;
    default :
        $title = 'TO ALL PARENTS';
        $emailto = 'all';
}

?>
<div class="row part">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="part-main-layout">
            <h3>SEND EMAIL <?=$title?></h3>
            <article>
                <form action="/leaders-emsent" method="post">
                    <input type="hidden" name="emailto" value="<?=$emailto?>">
                    <input type="hidden" name="emailfrom" value="<?=$emailfrom?>">
                    <input type="hidden" name="glid" value="<?=$l['id']?>">
                    <label>Text of the message:</label>
                    <textarea name="text" rows="12" class="form-control"></textarea>
                    <hr>
                    <input type="submit" value="SEND EMAIL" class="btn btn-primary">
                    <a href="/leaders" class="btn btn-danger pull-right">BACK TO MAIN PAGE</a>
                </form>
            </article>
        </div>
    </div>
</div>

