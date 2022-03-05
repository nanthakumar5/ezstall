<div class="navbar-header">
  <button type="button" id="sidebarCollapse" class="btn btn-info side-navbar-btn"><i class="side-nav-i bi bi-list"></i></button>
</div>
<nav id="sidebar-nav">
	<ul class="list-unstyled components">
		<li class="side-nav-active">
			<a href="<?php echo base_url();?>/dashboard" class="side-nav-a" data-toggle="collapse" aria-expanded="false">
				<i class="side-nav-i bi bi-speedometer"></i>
				Dashboard
			</a>
		</li>
		<li>
		  <a class="side-nav-a" href="#">
			<i class="side-nav-i bi bi-person"></i>
			Account Information
		</a>
		<a class="side-nav-a" href="<?php echo base_url();?>/events">
			<i class="side-nav-i bi bi-calendar2-event"></i>
			Add Event
		</a>
		<a class="side-nav-a" href="#">
			<i class="side-nav-i bi bi-person"></i>
			Stall Manager
		</a>
		<a class="side-nav-a" href="#">
			<i class="side-nav-i bi bi-calendar2-week"></i>
			Current Reservation
		</a>
		<a class="side-nav-a" href="#">
			<i class="side-nav-i bi bi-calendar3"></i>
			Past Month Activity
		</a>
		<a class="side-nav-a" href="#">
			<i class="side-nav-i bi bi-credit-card"></i>
			Payments
		</a>		
		<a class="side-nav-a" href="<?php echo base_url();?>/logout">
			<i class="side-nav-i bi bi-power"></i>
			Logout
		</a>
		</li>
	</ul>
</nav>
