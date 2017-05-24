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
		<h1 class="master-headline">Trade From Anywhere With Our Mobile FX Platforms</h1>
		<ul class="platform-navigation">
			<li><a href="<?php echo base_url() ?>cd_pages/C_xwt">XW Trader</a></li>
			<li><a href="#" style="color: #f59331;">XW Trader Mobile</a></li>
			<li><a href="<?php echo base_url() ?>cd_pages/C_mtpc">MetaTrader 4</a></li>
		</ul>
		<div class="mbr-section row">
			<div class="mbr-table-md-up">
				<div class="mbr-table-cell col-md-5 content-size text-xs-center">
					<h2 class="platforms-sub-seo-headline">XW Trader Mobile Is Built For Traders On-The-Go</h2>
					<p class="platforms-subheading">
						With integration across desktop accounts, your customers can place orders and manage positions with speed and 
						security anytime, anywhere.<br /><br />
						The XW Trader Mobile offers on-the-go trading capabilities with a variety of analytical options and graphical 
						displays for viewing quotes, trade execution and complete trade account management.<br /><br />
						For iPhone, iPad and iPod Touch. 
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
					<img src="<?php echo base_url()?>assets/img/xwtradermobilescreen.png" class="">
				</div>
			</div>
			<div class="col-md-4">
				<div class="mbr-figure">
					<img src="<?php echo base_url()?>assets/img/xwtradermobilelogo.png" class="">
				</div>
				<p style="text-align: center; font-size: 16px;">Click for more screenshots.</p>
				<div class="col-md-12">
					<div class="col-md-6 mbr-figure" style="width: 50%">
						<a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url()?>assets/img/large_XWTrader_Mobile_1.jpg">
		                    <img class="img-responsive" alt="" src="<?php echo base_url()?>assets/img/large_XWTrader_Mobile_1.jpg" />
		                </a>
					</div>
					<div class="col-md-6 mbr-figure" style="width: 50%">
						<a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url()?>assets/img/large_XWTrader_Mobile_2.jpg">
		                    <img class="img-responsive" alt="" src="<?php echo base_url()?>assets/img/large_XWTrader_Mobile_2.jpg" />
		                </a>
					</div>
				</div>
				<div class="col-md-12">
				&nbsp;
				</div>
				<div class="col-md-12">
					<div class="col-md-6 mbr-figure" style="width: 50%">
						<a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url()?>assets/img/large_XWTrader_Mobile_3.jpg">
		                    <img class="img-responsive" alt="" src="<?php echo base_url()?>assets/img/large_XWTrader_Mobile_3.jpg" />
		                </a>
					</div>
					<div class="col-md-6 mbr-figure" style="width: 50%">
						<a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url()?>assets/img/large_XWTrader_Mobile_4.jpg">
		                    <img class="img-responsive" alt="" src="<?php echo base_url()?>assets/img/large_XWTrader_Mobile_4.jpg" />
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
				<p class="secondary-list-item-strong">Simple, Clean and Uncluttered Interface with Instant Order Execution</p>
			</div>
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Full List of Order Types</p>
				<p class="desc">
					Market, Stop, Limit and Conditional (one cancels the other, trailing stop)
				</p>
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Real-time Quotes and Synchronization</p>
				<p class="desc">
					Account data and trading activity are synced in real time <br />
					Live streaming dealing rates
				</p>
			</div>
			<div class="col-md-4">
				<p class="secondary-list-item-strong">24-hour Streaming News</p>
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="col-md-12">
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Reporting and Account Management Tools</p>
				<p class="desc">Trade history, pending history, account statement</p>
			</div>
			<div class="col-md-4">
				<p class="secondary-list-item-strong">Interactive Graphing Tools</p>
				<p class="desc">
					Historical data and time periods from one minute to one month <br />
					Extensive charting library and analytical tools
				</p>
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
