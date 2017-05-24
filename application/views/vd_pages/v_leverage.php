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
		<h1 class="page-header blue left">Leverage</h1>
		<p class="subheading">
			Leverage ratio is flexible, the highest leverage of foreign exchange is 400:1 <br/>
			The leverage of gold, sliver is fixed at 100:1 <br/>
			You dont have to pay money for a negative balance <br/>
		</p>
		<h2 class="sub-seo-headline">The Definition of Leverage</h2>
		<p class="subheading">
			Trading with leverage is trading a position with a larger amount of funds than their own account. Leverage expressed by a 
			percentage, such as 50:1 or 400:1.<br/><br/>
			Suppose there are $10000 in your account. The position of your trading order is 4,000,000 USD/JPY, this means that the leverage 
			ratio is 400:1. How can you make the trading amount reached 400 times more than the disposable amount? The answer is that you can 
			use a short-term overdraft provided by Forexware when you trading on margin. The short-term overdraft can be used to buy forex far 
			more than the value of your account. Without this margin system, you can only trade a position of $10,000 each time.
		</p>
		<h2 class="sub-seo-headline">The Definition of Margin</h2>
		<p class="subheading">
			Margin is the guarantee used to compensate for the losses in case of a trading loss. Since no actual goods are dealt or delivered, 
			the only requirement, and indeed the only real purpose to deposit money into your account is to provide sufficient margin.<br/><br/>
			Margin is a percentage of position, such as 5% or 1%. If it is a 1% margin, then you need to deposit $10000 into your account in order 
			to open a position of $1000000.
		</p>
		<h2 class="sub-seo-headline">Risk Warning</h2>
		<p class="subheading">
			Leverage can help you to earn huge profits with a relatively small initial investment. But leverage can also magnify your losses without 
			a proper risk management. The leverage Forexware has provided indicates that we are willing to provide traders the risk level they are 
			willing to bear, but doesn&#8217;t mean that we suggest you to invest by a leverage of 400:1, which is extremely risky. Finally, it is traders 
			own decision to choose a leverage according to their risk tolerance.
		</p>
		<h2 class="sub-seo-headline">Negative Account Processing</h2>
		<p class="subheading">
			Your maximum risk of loss will not exceed the funds in your account and you will not responsible for a negative account.
		</p>
		<h2 class="sub-seo-headline">Regulated Your Margin</h2>
		<p class="subheading">
			The design of our trading platform can effectively allow you to control risk in real time. You can monitor the margin you have used 
			and the rest of it. The margin that have already used is the fund you must invest to support your trading. So, if the leverage of 
			your account is set to 100:1, you will need to invest 1% of your open position as margin.<br /><br />
			The usable margin is the fund remained in your account, by which to open positions or compensate for your loss. The usable margin 
			varies according to the net worth of your account. The used margin and usable margin are the net worth of your account.
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
