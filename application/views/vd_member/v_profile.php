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
		
		.btn-file {
		    position: relative;
		    overflow: hidden;
		}
		.btn-file input[type=file] {
		    position: absolute;
		    top: 0;
		    right: 0;
		    min-width: 100%;
		    min-height: 100%;
		    font-size: 100px;
		    text-align: right;
		    opacity: 0;
		    outline: none;
		    cursor: inherit;
		    display: block;
		    background-color: #00AAFF;
		    border-color: #00a0f0;
		    color:#FFFFFF;
		}
		
		#img-upload{
		    width: 100%;
		}
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
							<h3 class="panel-title">Edit Profile </h3>							
						</div>
						<div class="panel-body">
							<?php echo $this->session->flashdata('notif') ?>
							<form action="<?php echo base_url()?>cd_member/C_profile/saveprofile" method="post" enctype="multipart/form-data" class="well form-horizontal" id="edit-profile-form">
								<fieldset>
									<div class="form-group">
										<label class="col-md-2 control-label">Username</label>
										<div class="col-md-3">
	  										<input  name="username" id="username" class="form-control"  type="text" value="<?php echo $username; ?>">
  										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Tipe ID</label>
										<div class="col-md-3">
	  										<select name="type_id" id="type_id" class="form-control"> 
				                        		<option value = ''>- Pilih -</option>
				                        		<?php 
									           		if("ktp" == $type_id){
									           			echo '<option value="ktp" selected>ID Card / KTP</option>';
									           			echo '<option value="sim">Driving License / SIM</option>';
									           			echo '<option value="pas">Passport</option>';
									           		}else if("sim" == $type_id){
									              		echo '<option value="ktp">ID Card / KTP</option>';
									           			echo '<option value="sim" selected>Driving License / SIM</option>';	
									           			echo '<option value="pas">Passport</option>';
									           		}else if("pas" == $type_id){
									           			echo '<option value="ktp">ID Card / KTP</option>';
									           			echo '<option value="sim">Driving License / SIM</option>';
									           			echo '<option value="pas" selected>Passport</option>';
									           		}else{
									           			echo '<option value="ktp">ID Card / KTP</option>';
									           			echo '<option value="sim">Driving License / SIM</option>';
									           			echo '<option value="pas">Passport</option>';
									           		}
				            					?>
				                            </select>
  										</div>  										
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">No. ID</label>
										<div class="col-md-3">
	  										<input  name="no_id" id="no_id" class="form-control"  type="text" value="<?php echo $no_id; ?>">
  										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Email</label>
										<div class="col-md-3">
	  										<input  name="email" id="email" class="form-control"  type="text" value="<?php echo $email; ?>">
  										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">No. HP</label>
										<div class="col-md-2">
	  										<input  name="hp" id="hp" class="form-control"  type="text" value="<?php echo $hp; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
  										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Jenis Kelamin</label>
										<div class="col-md-3">
	  										<select name="sex" id="sex" class="form-control"> 
				                        		<option value = ''>- Pilih -</option>
				                        		<?php 
									           		if("M" == $sex){
									           			echo '<option value="M" selected>Laki-Laki</option>';
									           			echo '<option value="F">Perempuan</option>';
									           		}else if("F" == $sex){
									              		echo '<option value="M">Laki-Laki</option>';
									           			echo '<option value="F" selected>Perempuan</option>';							           			
									           		}else{
									           			echo '<option value="M">Laki-Laki</option>';
									           			echo '<option value="F">Perempuan</option>';
									           		}
				            					?>
				                            </select>
  										</div>  										
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Profesi</label>
										<div class="col-md-4">
	  										<input  name="profesi" id="profesi" class="form-control"  type="text" value="<?php echo $profesi; ?>">
  										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Alamat</label>
										<div class="col-md-10">
	  										<input  name="address" id="address" class="form-control"  type="text" value="<?php echo $address; ?>">
  										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Kode Pos</label>
										<div class="col-md-2">
	  										<input  name="postcode" id="postcode" class="form-control"  type="text" value="<?php echo $postcode; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
  										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Kota</label>
										<div class="col-md-4">
	  										<input  name="city" id="city" class="form-control"  type="text" value="<?php echo $city; ?>">
  										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Provinsi</label>
										<div class="col-md-4">
	  										<input  name="province" id="province" class="form-control"  type="text" value="<?php echo $province; ?>">
  										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Negara</label>
										<div class="col-md-4">
	  										<input  name="country" id="country" class="form-control"  type="text" value="<?php echo $country; ?>">
  										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Upload Image</label>
										<div class="col-md-10">
											<div class="input-group">
									            <span class="input-group-btn">
									                <span class="btn btn-default btn-file">
									                    Browse <input type="file" id="profilepic" name="profilepic">
									                </span>
									            </span>
									            <input type="text" class="form-control" name="imgProfile" id="imgProfile" readonly>
									        </div>
									        <img id='img-upload' style="max-height:20%; max-width:20%;"/>
										</div>								        
									</div>		
									<div class="form-group">
  										<label class="col-md-2 control-label"></label>
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
		$(document).ready( function() {
	    	$(document).on('change', '.btn-file :file', function() {
			var input = $(this),
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
				input.trigger('fileselect', [label]);
			});
	
			$('.btn-file :file').on('fileselect', function(event, label) {
			    
			    var input = $(this).parents('.input-group').find(':text'),
			        log = label;
			    
			    if( input.length ) {
			        input.val(log);
			    } else {
			        if( log ) alert(log);
			    }
		    
			});
			function readURL(input) {
			    if (input.files && input.files[0]) {
			        var reader = new FileReader();
			        
			        reader.onload = function (e) {
			            $('#img-upload').attr('src', e.target.result);
			        }
			        
			        reader.readAsDataURL(input.files[0]);
			    }
			}
	
			$("#imgInp").change(function(){
			    readURL(this);
			}); 	

			$('#edit-profile-form').validate({
			    rules: {
			    	username: {
			            required: true,
			        },
			        email: {
			            required: true,
			            email: true
			        },
			        hp: {
			            required: true
			        },
			    	type_id: {
			            required: true,
			        },
			        no_id: {
			            required: true
			        },
			        city: {
			            required: true
			        },
			        province: {
			            required: true
			        },
			        country: {
			            required: true
			        }
			    },
			    messages:{
			    	username: {
			    		required: "Username Tidak Boleh Kosong"
			        },
			        email: {
			        	required: "Email Tidak Boleh Kosong",
			        	email: "Format Email Salah"
			        },
			        hp: {
			        	required: "No HP Tidak Boleh Kosong"
			        },
			        type_id:{
				    	required: "Tipe ID Harus Dipilih"
				    },
				    no_id: {
			            required: "No ID Tidak Boleh Kosong"
			        },
			        city: {
			            required: "Kota Tidak Boleh Kosong"
			        },
			        province: {
			            required: "Provinsi Tidak Boleh Kosong"
			        },
			        country: {
			            required: "Negara Tidak Boleh Kosong"
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