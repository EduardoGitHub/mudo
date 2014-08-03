<?php
  require('includes/application_top.php');
  require_once("includes/modules/email/class.phpmailer.php");
  
  if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
    
	 $html = '<b>Nome:</b> '.$_POST['firstname'].'<br />
	 		  <b>E-mail:</b> '.$_POST['email_address'].'<br />
			  <b>Telefone:</b>'.$_POST['telephone'].'<br />
			  <b>CEP:</b></td>'.$_POST['postcode'].'<br />
			  <b>Page Views:</b>'.$_POST['pagaviews'].'<br />
			  <b>F�s ou Amigo</b> '.$_POST['fan'].'<br />
			  <b>URL ou endere�o do perfil:</b> '.$_POST['urle'].'<br />
			  <b>Responsavel pelo Site:</b> '.$_POST['responsavel'].'<br />
			  <b>Area de Atua��o:</b> '.$_POST['area'].'<br />
			  <b>Descri��o:</b> '.$_POST['desc'].'<br />
			  <b>Nome do Produto:</b> '.$_POST['produto'].'<br />
			  <b>Tamanho:</b></td> '.$_POST['tamanho'];
				
      tep_sendMail('parceiro@mudominhacasa.com.br', 'Parceria '.$_POST['sessao'], $html, $_POST['firstname'], $_POST['email_address']);
	  tep_redirect(tep_href_link('parceiros-sucesso.php', '', 'SSL'));
	
  }
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
.boxafiliado{border:1px solid #EBEBEB; width:940px; margin:0 0 15px 0; padding:10px;}
.boxafiliado ul{ list-style:none; margin:0; padding:0;}
.boxafiliado label { text-align: left; margin:0 0 5px 0; display: block; font-weight: bold;  font-size: 11px;}
.boxafiliado label .required{ color:red; }
.boxafiliado p { text-align: left; margin:0 0 5px 0; display: block; font-weight: bold;  font-size: 11px;}
.boxafiliado p .required{ color:red; }
.boxafiliado .float{float: left; margin-right: 50px;}
.tituloafiliado{ background-color:#ccc; color:#000; padding:5px; font-weight:bold}
.atuacao ul{margin:0; padding:0; border:0;}
.atuacao li{ float:left; width:230px; font-family:Tahoma; font-size:11px; padding:3px;}
label.error { margin:2px 0 0 0; color:red;}
</style>
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="mainContent" style="margin:0; padding:5px;">
  
      <img src="images/avaliacao_produtos.png" /><br /><br />
      
      <div class="pagestexto" style="text-align:justify; line-height:25px; font-size:16px">
      Neste modelo de parceria voc� recebe um produto da nossa loja e, em contrapartida, faz uma postagem no seu site ou blog contanto sua experi�ncia para os seus leitores. Voc� ter� direito a escolher um produto que gostaria no site do Mudominhacasa e receber� o mesmo sem nenhum custo. <br /><br />

Basta acessar o nosso site, se cadastrar e escolher o produto. Ap�s a aprova��o da sua solicita��o, voc� deve fazer a aplica��o do adesivo Mudo Minha Casa onde voc� quiser e publicar na sua p�gina uma avalia��o sobre ele, ressaltando a qualidade dos nossos adesivos de parede. � imprescind�vel que o post seja bem escrito e contenha imagens da aplica��o, do resultado final e os links de refer�ncia para que seu leitor possa conhecer a nossa loja. <br /><br />

A vantagem desta parceria � voc� Optando por este tipo de parceria voc� dever� solicitar o seu adesivo de parede entre os modelos dispon�veis na loja para pronta entrega. Basta preencher o formul�rio, colocando os seus dados pessoais e os dados do seu site, m�dia de visitantes, acessos, url, presen�a nas redes sociais, etc. Feito isso, nossa equipe vai avaliar a solicita��o e entrar em contato.<br /><br />

Para este tipo de parceria n�o � permitida a escolha de adesivos da linha de personalizados ou encomendas de servi�os especiais, como Foto Wall, Foto Art e 3 D.

      </div>
      
      <br />
      
      <div class="pagestexto">
      		<form name="formParceiros" id="formParceiros" method="post" action="avaliacao-de-produtos.php">
      		<input type="hidden" name="action" value="process" />
            <input type="hidden" name="sessao" value="Avalia��o de Produto" />
            <div class="tituloafiliado">Dados do Cadastrais</div>	
      		<div class="boxafiliado">
  				
                <p>*Nome:<br />
                <?=tep_draw_input_field('firstname','','size="40" maxlength="200"') ?>
                </p>
                
            	<p class="float">*E-mail:<br />
                <?=tep_draw_input_field('email_address','','size="40" maxlength="200" id="email_address"') ?>
                </p>
                
                <p>*Confirme E-Mail:<br />
                <?=tep_draw_input_field('email_address_cf','','size="40" maxlength="200" id="email_address_cf"') ?>
                </p>
                
                <p class="float">*Telefone <br />
                <?=tep_draw_input_field('telephone','','size="40" maxlength="200" id="telephone"') ?>
                </p>
                
                <p class="float">*CEP <br />
                <?=tep_draw_input_field('postcode','','size="40" maxlength="200" id="cep"') ?>
                </p>
                <div style="clear:both"></div>
            </div>
            
            
            <div class="tituloafiliado">Informa��es da M�dia (Blog, Site ou Rede Social)</div>	
      		<div class="boxafiliado">
  
            	<p class="float">Page Views: <span style="color:#999; font-size:10px; font-style:italic">(somente numeros)</span><br />
                <?=tep_draw_input_field('pagaviews','','size="40" maxlength="10" id="pagaviews"') ?>
                </p>
                
                <p>F�s ou Amigo - Informe para Rede Social: <span style="color:#999; font-size:10px; font-style:italic">(somente numeros)</span><br />
                <?=tep_draw_input_field('fan','','size="40" maxlength="200"') ?>
                </p>
                
                <p class="float">*URL ou endere�o do perfil que ser� utilizado: <br />
                <?=tep_draw_input_field('urle','','size="40" maxlength="200" id="urle"') ?>
                </p>
                
                <p>*Respons�vel pelo Site: <br />
                <?=tep_draw_input_field('responsavel','','size="40" maxlength="200" id="responsavel"');//precisa de ser incluso ?>
                </p>
                
                <p class="float">Area de Atua��o: <br />
                <?=tep_draw_input_field('area','','size="40" maxlength="200" id="area"') ?>
                </p>

                <p>Descri��o:<br />
                	<?=tep_draw_input_field('desc','','size="40" id="area" style="height:50px;"') ?>
                </p>
                
                <div style="clear:both"></div>
            </div>
            

             <div class="tituloafiliado">Produto que deseja Avaliar</div>	
      		<div class="boxafiliado">
  
            	<p class="float">Nome do Produto:<br />
                <?=tep_draw_input_field('produto','','size="40" maxlength="200"') ?>
                </p>
                
                <p>Tamanho:<br />
                <?=tep_draw_input_field('tamanho','','size="40" maxlength="200"') ?>
                </p>
                
                <p class="float">* Campos obrigat�rios</p>
                
                
                
                <div style="clear:both"></div>
            </div>
            
                <div style="text-align:right"><?=tep_image_submit('button_send_partner.jpg', IMAGE_BUTTON_CONTINUE);?></div>
           </form> 
      </div>
      
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
  <script type="text/javascript" src="includes/librays/jquery.form.js" ></script>
  <script type="text/javascript" src="includes/librays/jquery.validate.min.js" ></script>
  <script type="text/javascript" src="includes/librays/jqueryAlerts/jquery.alerts.js" ></script>

  <script type="text/javascript">

  
  	// valida o formul�rio
    $('#formParceiros').validate({
        // define regras para os campos   
	rules: {
		email_address: { required: true,
						 email: true},
		email_address_cf: { required: true,
			equalTo:'#email_address',
			email: true
		},
		firstname: { required: true },
		telephone: { required: true },
		urle: { required: true },
		postcode: { required: true },
		responsavel: { required: true }
		
	 },
        // define messages para cada campo
        messages: {
        	email_address: { required: 'Informe seu email.',
							 email: 'Informe um e-mail v�lido'},
			email_address_cf: { required: 'Confirme seu e-mail',
								equalTo:'Seu e-mail n�o � o mesmo digitado acima. Favor verificar',
								email: 'Informe um email valido'
			},
			

			firstname: { required: 'Informe seu nome' },
			telephone: { required: 'Informe seu telefone' },
			urle: { required: 'Informe a URL do seu site e ou blog' },
			
			postcode: { required: 'Informe seu CEP' },
			responsavel: { required: 'O nome do responsavel' }
			
        }
    });
  
  
  </script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>