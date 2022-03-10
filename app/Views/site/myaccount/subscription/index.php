<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>

<style type="text/css">
	input[type="radio"] {
    display: block;
}
</style>

<div>
	<div class="paymentselect">
		<input type="radio" name="golden" id="golden" checked>
		<label class="subscription_select_label"> $50</label>
	</div>
	<div class="choose_subscription_btn">
	     <button class="btn btn-primary"  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cardformModal" data-bs-whatever="@getbootstrap">Pay Now</button>
	</div>
</div>

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
<?php $this->endSection(); ?>

<?php $this->section('js') ?>
<script>


$(function(){
	validation(
				'#payment-form',
				{
					payer_name 	    : {
						required	: 	true
					},
					card_number     : {	
						required	: 	true
					},
					card_cvc 	    : {
						required	: 	true
					},					
					card_exp_month  : {
						required	: 	true
					},
					card_exp_year   : {
						required	: 	true
					}
				},
				{   
                    payer_name      : {
                        required    : "Name field is required."
                    },
                    card_number     : {
                        required    : "Card number field is required."
                    },
                    card_cvc        : {
                        required    : "Card CVC field is required."
                    },
                    card_exp_month  : {
                        required    : "Card Expiry Month field is required."
                    },
                   card_exp_year   : {
                        required    : "Card Expiry Year field is required."
                    },
                }
			);
	
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation");
                e.preventDefault();
                Stripe.setPublishableKey('<?php echo $stripepublishkey; ?>');
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);

        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });

</script>
<?php echo $this->endSection(); ?>
