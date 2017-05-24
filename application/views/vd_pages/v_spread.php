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
		<h1 class="page-header blue left">Spread</h1>
		<h2 class="sub-seo-headline">
			Spread refers to the difference between the purchase price and the selling price of trading products, that is to say, 
			purchase price&#9147; selling price= spread. <br /><br />
			When the relative monetary is the US dollar, the calculation formula of spread cost is: spread cost= standard spread&#215; contract unit&#215; lots.
		</h2>
		<p class="subheading">
			Since the platform settlement currency is US dollar, the trade that uses non dollar relative monetary need to have the instant 
			rate of the direction of closing a position included in the calculation, the calculation formula is: the spread cost of 
			buying positions= standard spread cost&#215; contract unit&#215; lots&#247; the instant rate of selling relative monetary. The spread cost of 
			selling positions= standard spread cost &#215; contract unit &#215; lots &#247; the instant rate of buying relative monetary.(Note: When 
			calculating the EUR/AUD and EUR/GBP, the trading platform will show only the exchange rate of that currency against dollar, 
			namely the exchange rate of Australian dollar against US dollar and British pound against US dollar. So the calculation method 
			should be &#8220;reciprocal&#8221;: spread cost= spread &#215; contract unit &#215; lots &#215; the instant rate of closing a position against the US dollar.<br /><br />
			Forexware adopts STP transaction mode, the spread varies according to the market time and floating of activity. Reference spread are as follows:
		</p>
		<table class="table table-bordered" style="max-width: 300px;">
			<thead>
				<tr class="table-heading">
			        <th style="text-align: center;">Symbol</th>
			        <th style="text-align: center;">Leverage</th>
			    	<th style="text-align: center;">Account Spread</th>
			   	</tr>
			</thead>
			<tbody>
				<tr>
					<td>XAUUSD</td>
					<td>100:1</td>
					<td>0.5</td>
				</tr>
				<tr>
					<td>XAUUSD</td>
					<td>100:1</td>
					<td>0.04</td>
				</tr>
				<tr>
					<td>EURUSD</td>
					<td>400:1</td>
					<td>1.8</td>
				</tr>
				<tr>
					<td>GBPUSD</td>
					<td>400:1</td>
					<td>2.5</td>
				</tr>
				<tr>
					<td>USDJPY</td>
					<td>400:1</td>
					<td>2.5</td>
				</tr>
				<tr>
					<td>USDCHF</td>
					<td>400:1</td>
					<td>2.5</td>
				</tr>
				<tr>
					<td>USDCAD</td>
					<td>400:1</td>
					<td>2.5</td>
				</tr>
				<tr>
					<td>AUDUSD</td>
					<td>400:1</td>
					<td>2.5</td>
				</tr>
				<tr>
					<td>NZDUSD</td>
					<td>400:1</td>
					<td>2.5</td>
				</tr>
				<tr>
					<td>EURJPY</td>
					<td>400:1</td>
					<td>4.0</td>
				</tr>
				<tr>
					<td>GBPJPY</td>
					<td>400:1</td>
					<td>4.0</td>
				</tr>
				<tr>
					<td>EURGBP</td>
					<td>400:1</td>
					<td>4.0</td>
				</tr>
				<tr>
					<td>EURCHF</td>
					<td>400:1</td>
					<td>4.0</td>
				</tr>
				<tr>
					<td>GBPCHF</td>
					<td>400:1</td>
					<td>5.0</td>
				</tr>
				<tr>
					<td>AUDJPY</td>
					<td>400:1</td>
					<td>5.0</td>
				</tr>
				<tr>
					<td>CADJPY</td>
					<td>400:1</td>
					<td>5.0</td>
				</tr>
				<tr>
					<td>CHFJPY</td>
					<td>400:1</td>
					<td>5.0</td>
				</tr>
				<tr>
					<td>NZDJPY</td>
					<td>400:1</td>
					<td>5.0</td>
				</tr>
				<tr>
					<td>GBPCAD</td>
					<td>400:1</td>
					<td>5.0</td>
				</tr>
				<tr>
					<td>GBPNZD</td>
					<td>400:1</td>
					<td>5.0</td>
				</tr>
				<tr>
					<td>AUDCHF</td>
					<td>400:1</td>
					<td>5.0</td>
				</tr>
				<tr>
					<td>AUDCAD</td>
					<td>400:1</td>
					<td>5.0</td>
				</tr>
				<tr>
					<td>AUDNZD</td>
					<td>400:1</td>
					<td>5.0</td>
				</tr>
				<tr>
					<td>CADCHF</td>
					<td>400:1</td>
					<td>5.0</td>
				</tr>
				<tr>
					<td>EURCAD</td>
					<td>400:1</td>
					<td>5.0</td>
				</tr>
				<tr>
					<td>EURAUD</td>
					<td>400:1</td>
					<td>5.0</td>
				</tr>
				<tr>
					<td>EURNZD</td>
					<td>400:1</td>
					<td>5.0</td>
				</tr>
			</tbody>
		</table>
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
