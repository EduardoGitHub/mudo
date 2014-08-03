<?php
  require('includes/application_top.php');
  require_once("includes/modules/email/class.phpmailer.php");
  
  if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
    
	 $html = '<b>Nome:</b> '.$_POST['firstname'].'<br />
	 		  <b>E-mail:</b> '.$_POST['email_address'].'<br />
			  <b>Telefone:</b>'.$_POST['telephone'].'<br />
			  <b>CEP:</b></td>'.$_POST['postcode'].'<br />
			  <b>Page Views:</b>'.$_POST['pagaviews'].'<br />
			  <b>Fãs ou Amigo</b> '.$_POST['fan'].'<br />
			  <b>URL ou endereço do perfil:</b> '.$_POST['urle'].'<br />
			  <b>Responsavel pelo Site:</b> '.$_POST['responsavel'].'<br />
			  <b>Area de Atuação:</b> '.$_POST['area'].'<br />
			  <b>Descrição:</b> '.$_POST['desc'].'<br />';
				
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
.boxafiliado{border:1px solid #EBEBEB; width:990px; margin:0 0 15px 0; padding:10px;}
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
  <div id="mainContent" style="margin: 5px 0 0 0; padding:5px;">
  
      <img src="images/troca_de_banners.png" /><br /><br />
      
      <div class="pagestexto" style="text-align:justify; line-height:25px; font-size:16px">
      E-MAIL APRESENTAÇÃO E PROPOSTA<br />
A troca de banner serve como ponte de acesso para o seu blog/site e para o blog do Mudo Minha Casa. É um sistema de ajuda mútua para aumentar a audiência de ambas as partes e funciona por tempo indeterminado. Funciona da mesma forma que a troca de links, com a diferença de que o banner é mais atrativo e será muito mais eficaz.<br /><br />


Ao optar por este tipo de parceria, você receberá um banner do Mudo Minha Casa e deverá enviar o banner de divulgação da sua página. Os tamanhos dos banners serão definidos assim que você manifestar, por aqui, o seu interesse e nos deixar as medidas de confecção do banner. Nosso banner no seu blog ou site terá as mesmas medidas de tamanho que o seu dentro da nossa publicação.<br /><br />


Este sistema de troca é excelente para atrair novos visitantes para seu site, uma vez que entre blogs não há concorrência e sim uma colaboração mútua entre ambos. Optando pela troca de banner você não está impedido de conhecer nossos outros modelos de parceria e aderir à eles..

      </div>
      
      <br />
      
      <div class="pagestexto">
      		<form name="formParceiros" id="formParceiros" method="post">
      		<input type="hidden" name="action" value="process" />
            <input type="hidden" name="sessao" value="Troca de Banners" />
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
            
            
            <div class="tituloafiliado">Informações da Mídia (Blog, Site ou Rede Social)</div>	
      		<div class="boxafiliado">
  
            	<p class="float">Page Views: <span style="color:#999; font-size:10px; font-style:italic">(somente numeros)</span><br />
                <?=tep_draw_input_field('pagaviews','','size="40" maxlength="10" id="pagaviews"') ?>
                </p>
                
                <p>Fãs ou Amigo - Informe para Rede Social: <span style="color:#999; font-size:10px; font-style:italic">(somente numeros)</span><br />
                <?=tep_draw_input_field('fan','','size="40" maxlength="200"') ?>
                </p>
                
                <p class="float">*URL ou endereço do perfil que será utilizado: <br />
                <?=tep_draw_input_field('urle','','size="40" maxlength="200" id="urle"') ?>
                </p>
                
                <p>*Responsável pelo Site: <br />
                <?=tep_draw_input_field('responsavel','','size="40" maxlength="200" id="responsavel"');//precisa de ser incluso ?>
                </p>
                
                <p class="float">Area de Atuação: <br />
                <?=tep_draw_input_field('area','','size="40" maxlength="200" id="area"') ?>
                </p>

                <p>Descrição:<br />
                	<?=tep_draw_input_field('desc','','size="40" id="area" style="height:50px;"') ?>
                </p>
                
                <div style="clear:both"></div>
            </div>
           
            
                <div style="text-align:right"><?=tep_image_submit('button_send_partner.jpg', IMAGE_BUTTON_CONTINUE);?></div>
           </form> 
      </div>
      
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<script type="text/javascript" src="includes/librays/jquery.form.js" ></script>
  <script type="text/javascript" src="includes/librays/jquery.validate.min.js" ></script>
  <script type="text/javascript" src="includes/librays/jqueryAlerts/jquery.alerts.js" ></script>

    <script type="text/javascript">

  
  	// valida o formulário
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
							 email: 'Informe um e-mail válido'},
			email_address_cf: { required: 'Confirme seu e-mail',
								equalTo:'Seu e-mail não é o mesmo digitado acima. Favor verificar',
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