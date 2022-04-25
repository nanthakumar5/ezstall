<?php $this->extend('site/common/layout/layout1') ?>
<?php $this->section('content') ?>
<div class="page-action mb-4 m-0" align="left">
	<a href="<?php echo base_url(); ?>/myaccount/facility" class="btn btn-dark">Back</a>
</div>
<section class="container-lg">
	<div class="row">
		<div class="col-12">
			<div class="border rounded pt-5 ps-3 pe-3">
				<div class="row">
					<div class="col-6">
					<h4 class="checkout-fw-6"><?php echo $detail['name'] ?></h4>
					</div>
				</div>
			</div>
				<?php 
					$tabbtn = '';
					$tabcontent = '';
					foreach ($detail['barn'] as $barnkey => $barndata) {
						$barnid = $barndata['id'];
						$barnname = $barndata['name'];
						$barnactive = $barnkey=='0' ? ' show active' : '';
						$tabbtn .= '<button class="nav-link'.$barnactive.'" data-bs-toggle="tab" data-bs-target="#barn'.$barnid.'" type="button" role="tab" aria-controls="barn'.$barnid.'" aria-selected="true">'.$barnname.'</button>';
					
						$tabcontent .= '<div class="tab-pane fade'.$barnactive.'" id="barn'.$barnid.'" role="tabpanel" aria-labelledby="nav-home-tab">
											<ul class="list-group">';
						foreach($barndata['stall'] as $stalldata){
							$boxcolor  = 'green-box';
							if(in_array($stalldata['id'], $occupied)){
								$boxcolor  = 'red-box';
							}elseif(in_array($stalldata['id'], array_keys($reserved))){
								$boxcolor  = 'yellow-box';
							}
							
							$tabcontent .= 	'<li class="list-group-item">
							'.$stalldata['name'].'
							<span class="'.$boxcolor.' stall-avail stallavailability" data-stallid="'.$stalldata['id'].'" ></span>
							</li>';
						}
						$tabcontent .= '</ul></div>';
					}
				?>
				<div class="barn-nav mt-4">
					<nav>
						<div class="nav nav-tabs mb-4" id="nav-tab" role="tablist">
							<?php echo $tabbtn; ?>
						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<?php echo $tabcontent; ?>
						<div class="row">
							<div class="btm-color">
								<p><span class="green-circle"></span>Available</p>
								<p><span class="yellow-circle"></span>Reserved</p>
								<p><span class="red-circle"></span>Occupied</p>
							</div>
						</div>
					</div>    
				</div>
		</div>
	</div>
</section>
<?php $this->endSection() ?>