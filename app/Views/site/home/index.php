<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
	<?php
		$userdetail  	= getSiteUserDetails();
		$usertype  		= $userdetail ? $userdetail['usertype'] : '';
		$liststall 		= base_url().'/login';
		if($usertype=='2')  	$liststall	= base_url().'/myaccount/facility';
		elseif($usertype=='3')  $liststall 	= base_url().'/myaccount/events';
	?>
	<div class="wi-1200">
		<div class="displayFlex">
			<div class="flexOneLeft beforeRound">
				<img class="flexoneImage" src="<?php echo base_url();?>/assets/site/img/what-we-do.jpg" />
			</div>
			<div class="flexOneRight afterHorse">
			<h1 class="commonTitle">What We Do</h1>
				<p class="commonContent">
				Our mission is to connect horses with stalls! Whether you're a
				rodeo athlete, dressage enthusiast, or trail riding adventurer;
				our goal is to identify the facilities you can keep your horses
				while on the road.
				</p>
				<button class="greyButton">Read More</button>
			</div>
		</div>

		<div class="displayFlex flexReverse">
			<div class="flexOneRight">
			<h1 class="commonTitle">Who We Are</h1>
				<p class="commonContent">
				We are horse owners. We are the people who have arrived on site, only to find a full barn and no manager in site. We are also the people who have called the secretary ahead of time and cruised by the long line leading out of the facility office. We want everyone to experience that second feeling.
				</p>
				<button class="greyButton">Read More</button>
			</div>
			<div class="flexOneLeft afterRound">
				<img class="flexoneImage" src="<?php echo base_url();?>/assets/site/img/Who.png" />
			</div>
		</div>
	</div>

	<section class="homeEventsPanel">
      	<div class="wi-1200">
          <ul class="nav nav-tabs align-items-center" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Upcoming Events</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Past Events</button>
            </li>
            <a href="<?php echo base_url().'/events'; ?>" class="allEventsLink">View All Events <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><polyline points="9 18 15 12 9 6"></polyline></svg></a>
      
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="MuiTabPanel-root css-13xfq8m-MuiTabPanel-root" role="tabpanel" aria-labelledby="mui-p-25453-T-1" id="mui-p-25453-P-1">
                	<?php foreach($upcomingevents as $row){ 
                			$start_on = date("M d, Y", strtotime($row['start_date']));
                			$end_on = date("M d, Y", strtotime($row['end_date']));
                			$event_on = $start_on.' - '.$end_on;
                		?>
                	<div class="ucEventInfo">
                		<div class="EventFlex">
                			<span class="wi-50">
                				<p><?php echo $event_on;?>. <?php echo ucfirst($row['location']);?></p>
                				<h5><?php echo ucfirst($row['name']);?></h5>
                			</span>
                			<div class="wi-50-2 justify-content-between">
                				<span class="m-left">
                					<p><img class="eventFirstIcon" src="<?php echo base_url();?>/assets/site/img/horseShoe.svg">Stalls</p>
                					<h6>from $<?php echo $row['stalls_price'];?> / night</h6>
                				</span>
                				<!--<span class="m-left">
                					<p><img class="eventSecondIcon" src="<?php echo base_url();?>/assets/site/img/rvSpot.svg">RV Spot</p>
                					<h6>from $<?php echo $row['rvspots_price'];?> / night</h6>
                				</span>-->
                				<button class="ucEventBtn"><a class="text-decoration-none text-white" href="<?php echo base_url()?>/events/detail/<?php echo $row['id']?>">Book Now</a></button>
                			</div>
                		</div>
                	</div>
                <?php } ?>
                	
            </div>
       
          </div>  
          <div class="tab-pane" id="profile" role="profile-tab" aria-labelledby="profile-tab">
          	<div class="MuiTabPanel-root css-13xfq8m-MuiTabPanel-root" role="tabpanel" aria-labelledby="mui-p-25453-T-1" id="mui-p-25453-P-1">
                	<?php foreach($pastevents as $row){ 
                			$start_on = date("M d, Y", strtotime($row['start_date']));
                			$end_on = date("M d, Y", strtotime($row['end_date']));
                			$event_on = $start_on.' - '.$end_on;
                		?>
                	<div class="ucEventInfo">
                		<div class="EventFlex">
                			<span class="wi-50">
                				<p><?php echo $event_on;?>. <?php echo ucfirst($row['location']);?></p>
                				<h5><?php echo ucfirst($row['name']);?></h5>
                			</span>
                			<div class="wi-50-2 justify-content-between">
                				<span class="m-left">
                					<p><img class="eventFirstIcon" src="<?php echo base_url();?>/assets/site/img/horseShoe.svg">Stalls</p>
                					<h6>from $<?php echo $row['stalls_price'];?> / night</h6>
                				</span>
                				<!--<span class="m-left">
                					<p><img class="eventSecondIcon" src="<?php echo base_url();?>/assets/site/img/rvSpot.svg">RV Spot</p>
                					<h6>from $<?php echo $row['rvspots_price'];?> / night</h6>
                				</span>-->
                				<button class="ucEventBtn"><a class="text-decoration-none text-white" href="<?php echo base_url()?>/events/detail/<?php echo $row['id']?>">View</a></button>
                			</div>
                		</div>
                	</div>
                <?php } ?>
                	
            </div>
          </div>

            <!-- Tabs content -->
  		</div>
    </section>

	<section class="howItWorks">
	  <div class="contentPanel">
	    <h1 class="howitworkTitle">How it works</h1>
	    <p class="hiwmainContent colorGrey">
		We are developing a community of facilities and horse owners to build a network to house equine athletes on the road.
	    </p>
	    <span class="hiwContent colorGrey">
	      <img src="<?php echo base_url();?>/assets/site/img/download1.png" />
		  Sign Up. Join in as either a horse owner or a facility. With us, if you need a stall you are a horse owner, if you have a stall that needs a horse in it you are a facility.
	    </span>
	    <span class="hiwContent colorGrey">
	      <img src="<?php echo base_url();?>/assets/site/img/download2.png" />
		  Search. Find where you are headed next, if this is an EZ Stall facility or event find the stall you want and reserve it. If not we’ll find the closest EZ Stall facility near you.
	    </span>
	    <span class="hiwContent colorGrey">
	      <img src="<?php echo base_url();?>/assets/site/img/download3.png" />
		  Rest and Relax. Enjoy the drive to your destination. Your stall will be waiting for you and your horse to arrive.
	    </span>
	  </div>
	  <div class="imagePanel colorGrey">
	    <img class="hiwImage" src="<?php echo base_url();?>/assets/site/img/How.png" />
	  </div>
	</section>

	<section class="footerabovePanel">
            <div class="horseOwners">
              <p class="footaboveTag">Looking for stalls</p>
              <h1 class="footaboveTitle">Horse Owners</h1>
              <!-- <p class="footaboveContent colorGrey">
                Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse
                quam nihil molestiae consequatur.
              </p> -->
              <button class="footaboveBtn footsearchbtn">Search</button>
            </div>
            <span class="footaboveLine"></span>
            <div class="facilities">
              <p class="footaboveTag">Grow your business</p>
              <h1 class="footaboveTitle">Facilities & Produces</h1>
              <!-- <p class="footaboveContent colorGrey">
                Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse
                quam nihil molestiae consequatur.
              </p> -->
			  <?php  ?>
              <a href="<?php echo $liststall; ?>" ><button class="footaboveBtn">List Your Stall</button></a>
            </div>
    </section>
<?php $this->endSection(); ?>
<?php $this->section('js') ?>
    <script>
        $('.footsearchbtn').click(function (e) {
			$('input[name="llocation"]').focus();
        });
    </script>
<?php $this->endSection(); ?>