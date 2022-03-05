<?= $this->extend("site/common/layout/layout1") ?>

<?php $this->section('content') ?>
	<section class="maxWidth">
		<div class="pageInfo">
		  <span class="marFive">
			<a href="/">Home /</a>
			<a href="/Events"> Events</a>
		  </span>
		</div>

		<div class="marFive dFlexComBetween eventTP">
		  <h1 class="eventPageTitle">Events</h1>
		  <span class="mar0">
			<input
			  type="text"
			  placeholder="Find your event"
			  class="searchEvent"
			  id="searchevent"
			  value="<?php echo $search; ?>"
			/>
			<svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="eventSearch" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M456.69 421.39L362.6 327.3a173.81 173.81 0 0034.84-104.58C397.44 126.38 319.06 48 222.72 48S48 126.38 48 222.72s78.38 174.72 174.72 174.72A173.81 173.81 0 00327.3 362.6l94.09 94.09a25 25 0 0035.3-35.3zM97.92 222.72a124.8 124.8 0 11124.8 124.8 124.95 124.95 0 01-124.8-124.8z"></path></svg>
		  </span>
		</div>
		<section class="maxWidth marFiveRes eventPagePanel">
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
							<button class="ucEventBtn">Book Now</button>
						</div>
					</div>
				</div>
            <?php } ?>
			<?php echo $pager; ?>
		</section>
	</section>
<?php $this->endSection(); ?>

<?php $this->section('js') ?>
	<script>
		$('#searchevent').keypress(function (e) {
			if($(this).val()!='' && e.which == 13){
				window.location.href = '<?php echo base_url(); ?>/events?q='+$(this).val();
			}
		});
	</script>
<?php $this->endSection(); ?>

