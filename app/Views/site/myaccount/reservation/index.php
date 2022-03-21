<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<h2 class="fw-bold mb-4">Current Reservation</h2>
<section class="maxWidth eventPagePanel">
  <?php foreach ($bookings as $data) { ?>
    <div class="dashboard-box">
      <div class="EventFlex leftdata">
        <div class="wi-30 row w-100">
          <div class="col-md-4">
            <div>
              <h6 class="mb-0 fw-600">Name</h6></td>
              <p class="mb-0"><?php echo $data['firstname'].$data['lastname'];?></p></td>
            </div>
            <div class="my-2">
              <h6 class="mb-0 fw-600">Booked Event</h6>
              <p class="mb-0"><?php echo $data['eventname'];?> ( <?php echo implode(',', $data['stall']);?> )</p>
            </div>
          </div>
          <div class="col-md-4">
            <div>
              <h6 class="mb-0 fw-600">CheckIn</h6>
              <p class="mb-0"><?php echo date("d-m-Y", strtotime($data['check_in']));?></p>
            </div>
            <div class="d-flex">
              <a href="#" class="view-res">View</a>
            </div>
          </div>
          <div class="col-md-4">
            <div>
              <h6 class="mb-0 fw-600">CheckOut</h6>
              <p class="mb-0"><?php echo date("d-m-Y", strtotime($data['check_out']));?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>

</section>

<?php echo $pager; ?>
<?php $this->endSection(); ?>
