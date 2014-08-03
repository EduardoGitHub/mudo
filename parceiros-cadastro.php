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
<?php } ?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<link rel="stylesheet" type="text/css" href="includes/librays/jqueryAlerts/jquery.alerts.css" />
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
<div id="container" style="border:0">
  <div id="mainContent" style="margin: 5px 0 0 0;">
  		
  	    <img src="images/afiliados-interno-grande.png" />
      
        <p style="color:#666; font-size:40px; text-align:right; ">Sua Opinião é importante para nós!</p>
        <p style="text-indent:35px; font-size:20px;  color:#666; padding-bottom:15px">
        
        <p style="text-indent:35px; font-size:20px; color:#666; text-align:justify">Neste modelo de parceria você recebe um produto da nossa loja e, em contrapartida, faz uma postagem no seu site ou blog contanto sua experiência para os seus leitores. Você terá direito a escolher um produto que gostaria no site do Mudominhacasa e receberá o mesmo sem nenhum custo. <br /></p>

<p style="text-indent:35px; font-size:20px; color:#666; text-align:justify">Basta acessar o nosso site, se cadastrar e escolher o produto. Após a aprovação da sua solicitação, você deve fazer a aplicação do adesivo Mudo Minha Casa onde você quiser e publicar na sua página uma avaliação sobre ele, ressaltando a qualidade dos nossos adesivos de parede. É imprescindível que o post seja bem escrito e contenha imagens da aplicação, do resultado final e os links de referência para que seu leitor possa conhecer a nossa loja. <br /><br /></p>

<p style="text-indent:35px; font-size:20px; color:#666; text-align:justify">A vantagem desta parceria é você Optando por este tipo de parceria você deverá solicitar o seu adesivo de parede entre os modelos disponíveis na loja para pronta entrega. Basta preencher o formulário, colocando os seus dados pessoais e os dados do seu site, média de visitantes, acessos, url, presença nas redes sociais, etc. Feito isso, nossa equipe vai avaliar a solicitação e entrar em contato.<br /><br /></p>

<p style="text-indent:35px; font-size:20px; color:#666; text-align:justify; padding-bottom:20px;">Para este tipo de parceria não é permitida a escolha de adesivos da linha de personalizados ou encomendas de serviços especiais, como Foto Wall, Foto Art e 3 D.</p>

        
        </p>
        
        <div style="height:30px; background-color:#F5E9BF; text-align:center; font-size:30px; padding:10px 0 10px 0; margin:15px 0 15px 0"> Informe seus dados e entre em contato conosco!</div>
      
      <div class="pagestexto">
      		<form name="formParceiros" id="formParceiros" method="post">
      		<input type="hidden" name="action" value="cadastroParceiros" />
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
            

             <div class="tituloafiliado">Produto que deseja Avaliar</div>	
      		<div class="boxafiliado">
  
            	<p class="float">Nome do Produto:<br />
                <?=tep_draw_input_field('produto','','size="40" maxlength="200"') ?>
                </p>
                
                <p>Tamanho:<br />
                <?=tep_draw_input_field('tamanho','','size="40" maxlength="200"') ?>
                </p>
                
                <p class="float">* Campos obrigatórios</p>
                
                
                
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

  
  	// valida o formulário
    $('#formParceiros').validate({
        // define regras para os campos  
    	submitHandler: function(form) {   
    	$(form).ajaxSubmit({
    		dataType: "json",
            type: "POST",
            url: 'actions-json.php',
    		success: function(data){   
    			if(data.retorno == 0)
    				alert('erro')
    			else if(data.retorno == 1) alert('Salva com sucesso');
        	}   
        });
	return false; 
}, 
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