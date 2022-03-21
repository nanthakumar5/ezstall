<?= $this->extend("admin/common/layout/layout2") ?>

<?php $this->section('content') ?>
	<?php
		$id 					= isset($result['id']) ? $result['id'] : '';
		$userid 				= isset($result['user_id']) ? $result['user_id'] : '';
		$name 					= isset($result['name']) ? $result['name'] : '';
		$price 		    		= isset($result['price']) ? $result['price'] : '';
		$interval 		    	= isset($result['interval']) ? $result['interval'] : '';
		$interval_count 		= isset($result['interval_count']) ? $result['interval_count'] : '';
		$pageaction 			= $id=='' ? 'Add' : 'Update';
	?>
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Plans</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
						<li class="breadcrumb-item"><a href="<?php echo getAdminUrl(); ?>/plan">Plans</a></li>
						<li class="breadcrumb-item active"><?php echo $pageaction; ?> Plans</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	
	<section class="content">
		<div class="page-action">
			<a href="<?php echo getAdminUrl(); ?>/plan" class="btn btn-primary">Back</a>
		</div>
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"><?php echo $pageaction; ?> Plans</h3>
			</div>
			<div class="card-body">
				<form method="post" id="form" action="<?php echo getAdminUrl(); ?>/plan/action" autocomplete="off">
					<div class="col-md-12">
						<div class="row">
							
							<div class="col-md-12">
								<div class="form-group">
									<label>Name</label>								
									<input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="<?php echo $name; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Price</label>								
									<input type="text" name="price" class="form-control" id="name" placeholder="Enter Price" value="<?php echo $price; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Interval</label>								
									<input type="text" name="interval" class="form-control" id="name" placeholder="Enter Interval" value="<?php echo $interval; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Interval Count</label>								
									<input type="text" name="interval_count" class="form-control" id="name" placeholder="Enter Interval Count" value="<?php echo $interval_count; ?>">
								</div>
							</div>
							
                            <div class="col-md-12" id="barnwrapper"></div>							
							<div class="col-md-12">
								<input type="hidden" name="actionid" value="<?php echo $id; ?>">
								<input type="submit" class="btn btn-primary" value="Submit">
								<a href="<?php echo getAdminUrl(); ?>/plan" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
<?php $this->endSection(); ?>

<?php $this->section('js') ?>
	<script>		
		$(function(){
			validation(
				'#form',
				{
					name 	     : {
						required	: 	true
					},
					price  : {	
						required	: 	true
					}
					interval  : {	
						required	: 	true
					}
					interval_count  : {	
						required	: 	true
					}
				}
			);
			
		});

	</script>
<?php $this->endSection(); ?>
