<?php
/*
  $Id: cache.php,v 1.23 2003/06/29 22:50:51 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

require('includes/application_top.php');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top" id="main"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          
		  <tr>
		  	<td height="5">Segue abaixo dados importantes referente a sua loja virtual. <br/><br/></td>
		  </tr>	
          <tr>
		  	<td height="5"></td>
		  </tr>	
		  <tr>
		  	<td align="left">
            <img src="../images/icone_txt.gif" border="0"> <b> Arquivos TXT</b><br/><br/>
            &raquo; <a href="exportprod_txt.php" TARGET="_parent" style="color:#0066CC">Exportar tabela de preço</a><br/>
            &raquo; <a href="exportnews_txt.php?cod=1" TARGET="_parent" >Exportar todos os e-mails do newsletter</a><br/>
		  	&raquo; <a href="exportnews_txt.php?cod=2" TARGET="_parent" >Exportar todos os e-mails de clientes cadastrado na loja</a><br/>
            &raquo; <a href="exportnews_txt.php?cod=3" TARGET="_parent" >Exportar apenas emails de clientes que deseja receber informativos.</a><br/><br/>
            
            
            <br/>
            <img src="../images/icone_pdf.gif" border="0"> <b> Arquivos PDF</b><br/><br/>
            &raquo; <a href="export_pdf.php" TARGET="_parent" style="color:#0066CC">Exportar tabela de preço</a><br/>

            </td>
		  </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
