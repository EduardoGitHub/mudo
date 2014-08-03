<?php
   require(DIR_WS_INCLUDES . 'counter.php');
   
   $shipping1 = strpos(MODULE_SHIPPING_INSTALLED, 'sedex');
   $shipping2 = strpos(MODULE_SHIPPING_INSTALLED, 'pac.php');
   $payment1 = strpos(MODULE_PAYMENT_INSTALLED, 'pagseguro.php');
   $payment2 = strpos(MODULE_PAYMENT_INSTALLED, 'boleto');
   $payment3 = strpos(MODULE_PAYMENT_INSTALLED, 'moneyorder.php');
   $payment4 = strpos(MODULE_PAYMENT_INSTALLED, 'transferencia');
   
   $array_pages = array('checkout_confirmation.php','checkout_payment.php','checkout_payment_address.php','checkout_process.php','checkout_shipping.php','checkout_shipping_address.php','checkout_success.php','login.php','logoff.php','shopping_cart.php','create_account.php');
   $pag_name = substr($PHP_SELF, strrpos($PHP_SELF,'/')+1);
   $desabledScri = 'false';
   foreach ($array_pages as $value) {
    if($value == $pag_name){
		$desabledScri = 'true';
		break;
	}
}
?>

<div style="background-color:#D6908E; height:60px">	
    <div style="float:right; width:320px; margin:10px 5px 0 0">
        <div style="position:relative;">
            <!-- PROCURAR -->
            <?=tep_draw_form('quick_find', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get')?>
            <?=tep_draw_input_field('keywords', '', 'id="txtSearch" onkeyup="searchSuggest();" size="200" maxlength="50" placeholder="Informe uma palavra chave para busca"   class="se" style="width:300px; border:0; background-color:#DEA6A5; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; padding-left:10px;"') . ' ' . tep_hide_session_id()?><div id="search_suggest"></div>
            <div style="position:absolute; top:3px; left:260px"><?php echo tep_image_submit('lupa.png','Buscar','style="background:none;"')?></div>
            </form>
        </div>
    </div>
    <!-- FIM PROCURAR -->
    <div style="float:left; font-size:25px; color:#FFF; width:500px; margin:15px 0 0 30px; font-family:Tahoma;">Não encontrou o que procura ?<span>&nbsp;&nbsp;<a href="<?=tep_href_link('produtos-personalizados.php')?>" style="color:#FFF; font-size:15px">Clique Aqui!</a></span></div>
<div style="clear:both"></div>
</div>

<div style="height:140px; padding-top:50px" class="information-footer">
	<div style="position:relative">
        <div style="position:absolute; left:50px; text-align:center"><img src="images/atendimento-rodape.png" /><br /><br /><img src="images/chat-rodape.png" />&nbsp;&nbsp;<a href="<?=tep_href_link('fale-conosco.html')?>"><img src="images/email-rodape.png" /></a><br /></div>
        <div style="text-align:center; position:absolute; left:350px; color:#592F33; font-family:Tahoma, Geneva, sans-serif;">
        	<span style="color:#C97471; font-weight:bold;">Compre pelo Telefone</span><br /><br />
            <b>0800 032 1777</b><br />
            <span style="color:#592F33; font-size:12px;">
            Horário de Atendimento de Segunda a Sexta<br />
            8hs às 18hs
            </span>
        </div>
        <div style="font-size:12px; font-family:Tahoma; top:16px; left:700px; position:absolute; color:#795B5B">Redes Sociais:</div>
        
        <div style="top:38px; left:700px; position:absolute;">
        <a href="http://www.mudominhacasa.com.br/blog/" target="_blank"><img src="images/blog-rodape.png" width="32" height="32"/></a>
        <a href="https://www.facebook.com/mudominhacasa" target="_blank" rel="nofollow"><img src="images/facebook-rodape.png" width="32" height="32"/></a>
        <a href="https://plus.google.com/u/0/+MudominhacasaBr/posts" target="_blank" rel="nofollow"><img src="images/gplus-rodape.png" width="32" height="32"/></a>
        <a href="https://twitter.com/mudominhacasa" target="_blank" rel="nofollow"><img src="images/twitter-rodape.png" width="32" height="32"/></a>
        <a href="https://www.pinterest.com/mudominhacasa/" target="_blank" rel="nofollow"><img src="images/pinterest-rodape.png" width="32" height="32"/></a>
        <a href="http://instagram.com/mudominhacasa" target="_blank" rel="nofollow"><img src="images/instagram-rodape.png" width="32" height="32" /></a></div>
    </div>
</div>


<div class="bg-footer"> 
<!--
 <div style="width:600px; float:left">
 	<ul>
    	<li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
 </div>
 <div style="clear:both"></div>
 -->
 <div class="sessoes">
    <p style="line-height:30px">
    	<b>Tire suas Dúvidas</b><br />
        
        <a href="<?=tep_href_link('como-comprar-i-1.html')?>">Como Comprar</a><br />
        <a href="<?=tep_href_link('como-aplicar.php')?>">Como Aplicar</a><br />
        <a href="<?=tep_href_link('formas-entrega-i-6.html')?>">Tempo e Formas de Entrega</a><br />
        <a href="<?=tep_href_link('formas-pagamento-i-5.html')?>">Formas de Pagamento</a><br />
        
        <a href="<?=tep_href_link('garantia-durabilidade-i-4.html')?>">Garantia e Durabilidade</a><br />
        <a href="<?=tep_href_link('seguranca-privacidade-i-7.html')?>">Segurança e Privacidade</a><br />
        <a href="<?=tep_href_link('troca-devolucao-pedido-i-11.html')?>">Troca e devolução de pedido</a><br />
        <a href="<?=tep_href_link('faq-i-8.html')?>">Perguntas Frequentes</a><br />
        <a href="<?=tep_href_link('paleta-de-cores.php')?>">Significado das Cores</a><br />
        <a href="<?=tep_href_link('quem-somos-i-2.html')?>">Quem Somos</a></li> 
    </p>
    
 </div>
 <div class="sessoes">
    <p>
    	<b>Acompanhe seu Pedido!</b><br />
    
        <form method="get" target="_blank" action="http://websro.correios.com.br/sro_bin/txect01$.QueryList?" name="rastreamento">
        <input type="hidden" name="P_TIPO" value="001" />
        <span style="color:#FFF; font-weight:bold; font-size:15px;">Rastrear Produto</span><br />
        <div style="padding-top:10px;">
            <input name="P_COD_UNI" style="width:150px; height:30px; border:0; background-color:#DEA6A5; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; padding-left:10px;"  placeholder="Insira aqui seu código" />
            <input type="hidden" name="P_LINGUA" value="001" checked="checked" />
            <input type="submit" value="" style=" border:0; cursor:pointer; background: url('/includes/languages/portugues/images/buttons/button_newletter_cad.png'); width:25px; height:17px;" />
        </div>
        </form>
    </p>
    <br /><br />
    <p>
    	<b>Assine nossa News!</b><br />
    

        <div style="padding-top:5px;">
            <input name="email2" id="email2"  placeholder="Informe seu e-mail" style="width:150px; height:30px; border:0; background-color:#DEA6A5; -webkit-border-radius: 20px; -moz-border-radius: 20px; border-radius: 20px; padding-left:10px;" />
            <input type="button" onClick="javascript: _gaq.push(['_trackPageview', '/virtual-assinatura-newsletter']); excuteAct2('inReg');" value="" style=" border:0; cursor:pointer; background: url('includes/languages/portugues/images/buttons/button_newletter_cad.png'); width:25px; height:17px; "  />
        </div> 
        <span style="color:#FFF; font-weight:bold; font-size:15px;">Receba Dicas de Decoração, Novidades, Ofertas Exclusivas e muito mais em 1 mão</span><br />

    </p>
    
    <p style="line-height:30px">
    <!--
    	<b>Outros</b><br />
        
        <a href="<?=tep_href_link('galeria-de-fotos.php')?>">Galeria de Fotos</a><br />
        <a href="<?=tep_href_link('mande-arte-i-15.html')?>">Mande sua Arte</a><br />
        <a href="<?=tep_href_link('promocoes-vigentes-i-18.html')?>">Promoções vigentes</a><br />
        
    </p>
    -->
    
 </div>
 <div class="sessoes">
    <!--
    <p style="line-height:30px">
    	<b>Ganhe dinheiro Conosco</b><br />
       
        <a href="<?=tep_href_link('seja-revendedor-i-16.html')?>">Seja um revendedor</a><br />
        <a href="<?=tep_href_link('parceiros.html')?>">Seja um Parceiro</a><br />
        <a href="<?=tep_href_link('afiliados.html')?>">Afiliados Mudominhacasa</a><br />
    </p>
    -->
    
    <p style="line-height:30px">
    	<!--
        <b>Concurso de Arte</b><br />
        
        <a href="<?=tep_href_link('mande-arte-i-15.html')?>">Envie sua Arte</a><br />
        <a href="#">Produtos em Avaliacao</a><br />
    </p>
    -->
    
    
 </div>
 <div class="sessoes">
 	<center><img src="images/logo-rodape.png" /></center>
    <p class="rodapetextomudo">Nossa paixão é misturar arte, design e decoração. Criamos adesivos de parede decorativos para alegrar sua casa com um toque de criatividade.</p>        
    <p class="rodapetextomudo">O adesivo decorativo é produzido com material ultrafino, de melhor desempenho encontrado no atual mercado. O adesivo é impresso em alta resolução real para que você tenha uma experiência super agradável tanto durante a aplicação do adesivo na parede, quanto no resultado da decoração.</p>    
    <p class="rodapetextomudo">Nossa empresa proporciona uma compra 100% segura, acompanhado de um serviço de entrega rápido e garantido, atendendo com perfeição todos nossos clientes e amigos espalhados por todos os estados do Brasil e outros países mundo afora. Atender bem e garantir nossos serviços são o nosso objetivo.</p> 
    <p style="text-align:center; font-weight:bold; color:#FFF">Seja Bem Vindo!</p>
 </div>
 <div style="clear:both"></div>
</div>		


<!--
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e7c9a053b9bc07e"></script>
-->
<script type="text/javascript" src="includes/librays/jquery.js" ></script>
<script type="text/javascript" src="includes/librays/jquery.corner.js" ></script>
<script type="text/javascript" src="includes/librays/slider/jquery.moodular.js?v3.1"></script>
<script type="text/javascript" src="includes/librays/slider/jquery.moodular.controls.js?v3.1"></script>
<script type="text/javascript" src="includes/librays/slider/jquery.moodular.effects.js?v3.1"></script>
<script src="includes/librays/elastislide/modernizr.custom.17475.js"></script>
<script type="text/javascript" src="includes/librays/elastislide/jquerypp.custom.js"></script>
<script type="text/javascript" src="includes/librays/elastislide/jquery.elastislide.js"></script>
<script language="javascript" type="text/javascript">
jQuery(document).ready(function () {
	jQuery('#demo').moodular({
		effects: 'left ',
		controls: 'buttons',
		legendContainer : jQuery('#legend'),
		legendSpeed: 200,
		indexElement : jQuery('#index'),
		bt_prev : jQuery('#prev'),
		bt_next : jQuery('#next'),
		thumbsContainer : jQuery('#demo_thumbs'),
		thumbsItem : 'li',
		auto: true,
		easing: '',
		speed: 1000,
		dispTimeout: 3000					});
	
	$( '#carousel' ).elastislide();
	$( '#carousel2' ).elastislide( {
				height : '300px'
			} );

	$( '#carousel3' ).elastislide( {
				height : '400px'
			} );
	
});		
<? if ($banner = tep_banner_exists('dynamic', 'banner_flutuante')){?>
function controlaCamada(nomeDiv) 
{ 
    if( document.getElementById(nomeDiv).style.visibility == "hidden" ) 
    { 
        document.getElementById(nomeDiv).style.visibility = "visible"; 
    } else 
    { 
        document.getElementById(nomeDiv).style.visibility = "hidden"; 
    } 
}
<?php } ?>

//:: SUGESTÃO DE BUSCA
function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Atualize seu browser!");
	}
}
var searchReq = getXmlHttpRequestObject();
function searchSuggest() {
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		var str = escape(document.getElementById('txtSearch').value);
		searchReq.open("GET", 'searchSuggest.php?search=' + str, true);
		searchReq.onreadystatechange = handleSearchSuggest; 
		searchReq.send(null);
	}		
}
function handleSearchSuggest() {
	if (searchReq.readyState == 4) {
		var ss = document.getElementById('search_suggest')
		ss.innerHTML = '';
		var str = searchReq.responseText.split("\n");
		for(i=0; i < str.length - 1; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
			var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
			suggest += 'onmouseout="javascript:suggestOut(this);" ';
			suggest += 'onclick="javascript:setSearch(this.innerHTML);" ';
			suggest += 'class="suggest_link">' + str[i] + '</div>';
			ss.innerHTML += suggest;
		}
	}
}

