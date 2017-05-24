<!doctype html>
<html lang="en">
<?php
$view_data['title'] = $title ;
?>
<head>
	<?php $this->load->view('vd_member/v_head',$view_data)?>
	<style type="text/css">
		.metric:hover
		{background-color: orange;}
	</style>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<?php $this->load->view('vd_member/v_navbar',$view_data) ?>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<?php $this->load->view('vd_member/v_leftbar',$view_data) ?>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->		
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-flat">
						<!-- Dompet -->
						<div class="panel-heading">
							<h3 class="panel-title">Edit Password </h3>							
						</div>
						<div class="panel-body">
							<?php echo $this->session->flashdata('notif') ?>
							<form action="<?php echo base_url()?>cd_member/C_editpassword/edpassword" method="post" class="well form-horizontal" id="reset-password-form">
								<fieldset>
									<div class="form-group">
										<label class="col-md-3 control-label">PIN</label>
										<div class="col-md-3">
	  										<input  name="pin" id="pin" class="form-control"  type="text">
  										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Password Lama</label>
										<div class="col-md-3">
	  										<input  name="old_password" id="old_password" class="form-control"  type="password">
  										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Password Baru</label>
										<div class="col-md-3">
	  										<input  name="new_password" id="new_password" class="form-control"  type="password">
  										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Konfirmasi Password</label>
										<div class="col-md-3">
	  										<input  name="new_password_conf" id="new_password_conf" class="form-control"  type="password">
  										</div>
									</div>
									<div class="form-group">
  										<label class="col-md-3 control-label"></label>
										<div class="col-md-3">
											<button type="submit" class="btn btn-primary" >Save</button>
										</div>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
	
	<!-- Javascript -->
	<script src="<?php echo base_url() ?>dashboard/assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>dashboard/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>dashboard/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url() ?>dashboard/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="<?php echo base_url() ?>dashboard/assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="<?php echo base_url() ?>dashboard/assets/scripts/klorofil-common.js"></script>	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.validate.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
	
			$('#reset-password-form').validate({
			    rules: {
			    	pin: {
			            required: true,
			            number: true
			        },
			        old_password: {
			        	minlength: 5,
			            required: true
			        },
			        new_password: {
			            minlength: 5,
			            required: true
			        },
			        new_password_conf: {
			            minlength: 5,
			            required: true,
			            equalTo:'#new_password'
			        }
			    },
			    messages:{
				    pin:{
				    	number: "PIN Harus Angka Saja",
				    	required: "PIN Tidak Boleh Kosong"
				    },
				    old_password: {
			            required: "Password Tidak Boleh Kosong"
			        },
			        new_password: {
			            required: "Password Baru Tidak Boleh Kosong"
			        },
			    	new_password_conf: { 
			    		 required: "Konfirmasi Password Tidak Boleh Kosong",
			        	 equalTo:"Konfirmasi Password Tidak Sama"
			        }
			    },
			    highlight: function (element) {
			        $(element).closest('.form-group').addClass('error');
			    },
			    unhighlight: function(element) {
			        $(element).closest('.form-group').removeClass('error');
			    },
			});
		});
	</script>
</body>