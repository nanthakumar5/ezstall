<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
              <section class="maxWidth">
                <div class="pageInfo">
                  <span class="marFive">
                    <a href="/">Home /</a>
                    <a href="/Events"> Checkout</a>
                  </span>
                </div>
        
                <div class="marFive dFlexComBetween eventTP">
                    <div class="pageInfo m-0 bg-transparent">
                    <span class="eventHead">
                    <a href="/Events" class="mb-4 d-block"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                      </svg> Back To Details</a>
                  <h1 class="eventPageTitle">Checkout</h1>
                </span>
            </div>
                </div>
            </section>

            <section class="container-lg">
                <div class="row">
                <form role="form" action="" method="post" class="stripeform" id="checkoutform">
                <div class="col-lg-8">
                  <div class="checkout-renter border rounded pt-4 ps-4 pe-4 mb-5">
                      <h2 class="checkout-fw-6 mb-2">Renter Information</h2>
                      <p>Changes to this information will be reflected on all of your existing reservations.</p>
                      <div class="row">
                        <div class="col-lg-6 mb-4">
                          <input placeholder="First Name" name="firstname" autocomplete='off'>
                        </div>
                        <div class="col-lg-6 mb-4">
                          <input type="text" placeholder="Last Name" name="lastname" autocomplete='off'>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6  mb-4">
                          <input placeholder="Mobile Number" name="mobile" autocomplete='off'>
                        </div>
                        <div class="col-lg-6 mb-4">
                          <span class="info-box"><img src="<?php echo base_url()?>/assets/site/img/Chekout-info.png"><p>You may receive a text message with your stall assignment before your arrival.</p></span>
                        </div>
                      </div>
                  </div> 

                  <div class="checkout-payment border rounded pt-4 ps-4 pe-4 mb-5">
                    <h2 class="checkout-fw-6 mb-4">Payment Details</h2>
                    <p class="fw-bold">Card Details</p>
                    <div class="row checkout-payment-frist">
                      <div class="col-lg-6 mb-4">
                         <input type='text' placeholder='Name on Card' name='payer_name' class='payer_name' autocomplete='off'>
                      </div>
                      <div class="col-lg-6 mb-4">
                        <input  type='text' placeholder='Your Card Number' name='card_number' class='card-number' autocomplete='off'>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12  mb-4">
                        <input type='text' class='card-expiry-month' placeholder='MM'  name='card_exp_month' autocomplete='off'>
                        <input type='text' class='card-expiry-year' placeholder='YYYY'  name='card_exp_year' autocomplete='off'>
                        <input type='text' class='card-cvc' placeholder='ex. 311' type='text' name='card_cvc' autocomplete='off'>
                      </div>
                    </div>
                </div> 
                  <input type="hidden" name="payer_id" id="payer_id" value="<?php echo $userdetail['id']; ?>">
                  <input type="hidden" name="payer_email" id="payer_email" value="<?php echo $userdetail['email']; ?>" >
                  <input type="hidden" name="check_in" id="check_in" value="<?php echo date('Y-m-d H:i:s');?>" >
                  <input type="hidden" name="check_out" id="check_out" value="<?php echo date('Y-m-d H:i:s');?>" >
                  <input type="hidden" name="price" id="price" value="50" >
                  <input type="hidden" name="stallid" id="stallid" value="1">

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
                      <p>High Plains Junior Rodeo--February 22</p>
                      <b>Location</b>
                      <p>Curry County Events Center & Fairgrounds<br>
                        1900 E Brady Ave<br>
                        Clovis, NM 88101</p>
                  </div>

                  <div class="col-lg-6 mb-4">
                    <b>Venue</b>
                    <p>Designed as a multi-function event facility, the Curry County Events Center is fully equipped to host rodeos, livestock sales, dog shows, concerts, circuses, trade shows, 
                      conventions, sporting events & a vast array of other private & public events.</p>
                  </div>

                </div>
                <div class="row">
                  <h2 class="checkout-fw-6 stallsum-head">Stall Summary</h2>
                  <div class="col-lg-6 mb-4">
                    <b>Check In</b>
                      <p class="mb-4">Thu, Feb 10, 2022 • After 8am</p>
                      <b>Check Out</b>
                      <p>Sat, Feb 12, 2022 • By 3pm</p>
                  </div>

                  <div class="col-lg-6 mb-4">
                    <b>Number Of Stalls</b>
                    <p>4 Stalls (4,6,10,12)</p>
                  </div>
                </div>
            </div>

            <div class="checkout-complete-btn">
              <span>
                <input class="form-check-input me-1" type="checkbox" value="" aria-label="..."> I confirm that I have read and accepted the <span class="redcolor">Agreement.</span></span>
              <button class="payment-btn " type="submit">Complete Payment</button>
            </div>
        </form>
                </div>
                <div class="col-lg-3">
                  <div class="border rounded pt-4 ps-3 pe-3 mb-5">
                 <div class="row mb-2">
                  <div class="col-lg-8 ">
                         4 Stalls x 4 Nights
                     </div>
                     <div class="col-lg-4">
                          $120.00
                     </div>
                 </div> 
                 <div class="row mb-2">
                  <div class="col-lg-8 ">
                         Transaction Fees
                     </div>
                     <div class="col-lg-4">
                          $8.50
                     </div>
                 </div> 
                 <div class="row mb-2 border-top mt-3 mb-3 pt-3">
                  <div class="col-lg-8 fw-bold ">
                         Total Due
                     </div>
                     <div class="col-lg-4 fw-bold">
                          $128.50
                     </div>
                 </div>
                 </div>
              </div>
            </div>
            </section>

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
    }
  );
  var $form = $(".stripeform");

  $('.stripeform').bind('submit', function(e) {
    if(!$form.valid()){
      return false;
    }

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
      $('.error').removeClass('hide').find('.alert').text(response.error.message);
    } else {
      var token = response['id'];
      $form.find('input[type=text]').empty();
      $form.append("<input type='hidden' name='stripe_token' value='" + token + "'/>");
      $form.get(0).submit();
    }
  }
});
</script>
<?php $this->endSection() ?>
