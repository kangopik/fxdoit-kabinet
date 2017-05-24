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
	
	<div class="container-fluid-content" style="padding: 600px 50px; margin-top: -485px;">
		<h2 class="sub-seo-headline">Copy Trading:In order to help traders with no experience and no time to gain stable profit, Forexware select institutions and personal trading masters to display their trading data. Traders can choose to copy their transactions to gain profit.</h2>
		<p class="subheading">
			Copy the method of QuantitativeMaster: Please contact online customer service or your account manager or send email <i>totrading@fx-central.com</i> Open the copy and read the rules carefully.
			<br/><br/>Rules:
			<br/><br/>1. Copying amount must be an integer multiple of $10,000.
			<br/><br/>2. On scheduled capital-guaranteed redemption dates, if you end your copying, same amount as your capital loss (if present) will be transferred to your MT4 account. Capital guarantee is valid for ending the copying after the 12-week lock-up period, and on scheduled dates in every 4 weeks since then.
			<br/><br/>3. In every 4-week period, 30% of your profit by copying CG Masters during that period, will be charged as performance fees.
			<br/><br/>4. When copying CG Masters, you are neither allowed to end or modify the copied trades, nor to withdraw the copying amount.
			<br/><br/>5. Leverage is fixed at 100. Modifying leverage is invalid for copying CG Masters.
		</p>
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
