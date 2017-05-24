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
	
	<div class="container-fluid-content" style="padding: 200px 50px; margin-top: -85px;">
		<h1 class="page-header blue left">Apply for IB</h1>
		<h2 class="sub-seo-headline">Brokerage department contact information:</h2>
		<p class="subheading">
			If you intend to become an IB of Forexware or want to know more information, 
			you can contact us through online customer service or send an E-mail to us. <br /><br />
			Forexware brokerage department E-mail: ib@nbfmarkets.com (global, multi language) <br /><br />
			Introducing Brokers(IB) plan can help investors and companies get bonus by introducing new customers to Forexware.
		</p>
		<h2 class="sub-seo-headline">
			Forexware’s unique equity incentive plan and IB business support program will be the best choice 
			for all the brokers who want to explore customer resources, develop business and increase revenue
		</h2>
	</div>	

	<?php $this->load->view('vd_pages/v_footer') ?>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/jquery.bootstrap-autohidingnavbar.js"></script>	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/jquery.bootstrap-dropdown-hover.js"></script>
	<script>
		$('.navbar [data-toggle="dropdown"]').bootstrapDropdownHover();
    	$("div.navbar-fixed-top").autoHidingNavbar();
    </script>
</body>
</html>
