<?= $this->extend("admin/common/layout/layout2") ?>

<?php $this->section('content') ?>
	<?php
	
		$barnvalue        =  isset($barnvalue) ? array_filter($barnvalue) : [];
		$name              = isset($barnvalue[0]['name']) ? ucfirst($barnvalue[0]['name']) : 'Event';
		$start_date        = isset($barnvalue[0]['start_date']) ? date('d M Y', strtotime($barnvalue[0]['start_date'])) : '';
		$end_date          = isset($barnvalue[0]['end_date']) ? date('d M Y', strtotime($barnvalue[0]['end_date'])) : '';
		$start_time        = isset($barnvalue[0]['start_time']) ? date("g:i a", strtotime($barnvalue[0]['start_time'])) : '';
		$end_time          = isset($barnvalue[0]['end_time']) ? date("g:i a", strtotime($barnvalue[0]['end_time'])) : '';
		$image      	   = isset($barnvalue[0]['image']) ? $barnvalue[0]['image'] : '';
		$image 			   = filedata($image, base_url().'/assets/uploads/event/');
			
		if(count($barnvalue) > 0 && isset($barnvalue[0]['barnid_stallid']) && $barnvalue[0]['barnid_stallid']!='@-@' ) : 
	?>
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>View Event</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right"> 
						<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
						<li class="breadcrumb-item"><a href="<?php echo getAdminUrl(); ?>/view">View</a></li>
						<li class="breadcrumb-item active">View Event</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	
	<section class="content">
		<div class="page-action">
			<a href="<?php echo getAdminUrl(); ?>/event" class="btn btn-primary">Back</a>
		</div>
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"> Event Details </h3>
			</div>
			<div class="card-body">
			    <h3 class="event_heading"> <?php echo $name;?> </h3>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<img class='img-fluid w-100' src="<?php echo $image[1];?>" alt="Event Image" />
						</div>
					</div>
				    <div class="row ">
						<div class="col-6">
							<div class="barn-text borderright">
								<div class="col">
									<strong> <i class='far fa-calendar'></i> Start Date</strong> 
									<p class="card-text"><?php echo $start_date; ?></p> 
								</div>
								<div class="col">
									<strong> <i class='far fa-calendar'></i> End Date </strong> 
									<p class="card-text"><?php echo $end_date; ?></p>
								</div> 
							</div>
						</div>
						<div class="col-6">
						  <div class="barn-text">
						    <div class="col"> 
								<strong> <i class='far fa-clock'></i> Start Time: </strong> 
								<p class="card-text">after <?php echo $start_time; ?></p>    
							</div>
							<div class="col">
								<strong> <i class='far fa-clock'></i> End Time :  </strong> 
								<p class="card-text">by <?php echo $end_time; ?></p>
						   </div>
						</div>
				    </div>
				</div>
				<h3 class="event_heading"> Barn and stalls </h3>
				<div class="row">
					<div class="col-md-12">
						<div class="card card-primary card-outline card-tabs">
						    <div class="card-header p-0 pt-1 border-bottom-0">
							    <ul class="nav nav-tabs" id="custom-tabs-tab" role="tablist">
									<?php 
									    
										$stalldata=[]; 
										foreach($barnvalue as $barns){
											$barnexplode=explode('^',$barns['barnid_stallid']);
											foreach($barnexplode as $be1){
												$barnexplode2=explode('@-@',$be1);	
												$barnId=isset($barnexplode2[0]) ? $barnexplode2[0] : '';
												$barnname=isset($barnexplode2[1]) ? $barnexplode2[1] : ''; 
												$stalldata[$barnname]=isset($barnexplode2[2]) ? $barnexplode2[2] : '';
												?>
												<li class="nav-item">
													<a class="nav-link barntab" data-barnid="<?php echo $barnId; ?>" data-barn="<?php echo $barnname;?>" id="custom-tabs-<?php echo $barnname;?>-tab" data-toggle="pill" href="#custom-tabs-<?php echo $barnname;?>" role="tab" aria-controls="custom-tabs-<?php echo $barnname;?>" aria-selected="true"><?php echo $barnname;?></a>
												</li>
												<?php
											}
										}
									?>
							    </ul>
						  </div>
						  <div class="card-body">
							<div class="tab-content" id="custom-tabs-tabContent">
								<?php 
								    $barnname='';
								    foreach($stalldata as $key=>$stall){
										$barnname=$key;
										$stallexplode = array_filter(explode(',', $stall));
										foreach($stallexplode as $se1){
											$stallexplode2   = explode('@@', $se1);
											$stallId         = isset($stallexplode2[0]) ? $stallexplode2[0] : '';
											$stallname       = isset($stallexplode2[1]) ? ucfirst($stallexplode2[1]) : '';
											$stallprice    	 = isset($stallexplode2[2]) ? $stallexplode2[2] : '';
											$stallstatues  	 = isset($stallexplode2[3]) ? $stallexplode2[3] : '';
											$stallstatusname = (isset($stallstatues) && $stallstatues==0) ? '' : $stallstatus[$stallstatues];
										    $display         = (isset($stallstatues) && $stallstatues==0) ? 'displaynone' : '' ;
							    ?>
								<div class="tab-pane fade <?php echo $barnname;?>"  id="custom-tabs-<?php echo $barnname;?>" role="tabpanel" aria-labelledby="custom-tabs-<?php echo $barnname;?>-tab">
									<div class="callout callout-info <?php echo $display;?>">
									    <div class="row">
											<div class="col-md-6">
											    <div class="container">
												    <div class="row">
														<div class="col-sm">
														  <h5><strong> <?php echo $stallname;?> </strong></h5>
														  <strong>Price </strong> 
														  <p class="card-text">$<?php echo $stallprice;?></p>
														  <strong>Status: </strong> 
												        	<div class='box <?php $color='green';if($stallstatues!=0 && $stallstatues==2){ $color='red';} echo $color;?>' data-toggle="tooltip" title="<?php echo $stallstatusname;?>"><?php echo $stallstatusname;?></div>
														</div>
												    </div>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php   }
									}  ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		
    <?php else : ?>
	
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>View Event</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right"> 
						<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
						<li class="breadcrumb-item"><a href="<?php echo getAdminUrl(); ?>/view">View</a></li>
						<li class="breadcrumb-item active">View Event</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	
	<section class="content">
		<div class="page-action">
			<a href="<?php echo getAdminUrl(); ?>/event" class="btn btn-primary">Back</a>
		</div>
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"> Event Details </h3>
			</div>
			<div class="card-body">
			    <h3 class="event_heading"> <?php echo $name;?> </h3>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<img class='img-fluid w-100' src="<?php echo $image[1];?>" alt="Event Image" />
						</div>
					</div>
				    <div class="row ">
						<div class="col-6">
							<div class="barn-text borderright">
								<div class="col">
									<strong> <i class='far fa-calendar'></i> Start Date</strong> 
									<p class="card-text"><?php echo $start_date; ?></p> 
								</div>
								<div class="col">
									<strong> <i class='far fa-calendar'></i> End Date </strong> 
									<p class="card-text"><?php echo $end_date; ?></p>
								</div> 
							</div>
						</div>
						<div class="col-6">
						  <div class="barn-text">
						    <div class="col"> 
								<strong> <i class='far fa-clock'></i> Start Time: </strong> 
								<p class="card-text">after <?php echo $start_time; ?></p>    
							</div>
							<div class="col">
								<strong> <i class='far fa-clock'></i> End Time :  </strong> 
								<p class="card-text">by <?php echo $end_time; ?></p>
						   </div>
						</div>
				    </div>
				</div>
			</div>
			<h3 class="event_heading"> Barn and stalls </h3>
			    <div class="row">
					<div class="alert alert-danger alert-dismissible alert-msg">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					   No Record Found.
					</div>
				</div>
			</div>
		</div>
	</section>   

    <?php endif; ?>  	

<?php $this->endSection(); ?>

<?php $this->section('js') ?>
	<script>
		
		$(function(){
			var initialtab=$(".barntab").first().attr('data-barn');
			$(".barntab").first().addClass('active');
			$('.'+initialtab).addClass("active show");
			
			$(".barntab").click(function () {
				var tab=$(this).attr('data-barn');
				$(".barntab").removeClass("active");
				$(".tab-pane").removeClass("active");
				$(".barntab").attr('aria-selected',false);
				$(this).addClass("active");  
				$('.'+tab).addClass("active show");
				$(this).attr('aria-selected',true);			
			});
		});		
	</script>
<?php $this->endSection(); ?>

