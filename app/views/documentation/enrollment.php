<?php

$d = self::model('registration')->getEnrollmentForm($data['user_id'], $data['tour_id'], $data['enroll_id'], $data['members']);


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Son Tours inc.');
$pdf->SetTitle('Enrollment Form');
$pdf->SetSubject('Enrollment Form');
$pdf->SetKeywords('son tours, enrollment form, enrollment');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists('/tcpdf/examples/lang/srp.php')) {
    require_once('/tcpdf/examples/lang/srp.php');
    $pdf->setLanguageArray($l);
}

// set font
$pdf->SetFont('dejavusans', '', 9);

// add a page
$pdf->AddPage();

// create some HTML content
$html = '<div style="padding: 12px 38px;">
	<h1 style="text-align: center;font-size:20px;">ENROLLMENT FORM<br>for registration to '.$d['tour']['tou_title'].'</h1>
	<div style="height:40px;width:100%;"></div>
        <div style="font-size: 16px;"><strong>Son-Tours, Inc.<br>PO Box 1839, Duluth<br>Georgia  30096</strong></div>
	<div style="height:30px;width:100%;"></div>
        <table border="0" cellpadding="10" cellspacing="0">
		<tr>
			<td><strong>Tour Title</strong></td>
			<td>'.$d['tour']['tou_title'].'</td>
		</tr>
		<tr>
			<td><strong>Tour Destination</strong></td>
			<td>'.$d['tour']['tou_destination'].'</td>
		</tr>
		<tr>
	<td><strong>Departure Date</strong></td>
	<td>'.date("m-d-Y", strtotime($d['tour']['tou_start'])).'</td>
</tr>
	</table>
        <div style="height:30px;width:100%;"></div>
	<table border="1" cellpadding="6">
        <tr><td colspan="2"><h1>REGISTERED PARTICIPANT/S</h1></td></tr>';

		for($i=0; $i<$d['members']; $i++){ $p=$i+1;
$html.=		'<tr><td colspan="2"><strong>'.$p.'. REGISTERED PARTICIPANT</strong></td></tr>
		<tr>
	<td><strong>Name of participant</strong></td>
	<td>'.$d['personal'][$i]['stu_firstname'].' '.$d['personal'][$i]['stu_lastname'].'</td>
</tr>
<tr>
	<td><strong>Parent Name</strong></td>
	<td>'.$d['personal'][$i]['firstname'].' '.$d['personal'][$i]['lastname'].'</td>
</tr>
<tr>
	<td><strong>Date of birth</strong></td>
	<td>'.date("m-d-Y", strtotime($d['personal'][$i]['stu_dob'])).'</td>
</tr>
<tr>
	<td><strong>Address</strong></td>
	<td>'.$d['personal'][$i]['address1'].', '.$d['personal'][$i]['city'].', '.$d['personal'][$i]['state'].'</td>
</tr>
<tr>
	<td><strong>Special occupancy</strong></td>
	<td>';
switch($d['enroll']['enf_occ']){case 'T': $html .= 'Triple';$occ=$d['members']*$d['tour']['tou_triple']; break; case 'D': $html .= 'Double';$occ=$d['members']*$d['tour']['tou_double'];break; case 'S': $html .= 'Single';$occ=$d['members']*$d['tour']['tou_single']; break; default : $html .= 'Quadruple';$occ=0;}
$html .= '</td></tr><tr>
    <td><strong>Hassle Free Refund (HFR)</strong></td>
    <td>';
if($d['enroll']['enf_hfr']==='y'){$html .= 'YES';}else{$html .= 'NO';}
$html .= '</td></tr>';
 }
$html .= '</table>
    <div style="height:30px;width:100%;"></div>
	<table  border="1" cellpadding="6">
		<tr><th colspan="2"><h1>PAYMENT DETAILS</h1></th></tr>
                
		<tr>
			<td><strong>Tour amount</strong></td>
			<td>For '.$d['members'].' student/s - &#36;'.($d['members']*$d['tour']['psc_full']).'</td>
		</tr>
                <tr>
			<td><strong>Hassle Free Refund (HFR)</strong></td>
			<td>For '.$d['members'].' student/s - &#36;';
