<?php

?>
<div class="row">
    <div class="col-lg-12 registration">
        <h1>TOUR COSTS</h1>
        <div class="col-lg-6" style="padding-left: 0;">
            <form action="/payment" method="post">
                <input type="hidden" name="user_id" value="<?php echo $data[1]; ?>">
                <input type="hidden" name="tour_id" value="<?php echo $data[0]['tou_id']; ?>">
                <input type="hidden" name="members" value="<?php echo $data[2]; ?>">
                <input type="hidden" name="tour_full_pay">
            <div class="reg-occ">
                <h3>Select tour costs options</h3>
                <h4>Fixed costs</h4>
                <p>Tour amount - $<?php echo $data[0]['psc_full']; ?></p>
                    <input type="hidden" name="tour_amount" value="<?php echo $data[0]['psc_full']; ?>">
                <p>Minimum capacity - not charged</p>
                <h4>Select optional costs</h4>
                    <p hidden="" id="fnop"><?php echo $data[2];?></p>
                    <label>HFR charges - $<?php echo $data[0]['tou_hfr']; ?></label>
                    <p hidden="" id="fhfr_val"><?php echo $data[0]['tou_hfr']; ?></p>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="tour_hfr" value="y" checked="">
                            opt out HFR charges
                        </label>
                    </div>
                    <label>Occupancy</label>
                    <select id="focc_val" class="form-control">
                        <option value="0">Quadruple occupancy - $0</option>
                        <option value="<?php echo $data[0]['tou_triple']; ?>">Triple occupancy - $<?php echo $data[0]['tou_triple']; ?></option>
                        <option value="<?php echo $data[0]['tou_double']; ?>">Double occupancy - $<?php echo $data[0]['tou_double']; ?></option>
                        <option value="<?php echo $data[0]['tou_single']; ?>">Single occupancy - $<?php echo $data[0]['tou_single']; ?></option>
                    </select>
                    <input type="hidden" name="tour_occupancy" value="Q">
                    <h4>PAYMENT CALCULATION</h4>
                    <h5>&nbsp;- for <?php echo $data[2];?> student(s)</h5>
                    <label>HFR - $<strong id="calcfhfr"><?php echo ($data[2]*$data[0]['tou_hfr']); ?></strong></label><br>
                    <label>Occupancy - $<strong id="calcfocc">0</strong></label><br>
                    <h4 class="fulltotal">Total for payment(+4% fee) - $<strong id="calcftotal"></strong></h4><br>
                    
                    <h1><input type="submit" name="confirmpay" value="ACCEPT TERMS AND CODITIONS AND SAVE" class="btn btn-default"></h1>
            </div>
            </form>
        </div>
        <div class="col-lg-6">
            <div class="row reg-tinfo">
                <div class="col-lg-12">
                <h3>Tour information</h3>
                <p><strong>Title: </strong><?php echo $data[0]['tou_title'];?></p>
                <p><strong>Destination: </strong><?php echo $data[0]['tou_destination'];?></p>
                <p><strong>Starts: </strong><?php echo date('m.d.Y.', strtotime($data[0]['tou_start']));?></p>
                <p><strong>Ends: </strong><?php echo date('m.d.Y.', strtotime($data[0]['tou_end']));?></p>
                </div>
                <div class="col-lg-6">
                <h4>Tour costs</h4>
                <p><strong>Tour amount: </strong>$<?php echo $data[0]['psc_full'];?></p>
                <p><strong>Quadruple occupancy: </strong>$<?php echo '0';?></p>
                <p><strong>Triple occupancy: </strong>$<?php echo $data[0]['tou_triple'];?></p>
                <p><strong>Double occupancy: </strong>$<?php echo $data[0]['tou_double'];?></p>
                <p><strong>Single occupancy: </strong>$<?php echo $data[0]['tou_single'];?></p>
                <p><strong>HFR: </strong>$<?php echo $data[0]['tou_hfr'];?></p>
                </div>
                <div class="col-lg-6">
                <h4>Special costs</h4>
                <p><strong>Minimum capacity: </strong><?php echo $data[0]['psc_mincap1'];?><strong> - </strong>$<?php echo $data[0]['psc_minval1'];?></p>
                <p><strong>Minimum capacity: </strong><?php echo $data[0]['psc_mincap2'];?><strong> - </strong>$<?php echo $data[0]['psc_minval2'];?></p>
                <p><strong>Minimum capacity: </strong><?php echo $data[0]['psc_mincap3'];?><strong> - </strong>$<?php echo $data[0]['psc_minval3'];?></p>
                </div>
                <div class="col-lg-12" style="padding: 0;">
                    <h4 style="padding-left: 15px;">Documentation</h4>
                    <div class="col-lg-3">
                        <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#pletter">Read Parent Letter</button>
                    </div>
                    <div class="col-lg-3">
                        <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#itin">Itinerrary Overview</button>
                    </div>
                    <div class="col-lg-3">
                        <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#terms">Read Terms</button>
                    </div>
                    <div class="col-lg-3">
                        <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#hfr">Read about HFR</button>
                    </div>
                </div>
            </div>
        </div>
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
    
<div class="modal fade" id="pletter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">PARENT LETTER</h4>
      </div>
      <div class="modal-body">
        <?php self::view('documentation/parentletter', $data); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="hfr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">HASSLE FREE REFUND (HFR)</h4>
      </div>
      <div class="modal-body">
        <?php self::view('documentation/hfr', $data); ?>
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
        <h4 class="modal-title" id="myModalLabel">LEGAL TERMS &AMP; CONDITIONS</h4>
      </div>
      <div class="modal-body">
        <?php self::view('documentation/itin',$data); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    
    
</div>

