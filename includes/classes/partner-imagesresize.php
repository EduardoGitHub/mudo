<?PHP
$image_need_resize = 1;          // 1 on, 0 off - 1 acik, 0 kapali
$width = 160;                                 // image width - resim genisligi
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


//


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

?>