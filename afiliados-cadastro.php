<?php
  require('includes/application_top.php');
  $action = $_REQUEST['action'];

	switch ($action){
		
		case 'cadastroAfiliados':
			require_once 'includes/classes/partner.php';
			$p = new Partner();
			$r = $p->newPartner($_POST);
			echo json_encode($r);
			break;
			
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
  <div id="mainContent" style="margin:0;">
  		
  	    <img src="images/afiliados-interno-grande.png" />
      
        <p style="color:#666; font-size:40px; text-align:right; ">Seja Bem Vindo a nossa Casa!</p>
        <p style="text-indent:35px; font-size:20px;  color:#666; padding-bottom:15px">Participando desta modadlidade você terá direito a escolher um produto que gostaria no site do Mudominhacasa e receberá o mesmo sem nenhum custo. Basta acessar o nosso site, escolher o produto e aplicar na sua casa ou onde quiser e fazer um post com sua avaliação ressaltando as qualidades do adesivo de parede do Mudo Minha Casa.</p>
        
        <div style="height:30px; background-color:#F5E9BF; text-align:center; font-size:30px; padding:10px 0 10px 0; margin:15px 0 15px 0"> Faça seu cadastro e Aguarde nosso contato!</div>
      
      <div class="pagestexto">
      		<form name="formAfiliados" id="formAfiliados" method="post">
      		<input type="hidden" name="action" value="cadastroAfiliados" />
            <div class="tituloafiliado">Dados do Parceiro</div>	
      		<div class="boxafiliado">
  
            	<p class="float">*E-mail:<br />
                <?=tep_draw_input_field('email_address','','size="40" maxlength="200" id="email_address"') ?>
                </p>
                
                <p>*Confirme E-Mail:<br />
                <?=tep_draw_input_field('email_address_cf','','size="40" maxlength="200"') ?>
                </p>
                
                <p class="float">*Escolha uma Senha:<br />
                <?=tep_draw_password_field('password','','size="40" maxlength="200" id="password"') ?>
                </p>
                
                <p>*Confirmar Senha: <br />
                <?=tep_draw_password_field('confirmation','','size="40" maxlength="200"') ?>
                </p>
                
            </div>
            
            
            <div class="tituloafiliado">Dados Cadastrais</div>	
      		<div class="boxafiliado">
  
            	<p class="float">*CPF: <br />
                <?=tep_draw_input_field('cpf','','size="40" maxlength="200" id="cpf"') ?>
                </p>
                
                <p>*Nome:<br />
                <?=tep_draw_input_field('firstname','','size="40" maxlength="200"') ?>
                </p>
                
                <p class="float">*RG: <br />
                <?=tep_draw_input_field('rg','','size="40" maxlength="200"') ?>
                </p>
                
                <p>*Orgão Expedidor: <br />
                <?=tep_draw_input_field('orgaorg','','size="40" maxlength="200"');//precisa de ser incluso ?>
                </p>
                
                <p class="float">*Telefone Residencial (somente numeros): <br />
                <?=tep_draw_input_field('telephone','','size="40" maxlength="200" id="telephone"') ?>
                </p>
                
                <p>Fax (somente numeros): <br />
                <?=tep_draw_input_field('fax','','size="40" maxlength="200" id="fax"') ?>
                </p>
                
                <p>Page Views (somente números: <br />
                <?=tep_draw_input_field('pageviews','','size="40" maxlength="200" id="pageviews"')// precisa ser incluso ?>
                </p>
                
                <p class="float">*URL ou endereço do perfil que será utilizado: <br />
                <?=tep_draw_input_field('urle','','size="40" maxlength="200"')// precisa ser incluso ?>
                </p>
                
                <p>*Responsável pleo Site: <br />
                <?=tep_draw_input_field('company','','size="40" maxlength="200"') ?>
                </p>
                
                <p class="float">Descrição: <br />
                <textarea cols="50" rows="5"></textarea>
                </p>
                
                <div style="clear:both"></div>
            </div>
            
            <div class="tituloafiliado">Endereço</div>	
      		<div class="boxafiliado">
  
            	<p>*CEP  :<br />
                <?=tep_draw_input_field('postcode','','size="15" maxlength="9" id="postcode" ') ?>&nbsp;&nbsp;<input type="button" name="buscacep" id="buscacep" style="border: 0px; width: 65px; height: 18px; background-image: url('images/button-cep.gif'); cursor:pointer; " /><div id="validpostcode" style="color:#000000;" class="inputRequirement"></div>
                </p>
                
                <p  class="float">*Endereço: <br />
                <?=tep_draw_input_field('street_address','','size="40" maxlength="200" id="street_address"') ?>
                </p>
                
                <p class="float">*Numero: <br />
                <?=tep_draw_input_field('street_number','','size="10" maxlength="200" id="street_number"') ?>
                </p>
                
                <p>*Complemento: <br />
                <?=tep_draw_input_field('complemento','','size="40" maxlength="200" ') ?>
                </p>
                
                <p class="float">*Bairro: <br />
                <?=tep_draw_input_field('suburb','','size="40" maxlength="200" id="suburb"') ?>
                </p>
                
                <p class="float">*Cidade: <br />
                <?=tep_draw_input_field('city','','size="40" maxlength="200" id="city"') ?>
                </p>
                
                <p>*Estado: <br />
                <?=tep_draw_input_field('state','','size="10" maxlength="2" id="state"') ?>
                </p>
                
                <div style="clear:both"></div>
            </div>
            
            
             <div class="tituloafiliado">Área de Atuação</div>	
             <div class="boxafiliado">
                    <div class="atuacao">
                        <ul>
                            <li><input type="checkbox" name="area[]" value="Administração/Negocios" />Administração/Negocios</li>
                            <li><input type="checkbox" name="area[]" value="Arquitetura e Construção" />Arquitetura e Construção</li>
                            <li><input type="checkbox" name="area[]" value="Artes" />Artes</li>
                            <li><input type="checkbox" name="area[]" value="Atividade Beneficientes" />Atividade Beneficientes</li>
                            <li><input type="checkbox" name="area[]" value="Carreira / Mercado de Trabalho" />Carreira / Mercado de Trabalho</li>
                            <li><input type="checkbox" name="area[]" value="Cinema/Video" />Cinema/Video</li>
                            <li><input type="checkbox" name="area[]" value="Compras" />Compras</li>
                            <li><input type="checkbox" name="area[]" value="Culinário / Gastronomia/" />Culinária / Gastronomia<li>
                            <li><input type="checkbox" name="area[]" value="Educação" />Educação</li>
                            <li><input type="checkbox" name="area[]" value="Esoterismo" />Esoterismo</li>
                            <li><input type="checkbox" name="area[]" value="Esportes" />Esportes</li>
                            <li><input type="checkbox" name="area[]" value="Finanças/Economia" />Finanças/Economia</li>
                            <li><input type="checkbox" name="area[]" value="Games" />Games</li>
                            <li><input type="checkbox" name="area[]" value="Hobbies" />Hobbies</li>
                            <li><input type="checkbox" name="area[]" value="Infantil" />Infantil</li>
                            <li><input type="checkbox" name="area[]" value="Informatica" />Informatica</li>
                            <li><input type="checkbox" name="area[]" value="Jogos Online" />Jogos Online</li>
                            <li><input type="checkbox" name="area[]" value="Lazer" />Lazer</li>
                            <li><input type="checkbox" name="area[]" value="Literatura" />Literatura</li>
                            <li><input type="checkbox" name="area[]" value="Mulher" />Mulher</li>
                            <li><input type="checkbox" name="area[]" value="Músicas" />Músicas</li>
                            <li><input type="checkbox" name="area[]" value="Notícias" />Notícias</li>
                            <li><input type="checkbox" name="area[]" value="Personalidades" />Personalidades</li>
                            <li><input type="checkbox" name="area[]" value="Provedores de Acesso" />Provedores de Acesso</li>
                            <li><input type="checkbox" name="area[]" value="Religião" />Religião</li>
                            <li><input type="checkbox" name="area[]" value="Saúde" />Saúde</li>
                            <li><input type="checkbox" name="area[]" value="Turismo" />Turismo</li>
                            <li><input type="checkbox" name="area[]" value="Outros" />Outros</li>
                        </ul>
                    </div>
                    
                <div style="clear:both"></div>
             </div>
             
			<iframe src="contrato.html" height="100" width="1000" style="border:1px solid #ccc"></iframe>
            <p  class="float"><input type="checkbox" name="adesao" id="adesao" />Li e aceito o nosso contrato de adesão <br />
               
             </p>
            	<div style="text-align:right"><?=tep_image_submit('button_add_afiliados.jpg', IMAGE_BUTTON_CONTINUE);?></div>
           </form> 
   
      
      </div>
      
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
  
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
<script type="text/javascript" src="includes/busca-cep.js"></script>
  
  <script type="text/javascript" src="includes/librays/jquery.form.js" ></script>
  <script type="text/javascript" src="includes/librays/jquery.validate.min.js" ></script>
  <script type="text/javascript" src="includes/librays/jqueryAlerts/jquery.alerts.js" ></script>

  <script type="text/javascript">

  
  	// valida o formulário
    $('#formAfiliados').validate({
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
		password: { required: true },
		confirmation: { required: true,
			equalTo:'#password' },
		cpf: { required: true },
		firstname: { required: true },
		rg: { required: true },
		orgaorg: { required: true },
		telephone: { required: true },
		url: { required: true },
		company: { required: true },
		postcode: { required: true },
		street_address: { required: true },
		street_number: { required: true },
		suburb: { required: true },
		city: { required: true },
		state: { required: true },
		adesao: { required: true }
	 },
        // define messages para cada campo
        messages: {
        	email_address: { required: 'Informe seu email.',
							 email: 'Informe um e-mail válido'},
			email_address_cf: { required: 'Confirme seu e-mail',
								equalTo:'Seu e-mail não é o mesmo digitado acima. Favor verificar',
								email: 'Informe um email valido'
			},
			password: { required: 'Informe sua senha' },
			confirmation: { required: 'Confirme sua senha',
				equalTo:'Sua senha esta incorreta. Favor verificar' },
			cpf: { required:  'Informe seu CPF' },
			firstname: { required: 'Informe seu nome' },
			rg: { required: 'Informe seu RG' },
			orgaorg: { required: 'Informe o Orgão Expeditor' },
			telephone: { required: 'Informe seu telefone' },
			url: { required: 'Informe a URL do seu site e ou blog' },
			company: { required: 'Informe o responsavel legal' },
			postcode: { required: 'Informe seu CEP' },
			street_address: { required: 'Informe seu endereço' },
			street_number: { required: 'Informe o numero de sua residencia' },
			suburb: { required: 'Informe seu Bairro' },
			city: { required: 'Informe a Cidade' },
			state: { required: 'Informe o Estado' },
			adesao: { required: 'Você não aceitor nosso contrato de adesão.' }
        }
    });
  
  
  </script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>