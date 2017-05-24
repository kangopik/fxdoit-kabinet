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
	
	<div class="container-fluid-content" style="padding: 1400px 50px; margin-top: -1285px;">
		<div id="mt5">
			<a href="/en/blog/mt5-cqg-gateway/">MT5 - CQG Gateway</a>
		</div>
		<div class="col-md-12">
			<div class="col-md-9">
				<h1 class="master-headline">YOU GET THE CLIENTS, WE'LL HANDLE THE REST</h1>
				<h2 class="secondary-headline">A PROVEN TRACK RECORD</h2>
			</div>
			<div class="col-md-3">
				<strong class="bold-number">99.99%</strong>
				<h2 class="highlight">systems uptime and availability</h2>
			</div>
		</div>		
		<div class="col-md-12">
			<div class="col-md-9">
				<p class="subheading">
					Forexware develops FX trading software and enterprise solutions to FX retail brokers, banks, financial institutions 
					and money managers worldwide. We provide clients with an integrated suite of three primary modules: back-end data 
					management, front-end trading platforms, and a dealing desk module that includes risk management, liquidity aggregation 
					and quote management software. Connectivity and systems integration services are part of our product offering, including 
					FIX and Java-based APIs and MT4 Bridge technology. 
				</p>
			</div>
			<div class="col-md-3">
				<strong class="bold-number">200k</strong>
				<h2 class="highlight">tickets executed daily</h2>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-9">
				<h2 class="section-headline">What our clients are saying</h2>
				<blockquote class="quote">
					<span class="large-quo">"</span>Forexware has demonstrated an openness and commitment to understanding our local business dynamics and market position, which has further helped us develop and strengthen our relationship together.<br clear="all">
					<span class="credit"><strong class="double-line">//</strong><span class="padded">CIO of a global FX brokerage</span></span>
				</blockquote>
				<blockquote class="quote">
					<span class="large-quo">"</span>...the greatest value to us was Forexware's ability to help us distinguish which issues we need to tackle are of greatest importance. They helped us produce a pragmatic and grounded action plan that our entire leadership team is committed to achieve.<br clear="all">
					<span class="credit"><strong class="double-line">//</strong><span class="padded">Executive of Asia Sales Division, FX Technology and Support, a global FX brokerage</span></span>
				</blockquote>
				<blockquote class="quote">
					<span class="large-quo">"</span>Because our business goals and objectives are aligned, they're able to help us by introducing their resources, expertise and technology to grow our bottom line. <br clear="all">
					<span class="credit"><strong class="double-line">//</strong><span class="padded">Head of FX Dealer Desk, major financial services company</span></span>
				</blockquote>
			</div>
			<div class="col-md-3">
				<strong class="bold-number">2.7bil</strong>
				<h2 class="highlight">USD avg daily volume</h2>
				<strong class="bold-number">5mil</strong>
				<h2 class="highlight">top of book available liquidity</h2>
				<strong class="bold-number">&#60;2wks</strong>
				<h2 class="highlight">fully operational for FXStarterKit&#8482; clients</h2>
				<strong class="bold-number">$0</strong>
				<h2 class="highlight">cost for FXStarterKit*<br /><sub>*excludes MT4 white label</sub></h2>
			</div>
		</div>
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