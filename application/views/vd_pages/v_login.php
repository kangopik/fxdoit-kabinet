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
				<div class="row text-center">
					<div class="col-md-12">	
						<img src="<?php echo base_url()?>assets/img/forexware-logo.png" alt="Forexware Logo" title="Forexware Logo" style="width: 20%">
					</div>
				</div>
				<div class="row" style="padding-top:10px;">
					<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
						<div class="panel panel-default">
							<div class="panel-heading" style="padding-top:5px;">	
								<p style="text-align: center; margin-bottom: -5px;"><b>LOGIN</b></p>
							</div>
							<div class="panel-body">
								<form action="<?php echo base_url()?>Gate/login" method="post">
									<br />
									<div class="form-group input-group">
										<span class="input-group-addon"  ><i class="fa fa-tag"></i></span>
                                        <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off"/>
									</div>
									<div class="form-group input-group">                                    	
                                        <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                    	<input type="password" class="form-control" name="password"  autocomplete="off" placeholder="Password" />
                                    </div>
     								<div class="form-group">
                                    	<label class="checkbox-inline">
                                        	<input type="checkbox" /> Remember me
                                        </label>
                                        <span class="pull-right">
                                        	<a href="<?php echo base_url() ?>cd_member/C_recover" >Forget password ? </a> 
                                        </span>
                                    </div>
                                    <div class="form-group">
										<input type="submit" value="LOGIN" class="btn btn-success col-md-12" name="loginsubmit" >
									</div>
									<br />
                                    <hr />
                                    Not register ? <a href="<?php echo base_url() ?>cd_member/C_registrasi">click here </a> 
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