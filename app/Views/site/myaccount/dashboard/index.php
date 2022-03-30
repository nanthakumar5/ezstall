<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<?php 
$userdetail = getSiteUserDetails();
$name = $userdetail['name'];
?>
<style>
	.upcoming {
  display:none;
  margin: 5px 0;
  padding: 8px 0;
  background: #eee;
  border: 1px solid #ccc;
  text-align: center;
}
#loadMore {
    padding: 10px;
    width: 100%;
    display: block;
    text-align: center;
    background-color: #33739E;
    color: #fff;
    border-width: 0 1px 1px 0;
    border-style: solid;
    border-color: #fff;
    box-shadow: 0 1px 1px #ccc;
    transition: all 600ms ease-in-out;
    -webkit-transition: all 600ms ease-in-out;
    -moz-transition: all 600ms ease-in-out;
    -o-transition: all 600ms ease-in-out;
    margin-top: 10px;
    margin-bottom: 10px;
}
#loadMore:hover {
    background-color: #eee;
    color: #33739E;
}
</style>
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
							<h2><?php echo $stallcount;?></h2>
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
							<h2><?php echo $available;?></h2>
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
							<h2><?php echo $bookingstall;?></h2>
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
							<h2><?php echo $paststallcount;?></h2>
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
							<h2>$<?php echo $paststallprice;?></h2>
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
							<h2><?php echo $totaleventpast;?></h2>
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
				<table class="table m-0" id="upcoming">
					<thead>
						<tr class="welcome-table table-active">
							<th scope="col">Date</th>
							<th scope="col">Event Name</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($upcomingevents as $value){ ?>
						
						<tr class="upcoming">
							<td><?php echo date('d-m-Y',strtotime($value['start_date'])); ?></td>
							<td><?php echo $value['name']; ?></td>
							<td>
								<button class="View">
									<a href="<?php echo base_url().'/myaccount/events/view/'.$value['id']; ?>">View</a>
								</button>
									
							</td>
						</tr>
						<?php } ?>
						
						<tr>
							<td colspan="3" class="text-center">
								<a href="" id="loadMore" class="dash-view">VIEW ALL</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php $this->endSection(); ?>
<?php $this->section('js') ?>
<script>
 $(function () {
      $(".upcoming").slice(0, 2).show();
      $("#loadMore").on('click', function (e) {
          e.preventDefault();
          $(".upcoming:hidden").slideDown();
          if ($(".upcoming:hidden").length == 0) {
              $("#load").fadeOut('slow');
              $('#loadMore').replaceWith("<a href='#' id='loadMore' class='dash-view'>No More</a>");
          }
      });
  });
</script>
<?php echo $this->endSection() ?>
