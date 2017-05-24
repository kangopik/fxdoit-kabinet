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
		<h1 class="page-header blue left">Risk Disclaimer</h1>
		<p class="subheading">
			This brief statement does not disclose all of the risks and other significant aspects of spot foreign currency trading(&#8221;Forex&#8221;).
			In light of the risks you should undertake such transactions only if you(&#8220;trader &#8221;or &#8220;Client&#8221;)understand the nature of the 
			trading into which you are about to engage and the extent of your exposure to risk. Trading in Forex is not suitable for many 
			members of the public. You should carefully consider whether trading is appropriate for you in light of your experience, 
			objectives, financial resources and other relevant circumstances.
		</p>
		<p class="subheading">
			1. Foreign exchange <br /><br />
			The risk of loss in dealing in foreign exchange can be substantial and it is possible to lose more than your initial investment. 
			If the market moves against your position, you maybe called upon to deposit a substantial amount of additional margin funds, 
			on short notice, in order to maintain your position. If you do not provide the required funds within the time required by us, 
			your position may be liquidated at a loss, and you will be liable for any resulting deficit in your account. <br /><br />
			2. Contracts for differences <br /><br />
			Futures contracts can also be referred to as a contract for differences. These can be futures on the London 100 index or 
			any other index, as well as currency and interest rate swaps. However, unlike other futures these contracts can only be 
			settled in cash. Investing in a contract for differences carries the same risks as investing in a future. Transactions in 
			contracts for differences may also have a contingent liability.<br /><br />
			3. Suspensions of trading<br /><br />
			Under certain trading conditions it may be difficult or impossible to liquidate a position. This may occur, for example, at 
			times of rapid price movement if the price rises or falls in one trading session to such an extent that under the rules of the 
			relevant exchange trading is suspended or restricted. Placing a stop-loss order will not necessarily limit your losses to the 
			intended amounts, because market conditions may make it impossible to execute an order at the stipulated price. <br /><br />
			4. Off-exchange transactions in derivatives <br /><br />
			It may not always be apparent whether or not a particular derivative is arranged on-exchange or in an off- exchange derivative 
			transaction. While some off-exchange markets are highly liquid, transactions in off-exchange or &#8216;non transferable&#8217; derivatives 
			may involve greater risk than investing in on-exchange derivatives because there is no exchange market on which to close out an 
			open position. It may be impossible to liquidate an existing position, to assess the value of the position arising from an 
			off-exchange transaction or to assess the exposure to risk. Bid prices and offer prices need not be quoted, and, even where 
			they are, they will be established by dealers in these instruments and consequently it may be difficult to establish what is a 
			fair price. <br /><br />
			5. Foreign markets <br /><br />
			Foreign markets will involve different risks from the markets. In some cases the risks will be greater. On request, Forexware 
			Services must provide an explanation of the relevant risks and protections (if any) which will operate in any foreign markets, 
			including the extent to which it will accept liability for any default of a foreign firm through which it deals. The potential 
			for profit or loss from transactions on foreign markets or in foreign denominated contracts will be affected by fluctuations in 
			foreign exchange rates. <br /><br />
			6. Insolvency <br /><br />
			The insolvency or default of Forexware Services, or that of any other brokers involved with your transaction, may lead to 
			positions being liquidated or closed out without your consent. On request, Forexware Services must provide an explanation of 
			the extent to which it will accept liability for any insolvency of, or default by, other firms involved with your transactions. <br /><br />
			7. Electronic trading <br /><br />
			Trading on an electronic trading system may differ not only from trading in an open-outcry market but also from trading on other 
			electronic trading systems. If you undertake transactions on an electronic trading system, you will be exposed to risks 
			associated with the system including the failure of hardware and software. The result of any system failure may be that your 
			order is either not executed according to your instructions or is not executed at all. <br /><br />
			8. Market risks and on-line trading <br /><br />
			Trading currencies involves substantial risk that is not be suitable for everyone. See Client Agreement for more detailed description 
			of risks. Trading on-line, no matter how convenient or efficient, does not necessarily reduce risks associated with currency trading. <br /><br />
			9. Quoting errors <br /><br />
			Should quoting errors occur due to a dealer&#8217;s mistype of a quote or an erroneous price quote from a Client, such as but not limited 
			to a wrong big figure quote, Forexware services will not be liable for the resulting errors in account balances. Forexware services 
			reserves the right to make the necessary corrections or adjustments on the account involved. Any dispute arising from such quoting 
			errors will be resolved on a basis of a fair market value of a currency at the time such an error occurred. <br /><br />
			10.Internet failures <br /><br />
			Since Forexware services does not control signal power, its reception or routing via Internet, configuration of your equipment or 
			reliability of its connection, we cannot be responsible for communication failures, distortions or delays when you trade on-line 
			(via Internet).
		</p> 
		<h2 class="sub-seo-headline"></h2>
		<p class="subheading">
		</p>
		<h2 class="sub-seo-headline"></h2>
		<p class="subheading">
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
