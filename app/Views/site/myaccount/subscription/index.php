<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
	<style type="text/css">
	input[type="radio"] {
		display: inline-block;
	}
	</style>
	<?php  	 $currentdate 	  	= date("Y-m-d"); 
			 $subscriptiondate 	= date("Y-m-d", strtotime($userdetail['subscription_end_date']));
			 $subscriptionid    = array_unique(array_column($subscriptions, 'id'))[0];
			 $amount      		= array_unique(array_column($subscriptions, 'amount'))[0];
				if($amount == 1000 ) $subscriptionplan = 'Yearly Subscription';
				elseif($amount == 500 ) $subscriptionplan = 'Monthly Subscription';
				elseif($amount == 100 ) $subscriptionplan =  'Dew'; ?>				

	<?php if($userdetail['subscription_id'] == 'NULL' || $userdetail['subscription_id'] == 0){ 
			 	foreach($plans as $plan){ ?>
					<div class="col payment-border">
						<div class="text-center">
							<input type="radio" class="subscribe" name="subscribe">
							<label class="subscription_select_label"><?php echo $plan['name']; ?></label>
							<label class="subscription_select_label"><?php echo $currencysymbol.$plan['price']; ?></label>
								<div class="paymentfields">
									<input type="hidden" value="<?php echo $plan['id']; ?>" name="plan_id">
									<input type="hidden" value="<?php echo $plan['name']; ?>" name="plan_name">
									<input type="hidden" value="<?php echo $plan['price']; ?>" name="price">
									<input type="hidden" value="<?php echo $plan['interval']; ?>" name="plan_interval">
									<input type="hidden" value="<?php echo $plan['interval_count']; ?>" name="plan_interval_count">
								</div>
						</div>
						<div class="choose_subscription_btn text-center">
							<button class="pay-btn paynowbtn">Pay Now</button>
							<button style="display:none" class="pay-btn paynowhidden"  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stripeFormModal" data-bs-whatever="@getbootstrap"></button>
						</div>
					</div>
				<?php } 
		} elseif($currentdate > $subscriptiondate &&  $userdetail['subscription_id'] == $subscriptionid) {?> 
					<div>
						<h6><?php echo 'Your Subscription plan ended';?></h6>
						<h6>Your Last Subscription Plan is : </h6>
						<h6>Amount : <?php echo $currencysymbol.$amount;?></h6>
						<h6>Subscription Plan : <?php echo $subscriptionplan;?></h6>
					</div>
 		<?php foreach($plans as $plan){ ?>
					<div class="col payment-border">
						<div class="text-center">
							<input type="radio" class="subscribe" name="subscribe">
							<label class="subscription_select_label"><?php echo $plan['name']; ?></label>
							<label class="subscription_select_label"><?php echo $currencysymbol.$plan['price']; ?></label>
								<div class="paymentfields">
									<input type="hidden" value="<?php echo $plan['id']; ?>" name="plan_id">
									<input type="hidden" value="<?php echo $plan['name']; ?>" name="plan_name">
									<input type="hidden" value="<?php echo $plan['price']; ?>" name="price">
									<input type="hidden" value="<?php echo $plan['interval']; ?>" name="plan_interval">
									<input type="hidden" value="<?php echo $plan['interval_count']; ?>" name="plan_interval_count">
								</div>
						</div>
						<div class="choose_subscription_btn text-center">
							<button class="pay-btn paynowbtn">Pay Now</button>
							<button style="display:none" class="pay-btn paynowhidden"  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stripeFormModal" data-bs-whatever="@getbootstrap"></button>
						</div>
					</div>
		<?php } 
		} else{ ?>
					<div class="col payment-border">
						<div>
							<h6>Your subscription was activated.</h6><h6>Your next subscription payment will be due by <?php echo date("d-m-Y", strtotime($userdetail['subscription_end_date']));?></h6>
						</div>
					</div>
	<?php } ?>

<?php $this->endSection(); ?>
<?php $this->section('js') ?>
	<?php echo $stripe; ?>
	<script>
		$('.paynowbtn').click(function(){
			if(!$(this).parent().parent().find('.subscribe').is(':checked')){
				$(this).parent().parent().find('.subscribe').focus();
			}else{
				$(this).parent().find('.paynowhidden').click();
				
				$('.stripeextra').remove();
				var data = 	'<div class="stripeextra">'+$(this).parent().parent().find('.paymentfields').html()+'</div>';
				$('.stripepaybutton').append(data);
			}
		})
	</script>
<?php echo $this->endSection(); ?>
