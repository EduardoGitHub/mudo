<?php
  require('includes/application_top.php');
  require("includes/modules/email/class.phpmailer.php");
 
  if (isset($_GET['action']) && ($_GET['action'] == 'send')) {
  	$error = false;
 	//if($customer_id > 0){

	
		$nome = tep_db_prepare_input($_POST['nome']);
		$email = tep_db_prepare_input($_POST['email']);
		$telefone = tep_db_prepare_input($_POST['telefone']);
		$url = tep_db_prepare_input($_POST['url']);
		$type = tep_db_prepare_input($_POST['type']);
		
		define('EMAIL_SUBJECT', $type.' a ' . STORE_NAME);
		while(list($key, $value) = each($_FILES['arquivoop6']['name'])){
			if(!empty($value)){ 
				$filename = $value;
				$filename = str_replace(" ","_",$filename);
				$tipo = strtolower(substr($filename, (strpos($filename, ".")+1), strlen($filename)));
				$dir = 'images/arquivos/';
				if($tipo == "zip" || $tipo== "rar" || $tipo== "cdr" || $tipo== "psd" || $tipo== "jpg" || $tipo== "gif" || $tipo== "tif" || $tipo== "bmp" || $tipo== "txt" || $tipo== "png"){
					
					$name = str_replace(" ","_",$_FILES['arquivoop6']['name'][$key]);
					if (!move_uploaded_file($_FILES['arquivoop6']['tmp_name'][$key], $dir.$name)){
						$error = true;
						$messageStack->add('budget', 'Erro ao carregar arquivo');
					}
				}else{
					$error = true;
					$messageStack->add('budget', 'A extensão ou o tamanho do arquivo não são aceitáveis.');
				}
				$mensagem_link .= HTTP_SERVER.'/images/arquivos/'.$filename.'<br/>';
			}
		}
		$html = '		
			<b>Arquivos fale conosco!</b><br/><br/>
			
			<b>Nome: </b>'.$nome.'<br/>
			<b>Email: </b>'.$email.'<br/>
			<b>Telefone: </b>'.$telefone.'<br/>

			'.$mensagem_link.'
			<br/><br/>
			'.sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME);


		if (tep_validate_email($email)) {
		  tep_sendMail('atendimento@mudominhacasa.com.br', EMAIL_SUBJECT.' (Arquivos)',$html, $nome, $email);
		  
		  tep_redirect(tep_href_link($url, 'action=success'));
		} else {
		  $error = true;
	
		  $messageStack->add('envie-seus-arquivos-fale-conosco', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
		}
 	//}else tep_redirect(tep_href_link(FILENAME_LOGIN));
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
      <div class="pagestitulo"><span>Sua mensagem foi enviada com sucesso!</span></div><br/>
      <?php if ($messageStack->size('envie-seus-arquivos-fale-conosco') > 0) echo $messageStack->output('envie-seus-arquivos-fale-conosco'); ?>
 
      <div class="pagestexto">
      <?php echo tep_draw_form('envie-seus-arquivos-fale-conosco', tep_href_link('envie-seus-arquivos-fale-conosco.php', 'action=send'), 'post', 'enctype="multipart/form-data"'); ?>
                  <input type="hidden" name="nome" value="<?=$_GET['nome']?>" />
                  <input type="hidden" name="email" value="<?=$_GET['email']?>" />
                  <input type="hidden" name="telefone" value="<?=$_GET['telefone']?>" />
                  <input type="hidden" name="url" value="<?=$_GET['url']?>" />
                  <input type="hidden" name="type" value="<?=$_GET['type']?>" />	
                  <!--<div class="OrcTitulosLink"><a href="<?= tep_href_link('envie-seus-arquivos-fale-conosco.php')?>">Quero fazer meu Projeto Exclusivo!</a></div>-->
                    <div class="OrcOpcao">
                        <span class="main">&nbsp;&nbsp;&nbsp; Aqui você pode enviar imagens e fotos para que possamos melhor visualizar suas ideias.</span><br /><br />
                         
                         <div class="titulos">ENVIAR IMAGENS (OPCIONAL)</div>
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
                                    <div style="float:right; width:220px; text-align:right"><?php echo tep_image_submit('button_buguet.gif', IMAGE_BUTTON_CONTINUE); ?></div>
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
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>