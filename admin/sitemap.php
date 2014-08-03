<?php
require('includes/application_top.php');
$grava = '';
function sitemap($parent_id=0,$parent_string=''){
	$result = tep_db_query("SELECT categories_id FROM ". TABLE_CATEGORIES." ORDER BY `categories_id`");
	while ($row=tep_db_fetch_array($result)) {
//		print_r($row);
		$grava .= '<url><loc>http://'.$_SERVER['HTTP_HOST'].'/index.php?cPath='.$parent_string.$row['categories_id'].'</loc><priority>0.9</priority><lastmod>'.date("Y-m-d").'T00:00:00+00:00</lastmod><changefreq>daily</changefreq></url>'."\n";
		$rsl = tep_db_query("SELECT ptc.products_id, pd.products_name FROM ".TABLE_PRODUCTS_TO_CATEGORIES." ptc, products_description pd, products p WHERE categories_id='".$row['categories_id']."' and pd.products_id = ptc.products_id and ptc.products_id = p.products_id and p.products_status = 1");
		while ($rw=tep_db_fetch_array($rsl)) {
			
			
			
			$car_a = ' -Á-À-Â-Ã-Ä-É-È-Ê-Ë-Í-Ì-Î-Ï-Ó-Ò-Ô-Õ-Ö-Ú-Ù-Û-Ü-Ç-á-à-â-ã-ä-é-è-ê-ë-í-ì-î-ï-ó-ò-ô-õ-ö-ú-ù-û-ü-ç-º->-<-(-)-/-*-"';
			$car_s = '_-A-A-A-A-A-E-E-E-E-I-I-I-I-O-O-O-O-O-U-U-U-U-C-a-a-a-a-a-e-e-e-e-i-i-i-i-o-o-o-o-o-u-u-u-u-c---------';
			$str = $rw['products_name'];
			$str = strtolower($str); //Deixa todos os caracteres em minúsculos 
			$texto = str_replace(explode('-', $car_a), explode('-', $car_s), $str);//Percorre o texto trocando as letras
			$name = str_replace(" ", "-", $texto);//Retira os espaços
			$novo_nome = strtoupper($name);
			$grava .= '<url><loc>http://'.$_SERVER['HTTP_HOST'].'/product_info.php?cPath='.$parent_string.$row['categories_id'].'&amp;products_id='.$rw['products_id'].'&amp;produto='.$novo_nome.'</loc><priority>0.9</priority><lastmod>'.date("Y-m-d").'T00:00:00+00:00</lastmod><changefreq>monthly</changefreq></url>'."\n";
			$grava .= '<url><loc>http://'.$_SERVER['HTTP_HOST'].'/product_reviews.php?products_id='.$rw['products_id'].'&amp;produto='.$novo_nome.'</loc><priority>0.1</priority><lastmod>'.date("Y-m-d").'T00:00:00+00:00</lastmod><changefreq>monthly</changefreq></url>'."\n";
			$grava .= '<url><loc>http://'.$_SERVER['HTTP_HOST'].'/tell_a_friend.php?products_id='.$rw['products_id'].'&amp;produto='.$novo_nome.'</loc><priority>0.1</priority><lastmod>'.date("Y-m-d").'T00:00:00+00:00</lastmod><changefreq>monthly</changefreq></url>'."\n";
			$grava .= '<url><loc>http://'.$_SERVER['HTTP_HOST'].'/shopping_cart.php?produto='.$novo_nome.'</loc><priority>0.1</priority><lastmod>'.date("Y-m-d").'T00:00:00+00:00</lastmod><changefreq>monthly</changefreq></url>'."\n";
			
			
		}
		//sitemap($row['categories_id'],$parent_string.$row['categories_id'].'_');
	}
	
	return $grava;
}

if((isset($_POST['gerarSitemap'])) && ($_POST['gerarSitemap'] =='ok')){
$grava .= '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/09/sitemap.xsd">
<url><loc>http://'.$_SERVER['HTTP_HOST'].'/</loc><priority>0.5</priority><lastmod>'.date("Y-m-d").'T04:27:55+00:00</lastmod><changefreq>monthly</changefreq></url>';
$grava .= sitemap();
$grava .= '</urlset>';

$arquivo = "../sitemap.xml";
$open = fopen($arquivo,"w");
chmod($arquivo, 0777);	
$write = fwrite($open,$grava);
fclose($open);


$arquivo = "../robots.txt";
$open = fopen($arquivo,"w");
chmod($arquivo, 0777);	
$grava2 ='User-agent: *
Allow: /

Sitemap: '.HTTP_SERVER.'/sitemap.xml';
$write = fwrite($open,$grava2);
fclose($open);


}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title>Atualiza&ccedil;&atilde;o da Tabela do PAC</title>
<link rel="stylesheet" type="text/css" href="./includes/stylesheet.css">
</head>
<body>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0" >
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">Google Site Map</td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td>
            <table border="0" cellspacing="0" cellpadding="3">

             
             
             
                	      
              <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              
              
              <tr><td class="smallText">
            
              Este recurso é utilizado para os motores de busca do Google, Yahoo entre outros que ajuda os buscadores a naveguarem melhor em seu site para indexar todo conteudo existente.Isso ajuda o seu site a se posicionar melhor nas buscas.<br/>
              <form name="googlesitemap" method="post">
              	<input type="hidden" name="gerarSitemap" value="ok" />
              	<input type="submit" value="Gerar Site Map" />
              </form>
                                                      
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>		     
      </tr>
   
      
      <tr>
        <td>

        </td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>