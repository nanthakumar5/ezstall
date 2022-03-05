<?php $this->extend('site/common/layout/layout1') ?>

<?php $this->section('content') ?>
	<section class="maxWidth marFiveRes eventPagePanel">
		<a href="<?php echo base_url().'/myaccount/events/add'; ?>">Add Event</a>
		 <?php foreach ($list as $data) {  ?>
			<div class="ucEventInfo">
				<div class="EventFlex">
					<span class="wi-50">
						<div class="EventFlex leftdata">
							<span class="wi-30">
								<span class="ucimg">
									<img src="<?php echo base_url() ?>/assets/uploads/event/<?php echo $data['image']?>">
								</span>
							</span>
							<span class="wi-70">
								<p class="topdate"> <?php echo $data['start_date']; ?> - <?php echo $data['end_date']; ?> -  <?php echo $data['location']; ?></p>
								<a href="<?php echo base_url() ?>/events/detail/<?php echo $data['id']?>"><h5><?php echo $data['name']; ?><h5></a></h5>
							</span>
						</div>
					</span>
					<div class="wi-50-2">
						<span class="m-left">
							<p><img class="eventFirstIcon" src="<?php echo base_url()?>/assets/site/img/horseShoe.svg">Stalls</p>
							<h6 class="ucprice"> from $<?php echo $data['stalls_price'] ?> / night</h6>
						</span>
						<span class="m-left">
							<p><img class="eventSecondIcon" src="<?php echo base_url()?>/assets/site/img/rvSpot.svg">RV Spots</p>
							<h6 class="ucprice">from $<?php echo $data['rvspots_price'] ?> / night</h6>
						</span>
						<a href="<?php echo base_url().'/myaccount/events/edit/'.$data['id']; ?>">Edit</a>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php echo $pager; ?>
	</section>
<?php $this->endSection(); ?>