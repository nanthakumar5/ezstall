<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content'); ?>
  <?php
      $bookingid          = isset($result['id']) ? $result['id'] : '';
      $firstname          = isset($result['firstname']) ? $result['firstname'] : '';
      $lastname           = isset($result['lastname']) ? $result['lastname'] : '';
      $mobile             = isset($result['mobile']) ? $result['mobile'] : '';
      $eventname          = isset($result['eventname']) ? $result['eventname'] : '';
      $stall              = isset($result['stall']) ? $result['stall'] : '';
      $checkin            = isset($result['check_in']) ? $result['check_in'] : '';
      $checkin            = date("d-m-Y", strtotime($checkin));
      $checkout           = isset($result['check_out']) ? $result['check_out'] : '';
      $checkout           = date("d-m-Y", strtotime($checkout));
      $barnstalls         = isset($result['barnstall']) ? $result['barnstall'] : '';

  ?>
    <div class="row">
      <div class="col">
        <h2 class="fw-bold mb-4">View Past Month Activity</h2>
      </div>
      <div class="col" align="right">
        <a href="<?php echo base_url().'/myaccount/pastactivity';?>" class="btn back-btn">Back</a>
      </div>
    </div>
    <section class="maxWidp eventPagePanel">
      <div class="row col-md-10 base-style">
        <div class="col fw-600">
          <p class="my-2">Booking ID</p>
        </div>
        <div class="col" align="left">
          <p class="my-2"><?php echo $bookingid;?></p>
        </div>
      </div>
     
      <div class="row col-md-10 base-style">
        <div class="col fw-600">
          <p class="my-2">First Name</p>
        </div>
        <div class="col" align="left">
          <p class="my-2"><?php echo $firstname;?></p>
        </div>
      </div>
      <div class="row col-md-10 base-style">
        <div class="col fw-600">
          <p class="my-2">Last Name</p>
        </div>
        <div class="col" align="left">
          <p class="my-2"><?php echo $lastname;?></p>
        </div>
      </div>
      <div class="row col-md-10 base-style">
        <div class="col fw-600">
          <p class="my-2">Mobile</p>
        </div>
        <div class="col" align="left">
          <p class="my-2"><?php echo $mobile;?></p>
        </div>
      </div>
      <div class="row col-md-10 base-style">
        <div class="col fw-600">
          <p class="my-2">Event Name</p>
        </div>
        <div class="col" align="left">
          <p class="my-2"><?php echo $eventname;?></p>
        </div>
      </div>
      <div class="row col-md-10 base-style">
        <div class="col fw-600">
          <p class="my-2">Barn Name</p>
        </div>
        <div class="col" align="left">
          <?php foreach ($barnstalls as $barnstall) {
              echo ' <p class="my-2">'.$barnstall['barnname'].'-'.$barnstall['stallname'].'</p>';  } ?>
        </div>
      </div>
      <div class="row col-md-10 base-style">
        <div class="col fw-600">
          <p class="my-2">Check In</p>
        </div>
        <div class="col" align="left">
          <p class="my-2"><?php echo $checkin;?></p>
        </div>
      </div>
      <div class="row col-md-10 base-style">
        <div class="col fw-600">
          <p class="my-2">Check Out</p>
        </div>
        <div class="col" align="left">
          <p class="my-2"><?php echo $checkout;?></p>
        </div>
      </div>
       <div class="row col-md-10 base-style">
        <div class="col fw-600">
          <p class="my-2">Booked By</p>
        </div>
        <div class="col" align="left">
          <p class="my-2"><?php echo $usertype[$result['usertype']];?></p>
        </div>
      </div>
    </section>

<?php $this->endSection(); ?>