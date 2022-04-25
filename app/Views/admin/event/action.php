<?= $this->extend("admin/common/layout/layout2") ?>

<?php $this->section('content') ?>
	<?php
		$id 					= isset($result['id']) ? $result['id'] : '';
		$userid 				= isset($result['user_id']) ? $result['user_id'] : '';
		$name 					= isset($result['name']) ? $result['name'] : '';
		$description 		    = isset($result['description']) ? $result['description'] : '';
		$location 				= isset($result['location']) ? $result['location'] : '';
		$mobile 				= isset($result['mobile']) ? $result['mobile'] : '';
		$start_date 		    = isset($result['start_date']) ? dateformat($result['start_date']) : '';
		$end_date 				= isset($result['end_date']) ? dateformat($result['end_date']) : '';
		$start_time 			= isset($result['start_time']) ? $result['start_time'] : '';
		$end_time 			    = isset($result['end_time']) ? $result['end_time'] : '';
		$stalls_price 			= isset($result['stalls_price']) ? $result['stalls_price'] : '';
		$rvspots_price 			= isset($result['rvspots_price']) ? $result['rvspots_price'] : '';
		$image      			= isset($result['image']) ? $result['image'] : '';
		$image 				    = filedata($image, base_url().'/assets/uploads/event/');
		$status 				= isset($result['status']) ? $result['status'] : '';
		$eventflyer      		= isset($result['eventflyer']) ? $result['eventflyer'] : '';
		$eventflyer 			= filedata($eventflyer, base_url().'/assets/uploads/eventflyer/');
		$stallmap      			= isset($result['stallmap']) ? $result['stallmap'] : '';
		$stallmap 				= filedata($stallmap, base_url().'/assets/uploads/stallmap/');
		$barn        			= isset($result['barn']) ? $result['barn'] : [];
		$pageaction 			= $id=='' ? 'Add' : 'Update';
	?>
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Events</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
						<li class="breadcrumb-item"><a href="<?php echo getAdminUrl(); ?>/event">Events</a></li>
						<li class="breadcrumb-item active"><?php echo $pageaction; ?> Event</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	
	<section class="content">
		<div class="page-action">
			<a href="<?php echo getAdminUrl(); ?>/event" class="btn btn-primary">Back</a>
		</div>
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"><?php echo $pageaction; ?> Event</h3>
			</div>
			<div class="card-body">
				<form method="post" id="form" action="<?php echo getAdminUrl(); ?>/event/action" autocomplete="off">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>User</label>								
									<?php echo form_dropdown('userid', getUsersList(['type'=>['3']]), $userid, ['id' => 'userid', 'class' => 'form-control']); ?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Name</label>								
									<input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="<?php echo $name; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Event Description</label>
									<textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="3"><?php echo $description;?></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Location</label>								
									<input type="text" name="location" class="form-control" id="location" placeholder="Enter Location" value="<?php echo $location; ?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Mobile</label>								
									<input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter Mobile" value="<?php echo $mobile; ?>">								
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Start Date</label>	
									<input type="text" class="form-control" name="start_date" value="<?php echo $start_date;?>" id="start_date">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>End Date</label>	
									<input type="text" class="form-control" name="end_date" value="<?php echo $end_date;?>" id="end_date">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Start Time</label>	
									<input type="time" class="form-control" name="start_time" value="<?php echo $start_time;?>" id="start_time">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>End Time</label>	
									<input type="time" class="form-control" name="end_time" value="<?php echo $end_time;?>" id="end_time">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Stalls Price</label>								
									<input type="text" name="stalls_price" class="form-control" id="stalls_price" placeholder="Enter Stalls Price" value="<?php echo $stalls_price;?>">								
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>RV Spots Price</label>								
									<input type="text" name="rvspots_price" class="form-control" id="rvspots_price" placeholder="Enter RV Spots Price" value="<?php echo $rvspots_price;?>">								
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Upload Event Image</label>			
									<div>
										<a href="<?php echo $image[1];?>" target="_blank">
											<img src="<?php echo $image[1];?>" class="image_source" width="100">
										</a>
									</div>
									<input type="file" class="image_file">
									<span class="image_msg messagenotify"></span>
									<input type="hidden" id="image" name="image" class="image_input" value="<?php echo $image[0];?>">
								</div>
							</div>							
							<div class="col-md-12">
								<div class="form-group">
									<label>Status</label>								
									<?php echo form_dropdown('status', ['' => 'Select Status']+$statuslist, $status, ['id' => 'status', 'class' => 'form-control']); ?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Upload Event Flyer</label>			
									<div>
										<a href="<?php echo $eventflyer[1];?>" target="_blank">
											<img src="<?php echo $eventflyer[1];?>" class="eventflyer_source" width="100">
										</a>
									</div>
									<input type="file" class="eventflyer_file">
									<span class="eventflyer_msg messagenotify"></span>
									<input type="hidden" id="eventflyer" name="eventflyer" class="eventflyer_input" value="<?php echo $eventflyer[0];?>">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Upload Stall Map (optional)</label>			
									<div>
										<a href="<?php echo $stallmap[1];?>" target="_blank">
											<img src="<?php echo $stallmap[1];?>" class="stallmap_source" width="100">
										</a>
									</div>
									<input type="file" class="stallmap_file">
									<span class="stallmap_msg messagenotify"></span>
									<input type="hidden" id="stallmap" name="stallmap" class="stallmap_input" value="<?php echo $stallmap[0];?>">
								</div>
							</div>	
							<div class="col-md-12 barn_wrapper">
								<a href="javascript:void(0);" class="btn btn-info barnbtn mb-3">Add Barn</a>
								<input type="hidden" value="" name="barnvalidation" class="barnvalidation">
							</div>
							<input type="hidden" id="current_barn_id" name="current_barn_id">
                            <div class="col-md-12" id="barnwrapper"></div>							
							<div class="col-md-12">
								<input type="hidden" name="actionid" value="<?php echo $id; ?>">
								<input type="submit" class="btn btn-primary" value="Submit">
								<a href="<?php echo getAdminUrl(); ?>/event" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
