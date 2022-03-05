<?php $this->extend('site/common/layout/layout1') ?>

<?php $this->section('content') ?>
<section class="maxWidth eventPagePanel mt-2">
	<a class="btn-custom-black" href="<?php echo base_url().'/myaccount/events/add'; ?>">Add Event</a>
	<?php foreach ($list as $data) {  ?>
		<div class="ucEventInfo mt-4">
			<div class="EventFlex">
				<span class="wi-50 px-2">
					<div class="EventFlex leftdata">
						<span class="wi-30">
							<span class="ucimg">
								<img src="<?php echo base_url() ?>/assets/uploads/event/<?php echo $data['image']?>">
							</span>
						</span>
						<span class="wi-70">
							<p class="topdate"> <?php echo $data['start_date']; ?> - <?php echo $data['end_date']; ?> -  <?php echo $data['location']; ?></p>
							<a class="text-decoration-none" href="<?php echo base_url() ?>/events/detail/<?php echo $data['id']?>"><h5><?php echo $data['name']; ?><h5></a></h5>
						</span>
					</div>
				</span>
				<div class="wi-50-2 px-3 justify-content-between">
					<span class="m-left w-100">
						<p><img class="eventFirstIcon" src="<?php echo base_url()?>/assets/site/img/horseShoe.svg">Stalls</p>
						<h6 class="ucprice"> from $<?php echo $data['stalls_price'] ?> / night</h6>
					</span>
					<span class="m-left w-100">
						<p><img class="eventSecondIcon" src="<?php echo base_url()?>/assets/site/img/rvSpot.svg">RV Spots</p>
						<h6 class="ucprice">from $<?php echo $data['rvspots_price'] ?> / night</h6>
					</span>
					<div class="edit">
						<a href="<?php echo base_url().'/myaccount/events/edit/'.$data['id']; ?>">Edit</a>
						<a data-id="<?php echo $data['id']; ?>" href="javascript:void(0);" class="delete">Delete</a>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	<?php echo $pager; ?>
</section>
<?php $this->endSection(); ?>

<?php $this->section('js') ?>
<script>
	var userid = '<?php echo $userid; ?>';

	$(document).on('click','.delete',function(){
		var action 	= 	'<?php echo base_url()."/myaccount/events"; ?>';
		var data   = '\
		<input type="hidden" value="'+$(this).data('id')+'" name="id">\
		<input type="hidden" value="'+userid+'" name="userid">\
		<input type="hidden" value="0" name="status">\
		';
		sweetalert2(action,data);
	});	
</script>
<?php $this->endSection(); ?>
