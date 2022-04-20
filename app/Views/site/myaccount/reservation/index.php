<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>

<div class="dFlexComBetween eventTP flex-wrap">
	<h2 class="fw-bold mb-4">Current Reservation</h2>
	<?php if(!empty($bookings)) {  ?>
		<div class="flex-row-reverse bd-highlight"> 
			<input type="text" placeholder="Search By Name" class="searchEvent bookedby" id="bookedby" value="" />
		</div>
	<?php } ?>
</div>

<section class="maxWidth eventPagePanel">
	<?php if(!empty($bookings)) {  ?>
		<?php foreach ($bookings as $data) { ?>
			<div class="dashboard-box">
				<div class="EventFlex leftdata">
					<div class="wi-30 row w-100 align-items-center">
						<div class="row row m-0 p-0 dash-booking">
							<div class="col-md-2 mb-2">
								<div>
									<p class="mb-0 text-sm fs-7 fw-600">Booking ID</p>
									<p class="mb-0 fs-7"><?php echo $data['id'];?></p>
								</div>
							</div>
							<div class="col-md-3 mb-2">
								<div>
									<p class="mb-0 fs-7 fw-600">Booked By</p>
									<p class="mb-0 fs-7"><?php echo $usertype[$data['usertype']]; ?></p>
								</div>
							</div>
							<div class="col-md-3 mb-2">
								<div>
									<p class="mb-0 fs-7 fw-600">Date of booking</p>
									<p class="mb-0 fs-7"><?php echo date("m-d-Y h:i A", strtotime($data['created_at']));?></p>
								</div>

							</div>
						</div>
						<div class="col-md-2">
							<div>
								<p class="mb-0 text-sm fs-7 fw-600">Name</p>
								<p class="mb-0 fs-7"><?php echo $data['firstname'].$data['lastname'];?></p>
							</div>
						</div>
						<div class="col-md-3">
							<div>
								<p class="mb-0 fs-7 fw-600">Booked Event</p>
								<p class="mb-0 fs-7"><?php echo $data['eventname'];?> (
								<?php 
								$stallname = [];
								foreach ($data['barnstall'] as $stalls) {
								$stallname[] = $stalls['stallname'];
								}
								echo implode(',', $stallname);
								?>)
								</p>
							</div>
						</div>
						<div class="col-md-3">
							<div>
								<p class="mb-0 fs-7 fw-600">CheckIn - CheckOut</p>
								<p class="mb-0 fs-7"><?php echo date("m-d-Y", strtotime($data['check_in']));?> - <?php echo date("m-d-Y", strtotime($data['check_out']));?></p>
							</div>
						</div>
						<div class="col-md-3">
							<div>
								<p class="mb-0 fs-7 fw-600">Cost</p>
								<p class="mb-0 fs-7"><?php echo $data['amount'];?></p>
							</div>
						</div>
						<div class="col-md-1">
							<div class="d-flex justify-content-end">
								<a href="<?php echo base_url().'/myaccount/bookings/view/'.$data['id']; ?>" class="view-res">View</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	<?php }else{ ?>
		<p>No Reservation Found.</p>
	<?php } ?>
</section>
<?php echo $pager; ?>
<?php $this->endSection(); ?>

<?php $this->section('js') ?>
<script>
	var baseurl = "<?php echo base_url(); ?>";

	$(document).ready(function() {
	$("#bookedby").autocomplete({
	source: function(request, response) {
	ajax(baseurl+'/myaccount/bookings/searchbookeduser', {search: request.term}, {
	success: function(result) {
	response(result);
	}
	});
	},
	html: true, 
	select: function(event, ui) {
	var name = ui.item.firstname+ui.item.lastname
	$('#bookedby').val(name); 
	window.location.href = baseurl+'/myaccount/bookings/view/'+ui.item.id;
	return false;
	},
	focus: function(event, ui) {
	$("#bookedby").val(name);
	return false;
	}
	})
	.autocomplete("instance")
	._renderItem = function( ul, item ) {
	var name = item.firstname+item.lastname
	return $( "<li><div>"+name+"</div></li>" ).appendTo( ul );
	};
});
</script>
<?php $this->endSection(); ?>
