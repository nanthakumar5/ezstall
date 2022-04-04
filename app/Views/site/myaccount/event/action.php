<?php $this->extend("site/common/layout/layout1") ?>

<?php $this->section('content') ?>
<?php
	$id 					= isset($result['id']) ? $result['id'] : '';
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
	$bulkstallimage			= filedata('', '');
	$barn        			= isset($result['barn']) ? $result['barn'] : [];
	$pageaction 			= $id=='' ? 'Add' : 'Update';
?>
	
	
<section class="content">
	<div class="d-flex justify-content-between align-items-center flex-wrap">
		<div align="left" class="m-0"><h3>Events</h3></div>
		<div class="page-action mb-4 m-0" align="right">
			<a href="<?php echo base_url(); ?>/myaccount/events" class="btn btn-dark">Back</a>
		</div>
	</div>
	<div class="card">
		<div class="card-header w-100">
			<h3 class="card-title"><?php echo $pageaction; ?> Event</h3>
		</div>
		<div class="card-body">
			<form method="post" id="form" action="" autocomplete="off">
				<input type="hidden" id="id" name="id" value="<?php echo $id;?>" >
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 my-2">
							<div class="form-group">
								<label>Name</label>								
								<input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="<?php echo $name; ?>">
							</div>
						</div>
						<div class="col-md-6 my-2">
							<div class="form-group">
								<label>Location</label>								
								<input type="text" name="location" class="form-control" id="location" placeholder="Enter Location" value="<?php echo $location; ?>">
							</div>
						</div>
						<div class="col-md-6 my-2">
							<div class="form-group">
								<label>Mobile</label>								
								<input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter Mobile" value="<?php echo $mobile; ?>">								
							</div>
						</div>
						<div class="col-md-6 my-2">
							<div class="form-group">
								<label>Start Date</label>	
								<input type="text" class="form-control" name="start_date" value="<?php echo $start_date;?>" id="start_date">
							</div>
						</div>
						<div class="col-md-6 my-2">
							<div class="form-group">
								<label>End Date</label>	
								<input type="text" class="form-control" name="end_date" value="<?php echo $end_date;?>" id="end_date">
							</div>
						</div>
						<div class="col-md-6 my-2">
							<div class="form-group">
								<label>Start Time</label>	
								<input type="time" class="form-control" name="start_time" value="<?php echo $start_time;?>" id="start_time">
							</div>
						</div>
						<div class="col-md-6 my-2">
							<div class="form-group">
								<label>End Time</label>	
								<input type="time" class="form-control" name="end_time" value="<?php echo $end_time;?>" id="end_time">
							</div>
						</div>
						<div class="col-md-6 my-2">
							<div class="form-group">
								<label>Stalls Price</label>								
								<input type="text" name="stalls_price" class="form-control" id="stalls_price" placeholder="Enter Stalls Price" value="<?php echo $stalls_price;?>">								
							</div>
						</div>
						<div class="col-md-6 my-2">
							<div class="form-group">
								<label>RV Spots Price</label>								
								<input type="text" name="rvspots_price" class="form-control" id="rvspots_price" placeholder="Enter RV Spots Price" value="<?php echo $rvspots_price;?>">								
							</div>
						</div>
						<div class="col-md-6 my-2">
							<div class="form-group">
								<label>Event Description</label>
								<textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="3"><?php echo $description;?></textarea>
							</div>
						</div>
						<div class="col-md-6 my-2">
							<div class="form-group">
								<label>Event Image</label>			
								<div>
									<a href="<?php echo $image[1];?>" target="_blank">
										<img src="<?php echo $image[1];?>" class="image_source" width="100">
									</a>
								</div>
								<input type="file" id="file" name="file" class="image_file">
								<span class="image_msg messagenotify"></span>
								<input type="hidden" id="image" name="image" class="image_input" value="<?php echo $image[0];?>">
							</div>
						</div>							
						<div class="col-md-6 my-2">
							<div class="form-group">
								<label>Event Flyer</label>			
								<div>
									<a href="<?php echo $eventflyer[1];?>" target="_blank">
										<img src="<?php echo $eventflyer[1];?>" class="eventflyer_source" width="100">
									</a>
								</div>
								<input type="file" id="" name="" class="eventflyer_file">
								<span class="eventflyer_msg messagenotify"></span>
								<input type="hidden" id="eventflyer" name="eventflyer" class="eventflyer_input" value="<?php echo $eventflyer[0];?>">
							</div>
						</div>
						<div class="col-md-6 my-2">
							<div class="form-group">
								<label>Stall Map (optional)</label>			
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
						<div class="col-md-6 barn_wrapper"><br>
							<a href="javascript:void(0);" class="btn btn-info barnbtn mb-3">Add Barn</a>
							<input type="hidden" value="" name="barnvalidation" class="barnvalidation">
						</div>	
						<div class="col-md-6 barn_wrapper"><br>
							<a href="javascript:void(0);" class="btn btn-info bulkbarnbtn mb-3">Add Bulk Barn</a>

