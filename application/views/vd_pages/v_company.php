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
	
	<div class="container-fluid-content" style="padding: 300px 50px; margin-top: -185px;">
		<h1 class="page-header blue left">Company Information</h1>		
		<h2 class="sub-seo-headline">About Us</h2>
		<p class="subheading">
			Forexware is registered by Australian Securities and Investment Commission (ASIC) (Registration No. AFSL305539).<br /><br />
			Forexware is a world-leading financial derivatives trading service provider. Forexware is committed to provide the most comprehensive clearing and trading execution services for the professionals, institutions, hedge funds across 5 continents in more than 130 countries, and to provide customers with the best financial investment solutions. When you open an account with Forexware, you not only trade, you Trade Up-to quicker connections, superior service and competitive pricing.
		</p>
		<h2 class="sub-seo-headline">Our Responsibility</h2>
		<p class="subheading">
			Forexwares mission is to provide institutional trading services for all customers, whether they are institutional clients or individual investors, to provide them with innovative proprietary technology, low cost trading, safety supervision of funds, comprehensive market research tools, advanced education courses and first-class customer service.<br/><br/>
			Through the cooperation of liquidation with the world&#8217;s famous bank, Forexware provide worldwide users with the safest, the quickest and the lowest cost of online trading solutions on foreign exchange and precious metal.
		</p>
		<h2 class="sub-seo-headline">Capacity and Prospects</h2>
		<p class="subheading">
			Through years of efforts, the contracts Forexware have cleared for institutional and individual investors is more than $100 billion. By constantly providing excellent service to customers, our company scale and business will keep growing. The market share of our company has received a significant boost and has been among the ranks of important foreign exchange brokers.<br /><br />
			With outstanding qualifications, Forexware will provide intermediary service and brokerage business of matchmaking transactions for global customers of multilingual in more than 100 countries( including financial institutions, industrial enterprises, asset management companies, professional traders and private investors).
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
