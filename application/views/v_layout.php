<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('vd_pages/v_head') ?>
</head>
<body>
	<!--[if lt IE 7]>
    	<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    
	<?php 
		$view_data['page'] =  $page ;
		$this->load->view('vd_pages/v_header',$view_data) 
	?>
	<!--
	<div class="container-fluid-content" style="">
		<div id="mt5">
			<a href="/en/blog/mt5-cqg-gateway/">MT5 - CQG Gateway</a>
		</div>
	</div> -->
	<div class="container-fluid-content" style="padding: 100px 50px; ">
	<div class="row-content" style="min-height: 600px;">
	<div id="mt5">
			<a href="/en/blog/mt5-cqg-gateway/">MT5 - CQG Gateway</a>
		</div>
		<h1 class="page-header blue left">Welcome to FxDoit.com !</h1>	
		<div class="col-sm-12 col-md-12">
			<div class="col-sm-6 col-md-6">
				<h2 class="sub-seo-headline">Find Best Forex Investment</h2>
			</div>
			<div class="col-sm-6 col-md-6">
				<h2 class="sub-seo-headline">Try Our Robot for FREE!!</h2>
				<p class="subheading">
				You can try to use our Robot for FREE, just open an account and deposit in FxDoit.
				</p>
			</div>
			
		</div>

		
		

		
		
	</div>
		
	</div>


	<?php  $this->load->view('vd_pages/v_footer') ?>	
	
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/js/navigation.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/jquery.bootstrap-autohidingnavbar.js"></script>	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/jquery.bootstrap-dropdown-hover.js"></script>
	<script type="text/javascript">
		$('.navbar [data-toggle="dropdown"]').bootstrapDropdownHover();
    	$("div.navbar-fixed-top").autoHidingNavbar();
    </script>	
 </body>
</html>