<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<?php $userid = getSiteUserID(); ?>

<h2 class="fw-bold mb-4">Current Reservation</h2>
<section class="maxWidth eventPagePanel">
  <?php  foreach ($reservations as $data) { 
            if($data['usertype']      == 2) $usertype = 'Facility';
            elseif($data['usertype']  == 3) $usertype = 'Producer';
            elseif($data['usertype']  == 4) $usertype = 'Stall Manager';
            elseif($data['usertype']  == 5) $usertype = 'Horse Owner'; 
        if($userid != $data['user_id'] || $data['usertype'] == 5){  ?>
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
                      <p class="mb-0 fs-7"><?php echo $data['eventname'];?> (
                        <?php 
                          foreach ($data['barnstall'] as $stalls) {
                                echo $stalls['stallname'];
                          }
                        ?>)
                      </p>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div>
                      <p class="mb-0 fs-7 fw-600">CheckIn - CheckOut</p>
                      <p class="mb-0 fs-7"><?php echo date("d-m-Y", strtotime($data['check_in']));?> - <?php echo date("d-m-Y", strtotime($data['check_out']));?></p>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div>
                      <p class="mb-0 fs-7 fw-600">Booked By</p>
                      <p class="mb-0 fs-7"><?php echo $usertype; ?></p>
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
        <?php } ?>
  </section>

<?php echo $pager; ?>
<?php $this->endSection(); ?>
