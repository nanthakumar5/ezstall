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
						<div class="col-md-12 my-2">
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
						<div class="col-md-12 my-2">
							<div class="form-group">
								<label>Event Description</label>
								<textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="3"><?php echo $description;?></textarea>
							</div>
						</div>
						<div class="col-md-4 my-2">
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
						<div class="col-md-4 my-2">
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
						<div class="col-md-4 my-2">
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
					</div>
					
					<div class="container row mt-5 dash-barn-style mx-auto">
						<div class="row align-items-center mb-4 p-0">
							<div class="col-md-2">
								<p class="fs-2 fw-bold mb-0">Barn</p>
							</div>
							<div class="col-md-10 t-right p-0">
								<a href="javascript:void(0);" class="btn btn-info addbulkbarnbtn">Add Bulk Barn</a>
								<input type="file" class="bulkbarnfile" style="display:none;">
								<button class="btn-stall barnbtn">Add Barn</button>
							</div>
						</div>
						<input type="hidden" value="" name="barnvalidation" class="barnvalidation">
						<ul class="nav nav-pills flex-column col-md-3 barntab" role="tablist"></ul>
						<div class="tab-content col-md-9 stalltab"></div>
					</div>
					<div class="col-md-12 mt-4">
						<input type="hidden" name="actionid" value="<?php echo $id; ?>">
						<input type="hidden" name="userid" value="<?php echo $userid; ?>">
						<input type="submit" id ="eventSubmit" class="btn btn-danger" value="Submit">
						<a href="<?php echo base_url(); ?>/myaccount/events" class="btn btn-dark">Back</a>
					</div>
				</div>
			</form>

		</div>
	</div>

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
							<label>Price</label>
							<input type="text" id="stall_price" class="form-control" placeholder="Enter Price">
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
							<label>Total Number of Columns</label>
							<input type="number" id="stall"  name="stall" class="form-control" placeholder="Enter Stall Name" min="1" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="barnIndexValue" name="barnIndexValue" value="0">
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
			},
			{
				ignore : []
			}
		);


		if(barn.length > 0){
			$(barn).each(function(i, v){
				barndata(v);
			});
		}
	});

	$('.barnbtn').click(function(e){
		e.preventDefault();
		barndata([], 1);
	});

	function barndata(result=[], type=''){ 
		var barnId   	= result['id'] ? result['id'] : '';
		var barnName 	= result['name'] ? result['name'] : '';
		var stall		= result['stall'] ? result['stall'] : [];
		
		var activeclass = barnIndex=='0' ? 'active' : '';
		
		var barntab='\
			<li class="nav-item text-center mb-3">\
				<a class="nav-link tab-link '+activeclass+'" data-bs-toggle="pill" data-bs-target="#barnstall'+barnIndex+'">\
					<span class="barnametext">'+(barnName=='' ? 'Barn' : barnName)+'</span>\
					<input type="text" id="barn'+barnIndex+'name" name="barn['+barnIndex+'][name]" class="form-control barnnametextbox" placeholder="Enter Barn Name" value="'+barnName+'" style="display:none;">\
				</a>\
				<input type="hidden" name="barn['+barnIndex+'][id]" value="'+barnId+'">\
			</li>\
		';
		
		var stalltab = '\
			<div id="barnstall'+barnIndex+'" class="container tab-pane p-0 mb-3 barn_wrapper_'+barnIndex+' '+activeclass+'">\
				<div class="col-md-10 p-0 my-3 stallbtns">\
					<button class="btn-stall stallbtn" data-barnIndex="'+barnIndex+'" >Add Stall</button>\
					<button class="btn-stall" data-barnIndex="'+barnIndex+'" data-bs-toggle="modal" data-bs-target="#myModal" id="addbulkstallbtn">Add Bulk Stall</button>\
					<button class="btn-stall barnremovebtn">Remove Barn and Stall</button>\
				</div>\
			</div>\
		';

		$('.barntab').append(barntab);
		$('.stalltab').append(stalltab);
		$('.barnvalidation').val('1');
		$('.barnvalidation').valid();

		$(document).find('#barn'+barnIndex+'name').rules("add", {required: true, messages: {required: "Barn Name field is required."}});

		if(stall.length > 0){
			$(stall).each(function(i, v){
				stalldata(barnIndex, v)
			});
		}
		
		if(type=='1') stalldata(barnIndex);
		++barnIndex;
		
		$(document).find('.barntab li a').on('show.bs.tab', function(e){
			 setTimeout(function () { barntext() }, 10);
		});
	}

	$(document).on('click', '.stallbtn', function(e){ 
		e.preventDefault();
		stalldata($(this).attr('data-barnIndex'));
	});
	
	function stalldata(barnIndex, result=[])
	{  
		var stallId       		= result['id'] ? result['id'] : '';
		var stallName     		= result['name'] ? result['name'] : '';
		var stallPrice    		= result['price'] ? result['price'] : '';
		var stallImage    		= result['image'] ? result['image'] : '';
		var stallBulkImage    	= result['bulkimage'] ? result['bulkimage'] : '';
		if(stallImage!='' && stallBulkImage==''){
			var stallImages   	= '<?php echo base_url()?>/assets/uploads/stall/'+stallImage;
		}else if(stallBulkImage!=''){
			var stallImages   	= '<?php echo base_url()?>/assets/uploads/temp/'+stallBulkImage;
		}else{
			var stallImages   	= '<?php echo base_url()?>/assets/images/upload.png';
		}

		var data='\
		<div class="row mb-2 dash-stall-base">\
			<div class="col-md-6 mb-3">\
				<input type="text" id="stall'+stallIndex+'name" name="barn['+barnIndex+'][stall]['+stallIndex+'][name]" class="form-control  fs-7" placeholder="Stall Name" value="'+stallName+'">\
			</div>\
			<div class="col-md-2 mb-3">\
				<input type="text" id="stall'+stallIndex+'price" name="barn['+barnIndex+'][stall]['+stallIndex+'][price]" class="form-control fs-7" placeholder="Price" value="'+stallPrice+'">\
			</div>\
			<div class="col-md-3 mb-3">\
				<a href="'+stallImages+'" target="_blank">\
					<img src="'+stallImages+'"  class="stall_image_source'+stallIndex+'" width="40" height="35">\
				</a>\
				<button class="dash-upload fs-7" title="Upload image here">Upload</button>\
				<input type="file" class="stallimage stall_image_file'+stallIndex+'" style="display:none;">\
				<span class="stall_image_msg'+stallIndex+'"></span>\
				<input type="hidden" name="barn['+barnIndex+'][stall]['+stallIndex+'][image]" class="stall_image_input'+stallIndex+'" value="'+stallImage+'">\
			</div>\
			<div class="col-md-1 mb-3">\
				<input type="hidden" name="barn['+barnIndex+'][stall]['+stallIndex+'][id]" value="'+stallId+'">\
				<input type="hidden" name="barn['+barnIndex+'][stall]['+stallIndex+'][status]" value="1">\
				<a href="javascript:void(0);" class="dash-stall-remove fs-7 stallremovebtn"><i class="fas fa-times text-white"></i></a>\
			</div>\
		</div>\
		';

		$(document).find('.barn_wrapper_'+barnIndex).find('.stallbtns').before(data); 

		fileupload([".stall_image_file"+stallIndex], [".stall_image_input"+stallIndex, ".stall_image_source"+stallIndex, ".stall_image_msg"+stallIndex]);

		$(document).find('#stall'+stallIndex+'name').rules("add", {required: true, messages: {required: "Stall Name field is required."}});
		$(document).find('#stall'+stallIndex+'price').rules("add", {required: true, messages: {required: "Price field is required."}});
		++stallIndex;
	}
	
	function barntext(){
		$(document).find('.barntab li').each(function(){
			if($(this).find('.tab-link').hasClass('active')){
				$(this).find('.tab-link .barnametext').hide();
				$(this).find('.tab-link .barnnametextbox').show();
			}else{
				$(this).find('.tab-link .barnametext').show();
				$(this).find('.tab-link .barnnametextbox').hide();
			}
			
			if($(this).find('.tab-link .barnnametextbox').val()!=''){
				$(this).find('.tab-link .barnametext').text($(this).find('.tab-link .barnnametextbox').val());
			}
		})
	}
		
	$(document).on('click','.dash-upload', function (e) {
		e.preventDefault();
		$(this).parent().find('.stallimage').click();
	});
	
	$(document).on('click', '.barnremovebtn', function(e){
		e.preventDefault();
		var stalltabparent = $(this).parent().parent();
		$(document).find('[data-bs-target="#'+stalltabparent.attr('id')+'"]').parent().remove();
		stalltabparent.remove();
		
		$(document).find('.barntab li:first a').addClass('active');
		$(document).find('.stalltab div:first').addClass('active');
		
		$(document).find('.barntab li a').on('show.bs.tab', function(e){
			 setTimeout(function () { barntext() }, 10);
		});
	});

	$(document).on('click', '.stallremovebtn', function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
	})

	$('#myModal').on('shown.bs.modal', function (e) {
		$('#stall_name, #stall_price, #stall_image, #stall_file, #stall').val('');
		$('#stall_status').val('1');
		$('.stall_source').attr('src', '<?php echo base_url()?>/assets/images/upload.png');
		$('.stall_source').parent().attr('href', '<?php echo base_url()?>/assets/images/upload.png');
	})

	$(document).on('click','#addbulkstallbtn', function (e) {
		e.preventDefault();
		$('#barnIndexValue').val($(this).attr('data-barnIndex'));
	});

	$('.bulkstallbtn').click(function(e){
		e.preventDefault();
		if($('#stall').val()==''){
			$('#stall').focus();
			return false;
		}

		var name          = $('#stall_name').val();
		var price         = $('#stall_price').val();
		var image         = $('#stall_image').val();
		var stallcount    = $('#stall').val();
		var barnIndex     = $('#barnIndexValue').val();

		for(var i=0; i<stallcount; i++){ 
			stalldata(barnIndex, {name:name,price:price,status:1,bulkimage:image});
		}

		$('#myModal').modal('hide');
	});
	
	$(document).on('click','.addbulkbarnbtn', function () {
		$('.bulkbarnfile').click();
	});

	$(document).on('change','.bulkbarnfile', function () {
  		var formdata = new FormData();
		formdata.append('file', $(this)[0].files[0]); 
		
		ajax(
			'<?php echo base_url(); ?>/myaccount/events/importbarnstall', 
			formdata, 
			{
				contenttype : 1,
				processdata : 1,
				success: function(result) {
					$(result).each(function(i, v){
						barndata(v)
					})
				}
			}
		);
	});
</script>
<?php $this->endSection(); ?>

