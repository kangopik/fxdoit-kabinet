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
		<h1 class="page-header blue left">Superior Characteristic</h1>	
		<h2 class="sub-seo-headline">Forexware is registered by Australian Securities and Investment Commission (ASIC) (Registration No. AFSL305539).</h2>
		<p class="subheading">
			The trading account investors opened in Forexware will be strictly protected by ASIC. ASIC is a statutory regulator of financial services and markets in Australia. Australian Securities and Investments Commission was established in 2001 under the Australian "Securities and Investments Commission Act". The agency independently exercise regulatory functions on companies, investment behaviors, financial products and services according to the law.
		</p>
		<h2 class="sub-seo-headline">Very Competitive Spreads</h2>
		<p class="subheading">
			With its seats of settlement in several exchanges, Forexware get the best price on the market, to quote directly and offer customers competitive prices. Trading will not be restricted in case of the release of important news and economic data. And you can set orders within the difference between purchase and sale price. At the same time, we received strong support from the international top financial institutions, such as BarclaysBank, HSBC, Goldmansachs, UBS, JPMorgenchase, CreditSuisse and so on. Forexware was able to get the relative optimal market price and spread under the illiquid situation of foreign exchange market, which guarantees the interests of investors in a large extent.
		</p>
		<h2 class="sub-seo-headline">Top Market Liquidity</h2>
		<p class="subheading">
			Forexwares monthly average of foreign exchange trading volume up to tens of billions of dollars. Such a large volume of transactions makes us established a good relationship with the world’s leading clearing bank, this makes Forexware provides global customers with top liquidity and a more extreme standards of order execution.
		</p>
		<h2 class="sub-seo-headline">Powerful Trading Platform</h2>
		<p class="subheading">
			Forexware use the industrys top trading platform - MetaTrader4 as trading platform solutions, providing multi-account trading platforms, as well as trading platform for smart mobile terminals for asset managers. The usability, openness, market share of Meta Trader4 are in a leading position in the industry. Customers can easily download and try the Mata Trader4 on this website. Whether it is real account, or demo account, customers can experience the feeling of professional market investment on foreign exchange, precious metal, oil, important global share. Choose Forexware, you can connect the world’s financial investment market just by a trading platform.
		</p>
		<h2 class="sub-seo-headline">STP trading patterns without artificial interference</h2>
		<p class="subheading">
			When customers open account and trading in Forexware, each of the order will be sent to co-operative bank. Customers profit and loss have no conflicts of interest with Forexware.<br /><br />
			You will trade without artificial interference, whats more , the electronic trading system improves the efficiency and reduces 
			the transaction costs, so we can provide you with a lower spread.
		</p>
		<h2 class="sub-seo-headline">Top IT Technology, safe and stable system</h2>
		<p class="subheading">
			Forexware cooperated with a number of well-known data centers to establish a global financial transaction data center, 
			to provide integrated financial online trading solutions for traders of every countries and regions from different time zone.<br /><br />
			With years of experience of the technical team and lots of hardware facilities input, Forexware effectively prevent network intrusion 
			and reduce transaction network delay. Data center is also equipped with a Dos-attacks protection system. They can defense or insulate 
			any kind of attack. When theres a lot of malicious attack systems, only data center will be attacked and Meta Trader4 server continues 
			to operate under it’s normal mode. Therefore, data center increases the system stability under DOS and DDOS attacks.	
		</p>
		<h2 class="sub-seo-headline">One-on-One Customer Service Manager</h2>
		<p class="subheading">
			For customers in the Asia Pacific region, Forexware provide telephone support in Chinese and Chinese online services. 
			Each customer will have a personal account manager to serve you.
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
