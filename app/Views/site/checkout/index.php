<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<?php
	$barnstall				= $cartdetail['barnstall'];
	$transactionfee 	= (3 / 100) * $cartdetail['price'];
	$stripemode 			= $settings['stripemode'];
	$stripepublickey 	= $settings['stripepublickey'];
	$firstname 				= $stripemode=='2' ? 'First Name Test' : '';
	$lastname 				= $stripemode=='2' ? 'Last Name Test' : '';
	$mobile 					= $stripemode=='2' ? '987654321' : '';
	$name 						= $stripemode=='2' ? 'test' : '';
	$cardno 					= $stripemode=='2' ? '4242424242424242' : '';
	$cvc 							= $stripemode=='2' ? '123' : '';
	$expirymonth 			= $stripemode=='2' ? '12' : '';
	$expiryyear 			= $stripemode=='2' ? '2027' : '';

?>
<section class="maxWidth">
  <div class="pageInfo">
    <span class="marFive">
      <a href="<?php echo base_url(); ?>">Home /</a>
      <a href="javascript:void(0);"> Checkout</a>
    </span>
  </div>

  <div class="marFive dFlexComBetween eventTP">
    <div class="pageInfo m-0 bg-transparent">
      <span class="eventHead">
        <a href="<?php echo base_url().'/events'; ?>" class="mb-4 d-block"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
        </svg> Back To Details</a>
        <h1 class="eventPageTitle">Checkout</h1>
      </span>
    </div>
  </div>
</section>