<?php $this->endSection(); ?>

<?php $this->section('js') ?>
	<script>
	    var barn			 = $.parseJSON('<?php echo addslashes(json_encode($barn)); ?>');
	    var statuslist		= $.parseJSON('<?php echo addslashes(json_encode($statuslist)); ?>');
	    var barnIndex        = '0';
		var stallIndex       = '0';
		
		$(function(){
			dateformat('#start_date, #end_date');
            fileupload([".image_file"], ['.image_input', '.image_source','.image_msg']);
			fileupload([".eventflyer_file"], ['.eventflyer_input', '.eventflyer_source','.eventflyer_msg']);
			fileupload([".stallmap_file"], ['.stallmap_input', '.stallmap_source','.stallmap_msg']);

			validation(
				'#form',
				{
					name 	     : {
						required	: 	true
					},
					description  : {	
						required	: 	true
					},
					location 	 : {
						required	: 	true
					},					
					mobile       : {
						required	: 	true,
						number      :   true
					},
					start_date   : {
						required	: 	true
					},
					end_date     : {
						required	: 	true
					},
					start_time   : {
						required	: 	true
					},
					end_time     : {
						required	: 	true
					},
					status        : {  
					    required	: 	true
					},
					barnvalidation : {
						required 	: true
					}
				}
			);
			
			if(barn.length > 0){
				$(barn).each(function(i, v){
					barndata(v);
				});
			}
		});
        
		$('.barnbtn').click(function(){
			barndata();
		});
		
		function barndata(result=[]){
			var barnId   	= result['id'] ? result['id'] : '';
			var barnName 	= result['name'] ? result['name'] : '';
			var stall		= result['stall'] ? result['stall'] : [];
				
			var data='\
			<div class="card barnspace">\
				<div class="card-header">\
					<h3 class="card-title">Barn</h3>\
					<div class="card-tools">\
					    <a href="javascript:void(0);" data-barnIndex="'+barnIndex+'" class="btn btn-info stallbtn">Add stall</a>\
						<a href="javascript:void(0);" class="btn btn-danger barnremovebtn">Remove</a>\
					</div>\
				</div>\
				<div class="card-body">\
					<div class="row">\
						<input type="hidden" name="barn['+barnIndex+'][id]" value="'+barnId+'">\
						<div class="col-md-12">\
							<div class="form-group">\
								<label>Barn Name</label>\
								<input type="text" id="barn'+barnIndex+'name" name="barn['+barnIndex+'][name]" class="form-control" placeholder="Enter Barn Name" value="'+barnName+'">\
							</div>\
						</div>\
			        	<div class="col-md-12 barn_wrapper_'+barnIndex+'"></div>\
					</div>\
				</div>\
			</div>\
			';
			
			$('#barnwrapper').append(data);
			$('.barnvalidation').val('1');
			$('.barnvalidation').valid();
			
			$(document).find('#barn'+barnIndex+'name').rules("add", {required: true, messages: {required: "Barn Name field is required."}});
			
			if(stall.length > 0){
				$(stall).each(function(i, v){
					stalldata(barnIndex, v)
				});
			}
			
			++barnIndex;
		}
		
		$(document).on('click', '.stallbtn', function(){
			stalldata($(this).attr('data-barnIndex'));
		});
		
		function stalldata(barnIndex, result=[])
		{
			var stallId      = result['id'] ? result['id'] : '';
			var stallName    = result['name'] ? result['name'] : '';
			var stallPrice   = result['price'] ? result['price'] : '';
			var stallStatus  = result['status'] ? result['status'] : '';

			var statusdata = '';
			$.each(statuslist, function(i, v){
				var selected = stallStatus==i ? 'selected' : '';
				statusdata += '<option value="'+i+'" '+selected+'>'+v+'</option>';
			})
			
			var data='\
			<div class="card stallsection">\
				<div class="card-header">\
					<h3 class="card-title">Stall</h3>\
					<div class="card-tools">\
						<a href="javascript:void(0);" class="btn btn-danger stallremovebtn">Remove</a>\
					</div>\
				</div>\
				<div class="card-body">\
					<div class="row">\
						<input type="hidden" name="barn['+barnIndex+'][stall]['+stallIndex+'][id]" value="'+stallId+'">\
						<div class="col-md-12">\
							<div class="form-group">\
								<label>Stall Name</label>\
								<input type="text" id="stall'+stallIndex+'name" name="barn['+barnIndex+'][stall]['+stallIndex+'][name]" class="form-control" placeholder="Enter Stall Name" value="'+stallName+'">\
							</div>\
						</div>\
						<div class="col-md-12">\
							<div class="form-group">\
								<label>Stall Price</label>\
								<input type="text" id="stall'+stallIndex+'price" name="barn['+barnIndex+'][stall]['+stallIndex+'][price]" class="form-control" placeholder="Enter Stall price" value="'+stallPrice+'">\
							</div>\
						</div>\
						<div class="col-md-12">\
							<div class="form-group">\
								<label>Status</label>\
								<select name="barn['+barnIndex+'][stall]['+stallIndex+'][status]" id="stall'+stallIndex+'status" class="form-control">'+statusdata+'</select>\
							</div>\
						</div>\
					</div>\
				</div>\
			</div>\
			';
			
			$(document).find('.barn_wrapper_'+barnIndex).append(data);
			
			$(document).find('#stall'+stallIndex+'name').rules("add", {required: true, messages: {required: "Stall Name field is required."}});
			$(document).find('#stall'+stallIndex+'price').rules("add", {required: true, messages: {required: "Stall Price field is required."}});
			$(document).find('#stall'+stallIndex+'status').rules("add", {required: true, messages: {required: "Stall Status field is required."}});
			++stallIndex;
		}
		
		$(document).on('click', '.barnremovebtn', function(){
		    $(this).parent().parent().parent().remove();
		});
		
		$(document).on('click', '.stallremovebtn', function(){
			$(this).parent().parent().parent().remove();
		})
	</script>
<?php $this->endSection(); ?>