<!--  					 <button type="submit" name="bulkbarn"><a href="<?php //echo base_url().'/myaccount/events/add/addbulkbarn' ?>" class="btn btn-info bulkbarnbtn mb-3">Add Bulk Barn</a></button>
 -->
						</div>

						<div id="barnwrapper"></div>
						<div class="col-md-12 mt-4">
							<input type="hidden" name="actionid" value="<?php echo $id; ?>">
							<input type="hidden" name="userid" value="<?php echo $userid; ?>">
							<input type="submit" id ="eventSubmit" class="btn btn-danger" value="Submit">
							<a href="<?php echo base_url(); ?>/myaccount/events" class="btn btn-dark">Back</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<!-- Barn and stall Tabs start -->

	<div class="container row mt-5 dash-barn-style">
		<div class="row align-items-center mb-4 p-0">
			<div class="col-md-2">
				<p class="fs-2 fw-bold mb-0">Barn</p>
			</div>
			<div class="col-md-10 t-right p-0">
				<button class="btn-stall">Add stall</button>
				<button class="btn-stall">Add bulk stall</button>
				<button class="btn-stall">Remove</button>
			</div>
		</div>
		
		<!-- Nav pills -->
		<ul class="nav nav-pills flex-column col-md-3" role="tablist">
			<li class="nav-item text-center mb-3">
				<a class="nav-link tab-link active" data-bs-toggle="pill" href="#tab1">
					Barn 1
				</a>
			</li>
			<li class="nav-item text-center mb-3">
				<a class="nav-link tab-link" data-bs-toggle="pill" href="#tab2">
					Barn 2
				</a>
			</li>
			<li class="nav-item text-center mb-3">
				<a class="nav-link tab-link" data-bs-toggle="pill" href="#tab3">
					Barn 3
				</a>
			</li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content col-md-9">
			<div id="tab1" class="container tab-pane active p-0 mb-3">
				<div class="row mb-2 dash-stall-base">
					<div class="col-md-7 mb-3">
						<input type="text" name="stall_name" class="form-control" placeholder="Stall name">
					</div>
					<div class="col-md-2 mb-3">
						<input type="text" name="stall_price" class="form-control" placeholder="Price">
					</div>
					<div class="col-md-2 mb-3">
						<button class="dash-upload" title="Upload image here">Upload</button>
					</div>
					<div class="col-md-1 mb-3">
						<a href="#" class="dash-stall-remove"><i class="fas fa-times text-white"></i></a>
					</div>
				</div>
				<div class="row mb-2 dash-stall-base">
					<div class="col-md-7 mb-3">
						<input type="text" name="stall_name" class="form-control" placeholder="Stall name">
					</div>
					<div class="col-md-2 mb-3">
						<input type="text" name="stall_price" class="form-control" placeholder="Price">
					</div>
					<div class="col-md-2 mb-3">
						<button class="dash-upload" title="Upload image here">Upload</button>
					</div>
					<div class="col-md-1 mb-3">
						<a href="#" class="dash-stall-remove"><i class="fas fa-times text-white"></i></a>
					</div>
				</div>
				<div class="row mb-2 dash-stall-base">
					<div class="col-md-7 mb-3">
						<input type="text" name="stall_name" class="form-control" placeholder="Stall name">
					</div>
					<div class="col-md-2 mb-3">
						<input type="text" name="stall_price" class="form-control" placeholder="Price">
					</div>
					<div class="col-md-2 mb-3">
						<button class="dash-upload" title="Upload image here">Upload</button>
					</div>
					<div class="col-md-1 mb-3">
						<a href="#" class="dash-stall-remove"><i class="fas fa-times text-white"></i></a>
					</div>
				</div>
				<div class="row mb-2 dash-stall-base">
					<div class="col-md-7 mb-3">
						<input type="text" name="stall_name" class="form-control" placeholder="Stall name">
					</div>
					<div class="col-md-2 mb-3">
						<input type="text" name="stall_price" class="form-control" placeholder="Price">
					</div>
					<div class="col-md-2 mb-3">
						<button class="dash-upload" title="Upload image here">Upload</button>
					</div>
					<div class="col-md-1 mb-3">
						<a href="#" class="dash-stall-remove"><i class="fas fa-times text-white"></i></a>
					</div>
				</div>
				<div class="row mb-2 dash-stall-base">
					<div class="col-md-7 mb-3">
						<input type="text" name="stall_name" class="form-control" placeholder="Stall name">
					</div>
					<div class="col-md-2 mb-3">
						<input type="text" name="stall_price" class="form-control" placeholder="Price">
					</div>
					<div class="col-md-2 mb-3">
						<button class="dash-upload" title="Upload image here">Upload</button>
					</div>
					<div class="col-md-1 mb-3">
						<a href="#" class="dash-stall-remove"><i class="fas fa-times text-white"></i></a>
					</div>
				</div>
			</div>
			<div id="tab2" class="container tab-pane fade p-0 mb-3">
				<div class="row mb-2 dash-stall-base">
					<div class="col-md-7 mb-3">
						<input type="text" name="stall_name" class="form-control" placeholder="Stall name">
					</div>
					<div class="col-md-2 mb-3">
						<input type="text" name="stall_price" class="form-control" placeholder="Price">
					</div>
					<div class="col-md-2 mb-3">
						<button class="dash-upload" title="Upload image here">Upload</button>
					</div>
					<div class="col-md-1 mb-3">
						<a href="#" class="dash-stall-remove"><i class="fas fa-times text-white"></i></a>
					</div>
				</div>

				<div class="row mb-2 dash-stall-base">
					<div class="col-md-7 mb-3">
						<input type="text" name="stall_name" class="form-control" placeholder="Stall name">
					</div>
					<div class="col-md-2 mb-3">
						<input type="text" name="stall_price" class="form-control" placeholder="Price">
					</div>
					<div class="col-md-2 mb-3">
						<button class="dash-upload" title="Upload image here">Upload</button>
					</div>
					<div class="col-md-1 mb-3">
						<a href="#" class="dash-stall-remove"><i class="fas fa-times text-white"></i></a>
					</div>
				</div>
			</div>
			<div id="tab3" class="container tab-pane fade p-0 mb-3">
				<div class="row mb-2 dash-stall-base">
					<div class="col-md-7 mb-3">
						<input type="text" name="stall_name" class="form-control" placeholder="Stall name">
					</div>
					<div class="col-md-2 mb-3">
						<input type="text" name="stall_price" class="form-control" placeholder="Price">
					</div>
					<div class="col-md-2 mb-3">
						<button class="dash-upload" title="Upload image here">Upload</button>
					</div>
					<div class="col-md-1 mb-3">
						<a href="#" class="dash-stall-remove"><i class="fas fa-times text-white"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Barn and stall Tabs end -->

	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Stall</h4>
					<button type="button" class="close" data-bs-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="col-md-12 my-2">
						<div class="form-group">
							<label>Stall Name</label>
							<input type="text" id="stall_name" class="form-control" placeholder="Enter Stall Name">
						</div>
					</div>
					<div class="col-md-12 my-2">
						<div class="form-group">
							<label>Stall Price</label>
							<input type="text" id="stall_price" class="form-control" placeholder="Enter Stall Name">
						</div>
					</div>
					<div class="col-md-6 my-2">
						<div class="form-group">
							<label>Stall Image</label>			
							<div>
								<a href="<?php echo $bulkstallimage[1];?>" target="_blank">
									<img src="<?php echo $bulkstallimage[1];?>" class="stall_source" width="100">
								</a>
							</div>
							<input type="file" class="stall_file">
							<span class="stall_msg"></span>
							<input type="hidden" id="stall_image" class="stall_input" value="<?php echo $bulkstallimage[0];?>">
						</div>
					</div>	
					<div class="col-md-12 my-2">
						<div class="form-group">
							<label>Status</label>
							<?php echo form_dropdown('bulkstallstatus', $statuslist, '1', ['id' => 'stall_status', 'class' => 'form-control']); ?>
						</div>
					</div>
					<div class="col-md-12 my-2">
						<div class="form-group">
							<label>Total Number of Columns</label>
							<input type="number" id="stall"  name="stall" class="form-control" placeholder="Enter Stall Name" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<inpu type="hidden" id="barnIndexValue" name="barnIndexValue" value="0">
					<button type="button"class="btn btn-info bulkstallbtn">Submit</button>
					<button type="button"class="btn btn-info " data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</section>
	
 

