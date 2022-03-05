<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<section class="maxWidth">
	<div class="pageInfo">
	  <span class="marFive">
		<a href="/">Home /</a>
		<a href="/Events"> Checkout /</a>
		<a href="/Events"> Nemo enim ipsam voluptatem quia</a>
	  </span>
	</div>

	<div class="marFive dFlexComBetween eventTP pb-3 pt-4">
		<div class="pageInfo m-0 bg-transparent">
			<span class="eventHead">
				<a href="<?php echo base_url().'/events'; ?>" class="d-block"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
					<path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
				  </svg> Back To All Events</a>
			</span>
		</div>
	</div>
</section>

<section class="container-lg">
	<div class="row">
		<div class="col-8">
			<div class="border rounded pt-5 ps-3 pe-3">
				<div class="row">
					<div class="col-6">
						<span class="edimg">
							<img src="<?php echo base_url() ?>/assets/uploads/event/<?php echo $detail['image']?>" width="350px" height="auto">
						</span>
					</div>
					<div class="col-6">
					<h4 class="checkout-fw-6"><?php echo $detail['name'] ?></h4>
						<ul class="edaddr">
							<li class="mb-3 mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
							<path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
							</svg> 
								<?php echo $detail['location'] ?> <!-- - <a href="">Download Stall Map</a> -->
							</li>
							<li class="mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar4" viewBox="0 0 16 16">
							<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1H2zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5z"/>
							</svg> 
								<?php echo $detail['start_date'] ?>
							</li>
							<li class="mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
							</svg> 
								<?php echo $detail['mobile'] ?>
							</li>
							<div class="row">
								<span class="col-6">
									<p class="mb-1 fw-bold"><img class="eventFirstIcon" src="<?php echo base_url()?>/assets/site/img/stall.jpg">Stalls</p>
									<h6 class="ucprice"> from $<?php echo $detail['stalls_price'] ?> / night</h6>
								</span>
								<span class="col-6">
									<p class="mb-1 fw-bold"><img class="eventSecondIcon" src="<?php echo base_url()?>/assets/site/img/rv.jpg">RV Spots</p>
									<h6 class="ucprice">from $<?php echo $detail['rvspots_price'] ?> / night</h6>
								</span>
							</div>
						</ul>
					</div>
					<div class="col-12 mb-5 mt-2">
						<p>Contact the stall manager at <?php echo $detail['mobile'] ?> for more information and stall maps.</p>
						<button class="ucEventdetBtn"><img src="<?php echo base_url() ?>/assets/site/img/flyer.png"> Dowload Event Flyer</button>
					</div>
				</div>
				<div class="row row border-top pt-4 pb-4">
					<span class="col-3">
						<p class="mb-1 fw-bold"><img class="eventDIcon" src="<?php echo base_url() ?>/assets/site/img/date.png"> Start Date: </p>
						<p class="ucDAte mb-0"><?php echo $detail['start_date'] ?></p>
					</span>
					<span class="col-3 border-end">
						<p class="mb-1 fw-bold"><img class="eventDIcon" src="<?php echo base_url() ?>/assets/site/img/date.png"> End Date: </p>
						<p class="ucDAte mb-0"><?php echo $detail['end_date'] ?></p>
					</span>
					<span class="col-3">
						<p class="mb-1 fw-bold"><img class="eventDIcon" src="<?php echo base_url() ?>/assets/site/img/time.png"> Start Time: </p>
						<p class="ucDAte mb-0"> after <?php echo $detail['start_time'] ?> am</p>
					</span>
					<span class="col-3">
						<p class="mb-1 fw-bold"><img class="eventDIcon" src="<?php echo base_url() ?>/assets/site/img/time.png"> End Time:</p>
						<p class="ucDAte mb-0">by <?php echo $detail['end_time'] ?> pm </p>
					</span>
				</div> 
			</div>
			<div class="border rounded pt-4 ps-3 pe-3 mt-4 mb-5">
				<h3 class="fw-bold mb-4">Book Your Stalls</h3>
				<div class="infoPanel form_check">
					<span class="infoSection">
						<span class="iconProperty">
							<input type="text" placeholder="Number of Stalls">
							<span class="num_btn"><button>+</button><br><button>-</button></span>
						</span>
						<span class="iconProperty">
							<input type="text" placeholder="Check-In">
							<img src="<?php echo base_url()?>/assets/site/img/calendar.png" class="iconPlace" alt="Calendar Icon">
						</span>
						<span class="iconProperty">
							<input type="text" placeholder="Check-Out">
							<img src="<?php echo base_url()?>/assets/site/img/calendar.png" class="iconPlace" alt="Calendar Icon">
						</span>
					</span>
				</div>

				<?php 
					$tabbtn = '';
					$tabcontent = '';
					foreach ($detail['barn'] as $barnkey => $barndata) {
						$barnid = $barndata['id'];
						$barnname = $barndata['name'];
						$barnactive = $barnkey=='0' ? ' show active' : '';
						$tabbtn .= '<button class="nav-link'.$barnactive.'" data-bs-toggle="tab" data-bs-target="#barn'.$barnid.'" type="button" role="tab" aria-controls="barn'.$barnid.'" aria-selected="true">'.$barnname.'</button>';
					
						$tabcontent .= '<div class="tab-pane fade'.$barnactive.'" id="barn'.$barnid.'" role="tabpanel" aria-labelledby="nav-home-tab">
											<ul class="list-group">';
						foreach($barndata['stall'] as $stalldata){
								$tabcontent .= 	'<li class="list-group-item">
													<input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
													'.$stalldata['name'].'
													<span class="red-box"></span>
												</li>';
						}
						
						$tabcontent .= '</ul></div>';
					}
				?>
				<div class="barn-nav mt-4">
					<nav>
						<div class="nav nav-tabs mb-4" id="nav-tab" role="tablist">
							<?php echo $tabbtn; ?>
						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<?php echo $tabcontent; ?>
						<div class="row">
							<div class="btm-color">
								<p><span class="green-circle"></span>Available</p>
								<p><span class="yellow-circle"></span>Reserved</p>
								<p><span class="red-circle"></span>Occupied</p>
							</div>
						</div>
					</div>    
				</div>
			</div> 
		</div>
		<div class="col-3">
			<div class="border rounded pt-4 ps-3 pe-3 mb-5">
		   <div class="row mb-2">
			<div class="col-8 ">
				   4 Stalls x 4 Nights
			   </div>
			   <div class="col-4">
					$120.00
			   </div>
		   </div> 
		   <div class="row mb-2">
			<div class="col-8 ">
				   Transaction Fees
			   </div>
			   <div class="col-4">
					$8.50
			   </div>
		   </div> 
		   <div class="row mb-2 border-top mt-3 mb-3 pt-3">
			<div class="col-8 fw-bold ">
				   Total Due
			   </div>
			   <div class="col-4 fw-bold">
					$128.50
			   </div>
		   </div>
		   <button class="ucEventdetBtn ps-3 mb-3 ">Continue to Checkout</button> 
		   </div>
		</div>
	</div>
</section>

<?php $this->endSection() ?>