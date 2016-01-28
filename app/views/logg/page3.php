<?php

?>
<div class="row">
    <div class="col-lg-12 registration">
        <h1>PAYMENT</h1>
    <div class="col-lg-6 col-lg-offset-3">
        <div class="payment-form">
            <form action="/success" method="post">
                <input type="hidden" name="user_id" value="<?php echo $data[0]; ?>">
                <input type="hidden" name="tour_id" value="<?php echo $data[1]; ?>">
                <input type="hidden" name="members" value="<?php echo $data[2]; ?>">
                <input type="hidden" name="enroll_id" value="<?php echo $data[3]; ?>">
                <input type="hidden" name="tour_full" value="<?php echo $data[4]; ?>">
                <img src="/assets/images/common/credit-card-icons.png" alt="Credit Cards Icons" class="img-thumbnail" />
				
					<input type="hidden" name="signature" id="card_sign">
					<table class="table">
						<tr>
							<td>Choose Credit Card</td>
							<td>
                                                            <select name="creditcard" class="form-control">
									<option value="Visa">Visa</option>
									<option value="MasterCard">MasterCard</option>
									<option value="Amex">American Express</option>
									<option value="Discover">Discover</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Credit Card Number</td>
							<td><input type="text" name="ccnumber" maxlenght="18" pattern="[0-9]{15,16}"></td>
						</tr>
						<tr>
							<td>Expiration Date (format: 0115)</td>
							<td><input type="text" name="expdate" size="7" pattern="[0-9]{4}"></td>
						</tr>
						<tr>
							<td>Code [cvc]</td>
							<td><input type="text" name="cvv2" size="4" pattern="[0-9]{3,4}"></td>
						</tr>
						<tr>
							<td>First Name</td>
							<td><input type="text" name="fname" class="form-control"></td>
						</tr>
						<tr>
							<td>Last Name</td>
							<td><input type="text" name="lname" class="form-control"></td>
						</tr>
						<tr>
							<td>Address</td>
							<td><input type="text" name="street" class="form-control"></td>
						</tr>
						<tr>
							<td>City</td>
							<td><input type="text" name="city" class="form-control"></td>
						</tr>
						<tr>
							<td>Zipcode</td>
							<td><input type="text" name="zip" class="form-control"></td>
						</tr>
						<tr>
							<td>State</td>
							<td><input type="text" name="state" class="form-control"></td>
						</tr>
						<tr>
							<td>Total amount</td>
							<td><?php echo '&#36;'.$data[4]; ?></td>
						</tr>
						<tr>
							<td></td>
                                                        <td><input class="btn btn-danger" type="submit" value="Make Payment" name="confirmpay"></td>
						</tr>
						
					</table>
                </form>
        </div>
    </div>
    </div>
</div>

