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
		<h1 class="page-header blue left">IB Program</h1>
		<h2 class="sub-seo-headline">Why Forexware ?</h2>
		<h2 class="sub-seo-headline">Exclusive equity plan:</h2>
		<p class="subheading">
			Forexware will provide equity rewards of our company for each IB who join us. IB will become a member of 
			Forexware and share achievements with Forexware.
		</p>
		<h2 class="sub-seo-headline">Unique career support program for IB:</h2>
		<p class="subheading">
			Forexware will provide outstanding IB with career development fund for free; to set up a company for broker 
			and provide office space ,even help IB to pay off salaries. All of this will be given gratis, IB will be free 
			to get a company of his own and gain all profit of the company.
		</p>
		<h2 class="sub-seo-headline">High commission return scheme:</h2>
		<p class="subheading">
			Forexwareprovide IB with highly competitive bonus scheme.
		</p>
		<h2 class="sub-seo-headline">Forexware will grow with you together</h2>
		<p class="subheading">
			Whether you just take IB as an extra job or as an independent business, we can cooperate. There are different 
			groups who have brokerage business cooperation with us, such as teachers, accountants, real estate consultant, 
			financial advisers, professional online brokers and investors, we share interests every month.
		</p>
		<h2 class="sub-seo-headline">Perfect background service:</h2>
		<p class="subheading">
			IB can focus on developing and maintaining customers. Forexware headquarters responsible for handing customer 
			accounts, fund access, transfer and other problems.
		</p>
		<h2 class="sub-seo-headline">Targeted marketing program:</h2>
		<p class="subheading">
			Forexware will provide IB with perfect assistance to development clients. No matter marketing techniques or methods, 
			Forexware has a complete system for IB, by which IB can have more advantages and develop clients more quickly.
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
