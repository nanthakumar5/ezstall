<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content'); ?>
  <?php
      $id                 = isset($result['id']) ? $result['id'] : '';
      $firstname          = isset($result['firstname']) ? $result['firstname'] : '';
      $lastname           = isset($result['lastname']) ? $result['lastname'] : '';
      $mobile             = isset($result['mobile']) ? $result['mobile'] : '';
      $eventname          = isset($result['eventname']) ? $result['eventname'] : '';
      $stall              = isset($result['stall']) ? $result['stall'] : '';
      $stalls             = implode(',', $stall);
      $checkin            = isset($result['check_in']) ? $result['check_in'] : '';
      $checkin            = date("d-m-Y", strtotime($checkin));
      $checkout           = isset($result['check_out']) ? $result['check_out'] : '';
      $checkout           = date("d-m-Y", strtotime($checkout));
  ?>
<a href="<?php echo base_url().'/myaccount/bookings';?>" class="btn btn-primary">Back</a>
<h2 class="fw-bold mb-4">View Reservation</h2>
<section class="maxWidth eventPagePanel">
  <table class="table">
    <tbody>
      <tr>
        <th>First Name</th>
        <td><?php echo $firstname;?></td>
      </tr>
      <tr>
        <th>Last Name</th>
        <td><?php echo $lastname;?></td>
    </tr>
    <tr>
      <th>Mobile</th>
      <td><?php echo $mobile;?></td>
    </tr>
    <tr>
      <th>Event Name</th>
      <td><?php echo $eventname;?></td>
    </tr>
    <tr>
      <th>Stall Name</th>
      <td><?php echo $stalls;?></td>
    </tr>
    <tr>
      <th>Check In</th>
      <td><?php echo $checkin;?></td>
    </tr>
    <tr>
      <th>Check Out</th>
      <td><?php echo $checkout;?></td>
    </tr>
    </tbody>
  </table>
</section>

<?php $this->endSection(); ?>
