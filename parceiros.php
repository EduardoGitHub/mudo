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
.textoexplanation{ width:990px; background-color:#F5E9BF; padding:10px; margin:10px 0 ;}
.textoexplanation h3{padding:0; margin:3px; font-size:15px; color:#666; font-weight:100}
.textoexplanation .desc{ width:970px; background-color:#F9FDFC; padding:10px; margin-bottom:20px; text-indent:10px;}
.inforParceiros{background-color:#F5E9BF; width:97%; padding:15px}
.inforParceiros ul{ list-style:none; padding:0; margin:0}
.inforParceiros li{ float: left; margin:5px; width:450px; min-height:350px;}
.inforParceiros li p{ text-indent:20px; width:400px; text-align:justify; padding-left:35px; font-size:16px}
.inforParceiros .branco{ background-color:#F9FDFC}
</style>
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container" style="border:0">
  <div id="mainContent" style="margin:0;">
  		<center>
  	    <? 
		  if ($banner = tep_banner_exists('dynamic', 'banner_parceiros')){ 
		  echo tep_display_banner('static', $banner);
          }
		?>
        </center>
        
        <p style="text-indent:35px; font-size:25px;  color:#666; padding-bottom:15px; text-align:center">Com nossas propostas de parcerias você pode lucrar ainda mais, além de conseguir maior visibilidade e novos Clientes/Leitores para sua Página Web.</p>
        <p style="text-indent:35px; font-size:25px;  color:#666; padding-bottom:15px; text-align:right">Conheça nosso programas</p>
        
        <center><img src="images/titulo-afiliados.jpg"/></center><br /><br />
        <center><img src="images/parceiros-infografico.png" /></center><br />
        
        <p style="text-indent:35px; font-size:25px;  color:#666; padding:0 0 15px 5px; text-align:left">Participar do nosso programa de afiliados é muito simples e vantajoso. Com a publicação de banners, ofertas e links, você divulga nossos produtos e é comissionado toda vez que uma venda for realizada por meio desse canal.</p>
        
        <p style="text-align:right"><a href="afiliados.html"><img src="images/saiba_mais_afiliados.png" /></a></p>
        
        
        <div style="clear:both"></div>
      
      	<div class="pagestexto">
      		
      		<div class="inforParceiros">
            	<ul>
                	<li class="branco">
                    	<img src="images/avaliacao_produtos.png" /><br />
                        <p>Participando desta modalidade você terá direito a escolher um produto que gostaria para testar. Você receberá o produto sem custo para aplicar na sua casa ou onde quiser para então publicar um post com sua sincera avaliação!
                        <br /><br /><a href="<?=tep_href_link('avaliacao-de-produtos.html')?>"><img src="images/saiba_mais.png" align="right" /></a>
                        </p>
                        
                    </li>
                    <li>
                    	<img src="images/convenio_mudominhacasa.png" /><br />
                        <p>Fornecemos ao administrador do blog/site um cupom de desconto personalizado para que o mesmo distribua o código de desconto com o nome do blog para seus leitores. Esta parceria é muito benéfica e não implica em nenhum custo para você.
                        <br /><br /><a href="<?=tep_href_link('convenio.html')?>"><img src="images/saiba_mais.png" align="right" /></a>
                        </p>
                    </li>
                    <div style="clear:both"></div>
                    <li class="branco">
                    	<img src="images/sorteio.png" /><br />
                        <p>Fornecemos ao parceiro um produto ou vale-presente para que o mesmo seja sorteado para seus leitores ou clientes no ambiente do site ou blog. Basta divulgar a promoção e premiar o vencedor!
                        <br /><br /><a href="<?=tep_href_link('produtos-para-sorteios.html')?>"><img src="images/saiba_mais.png" align="right" /></a>
                        </p>
                    </li>
                    <li>
                    	<img src="images/troca_de_banners.png" /><br />
                        <p>A troca de banner serve como ponte de acesso para o seu blog/site e para o blog do Mudo Minha Casa. É um sistema de ajuda mútua para aumentar a audiência de ambas as partes e funciona por tempo indeterminado.
                        <br /><br /><a href="<?=tep_href_link('troca-de-banners.html')?>"><img src="images/saiba_mais.png" align="right" /></a>
                        </p>
                    </li>
                    <li class="branco">
                    	<img src="images/troca_de_posts.png" /><br />
                        <p>Em nosso site estamos sempre divulgando outros sites ou blogs interessantes, contando um pouco da história das pessoas que estão por trás da mídia. Nesta parceria promovemos a troca de posts para divulgacao mutua.
                        <br /><br /><a href="<?=tep_href_link('troca-de-posts.html')?>"><img src="images/saiba_mais.png" align="right" /></a>
                        </p>
                    </li>
                    <li>
                    	<img src="images/troca_de_links.png" /><br />
                        <p>Links são uma forma interessante de crescer dentro da net. Promovemos uma simples troca de links para divulgação do seu trabalho e, em contrapartida, você divulga o nosso.
                        
                        <br /><br /><a href="<?=tep_href_link('troca-de-links.html')?>"><img src="images/saiba_mais.png" align="right" /></a></p>
                    </li>
            	</ul>
            	<div style="clear:both"></div>
            </div>
      		<p style="font-size:27px; color:#B79205; font-weight:normal;">"Quando há mais pessoas formando uma parceria... a primeira coisa a buscar ...<br /></p>
            <p style="font-size:35px; color:#B79205; text-align:right; padding-right:100px; font-weight:normal;">é um objetivo comum."</p>
            <p style="font-size:28px; color:#B79205; text-align:right; padding-right:50px; font-weight:normal;">Walter Grando</p>
      	</div>
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>