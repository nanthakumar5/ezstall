<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<?php $userid = getSiteUserID(); ?>

<div class="dFlexComBetween eventTP flex-wrap">
<h2 class="fw-bold mb-4">Current Reservation</h2>
<div class="flex-row-reverse bd-highlight"> 
 <input type="text" placeholder="Search By Name" class="searchEvent bookedby" id="bookedby" value="" />
</div>
</div>
<section class="maxWidth eventPagePanel">
  <?php  
    foreach ($bookings as $data) {           
  ?>
            <div class="dashboard-box">
              <div class="EventFlex leftdata">
                <div class="wi-30 row w-100 align-items-center">
                  <div class="col-md-2">
                    <div>
                      <p class="mb-0 text-sm fs-7 fw-600">Name</p></td>
                      <p class="mb-0 fs-7"><?php echo $data['firstname'].$data['lastname'];?></p></td>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div>
                      <p class="mb-0 fs-7 fw-600">Booked Event</p>
                      <p class="mb-0 fs-7"><?php echo $data['eventname'];?> (
                        <?php 
                          foreach ($data['barnstall'] as $stalls) {
                                echo $stalls['stallname'];
                          }
                        ?>)
                      </p>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div>
                      <p class="mb-0 fs-7 fw-600">CheckIn - CheckOut</p>
                      <p class="mb-0 fs-7"><?php echo date("d-m-Y", strtotime($data['check_in']));?> - <?php echo date("d-m-Y", strtotime($data['check_out']));?></p>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div>
                      <p class="mb-0 fs-7 fw-600">Booked By</p>
                      <p class="mb-0 fs-7"><?php echo $usertype[$data['usertype']]; ?></p>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="d-flex justify-content-end">
                     <a href="<?php echo base_url().'/myaccount/bookings/view/'.$data['id']; ?>" class="view-res">View</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        <?php } ?>
  </section>

<?php echo $pager; ?>
<?php $this->endSection(); ?>
<?php $this->section('js') ?>
<script>
  var baseurl = "<?php echo base_url(); ?>";

 $(document).ready(function() {
     $("#bookedby").autocomplete({
        source: function(request, response) {
          ajax(baseurl+'/myaccount/searchbookeduser', {search: request.term}, {
            success: function(result) {
                    response(result);
                }
          });
        },
        html: true, 
        select: function(event, ui) {
          var name = ui.item.firstname+ui.item.lastname
          $('#bookedby').val(name); 
            window.location.href = baseurl+'/myaccount/bookings/view/'+ui.item.id;
            return false;
        },
        focus: function(event, ui) {
            $("#bookedby").val(name);
            return false;
        }
    })
      .autocomplete("instance")
      ._renderItem = function( ul, item ) {
        var name = item.firstname+item.lastname
      return $( "<li><div>"+name+"</div></li>" ).appendTo( ul );
      };
});
</script>
<?php $this->endSection(); ?>
