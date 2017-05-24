
<style type="text/css">


@media (max-width: 992px){
    .navbar li {
        margin-left : 0em;
        margin-right : 0em;
    }
   
}


@media screen and (min-width: 200px) {
		.flex{
			font-size: 18px;
			margin-left: 16px;
		}
		

	}

@media screen and (min-width: 750px) {
		.flex{
			font-size: 16px;
			margin-left: 7px;
		}
		

	}


	@media screen and (min-width: 900px) {

		.flex2{
			font-size: 13px;
			padding: 0px;
			margin: 0px;
		}
		.fleximage {
			width:80%;
		}
		

	}


	@media screen and (min-width: 1100px) {
		.flex{
			font-size: 18px;
			margin-left: 16px;
		}
		.flex2{
			font-size: 15px;
			padding:0px;
		}
		.fleximage {
			width:100%;
		}
		

	}

</style>

<div class="navbar navbar-default navbar-fixed-top" style="top: 0px;">
	<div class="container-fluid">
	<div class="col-md-12">
		<div class="fleximage">
		<div class="col-md-3 col-sm-2 col-xs-12" style="left: 0; margin-left: 0px;padding-left: 0px;"><!-- ruas kiri -->
		
			 <a class="navbar-brand" href="#" style="margin-bottom: 30px; margin-right: 60px;"><img src="<?php echo base_url()?>assets/img/forexware-logo.png" alt="Forexware Logo" title="Forexware Logo" ></a>
		
			
		</div></div>

		<div class="col-md-7 col-sm-12"><!-- ruas tengah -->
		<div class="navbar-header" style="position: fixed; top: 10;right: 0;" >
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	         
	        </div>	


				   <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
     
            <li><div class="flex"><a href="<?php echo base_url() ?>" >Front</a></div></li>
            <li>
             <div class="flex"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">About</a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url() ?>cd_pages/C_company">Informasi Perusahaan</a></li>
		        <li><a href="<?php echo base_url() ?>cd_pages/C_feature">Karakter Unggulan</a></li>
              </ul></div>
            </li>

            <li class="dropdown"><div class="flex">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Our Support</a>
				<ul class="dropdown-menu">
	            	<li><a href="<?php echo base_url() ?>cd_pages/C_contactus">Hubungi Kami</a></li>
	                <li><a href="<?php echo base_url() ?>cd_pages/C_spread">Penyebaran</a></li>
	                <li><a href="<?php echo base_url() ?>cd_pages/C_leverage">Pengaruh</a></li>
	                <li><a href="<?php echo base_url() ?>cd_pages/C_risk">Pengungkapan Risiko</a></li>
	                <li><a href="<?php echo base_url() ?>cd_pages/C_privacy">Kebijakan Privasi</a></li>
	       		</ul></div>
			</li>
            <li><div class="flex"><a href="<?php echo base_url() ?>cd_pages/C_transaction">Transaction</a></div></li>
			<li class="dropdown"><div class="flex">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Account Types</a>
				<ul class="dropdown-menu">
	            	<li><a href="<?php echo base_url() ?>cd_pages/C_standart">Akun Standar</a></li>
	                <li><a href="<?php echo base_url() ?>cd_pages/C_premium">Akun Premium</a></li>
	       		</ul></div>
			</li>
			<li class="dropdown"><div class="flex">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Program</a>
				<ul class="dropdown-menu">
	            	<li><a href="<?php echo base_url() ?>cd_pages/C_xwt">XW Trader</a></li>
	                <li><a href="<?php echo base_url() ?>cd_pages/C_xwm">XW Trader Mobile</a></li>
	                <li><a href="<?php echo base_url() ?>cd_pages/C_mtpc">MetaTrader 4</a></li>
	       		</ul></div>
			</li>
			<li class="dropdown" style="border-right: none;"><div class="flex">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Affiliation</a>
				<ul class="dropdown-menu">
	            	<li><a href="<?php echo base_url() ?>cd_pages/C_requestib">Pengajuan IB</a></li>
	                <li><a href="<?php echo base_url() ?>cd_pages/C_programib">Program IB</a></li>	                
	                <li><a href="<?php echo base_url() ?>cd_pages/C_affiliasi">Agen Affiliasi</a></li>
	       		</ul></div>
			</li>
		
          </ul>  
          </div> 
		</div>
		<div class="col-md-2 col-sm-4 col-xs-12" style="margin-bottom: 25px;">
			  <div id="right">
          	<div class="lang-select" style="text-align: left;margin-right: 10px;">
				<a href="index.html" style=""><img src="<?php echo base_url()?>assets/img/us.jpg"></a>
				<a href="index-id.html" ><span ><img src="<?php echo base_url()?>assets/img/id.jpg" style="border: 3px; border-style: solid; border-color: lightgreen"></span></a>
			</div>
			<div class="head-right-cta" style="padding-right: 0px;" > 
 				<a href="<?php echo base_url() ?>cd_pages/C_track_record" class="grey" style="margin-left: 40px;">&nbsp;Rekam Jejak</a> 
 			<?php 
 			if ($this->session->userdata('user_id') == '')
 				{ ?>
 				<a href="<?php echo base_url() ?>Gate/create" class="btn btn-success" style="padding: 3px;"><div class="flex2"> Buka Akun</div></a> 
 				<a href="<?php echo base_url() ?>Gate/form_login" class="btn btn-warning" style="padding: 3px;"><div class="flex2"> Login</div></a>
 				<?php
 				}
 				else
 				{ ?>
 					<a href="<?php echo base_url().'cd_member/C_dashboard' ?>" class="btn btn-info" style="padding: 3px;"><div class="flex2"> Kabinet</div></a> 
 				<a href="<?php echo base_url() ?>Gate/logout" class="btn btn-danger" style="padding: 3px;"><div class="flex2"> Log Out</div></a>



 				<?php 
 				} ?>
 			</div> 
 			
          </div>    

		</div>
	</div>
    	

        
		




	</div>
</div>


