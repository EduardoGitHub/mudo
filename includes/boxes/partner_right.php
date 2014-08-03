<?php
$image_need_resize = 1;          // 1 on, 0 off - 1 acik, 0 kapali
$width = 145;                                 // image width - resim genisligi
$height = 59;   

 function thumb_kampanya2($img, $width, $height, $fill = false) {
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

  $nWidth = round($width);
  $nHeight = round($height);

  $newImg = imagecreatetruecolor($nWidth, $nHeight);
  $th_bg_color = imagecolorallocate($newImg, 255, 255, 255);
  imagefill($newImg, 0, 0, $th_bg_color);
  imagecolortransparent($newImg, $th_bg_color);

  imagecopyresampled($newImg, $im, 0, 0, 0, 0, $nWidth, $nHeight, $imgInfo[0], $imgInfo[1]);

  switch ($imgInfo[2]) {
    case 1: imagegif($newImg,$img.'partner.gif');
    return 'partner.gif';
    break;
    case 2: imagejpeg($newImg,$img.'partner.jpg');
    return 'partner.jpg';
    break;
    case 3: imagepng($newImg,$img.'partner.png');
    return 'partner.png';
    break;
    default:  trigger_error('I havea problem ', E_USER_WARNING);  break;
  }

  imagedestroy($newImg);
}
$random_partner_select = tep_db_query("select banners_title, banners_url, banners_image, banners_html_text, status from partners where banners_image <> ''");
$random_partner = tep_db_fetch_array($random_partner_select);
if(mysql_num_rows($random_partner_select)>0){
?>
<div class="box" id="parceiros">
<div class="lay_bordaBox"><span>Parceiros</span></div>
<div class="boxconteudo">
<?php
for($cont =0; $cont < tep_db_num_rows($random_partner_select); $cont++){
	if($random_partner['banners_image'] <>''){
		
	if($image_need_resize == 1){
	  $new_image = $random_partner['banners_image'].thumb_kampanya2('images/Imgprodutos/'.$random_partner['banners_image'], $width, $height,false);
	  }else{
	  $new_image = $random_partner['banners_image'];
	  }
	  $image_size = @getimagesize(DIR_WS_IMAGES_PRODUTOS.$new_image);
	if (empty($random_partner['banners_html_text'])){
	$src = '<img src="'.DIR_WS_IMAGES_PRODUTOS.$new_image.'" border="0" width="'.$image_size[0].'" height="'.$image_size[1].'"/>';
	}else
	$src = $random_partner['banners_html_text'];		
	
	if ($random_partner['status'] == 1){
		
		if ($random_partner['banners_url'] != ''){
		echo '<div style="border:1px solid #ccc; margin:0 auto; margin-top:5px; text-align:center;"><a href="'.$random_partner['banners_url'].'" title="'.$random_partner['banners_title'].'">'.$src.'</a></div>';
		}else 
		echo '<div style="border:1px solid #ccc; margin:0 auto; margin-top:5px; text-align:center;">'.$src.'</div>';
		}
		
	}
		
	$random_partner = tep_db_fetch_array($random_partner_select);
	}
?>
</div>
</div>
<? }?>