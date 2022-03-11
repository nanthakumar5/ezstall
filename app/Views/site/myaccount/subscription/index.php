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
	     <button class="btn btn-primary"  type="button" class="btn btn-primary" id="subscription_method_btn"  data-bs-toggle="modal" data-bs-target="#cardformModal" data-bs-whatever="@getbootstrap">Pay Now</button>
	</div>
</div>

<div class="choose_subscription_btn">
	     <button class="btn btn-primary"  type="button" class="btn btn-primary" id="single_pay_method_btn"  data-bs-toggle="modal" data-bs-target="#cardformModal" data-bs-whatever="@getbootstrap">Single Payment</button>
	</div>
</div>

<?php echo $this->include('site/common/stripe/stripe1') ?>

<?php $this->endSection(); ?>
<?php $this->section('js') ?>

<script>

$(function(){

	$("#subscription_method_btn").click(function(){
		var methodtype="SubscriptionMethod";
        $('#single_payment_method').attr('value', '');  
		$('#subscription_method').val(methodtype);
	});

	$("#single_pay_method_btn").click(function(){
		var methodtype = "SinglePaymentMethod";
        $('#subscription_method').attr('value', '');  
		$('#single_payment_method').val(methodtype);
	});

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
