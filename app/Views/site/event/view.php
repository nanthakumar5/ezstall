<?php $this->extend('site/common/layout/layout1') ?>

<?php $this->section('content') ?>
<?php
		$id 					= isset($result['id']) ? $result['id'] : '';
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
		$status 				= isset($result['status']) ? $result['status'] : '';
		$eventflyer      		= isset($result['eventflyer']) ? $result['eventflyer'] : '';
		$eventflyer 			= filedata($eventflyer, base_url().'/assets/uploads/eventflyer/');
		$stallmap      			= isset($result['stallmap']) ? $result['stallmap'] : '';
		$stallmap 				= filedata($stallmap, base_url().'/assets/uploads/stallmap/');
		$pageaction 			= $id=='' ? 'Add' : 'Update';
		
		$barnstallvalue        =  (isset($barnstallvalue[0]['barnid_stallid']) && $barnstallvalue[0]['barnid_stallid']!="@-@") ? 
		                           array_filter($barnstallvalue) : [];
		$stallvalue            =  array();

		$file   = $image;
		$file 				    = filedata($image, base_url().'/assets/uploads/event/');
		if($file[0]!=''){
		$mediafile  = base_url().'/assets/uploads/event/'.$file[0];

		}else{
		$mediafile = $file[1];
		}
		
		if($eventflyer[0]!=''){
		$eventflyerfile  = base_url().'/assets/uploads/eventflyer/'.$eventflyer[0];

		}else{
		$eventflyerfile = $file[1];
		}

?>
<div class="container-fluid">
	<div class="cont-sec">
		<div class="inner-section row" >
			
			<div class="col-sm-12 col-md-9 col-lg-9 right-conten-section my-5">
				<form method="post" id="form" action="#" autocomplete="off">
					
						<h1>Event Details</h1><hr>
							<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label><b>Name </b> : </label>								
										<?php echo ucfirst($name); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label><b>Event Description</b> : </label>
										<?php echo ucfirst($description);?>
									</div>
								</div>
							</div><!--row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label><b>Localtion </b> : </label>								
										<?php echo ucfirst($location); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label><b>Mobile</b> : </label>
										<?php echo $mobile;?>
									</div>
								</div>
							</div><!--row-->
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label><b>Event start date & time </b> : </label>								
										<?php echo date('M d, Y', strtotime($start_date)). '-' .date('M d, Y', strtotime($end_date)); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label><b></b> : </label>
										<?php echo $mobile;?>
									</div>
								</div>
							</div><!--row-->


					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $this->endSection(); ?>
<?php $this->section('js') ?>

<?php echo $this->endSection() ?>