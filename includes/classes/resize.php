<?php
function open_image ($file) {
	$im = @imagecreatefromjpeg($file);
	if ($im !== false) { return $im; }
	$im = @imagecreatefromgif($file);
	if ($im !== false) { return $im; }
	$im = @imagecreatefrompng($file);
	if ($im !== false) { return $im; }
	$im = @imagecreatefromgd($file);
	if ($im !== false) { return $im; }
	$im = @imagecreatefromgd2($file);
	if ($im !== false) { return $im; }
	$im = @imagecreatefromwbmp($file);
	if ($im !== false) { return $im; }
	$im = @imagecreatefromxbm($file);
	if ($im !== false) { return $im; }
	$im = @imagecreatefromxpm($file);
	if ($im !== false) { return $im; }
	$im = @imagecreatefromstring(file_get_contents($file));
	if ($im !== false) { return $im; }
	return false;
}
function resizeImage($im, $la='50%', $al = '0', $type)
{
	
	if($type == 'P'){
		$largura_definida = SMALL_IMAGE_WIDTH;
		$altura_definida = SMALL_IMAGE_HEIGHT;
	}else if($type == 'G'){
		$largura_definida = IMAGE_AMPLIADA_LARGURA;
		$altura_definida = IMAGE_AMPLIADA_ALTURA;	
	}else if($type == 'SP'){
		$largura_definida = 80;
		$altura_definida = 80;
	}else if($type == 'SPP'){
		$largura_definida = 300;
		$altura_definida = 280;
	}else if($type == 'SPPE'){
		$largura_definida = 260;
		$altura_definida = 175;
	}

	//Seta todas as strings como 'string'
	settype($la, "string");
	settype($al, "string");
	
	$name_image = substr($im,0,-4);
	$type_image = substr($im,-4);
	$new_image = DIR_WS_IMAGES_PRODUTOS ."R".$name_image."_".$largura_definida."x".$altura_definida.$type_image;
	
	if (!copy(DIR_WS_IMAGES_PRODUTOS .$im, $new_image)) {
    echo "falha ao copiar $file...\n";
	}

	// Carrega Imagem
	$image = open_image($new_image);
	if ($image == false) {
		die ('<strong>Erro ao abrir imagem</strong>');
	}
	// Pega os tamanhos originais
	$width = imagesx($image);
	$height = imagesy($image);
	// Checa o redimensionamendo, se é feito por % ou px
	if (preg_match("/[0-9]{1,3}%/",$la,$lixo)) {
		$size = str_replace("%","",$la);
		settype($size, "integer");
		$percent = floatval($la);
		$percent /= 100;
		$new_width = $width * $percent;
		$new_height = $height * $percent;
	}
	elseif (isset($la) && $al == '0' && !$al && $al == 0) {
		settype($la, "integer");
		$new_width = floatval($la);
		$new_height = $height * ($new_width/$width);
		// Se apenas altura foi definida
	}
	elseif (isset($al) && $la == '0' && !$la && $la == 0) {
		settype($al, "integer");
		$new_height = floatval($al);
		$new_width = $width * ($new_height/$height);
		// Nova Largura e nova altura;
	}
	elseif (isset($la) && isset($al)) {
		$new_height = floatval($la);
		$new_width = floatval($la);
	} else {
		die ('<strong>Nenhum tamanho foi especificado!');
	}
	$image_resized = imagecreatetruecolor($new_width, $new_height);
	imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	// Display resized image
	//header('Content-type: image/jpeg');
	imagejpeg($image_resized,$new_image);
	//imagedestroy($image_resize);
	return $new_image;
}

