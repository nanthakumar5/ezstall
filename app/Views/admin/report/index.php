<?= $this->extend("admin/common/layout/layout2") ?>

<?php $this->section('content') ?>
<?php //echo "<pre>"; print_r($event);die;?>
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Event Report</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
						<li class="breadcrumb-item active">Event Report</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	
	<section class="content">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Event Report</h3>
			</div>
			<div class="card-body">
				<form method="post" id="form">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12 my-2">
						  		<div class="form-group">

							       <label>Facility Users</label>
								    <select class="form-select exportevent" id="export" aria-label="Default select example">
	  									<option selected>Select Export Event</option>
	  									<option value="all">All Event</option>
	  									<?php foreach ($event  as $export) {
	  										echo '<option value="'.$export['id'].'">'.$export['name'].'</option>';
	  									}?>
	  								</select>
								</div>
							</div>
							<div class="col-md-12 exportup">
								<a class="btn btn-primary element" href="#">Export</a>
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
			$('.exportevent').change(function(){ 
				var id = $( "#export" ).val();
				$('.element').attr('href', '<?php echo getAdminUrl();?>/exportevent/'+id);
			});			
		});
	</script>
<?php $this->endSection(); ?>
