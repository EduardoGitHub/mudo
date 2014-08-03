<?php
/*
  $Id: kampanya.php, v 1 03/08/2008 22:59

  osCommerce, Açýk Kaynak Kodlu E-Ticaret Çözümleri
  http://www.oscommerce.com.tr

  Copyright (c) 2007 osCommerce Türkiye

  GNU Genel Kamu Lisansý (GPL) altýnda sunulmuþtur
*/
// (turkce)  Ayarlar
// (english) Configuration
       require('includes/classes/class.image-resize.php');

  $kampanya = new currencies();
  function savefile($xmldata, $filename){
        $filename_dir  = DIR_FS_CATALOG . DIR_WS_IMAGES . $filename;
        if ($fp = fopen($filename_dir, 'w+')){
                  fwrite($fp, $xmldata);
                  fclose($fp);
                  return true;
        }
        else  return false;
  }
  // (turkce) Eðer resmin boyutlandirilmasini istiyorsaniz asagidaki ayarlari degistiriniz
// (english)If you want to resize images change below lines
$image_need_resize = 1;          // 1 on, 0 off - 1 acik, 0 kapali
$width = 100;                                 // image width - resim genisligi
$height = 114;                                 // image height - resim yuksekligi
$limit_product_number = 12; // how many products want to show - kac tane urun gostermek istiyorsunuz
// (turkce)  Ayarlar bitti
// (english) Configuration end

 function thumb_kampanya($img, $width, $height, $fill = false) {
  if (!extension_loaded('gd') && !extension_loaded('gd2')) {
                trigger_error("No dispones de la libreria GD para generar la imagen.", E_USER_WARNING);
                return false;
        }

  //$ext = strtolower(array_pop(explode(".",$img)));
  $imgInfo = getimagesize($img);
  switch ($imgInfo[2]) {
    case 1: $im = imagecreatefromgif($img); break;
    case 2: $im = imagecreatefromjpeg($img);  break;
    case 3: $im = imagecreatefrompng($img); break;
    default:  trigger_error('Tipo de imagen no reconocido.', E_USER_WARNING);  break;
  }

            $ratio = $imgInfo[1] / $imgInfo[0];

            // Set the width and height to the proper ratio
            if (!$width && $height) {
                $ratio = $height / $imgInfo[1];
                $width = intval($imgInfo[0] * $ratio);
            } elseif ($width && !$height) {
                $ratio = $width / $imgInfo[0];
                $height = intval($imgInfo[1] * $ratio);
            } elseif (!$width && !$height) {
                $width = $imgInfo[0];
                $height = $imgInfo[1];
            }

            // Scale the image if not the original size
            if ($imgInfo[0] != $width || $imgInfo[1] != $height) {
                $rx = $imgInfo[0] / $width;
                $ry = $imgInfo[1] / $height;

                if ($rx < $ry) {
                    $width = intval($height / $ratio);
                } else {
                    $height = intval($width * $ratio);
                }
            }
//
  $nWidth = round($width);
  $nHeight = round($height);

  $newImg = imagecreatetruecolor($nWidth, $nHeight);
  $th_bg_color = imagecolorallocate($newImg, 255, 255, 255);
  imagefill($newImg, 0, 0, $th_bg_color);
  imagecolortransparent($newImg, $th_bg_color);

  imagecopyresampled($newImg, $im, 0, 0, 0, 0, $nWidth, $nHeight, $imgInfo[0], $imgInfo[1]);

  $img = str_replace('Imgprodutos/','',$img);
  switch ($imgInfo[2]) {
    case 1: imagegif($newImg,$img.'kampanya.gif');
    return 'kampanya.gif';
    break;
    case 2: imagejpeg($newImg,$img.'kampanya.jpg');
    return 'kampanya.jpg';
    break;
    case 3: imagepng($newImg,$img.'kampanya.png');
    return 'kampanya.png';
    break;
    default:  trigger_error('I havea problem ', E_USER_WARNING);  break;
  }

  imagedestroy($newImg);
}
// (turkce)  xml dosyasini olustur
// (english) create xml file
$xmlfile='<?xml version="1.0" encoding="'.CHARSET.'"?>'."\n";
$xmlfile.="<products>\n";

    $specials_query_raw = "select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, f.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " f where p.products_status = '1' and f.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and f.status = '1' order by rand() DESC LIMIT $limit_product_number";

$specials_query = tep_db_query($specials_query_raw);
    while ($specials = tep_db_fetch_array($specials_query)) {
      if ((!isset($HTTP_GET_VARS['sID']) || (isset($HTTP_GET_VARS['sID']) && ($HTTP_GET_VARS['sID'] == $specials['specials_id']))) && !isset($sInfo)) {
        $products_query = tep_db_query("select products_image from " . TABLE_PRODUCTS . " where products_id = '" . (int)$specials['products_id'] . "'");
        $products = tep_db_fetch_array($products_query);
		$special_price = tep_db_query(" SELECT specials_new_products_price FROM " . TABLE_SPECIALS . " where products_id = '" . (int)$specials['products_id'] . "'");	    $new_price = tep_db_fetch_array($special_price);	    if ($new_price) 			{ $specials['products_price'] = $new_price['specials_new_products_price']; 
		}             
      }
      if($image_need_resize == 1){
      $new_image = $specials['products_image'].thumb_kampanya(HTTP_SERVER_PRODUTOS.$specials['products_image'], $width, $height,false);
      }else{
      $new_image = $specials['products_image'];
      }
	  	 
      $car_a = 'º->-<-"';
	  $car_s = ' - - -';
	  $texto = str_replace(explode('-', $car_a), explode('-', $car_s), $specials['products_name']);//Percorre o texto trocando as letras

      $xmlfile .= "\t\t" . '<product filename="'.$new_image.'" productname="'.$texto.'" productprice="'.$kampanya->display_price($specials['products_price'], tep_get_tax_rate($specials['products_tax_class_id'])).'" url="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials['products_id']) . '" />'."\n";

    }
$xmlfile.="</products>\n";


// (turkce)  xml dosyasini images klasoru altina kaydet
// (english) save xml file under images directory
savefile($xmlfile, 'kampanya.xml');
?>
<div id="flashcontent" style="z-index: 0; position:relative; ">
  Não foi possivel visualizar o flash.
</div>

<script type="text/javascript" src="includes/swfobject.js"></script>
<script type="text/javascript">
var so = new SWFObject("includes/kampanya.swf", "mymovie", "100%", "200", "8", "#FFFFFF");
so.write("flashcontent");
</script>