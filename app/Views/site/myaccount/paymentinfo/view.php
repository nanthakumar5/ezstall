<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<?php
$id             = isset($result['id']) ? $result['id'] : '';
$name           = isset($result['payer_name']) ? $result['payer_name'] : '';
$email          = isset($result['payer_email']) ? $result['payer_email'] : '';
$type           = isset($result['type']) && $result['type']=='1' ? 'Payment' : 'Subscription';
$amount         = isset($result['amount']) ? $result['amount'] : '';
$plan_start     = isset($result['plan_period_start']) ? $result['plan_period_start'] : '';
$plan_start     = date("d-m-Y", strtotime($plan_start));
$plan_end       = isset($result['plan_period_start']) ? $result['plan_period_end'] : '';
$plan_end       = date("d-m-Y", strtotime($plan_end));

?>
<div class="row">
  <div class="col">
    <h2 class="fw-bold mb-4">View Payment Details</h2>
  </div>
  <div class="col" align="right">
    <a href="<?php echo base_url().'/myaccount/payments';?>" class="btn back-btn">Back</a>
  </div>
</div>
<section class="maxWidth eventPagePanel">
  <div class="row col-md-10 base-style">
    <div class="col fw-600">
      <p class="my-2">First Name</p>
    </div>
    <div class="col" align="left">
      <p class="my-2"><?php echo $name;?></p>
    </div>
  </div>
  <div class="row col-md-10 base-style">
    <div class="col fw-600">
      <p class="my-2">Email</p>
    </div>
    <div class="col" align="left">
      <p class="my-2"><?php echo $email;?></p>
    </div>
  </div>
  <div class="row col-md-10 base-style">
    <div class="col fw-600">
      <p class="my-2">Payment Type</p>
    </div>
    <div class="col" align="left">
      <p class="my-2"><?php echo $type;?></p>
    </div>
  </div>  
  <div class="row col-md-10 base-style">
    <div class="col fw-600">
      <p class="my-2">Amount</p>
    </div>
    <div class="col" align="left">
      <p class="my-2"><?php echo $amount;?></p>
    </div>
  </div>  
  <div class="row col-md-10 base-style">
    <div class="col fw-600">
      <p class="my-2">Plan Date</p>
    </div>
    <div class="col" align="left">
      <p class="my-2"><?php echo $plan_start;?></p>
    </div>
  </div>
  <div class="row col-md-10 base-style">
    <div class="col fw-600">
      <p class="my-2">Plan End</p>
    </div>
    <div class="col" align="left">
      <p class="my-2"><?php echo $plan_end;?></p>
    </div>
  </div>
</section>
<?php $this->endSection(); ?>
