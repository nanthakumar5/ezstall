<?= $this->extend("admin/common/layout/layout2") ?>

<?php $this->section('content') ?>
	<?php
		$id 					= isset($result['id']) ? $result['id'] : '';
		$userid 				= isset($result['user_id']) ? $result['user_id'] : '';
		$name 					= isset($result['name']) ? $result['name'] : '';
		$description 		    = isset($result['description']) ? $result['description'] : '';
		$location 				= isset($result['location']) ? $result['location'] : '';
		$mobile 				= isset($result['mobile']) ? $result['mobile'] : '';
		$start_date 		    = isset($result['start_date']) ? dateformat($result['start_date']) : '';
		$end_date 				= isset($result['end_date']) ? dateformat($result['end_date']) : '';
		$start_time 			= isset($result['start_time']) ? $result['start_time'] : '';
		$end_time 			    = isset($result['end_time']) ? $result['end_time'] : '';
		$stalls_price 			= isset($result['stalls_price']) ? $result['stalls_price'] : '';
		$rvspots_price 			= isset($result['rvspots_price']) ? $result['rvspots_price'] : '';
		$image      			= isset($result['image']) ? $result['image'] : '';
		$image 				    = filedata($image, base_url().'/assets/uploads/event/');
		$status 				= isset($result['status']) ? $result['status'] : '';
		$eventflyer      		= isset($result['eventflyer']) ? $result['eventflyer'] : '';
		$eventflyer 			= filedata($eventflyer, base_url().'/assets/uploads/eventflyer/');
		$stallmap      			= isset($result['stallmap']) ? $result['stallmap'] : '';
		$stallmap 				= filedata($stallmap, base_url().'/assets/uploads/stallmap/');
		$barn        			= isset($result['barn']) ? $result['barn'] : [];
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
					<?php 
						$tabbtn = '';
						$tabcontent = '';
						foreach ($barn as $barnkey => $barndata) {
							$barnid = $barndata['id'];
							$barnname = $barndata['name'];
							$barnactive = $barnkey=='0' ? ' show active' : '';
							$tabbtn .= '<li class="nav-item"><a class="nav-link'.$barnactive.'" data-toggle="tab" href="#barn'.$barnid.'">'.$barnname.'</a></li>';
							
							$tabcontent .= '<div class="tab-pane container'.$barnactive.'" id="barn'.$barnid.'">
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
					<ul class="nav nav-tabs"><?php echo $tabbtn; ?></ul>
					<div class="tab-content"><?php echo $tabcontent; ?></div>
			</div>
		</div>
	</section>
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

