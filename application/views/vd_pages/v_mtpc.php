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
	
	<div class="container-fluid-content" style="padding: 900px 50px; margin-top: -785px;">
		<div id="mt5">
			<a href="/en/blog/mt5-cqg-gateway/">MT5 - CQG Gateway</a>
		</div>
		<h2 class="product-xlarge-heading">PLATFORMS</h2>
		<h1 class="master-headline">MetaTrader 4 Trading and Back Office Systems That Are Easy To Use</h1>
		<ul class="platform-navigation">
			<li><a href="<?php echo base_url() ?>cd_pages/C_xwt">XW Trader</a></li>
			<li><a href="<?php echo base_url() ?>cd_pages/C_xwm">XW Trader Mobile</a></li>
			<li><a href="#" style="color: #f59331;">MetaTrader 4</a></li>
		</ul>
		<div class="mbr-section row">
			<div class="mbr-table-md-up">
				<div class="mbr-table-cell col-md-5 content-size text-xs-center">
					<h2 class="platforms-sub-seo-headline">MetaTrader 4 Trading Platform with MT4 Bridge</h2>
					<p class="platforms-subheading">
						Forexware offers an MT4 white label platform and Forexware's MT4 Bridge that passes both market data (i.e. quotes) 
						and trading data (i.e. trade executions) between MT4 and Forexware servers. Our MT4 Bridge allows for real time trade 
						execution, reduced slippage, interfacing with back office systems, and access to liquidity through Forexware's pricing engine. 
					</p>
				</div>
				<div class="mbr-table-cell mbr-valign-top mbr-left-padding-md-up col-md-7 image-size" style="width: 40%">
					<div class="mbr-figure">
						<img src="<?php echo base_url()?>assets/img/xwplatformsiconlarge.png" class="">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-4">
				<div class="mbr-figure">
					<img src="<?php echo base_url()?>assets/img/metatraderfourscreen.png" class="">
				</div>
			</div>
			<div class="col-md-4">
				<div class="mbr-figure">
					<img src="<?php echo base_url()?>assets/img/metatraderfourlogo.png" class="">
				</div>
				<p style="text-align: center; font-size: 16px;">Click for more screenshots.</p>
				<div class="col-md-12">
					<div class="col-md-6 mbr-figure" style="width: 50%">
						<a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url()?>assets/img/large_mt1.jpg">
		                    <img class="img-responsive" alt="" src="<?php echo base_url()?>assets/img/large_mt1.jpg" />
		                </a>
					</div>
					<div class="col-md-6 mbr-figure" style="width: 50%">
						<a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url()?>assets/img/large_mt2.jpg">
		                    <img class="img-responsive" alt="" src="<?php echo base_url()?>assets/img/large_mt2.jpg" />
		                </a>
					</div>
				</div>
				<div class="col-md-12">
				&nbsp;
				</div>
				<div class="col-md-12">
					<div class="col-md-6 mbr-figure" style="width: 50%">
						<a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url()?>assets/img/large_mt3.jpg">
		                    <img class="img-responsive" alt="" src="<?php echo base_url()?>assets/img/large_mt3.jpg" />
		                </a>
					</div>
					<div class="col-md-6 mbr-figure" style="width: 50%">
					</div>
				</div>
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<h2 class="platforms-section-headline">KEY BENEFITS</h2>
		<div class="col-md-12">
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Access multi-leveled aggregated liquidity pools for STP or accumulated trades</p>
			</div>
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Execute the best bid/offer from the world's top-tiered liquidity sources, including banks and ECNs, guaranteeing the best possible liquidity in the market</p>
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Trade confirmations are displayed automatically between liquidity flows and order management systems</p>
			</div>
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Quotes are aggregated with the best market prices into a single real-time stream</p>
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Customizable liquidity streams, liquidity bridge, FIX API access and real-time price aggregation along with an array of reporting and automated risk management tools</p>
			</div>
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
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
    <script type="text/javascript">
    $(document).ready(function(){
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });
    </script>
</body>
</html>
