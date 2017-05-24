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
	
	<div class="container-fluid-content" style="padding: 1250px 50px; margin-top: -1135px;">
		<div id="mt5">
			<a href="/en/blog/mt5-cqg-gateway/">MT5 - CQG Gateway</a>
		</div>
		<h2 class="product-xlarge-heading">PLATFORMS</h2>
		<h1 class="master-headline">Get The Most With Our Platform</h1>
		<ul class="platform-navigation">
			<li><a href="#" style="color: #f59331;">XW Trader</a></li>
			<li><a href="<?php echo base_url() ?>cd_pages/C_xwm">XW Trader Mobile</a></li>
			<li><a href="<?php echo base_url() ?>cd_pages/C_mtpc">MetaTrader 4</a></li>
		</ul>
		<div class="mbr-section row">
			<div class="mbr-table-md-up">
				<div class="mbr-table-cell col-md-5 content-size text-xs-center">
					<h2 class="platforms-sub-seo-headline">XW Trader, A Fully Customizable White Label FX Trading Platform</h2>
					<p class="platforms-subheading">
						Forexware's XW Trader provides brokerages with an easy to use, flexible and fully customizable white-label platform. 
						Our system is fully integrated with all major social trading platforms and our back-end technology is optimized to support 
						their trading style where thousands of clients can trade at the same time on the exact same currency. 
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
					<img src="<?php echo base_url()?>assets/img/xwtraderscreen.png" class="">
				</div>
			</div>
			<div class="col-md-4">
				<div class="mbr-figure">
					<img src="<?php echo base_url()?>assets/img/xwtraderlogo.png" class="">
				</div>
				<p style="text-align: center; font-size: 16px;">Click for more screenshots.</p>
				<div class="col-md-12">
					<div class="col-md-6 mbr-figure" style="width: 50%">
						<a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url()?>assets/img/large_XWTrader_1.jpg">
		                    <img class="img-responsive" alt="" src="<?php echo base_url()?>assets/img/large_XWTrader_1.jpg" />
		                </a>
					</div>
					<div class="col-md-6 mbr-figure" style="width: 50%">
						<a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url()?>assets/img/large_XWTrader_2.jpg">
		                    <img class="img-responsive" alt="" src="<?php echo base_url()?>assets/img/large_XWTrader_2.jpg" />
		                </a>
					</div>
				</div>
				<div class="col-md-12">
				&nbsp;
				</div>
				<div class="col-md-12">
					<div class="col-md-6 mbr-figure" style="width: 50%">
						<a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url()?>assets/img/large_XWTrader_3.jpg">
		                    <img class="img-responsive" alt="" src="<?php echo base_url()?>assets/img/large_XWTrader_3.jpg" />
		                </a>
					</div>
					<div class="col-md-6 mbr-figure" style="width: 50%">
						<a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url()?>assets/img/large_XWTrader_4.jpg">
		                    <img class="img-responsive" alt="" src="<?php echo base_url()?>assets/img/large_XWTrader_4.jpg" />
		                </a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<h2 class="platforms-section-headline">KEY BENEFITS</h2>
		<div class="col-md-12">
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Chart Based Trading</p>
				<p class="desc">Customizable indicators such as: moving average, stochastics, RSI, and many more</p>
			</div>
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Full Online Reporting Access On:</p>
				<p class="desc">
					Pending Orders and Positions<br />
					Trading History<br />
					Account Statements<br />
					Account Summaries<br />
					P&L<br />
					Margin Levels<br />
				</p>
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-4">
				<p class="secondary-list-item-strong">One-Click Trading</p>
			</div>
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Integrated with Social Trading Platforms</p>
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Order Types Include:</p>
				<p class="desc">Market, limit, stop loss, trailing stop, OCO</p>
			</div>
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Easily Customizable</p>
				<p class="desc">
					Switch between color pallets, adjust order settings
				</p>
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-4">
				<p class="secondary-list-item-strong">News Panel and Live Market Data</p>
			</div>
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Online Training &#38; Support</p>
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Algo Console Allows You To:</p>
				<p class="desc">
					Choose your own trading strategies and algorithms<br />
					Review scripts to make changes or updates in the Script Editor<br />
					Algo Wizard to back test various strategies</p>
			</div>
			<div class="col-md-4">
				<p class="secondary-list-item-strong">MAM / PAM integration</p>
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Advanced Charting Tools</p>
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