<section class="container-lg">
  <div class="row">
    <div class="col-lg-9">
      <form role="form" action="" method="post" class="stripeform" id="checkoutform">
        <div class="col-lg-12">
          <div class="checkout-renter border rounded pt-4 ps-4 pe-4 mb-5">
            <h2 class="checkout-fw-6 mb-2">Renter Information</h2>
            <p>Changes to this information will be reflected on all of your existing reservations.</p>
            <div class="row">
              <div class="col-lg-6 mb-4">
                <input placeholder="First Name" name="firstname" autocomplete='off' value="<?php echo $firstname; ?>">
              </div>
              <div class="col-lg-6 mb-4">
                <input type="text" placeholder="Last Name" name="lastname" autocomplete='off' value="<?php echo $lastname; ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6  mb-4">
                <input placeholder="Mobile Number" name="mobile" autocomplete='off'  value="<?php echo $mobile; ?>">
              </div>
              <div class="col-lg-6 mb-4">
                <span class="info-box d-flex justify-content-between"><img class="dash-info-i" src="<?php echo base_url()?>/assets/site/img/chekout-info.png"><p>You may receive a text message with your stall assignment before your arrival.</p></span>
              </div>
            </div>
          </div> 

          <div class="checkout-payment border rounded pt-4 ps-4 pe-4 mb-5">
            <h2 class="checkout-fw-6 mb-4">Payment Details</h2>
            <p class="fw-bold">Card Details</p>
            <div class="row checkout-payment-frist">
              <div class="col-lg-6 mb-4">
               <input type='text' placeholder='Name on Card' name='name' class='name' autocomplete='off'  value="<?php echo $name; ?>">
             </div>
             <div class="col-lg-6 mb-4">
              <input  type='text' placeholder='Your Card Number' name='card_number' class='card-number' autocomplete='off' value="<?php echo $cardno; ?>">
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12  mb-4">
              <input type='text' class='card-expiry-month' placeholder='MM'  name='card_exp_month' autocomplete='off' value="<?php echo $expirymonth; ?>">
              <input type='text' class='card-expiry-year' placeholder='YYYY'  name='card_exp_year' autocomplete='off'  value="<?php echo $expiryyear; ?>">
              <input type='text' class='card-cvc' placeholder='ex. 311' type='text' name='card_cvc' autocomplete='off'  value="<?php echo $cvc; ?>">
            </div>
          </div>
		  <div class='error hide'><div class='alert' style="color: red;"></div></div> 
        </div> 
        <input type="hidden" name="userid" value="<?php echo $userdetail['id']; ?>">
        <input type="hidden" name="email" value="<?php echo $userdetail['email']; ?>" >
        <input type="hidden" name="checkin" value="<?php echo formatdate($cartdetail['check_in']); ?>" >
        <input type="hidden" name="checkout" value="<?php echo formatdate($cartdetail['check_out']); ?>" >
        <input type="hidden" name="price" value="<?php echo $cartdetail['price']+$transactionfee; ?>" >
        <input type="hidden" name="eventid" value="<?php echo $cartdetail['event_id']; ?>" >
        <input type="hidden" name="type" value="<?php echo $cartdetail['type']; ?>" >
        <input type="hidden" name="barnstall" value='<?php echo json_encode($barnstall); ?>'>
        <input type="hidden" name="page" value="checkout" >

        <div class="checkout-special border rounded pt-4 ps-4 pe-4 mb-5">
          <h2 class="checkout-fw-6">Special Requests</h2>
          <p>Optional</p>
          <p>Enter any requests, such as stall location or other renters you want to be placed near.
            <b>Please note: special requests are not guaranteed</b></p>
            <textarea placeholder="Message"></textarea>
          </div> 

          <div class="checkout-reservation border rounded pt-4 ps-4 pe-4 mb-5">
            <h2 class="checkout-fw-6">Reservation Summary</h2>
            <div class="row">
              <div class="col-lg-6 mb-4">
                <b>Event</b>
                <p><?php echo $cartdetail['event_name'];?></p>
                <b>Location</b>
                <p><?php echo $cartdetail['event_location'];?><br>
                </div>
                <div class="col-lg-6 mb-4">
                  <b>Venue</b>
                  <p><?php echo $cartdetail['event_description'];?></p>
                </div>

              </div>
              <div class="row">
                <h2 class="checkout-fw-6 stallsum-head">Stall Summary</h2>
                <div class="col-lg-6 mb-4">
                  <b>Check In</b>
                  <p class="mb-4"><?php echo $cartdetail['check_in'] ?></p>
                  <b>Check Out</b>
                  <p><?php echo $cartdetail['check_out'] ?></p>
                </div>

                <div class="col-lg-6 mb-4">
                  <b>Number Of Stalls</b>
                  <p><?php echo count($barnstall); ?> Stalls 
                   <?php 
                   foreach ($barnstall as $data) { 
                     echo '<p>'.$data['barn_name'].'-'.$data['stall_name'].'</p>'; 
                   }
                   ?>
                 </p>
               </div>
             </div>
           </div>
           <div class="checkout-complete-btn">
            <span>
              <input class="form-check-input me-1" type="checkbox" name="tc" data-error="firstparent">I have read and accepted the <span class="redcolor">Terms and Conditions.</span></span>
              <input type="hidden" name="stripepayid" class="stripepayid">
              <button class="payment-btn " type="submit">Complete Payment</button>
            </div>
          </form>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="border rounded pt-4 ps-3 pe-3 mb-5">
          <div class="row mb-2">
            <div class="col-lg-8 ">
              <?php echo count($barnstall); ?> Stalls x <?php echo $cartdetail['interval']; ?> Nights
            </div>
            <div class="col-lg-4">
              <?php echo $currencysymbol.$cartdetail['price']; ?>
            </div>
          </div> 
          <div class="row mb-2">
            <div class="col-lg-8 ">
              Transaction Fees
            </div>
            <div class="col-lg-4">
              <?php echo $currencysymbol.$transactionfee; ?>
            </div>
          </div> 
          <div class="row mb-2 border-top mt-3 mb-3 pt-3">
            <div class="col-lg-8 fw-bold ">
              Total Due
            </div>
            <div class="col-lg-4 fw-bold">
              <?php echo $currencysymbol.($cartdetail['price']+$transactionfee); ?>
            </div>  
          </div>
        </div>
      </div>


    </div>
  </section>
	
	<div class="stripeiframe displaynone">
		<div></div>
	</div>
  <?php $this->endSection(); ?>
  <?php $this->section('js') ?>
  <script>
    $(function(){
		validation(
		'.stripeform',
		{
		firstname      : {
		required  :   true
		},
		lastname      : {
		required  :   true
		},
		mobile      : {
		required  :   true
		},
		payer_name      : {
		required  :   true
		},
		card_number     : { 
		required  :   true
		},
		card_cvc      : {
		required  :   true
		},          
		card_exp_month  : {
		required  :   true
		},
		card_exp_year   : {
		required  :   true
		},
		tc   : {
		required  :   true
		}
		},
		{ 
		firstname      : {
		required    : "Please Enter Your Firstname."
		},
		lastname      : {
		required    : "Please Enter Your Lastname."
		},
		mobile      : {
		required    : "Please Enter Mobile Number."
		},  
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
		tc   : {
		required    : "Please check the checkbox."
		},
		}
		);
	});
	
		var $form = $(".stripeform");
		$form.bind('submit', function(e) {
			if(!$form.valid()){
				return false;
			}
			
			if($('.stripepayid').val()!=''){
				return true;
			}
			
			e.preventDefault();
			Stripe.setPublishableKey('<?php echo $stripepublickey; ?>');
			Stripe.createToken({
				number: $('.card-number').val(),
				cvc: $('.card-cvc').val(),
				exp_month: $('.card-expiry-month').val(),
				exp_year: $('.card-expiry-year').val()
			}, stripeResponseHandler);
		});

		function stripeResponseHandler(status, response) {
			if (response.error) {
				$('.error').removeClass('hide').find('.alert').text(response.error.message);
			} else {
				$('.paymentloader').remove();
				
				ajax('<?php echo base_url()."/ajax/ajaxstripepayment"; ?>', $form.serializeArray(), {
					beforesend: function() {
						$('body').append('<div class="paymentloader"><div class="loader_wrapper"><img src="<?php echo base_url()."/assets/site/img/loading.svg"; ?>"></div></div>');
					},
					success: function(data){
						if(data.success.status=='1'){
							$('.stripepayid').val(data.success.id);
							if(data.success.url==''){
								$('.paymentloader').remove();
								$(".stripeform").submit();
							}else{
								$('.stripeiframe').removeClass('displaynone');
								$('.stripeiframe div').html('<iframe src="'+data.success.url+'" width="400" height="400"></iframe>');
								$('.paymentloader').remove();
							}
						}else{
							$('.paymentloader').remove();
							$('.stripeiframe').find('iframe').remove();
							$('.stripeiframe').addClass('displaynone');
						}
					},
					error: function(data){
						$('.paymentloader').remove();
						$('.error').removeClass('hide').find('.alert').text(data.responseJSON.message);
					}
				});
			}
		}
		
		window.addEventListener('message', function(ev) {
			if (ev.data === '3DS-authentication-complete') {
				$(".stripeform").submit();
			}
		}, false);

  </script>
  <?php $this->endSection() ?>
