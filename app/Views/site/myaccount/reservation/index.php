<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<h5>Current Reservation</h5>
<section class="maxWidth marFiveRes eventPagePanel">
  <?php foreach ($bookings as $data) { ?>
      <div class="ucEventInfo">
          <div class="EventFlex">
              <div class="EventFlex leftdata">
                    <span class="wi-30">
                    <h6>FitstName:</h6><p><?php echo $data['firstname'];?></p>
                    <h6>LastName:</h6><p><?php echo $data['lastname'];?></p>
                    <h6>Mobile:</h6><p> <?php echo $data['mobile'];?></p>
                    <h6>Booked Event:</h6><p><?php echo $data['eventname'];?></p>
                    <h6>Booked Stall:</h6><p><?php echo implode(',', $data['stall']);?></p>
                    <h6>CheckIn:</h6><p><?php echo $data['check_in'];?></p>
                    <h6>CheckOut:</h6><p><?php echo $data['check_out'];?></p>
                    </span>
              </div>
          </div>
      </div>
  <?php } ?>
</section>

<?php echo $pager; ?>
<?php $this->endSection(); ?>
