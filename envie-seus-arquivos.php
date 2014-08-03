<?php
  require('includes/application_top.php');
  require("includes/modules/email/class.phpmailer.php");
  
  if (isset($_POST['action']) && ($_POST['action'] == 'sendpersonalizados')) {
  	$error = false;
 	//if($customer_id > 0){
		//$customers_query = tep_db_query("SELECT customers_firstname as cliente, customers_email_address as email FROM CUSTOMERS WHERE customers_id=".$customer_id);
		//$customers_name = tep_db_fetch_array($customers_query);
		define('EMAIL_SUBJECT', ' :: ORÇAMENTO :: ' . STORE_NAME);
	
		$nome = tep_db_prepare_input($_POST['nome']);
		$email = tep_db_prepare_input($_POST['email']);
		$telefone = tep_db_prepare_input($_POST['telefone']);
		$cep = tep_db_prepare_input($_POST['cep']);
		
		$erro_email = checa_email2($email);
		if($erro_email == "") $sql = mysql_query("INSERT INTO newsletter(email,nome)VALUES('".$email."','".$nome."')");
		
		$information1op6 = tep_db_prepare_input($_POST['information1op6']);
		$information2op6 = tep_db_prepare_input($_POST['information2op6']);
		$ideiaop6 = tep_db_prepare_input($_POST['ideiaop6']);
		$estilop = tep_db_prepare_input($_POST['estilop']);

		
		//$corop6 = tep_db_prepare_input($_POST['corop6']);
		$enquiryop6 = tep_db_prepare_input($_POST['enquiryop6']);
		
		$num = count($estilop);
		$op ='';
		for($i=0;$i<$num;$i++){
			$op .= $estilop[$i].' ';
		}
		
		
		$html = '		
			<b>Quero fazer meu Projeto Exclusivo!</b><br/><br/>
			
			<b>Nome: </b>'.$nome.'<br/>
			<b>Email: </b>'.$email.'<br/>
			<b>Telefone: </b>'.$telefone.'<br/>
			<b>CEP: </b>'.$cep.'<br/>
			
			
			<b>O que você deseja decorar? </b>'.$information1op6.'<br/>
			<b>Qual o tema preferido? </b>'.$information2op6.'<br/>
			<b>Descreva sua ideia </b>'.$ideiaop6.'<br/>
			<b>Quais estilos você gostaria que valorizássemos no projeto? </b>'.$op.'<br/>
			<b>Tamanhos, medidas e observações: </b>'.$enquiryop6.'<br/>
			<br/><br/>
			'.sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME) .'
		';


		if (tep_validate_email($email)) {
		  tep_sendMail('atendimento@mudominhacasa.com.br', EMAIL_SUBJECT, $html, $nome, $email);
		  //tep_redirect(tep_href_link('envie-seus-arquivos.php', 't=Produtos-Personalizados&url=produtos-personalizados.php'));
		} else {
		  $error = true;
	
		  $messageStack->add('personalizados', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
		}
  }else if (isset($_POST['action']) && ($_POST['action'] == 'sendcorporativo')) {
	  $error = false;
 	//if($customer_id > 0){
		//$customers_query = tep_db_query("SELECT customers_firstname as cliente, customers_email_address as email FROM CUSTOMERS WHERE customers_id=".$customer_id);
		//$customers_name = tep_db_fetch_array($customers_query);
		define('EMAIL_SUBJECT', ' :: ORÇAMENTO :: ' . STORE_NAME);
	
			$nomeu = tep_db_prepare_input($_POST['nome']);
			$email = tep_db_prepare_input($_POST['email']);
			$telefone = tep_db_prepare_input($_POST['telefone']);
			$cep = tep_db_prepare_input($_POST['cep']);
			
			$erro_email = checa_email2($email);
			if($erro_email == "") $sql = mysql_query("INSERT INTO newsletter(email,nome)VALUES('".$email."','".$nome."')");
			
			$nome = tep_db_prepare_input($_POST['nomeempresa']);
			$ramo = tep_db_prepare_input($_POST['ramosegmento']);
			$site = tep_db_prepare_input($_POST['site']);
			$sobre = tep_db_prepare_input($_POST['sobreempresa']);
			$publico = tep_db_prepare_input($_POST['publico']);
			$decorar = tep_db_prepare_input($_POST['decorar']);
			$ideia = tep_db_prepare_input($_POST['ideia']);
			$estPessoal = tep_db_prepare_input($_POST['estiloe']);
			$estArte = tep_db_prepare_input($_POST['estiloa']);
			//$cor = tep_db_prepare_input($_POST['corop1']);
			$obs = tep_db_prepare_input($_POST['enquiryop1']);
			
			$nume = count($estPessoal);
			for($i = 0; $i < $nume; $i++){
				$ope = $estPessoal[$i].' ';
			}
			
			$numa = count($estArte);
			for($i = 0; $i < $numa; $i++){
				$opa = $estArte[$i].' ';
			}
			

		  	$html = '<b>Nome: </b>'.$nomeu.'<br/>
					<b>Email: </b>'.$email.'<br/>
					<b>Telefone: </b>'.$telefone.'<br/>
					<b>CEP: </b>'.$cep.'<br/>
					
					
					<b>Nome da Empresa:</b> '.$nome.'<br/>
					<b>Ramo/Segmento:</b> '.$ramo.'<br/>
					<b>Possui Site:</b> '.$site.'<br/>
					<b>Sobre a Empresa:</b> '.$sobre.'<br/>
					<b>Público Alvo:</b> '.$publico.'<br/>
					<b>O que deseja decorar:</b> '.$decorar.'<br/>
					<b>Descreva sua ideia:</b> '.$ideia.'<br/>
					<b>Quais estilos você gostaria que valorizássemos no projeto?<br/>
					<b>Estilo da Empresa:'.$ope.'<br/>
					<b>Estilo da Arte:'.$opa.'<br/>
					<b>Observações:</b> '.$obs.'<br/>

					<br/><br/>
					'.sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME) .'
				';


		if (tep_validate_email($email)) {
		  tep_sendMail('atendimento@mudominhacasa.com.br' , EMAIL_SUBJECT, $html, $nome, $email);
		  
		  //tep_redirect(tep_href_link('envie-seus-arquivos.php', 't=Projetos-Coporativos&url=projetos-corporativos.php'));
		} else {
		  $error = true;
	
		  $messageStack->add('projetos-corporativos', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
		}
  }else if (isset($_POST['action']) && ($_POST['action'] == 'sendwall')) {
  	$error = false;
 	//if($customer_id > 0){
		//$customers_query = tep_db_query("SELECT customers_firstname as cliente, customers_email_address as email FROM CUSTOMERS WHERE customers_id=".$customer_id);
		//$customers_name = tep_db_fetch_array($customers_query);
		define('EMAIL_SUBJECT', ' :: ORÇAMENTO :: ' . STORE_NAME);
	
		$nome = tep_db_prepare_input($_POST['nome']);
		$email = tep_db_prepare_input($_POST['email']);
		$telefone = tep_db_prepare_input($_POST['telefone']);
		$cep = tep_db_prepare_input($_POST['cep']);
		
		$erro_email = checa_email2($email);
		if($erro_email == "") $sql = mysql_query("INSERT INTO newsletter(email,nome)VALUES('".$email."','".$nome."')");
		
		$tamanhoLar_op4 = tep_db_prepare_input($_POST['tamanhoLarop4']);
		$tamanhoAlt_op4 = tep_db_prepare_input($_POST['tamanhoAltop4']);
		$estilo_op4 = tep_db_prepare_input($_POST['estiloop4']);
		$enquiry_op4 = nl2br($_POST['enquiryop4']);
		$modelo = tep_db_prepare_input($_POST['modelo']);
		$quantidade = tep_db_prepare_input($_POST['quantftop4']);
			
			
			$html = '<b>Quero fazer meu foto Wall personalizado!</b><br/>
					
					<b>Nome: </b>'.$nome.'<br/>
					<b>Email: </b>'.$email.'<br/>
					<b>Telefone: </b>'.$telefone.'<br/>
					<b>CEP: </b>'.$cep.'<br/>
					
					<b>Qual o nome ou número do modelo escolhido:</b> '.$modelo.'
					<b>Tamanho:</b> '.$tamanhoLar_op4.'cm largura x '.$tamanhoAlt_op4.'cm altura<br/>
					<b>Estilo:</b>'.$estilo_op4.' <br/>
					<b>Quantidade de Fotos:</b>'.$quantidade.' <br/>
					<b>Observação:</b> '.$enquiry_op4.'<br/>
					<br/><br/>
					'.sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME);


		if (tep_validate_email($email)) {
		  tep_sendMail('atendimento@mudominhacasa.com.br' , EMAIL_SUBJECT, $html, $nome, $email);
		  
		  //tep_redirect(tep_href_link('envie-seus-arquivos.php', 't=Foto-Wall&url=foto-wall.php'));
		} else {
		  $error = true;
	
		  $messageStack->add('foto-wall', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
		}
 	//}else tep_redirect(tep_href_link(FILENAME_LOGIN));
  }else if (isset($_POST['action']) && ($_POST['action'] == 'sendfrases')) {
  	$error = false;
 	//if($customer_id > 0){
		//$customers_query = tep_db_query("SELECT customers_firstname as cliente, customers_email_address as email FROM CUSTOMERS WHERE customers_id=".$customer_id);
		//$customers_name = tep_db_fetch_array($customers_query);
		define('EMAIL_SUBJECT', ' :: ORÇAMENTO :: ' . STORE_NAME);
	
			
			$nome = tep_db_prepare_input($_POST['nome']);
			$email = tep_db_prepare_input($_POST['email']);
			$telefone = tep_db_prepare_input($_POST['telefone']);
			$cep = tep_db_prepare_input($_POST['cep']);
			
			$erro_email = checa_email2($email);
			if($erro_email == "") $sql = mysql_query("INSERT INTO newsletter(email,nome)VALUES('".$email."','".$nome."')");
			
			$tamanhoLar_op2 = tep_db_prepare_input($_POST['tamanhoLarop2']);
			$tamanhoAlt_op2 = tep_db_prepare_input($_POST['tamanhoAltop2']);
			$cor_op2 = tep_db_prepare_input($_POST['corop2']);
			$frase_op2 = nl2br($_POST['fraseop2']);
			$enquiry_op2 = nl2br($_POST['enquiryop2']);

			  
			$html = '	
					<b>Quero escrever minha própria frase!</b><br/>
					
					<b>Nome: </b>'.$nome.'<br/>
					<b>Email: </b>'.$email.'<br/>
					<b>Telefone: </b>'.$telefone.'<br/>
					<b>CEP: </b>'.$cep.'<br/>
					
					<b>Qual é sua frase?</b> '.$frase_op2.'<br/>
					<b>Tamanho:</b> '.$tamanhoLar_op2.'cm largura x '.$tamanhoAlt_op2.'cm altura <br/>
					<b>Cor:</b>'.$cor_op2.' <br/>
					<b>Observação:</b> '.$enquiry_op2.' <br/>
					<b>Copie o(s) link(s) abaixo para baixar o(s) arquivo(s):</b><br/>
					<br/><br/>
					'.sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME);

	if (tep_validate_email($email)) {
		  tep_sendMail('atendimento@mudominhacasa.com.br' , EMAIL_SUBJECT, $html, $nome, $email);
		  
		  //tep_redirect(tep_href_link('envie-seus-arquivos.php', 't=Frases&url=frases.php'));
		} else {
		  $error = true;
	
		  $messageStack->add('frases', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
		}
 	//}else tep_redirect(tep_href_link(FILENAME_LOGIN));
  }else if (isset($_POST['action']) && ($_POST['action'] == 'sendart')) {
  	$error = false;
 	//if($customer_id > 0){
		//$customers_query = tep_db_query("SELECT customers_firstname as cliente, customers_email_address as email FROM CUSTOMERS WHERE customers_id=".$customer_id);
		//$customers_name = tep_db_fetch_array($customers_query);
		define('EMAIL_SUBJECT', ' :: ORÇAMENTO :: ' . STORE_NAME);
			
			$nome = tep_db_prepare_input($_POST['nome']);
			$email = tep_db_prepare_input($_POST['email']);
			$telefone = tep_db_prepare_input($_POST['telefone']);
			$cep = tep_db_prepare_input($_POST['cep']);
			
			$erro_email = checa_email2($email);
			if($erro_email == "") $sql = mysql_query("INSERT INTO newsletter(email,nome)VALUES('".$email."','".$nome."')");
			
			$tamanhoLar_op3 = tep_db_prepare_input($_POST['tamanhoLarop3']);
			$tamanhoAlt_op3 = tep_db_prepare_input($_POST['tamanhoAltop3']);
			$tema = tep_db_prepare_input($_POST['information1op3']);
			$ideia = tep_db_prepare_input($_POST['ideiaop3']);
			$estPessoal = tep_db_prepare_input($_POST['estilop']);
			$estArte = tep_db_prepare_input($_POST['estiloa']);
			$enquiry_op3 = nl2br($_POST['enquirypo3']);
			
			$nume = count($estPessoal);
			for($i = 0; $i < $nume; $i++){
				$ope = $estPessoal[$i].' ';
			}
			
			$numa = count($estArte);
			for($i = 0; $i < $numa; $i++){
				$opa = $estArte[$i].' ';
			}
			


			$html = '<b>Quero minha FOTOART na parede!</b><br/>
					
					<b>Nome: </b>'.$nome.'<br/>
					<b>Email: </b>'.$email.'<br/>
					<b>Telefone: </b>'.$telefone.'<br/>
					<b>CEP: </b>'.$cep.'<br/>
					
					<b>Tamanho:</b> '.$tamanhoLar_op3.'cm largura x '.$tamanhoAlt_op3.'cm altura<br/>
					<b>Qual o tema preferido para aplicarmos a sua foto?</b>'.$tema.' <br/>
					<b>Descreva sua ideia</b>'.nl2br($ideia).' <br/>
					<b>Estilo Pessoal</b>'.$ope.' <br/>
					<b>Estilo da Arte</b>'.$opa.' <br/>
					<b>Observação:</b> '.$enquiry_op3.' <br/>

					<br/><br/>
					'.sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME) .'
				';

		if (tep_validate_email($email)) {
		  tep_sendMail('atendimento@mudominhacasa.com.br' , EMAIL_SUBJECT, $html, $nome, $email);
		  
		  //tep_redirect(tep_href_link('envie-seus-arquivos.php', 't=Foto-Art&url=foto-art.php'));
		} else {
		  $error = true;
	
		  $messageStack->add('foto-art', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
		}
 	//}else tep_redirect(tep_href_link(FILENAME_LOGIN));
  }else if (isset($_POST['action']) && ($_POST['action'] == 'send')) {
  	$error = false;
 	//if($customer_id > 0){

		define('EMAIL_SUBJECT', ' :: ORÇAMENTO :: ' . STORE_NAME);
	
		$nome = tep_db_prepare_input($_POST['nome']);
		$email = tep_db_prepare_input($_POST['email']);
		$telefone = tep_db_prepare_input($_POST['telefone']);
		$cep = tep_db_prepare_input($_POST['cep']);
		$url = tep_db_prepare_input($_POST['url']);
		
		
		while(list($key, $value) = each($HTTP_POST_FILES['arquivoop6']['name'])){
			if(!empty($value)){
				$filename = $value;
				$filename = str_replace(" ","_",$filename);
				$tipo = strtolower(substr($filename, (strpos($filename, ".")+1), strlen($filename)));
				$dir = 'images/orcamento/';
				if($tipo == "zip" || $tipo== "rar" || $tipo== "cdr" || $tipo== "psd" || $tipo== "jpg" || $tipo== "gif" || $tipo== "tif" || $tipo== "bmp" || $tipo== "txt" || $tipo== "png"){
					
					$name = str_replace(" ","_",$HTTP_POST_FILES['arquivoop6']['name'][$key]);
					if (!move_uploaded_file($HTTP_POST_FILES['arquivoop6']['tmp_name'][$key], $dir.$name)){
						$error = true;
						$messageStack->add('budget', 'Erro ao carregar arquivo');
					}
				}else{
					$error = true;
					$messageStack->add('budget', 'A extensão ou o tamanho do arquivo não são aceitáveis.');
				}
				$mensagem_link .= HTTP_SERVER.'/images/orcamento/'.$filename.'<br/>';
			}
		}
		$html = '		
			<b>Quero fazer meu Projeto Exclusivo!</b><br/><br/>
			
			<b>Nome: </b>'.$nome.'<br/>
			<b>Email: </b>'.$email.'<br/>
			<b>Telefone: </b>'.$telefone.'<br/>
			<b>CEP: </b>'.$cep.'<br/>

			'.$mensagem_link.'
			<br/><br/>';


		if (tep_validate_email($email)) {
		  tep_sendMail('atendimento@mudominhacasa.com.br', EMAIL_SUBJECT.' (Arquivos)',$html, $nome, $email);
		  
		  tep_redirect(tep_href_link($url, 'action=success'));
		} else {
		  $error = true;
	
		  $messageStack->add('envie-seus-arquivos', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
		}
  }else if (isset($_GET['action']) && ($_GET['action'] == 'sendenvieseumodelo')) {
  	$error = false;

		define('EMAIL_SUBJECT', ' :: ORÇAMENTO :: ' . STORE_NAME);
		
		$nome = tep_db_prepare_input($_POST['nome']);
		$email = tep_db_prepare_input($_POST['email']);
		$telefone = tep_db_prepare_input($_POST['telefone']);
		$cep = tep_db_prepare_input($_POST['cep']);
		
		$erro_email = checa_email2($email);
		if($erro_email == "") $sql = mysql_query("INSERT INTO newsletter(email,nome)VALUES('".$email."','".$nome."')");
		
		$tamanhoLarop8 = tep_db_prepare_input($_POST['tamanhoLarop8']);
		$tamanhoAltop8 = tep_db_prepare_input($_POST['tamanhoAltop8']);
		$enquiryop8 = nl2br($_POST['enquiryop8']);
		
		$html = '<b>Quero criar meu próprio modelo!</b><br/><br/>

				<b>Qual o espaço que você tem disponível, ao qual o modelo deve se adaptar? </b>'.$tamanhoLarop8.' largura x '.$tamanhoAltop8.' altura<br/>
				<b>Observações: </b>'.$enquiryop8.'<br/>
		
				'.$mensagem_link.'
				<br/><br/>
				'.sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME);
		if (tep_validate_email($email)) {
		  tep_sendMail('atendimento@mudominhacasa.com.br', EMAIL_SUBJECT, $html, $nome, $email);
		} else {
		  $error = true;
	
		  $messageStack->add('envie-seu-modelo', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
		}
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
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title><?php echo TITLE; ?></title>
<?php
}
?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />

<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<style type="text/css">
.OrcTitulosLink{font-size:12px; font-weight:bold; text-transform:uppercase; background-color:#1B4B89; color:#FFF; padding-left:5px; height:25px; padding-top:5px;}
.OrcTitulosLink a{ color:#FFF; text-decoration:none; cursor:pointer}
.OrcTitulosLink a:hover{ text-decoration:underline;cursor:pointer}
.OrcTitulos{font-size:12px; font-weight:bold; text-transform:uppercase; background-color:#ccc; color:#000; padding-left:10px; height:30px; padding-top:10px;}
.OrcOpcao{font-family:Tahoma; color:#666; font-size:12px; padding-bottom:10px; padding-top:10px; text-align:left;  text-decoration:none; width:100%; text-align:justify;}
.OrcOpcao .titulos{ font-family:Tahoma; font-size:12px; font-weight:bold; text-transform:uppercase; background-color:#CCC; color:#000; height:20px; padding-top:5px; padding-left:5px; width:100%; margin-top:10px; margin-bottom:10px;}
</style>
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="sidebar1"><?php require(DIR_WS_INCLUDES . 'column_left.php'); ?></div>
  <div id="mainContent">
      <div class="pagestitulo" style="text-align:center"><span>Seu Pedido de Orçamento foi enviado com sucesso!</span><br /><span style="font-size:15px;">Em breve entraremos em contato.</span></div><br/>
      <?php if ($messageStack->size('envie-seus-arquivos') > 0) echo $messageStack->output('envie-seus-arquivos'); ?>
 
      <div class="pagestexto">
      <?php echo tep_draw_form('envie-seus-arquivos', tep_href_link('envie-seus-arquivos.php', 'action=send'), 'post', 'enctype="multipart/form-data"'); ?>
                  <input type="hidden" name="nome" value="<?=$_GET['nome']?>" />
                  <input type="hidden" name="email" value="<?=$_GET['email']?>" />
                  <input type="hidden" name="telefone" value="<?=$_GET['telefone']?>" />
                  <input type="hidden" name="cep" value="<?=$_GET['cep']?>" />	
                  <input type="hidden" name="url" value="<?=$_GET['url']?>" />	
                  <!--<div class="OrcTitulosLink"><a href="<?= tep_href_link('envie-seus-arquivos.php')?>">Quero fazer meu Projeto Exclusivo!</a></div>-->
                    <div class="OrcOpcao">
                    
                    	<div style="width:400px; text-align:center; margin:5px auto"><img src="images/jpeg.png" align="left" /><br /><br /><span style="font-size:25px">Deseja Enviar Imagens?</span></div>
                    
                         <br /><br /><br />
                        <center><span class="main">&nbsp;&nbsp;&nbsp; Aqui você pode enviar imagens e fotos para que possamos melhor visualizar suas ideias.</span></center><br /><br />

                               &nbsp;&nbsp;&nbsp;Siga as instru&ccedil;&otilde;es abaixo para enviar o projeto ou as fotos do ambiente ou objeto em quest&atilde;o. Mande tamb&eacute;m as refer&ecirc;ncias da sua id&eacute;ia ou qualquer desenho que possa nos inspirar.<br /><br />
                            <div style="background-color:#CCD9FF; width:100%; padding-left:10px; ">
                                <br /><b>ATEN&Ccedil;&Atilde;O</b><br />
                                - O envio de arquivos &eacute; opcional, para concluir esta etapa clique em CONTINUAR.<br />
                                - N&atilde;o inclua caracteres especiais como acentos ou espa&ccedil;os em branco no nome.<br />
                                - Tamanho m&aacute;ximo para envio do arquivo: 16MB <br />
                                - Prefer&ecirc;ncia no envio de arquivos em Corel Draw convertidos em curva<br />
                                - Ser&atilde;o aceitos arquivos .zip; .rar; .cdr; .psd; .jpg; .tif; .gif; .bmp;<br /><br />
                            </div><br /><br />
                            <input type="file" name="arquivoop6[]" size="40"><br /><br />
                            <input type="file" name="arquivoop6[]" size="40"><br /><br />
                            <input type="file" name="arquivoop6[]" size="40"><br /><br />
                            <input type="file" name="arquivoop6[]" size="40"><br /><br />
                            <input type="file" name="arquivoop6[]" size="40"><br /><br />
                            
                                
                                <div class="titulos">4&deg; Passo - Enviar formul&aacute;rio:</div>
                                <div>
                                    <div style="float:left; width:200px;"><a onclick="history.go(-1)" style="cursor:pointer"><?=tep_image_button('button_back.gif', IMAGE_BUTTON_BACK)?></a></div>
                                    <div style="float:right; width:520px; text-align:right"><a href="<?=tep_href_link(FILENAME_DEFAULT)?>" style="cursor:pointer"><?=tep_image_button('nao-obrigado.gif', IMAGE_BUTTON_BACK)?></a>&nbsp;&nbsp;<?php echo tep_image_submit('enviar-imagens.gif', IMAGE_BUTTON_CONTINUE); ?></div>
                                    <div style="clear:both"></div>
                                </div>
                        </div>
                </form>     
      </div>
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1055985706;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:none;">
<img height="1" width="1" style="border-style:none;" alt="" src="https://googleads.g.doubleclick.net/pagead/viewthroughconversion/1055985706/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>