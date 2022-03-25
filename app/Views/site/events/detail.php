<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<section class="maxWidth">
	<div class="pageInfo">
	  <span class="marFive">
		<a href="<?php echo base_url(); ?>">Home /</a>
		<a href="<?php echo base_url().'/events'; ?>"> Events /</a>
		<a href="javascript:void(0);"><?php echo $detail['name'] ?></a>
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
								<?php echo $detail['location'] ?>
							</li>
							<li class="mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar4" viewBox="0 0 16 16">
							<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1H2zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V5z"/>
							</svg> 
								<?php echo date('d-m-Y', strtotime($detail['start_date'])); ?>
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
						<p class="ucDAte mb-0">
							<?php  echo date("d-m-Y", strtotime($detail['start_date']));?></p>
					</span>
					<span class="col-3 border-end">
						<p class="mb-1 fw-bold"><img class="eventDIcon" src="<?php echo base_url() ?>/assets/site/img/date.png"> End Date: </p>
						<p class="ucDAte mb-0"><?php echo date("d-m-Y", strtotime($detail['end_date'])); ?></p>
					</span>
					<span class="col-3">
						<p class="mb-1 fw-bold"><img class="eventDIcon" src="<?php echo base_url() ?>/assets/site/img/time.png"> Start Time: </p>
						<p class="ucDAte mb-0"> after <?php echo $detail['start_time'] ?></p>
					</span>
					<span class="col-3">
						<p class="mb-1 fw-bold"><img class="eventDIcon" src="<?php echo base_url() ?>/assets/site/img/time.png"> End Time:</p>
						<p class="ucDAte mb-0">by <?php echo $detail['end_time'] ?></p>
					</span>
				</div> 
			</div>
			<div class="border rounded pt-4 ps-3 pe-3 mt-4 mb-5">
				<h3 class="fw-bold mb-4">Book Your Stalls</h3>
				<div class="infoPanel form_check">
					<span class="infoSection">
						<span class="iconProperty">
							<input type="text" readonly id="stallcount"  value="" placeholder="Number of Stalls">
							<span class="num_btn stallcount"><button>+</button><br><button>-</button></span>
						</span>
						<span class="iconProperty">
							<input type="date" name="startdate" id="startdate" class="checkdate checkin" placeholder="Check-In">
						</span>
						<span class="iconProperty">
							<input type="date" name="enddate" id="enddate" class="checkdate checkout" placeholder="Check-Out">
						</span>
					</span>
					<input type="hidden" name="datecount" id="datecount">
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
							$boxcolor  = 'green-box';
							$checkboxstatus = '';
							if(in_array($stalldata['id'], $occupied)){
								$boxcolor  = 'red-box';
								$checkboxstatus = 'disabled checked';
							}
							
							$tabcontent .= 	'<li class="list-group-item">
							<input class="form-check-input stallid me-1" data-price="'.$stalldata['price'].'" data-eventid="'.$detail['id'].'" data-barnid="'.$stalldata['barn_id'].'" value="'.$stalldata['id'].'" name="checkbox"  type="checkbox" '.$checkboxstatus.'>
							'.$stalldata['name'].'
							<span class="'.$boxcolor.' stallavailability" data-stallid="'.$stalldata['id'].'" ></span>
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
		<div class="checkout col-3">
	</div>
</section>
<?php $this->endSection() ?>
<?php $this->section('js') ?>
<script> 
	 $(document).ready(function (){
	 	cart();
	});

	function checkdate(){
		var startdate 	= $("#startdate").val(); 
		var enddate   	= $("#enddate").val(); 
		
		if($(".form-check-input:checked").length > 0){			
			if(startdate=='' || enddate==''){
				if(startdate=='') $("#startdate").focus();
				else if(enddate=='') $("#enddate").focus();

				$(".form-check-input").prop('checked', false);
				return false;
			}

			$(".checkin").attr('readonly', 'readonly');
			$(".checkout").attr('readonly', 'readonly');
		}else{
			$(".checkin").removeAttr('readonly', 'readonly');
			$(".checkout").removeAttr('readonly', 'readonly');
		}
	}

	$(".form-check-input").on("click", function() {
		checkdate();

		var startdate 	= $("#startdate").val(); 
		var enddate   	= $("#enddate").val(); 
		var stall_id	= $(this).val(); 
		var event_id    = $(this).attr('data-eventid');
		var barn_id    = $(this).attr('data-barnid');
		var price 		= $(this).attr('data-price');

		dateformat('#start_date, #end_date');

		if($(this).is(':checked')){
			cart({stall_id : stall_id, event_id : event_id, barn_id : barn_id, price : price, startdate : startdate, enddate : enddate, checked : 1});
		}else{
			cart({stall_id : stall_id, checked : 0}); 
		}
	});

	function cart(data={cart:1}){	 	
	    ajax(
		    '<?php echo base_url()."/cart"; ?>',
	        data,
	    	{ 
	    		success  : function(result){
	    			checkdate();

	    			if(result){  
	    				$("#startdate").val(result.check_in); 
						$("#enddate").val(result.check_out); 

		    			$('#stallcount').val(result.barnstall.length);  
			      		$(result.barnstall).each(function(i,v){ 
							$('.stallid[value='+v.stall_id+']').prop('checked', true);
							$('.stallavailability[data-stallid='+v.stall_id+']').removeClass("green-box").addClass("yellow-box");
						});

						var total = (result.price+8.50);
	        		    $('#stallcount').val(result.barnstall.length);
	            		var result ='\
	                        <div class="w-100">\
	                            <div class="border rounded pt-4 ps-3 pe-3 mb-5">\
	                                <div class="row mb-2">\
	                                    <div class="col-8 ">\
	                                        <span>'+result.barnstall.length+'</span> Stalls x \
	                                        <span>'+result.interval+'</span> Nights \
	                                    </div>\
	                                    <div class="col-4">\
	                                        $'+result.price+'\
	                                    </div>\
	                                </div>\
	                                <div class="row mb-2">\
	                                    <div class="col-8 ">\
	                                       Transaction Fees\
	                                    </div>\
	                                    <div class="col-4">\
	                                        $8.50\
	                                    </div>\
	                                </div>\
	                                <div class="row mb-2 border-top mt-3 mb-3 pt-3">\
	                                    <div class="col-8 fw-bold ">\
	                                       Total Due\
	                                    </div>\
	                                    <div class="col-4 fw-bold">\
	                                        $'+total+'\
	                                    </div>\
	                               </div>\
	                               <a href="<?php echo base_url()?>/checkout" class="ucEventdetBtn ps-3 mb-3 ">Continue to Checkout</a>\
	                            </div>\
	                        </div>\
	                    ';

	                    $('.checkout').empty().append(result);
                    }
		        }
	        }
		);
	}
</script>
<?php echo $this->endSection() ?>