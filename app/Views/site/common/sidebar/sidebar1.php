<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

<?php
	$userdetail = getSiteUserDetails();
	$role = $userdetail['type']; 
?>
<div class="navbar-header">
  <button type="button" id="sidebarCollapse" class="btn btn-info side-navbar-btn"><i class="side-nav-i bi bi-list"></i></button>
</div>
<nav id="sidebar-nav" class="ml-5">
	<ul class="list-unstyled components">
		<li class="side-nav-active">
			<a href="<?php echo base_url();?>/myaccount/dashboard" class="side-nav-a" data-toggle="collapse" aria-expanded="false">
				<i class="side-nav-i bi bi-speedometer"></i>
				Dashboard
			</a>
		</li>
		<li>
		  <a class="side-nav-a" href="<?php echo base_url();?>/myaccount/account">
			<i class="side-nav-i bi bi-person"></i>
			Account Information
		</a>

		<?php if($role!='5'){ ?>
		<a class="side-nav-a" href="<?php echo base_url();?>/myaccount/events">
			<i class="side-nav-i bi bi-calendar2-event"></i>
			Add Event
		</a>
		<?php } ?>
		<?php if($role!='4'){ ?>
		<a class="side-nav-a" href="<?php echo base_url();?>/myaccount/stallmanager">
			<i class="side-nav-i bi bi-person"></i>
			Stall Manager
		</a>
		<?php } ?>
		<a class="side-nav-a" href="<?php echo base_url();?>/myaccount/bookings">
			<i class="side-nav-i bi bi-calendar2-week"></i>
			Current Reservation
		</a>
		<a class="side-nav-a" href="<?php echo base_url();?>/myaccount/pastactivity">
			<i class="side-nav-i bi bi-calendar3"></i>
			Past Month Activity
		</a>
		<a class="side-nav-a" href="<?php echo base_url();?>/myaccount/payments">
			<i class="side-nav-i bi bi-credit-card"></i>
			Payments
		</a>
		<?php if($role!='3'){ ?>
			<a class="side-nav-a" href="<?php echo base_url();?>/myaccount/subscription">
				<i class="side-nav-i bi bi-credit-card"></i>
				Subscription
			</a>
		<?php } ?>
		<a class="side-nav-a" href="<?php echo base_url();?>/logout">
			<i class="side-nav-i bi bi-power"></i>
			Logout
		</a>
		</li>
	</ul>
</nav>
