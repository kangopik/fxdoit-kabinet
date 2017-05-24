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
	<title><?php echo $title ?></title>
		
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
				<div class="row text-center">
					<div class="col-md-12">	
						<img src="<?php echo base_url()?>assets/img/forexware-logo.png" alt="Forexware Logo" title="Forexware Logo" style="width: 20%">
					</div>
				</div>
				<div class="row" style="padding-top:10px;">
					<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
						<div class="panel panel-default">
							<div class="panel-heading" style="padding-top:5px;">	
								<p style="text-align: center; margin-bottom: -5px;"><b>FORGOT PASSWORD</b></p>
							</div>
							<div class="panel-body">
								<form action="" method="post">
									<br />
									<div class="form-group input-group">
										<span class="input-group-addon"  ><i class="fa fa-tag"></i></span>
                                        <input type="text" class="form-control" name="email" placeholder="Email" autocomplete="off"/>
									</div>
                                    <div class="form-group">
										<input type="submit" value="RECOVER" class="btn btn-success col-md-12" name="btnrecover" >
									</div>
									<br />
                                    <hr />
								</form>
							</div>
						</div>
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