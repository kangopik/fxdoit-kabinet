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
		<h1 class="page-header blue left">Privacy Policy</h1>
		<p class="subheading">
			At Forexware, maintaining customer trust and confidence is a high priority. We understand that you are concerned with how we 
			treat nonpublic personal information (&#8220;Customer Information&#8221;) that we obtain from you or from other sources about you in the 
			course of providing you with our products and services. For this reason, we want you to understand how we work to protect your 
			privacy when we collect and use information about you, and the steps we take to safeguard that information. <br /><br />
			SECURITY PROCEDURES -- Forexware restricts access to Customer Information about you to: 
		</p>
		<ul class="ul-content">
			<li>
				 Those of our employees and affiliates who need to know that information in order to provide the products and services you 
				 receive from us.
			</li>
			<li>
				Those unaffiliated third parties whose access to such information is permitted or required by law and who need to know that 
				information in order to assist us in providing you with the products and services you receive from us.
			</li>
		</ul>
		<p class="subheading">
			To protect the security of Customer Information, we maintain physical, electronic, and procedural safeguards that comply with 
			federal standards for guarding the information we collect about you. While Advantage has written policies and procedures with 
			respect to safeguarding your nonpublic personal information, it is possible (although highly unlikely) that a third party may 
			be able to gain unauthorized access to such information by &#8220;hacking&#8221; into Advantage&#8217;s system or otherwise. We utilize state of 
			the art security devices and employ best practices to safeguard all client information. <br /><br />
			INFORMATION WE COLLECT -- In providing you with financial products and services, Forexware may collect the following types of 
			Customer Information:
		</p>
		<ul class="ul-content">
			<li>
				Information from your account applications and other forms (for example, your name, address, social security number, income, 
				and investment experience).
			</li>
			<li>
				 Information about your transactions with us, our affiliates, or other (for example, your trading history, your history of 
				 meeting margin calls, and your use of various products and services).
			</li>
			<li>
				 Information about your creditworthiness, credit history, and other information about you from consumer reporting agencies, 
				 our affiliates, or providers of other demographic information, such as your purchasing or investment preferences.
			</li>
			<li>
				Information about you obtained in connection with Forexware efforts to protect against fraud or unauthorized use of your account.
			</li>
		</ul>
		<p class="subheading">
			CATEGORIES OF PARTIES TO WHICH WE MAY DISCLOSE -- Forexware may disclose the types of your Customer Information listed above to the 
			following types of parties:
		</p>
		<ul class="ul-content">
			<li>
				Affiliates, including affiliated financial service providers.
			</li>
			<li>
				Governmental agencies, other regulatory bodies, and law enforcement officials.
			</li>
			<li>
				 Other organizations, as required by law.
			</li>
		</ul>
		<p class="subheading">
			Forexware may also disclose your Customer Information to other nonaffiliated third parties as permitted by law, such as in response 
			to a subpoena or legal process or in order to complete a transaction which you initiated and authorized.<br /><br />
			The policies and practices described in this notice are subject to change. Forexware will notify you of any significant changes as 
			required by applicable law.
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
