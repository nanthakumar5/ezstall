<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<h2 class="fw-bold mb-4">Current Reservation</h2>
<section class="maxWidth eventPagePanel">
  <?php foreach ($bookings as $data) { ?>
      <div class="dashboard-box">
          <div class="EventFlex">
              <div class="EventFlex leftdata">
                    <span class="wi-30">

                      <table>
                        <tr class="mb-5">
                          <td class="py-2 px-2"><h6 class="mb-0 fw-600">FitstName</h6></td>
                          <td class="py-2 fw-600">:</td>
                          <td class="py-2 px-2"><p class="mb-0"><?php echo $data['firstname'];?></p></td>
                        </tr>
                        <tr>
                          <td class="py-2 px-2"><h6 class="mb-0 fw-600">LastName</h6></td>
                          <td class="py-2 fw-600">:</td>
                          <td class="py-2 px-2"><p class="mb-0"><?php echo $data['lastname'];?></p></td>
                        </tr>
                        <tr>
                          <td class="py-2 px-2"><h6 class="mb-0 fw-600">Mobile</h6></td>
                          <td class="py-2 fw-600">:</td>
                          <td class="py-2 px-2"><p class="mb-0"> <?php echo $data['mobile'];?></p></td>
                        </tr>
                        <tr>
                          <td class="py-2 px-2"><h6 class="mb-0 fw-600">Booked Event</h6></td>
                          <td class="py-2 fw-600">:</td>
                          <td class="py-2 px-2"><p class="mb-0"><?php echo $data['eventname'];?></p></td>
                        </tr>

                        <tr>
                          <td class="py-2 px-2"><h6 class="mb-0 fw-600">Booked Stall</h6></td>
                          <td class="py-2 fw-600">:</td>
                          <td class="py-2 px-2"><p class="mb-0"><?php echo implode(',', $data['stall']);?></p></td>
                        </tr>
                        <tr>
                          <td class="py-2 px-2"><h6 class="mb-0 fw-600">CheckIn</h6></td>
                          <td class="py-2 fw-600">:</td>
                          <td class="py-2 px-2"><p class="mb-0"><?php echo $data['check_in'];?></p></td>
                        </tr>
                        <tr>
                          <td class="py-2 px-2"><h6 class="mb-0 fw-600">CheckOut</h6></td>
                          <td class="py-2 fw-600">:</td>
                          <td class="py-2 px-2"><p class="mb-0"><?php echo $data['check_out'];?></p></td>
                        </tr>
                      </table>
                    </span>
              </div>
          </div>
      </div>
  <?php } ?>
</section>

<?php echo $pager; ?>
<?php $this->endSection(); ?>
