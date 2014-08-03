<?php
  require('includes/application_top.php');
  $edit_query = tep_db_query("select * from " . TABLE_EDIT_TEXT . " where text_id =".$_GET['cod']);
  $edit_text = tep_db_fetch_array($edit_query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<title><?=$edit_text['title_seo']?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
 <meta name="Description" content="<?=$edit_text['description_seo']?>" >
 <meta http-equiv="Content-Language" content="pt-BR" >
 <meta name="googlebot" content="all" >
 <meta name="robots" content="noodp" >
 <meta name="slurp" content="noydir" >
 <meta name="revisit-after" content="1 days" >
 <meta name="robots" content="index, follow" >
 <meta name="no-email-collection" value="http://www.mudominhacasa.com.br" >
 <meta name="Reply-to" content="mudo@mudominhacasa.com.br">
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="mainContent" style="margin: 0; padding:5px;">
      <h1 class="pagestitulo"><?=$edit_text['text_titulo']; ?></h1>
      
      <div class="pagestexto">
	  <?=$edit_text['text_descricao']; ?></div>
      <div><a onclick="history.go(-1)" style="cursor:pointer"><?=tep_image_button('button_back.gif', IMAGE_BUTTON_BACK)?></a></div>
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>