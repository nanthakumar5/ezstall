<!DOCTYPE html>
<html>
	<head>
	</head>
<body>

<div class="modal fade" id="cardformModal" tabindex="-1" aria-labelledby="cardformModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="cardformModalLabel">Stripe Payment</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
		    <div class="modal-body">
		    	<form role="form" action="" method="post" id="payment-form" class="require-validation">
					<div class="mb-3">
						<div class='required'>
							<label class='control-label'>Name on Card:</label> 
							<input autocomplete='off' class='form-control' size='4' placeholder='Name on Card' type='text' name='payer_name'>
						</div>

					</div>
					<div class="mb-3">
						<div class='card required'>
							<label class='control-label'>Card Number:</label> 
							<input autocomplete='off' class='form-control card-number' placeholder='Your Card Number' size='20' type='text' name='card_number'>
						</div>
					</div>
					<div class="mb-3">
						<div class='cvc required'>
							<label class='control-label'>CVC:</label> 
							<input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text' name='card_cvc'>
						</div>
					</div>
					<div class='mb-3'>
						<div class='expiration required'>
							<label class='control-label'>Expiration Month:</label> 
							<input class='form-control card-expiry-month' placeholder='MM' size='2' type='text' name='card_exp_month'>
						</div>
					</div>
					<div class='mb-3'>
						<div class='expiration required'>
							<label class='control-label'>Expiration Year:</label> 
							<input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' name='card_exp_year'>
						</div>
					</div>
					<input type="hidden" name="subscription_method" id="subscription_method" >
					<input type="hidden" name="single_payment_method" id="single_payment_method">

					<div class='error hide'>
					      <div class='alert' style="color: red;"></div>
					</div> 
				   	<div class="mb-3">
					   <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
				   	</div>
		        </form>
		    </div>
	    </div>
  	</div>
</div>

	</body>
</html>