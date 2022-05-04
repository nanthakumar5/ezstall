<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<?php 
// print_r($details);
// exit;
?>
 <div class="infoPanel stallform container-lg">
    <span class="infoSection">
        <span class="iconProperty">
            <input type="text" placeholder="Location">
            <img src="<?php echo base_url()?>/assets/site/img/location.svg" class="iconPlace" alt="Map Icon">
        </span>
        <span class="iconProperty">
            <input type="text" placeholder="Check-In">
            <img src="<?php echo base_url()?>/assets/site/img/calendar.svg" class="iconPlace" alt="Calendar Icon">
        </span>
        <span class="iconProperty">
            <input type="text" placeholder="Check-Out">
            <img src="<?php echo base_url()?>/assets/site/img/calendar.svg" class="iconPlace" alt="Calendar Icon">
        </span>
        <input type="text" placeholder="No.of stalls">
        <span class="searchResult">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" class="searchIcon" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                <path d="M456.69 421.39L362.6 327.3a173.81 173.81 0 0034.84-104.58C397.44 126.38 319.06 48 222.72 48S48 126.38 48 222.72s78.38 174.72 174.72 174.72A173.81 173.81 0 00327.3 362.6l94.09 94.09a25 25 0 0035.3-35.3zM97.92 222.72a124.8 124.8 0 11124.8 124.8 124.95 124.95 0 01-124.8-124.8z">
                </path>
            </svg>
        </span>
    </span>
</div>
            <div class="container-lg"> 
                <div class="row">
                <div class="stalldetail-banner mt-4 mb-5">
                    <img src="<?php echo base_url() ?>/assets/uploads/stallmap/<?php echo $detail['image']?>">
                </div>
                </div>
             </div>
             <section class="container-lg">
                 <div class="row">
                     <div class="col-lg-8">
                        <div class="stall-head">
                                <div class="float-start">
                                    <img src="<?php echo base_url() ?>/assets/site/img/stallhead.png">
                                </div>
                                <div class="float-next">
                                    <h4 class="fw-bold">Excepteur sint occaecat</h4>
                                    <p>Ocala, FL, United States</p>
                                </div>
                        </div>
                        <div class="stall-description">
                            <h4 class="fw-bold">Description</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <p>
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloreme laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                            </p>
                        </div>
                        <div class="stall-riding">
                            <h4 class="fw-bold">Riding Disciplines</h4>
                            <ul>
                                <li>Ut pharetra sem vehicula pulvinar bibendum.</li>
                                <li>Aenean convallis turpis nec turpis consequat aliquam.</li>
                                <li>In ullamcorper velit lobortis quam pretium, et malesuada dolor rutrum.</li>
                                <li>Fusce quis mauris vitae metus mattis convallis sed at nulla.</li>
                            </ul>
                        </div>
                        <div class="stall-cancel">
                            <h4 class="fw-bold">Cancellation Policy</h4>
                            <p>Quis autem vel eum iure reprehenderit qui in ea volute velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.</p>
                        </div>
                     </div>
                     <div class="col-lg-4">
                        <div class="stall-right">
                            <div class="stall-price">
                                <b>$15</b> per day
                            </div>
                            <div class="choose-stall-date">
                                <p class="fw-bold">Dates</p>
                                <div class="col-md-12 col-md-12 px-3">
                                    <div class="mb-3">
                                        <label>Check In</label>-
                                        <input type="text" name="startdate" id="startdate" class ="checkdate checkin form-control" autocomplete = "off" placeholder = "Check-In"/>                                   
                                    </div>
                                    <div class="mb-3">
                                        <label>Check Out</label>-
                                        <input type="text" name="enddate" id="enddate" class = "checkdate checkout form-control" autocomplete = "off" placeholder = "Check-Out"/>                       
                                    </div>
                                </div>
                            </div>
                            <div class="stall-date" style="display: none;">
                                <p class="fw-bold">Dates</p>                                 
                                <p class="float-left" id="startdatetxt" ></p> - <p class="float-end" id="enddatetxt"></p>
                            </div>
                            <div class="stall-total" style="display: none;">
                                <p class="float-start fw-bold tot">Total</p>
                                <!-- <p class="float-end  fw-bold" id="stallfees" >$30.00<span class="redcolor">Fees</span></p> -->
                            </div>
                             <div class="stall-points" style="display: none;">
                                <ul>
                                    <li>You can cancel at any point of time.</li>
                                    <li>You will not be charged without your approval.</li>
                                </ul>
                            </div> 
                            <div class="stall-msg" style="display: none;">
                               <p class="text-center">You cannot book!.</p>
                            </div>
                            <div class="stall-btn">
                                <button class="stalldetail-btn" id="checkavailability">Check Availability</button>
                            </div>
                            <div class="book-now" style="display: none;">
                                <button class="stallbooknow-btn"  id="bookstall"><a href ="<?php echo base_url().'/checkout'?>">Book Now</a></button>
                            </div>
                        </div>
                     </div>
                 </div>
             </section>

