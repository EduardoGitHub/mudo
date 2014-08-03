<?php
require('includes/application_top.php');

if(LOGIN_AUTHENTICCATION=='True'){
// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
 } 
  

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_INFO);

  $product_check_query = tep_db_query("select count(*) as total, products_image from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
  $product_check = tep_db_fetch_array($product_check_query);
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<?php
/*** Begin Header Tags SEO ***/
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
  <title><?php echo TITLE; ?></title>
<?php
}
?>
<link rel="image_src" href="<?=HTTP_SERVER.'file://'.DIR_WS_IMAGES_PRODUTOS.$product_check['products_image']?>" />
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<link rel="stylesheet" href="includes/librays/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<link rel="stylesheet" type="text/css" href="includes/librays/jcrop/jquery.Jcrop.min.css" />

<style type="text/css">

.Produtos{ padding:3px; }
.ProdutosImagem{width:180px; float:left; text-align:center;}
.ProdutosImagensExtra{width:380px; float:left}
.ProdutosImagensExtra a{ float:left; margin-left:3px;}
.ProdutosImagemOpcoes{ float:left;  left:210px; top:0; width:100%;}
.ProdutosAtributos{ border:1px dashed #CCC; padding:5px; margin:2px; width:300px;}
.ml5{ margin:5px 0 10px 0; text-align:right}
.ml5 h1{ font-size:23px; color: #999; text-decoration: none; font-weight: bold; font-family: arial; margin:0; padding:0; }
/*ABAS*/

#abas{ margin:0; padding:0; list-style:none;}
#abas li{ float:left; padding-top:10px; padding-bottom:10px; margin:0;}
#abas li a{ border:1px solid #999; text-decoration:none; margin:0px; padding:10px; background-image:url(images/abasinativo.png); color:#005B88; font-family:Tahoma; font-size:11px; text-transform:uppercase; font-weight:bold;}
#abas li a:hover{background:#999; color:#f0f0f0;}
#abas a.selected{background:#999; color:#f0f0f0;}
.contaba{font-family:Tahoma; font-size:12px; color:#333}

.optionTamanho{ font-family:Tahoma; font-size:12px; background-color:#ECEAEB; border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; width:300px; min-height:90px; padding:2px; float:left; margin:15px 0 0 10px;}
.optionTamanho .input{ float:left; width:10px; margin-left:10px; margin-top:10px;}
.optionTamanho .image{ float:left; width:50px; height:40px; text-align:center; margin-top:5px;}
.optionTamanho .info{ float:left; width:140px; margin-top:5px; text-align:center}
.optionTamanho .valor{ float:right; width:90px; margin-top:10px; color:#23793A}
.optionTamanho .info b{color:#CC6E6E}
.optionTamanho .desc{ background-color:#FFFDFE; margin:5px; width:280x; min-height:35px; padding:2px; color:#999}

.optionEspelhado{padding:10px 0 0 20px; clear:left}
.optionEspelhado ul { list-style:none; font-family:Tahoma; font-size:12px; color:#000; margin:0; padding:0; float:left; clear:left}
.optionEspelhado li{ float:left; padding-left:10px; text-align:center; padding-left:15px;}
.optionEspelhado p { clear: both; float: none; position: relative; margin:0; padding-left:15px; text-align:center  }
.optionEspelhado p input { left: 10px; position: absolute; top: 2px; }
.optionEspelhado p label {  display: block; margin-left: 15px; }



.optionMidiaImpressao {padding:0 0 10px 0; clear:left}
.optionMidiaImpressao ul { list-style:none; font-family:Tahoma; font-size:12px; color:#000; margin:0; padding:0; float:left; clear:left}
.optionMidiaImpressao li{ float:left; padding-left:10px; width:290px;}
.optionMidiaImpressao p { clear: both; float: none; position: relative; margin:0; padding:0;  }
.optionMidiaImpressao p input { left: 0px; position: absolute; top: 2px; }
.optionMidiaImpressao p label {  display: block; margin-left: 15px; }


.options{ font-family:Tahoma; font-size:12px; background-color:#CAC7BE; border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; width:450px; height:70px; margin-top:17px;}
.options .input{ float:left; width:10px; margin-left:10px; margin-top:10px;}
.options .image{ float:left; width:50px; height:40px; text-align:center; margin-top:5px;}
.options .info{ float:left; width:180px; margin:30px 0 0 10px; color:#000}
.options .info b{color:#781613}
.options .desc{ background-color:#E6E2E3; margin:5px; width:440px; height:35px;}

.optionCor{ width:700px; margin:15px 0 0 0; }
.optionCor ul { list-style:none; margin:0; padding:0; float:left; clear:left}
.optionCor li{ width:130px; height:22px; float:left; margin:2px; padding:0 0 0 3px; border:1px solid #333}
.optionCor li span{ padding-left:5px; color:#FFF; font-size:11px; font-weight:bold; font-family:Tahoma;}


.botoesProdutos{ width:900px; margin:0 auto}
.botoesProdutos ul{ list-style:none; margin:0; padding:0;}
.botoesProdutos li{ float:left; margin-right:5px; background-color:#CCC; color:#FFF; padding:5px}
.botoesProdutos li a{ text-decoration:none; color:#FFF; font-family:Tahoma; font-weight:bold; font-size:14px;}

.FormasdePagamento{ width:900px; margin:15px auto; text-align:center}

.DescricaoProduto{ width:900px; margin:20px auto; text-align:justify; font-family:Tahoma; font-size:14px; line-height:20px;}

/*ZOOM*/
div.jqZoomTitle{z-index:5000; text-align:center; font-size:11px; font-family:Tahoma; height:16px; padding-top:2px; position:absolute; top: 0px; left: 0px; width: 100%; color: #FFF; background: #999}
.jqZoomPup{overflow:hidden; -moz-opacity:0.6; opacity: 0.6; filter: alpha(opacity = 60); z-index:10; cursor:crosshair; }
.jqZoomPup img { border: 0px; }
.preload{ -moz-opacity:0.8; opacity: 0.8; filter: alpha(opacity = 80); color: #333; font-size: 12px; font-family: Tahoma; text-decoration: none; border: 1px solid #CCC; background-color: white; padding: 8px; text-align:center; background-image: url(images/loading.gif); background-repeat: no-repeat; background-position: 43px 30px; width:90px; * width:100px; height:43px; *height:55px; z-index:10; position:absolute; top:3px; left:3px; }
.jqZoomWindow { border: 1px solid #999; background-color: #FFF; }


.headtop{font-family:'Tahoma';font-size:14px;background-color:#4E4E4E;font-weight:bold;text-align:center;color:#ffffff;border:1px solid #ffffff;}
.head{font-family:'Tahoma';font-size:12px;background-color:#F1F1F1;font-weight:bold;text-align:center;color:#333333;border:1px solid #ffffff;}
.head2{font-family:'Tahoma';font-size:12px;background-color:#4E4E4E;font-weight:bold;text-align:center;color:#ffffff;border:1px solid #ffffff;}
.res1{font-family:'Tahoma';font-size:12px;background-color:#ffffff;text-align:left;color:#000000;}
.res2{font-family:'Tahoma';font-size:12px;background-color:#f1f1f1;text-align:left;color:#000000;border:1px solid #ffffff;}
.res4{font-family:'Tahoma';font-size:12px;background-color:#ffffff;font-weight:bold;text-align:left;color:#666666;}
form{ padding:0; margin:0;}

.textoMenor{float:left; color:#333; font-size:12px; margin:15px 0 15px 0; text-indent:30px; text-align:justify; font-family:Tahoma; width:320px; line-height:18px}
.pr_price{ font-size: 12px; color: #000; font-weight: bold; font-family: Tahoma; }
.textdesconto{color:#000; font-family:Tahoma; font-size:11px; font-weight:normal;}
.textdesconto span{ color:#666; font-weight:bold}


/*MURAL*/

.optionMural{margin:15px 0 0 0; padding:15px; width:500px; border:1px solid #F5F5F5; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px;}
.optionMural ul{ list-style:none; margin:0; padding:0;}
.optionMural li{ float:left; padding-left:15px;}
.optionMural li.titulos{ font-weight:bold; font-family:Tahoma; font-size:12px;}

.optionMuralList{margin:15px 0 0 0; padding:15px; width:500px; border:1px solid #F5F5F5; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; font-family:Tahoma; font-size:12px;}
.optionMuralList ul{ list-style:none; margin:0; padding:0;}
.optionMuralList li{ padding:10px;}
.optionMuralList li label{ padding-left:10px;}
.optionMuralList li.titulos{ font-weight:bold; font-family:Tahoma; font-size:12px;}

.imageGray{-webkit-filter: grayscale(100%);  filter: gray; filter: grayscale(100%); -ms-filter:grayscale; filter: url('#grayscale');  filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale");
}
.imageInvert{-moz-transform: scaleX(-1);-o-transform: scaleX(-1);-webkit-transform: scaleX(-1);transform: scaleX(-1);filter: FlipH; -ms-filter: "FlipH";}

.tamanhopersonalizado td{ font-family:Tahoma; font-size:12px; color:#000}
</style>
</head>
<body>
  <div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container" style="border:0">
  <div id="mainContent" style="margin:0;">
  <div class="Produtos">
  
   <?php echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'action=add_product'),'post', 'onsubmit="return checkform(this);" id="cart_quantity"');?>  
   
  	<?php if ($product_check['total'] < 1) {?>
    <div>
		<?php new infoBox(array(array('text' => TEXT_PRODUCT_NOT_FOUND))); ?><br />
        <?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?>
    </div>
    <?php
		  } else {
		    $product_info_query = tep_db_query("select p.products_id, p.products_type, p.products_murals_max_width, p.products_murals_max_height, pd.products_name, pd.products_description, pd.products_description_simple, p.products_model, p.products_weight, p.products_pack_length, p.products_pack_width, p.products_pack_height, p.products_pack_diameter, p.products_youtube, p.products_quantity, p.products_image, pd.products_url, pd.products_availability, p.products_price, p.products_price_revenda, p.products_free_shipping, p.products_warranty, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
		    $product_info = tep_db_fetch_array($product_info_query);
			
			//PEGAR FORNECEDOR
			$product_get_query = tep_db_query("select m.manufacturers_name, mi.manufacturers_url from manufacturers_info mi, manufacturers m where m.manufacturers_id =".$product_info['manufacturers_id']." and mi.manufacturers_id = m.manufacturers_id");
			$product_get = tep_db_fetch_array($product_get_query);
			
		
		    tep_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set products_viewed = products_viewed+1 where products_id = '" . (int)$_GET['products_id'] . "' and language_id = '" . (int)$languages_id . "'");
			if(!isset($customer_revenda)||($customer_revenda==0)){//VERIFICANDO TIPO DE CONSUMIDOR	
				if($not_show =='False'){//VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
				if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
				  $products_price = '<br /><div id="pricedesconto"><span style="color:#333;">de</span> <span class="pr_price" style="color:#656565; font-size:15px;"><s>' . $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</s></span></div><br/><span class="pr_price" style="color:#158E1A;">por </span><span class="pr_price" style="color:#158E1A; font-size:30px;" id="precoProduto">' . $currencies->display_price($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span><br/><span class="textdesconto" id="txtDesconto" style="font-size:14px"><br/><br/>' . tep_display_parcela($new_price).'</span><br /><span class="textdesconto" id="txtDescontoAvista" style="font-size:14px">'.tep_discount_products($product_info['products_id']).'</span><br /><br />';
				$preco = $new_price;
				} else {
				  $products_price ='<br /><span class="pr_price" style="color:#158E1A;">por </span> <span class="pr_price" style="color:#158E1A; font-size:30px;" id="precoProduto">'. $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])).'</span><br/><span class="textdesconto" id="txtDesconto" style="font-size:14px"><br/>' . tep_display_parcela($product_info['products_price']).'</span><br /><span class="textdesconto" id="txtDescontoAvista" style="font-size:14px">'.tep_discount_products($product_info['products_id']).'</span><br /><br />';
				  $preco = $product_info['products_price'];
				}
				}// FIM VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
			}else{
			
				if($not_show =='False'){//VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
				if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
				  //$products_price = '<span class="pr_price" style="padding-right:0px; color:#7F7F7F;font-size:11px">de <s>' . $currencies->display_price($product_info['products_price_revenda'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</s></span><br/>&nbsp;por <span class="pr_price" style="font-size:20px;">' . $currencies->display_price($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span><span class="textdesconto"><br/>' . tep_display_parcela($product_info['products_price_revenda']).'</span><br /><br /><br />';
				   $products_price = '<br /><span class="pr_price" style="color:#158E1A; font-size:30px;" id="precoProduto">' . $currencies->display_price($product_info['products_price_revenda'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span><br/><span class="textdesconto" id="txtDesconto"><br/>' . tep_display_parcela($product_info['products_price_revenda']).'</span><br /><br /><br />';
				   $preco = $product_info['products_price_revenda'];
				} else {
				  $products_price ='<br /><span class="pr_price" style="color:#158E1A; font-size:30px;" id="precoProduto">'. $currencies->display_price($product_info['products_price_revenda'], tep_get_tax_rate($product_info['products_tax_class_id'])).'<br/><br/></span><span class="textdesconto" id="txtDesconto">' . tep_display_parcela($product_info['products_price_revenda']).'</span><br /><br /><br />';
				  $preco = $product_info['products_price_revenda'];
				}
				}// FIM VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
			}
		
		    if (tep_not_null($product_info['products_model'])) {
		      //$products_name = $product_info['products_name'] . '<br /><span class="smallText">[' . $product_info['products_model'] . ']</span>';
			  $products_name = $product_info['products_name'];
		    } else {
		      $products_name = $product_info['products_name'];
		    }	
			$products_weight = $product_info['products_weight'];	
			
			if($not_show =='False'){//VERIFICA SE OS PREÇOS E O BOTÃO DE COMPRA PODE SER EXIBIDO  (SHOW_STORE_FOR_USERS )
			   if(($product_info['products_quantity']<=0)&&(STORE_OPENED_TO_BUY == 'True')){
				$ver_num_products = '&raquo; Disponibilidade: <a href="' . tep_href_link(FILENAME_NOTIFYME_PRODUCT, 'products_id=' . $product_info['products_id']) . '" style="font-style:italic;text-decoration:underline;">'.ENTRY_TEXT_PRODUCTS_SOB_CONSULTA.'</a>';
				$comprar ='';
				$frete = '';
			}elseif(($product_info['products_quantity']>0)&&(STORE_OPENED_TO_BUY == 'True')){
				if($product_info['products_availability'] !='')$ver_num_products = '&raquo; Disponibilidade: <b>'.$product_info['products_availability'].'</b>';
				else
				$ver_num_products = '&raquo; Disponibilidade: <b>Pronta Entrega</b>';
				$comprar = tep_draw_hidden_field('products_id', $product_info['products_id']) . tep_image_submit('botao-comprar-produto.jpg', IMAGE_BUTTON_BUY_NOW);
				if( ($product_info['products_weight'] == 0) || ($product_info['products_free_shipping'] ==1))
                    $frete =  '<img src="includes/languages/portugues/images/buttons/frete_gratis.gif" alt="'.TEXT_FREE_SHIPPING_TO_BRASIL.'" width="125" height="52" />';
			}
		}
	?>
    <div>
        	<div style="float:left"><a onclick="history.go(-1)" style="cursor:pointer;"><?=tep_image_button('botao-voltarr-produto.jpg', IMAGE_BUTTON_BACK) ?></a></div>
            <div class="CaminhoNav"><?=$breadcrumb->trail(' >> '); ?></div>
            <div style="float:right"><div class="ml5"><h1><?=$products_name?></h1> <span style="font-weight:bold; font-size:15px; color:#999; font-style:italic;font-family: arial;">por mudominhacasa</span> </div></div>
        	<div style="clear:both"></div>
        </div>
    
<? if($product_info['products_type']==1){// Se for produto adesivo ?>
    <div style="width:630px; float:left;">
    	
        <div style="width:600px">
        	<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
            <a class="addthis_button_tweet"></a>
            <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
            <a class="addthis_counter addthis_pill_style"></a>
         </div>

    	<?php if (tep_not_null($product_info['products_image'])) { 
			//echo '<link rel="image_src" href="'.DIR_WS_IMAGES_PRODUTOS.$product_info['products_image'].'" />';?>
    	<div>
			<? echo tep_image_produto(DIR_WS_IMAGES_PRODUTOS . $product_info['products_image'], $product_info['products_name'], 'YES','G', 'vspace="0" ') ?>
            <div style="margin:5px 0 0 0; border:1px dashed #CCC; width:590px; padding:5px;" class="gallery clearfix">
           		<div style="float:left;"><a href="<?=tep_href_link(DIR_WS_IMAGES_PRODUTOS . htmlentities($product_info['products_image']))?>" rel="prettyPhoto[gallery1]"><img src="images/amplicar-imagens.jpg"  /></a></div> 
                <div class="ProdutosImagensExtra">
                <?php 
                    if (DISPLAY_EXTRA_IMAGES == 'true'){
                     if ($product_check['total'] >= 1) {
                       include ('products_extra_images.php');
                     }
                    } 
                ?>
                </div>
               <div style="clear:both"></div>
            </div>
        </div>
        <?php } ?>
    
    </div>
    <div style="width:340px; float:right; margin-top:10px;">
    
			<div style="float:right; width:255px; margin:20px 40px 0 0"><?=$comprar//botão de comprar?></div>
            <div class="ch6" style="float:right; width:330px; margin:0 5px 0 0; text-align:center"><? if($product_info['products_quantity']>0) echo $products_price?></div>
            
            <div style="float:left; width:141px; margin:10px 0 20px 100px;"><img src="images/pagseguro_info_products.jpg" /></div>
            
            <div class="textoMenor"><?=$product_info['products_description_simple']?></div>

    		<div style="clear:both"></div>
    </div>
    
    <div style="width:990px; float:left; margin:20px 0 0 0">
    	<div style="float:left; margin:10px;"><? echo tep_display_option($_GET['products_id'], '1', $languages_id, false, $preco); //Atributos tamanho?></div>
        <div style="float:left"><?=tep_display_option($_GET['products_id'], '2', $languages_id);//Atributos cor ?></div>   
        <div style="float:left; margin:50px 0 0 30px; text-align:center"><?=tep_display_option($_GET['products_id'], '3', $languages_id);//Atributos espelhado ?></div> 
    	<div style="clear:both"></div>
    </div>
    
    
    
    
    
<? } else if($product_info['products_type']==2){ //Se for produto mural ?>   

        <div style="float:left; width:640px;" class="gallery clearfix">
        	<div style="width:400px; float:left; font-family:Tahoma; font-size:12px; padding:20px 0 0 10px; font-weight:bold">Veja a aplicação no ambiente</div>
            <div style="float:right; width:200px; margin-right:20px"><a href="<?=tep_href_link(DIR_WS_IMAGES_PRODUTOS . htmlentities($product_info['products_image']))?>" rel="prettyPhoto[gallery1]"><img src="images/amplicar-imagens.jpg"  /></a></div>
            <div style="float:left">
            <?php 
                if (DISPLAY_EXTRA_IMAGES == 'true'){
                 if ($product_check['total'] >= 1) {
                   include ('products_extra_images_mural.php');
                 }
                } 
            ?>
            </div>
        </div>
        <div style="width:340px; float:right; border:1px solid #F5F5F5; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px;">
        
                <div style="float:right; width:255px; margin:20px 40px 0 0"><?=$comprar//botão de comprar?></div>
                <div class="ch6" style="float:right; width:330px; margin:0 5px 0 0; text-align:center"><? if($product_info['products_quantity']>0) echo $products_price?></div>
                
                <div style="float:left; width:141px; margin:10px 0 20px 100px;"><img src="images/pagseguro_info_products.jpg" /></div>
    
                <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
        
        <div style="margin:15px 0 0 0; padding:10px; text-align:center"><? echo tep_image_produto(DIR_WS_IMAGES_PRODUTOS . $product_info['products_image'], $product_info['products_name'], 'YES','GG', 'vspace="0" id="imagemural" ') ?></div>

        
        <div style="width:990px; float:left; margin:20px 0 0 0">
            <div style="float:left; width:510px;">
                <?=tep_display_option($_GET['products_id'], '4', $languages_id);//Atributos posicao ?>
                <?=tep_display_option($_GET['products_id'], '5', $languages_id);//Atributos cor ?>
                <?=tep_display_option($_GET['products_id'], '6', $languages_id);//Atributos material ?>
                <div style="clear:both"></div>
            </div>
            <div style="float:right; width:400px; margin:15px 10px 15px 0" class="optionMural">
            	<ul>
                	<li class="titulos">Escolha um tamanho Proporcional:</li>
                    <li>
                   	  <select name="tamanhoproporcial">
							<?
                                $arr = array('90','80','70','60','50','40','30','20','10');
                                for($cont = 0; $cont < 9; $cont++){
                                    $altSugerida = round((($product_info['products_murals_max_width'] * $arr[$cont])/100)/100,2);
                                    $larSugerida = round((($product_info['products_murals_max_height'] * $arr[$cont])/100)/100,2);
                                    echo '<option>'.$larSugerida.' m x '.$altSugerida.' m</option>';
                                }
                            ?>
                      </select>
                    </li>
                </ul>
                <div style="clear:both"></div>
              <br /><br /><center>-- OU --</center><br /><br />
                <table width="301" height="129" class="tamanhopersonalizado">
                	<tr><td colspan="4"><b>Escolha um tamanho Personalizado:</b></td></tr>
                	<tr>
                    	<td style="text-align:right"><b>Comprimento:</b></td>
                        <td><input type="text" size="5" />m</td>
                        <td></td>
                        <td><input type="text" size="5" />cm</td>
                    </tr>
                    <tr>
                    	<td style="text-align:right"><b>Altura:</b></td>
                        <td><input type="text" size="5" />m</td>
                        <td></td>
                        <td><input type="text" size="5" />cm</td>
                    </tr>
                </table>
            </div>
            <div style="clear:both"></div>
    	</div>

<? } ?>  
    <div style="clear:both"></div>    
   
    
    
    <div style="width:990px; float:left; margin:20px 0 0 0">
		
        <div class="botoesProdutos">
        	<ul>
            	<li style="background-color:#CC6E6E"><a href="<?=tep_href_link(FILENAME_INFORMATION, 'cod=1')?>">Como Comprar</a></li>
                <li style="background-color:#CC6E6E"><a href="<?=tep_href_link('como-aplicar.php')?>">Como Aplicar</a></li>
                <li style="background-color:#CC6E6E"><a href="<?=tep_href_link(FILENAME_INFORMATION, 'cod=6')?>">Prazo de entrega</a></li>
                <li><a href="<?=tep_href_link('alterar-tamanho-de-sua-imagem.php', 'nome='.$products_name)?>">Alterar Tamanho</a></li>
                <!--<li><a href="<?=tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params())?>">Comentários</a></li>-->
                <li><a href="<?=tep_href_link(FILENAME_CONTACT_US)?>">Tire suas Dúvidas</a></li>
                <li><a href="<?=tep_href_link(FILENAME_TELL_A_FRIEND, tep_get_all_get_params())?>">Indique um Amigo</a></li>
            </ul>
        </div>
        <div style="clear:both"></div>
        
        <br /><br />
        <div style="font-family:Tahoma; font-weight:bold; padding:10px 0 0 50px;">Outros Produtos</div>
    	<div style="width:950px; margin:0 auto;">
            <ul id="carousel2" class="elastislide-list">
                <?php
				
				$mult = explode('_', $cPath);
				if(count($mult) > 1) $cPath = $mult[1];
				else $cPath = $mult[0];

                $products_others = tep_db_query("select pd.products_name, p.products_id, p.products_image, p.products_price,  IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from products_description  pd, products p left join specials s on p.products_id = s.products_id , products_to_categories p2c where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and p2c.categories_id =".$cPath." order by rand() LIMIT 8");
                while ($others = tep_db_fetch_array($products_others)) {
                    echo '<li><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $others['products_id']).'">' . tep_image_produto(DIR_WS_IMAGES_PRODUTOS . $others['products_image'], $others['products_name'], 'YES','SPPE', 'vspace="0"') . '</a>
						<center><a class="pr_name" style="font-size:10px" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $others['products_id']) . '"><strong><b>'.$others['products_name'].'</b></strong></a>
						<br/>
						<span class="pr_price">por: '.$currencies->display_price($others['products_price'], tep_get_tax_rate($others['products_tax_class_id'])) . '</span><br /><span class="textdesconto">' . tep_display_parcela($others['products_price']).'</span>
						</center>
					
					</li>';
                }
                ?>
            </ul>
		</div>
        
        <div style="text-align:center; padding-top:10px"><a href="<?=tep_href_link('informacoes-tecnicas-i-22.html');?>" style="font-family:Tahoma; font-size:13px">Informações Técnicas e Recomendações</a></div>
        
		<div class="FormasdePagamento">
        
        <div style="font-family:Tahoma; font-weight:bold; padding:10px; text-align:center">&nbsp;&nbsp;Formas de Pagamento&nbsp;&nbsp;</div>
        		<div style="padding:10px 0 10px;"><img src="images/produto detalhe_pagseguro.png" /></div>
                <div id="parc_default"><? include('products_split_creditcard_a.php');?></div>
                <div id="parc_dinamic"></div>
                <div style="padding:10px 0 10px;"><img src="images/produto detalhe_deposito.png" /></div>
                <div style="padding:10px 0 10px; font-family:Tahoma; "><span style="color:#CC6E6E; font-weight:bold">10%</span> de desconto para depósito, transferência Bank Line ou boleto</div>
        </div>      
        
        <div class="DescricaoProduto">
        	<div style="font-family:Tahoma; font-weight:bold; padding:10px; text-align:center; font-size:16px; text-align:center">&nbsp;&nbsp;Informações do Produto&nbsp;&nbsp;</div>
        	<br />
        	<?php echo stripslashes($product_info['products_description']); ?><br />
            <?php 
			/*
             if($product_get['manufacturers_name']==''){
                $name = '';
             }else{
                $name = '<br /><b>Fabricante : </b>'.$product_get['manufacturers_name'].'<br />';
             }
             
             if($product_get['manufacturers_url']==''){
                $url = '';
             }else{
                $url = '<b>Site : </b><a href="'.$product_get['manufacturers_url'].'" style="color:#0000FF" target="_blank">'.$product_get['manufacturers_url'].'</a>';
             }
             echo $name.$url;
			 */
             ?>
			
        </div> 
        
        <div style="width:90%; margin:0 auto">
        	<div id="disqus_thread"></div>
				<script type="text/javascript">
                    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                    var disqus_shortname = 'mudominhacasa'; // required: replace example with your forum shortname
            
                    /* * * DON'T EDIT BELOW THIS LINE * * */
                    (function() {
                        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                    })();
                </script>
        </div>
       
       
      <!--  
        <div style="font-family:Tahoma; font-weight:bold; padding:10px 0 0 50px">Destaques</div>
    	<div style="width:990px; margin:0 auto;">
            <ul id="carousel" class="elastislide-list">
                <?
				/*
				$random_banner_select = tep_db_query("select banners_group, banners_url, banners_image from banners where banners_group LIKE 'bRotativo%' and status = 1 order by banners_group ");
				$random_banner = tep_db_fetch_array($random_banner_select);
				$ramdon_num_rows = tep_db_num_rows($random_banner_select);
				if($ramdon_num_rows > 0){
					for($cont4 =1; $cont4 <= $ramdon_num_rows; $cont4++){
						if($random_banner['banners_url']=='') echo "<li><img src='images/banners/".$random_banner['banners_image']."' /></li>\n\r";
						else echo "<li><a href='".$random_banner['banners_url']."'><img src='images/banners/".$random_banner['banners_image']."' /></a></li>";
						$random_banner = tep_db_fetch_array($random_banner_select);		
					}
				}
				*/
				?>
            </ul>
		</div>-->
    </div>
    
    <div style="clear:both"></div>
      </form>  



    </div>
  </div>  

<?php if (tep_not_null($product_info['products_url'])) {
 echo sprintf(TEXT_MORE_INFORMATION, tep_href_link(FILENAME_REDIRECT, 'action=url&goto=' . urlencode($product_info['products_url']), 'NONSSL', true, false)); 
    }
  }
?>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>   
</div>
<script src="includes/librays/prettyPhoto/js/jquery.prettyPhoto.js" type="text/javascript"></script>
<script src="includes/librays/jcrop/jquery.Jcrop.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
	$(".gallery a[rel^='prettyPhoto']").prettyPhoto({theme:'facebook'});
	
	$('#imagemural').Jcrop({
      aspectRatio: 1
    });
	
});

function invert(id, val){
	$('#imagefromjcrop').attr('src', 'images/ImgProdutos/arco do triunfo-invertida.jpg');
	$('.jcrop-holder img').attr('src', 'images/ImgProdutos/arco do triunfo-invertida.jpg');
	
	
	
	$('#normalouinvertido').remove();
	$('#cart_quantity').append('<input type="hidden" name="id['+id+']" value="'+val+'" id="normalouinvertido" />');
}

function removeInvert(id, val){
	$('#imagefromjcrop').removeClass('imageInvert');
	$('#normalouinvertido').remove();
	$('#cart_quantity').append('<input type="hidden" name="id['+id+']" value="'+val+'" id="normalouinvertido" />');
}

function gray(id, val){
	$('#imagefromjcrop').attr('src', 'images/ImgProdutos/arco do triunfo-normal-gray.jpg');
	$('.jcrop-holder img').attr('src', 'images/ImgProdutos/arco do triunfo-normal-gray.jpg');
	$('#coloridooucinza').remove();
	$('#cart_quantity').append('<input type="hidden" name="id['+id+']" value="'+val+'" id="coloridooucinza" />');
}

function removeGray(id, val){
	$('#imagefromjcrop').removeClass('imageGray');
	$('#escalacinza').remove();
	$('#coloridooucinza').append('<input type="hidden" name="id['+id+']" value="'+val+'" id="coloridooucinza" />');
}

function checkform (form)
{
    var r = false;
    var r2 = false;
	var cont = 0;

	if(form.elements['id[2]']){//Verifica se existe a opção de cor
		if(form.elements['id[2]'].length == undefined){
			if(form.elements['id[2]'].checked){
					r2 = true;
				}
		}else{
			for(l =0; l < form.elements['id[2]'].length; l++){
				if(form.elements['id[2]'][l].checked){
					r2 = true;
					break
				}
			}
		}
		if(r2 == false){ 
			alert('Escolha uma cor para o adesivo');
			return false
		}
	}
	
	if(form.elements['id[1]']){
		if(form.elements['id[1]'].length == undefined){
			if(form.elements['id[1]'].checked){
					r = true;
				}
		}else{
			for(i =0; i < form.elements['id[1]'].length; i++){
				if(form.elements['id[1]'][i].checked){
					r = true;
					break;
				}
			}
		}
		if(r == false){ 
			alert('Escolha a medida do seu adesivo');
			return false;
		}
	}
	
	if((r == true)&&(r2 == true)) return true;
}



function popupfrete(url) {window.open(url,'popupfrete','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=350,height=200,top=200,left=350')
}


function selecionadoT(op){
	for(cont = 0; cont < 3; cont++){
		document.getElementById('size'+cont).style.backgroundColor="#ECEAEB";
	}
	
	for(cont = 0; cont < 3; cont++){
		if(op == cont) { 
			document.getElementById('size'+cont).style.backgroundColor="#B5BAB6";
			document.getElementById('precoProduto').innerHTML = document.getElementById('valor'+cont).innerHTML
			document.getElementById('txtDesconto').innerHTML  = document.getElementById('textparc'+cont).innerHTML;
			document.getElementById('txtDescontoAvista').innerHTML  = document.getElementById('textdescavista'+cont).innerHTML;
			document.getElementById('parc_default').style.display = 'none';
			document.getElementById('pricedesconto').style.display = 'none';
			http.open("GET", "products_split_creditcard.php?pr="+document.getElementById('hpred'+cont).value, true);
			http.onreadystatechange = handleHttpResponse;  
			http.send(null);
		}
	}
}
/*
function selecionadoO(op){
	for(cont = 0; cont < 2; cont++){
		if(op == cont) { 
			document.getElementById('size'+cont).style.backgroundColor="#B5BAB6";
			document.getElementById('precoProduto').innerHTML = document.getElementById('valor'+cont).innerHTML
			//document.getElementById('txtDesconto').innerHTML  = document.getElementById('textparc'+cont).innerHTML;
			document.getElementById('parc_default').style.display = 'none';
			http.open("GET", "products_split_creditcard.php?pr="+document.getElementById('hpred'+cont).value, true);
			http.onreadystatechange = handleHttpResponse;  
			http.send(null);
		}else document.getElementById('size'+cont).style.backgroundColor="#B5BAB6";
		
	}
}
*/
function handleHttpResponse()
{
    if (http.readyState == 4) {
        results = http.responseText;
        document.getElementById('parc_dinamic').innerHTML = results; 
    }
}
function popup(URL){
   window.open(URL,"janela1","width=340,height=333,scrollbars=NO")
}


// Essa função é somente para identificar o Navegador e suporte ao XMLHttpRequest.

function getHTTPObject()
{
    var req;
    try {
        if (window.XMLHttpRequest) {
            req = new XMLHttpRequest();
            if (req.readyState == null) {
                req.readyState = 1;
                req.addEventListener("load", function() {
                    req.readyState = 4;
                    if (typeof req.onReadyStateChange == "function") {
                        req.onReadyStateChange();
                    }
                }, false);  
            }
            return req; 
        }

        if (window.ActiveXObject) {
            var prefixes = ["MSXML2", "Microsoft", "MSXML", "MSXML3"];
            for (var i = 0; i < prefixes.length; i++) {
                try {
                    req = new ActiveXObject(prefixes[i] + ".XmlHttp");
                    return req;
                } catch (ex) {};
            }
        }
    } catch (ex) {}

    alert("XmlHttp Objects not supported by client browser");
}
var http = getHTTPObject();
// Logo após fazer a verificação, é chamada a função e passada 
// o valor à variável global http.
</script>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
