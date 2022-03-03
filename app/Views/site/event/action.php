<?= $this->extend("site/common/layout/layout1") ?>

<?php $this->section('content') ?>
	<?php //echo '<pre>'; print_r($result); die();
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
		$status 				= isset($result['status']) ? $result['status'] : '';
		$eventflyer      		= isset($result['eventflyer']) ? $result['eventflyer'] : '';
		$eventflyer 			= filedata($eventflyer, base_url().'/assets/uploads/eventflyer/');
		$stallmap      			= isset($result['stallmap']) ? $result['stallmap'] : '';
		$stallmap 				= filedata($stallmap, base_url().'/assets/uploads/stallmap/');
		$pageaction 			= $id=='' ? 'Add' : 'Update';
		
		$barnstallvalue        =  (isset($barnstallvalue[0]['barnid_stallid']) && $barnstallvalue[0]['barnid_stallid']!="@-@") ? 
		                           array_filter($barnstallvalue) : [];
		$stallvalue            =  array();

		$file   = $image;
		$file 				    = filedata($image, base_url().'/assets/uploads/event/');
		// $file   = filedata($file, base_url().'/assets/site/img/', ['no_images']);
		if($file[0]!=''){
		$mediafile  = base_url().'/assets/uploads/event/'.$file[0];

		}else{
		$mediafile = $file[1];
		}
		
		if($eventflyer[0]!=''){
		$eventflyerfile  = base_url().'/assets/uploads/eventflyer/'.$eventflyer[0];

		}else{
		$eventflyerfile = $file[1];
		}

		if(isset($barnstallvalue[0]['barnid_stallid']) && $barnstallvalue[0]['barnid_stallid']!="@-@"){
			foreach($barnstallvalue as $stall){
				$value=explode('^',$stall['barnid_stallid']);
				foreach($value as $stallarray){
					$variable=explode('@-@',$stallarray);
					$stallmainarray=isset($variable[2]) ? explode(',',$variable[2]) : '';
					$stallvalue[$variable[0]]=$stallmainarray;
				}
			}
		}
	?>
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Events</h1>
				</div>
				<!-- <div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
						<li class="breadcrumb-item"><a href="<?php //echo getAdminUrl(); ?>/event">Events</a></li>
						<li class="breadcrumb-item active"><?php //echo $pageaction; ?> Event</li>
					</ol>
				</div> -->
			</div>
		</div>
	</section>
	
	<section class="content">
		<div class="page-action" align="right">
			<a href="<?php echo base_url(); ?>/events" class="btn btn-dark">Back</a>
		</div>
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"><?php echo $pageaction; ?> Event</h3>
			</div>
			<div class="card-body">
				<form method="post" id="form" action="<?php echo base_url(); ?>/addEvent" autocomplete="off">
					<input type="hidden" id="id" name="id" value="<?php echo $id;?>" >
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label><b>Name</b></label>								
									<input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="<?php echo $name; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><b>Event Description</b></label>
									<textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="3"><?php echo $description;?></textarea>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><b>Location</b></label>								
									<input type="text" name="location" class="form-control" id="location" placeholder="Enter Location" value="<?php echo $location; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><b>Mobile</b></label>								
									<input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter Mobile" value="<?php echo $mobile; ?>">								
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><b>Start Date</b></label>	
									<input type="text" class="form-control" name="start_date" value="<?php echo $start_date;?>" id="start_date">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><b>End Date</b></label>	
									<input type="text" class="form-control" name="end_date" value="<?php echo $end_date;?>" id="end_date">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><b>Start Time</b></label>	
									<input type="time" class="form-control" name="start_time" value="<?php echo $start_time;?>" id="start_time">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><b>End Time</b></label>	
									<input type="time" class="form-control" name="end_time" value="<?php echo $end_time;?>" id="end_time">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><b>Stalls Price</b></label>								
									<input type="text" name="stalls_price" class="form-control" id="stalls_price" placeholder="Enter Stalls Price" value="<?php echo $stalls_price;?>">								
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><b>RV Spots Price</b></label>								
									<input type="text" name="rvspots_price" class="form-control" id="rvspots_price" placeholder="Enter RV Spots Price" value="<?php echo $rvspots_price;?>">								
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><b>Event Image</b></label>			
									<div>
										<a href="<?php echo $mediafile; ?>" target="_blank">
											<img src="<?php echo $mediafile; ?>" class="image_source" width="100">
										</a>
									</div>
									<input type="file" id="file" name="file" class="image_file">
									<span class="image_msg messagenotify"></span>
									<input type="hidden" id="image" name="image" class="image_input" value="<?php echo $file[0];?>">
								</div>
							</div>							
							<!-- <div class="col-md-12">
								<div class="form-group">
									<label>Status</label>								
									
								</div>
							</div> -->
							<div class="col-md-6">
								<div class="form-group">
									<label><b>Event Flyer</b></label>			
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
							<div class="col-md-6">
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
							<input type="hidden" id="current_barn_id" name="current_barn_id">
							<div class="col-md-6"></div>
                            <div class="col-md-6 main_wrapper">
                            	<!--Barn part-->
                            	<?php $i=0; foreach($barnList as $res1){ 
                            		$barn_id = $res1['id'];
                            		?>
                            	<div class="card barnspace">                
        <div class="card-header">                   
            <h3 class="card-title">Barn</h3>                    
                <div class="card-tools">                        
                    <a href="javascript:void(0);" data-eventid="41" title="Add Stall for Barn#" data-stallcount="1" data-barnindex="0" data-barnid="" id="barn_wrap_" class="btn btn-info stallbtn">Add stall</a>                       
                    <a href="javascript:void(0);" data-barnid="0" class="btn btn-danger barnremovebtn">Remove</a>                   
                </div>              
        </div>              
        <div class="card-body">                 
            <div class="row">                       
                <input type="hidden" name="barn[<?php echo $i;?>][id]" value="<?php echo $barn_id;?>">                       
                <input type="hidden" name="barn[<?php echo $i;?>][event_id]" value="<?php echo $id;?>">                       
                <div class="col-md-12">                         
                    <div class="form-group">                         
                        <label>Barn Name</label>                                
                        <input type="text" id="barn0name" name="barn[<?php echo $i;?>][name]" class="form-control" placeholder="Enter Barn Name" value="<?php echo $res1['name']; ?>">            
                    </div>                      
                </div>
                <?php $j=0;
                foreach($stallList[$barn_id] as $col){
                	//echo '<pre>'; print_r($col); die();
                ?>                      
            <div class="col-md-12 barn_wrapper_0">          
                <div class="card stallsection">             
                    <div class="card-header">                   
                        <h3 class="card-title">Stall</h3>                   
                        <div class="card-tools">                        
                            <a href="javascript:void(0);" class="btn btn-danger stallremovebtn">Remove</a>                  
                        </div>              
                    </div>              
                    <div class="card-body">                 
                        <div class="row">                       
                            <input type="hidden" name="barn[<?php echo $i;?>][stall][<?php echo $j;?>][id]" value="<?php echo $col['id'];?>">                     
                            <div class="col-md-12">                         
                                <div class="form-group">                                
                                    <label>Stall Name</label>                               
                                    <input type="text" id="stall0name" name="barn[<?php echo $i;?>][stall][<?php echo $j;?>][name]" class="form-control" placeholder="Enter Stall Name" value="<?php echo $col['name'];?>">                         
                                </div>                      
                            </div>                      
                            <div class="col-md-12">                         
                                <div class="form-group">                                
                                    <label>Stall Price</label>                              
                                    <input type="text" id="stall0price" name="barn[<?php echo $i;?>][stall][<?php echo $j;?>][price]" class="form-control" placeholder="Enter Stall price" value="<?php echo $col['price'];?>">                          
                                </div>                      
                            </div>                      
                            <div class="col-md-12">                         
                                <div class="form-group">                                
                                    <label>Status</label>   
                                        <select name="barn[<?php echo $i;?>][stall][<?php echo $j;?>][status]" id="stall0status" class="form-control">                                
                                            <option value="">Select Status </option>                   
                                            <option <?php if($col['status']=='1'){ echo 'selected';}?> value="1"> Enable </option>                     
                                            <option <?php if($col['status']=='2'){ echo 'selected';}?> value="2"> Disable </option>
                                        </select>                           
                                </div>                      
                            </div>                  
                        </div>             
                    </div>          
                </div>          
            </div>      
            <?php $j++; } ?>            
        </div>             
    </div>          
</div>
					    	<?php $i++; } ?>
                            	<!--Barn part-->
                            </div>	
                            <br>						
							<div class="col-md-12">
								<input type="hidden" name="actionid" value="<?php echo $id; ?>">
								<input type="submit" class="btn btn-danger" value="Submit">
								<a href="<?php echo base_url(); ?>/event" class="btn btn-dark">Back</a>
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
	
	    var eventId    	     = '<?php echo $id; ?>';
		var barnStallvalue   = $.parseJSON('<?php echo addslashes(json_encode($barnstallvalue)); ?>');
		var Stallvalue       = $.parseJSON('<?php echo addslashes(json_encode($stallvalue)); ?>');
	    var barnIndex        = '0';
		var stallIndex       = '0';
		
		$(function(){
			//dateformat('#start_date, #end_date');
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
					}
				}
			);
			
			$(barnStallvalue).each(function(i, v){
				var barnparams = v['barnid_stallid'].split('^');
				$(barnparams).each(function(i, v){
					var databarn=v.split('@-@');
					barndata(databarn);
					stalldata(barnIndex, values=[])
				});
			});
		});
        
		$('.barnbtn').click(function(){
			barndata();
		});
		
		function barndata(values=[]){
			
			var barnId   = (values[0] ? values[0] : '');
			var barnName = (values[1] ? values[1] : '');
			
			var data='\
			<div class="card barnspace">\
				<div class="card-header">\
					<h3 class="card-title">Barn</h3>\
					<div class="card-tools">\
					    <a href="javascript:void(0);" data-eventid="'+eventId+'" title="Add Stall for Barn#'+barnId+'" data-stallcount="1" data-barnIndex="'+barnIndex+'" data-barnid="'+barnId+'" id="barn_wrap_'+barnId+'" class="btn btn-info stallbtn">Add stall</a>\
						<a href="javascript:void(0);" data-barnid='+barnIndex+' class="btn btn-danger barnremovebtn">Remove</a>\
					</div>\
				</div>\
				<div class="card-body">\
					<div class="row">\
						<input type="hidden" name="barn['+barnIndex+'][id]" value="'+barnId+'">\
						<input type="hidden" name="barn['+barnIndex+'][event_id]" value="'+eventId+'">\
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
			
			$('.main_wrapper').append(data);
			$('.barnvalidation').val('1');
			$('.barnvalidation').valid();
			
			$(document).find('#barn'+barnIndex+'name').rules("add", {required: true, messages: {required: "Barn Name field is required."}});
			++barnIndex;
		}
		
		$(document).on('click', '.stallbtn', function(){
			stalldata($(this).attr('data-barnIndex'));
		});
		
		function stalldata(barnIndex, values=[])
		{
			var stallId      = (values[0] ? values[0] : '');
			var stallName    = (values[2] ? values[2] : ''); 
			var stallPrice   = (values[3] ? values[3] : '');
			var stallStatus  = (values[4] ? values[4] : '');

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
								<label>Status</label>\	<select name="barn['+barnIndex+'][stall]['+stallIndex+'][status]" id="stall'+stallIndex+'status" class="form-control">\
								<option value="">Select Status</option>\
								<option value="1">Enable</option>\
								<option value="2">Disable</option>\
								</select>\
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

