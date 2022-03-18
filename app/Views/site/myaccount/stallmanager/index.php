<?php $this->extend('site/common/layout/layout1') ?>

<?php $this->section('content') ?>
<section class="maxWidth eventPagePanel mt-2">
	<a class="btn-custom-black" href="<?php echo base_url().'/myaccount/stallmanager/add'; ?>">Add Stall Manager</a>
	<?php if(count($list) > 0){ ?>
		<?php foreach ($list as $data) {  ?>
			<div class="ucEventInfo mt-4">
				<div class="EventFlex">
					<span class="wi-50 px-2">
						<div class="EventFlex leftdata">
							<span class="wi-30">
								<span class="ucimg">
									<label>Name</label>
									<label>Email</label>
								</span>
							</span>
							<span class="wi-70">
								<p><?php echo $data['name']; ?></p>
								<p><?php echo $data['email']; ?></p>
							</span>
						</div>
					</span>
					<div class="wi-50-2 px-3 justify-content-between">
						<span class="m-left w-100">
							
						</span>
						<span class="m-left w-100">
							
						</span>
						<div class="edit">
							<a href="<?php echo base_url().'/myaccount/stallmanager/edit/'.$data['id']; ?>">Edit</a>
							<a data-id="<?php echo $data['id']; ?>" href="javascript:void(0);" class="delete">Delete</a>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	<?php }else{ ?>
		<p class="mt-3">No Record Found</p>
	<?php } ?>
	<?php echo $pager; ?>
</section>
<?php $this->endSection(); ?>

<?php $this->section('js') ?>
	<script>
		var userid = '<?php echo $userid; ?>';

		$(document).on('click','.delete',function(){
			var action 	= 	'<?php echo base_url()."/myaccount/stallmanager"; ?>';
			var data   = '\
			<input type="hidden" value="'+$(this).data('id')+'" name="id">\
			<input type="hidden" value="'+userid+'" name="userid">\
			<input type="hidden" value="0" name="status">\
			';
			sweetalert2(action,data);
		});	
	</script>
<?php $this->endSection(); ?>
