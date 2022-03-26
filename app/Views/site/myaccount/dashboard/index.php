<?php $this->extend('site/common/layout/layout1') ?>

<?php $this->section('content') ?>

<?php 
$userdetail = getSiteUserDetails();
$name = $userdetail['name'];
?>

<div class="welcome-content mb-5">
	<h3 class="fw-bold d-flex flex-wrap">Welcome to EZStall, <p class="welcome-user"><?php echo $name; ?></p></h3>
	<p class="c-5">
		We've glad you've decided to join us a EZStall Producer.
	</p>
	<div class="col-md-12 mt-4 p-4 bg-white rounded-sm">
		<h5 class="font-w-600">Current Reservation</h5>
		<div class="row mt-4 first">
			<div class="col-md-4 mb-3">
				<div class="card">
					<div class="row mt-4 p-3">
						<div class="col-md-3">
							<img src="<?php echo base_url()?>/assets/site/img/stall.png" class="rounded mx-auto d-block" />
						</div>
						<div class="col-md-9">
							<h2>50</h2>
							<p>Total no of. Stalls</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="card">
					<div class="row mt-4 p-3">
						<div class="col-md-3">
							<img
							src="<?php echo base_url()?>/assets/site/img/currently_available.png"
							class="rounded mx-auto d-block"
							/>
						</div>
						<div class="col-md-9">
							<h2>12</h2>
							<p>Currently Available</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="card">
					<div class="row mt-4 p-3">
						<div class="col-md-3">
							<img
							src="<?php echo base_url()?>/assets/site/img/currently_booked.png"
							class="rounded mx-auto d-block"
							/>
						</div>
						<div class="col-md-9">
							<h2>38</h2>
							<p>Currently booked</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 p-4 mt-5 bg-white rounded-sm">
		<h5 class="font-w-600">Past Month Activity</h5>
		<div class="row mt-4 second">
			<div class="col-md-4 mb-3">
				<div class="card">
					<div class="row mt-4 p-3">
						<div class="col-md-3">
							<img src="<?php echo base_url()?>/assets/site/img/rented_stalls.png" class="rounded mx-auto d-block" />
						</div>
						<div class="col-md-9">
							<h2>43</h2>
							<p>Rented Stalls</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="card">
					<div class="row mt-4 p-3">
						<div class="col-md-3">
							<img src="<?php echo base_url()?>/assets/site/img/total_revenue.png" class="rounded mx-auto d-block" />
						</div>
						<div class="col-md-9">
							<h2>$1290</h2>
							<p>Total Revenue</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="card">
					<div class="row mt-4 p-3">
						<div class="col-md-3">
							<img src="<?php echo base_url()?>/assets/site/img/total_events.png" class="rounded mx-auto d-block" />
						</div>
						<div class="col-md-9">
							<h2>14</h2>
							<p>Total Events</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row tablesec mt-5 mb-5">
		<div class="col-md-6">
			<h5 class="font-w-600">Monthly Accured Income</h5>
			<div class="table-responsive mt-3">
				<table class="table m-0">
					<thead>
						<tr class="welcome-table table-active">
							<th scope="col">#</th>
							<th scope="col">Month</th>
							<th scope="col">Amount</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>January 2022</td>
							<td>$500</td>
							<td>
								<button class="View">View</button>
							</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Feburary 2022</td>
							<td>$500</td>
							<td>
								<button class="View">View</button>
							</td>
						</tr>
						<tr>
							<td>3</td>
							<td>March 2022</td>
							<td>$500</td>
							<td>
								<button class="View">View</button>
							</td>
						</tr>
						<tr>
							<td>4</td>
							<td>April 2022</td>
							<td>$500</td>
							<td>
								<button class="View">View</button>
							</td>
						</tr>
						<tr>
							<td>5</td>
							<td>May 2022</td>
							<td>$500</td>
							<td>
								<button class="View">View</button>
							</td>
						</tr>
						<tr>
							<td colspan="4" class="text-center">
								<a href="#" class="dash-view">VIEW ALL</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-6">
			<h5 class="font-w-600">Upcoming events</h5>
			<div class="table-responsive mt-3">
				<table class="table m-0">
					<thead>
						<tr class="welcome-table table-active">
							<th scope="col">Date</th>
							<th scope="col">Event Name</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>15-02-2022</td>
							<td>World Series Team</td>
							<td>
								<button class="View">View</button>
							</td>
						</tr>
						<tr>
							<td>15-02-2022</td>
							<td>World Series Team</td>
							<td>
								<button class="View">View</button>
							</td>
						</tr>
						<tr>
							<td>15-02-2022</td>
							<td>World Series Team</td>
							<td>
								<button class="View">View</button>
							</td>
						</tr>
						<tr>
							<td>15-02-2022</td>
							<td>World Series Team</td>
							<td>
								<button class="View">View</button>
							</td>
						</tr>
						<tr>
							<td>15-02-2022</td>
							<td>World Series Team</td>
							<td>
								<button class="View">View</button>
							</td>
						</tr>
						<tr>
							<td colspan="3" class="text-center">
								<a href="#" class="dash-view">VIEW ALL</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php $this->endSection(); ?>