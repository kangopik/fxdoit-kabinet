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
		<h1 class="page-header blue left">Compare Account</h1>
		<table class="table table-bordered" style="max-width: 700px;">
			<thead>
				<tr class="table-heading">
			        <th style="text-align: center;">Specification</th>
			        <th style="text-align: center;">Standart</th>
			    	<th style="text-align: center;">Premium</th>
			    	<th style="text-align: center;">MAM</th>
			   	</tr>
			</thead>
			<tbody>
				<tr>
					<td>Minimum Deposit</td>
					<td>USD 10</td>
					<td>USD 1.000</td>
					<td>By Request</td>
				</tr>
				<tr>
					<td>Spread</td>
					<td>From 1,5</td>
					<td>From 0,8</td>
					<td>By Request</td>
				</tr>
				<tr>
					<td>Deposit Currency</td>
					<td>USD</td>
					<td>USD</td>
					<td>USD</td>
				</tr>
				<tr>
					<td>Laverage</td>
					<td>1:400 - 1:1</td>
					<td>1:200 - 1:1</td>
					<td>1:200 - 1:1</td>
				</tr>
				<tr>
					<td>Price Decimal</td>
					<td>5 Decimal</td>
					<td>5 Decimal</td>
					<td>5 Decimal</td>
				</tr>
				<tr>
					<td>Minimum Lots</td>
					<td>0,01</td>
					<td>0,01</td>
					<td>0,01</td>
				</tr>
				<tr>
					<td>Margin Cal</td>
					<td>70%</td>
					<td>70%</td>
					<td>70%</td>
				</tr>
				<tr>
					<td>Stop Out</td>
					<td>50%</td>
					<td>50%</td>
					<td>50%</td>
				</tr>
				<tr>
					<td>Trading Instrument</td>
					<td>Forex &#38; Metal</td>
					<td>Forex &#38; Metal</td>
					<td>Forex &#38; Metal</td>
				</tr>
				<tr>
					<td>Expert Advisor</td>
					<td>Allowed</td>
					<td>Allowed</td>
					<td>Allowed</td>
				</tr>
				<tr>
					<td>Scalping</td>
					<td>Allowed</td>
					<td>Allowed</td>
					<td>Allowed</td>
				</tr>
				<tr>
					<td>Commision</td>
					<td>No</td>
					<td>No</td>
					<td>No</td>
				</tr>
				<tr>
					<td>Swap</td>
					<td>No</td>
					<td>No</td>
					<td>No</td>
				</tr>
			</tbody>
		</table>
		<div class="btn-group btn-content">
		    <a class="btn-registrasi" href="#" class="btn btn-white btn-default active">Register Now</a>
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
