<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<h5>Payment Details</h5>
 <section class="maxWidth marFiveRes eventPagePanel">
  <?php foreach ($payments as $data) { ?>
    <div class="ucEventInfo">
      <div class="EventFlex">
          <div class="EventFlex leftdata">
            <span class="wi-30">
              <h6>Name:</h6><p><?php echo $data['payer_name'];?></p>
              <h6>Email:</h6><p> <?php echo $data['payer_email'];?></p>                 
              <h6>Payment Type:</h6><p><?php echo isset($paymenttype[$data['type']]) ? $paymenttype[$data['type']] : '';?></p>
              <h6>Plan Name:</h6><p><?php echo isset($paymentinterval[$data['plan_interval']]) ? $paymentinterval[$data['plan_interval']] : '';?></p>
              <h6>Amout:</h6><p><?php echo $data['amount'];?></p>
              <h6>Plan Date</h6><p> <?php echo $data['type']=='1'? $data['created'] : $data['plan_period_start'].'-'.$data['plan_period_end']; ?></p>
            </span>
          </div>
      </div>
    </div>
  <?php } ?>
</section>
<?php echo $pager; ?>
<?php $this->endSection(); ?>
    