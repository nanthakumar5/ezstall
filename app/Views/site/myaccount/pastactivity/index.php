<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>

<div class="dFlexComBetween eventTP flex-wrap">
<h2 class="fw-bold mb-4">Past Month Acivity</h2>
</div>

<section class="maxWidth eventPagePanel">
  <?php  
    foreach ($bookings as $data) {           
  ?>
            <div class="dashboard-box">
              <div class="EventFlex leftdata">
                <div class="wi-30 row w-100 align-items-center">
                <div class="col-md-2">
                    <div>
                      <p class="mb-0 text-sm fs-7 fw-600">Booking ID</p></td>
                      <p class="mb-0 fs-7"><?php echo $data['id'];?></p></td>
                    </div>
                  </div>
                  <div class="col-md-2">
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
                        $stallname = [];
                          foreach ($data['barnstall'] as $stalls) {
                                $stallname[] = $stalls['stallname'];
                          }
                          echo implode(',', $stallname);
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
                      <p class="mb-0 fs-7 fw-600">Cost</p>
                      <p class="mb-0 fs-7"><?php echo $data['amount'];?></p>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div>
                      <p class="mb-0 fs-7 fw-600">Booked By</p>
                      <p class="mb-0 fs-7"><?php echo $usertype[$data['usertype']]; ?></p>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="d-flex justify-content-end">
                     <a href="<?php echo base_url().'/myaccount/pastactivity/view/'.$data['id']; ?>" class="view-res">View</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        <?php } ?>
  </section>

<?php echo $pager; ?>
<?php $this->endSection(); ?>
<?php $this->section('js') ?>
<script>
  
</script>
<?php $this->endSection(); ?>
