<?php
  require('includes/application_top.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<?php
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
  <title><?php echo TITLE; ?></title>
<?php
}
?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<style>
.section {margin:30px 0 ; font-family:Tahoma, Geneva, sans-serif;}
.section h2{padding:0; margin:0; font-size:25px; color:#666  }
.textoexplanation{ width:960px; background-color:#F5E9BF; padding:10px; margin:10px 0 ;}
.textoexplanation h3{padding:0; margin:3px; font-size:16px; color:#666; font-weight:100; font-weight:bold}
.textoexplanation .desc{ width:940px; background-color:#F9FDFC; padding:10px; margin-bottom:20px; line-height:24px;}
</style>
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container" style="border:0">
  <div id="mainContent" style="margin:0;">
  		<center>
  	    <? 
		  if ($banner = tep_banner_exists('dynamic', 'banner_afiliados')){ 
		  echo tep_display_banner('static', $banner);
          }
		?>
        </center>
        <p style="color:#666; font-size:40px; text-align:right; ">� muito f�cil lucrar com o Mudominhacasa.com!</p>
        <p style="text-indent:35px; font-size:20px;  color:#666; padding-bottom:15px">Participar do nosso programa de afiliados � muito simples e vantajoso. com a publica��o de banners, ofernas e links, voc� divulga nossos produtos no seu canal (Site, Blog ou redes Sociais) e � comissionado toda vez que uma venda for realizada atarv�s da mesma.</p>
        
        <div class="menuAfiliados">
        	
        	<ul>
            	<div class="navigation">
            	<li style="list-style:none"><a href="#como-anunciar" class="nav-active">Como anunciar?</a></li>
                <li><a href="#quanto-voce-ganha">Quanto voc� ganha?</a></li>
                <li><a href="#perguntas-frequentes">Perguntas Frequentes</a></li>
                </div>
                <li><a href="afiliados-cadastro.php">Cadastra-se Agora</a></li>
            </ul>
            
        </div>
        
        <img src="images/afiliados-explicaco.jpg" alt="Explica��o de como funciona" />
        <br /><br /><br /><br /><br />
        
        <div style="width:50%; text-align:center; float:left; color:#464A49; font-size:25px;">Transforme seu site, blog ou<br /> Rede Social<br /> no sue melhor neg�cio!</div>
        <div style="width:50%; text-align:center; float:right"><a href="afiliados-cadastro.php"><img src="images/afiliados-castrase-grande.jpg" /></a></div>
        <div style="clear:both"></div>
      
      <div class="pagestexto">
      		
      		<div id="como-anunciar" class="section" >
            	<h2>Como Anunciar?</h2>
                <div class="textoexplanation">
                	<div class="desc">Fazendo parte do nosso Programa, voc� pode oferecer nossas ofertas atrav�s de sites, blogs ou qualquer Rede Social na qual estiver inserido, como Facebook, Twitter, G+, Pinterest, etc...<br /><br />
Com o Programa de Afiliados do Mudominhacasa voc� pode gerar lucros reais para o seu site. Voc� oferece nossos produtos ao seu p�blico atrav�s de banners, ofertas, links e outras a��es no seu site ou rede social. A cada venda faturada realizada por meio desse canal, voc� ganha uma boa comiss�o.
</div>
                
                	<h3>Atrav�s de Banners Promocionais</h3>
            		<div class="desc">Escolha os banners que mais lhe agradam, a categoria de seu interesse, obtenha a imagem ou c�digo dos banners e insira no HTML do seu site/blog. Oferecemos oito diferentes formatos de banners.</div>
                    
                    <h3>Atrav�s de Links de Ofertas</h3>
            		<div class="desc">Gostou de uma oferta e quer divulg�-la ganhando dinheiro? Use os Links de Oferta Mudominhacasa, um jeito pr�tico de criar links patrocinados e ser comissionado.</div>
                    
                    <h3>Atrav�s de Imagens Para Redes Sociais</h3>
            		<div class="desc">Desenvolvemos diversas imagens bacanas para voc� postar em suas redes sociais e divulgar os produtos ou servi�os que melhor lhe interessar para seus familiares e amigos. Uma �tima forma de indicar um bom produto e ainda faturar com isso!</div>
                    
                    <h3>Atrav�s de Guests Posts ou Publi-Editorial</h3>
            		<div class="desc">Uma excelente forma de nos indicar e garantir uma boa comiss�o. Disponibilizamos v�rios modelos de publica��es para que voc� aproveite as ideias e crie seu pr�prio conte�do divulgando nossa empresa e nossos produtos.</div>
                </div>
                
            </div>
            <div id="quanto-voce-ganha" class="section">
            	<h2>Quanto voc� ganha?</h2>
                <div class="textoexplanation">
            		<div class="desc">Voc� ganha 10% sobre o valor de cada venda faturada vinculada ao seu an�ncio atrav�s de seu c�digo de afiliado. <br /><br />
Toda vez que sua comiss�o atingir o m�nimo de R$50,00, voc� poder� sacar a quantia na sua conta cadastrada no Pagseguro. Acompanhe suas vendas e sua comiss�o atrav�s de relat�rios a qualquer momento.
</div>
     
                </div>
            </div>
            <div id="perguntas-frequentes" class="section">
            	<h2>Perguntas Frequentes</h2>
                <div class="textoexplanation">
                	<h3>Como funciona o programa de afiliados do Mudominhacasa?</h3>
            		<div class="desc">Ao se cadastrar em nosso programa de afiliados, voc� ter� uma URL personalizada para divulgar. Voc� poder� divulg�-la em seu Site, Blog ou Rede Social da maneira que desejar. Voc� pode escrever um post mostrando v�rios produtos ou categorias, ou utilizar nossos banners, incluindo-os na sidebar ou corpo do seu site. Toda vez que for confirmada uma venda, atrav�s do seu link de afiliado, voc� ganha uma comiss�o.</div>
                    
                    <h3>Quem pode participar?</h3>
            		<div class="desc">Qualquer pessoa f�sica ou jur�dica pode ser um Afiliado Mudominhacasa. Para isso, � necess�rio possuir um site, blog ou rede social de acordo com as regras de aprova��o e fazer seu cadastro no Programa. Voc� tamb�m precisa possuir uma conta no Pagseguro em seu nome para receber as comiss�es.</div>
                    
                    <h3>O que devo fazer para participar?</h3>
            		<div class="desc">Para fazer parte do Programa e se tornar um Afiliado Mudominhacas, voc� precisa efetuar o cadastro de seu Site, Bolg ou Rede Social no Programa. Ap�s o cadastro, voc� receber� um e-mail de confirma��o de cadastro. Aguarde um e-mail com a aprova��o e as informa��es contendo seu c�digo de Afiliado. Para acessar a �rea de Afiliados e conhecer as Ferramentas de Divulga��o basta utilizar o e-mail cadastrado ou seu c�digo afiliado que receber�.</div>
                    
                    <h3>Eu terei algum custo para participar?</h3>
            		<div class="desc">N�o, n�o h� nenhum custo para ser um Afiliado Mudominhacasa. E mais, voc� pode solicitar sua sa�da do Programa a qualquer momento.</div>
                    
                    <h3>Quanto eu ganho por participar?</h3>
            		<div class="desc">Voc� ganha 10% sobre o valor de cada venda faturada vinculada ao seu an�ncio atrav�s de seu c�digo de afiliado. </div>
                    
                    <h3>Como minhas vendas s�o rastreadas?</h3>
            		<div class="desc">Ao se cadastrar no Programa, voc� receber� um C�digo de Afiliado. Este c�digo deve constar em todos os links que redirecionam ao Mudominhacasa, conforme instru��es em cada Ferramenta de Divulga��o. Atrav�s do Link, o Sistema rastreia todo o processo de compra, desde o momento em que o cliente entra na nossa loja atrav�s de seu site at� o fechamento do pedido de compra.</div>
                    
                    <h3>Como poderei acompanhar minhas vendas?</h3>
            		<div class="desc">Em sua �rea de Afiliado, voc� ter� acesso aos Relat�rios de Vendas, Comiss�es e Pagamentos, possibilitando acompanhar os pedidos feitos, a comiss�o gerada e os pagamentos a que voc� tem direito.</div>
                    
                    <h3>Como recebo o valor das minhas comiss�es?</h3>
            		<div class="desc">O primeiro passo para poder receber suas comiss�es, � ter uma conta no Pagseguro (uma vez que todo o controle de pagamentos e transa��es s�o realizadas atrav�s dele. Se voc� ainda n�o tem uma conta por l�, <a href="https://pagseguro.uol.com.br/" style="color:#06C">clique aqui para criar uma conta no Pagseguro (� r�pido e gratuito)</a>.<br /><br />


Toda vez que o m�nimo de R$ 50,00 for atingido voc� pode solicitar o saque dentro da sua conta, a Mudominhacasa, que far� o dep�sito da sua comiss�o na conta do Pagseguro informada por voc� em nosso painel de afiliados. Atrav�s da sua conta no Pagseguro voc� poder� transferir os pagamentos recebidos para sua conta banc�ria no Brasil. Todos os bancos brasileiros s�o aceitos. N�s n�o nos responsabilizamos caso o e-mail de conta no Pagseguro, informado por voc�, seja um e-mail inv�lido.
</div>
                    
                    <h3>D�vidas?</h3>
            		<div class="desc">Caso voc� tenha ficado com alguma d�vida ou tenha alguma pergunta para nos fazer, sinta-se � vontade para entrar em contato conosco, atrav�s do nosso formul�rio de contato: <a href="http://www.mudominhacasa.com.br/fale-conosco.html" style="color:#06C">http://www.mudominhacasa.com.br/fale-conosco.html</a>
Estamos esperando voc�!
</div>
                 
                </div>
            </div>
      
      </div>
      <div><a onclick="history.go(-1)" style="cursor:pointer"><?=tep_image_button('button_back.gif', IMAGE_BUTTON_BACK)?></a></div>
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
  <script type="text/javascript" src="includes/librays/on.scroll.js" ></script>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>