<footer class="footer main-footer"   >
	<div style="height: 50px;text-align: center;">
		
		<span style="color: white;" class="copy">© 2017 Fxdoit. All Rights reserved.</span>
	</div>
	<div id="glt-translate-trigger">
	<span class="notranslate">Translate &#187;</span>
</div>
<div id="glt-toolbar"></div>
<div id="flags" style="display:none">
  	<ul id="sortable" class="ui-sortable">
   		<li id='English'><a title='English' class='notranslate flag en united-states' data-lang="English" onclick="alert('Fxdoit : Change into English language')"></a></li>
   		<li id='Indonesian'><a title='Indonesian' class='notranslate flag id Indonesian' data-lang="Indonesian"onclick="alert('Fxdoit: Menggunakan Bahasa Indonesia')" ></a></li>
   	</ul>
</div>
<div id="google_translate_element" style="display: none;"></div>
</footer>

<input type="hidden" name="" id="langset" value="<?php echo 'English' ?>">

<script type="text/javascript">
	  function googleTranslateElementInit() {
	    new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
	  }
	</script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	
<script type="text/javascript">
	$(document).ready(function(){ 

	});
</script>
    
<script type="text/javascript">
    $('.ui-sortable a').click(function() {
        var lang_text = $(this).data('lang');
        var simple = $('.goog-te-menu-frame:first'); 

        // trigger oleh klik

        if (!simple.size()) {
          alert("Error: Could not find Google translate frame.");
          return false;
        }

        langset = $('#langset').val();
     

        var simpleValue = simple.contents().find('.goog-te-menu2-item span.text:contains('+lang_text+')');
        simpleValue.click(); 
     
 
        	$(".tool-container").hide();
        0==$("body > #google_language_translator").length&&$("#glt-footer").html("<div id='google_language_translator'></div>");
        return false;


        
        
      });


function LangIndonesia()
{
	// alert('Ubah ke Bahasa Indonesia');
	$("#menuheader").load("<?php echo base_url().'Api/LangIndonesia' ?>",function(){} );
}

function LangEnglish()
{
	// alert('Set to English language');
	$("#menuheader").load("<?php echo base_url().'Api/LangEnglish' ?>",function(){} );
}



</script>