function redimenciona($name,$type){
	$name_iqual = substr($name,19);
	$name = substr($name,19);
	
	if($type == 'P'){
		$largura_definida = SMALL_IMAGE_WIDTH;
		$altura_definida = SMALL_IMAGE_HEIGHT;
	}else if($type == 'G'){
		$largura_definida = IMAGE_AMPLIADA_LARGURA;
		$altura_definida = IMAGE_AMPLIADA_ALTURA;	
	}else if($type == 'SP'){
		$largura_definida = 80;
		$altura_definida = 80;
	}else if($type == 'SPP'){
		$largura_definida = 305;
		$altura_definida = 200;
	}else if($type == 'SPPE'){
		$largura_definida = 252;
		$altura_definida = 170;
	}else if($type == 'GG'){//para mural
		$largura_definida = 800;
		$altura_definida = 390;
	}
	
	if(($name == 'PROD_SEM_IMAGEM.jpg')or($name == 'prod_sem_imagem.jpg')){
		$new_name = 'images/imgProdutos/'.$name;
		$info_images = array($new_name,$largura_definida,$altura_definida);
		return $info_images;
	}else{
			$new_name = substr($name,0,-4);
			$type_file = substr($name,-4);
			$name_already_resize = "R".$new_name."_".$largura_definida."x".$altura_definida.$type_file;
			$caminho = DIR_WS_IMAGES_PRODUTOS.$name_already_resize;
			
			
				if(file_exists($caminho)){
					$new_name = $name_already_resize;
					$image_dimension = @getimagesize(DIR_WS_IMAGES_PRODUTOS.$new_name);
					$info_images = array(DIR_WS_IMAGES_PRODUTOS.$new_name,$image_dimension[0],$image_dimension[1]);
					return $info_images;
				}else{
						$image_dimension = @getimagesize(DIR_WS_IMAGES_PRODUTOS.$name);		
						$width = $image_dimension[0];
						$height = $image_dimension[1];
						
						if(($width < $largura_definida)&&($height < $altura_definida)){
							
							if($width > $height){
								$image_width = $width;
								$image_height = 0;
							}else if($width < $height){
								$image_width = 0;
								$image_height = $height;
							}else if($width == $height){
								$image_width = $width;
								$image_height = $height;
							}
						}else if(($width > $largura_definida)&&($height < $altura_definida)){
						$image_width = $largura_definida;
						$image_height = 0;
						}else if(($width < $largura_definida)&&($height > $altura_definida)){
						$image_width = 0;
						$image_height = $altura_definida;
						}else if(($width == $largura_definida)&&($height > $altura_definida)){
						$image_width = 0;
						$image_height = $altura_definida;
						}else if(($width > $largura_definida)&&($height == $altura_definida)){
						$image_width = $largura_definida;
						$image_height = 0;
						}else if(($width < $largura_definida)&&($height == $altura_definida)){
						$image_width = 0;
						$image_height = $altura_definida;
						}else if(($width == $largura_definida)&&($height < $altura_definida)){
						$image_width = $largura_definida;
						$image_height = 0;
						}else if(($width > $largura_definida)&&($height > $altura_definida)){
							if($width > $height){
								$image_width = $largura_definida;
								$image_height = 0;
							}else if($width < $height){
								$image_width = 0;
								$image_height = $altura_definida;
							}else if($width == $height){
								$image_width = $largura_definida;
								$image_height = $altura_definida;
							}	
						}else if(($width == $largura_definida)&&($height == $altura_definida)){
							$image_width = $largura_definida;
							$image_height = $altura_definida;						
							$info_images = array(HTTP_SERVER_PRODUTOS.$name,$image_width,$image_height);
							return $info_images;
						}
						
						$new_name = resizeImage($name,$image_width,$image_height,$type);//REDIMENCIONANDO
						$image_dimension = @getimagesize($new_name);						
						$info_images = array($new_name,$image_dimension[0],$image_dimension[1]);
						return $info_images;		
					}		
		}

}




