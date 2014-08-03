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
        <p style="color:#666; font-size:40px; text-align:right; ">É muito fácil lucrar com o Mudominhacasa.com!</p>
        <p style="text-indent:35px; font-size:20px;  color:#666; padding-bottom:15px">Participar do nosso programa de afiliados é muito simples e vantajoso. com a publicação de banners, ofernas e links, você divulga nossos produtos no seu canal (Site, Blog ou redes Sociais) e é comissionado toda vez que uma venda for realizada atarvés da mesma.</p>
        
        <div class="menuAfiliados">
        	
        	<ul>
            	<div class="navigation">
            	<li style="list-style:none"><a href="#como-anunciar" class="nav-active">Como anunciar?</a></li>
                <li><a href="#quanto-voce-ganha">Quanto você ganha?</a></li>
                <li><a href="#perguntas-frequentes">Perguntas Frequentes</a></li>
                </div>
                <li><a href="afiliados-cadastro.php">Cadastra-se Agora</a></li>
            </ul>
            
        </div>
        
        <img src="images/afiliados-explicaco.jpg" alt="Explicação de como funciona" />
        <br /><br /><br /><br /><br />
        
        <div style="width:50%; text-align:center; float:left; color:#464A49; font-size:25px;">Transforme seu site, blog ou<br /> Rede Social<br /> no sue melhor negócio!</div>
        <div style="width:50%; text-align:center; float:right"><a href="afiliados-cadastro.php"><img src="images/afiliados-castrase-grande.jpg" /></a></div>
        <div style="clear:both"></div>
      
      <div class="pagestexto">
      		
      		<div id="como-anunciar" class="section" >
            	<h2>Como Anunciar?</h2>
                <div class="textoexplanation">
                	<div class="desc">Fazendo parte do nosso Programa, você pode oferecer nossas ofertas através de sites, blogs ou qualquer Rede Social na qual estiver inserido, como Facebook, Twitter, G+, Pinterest, etc...<br /><br />
Com o Programa de Afiliados do Mudominhacasa você pode gerar lucros reais para o seu site. Você oferece nossos produtos ao seu público através de banners, ofertas, links e outras ações no seu site ou rede social. A cada venda faturada realizada por meio desse canal, você ganha uma boa comissão.
</div>
                
                	<h3>Através de Banners Promocionais</h3>
            		<div class="desc">Escolha os banners que mais lhe agradam, a categoria de seu interesse, obtenha a imagem ou código dos banners e insira no HTML do seu site/blog. Oferecemos oito diferentes formatos de banners.</div>
                    
                    <h3>Através de Links de Ofertas</h3>
            		<div class="desc">Gostou de uma oferta e quer divulgá-la ganhando dinheiro? Use os Links de Oferta Mudominhacasa, um jeito prático de criar links patrocinados e ser comissionado.</div>
                    
                    <h3>Através de Imagens Para Redes Sociais</h3>
            		<div class="desc">Desenvolvemos diversas imagens bacanas para você postar em suas redes sociais e divulgar os produtos ou serviços que melhor lhe interessar para seus familiares e amigos. Uma ótima forma de indicar um bom produto e ainda faturar com isso!</div>
                    
                    <h3>Através de Guests Posts ou Publi-Editorial</h3>
            		<div class="desc">Uma excelente forma de nos indicar e garantir uma boa comissão. Disponibilizamos vários modelos de publicações para que você aproveite as ideias e crie seu próprio conteúdo divulgando nossa empresa e nossos produtos.</div>
                </div>
                
            </div>
            <div id="quanto-voce-ganha" class="section">
            	<h2>Quanto você ganha?</h2>
                <div class="textoexplanation">
            		<div class="desc">Você ganha 10% sobre o valor de cada venda faturada vinculada ao seu anúncio através de seu código de afiliado. <br /><br />
