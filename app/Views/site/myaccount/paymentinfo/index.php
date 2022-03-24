<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<h2 class="fw-bold mb-4">Payment Details</h2>
<section class="maxWidth eventPagePanel">
 <?php foreach ($payments as $data) { ?>
  <div class="dashboard-box">
    <div class="EventFlex leftdata">
      <div class="wi-30 row w-100">
        <div class="col-md-4">
          <div>
            <p class="mb-0 text-sm fs-7 fw-600">Name</p>
            <p class="mb-0 fs-7"><?php echo $data['payer_name'];?></p>
          </div>
        </div>
        <div class="col-md-4">
          <div>
            <p class="mb-0 text-sm fs-7 fw-600">Amout:</p>
            <p class="mb-0 fs-7"><?php echo $data['amount'];?></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="d-flex justify-content-end">
            <a href="<?php echo base_url().'/myaccount/payments/view/'.$data['id']; ?>" class="view-res">View</a>
          </div>
        </div>
      </table>   
    </div>
  </div>
</div>
<?php } ?>
</section>
<?php echo $pager; ?>
<?php $this->endSection(); ?>
