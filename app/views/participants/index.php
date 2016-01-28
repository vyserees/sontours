<?php
if(!isset($_SESSION['USER_ID'])&&$_SESSION['USER_ROLE']!=='P'){
    header('Location: /');
}
?>
<div class="row part">
    <?php //var_dump($data); ?>
    <div class="col-lg-12 part-header">
        <?php echo '<p>Welcome, '.$data['parent']['firstname'].' '.$data['parent']['lastname'].'</p>'; ?>
    </div>
    <div class="col-lg-8" style="padding-right: 0;">
        <div class="part-main-layout">
            <h3><?php echo $data['students'][0]['tou_title']; ?>
                <span class="pull-right" style="font-size: 14px;font-style: italic;text-align: center;">
                    <?php 
                    $start = strtotime($data['students'][0]['tou_start']);
                    $gap = $start-time();
                    $days = abs(ceil($gap/(24*60*60)));
                    echo '<p>Starting in :<br><strong>'.$days.'</strong> days</p>';
                    ?>
                </span>
            </h3>
            <div class="row">
                <div class="col-lg-8">
                    <article><?php echo $data['students'][0]['tou_long']; ?></article>
                </div>
                <div class="col-lg-4">
                    <h4>Destination</h4>
                    <p><?php echo $data['students'][0]['tou_destination']; ?></p>
                    <h4>Transportation</h4>
                    <p><?php 
                    switch($data['students'][0]['tou_transport']){
                        case 'A':
                            echo 'Airplane';
                            break;
                        case 'C':
                            echo 'Coach';
                            break;
                        case 'T':
                            echo 'Train';
                            break;
                        default :
                            echo 'Ship';
                    } 
                    ?></p>
                    <h4>Departure date</h4>
                    <p><?php echo date('m.d.Y.', strtotime($data['students'][0]['tou_start'])); ?></p>
                    <h4>Return date</h4>
                    <p><?php echo date('m.d.Y', strtotime($data['students'][0]['tou_end'])); ?></p>
                </div>
                <div class="col-lg-12">
                    <div class="part-main-buttons" style="text-align:center;">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#itin">ITINERARY</button>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pletter">PARENT LETTER</button>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#terms">TERMS AND CONDITIONS</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4" style="padding-left: 0;">
        <?php self::view('participants/sidebar',$data); ?>
    </div>
        
</div>
    
    <!--Modals for documentation-->
<div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">LEGAL TERMS &AMP; CONDITIONS</h4>
      </div>
      <div class="modal-body">
        <?php self::view('documentation/terms'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    
<div class="modal fade" id="pletter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">PARENT LETTER</h4>
      </div>
      <div class="modal-body">
        <?php self::view('documentation/parentletter', $data['students']); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="itin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ITINERARY</h4>
      </div>
      <div class="modal-body">
          <div class="col-lg-12">
              <iframe style="width:100%;min-height: 500px;" src="/assets/itineraries/<?php echo $data['students'][0]['tou_itin']; ?>"></iframe>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


