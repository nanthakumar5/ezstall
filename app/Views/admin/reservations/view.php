<?= $this->extend("admin/common/layout/layout2") ?>

<?php $this->section('content') ?>
	<?php
		$id 					    = isset($result['id']) ? $result['id'] : '';
		$firstname 					= isset($result['firstname']) ? $result['firstname'] : '';
		$lastname 					= isset($result['lastname']) ? $result['lastname'] : '';
		$mobile 					= isset($result['mobile']) ? $result['mobile'] : '';
		$eventname 					= isset($result['eventname']) ? $result['eventname'] : '';
		$stall 					    = isset($result['stall']) ? $result['stall'] : '';
		$stalls                     = implode(',', $stall);
		$checkin 					= isset($result['check_in']) ? $result['check_in'] : '';
		$checkin                    = date("d-m-Y", strtotime($checkin));
		$checkout 					= isset($result['check_out']) ? $result['check_out'] : '';
		$checkout                    = date("d-m-Y", strtotime($checkout));

	?>
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Reservations</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
						<li class="breadcrumb-item"><a href="<?php echo getAdminUrl(); ?>/reservations">Reservations</a></li>
						<li class="breadcrumb-item active">View Reservations</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	
	<section class="content">
		<div class="page-action">
			<a href="<?php echo getAdminUrl(); ?>/reservations" class="btn btn-primary">Back</a>
		</div>
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">View Reservations</h3>
			</div>
			<div class="card-body">
				<table class="table">
				  <tbody>
				    <tr>
				      <th>First Name</th>
				      <td><?php echo $firstname;?></td>
				    </tr>
				    <tr>
				      <th>Last Name</th>
				      <td><?php echo $lastname;?></td>
					</tr>
					<tr>
						<th>Mobile</th>
						<td><?php echo $mobile;?></td>
					</tr>
					<tr>
						<th>Event Name</th>
						<td><?php echo $eventname;?></td>
					</tr>
					<tr>
						<th>Stall Name</th>
						<td><?php echo $stalls;?></td>
					</tr>
					<tr>
						<th>Check In</th>
						<td><?php echo $checkin;?></td>
					</tr>
					<tr>
						<th>Check Out</th>
						<td><?php echo $checkout;?></td>
					</tr>
				  </tbody>
				</table>
			</div>
		</div>
	</section>
<?php $this->endSection(); ?>