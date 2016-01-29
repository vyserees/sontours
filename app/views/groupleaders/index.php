<?php

?>
<div class="row part">
    <div class="col-lg-12 part-header">
        <?php echo '<p>Welcome, '.$data['leader']['firstname'].' '.$data['leader']['lastname'].'</p>'; ?>
    </div>
    <div class="col-lg-8" style="padding-right: 0;">
        <div class="part-main-layout">
            <h3><?php echo $data['tour']['tou_title']; ?><span class="pull-right"><?php echo $data['data'];?> students</span></h3>
            <p class="green-warning">
                <?php 
                    $start = strtotime($data['tour']['tou_start']);
                    $gap = $start-time();
                    $days = abs(ceil($gap/(24*60*60)));
                    echo '<em>Starting in : '.$days.' days</em>';
                    ?>
            </p>
            <article>
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th width="10%" style="text-align: center;">No.</th>
                        <th width="60%" style="text-align: left;">Name</th>
                        <th width="15%" style="text-align: center;">Details</th>
                        <th width="15%" style="text-align: center;">Email</th>
                    </tr>
                    <?php for($i=0;$i<count($data['students']);$i++){ ?>
                    <tr>
                        <td style="text-align: right;"><?php echo ($i+1).'.'; ?></td>
                        <td><?php echo $data['students'][$i]['stu_lastname'].' '.$data['students'][$i]['stu_firstname']; ?></td>
                        <td style="text-align: center;"><button class="btn btn-success"><i class="fa fa-search"></i></button></td>
                        <td style="text-align: center;"><a href="/leaders-mailto/<?=$data['students'][$i]['stu_user_id']?>/topar=<?=$data['leader']['id']?>" class="btn btn-warning"><i class="fa fa-envelope-o"></i></a></td>
                    </tr>
                    <?php }?>
                </table>
            </article>
        </div>
    </div>
    <div class="col-lg-4" style="padding-left: 0;">
        <?php self::view('groupleaders/sidebar',$data); ?>
    </div>
        
</div>

