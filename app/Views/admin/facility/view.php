<?= $this->extend("admin/common/layout/layout2") ?>

<?php $this->section('content') ?>
	<?php
		$id 					= isset($result['id']) ? $result['id'] : '';
		$userid 				= isset($result['user_id']) ? $result['user_id'] : '';
		$name 					= isset($result['name']) ? $result['name'] : '';
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
						<li class="breadcrumb-item active">View Facility</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	
	<section class="content">
		<div class="page-action">
			<a href="<?php echo getAdminUrl(); ?>/facility" class="btn btn-primary">Back</a>
		</div>
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"> Facility Details </h3>
			</div>
			<div class="card-body">
			    <h3 class="event_heading"> <?php echo $name;?> </h3>
				<div class="container">
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