<?php $this->endSection(); ?>

<?php $this->section('js') ?>
	<script>
	    var barn			 = $.parseJSON('<?php echo addslashes(json_encode($barn)); ?>'); 
	    var statuslist		 = $.parseJSON('<?php echo addslashes(json_encode($statuslist)); ?>');
	    var barnIndex        = '0';
		var stallIndex       = '0';
		
		$(function(){
			dateformat('#start_date, #end_date');
            fileupload([".image_file"], ['.image_input', '.image_source','.image_msg']);
			fileupload([".eventflyer_file"], ['.eventflyer_input', '.eventflyer_source','.eventflyer_msg']);
			fileupload([".stallmap_file"], ['.stallmap_input', '.stallmap_source','.stallmap_msg']);
			fileupload([".stall_file"], ['.stall_input', '.stall_source','.stall_msg']);

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

		$('.bulkbarnbtn').click(function(){
			bulkbarndata();
		});

		function barndata(result=[]){ 
			var barnId   	= result['id'] ? result['id'] : '';
			var barnName 	= result['name'] ? result['name'] : '';
			var stall		= result['stall'] ? result['stall'] : [];
				
			var data='\
			<div class="card barnspace mt-4">\
				<div class="card-header">\
					<h3 class="card-title">Barn</h3>\
					<div class="card-tools">\
					    <a href="javascript:void(0);" data-barnIndex="'+barnIndex+'" class="btn btn-info stallbtn">Add stall</a>\
					    <button type="button" class="btn btn-info " data-barnIndex="'+barnIndex+'" data-bs-toggle="modal" data-bs-target="#myModal" id="addbulkstallbtn">Add bulk stall</button>\
						<a href="javascript:void(0);" class="btn btn-danger barnremovebtn">Remove</a>\
					</div>\
				</div>\
				<div class="card-body">\
					<div class="row">\
						<input type="hidden" name="barn['+barnIndex+'][id]" value="'+barnId+'">\
						<div class="col-md-12 mb-4">\
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

		function bulkbarndata(result=[]){ 
			var barnId   	= result['id'] ? result['id'] : '';
			var barnName 	= result['name'] ? result['name'] : '';
			var stall		= result['stall'] ? result['stall'] : [];
			
			var data='\
			<div class="mb-3">\
					<label for="bulkbarn" class="form-label">Choose your file:</label>\
					<input class="form-control bulkbarn" type="file" id="bulkbarn">\
			</div>';
			$('#barnwrapper').append(data);

		}
		
		$(document).on('click', '.stallbtn', function(){ 
			stalldata($(this).attr('data-barnIndex'));
		});
		
		$('#myModal').on('shown.bs.modal', function (e) {
			$('#stall_name, #stall_price, #stall_image, #stall_file').val('');
			$('#stall_status').val('1');
			$('#stall_source').attr('src', '<?php echo base_url()?>/assets/images/upload.png');
			$('#stall_source').parent().attr('href', '<?php echo base_url()?>/assets/images/upload.png');
		})
		
		$('.bulkstallbtn').click(function(){
			if($('#stall').val()==''){
				$('#stall').focus();
				return false;
			}
			
			var name          = $('#stall_name').val();
			var price         = $('#stall_price').val();
			var status        = $('#stall_status').val();
			var image         = $('#stall_image').val();
			var stallcount    = $('#stall').val();
			var barnIndex     = $('#barnIndexValue').val();
			
			for(var i=0; i<stallcount; i++){ 
				stalldata(barnIndex, {name:name,price:price,status:status,bulkimage:image});
			}
			
			$('#myModal').modal('hide');
		});
		
		function stalldata(barnIndex, result=[])
		{  
			var stallId       		= result['id'] ? result['id'] : '';
			var stallName     		= result['name'] ? result['name'] : '';
			var stallPrice    		= result['price'] ? result['price'] : '';
			var stallStatus   		= result['status'] ? result['status'] : '';
			var stallImage    		= result['image'] ? result['image'] : '';
			var stallBulkImage    	= result['bulkimage'] ? result['bulkimage'] : '';
			if(stallImage!='' && stallBulkImage==''){
				var stallImages   	= '<?php echo base_url()?>/assets/uploads/stall/'+stallImage;
			}else if(stallBulkImage!=''){
				var stallImages   	= '<?php echo base_url()?>/assets/uploads/temp/'+stallBulkImage;
			}else{
				var stallImages   	= '<?php echo base_url()?>/assets/images/upload.png';
			}
			
			var statusdata = '';
			$.each(statuslist, function(i, v){
				var selected = stallStatus==i ? 'selected' : '';
				statusdata += '<option value="'+i+'" '+selected+'>'+v+'</option>';
			})

			var data='\
			<div class="card stallsection mt-4">\
				<div class="card-header">\
					<h3 class="card-title">Stall</h3>\
					<div class="card-tools">\
						<a href="javascript:void(0);" class="btn btn-danger stallremovebtn">Remove</a>\
					</div>\
				</div>\
				<div class="card-body">\
					<div class="row">\
						<input type="hidden" name="barn['+barnIndex+'][stall]['+stallIndex+'][id]" value="'+stallId+'">\
						<div class="col-md-12 my-2">\
							<div class="form-group">\
								<label>Stall Name</label>\
								<input type="text" id="stall'+stallIndex+'name" name="barn['+barnIndex+'][stall]['+stallIndex+'][name]" class="form-control" placeholder="Enter Stall Name" value="'+stallName+'">\
							</div>\
						</div>\
						<div class="col-md-12 my-2">\
							<div class="form-group">\
								<label>Stall Price</label>\
								<input type="text" id="stall'+stallIndex+'price" name="barn['+barnIndex+'][stall]['+stallIndex+'][price]" class="form-control" placeholder="Enter Stall price" value="'+stallPrice+'">\
							</div>\
						</div>\
						<div class="col-md-6 my-2">\
							<div class="form-group">\
								<label>Stall Image</label>\
								<div>\
									<a href="'+stallImages+'" target="_blank">\
										<img src="'+stallImages+'"  class="stall_image_source'+stallIndex+'" width="100">\
									</a>\
								</div>\
								<input type="file" class="stall_image_file'+stallIndex+'" >\
								<span class="stall_image_msg'+stallIndex+'"></span>\
								<input type="hidden" name="barn['+barnIndex+'][stall]['+stallIndex+'][image]" class="stall_image_input'+stallIndex+'" value="'+stallImage+'">\
							</div>\
						</div>\
						<div class="col-md-12 my-2">\
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
			
			fileupload([".stall_image_file"+stallIndex], [".stall_image_input"+stallIndex, ".stall_image_source"+stallIndex,".stall_image_msg"+stallIndex]);
			
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

		$(document).on('click','#addbulkstallbtn', function () {
	        $('#barnIndexValue').val($(this).attr('data-barnIndex'));
	    });
		$(document).on('click','#eventSubmit', function () {
			
			if ($('#bulkbarn').get(0).files.length !== 0) {
			    console.log("Files selected.");
			$.ajax({
	        type: "POST",
	        url: "<?php echo base_url();?>/myaccount/events/add/import",
	        success: function (res) {
	            alert('saas');
	        }
    	});
			}
			else{
			    console.log("No files selected.");
			}
	    });
	</script>
<?php $this->endSection(); ?>

