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
	<link href="<?php echo base_url(); ?>assets/dist/css/glt_toolbar_styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/dist/css/google_translate_style.css" rel="stylesheet" type="text/css">
	<!-- css -->
	
	<style type="text/css">#google_language_translator { clear:both; }#flags { width:165px; }#flags a { display:inline-block; margin-right:2px; }.goog-tooltip {display: none !important;}.goog-tooltip:hover {display: none !important;}.goog-text-highlight {background-color: transparent !important; border: none !important; box-shadow: none !important;}.goog-te-banner-frame{visibility:hidden !important;}body { top:0px !important;}</style>
	
	
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
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/js/load-toolbar.js"></script>
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
						<h1>REGISTER FORM</h1>
					</div>
				</div>
				<div class="row">


							<div class="col-md-12">
						<form action="<?php echo base_url()?>Gate/post_create" method="post">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-lg-4 label-registrasi">Nama Lengkap</label>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="nama" id="nama" value='' required="required">
									</div>
								</div>
								
								<div class="form-group" style="padding-top: 30px;">
									<label class="control-label col-lg-4 label-registrasi">Type ID</label>
									<div class="col-lg-8">
										<select class="form-control" name="type_id">
											<option value="ktp">ID Card / KTP</option>
											<option value="sim">Driving License / SIM</option>
											<option value="pas">Passport</option>
										</select>
									</div>
								</div>
								<div class="form-group" style="padding-top: 30px;">
									<label class="control-label col-lg-4 label-registrasi">No. ID</label>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="no_id" id="no_id" value='' required="required" style="max-width: 100%;">
									</div>
								</div>
							
								<div class="form-group" style="padding-top: 30px;">
									<label class="control-label col-lg-4 label-registrasi">Email</label>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="email" id="email" value='' required="required">
									</div>
								</div>
								<div class="form-group" style="padding-top: 30px;">
									<label class="control-label col-lg-4 label-registrasi">No. hp</label>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="hp" id="hp" value='' required="required" style="max-width: 50%;">
									</div>
								</div>
								<div class="form-group" style="padding-top: 30px;">
									<label class="control-label col-lg-4 label-registrasi">Kota</label>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="city" id="city" value='' required="required">
									</div>
								</div>
								<div class="form-group" style="padding-top: 30px;">
									<label class="control-label col-lg-4 label-registrasi">Provinsi</label>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="province" id="province" value='' required="required">
									</div>
								</div>
								<div class="form-group" style="padding-top: 30px;">
									<label class="control-label col-lg-4 label-registrasi">Negara</label>
									<div class="col-lg-8">
										<input type="text" class="form-control" name="country" id="country" value='' required="required">
									</div>
								</div>
								<div class="form-group" style="padding-top: 30px;">
									<label class="control-label col-lg-4 label-registrasi">Jenis Akun</label>
									<div class="col-lg-8">
										<select name="type_akun" id="type_akun" class="form-control" required="required" style="max-width: 50%;"> 
			                        		<option value = ''>- Select Jenis Akun -</option>
			                        		<option value ="micro">Akun Standar</option>
			                        		<option value ="standard">Akun Standar</option>
			                        		<option value ="premium">Akun Premium</option>
			                            </select>
									</div>
								</div>
								<div class="form-group" style="padding-top: 30px;">
									<label class="control-label col-lg-4 label-registrasi">Leverage</label>
									<div class="col-lg-8">
										<select name="leverage" id="leverage" class="form-control" required="required" style="max-width: 50%;"> 
			                        		<option value = ''>- Select Leverage -</option>
			                        		<option value = '100'>1:100</option>
			                        		<option value = '200'>1:200</option>
			                        		<option value = '500'>1:500</option>
			                        		<option value = '1000'>1:1000</option>
			                        	
			                            </select>
									</div>
								</div>
								<div class="form-group" style="padding-top: 30px;">
									<label class="checkbox-inline" style="padding-left: 35px;">
                                   <input required="required" type="checkbox" name="check_setuju" value="1"> I accept and read the <a href="#">Terms and Conditions</a>, <a href="#">Privacy Policy</a>, Risk Acknowledgment and the Disclaimer.
                                    </label>
								</div>
								<div class="form-group" style="padding-left: 15px;">
									<input type="submit" value="Registrasi Sekarang" class="btn btn-success" name="btnregistrasi" >
								</div>
                                <hr />
                                ALREADY REGISTERED ? <a href="<?php echo base_url() ?>cd_member/C_login" >login here </a> 
							</div>
							<div class="col-md-6">
							</div>
						</form>
					</div>


					
				</div>
			</div>
		</div>
		<div id="footer">
			<p class="copyright">&copy; 2017 fxdoit</p>
		</div>
		<div id="glt-translate-trigger">
			<span class="notranslate">Translate &#187;</span>
		</div>
		<div id="glt-toolbar"></div>
		<div id="flags" style="display:none">
		  	<ul id="sortable" class="ui-sortable">
		   		<li id='English'><a title='English' class='notranslate flag en united-states' data-lang="English"></a></li>
		   		<li id='Indonesian'><a title='Indonesian' class='notranslate flag id Indonesian' data-lang="Indonesian"></a></li>
		   	</ul>
		</div>
		<div id="google_translate_element" style="display: none;"></div>
		
		<script type="text/javascript">
			  function googleTranslateElementInit() {
			    new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
			  }
			</script>
		    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
			
		    
		<script type="text/javascript">
		    $('.ui-sortable a').click(function() {
		        var lang_text = $(this).data('lang');
		        var simple = $('.goog-te-menu-frame:first'); 
		        if (!simple.size()) {
		          alert("Error: Could not find Google translate frame.");
		          return false;
		        }
		
		        var simpleValue = simple.contents().find('.goog-te-menu2-item span.text:contains('+lang_text+')');
		        simpleValue.click(); 
		        $(".tool-container").hide();
		        0==$("body > #google_language_translator").length&&$("#glt-footer").html("<div id='google_language_translator'></div>");
		        return false;
		      });
		</script>
	</div>
</body>
</html>