function suggestOver(div_value) {
	div_value.className = 'suggest_link_over';
}
function suggestOut(div_value) {
	div_value.className = 'suggest_link';
}

function replaceAll2(string, token, newtoken) {  
	var num = token.length;
	for(var cont =0; cont < num; cont++){
		while (string.indexOf(token[cont]) != -1) {  
			string = string.replace(token[cont], newtoken);  
		 }  
		// alert(token[cont]);
	}
    return string;  
}

//window.alert(replaceAll(str, "<b>", "[A]"));  
function setSearch(value) {
	var words = new Array("<B>","</B>","<b>","</b>");
	document.getElementById('txtSearch').value = replaceAll2(value,words,"");
	document.getElementById('search_suggest').innerHTML = '';
}
//==================================================


//:: NEWSLETTER
function excuteAct (act){
var head = document.getElementsByTagName('head').item(0);
var eScript = document.createElement("script");
reg1 = document.getElementById('email').value;
//reg2 = document.getElementById('nomenewsletter').value;
eScript.setAttribute('src','putmailnewsletter.php?action='+act+'&nome=&email='+reg1);
head.appendChild(eScript);
}
//=============================

function limpa_modelo(){ document.rastreamento.P_COD_UNI.value = ""; }
$(function() {
		$('div.box').corner("rounded 10px");
		$('div.boxconteudo').corner("rounded 5px");
		//$('div.pagestitulo').corner("rounded 5px");
		$('div.pagestitulo').corner("top");
		//$("#bannerPrincipal").moodular();
		jQuery('#bannerPrincipal').moodular({
			effects: 'left',
			controls: '',
			auto: true,
			easing: '',
			speed: 1000,
			dispTimeout: 3000       
		});

		
		
});


$(document).ready(function(){
  $("#navmenu-h li,#navmenu-v li").hover(
    function() { $(this).addClass("iehover"); },
    function() { $(this).removeClass("iehover"); }
  );
});


function popup(URL){ 
   window.open(URL,"janela1","width=640,height=700,scrollbars=YES") 
}
function compartilhe(URL){ 
   window.open(URL,"janela1","width=640,height=300,scrollbars=YES") 
}
/*menu*/
//Nested Side Bar Menu (Mar 20th, 09)
//By Dynamic Drive: http://www.dynamicdrive.com/style/



-->

jQuery(document).ready(function($){
	//portfolio - show link
	$('.fdw-background').hover(
		function () {
			$(this).animate({opacity:'1'});
		},
		function () {
			$(this).animate({opacity:'0'});
		}
	);	
	
	$('h2.accordion').click(function(){
  $(this).parent().find('div.accordion').slideToggle("slow");
 });
	
});

</script>

<script type="text/javascript" src="https://apis.google.com/js/plusone.js">{lang: 'pt-BR'}</script>
<? if(ENTRY_GOOGLE_KEY_ANALYTICS != ''){ ?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?=ENTRY_GOOGLE_KEY_ANALYTICS ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php }?>
