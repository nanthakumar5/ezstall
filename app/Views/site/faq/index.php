<?= $this->extend("site/common/layout/layout1") ?>
<?php $this->section('content') ?>
<section class="maxWidth">
	<div class="pageInfo">
		<span class="marFive">
			<a href="/">Home /</a>
			<a href="javascript:void(0);"> Aboutus</a>
		</span>
	</div>

	<div class="container px-5 my-5">
		<div class="accordion" id="accordionFlush">
			<div class="accordion-item">
				<h2 class="accordion-header" id="flush-headingOne">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">Is online payment is safe ?
					</button>
				</h2>
				<div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlush">
					<div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the class. This is the first item's accordion body.</div>
				</div>
			</div>
			<div class="accordion-item">
				<h2 class="accordion-header" id="flush-headingTwo">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">How to buy a stall ?
					</button>
				</h2>
				<div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlush">
					<div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
				</div>
			</div>
			<div class="accordion-item">
				<h2 class="accordion-header" id="flush-headingThree">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
						How to buy barn ?
					</button>
				</h2>
				<div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlush">
					<div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container px-5 my-5 col-md-6 text-center">
		<p class="h3 fw-bold">Still have questions ?</p>
		<p>If you still have any enquries, please contact us and write a message with us. We will clarify your valuable questions and we will upload here to help others.</p>
		<a class="faq-c-link" href="<?php echo base_url() ?>/contactus">Contact Us</a>
	</div>

</section>
<?php $this->endSection(); ?>
