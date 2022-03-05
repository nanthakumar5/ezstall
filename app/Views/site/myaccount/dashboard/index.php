<?php $this->extend('site/common/layout/layout1') ?>

<?php $this->section('content') ?>

<?php 
	$userdetail = getSiteUserDetails();
	$name = $userdetail['name'];
?>

Welcome <?php echo $name; ?>

<?php $this->endSection(); ?>