Toda vez que sua comissão atingir o mínimo de R$50,00, você poderá sacar a quantia na sua conta cadastrada no Pagseguro. Acompanhe suas vendas e sua comissão através de relatórios a qualquer momento.
</div>
     
                </div>
            </div>
            <div id="perguntas-frequentes" class="section">
            	<h2>Perguntas Frequentes</h2>
                <div class="textoexplanation">
                	<h3>Como funciona o programa de afiliados do Mudominhacasa?</h3>
            		<div class="desc">Ao se cadastrar em nosso programa de afiliados, você terá uma URL personalizada para divulgar. Você poderá divulgá-la em seu Site, Blog ou Rede Social da maneira que desejar. Você pode escrever um post mostrando vários produtos ou categorias, ou utilizar nossos banners, incluindo-os na sidebar ou corpo do seu site. Toda vez que for confirmada uma venda, através do seu link de afiliado, você ganha uma comissão.</div>
                    
                    <h3>Quem pode participar?</h3>
            		<div class="desc">Qualquer pessoa física ou jurídica pode ser um Afiliado Mudominhacasa. Para isso, é necessário possuir um site, blog ou rede social de acordo com as regras de aprovação e fazer seu cadastro no Programa. Você também precisa possuir uma conta no Pagseguro em seu nome para receber as comissões.</div>
                    
                    <h3>O que devo fazer para participar?</h3>
            		<div class="desc">Para fazer parte do Programa e se tornar um Afiliado Mudominhacas, você precisa efetuar o cadastro de seu Site, Bolg ou Rede Social no Programa. Após o cadastro, você receberá um e-mail de confirmação de cadastro. Aguarde um e-mail com a aprovação e as informações contendo seu código de Afiliado. Para acessar a área de Afiliados e conhecer as Ferramentas de Divulgação basta utilizar o e-mail cadastrado ou seu código afiliado que receberá.</div>
                    
                    <h3>Eu terei algum custo para participar?</h3>
            		<div class="desc">Não, não há nenhum custo para ser um Afiliado Mudominhacasa. E mais, você pode solicitar sua saída do Programa a qualquer momento.</div>
                    
                    <h3>Quanto eu ganho por participar?</h3>
            		<div class="desc">Você ganha 10% sobre o valor de cada venda faturada vinculada ao seu anúncio através de seu código de afiliado. </div>
                    
                    <h3>Como minhas vendas são rastreadas?</h3>
            		<div class="desc">Ao se cadastrar no Programa, você receberá um Código de Afiliado. Este código deve constar em todos os links que redirecionam ao Mudominhacasa, conforme instruções em cada Ferramenta de Divulgação. Através do Link, o Sistema rastreia todo o processo de compra, desde o momento em que o cliente entra na nossa loja através de seu site até o fechamento do pedido de compra.</div>
                    
                    <h3>Como poderei acompanhar minhas vendas?</h3>
            		<div class="desc">Em sua Área de Afiliado, você terá acesso aos Relatórios de Vendas, Comissões e Pagamentos, possibilitando acompanhar os pedidos feitos, a comissão gerada e os pagamentos a que você tem direito.</div>
                    
                    <h3>Como recebo o valor das minhas comissões?</h3>
            		<div class="desc">O primeiro passo para poder receber suas comissões, é ter uma conta no Pagseguro (uma vez que todo o controle de pagamentos e transações são realizadas através dele. Se você ainda não tem uma conta por lá, <a href="https://pagseguro.uol.com.br/" style="color:#06C">clique aqui para criar uma conta no Pagseguro (é rápido e gratuito)</a>.<br /><br />


Toda vez que o mínimo de R$ 50,00 for atingido você pode solicitar o saque dentro da sua conta, a Mudominhacasa, que fará o depósito da sua comissão na conta do Pagseguro informada por você em nosso painel de afiliados. Através da sua conta no Pagseguro você poderá transferir os pagamentos recebidos para sua conta bancária no Brasil. Todos os bancos brasileiros são aceitos. Nós não nos responsabilizamos caso o e-mail de conta no Pagseguro, informado por você, seja um e-mail inválido.
</div>
                    
                    <h3>Dúvidas?</h3>
            		<div class="desc">Caso você tenha ficado com alguma dúvida ou tenha alguma pergunta para nos fazer, sinta-se à vontade para entrar em contato conosco, através do nosso formulário de contato: <a href="http://www.mudominhacasa.com.br/fale-conosco.html" style="color:#06C">http://www.mudominhacasa.com.br/fale-conosco.html</a>
Estamos esperando você!
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