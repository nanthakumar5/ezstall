<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
	<style type="text/css">
	input[type="radio"] {
		display: inline-block;
	}
	</style>

<?php if($userdetail['subscription_id']=='' || $userdetail['subscription_id']=0){ ?>

	<div class="col payment-border">
		<div class="text-center">
			<input type="radio" checked>
			<label class="subscription_select_label"><?php echo $plan['name']; ?></label>
			<label class="subscription_select_label"><?php echo $currencysymbol.$plan['price']; ?></label>
		</div>
		<div class="choose_subscription_btn text-center">
			<button class="pay-btn"  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stripeFormModal" data-bs-whatever="@getbootstrap">Pay Now</button>
		</div>
	</div>

<?php } else{ ?>

	<div class="col payment-border">
		<div>
			<h6>Your subscription was activated.
			Your next subscription payment will be due by <?php echo date("d-m-Y", strtotime($userdetail['subscription_end_date']));?></h6>
		</div>
	</div>

<?php } ?>

<?php $this->endSection(); ?>
<?php $this->section('js') ?>
	<?php echo $stripe; ?>
	<script>
		$('#stripeFormModal').on('shown.bs.modal', function () {
			$('.stripeextra').remove();
			
			var data = 	'<div class="stripeextra">\
							<input type="hidden" value="<?php echo $plan['id']; ?>" name="plan_id">\
							<input type="hidden" value="<?php echo $plan['name']; ?>" name="plan_name">\
							<input type="hidden" value="<?php echo $plan['price']; ?>" name="price">\
							<input type="hidden" value="<?php echo $plan['interval']; ?>" name="plan_interval">\
							<input type="hidden" value="<?php echo $plan['interval_count']; ?>" name="plan_interval_count">\
						</div>';
						
			$('.stripepaybutton').append(data);
		})
	</script>
<?php echo $this->endSection(); ?>
