<?= $this->extend("site/common/layout/layout1") ?>
<?php $this->section('content') ?>
<section class="maxWidth">
	<div class="pageInfo">
		<span class="marFive">
			<a href="/">Home /</a>
			<a href="javascript:void(0);"> Aboutus</a>
		</span>
	</div>

	<div class="about-banner text-center my-5">
		<p class="mb-2 h3 fw-bold">About Us</p>
		<p class="col-md-6 mx-auto">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consuuntur magn dolores eos qui ratione voluptatem sequi nesciunt.</p>
	</div>

	<div class="wi-1200">
		<div class="row d-flex justify-content-between">
			<div class="col-md-5 beforeRound">
				<img class="about-img" src="<?php echo base_url();?>/assets/site/img/What.png" />
			</div>
			<div class="col-md-6 afterHorse">
				<p class="commonContent mt-0">
					Our mission is to connect horses with stalls! Whether you're a
					rodeo athlete, dressage enthusiast, or trail riding adventurer;
					our goal is to identify the facilities you can keep your horses
					while on the road. <br /><br />
					Our goal is to identify the facilities you can keep your horses
					while on the road.Sed ut perspits unde onis iste naus error sit vuatem accantium
					doloeque lauantium.
				</p>
			</div>
		</div>

		<div class="row d-flex justify-content-between flexReverse my-5">
			<div class="col-md-6">
				<p class="commonContent mt-0">
					Sed ut perspits unde onis iste naus error sit vuatem accantium
					doloeque lauantium, totam rem aperiam, eaqe ipsa que ab illo
					intore veitatis et quasi architecto beatae vitae dicta sunt
					explicabo.<br /><br>
					Our mission is to connect horses with stalls! Whether you're a
					rodeo athlete, dressage enthusiast, or trail riding adventurer;
					our goal is to identify the facilities you can keep your horses
					while on the road.
				</p>
			</div>
			<div class="col-md-5 afterRound">
				<img class="about-img" src="<?php echo base_url();?>/assets/site/img/Who.png" />
			</div>
		</div>
	</div>
</section>
<?php $this->endSection(); ?>
