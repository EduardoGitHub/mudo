<?php
  require('includes/application_top.php');
  define('NAVBAR_TITLE', 'Galeria de Fotos');
define('HEADING_TITLE', 'Galeria de Fotos');
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
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<link rel="stylesheet" href="includes/librays/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="sidebar1"><?php require(DIR_WS_INCLUDES . 'column_left.php'); ?></div>
  	<div class="pagestitulo"><span>Mande sua foto!</span></div>
        
        
      <div class="pagestexto">

        <br>
                &nbsp;&nbsp;&nbsp;Cada foto enviada, caso aprovada, dará a você R$ 10,00 em créditos para comprar na loja, a possibilidade de participar periodicamente de promoções para clientes exclusivos, além de garantir a exposição de sua “obra-prima” em nossa galeria de arte pra todo mundo ver. 
    	<br><br>


<?
	  			$galery_new_query = "select * from ".TABLE_GALLERY_IMAGES;
				$galery_split = new splitPageResults($galery_new_query, 12);
				$galery_query = tep_db_query($galery_split->sql_query);

		
		?>
      
      <div class="gallery clearfix">
      	<div class="galeriafotos">
        	<ul>
               <?PHP                 
			   $cont = 0;
    			while ($gallery_new = tep_db_fetch_array($galery_query)) {
					$new_image = $gallery_new['gallery_foto'].thumb_galery('images/ImgProdutos/Fotos/'.$gallery_new['gallery_foto'], 185, 140,false);
					$showFotos .= '<li><a href="images/ImgProdutos/Fotos/'.$gallery_new['gallery_foto'].'" rel="prettyPhoto[gallery1]" title="'.$gallery_new['gallery_adesivo'].'<br/>'.$gallery_new['gallery_autor'].' <br /> '.$gallery_new['gallery_description'].'"><img src="images/ImgProdutos/Fotos/'.$new_image.'" rel="prettyPhoto[gallery1]"/></a><br /> <span>enviado por</span><br /><span class="autorfoto">'.$gallery_new['gallery_autor'].'</span> 
					</li>';
					
					$cont++;
				}
				echo $showFotos;
			 	?>
            </ul>
         </div>
  	</div>
    
   

      </div>
       
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
<script src="includes/librays/prettyPhoto/js/jquery.prettyPhoto.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
	$(".gallery a[rel^='prettyPhoto']").prettyPhoto({theme:'facebook'});
});
</script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>