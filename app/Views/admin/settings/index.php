<?= $this->extend("admin/common/layout/layout2") ?>

<?php $this->section('content') ?>
	<?php
		$id 				= isset($result['id']) ? $result['id'] : '';
		$name 				= isset($result['name']) ? $result['name'] : '';
		$description 		= isset($result['description']) ? $result['description'] : '';
		$address 			= isset($result['address']) ? $result['address'] : '';
		$email 		    	= isset($result['email']) ? $result['email'] : '';
		$phone 				= isset($result['phone']) ? $result['phone'] : '';
		$facebook 		    = isset($result['facebook']) ? $result['facebook'] : '';
		$google 			= isset($result['google']) ? $result['google'] : '';
		$twitter 		    = isset($result['twitter']) ? $result['twitter'] : '';
		$instagram 		    = isset($result['instagram']) ? $result['instagram'] : '';
		$logo 		    	= isset($result['logo']) ? $result['logo'] : '';
		$logo 				= filedata($logo, base_url().'/assets/uploads/settings/');
	?>
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>About Us</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
						<li class="breadcrumb-item active">Settings</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	
	<section class="content">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Settings</h3>
			</div>
			<div class="card-body">
				<form method="post" id="form" action="<?php echo getAdminUrl(); ?>/settings" autocomplete="off">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Name</label>								
									<input type="text" name="name" class="form-control" id="name" placeholder="Enter Title" value="<?php echo $name; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Desription</label>
									<textarea class="form-control" id="description" name="description" placeholder="Enter Desription" rows="3"><?php echo $description;?></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Address</label>
									<textarea class="form-control" id="address" name="address" placeholder="Enter Address" rows="3"><?php echo $address;?></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Email</label>								
									<input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="<?php echo $email; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Phone Number</label>								
									<input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone" value="<?php echo $phone; ?>">
								</div>
							</div>	
							<div class="col-md-12">
								<div class="form-group">
									<label>Facebook</label>								
									<input type="text" name="facebook" class="form-control" id="facebook" placeholder="Enter facebook" value="<?php echo $facebook; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Google</label>								
									<input type="text" name="google" class="form-control" id="google" placeholder="Enter Google" value="<?php echo $google; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Twitter</label>								
									<input type="text" name="twitter" class="form-control" id="twitter" placeholder="Enter Twitter" value="<?php echo $twitter; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Instagram</label>								
									<input type="text" name="instagram" class="form-control" id="instagram" placeholder="Enter Instagram" value="<?php echo $instagram; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Logo</label>
									<div>
										<a href="<?php echo $logo[1];?>" target="_blank">
											<img src="<?php echo $logo[1];?>" class="logo_source" width="100">
										</a>
									</div>
									<input type="file" class="logo_file">
									<span class="logo_msg messagenotify"></span>
									<input type="hidden" id="image" name="image" class="logo_input" value="<?php echo $logo[0];?>">
								</div>
							</div>						
							<div class="col-md-12">
								<input type="hidden" name="actionid" value="1">
								<input type="submit" class="btn btn-primary" value="Submit">
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
			fileupload([".logo_file"], ['.logo_input', '.logo_source','.logo_msg']);
			
			validation(
				'#form',
				{
					title 	     : {
						required	: 	true
					},
					content  : {	
						required	: 	true
					}
				}
			);
			
		});

	</script>
<?php $this->endSection(); ?>
