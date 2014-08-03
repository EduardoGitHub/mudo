<?php
require('includes/application_top.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<style type="text/css">
.btboleto{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
background-image:url(includes/languages/portugues/images/buttons/button_gerar_boleto.gif); 
color:#333333;
width:116px; 
height:22px; 
border:0px;  
}
</style>

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
		  	<td align="left">
		  	<?php echo '<a href="exportnews_txt.php?cod=1" TARGET="_parent" >Exportar todos os e-mails do newsletter</a>';?><br/>
		  	<?php echo '<a href="exportnews_txt.php?cod=2" TARGET="_parent" >Exportar todos os e-mails de clientes cadastrado na loja</a>';?><br/>
            <?php echo '<a href="exportnews_txt.php?cod=3" TARGET="_parent" >Exportar apenas emails de cliente que deseja receber informativos.</a>';?><br/><br/>
		  	</td>
		  </tr>
          <tr>
            <td valign="top">
				<table border="0" width="100%" cellspacing="0" cellpadding="2">
				  <tr class="dataTableHeadingRow">
					<td class="dataTableHeadingContent">nome</td>
					<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_NEWSLETTER; ?></td>
				  </tr>
					<?php
					  $emails_news = tep_db_query("select email, nome from " . TABLE_NEWSLETTER);
					 while ($emails = tep_db_fetch_array($emails_news)) {
					 ?>
						 <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
							<td class="dataTableContent"><?php echo $emails['nome']; ?></td>
							<td class="dataTableContent"><?php echo $emails['email']; ?></td>
						</tr>
					<?php } ?>
            	</table>
			</td>
          </tr>
		  <tr>
		  	<td height="5"></td>
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