<?php $this->endSection() ?>

<?php $this->section('js') ?>
<script> 

var eventid = '<?php echo $detail["event_id"]; ?>';
var currencysymbol = '<?php echo $currencysymbol; ?>';

	$(document).ready(function (){

		uidatepicker(
			'#startdate', 
			{ 
                dateFormat : 'mm-dd-yy',
			    'close'    : function(selecteddate){
					var date = new Date(selecteddate)
					date.setDate(date.getDate() + 1);
					$("#enddate").datepicker( "option", "minDate", date );
				}
			}
		);

		uidatepicker('#enddate', { dateFormat: 'mm-dd-yy' });
	});

    $( "#checkavailability" ).on( "click", function() {

		setTimeout(function(){
			var startdate 	= $("#startdate").val(); 
			var enddate   	= $("#enddate").val(); 
      
			if(startdate!='' && enddate!=''){
                var dt1 = new Date(startdate);
                var dt2 = new Date(enddate);
                var time_difference = dt2.getTime() - dt1.getTime();
                var datediff        = time_difference / (1000 * 60 * 60 * 24);
                var totalfees       = datediff * 15;
                var stallamount     = currencysymbol+totalfees
                var amounthtml ='<p class="float-end  fw-bold" id="stallfees">'+stallamount+'<span class="redcolor">Fees</span></p>';

                $(".choose-stall-date").css("display", "none");
                $(".stall-date").css("display", "block");
                $(".stall-total").css("display", "block");
                $(".stall-points").css("display", "block");
                $(".book-now").css("display", "block");

                $('#startdatetxt').append(startdate);
                $('#enddatetxt').append(enddate);
                $(amounthtml).insertAfter('.tot');

				occupiedreserved(startdate, enddate);
			}
		}, 100);
	
    });

    function occupiedreserved(startdate, enddate){

        ajax(
			'<?php echo base_url()."/ajax/ajaxoccupied"; ?>',
			{ eventid : eventid, checkin : startdate, checkout : enddate },
			{
				success : function(data){
                    if (data == undefined || data == null || data.length == 0 || (data.length == 1 && data[0] == "")){
                       $(".stall-total").css("display", "none");
                       $("#bookstall").css("display", "none");
                       $(".stall-msg").css("display", "none");
                    }

				}
			}
		)
        ajax(
			'<?php echo base_url()."/ajax/ajaxreserved"; ?>',
			{ eventid : eventid, checkin : startdate, checkout : enddate },
			{
				asynchronous : 1,
				success : function(data){
                    if (data == undefined || data == null || data.length == 0 || (data.length == 1 && data[0] == "")){
                       $(".stall-total").css("display", "none");
                       $("#bookstall").css("display", "none");
                       $(".stall-msg").css("display", "none");
                    }

				}
			}
		)
	}


</script>

<?php echo $this->endSection() ?>