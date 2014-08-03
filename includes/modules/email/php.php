<?php
$gmtDate = gmdate ( "D, d M Y H:i:s" );
header ( "Expires: {$gmtDate} GMT" );
header ( "Last-Modified: {$gmtDate} GMT" );
header ( "Cache-Control: no-cache, must-revalidate" );
header ( "Pragma: no-cache" );
header ( "Content-Type: application/json; charset=UTF-8", true );
require_once('config.php');
if(isset($_POST['action']) && $_POST['action']=='true'){
$html = '
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-UTF-8">
		<style>
		.NomoLoja{ font-family:Calibri; font-size:29px; font-weight:bold;text-align:left;}
		.Site{font-family:Calibri; font-size:29px; text-align:left;}
		.texto{font-family:Calibri; font-size:16px; line-height:28px; color:#333; text-align:left;}
		</style>
		</head>
		<body>
		<table width="760" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #CCC; padding:15px; background-color:#000000" align="center">
          <tr>
			<td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="70%" rowspan="2" style="color:#FFF; text-align:left; padding-right:3px;"> FALE COM O PRESIDENTE!</td>
                    <td width="30%" align="right"><img src="http://ouvidoria.zabbixbrasil.com.br/images/logo.png" width="146" height="59"/></td>
                  </tr>
               
                </table>
            </td>
		  </tr>
		  <tr>
			<td class="texto">
            	<table width="760" border="0" cellspacing="0" cellpadding="0" style="background-color:#FFF; margin:5px">
					<tr><td style="padding-top:15px;">
						<table width="740" border="0" cellspacing="0" cellpadding="0" align="center">
						  <tr>
							<td style="font-family:Tahoma; font-size: 13px;"><b>Nome:</b> '.utf8_decode($_POST['nome']).'</td>
						  </tr>
						  <tr>
							<td style="font-family:Tahoma; font-size: 13px;"><b>Empresa:</b> '.utf8_decode($_POST['empresa']).'</td>
						  </tr>
						  <tr>
							<td style="font-family:Tahoma; font-size: 13px;"><b>E-mail:</b> '.$_POST['emaild'].'</td>
						  </tr>
						  <tr>
							<td style="font-family:Tahoma; font-size: 13px;"><b>Celular:</b> ('.$_POST['ddd'].') '.$_POST['telefone'].'</td>
						  </tr>
						  <tr>
							<td style="font-family:Tahoma; font-size: 13px;"><b>Mensagem:</b> '.utf8_decode(nl2br($_POST['obs'])).'</td>
						  </tr>
						  <tr>
							<td height="15"></td>
						  </tr>
						</table>
					</td></tr>
				<table>
			</td>
		  </tr>	
		  
		</table>
		</body>
	</html>';
	if(mail(REMETENTE, utf8_decode(ASSUNTO), $html, "Content-type: text/html;"))$ret = array('RET'=> 1); else $ret = array('RET'=> 0);		
	echo json_encode ( $ret );
}
?>