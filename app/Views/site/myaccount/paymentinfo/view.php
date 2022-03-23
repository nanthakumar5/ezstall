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
<a href="<?php echo base_url().'/myaccount/payments';?>" class="btn btn-primary">Back</a>
<h2 class="fw-bold mb-4">View Payment Details</h2>
<section class="maxWidth eventPagePanel">
        <table class="table">
          <tbody>
            <tr>
                <th>Name</th>
                <td><?php echo $name;?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $email;?></td>
          </tr>
          <tr>
            <th>Payment Type</th>
            <td><?php echo $type;?></td>
          </tr>
          <tr>
            <th>Amount</th>
            <td><?php echo $amount;?></td>
          </tr>
          <tr>
            <th>Plan Date</th>
            <td><?php echo $plan_start;?></td>
          </tr>
          <tr>
            <th>Plan End</th>
            <td><?php echo $plan_end;?></td>
          </tr>
          </tbody>
        </table>
</section>
<?php $this->endSection(); ?>
