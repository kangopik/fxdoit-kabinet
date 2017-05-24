<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta id="viewport" name="viewport" content="width=device-width, initial-scale=.3, maximum-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="format-detection" content="telephone=no">
	<title>Register Success</title>
		
	<!-- css -->
	<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/dist/css/login_style.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- css -->
	
	<!-- js -->
	<script>
		/** mobile detect **/
	    var isiPad = navigator.userAgent.match(/iPad/i) != null;
	   	if (isiPad) {
	       	document.getElementById("viewport").setAttribute("content", "width=device-width, initial-scale=.7, maximum-scale=.7, user-scalable=yes");
	    } else {
	       	document.getElementById("viewport").setAttribute("content", "width=device-width, initial-scale=.3, maximum-scale=1");
	    }
	</script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- js -->
</head>
<body>
	<div id="wrapper">
		<div id="wrapper_inner">
			<div class="container">
				<div id="logo">
					<img src="<?php echo base_url()?>assets/img/forexware-logo.png" alt="Forexware Logo" title="Forexware Logo">
				</div>
				<div id="headings_area">
					<div class="page-header section-header">	
						<h1>REGISTER SUCCESS!!</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h2>Mohon Dicatat, data Akun, Pin dan Password Anda. Data ini hanya ditampilkan SEKALI!</h2>
						<h3>
						<table>
							<tr>
								<td>No Akun :</td><td>&nbsp;<?php echo $no_akun ?></td>
							</tr>
							<tr>
								<td>Password :</td><td>&nbsp;<?php echo $password ?></td>
							</tr>
							<tr>
								<td>PIN :</td><td>&nbsp;<?php echo $pin ?></td>
							</tr>
						</table>
						</h3>
					</div>
				</div>
			</div>
		</div>
		<div id="footer">
			<p class="copyright">&copy; 2017 fxdoit</p>
		</div>
	</div>
</body>
</html>