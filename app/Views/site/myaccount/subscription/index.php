<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
	<style type="text/css">
	input[type="radio"] {
		display: inline-block;
	}
	</style>

	<div>
		<div class="col-md-12">
			<input type="radio" checked>
			<label class="subscription_select_label"><?php echo $plan['name']; ?></label>
			<label class="subscription_select_label"><?php echo $currencysymbol.$plan['price']; ?></label>
		</div>
		<div class="choose_subscription_btn">
			<button class="btn btn-primary"  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stripeFormModal" data-bs-whatever="@getbootstrap">Pay Now</button>
		</div>
	</div>
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
