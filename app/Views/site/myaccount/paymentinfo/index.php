<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<h5>Payment Details</h5>
 <section class="maxWidth marFiveRes eventPagePanel">
       <?php foreach ($payments as $data) { 

          if($data['type']==1) 
          $paymenttype="Single Payment";
          else 
          $paymenttype="Subscription";

          $plan_interval='';
          if($data['plan_interval']=='week') 
            $plan_interval="<h6>Plan Name :</h6> Weekly Subscription";
          elseif($data['plan_interval']=='month') 
            $plan_interval="<h6>Plan Name :</h6> Monthly Subscription";
          elseif($data['plan_interval']=='year') 
            $plan_interval="<h6>Plan Name :</h6> Yearly Subscription";

          if($data['type']==1) 
            $plancreated=$data['created'];
          else 
            $plancreated=$data['plan_period_start'];
                     
          if($data['type']==1) 
            $planend='';
          else 
            $planend='<h6>To:</h6>'.$data['plan_period_end'];
      ?>
        <div class="ucEventInfo">
          <div class="EventFlex">
              <div class="EventFlex leftdata">
                <span class="wi-30">
                        <h6>Name:</h6><p><?php echo $data['payer_name'];?></p>
                        <h6>Email:</h6><p> <?php echo $data['payer_email'];?></p>                 
                        <h6>Payment Type:</h6><p><?php echo $paymenttype;?></p>
                        <p><?php echo $plan_interval;?></p>
                        <h6>Amout:</h6><p>$<?php echo $data['amount'];?></p>
                        <h6>Plan Start:</h6><p><?php echo $plancreated; ?></p>
                        <h6></h6><p> <?php echo $planend; ?></p>
                  </span>
              </div>
          </div>
        </div>
    <?php } ?>
<?php echo $pager; ?>

<?php $this->endSection(); ?>
<?php $this->section('js') ?>

<?php $this->endSection() ?>