function reduzir($name,$type){
	$img = @getimagesize(DIR_WS_IMAGES_PRODUTOS.$name);
	$vl_w = 0;
	$vl_h = 0;
	if($img)
		{
			
			if($type == 'P'){
				$pw = SMALL_IMAGE_WIDTH;
				$ph = SMALL_IMAGE_HEIGHT;
			}else if($type == 'G'){
				$pw = IMAGE_AMPLIADA_LARGURA;
				$ph = IMAGE_AMPLIADA_ALTURA;	
			}else if($type == 'SP'){
				$pw = 80;
				$ph = 80;
			}else if($type == 'SPP'){
				$pw  = 300;
				$ph = 280;
			}else if($type == 'SPPE'){
				$pw = 220;
				$ph = 150;
			}

			$w = $img[0];
			$h = $img[1];
			
			if(($w > $pw) && ($h > $ph)){
				if($w > $h){//IMAGEM  RETANGULAR, SUBSTITUI A ALTURA
					$prop = $w/$h;
					$vl_w = $pw;
					$vl_h = $ph/$prop;
				}elseif($w < $h){//IMAGEM CUMPRIDA, SUBSTITUI A LARGURA
					$prop = $h/$w;
					$vl_w = $ph/$prop;
					$vl_h = $ph;
				}elseif(($w == $h)&&($w > $pw)&&($h >$ph)){// IMAGEM QUADRADA, REDIMENCINA PELO O MENOR TAMANHO DA IMAGEM DESEJADA
					if(SMALL_IMAGE_WIDTH > SMALL_IMAGE_HEIGHT){
						$vl_w = SMALL_IMAGE_HEIGHT;
						$vl_h = SMALL_IMAGE_HEIGHT;
					}elseif(SMALL_IMAGE_WIDTH < SMALL_IMAGE_HEIGHT){
						$vl_w = SMALL_IMAGE_WIDTH;
						$vl_h = SMALL_IMAGE_WIDTH;
					}elseif(SMALL_IMAGE_WIDTH == SMALL_IMAGE_HEIGHT){
						$vl_w = SMALL_IMAGE_WIDTH;
						$vl_h = SMALL_IMAGE_HEIGHT;
					}	
				}/*elseif(($w == $h)&&($w <= $pw)&&($h <= $ph)){ 
					$vl_w = $w;
					$vl_h = $h;
					}*/
			}else{
				$vl_w = $w;
				$vl_h = $h;
			}		
		}
		 $teste = array($name,$vl_w,$vl_h);
	return $teste;
}

function clearimg(){
	$product_query = tep_db_query("select products_image  from " . TABLE_PRODUCTS);
    $product = tep_db_fetch_array($product_query);
		while($product = tep_db_fetch_array($product_query)) {
			$new_name = substr($product['products_image'],0,-4);
			$type_file = substr($product['products_image'],-4);
			$name_already_resize = "R".$new_name."_".SMALL_IMAGE_WIDTH."x".SMALL_IMAGE_HEIGHT.$type_file;
			$caminho = DIR_WS_IMAGES_PRODUTOS.$name_already_resize;
			if(file_exists($caminho)){
			chmod($caminho, 0777);   
			$cleaning = unlink($caminho);
			}
		}
	return "Todas as imagens redimencionadas foram deletadas corretamente";	
}

function createall_img_resize(){
$product_query = tep_db_query("select products_image  from " . TABLE_PRODUCTS);
$product = tep_db_fetch_array($product_query);
	while($product = tep_db_fetch_array($product_query)) {
		redimenciona($product['products_image']);
	}
	return 'Todas as imagens redimencionadas corretamente';
}

function removeImageResize($id){
	$product_query = tep_db_query("select products_image  from " . TABLE_PRODUCTS." where products_id =".$id);
    $product = tep_db_fetch_array($product_query);
	$new_name = substr($product['products_image'],0,-4);
	$type_file = substr($product['products_image'],-4);
	$name_already_resize = "R".$new_name."_".SMALL_IMAGE_WIDTH."x".SMALL_IMAGE_HEIGHT.$type_file;
	$caminho = DIR_WS_IMAGES_PRODUTOS.$name_already_resize;
	if(file_exists($caminho)){
	chmod($caminho, 0777);   
	$cleaning = unlink($caminho);
	}
}
?>