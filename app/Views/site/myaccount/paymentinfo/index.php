<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<h2 class="fw-bold mb-4">Payment Details</h2>
<section class="maxWidth eventPagePanel">

 <?php foreach ($payments as $data) { ?>
  <div class="dashboard-box">
    <div class="EventFlex">
      <div class="EventFlex leftdata">
        <span class="wi-30">
          <table>
            <tr class="mb-5">
              <td class="py-2 px-2"><h6 class="mb-0 fw-600">Name</h6></td>
              <td class="py-2 fw-600">:</td>
              <td class="py-2 px-2"><p class="mb-0"><?php echo $data['payer_name'];?></p></td>
            </tr>
            <tr>
              <td class="py-2 px-2"><h6 class="mb-0 fw-600">Email:</h6></td>
              <td class="py-2 fw-600">:</td>
              <td class="py-2 px-2"><p class="mb-0"><?php echo $data['payer_email'];?></p></td>
            </tr>
            <tr>
              <td class="py-2 px-2"><h6 class="mb-0 fw-600">Payment Type:</h6></td>
              <td class="py-2 fw-600">:</td>
              <td class="py-2 px-2"><p class="mb-0"><?php echo isset($paymenttype[$data['type']]) ? $paymenttype[$data['type']] : '';?></p></td>
            </tr>
            <tr>
              <td class="py-2 px-2"><h6 class="mb-0 fw-600">Plan Name:</h6></td>
              <td class="py-2 fw-600">:</td>
              <td class="py-2 px-2"><p class="mb-0"><?php echo isset($paymentinterval[$data['plan_interval']]) ? $paymentinterval[$data['plan_interval']] : '';?></p></td>
            </tr>
            <tr>
              <td class="py-2 px-2"><h6 class="mb-0 fw-600">Amout:</h6></td>
              <td class="py-2 fw-600">:</td>
              <td class="py-2 px-2"><p class="mb-0"><?php echo $data['amount'];?></p></td>
            </tr>
            <tr>
              <td class="py-2 px-2"><h6 class="mb-0 fw-600">Plan Date</h6></td>
              <td class="py-2 fw-600">:</td>
              <td class="py-2 px-2"><p class="mb-0"> <?php echo $data['type']=='1'? $data['created'] : $data['plan_period_start'].'-'.$data['plan_period_end']; ?></p></td>
            </tr>
             <tr>
              <td class="py-2 px-2"><h6 class="mb-0 fw-600">
                <a href="<?php echo base_url().'/myaccount/payments/view/'.$data['id']; ?>" class="view-res">View</a>
              </h6></td>
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
