<style>
.loader_wrapper{
	position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
	background: rgba(0,0,0,0.5);
}

.loader_wrapper img{
	width: 120px;
    position: relative;
    top: 50%;
    left: 50%;
    transform: translate(-200px, -200px);
}
</style>
<div class="loader_wrapper"><img src="<?php echo base_url()."/assets/site/img/loading.gif"; ?>"></div>
<script>
	window.parent.top.postMessage('3DS-authentication-complete');
</script>