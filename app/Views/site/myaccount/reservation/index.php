<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<h2 class="fw-bold mb-4">Current Reservation</h2>
<section class="maxWidth eventPagePanel">
  <?php foreach ($bookings as $data) { ?>
    <div class="dashboard-box">
      <div class="EventFlex leftdata">
        <div class="wi-30 row w-100">
          <div class="col-md-3">
            <div>
              <p class="mb-0 text-sm fs-7 fw-600">Name</p></td>
              <p class="mb-0 fs-7"><?php echo $data['firstname'].$data['lastname'];?></p></td>
            </div>
          </div>
          <div class="col-md-3">
            <div>
              <p class="mb-0 fs-7 fw-600">Booked Event</p>
              <p class="mb-0 fs-7"><?php echo $data['eventname'];?> ( <?php echo implode(',', $data['stall']);?> )</p>
            </div>
          </div>
          <div class="col-md-3">
            <div>
              <p class="mb-0 fs-7 fw-600">CheckIn - CheckOut</p>
              <p class="mb-0 fs-7"><?php echo date("d-m-Y", strtotime($data['check_in']));?> - <?php echo date("d-m-Y", strtotime($data['check_out']));?></p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="d-flex justify-content-end">
             <a href="<?php echo base_url().'/myaccount/bookings/view/'.$data['id']; ?>" class="view-res">View</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>

</section>

<?php echo $pager; ?>
<?php $this->endSection(); ?>