if($d['enroll']['enf_hfr']==='y'){$html .= ($d['members']*$d['tour']['tou_hfr']);}else{$html .= '0';}
        $html .= '</td>
		</tr>
		<tr>
			<td><strong>Special occupancy</strong></td>
			<td>For '.$d['members'].' student/s - &#36;'.$occ.'</td>
		</tr>
		
		<tr style="background-color: #eee;">
			<td><strong>TOTAL AMOUNT(+4% transaction fee)</strong></td>
			<td><strong>&#36;'.$d['enroll']['enf_amount'].'</strong></td>
		</tr>
		
	</table>
        <div style="height:50px;width:100%;"></div>
	<div>
		<h1 style="font-size:20px;text-align:center;">LEGAL TERMS &amp; CONDITIONS</h1>
		<ul>
			<li>
				<h4>CANCELLATION REFUND POLICY </h4>
				<p>All cancellation requests must be in writing, listing the group and participant’s name, and the reason for cancellation with documentation provided. Your original deposit is non-refundable. Any balance paid, not including the non-refundable deposit, will be refunded in full for written cancellations prior to 91 days from the scheduled date of departure. A fee of 50% of the total tour price will be charged for cancellations postmarked 61-90 days from the scheduled date of departure. A fee of 60% of the total tour price will be charged for cancellations postmarked 46-61 days from the scheduled date of departure. No refund will be given for cancellations postmarked 45 days or less from the scheduled departure date.</p>
			</li>
			<li>
				<h4>RETURNED CHECKS </h4>
				<p>All returned checks will be subject to a $25 collection fee. Checks will not be resubmitted to a bank. You will be required to pay all future payments by money order. If there is a waiting list, and your original deposit check is returned, you will be placed on the waiting list and will forfeit your space. </p>
			</li>
			
			<li>
				<h4>NAME CHANGES </h4>
				<p>A change of name must be put in writing and approved by Son-Tours, Inc. For groups traveling by motorcoach, a $25 fee will be applied. For groups traveling by air, a $100 fee will be applied. Please fax a name change request to (770) 813-4698. Tour deposits cannot be moved between participants without paying a $25 name change. </p>
			</li>
			<li>
				<h4>DISCIPLINE</h4>
				<p>The designated group leader has full authority to send a student home if that student displays willful misconduct or criminal activity while on tour. By signing this form, the parent or guardian agrees to accept all financial liabilities for return arrangements for their child whether by train, bus (Greyhound) or airline. An assigned group escort will stay with this student until he/she boards the transportation for the return home. </p>
			</li>
			<li>
				<h4>INSURANCE BENEFITS INCLUDED </h4>
				<p>All overnight packages include: $25,000 Emergency Evacuation/Repatriation, $5,000 Accident/Sickness, Emergency Dental, Travel Assistance and $500 Travel Delay. This is a reimbursable insurance that will cover medical expenses you have paid for an injury that occurred while on tour. </p>
			</li>
			<li>
				<h4>LIABILITY DISCLOSURE </h4>
				<p>Son-Tours, Inc., and staff act only in the capacity of agents for the passengers in all matters pertaining to hotel accommodations, sightseeing tours and transportation whether by railroad, motorcoach, or plane, and as such, they shall not be liable for any injury, personal injury, damage, loss, accident, delay, or irregularity which may be occasioned either by reason of any company or person engaged in conveying the passenger, or in carrying out the arrangements of the tour, or otherwise in connection therewith. </p>
				<p>Son-Tours reserves seats with most major carriers. (The passenger contract in use by each airline, when issued, shall constitute the sole contract between the airline and the purchaser of the tour.) In cases where seating demand deems it necessary, Son-Tours does reserve the right to use charter flights. Due to available flight routings, we cannot guarantee non-stop flights. Because of space availability and sizes of available aircraft, we cannot guarantee that members of a group will all fly together on the same flight. In rare cases, groups may have an additional overnight due to flight space availability, routings, and legal connection times. Son-Tours cannot be held responsible for changes in scheduling that airlines make, and does not take responsibility for any layovers due to these airline changes, or weather-related delays. </p>
				<p>In the interest of giving students the most time possible on their tour, Son-Tours will attempt to secure the earliest flights available. In the case of a lost ticket, the participant is solely responsible for meeting the airline s requirements (both logistical and financial) for ticket replacement. In cases of unforeseen disaster, all tours will be completed unless otherwise directed by the Department of State. </p>
			</li>
			<li>
				<h4>GENERAL POLICY </h4>
				<p>Son-Tours, Inc. reserves the right to make substitutions of comparable quality in the itinerary where necessary. We also reserve the right to change the dates of your tour if outside agents are unavailable such as airlines or motorcoach vendors without penalty to Son-Tours. If Son-Tours changes your dates, you will be notified within 30 days of signing your contract. Any participant who can not make the tour due to the date changes will be offered a full refund, less a $50 administration fee. The right is also reserved to decline to accept or retain any person as a member of any party at any time. </p>
			</li>
		</ul>
	</div>
	<table style="width:100%;">
		<tr>
			<td><strong style="margin-left:22px;">Parent signature</strong></td>
			<td style="text-align:right"><strong style="margin-right:22px;">Date</strong></td>
		</tr>
		<tr>
			<td>'.$d['personal'][0]['firstname'].' '.$d['personal'][0]['lastname'].'</td>
			<td style="text-align:right">'.date("M-d-Y").'</td>
		</tr>
	</table>
	
</div>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

//Close and output PDF document
$pdf->Output('eform.pdf', 'I');


?>


