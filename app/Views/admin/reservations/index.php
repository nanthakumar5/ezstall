<?= $this->extend("admin/common/layout/layout2") ?>
	<?php $this->section('content') ?>
		<section class="content-header">		
			<div class="container-fluid">			
				<div class="row mb-2">				
					<div class="col-sm-6">					
						<h1>Reservations</h1>				
					</div>				
					<div class="col-sm-6">					
						<ol class="breadcrumb float-sm-right">						
							<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
							<li class="breadcrumb-item active">Reservations</li>
						</ol>				
					</div>			
				</div>
			</div>
		</section>
		<section class="content">
			<div class="card">			
				<div class="card-header">
					<h3 class="card-title">Reservations</h3>
				</div>
				<div class="card-body">	
					<table class="table table-striped table-hover datatables">
						<thead>
							<th>Firstname</th>
							<th>Lastname</th>
							<th>Mobile</th>	
							<th>Action</th>
						</thead>
					</table>
				</div>
			</div>
		</section>

<?php $this->endSection(); ?>
<?php $this->section('js') ?>
	<script>
		$(function(){
			var options = {	
				url 		: 	'<?php echo getAdminUrl()."/reservations/DTreservations"; ?>',	
				data		:	{ 'page' : 'adminreservations' },				
				columns 	: 	[
    				                { 'data' : 'firstname' },
                    				{ 'data' : 'lastname' },
                    				{ 'data' : 'mobile' },					
                    				{ 'data' : 'action' }								
                				],
				columndefs	:	[{"sortable": false, "targets": [3]}]											
			};				
			
			ajaxdatatables('.datatables', options);		
		});
	</script>
<?php $this->endSection(); ?>

