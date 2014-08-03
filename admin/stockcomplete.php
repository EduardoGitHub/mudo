<?php
  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
	$result = mysql_query("SELECT p.products_id, pd.products_name, pd.products_description, p.products_warranty, p.products_weight, p.products_image, p.products_price, p.products_price_revenda, p.products_quantity, p.products_model, p.products_status FROM products p,  products_description pd WHERE p.products_id = pd.products_id ORDER BY products_name asc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body>
<div id="page">

<table border="0" width="100%" cellspacing="0" cellpadding="0">
<tr>
				<td colspan="2">
				   <table border="0" width="100%" cellspacing="0" cellpadding="0">
					 <tr>
						<td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
					 </tr>
					 <tr>
					   <td class="pageHeading"><?php echo 'Estoque (Loja Virtual)' ?> - <?php echo STORE_NAME; ?></td>
					   <td class="pageHeading" align="right"></td>
					 </tr>
					   <tr class="dataTableHeadingRow">
				   	   <td class="dataTableHeadingContent"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '1'); ?></td>
				 	</tr>
				  </table>
	   			</td>
     		</tr>
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"></td>
    <td width="100%" valign="top">
	
		<table width="100%" align="center" class="infoBoxContents" cellspacing="2" cellpadding="2">	
			<tr>
				<td>
					<table width="100%" align="center" class="infoBoxContents" cellspacing="2" cellpadding="2">
						<?
							echo "<tr  class=\"dataTableHeadingRow\"><td  class=\"dataTableHeadingContent\" width=4%><b>". 'Cod.' . "</b></td><td class=\"dataTableHeadingContent\" width=25%><b>" . 'Nome do Produto' . "</b></td><td class=\"dataTableHeadingContent\" width=35%><b>" . 'Desc do Produto ' . "</b></td> <td class=\"dataTableHeadingContent\" width=10%><b>" . 'Imagem ' . "</b></td><td class=\"dataTableHeadingContent\" width=10%><b>" . 'Preço/Revenda ' . "</b></td><td class=\"dataTableHeadingContent\" width=5%><b>". 'Quant.' . "</b></td><td class=\"dataTableHeadingContent\" width=5%><b>". 'Peso' . "</b></td><td class=\"dataTableHeadingContent\" width=15%><b>" . 'Garantia ' . "</b></td><td class=\"dataTableHeadingContent\" width=20%><b>" . 'Modelo ' . "</b></td><td class=\"dataTableHeadingContent\" width=15%><b>" . 'Status' . "</b></td> </tr>";
						//	echo "SELECT * FROM products, products_description, products_attributes, products_options_values WHERE products.products_id = products_description.products_id and products.products_id = products_attributes.products_id and products_description.language_id = '" . $languages_id . "' and products_attributes.options_values_id = products_options_values.products_options_values_id ORDER BY products_description.products_name";
							if ($row = mysql_fetch_array($result)) {
								do {
										//REDIMENSIONAMENTO DE IMAGEM
										$imagem = $row['products_image'];
										$type_ofimage = @getimagesize("../".DIR_WS_IMAGES_PRODUTOS.$imagem);		
										$vl_w ='';
										$vl_h = '';	
										if(($type_ofimage[2] <> 1) && ($type_ofimage[2] <> 2) && ($type_ofimage[2] <> 3) ){
											$new_name = $imagem;
											$dimensao = reduzir($imagem);
											$vl_w = $dimensao[0];
											$vl_h = $dimensao[1];
										}else{
												$new_name = redimenciona($imagem);
											 }
										//FIM REDIMENCIONAMENTO DE IMAGEM
								
										if($row["products_status"] == 1)$status = 'OK';else $status = 'NO';
										echo "<tr class=\"dataTableRow\" onmouseover=\"rowOverEffect(this)\" onmouseout=\"rowOutEffect(this)\" ><td class='dataTableContent'>&nbsp;".$row["products_id"]."</td>";
										echo "<td class='dataTableContent'>".$row["products_name"]."</td>";
										echo "<td class='dataTableContent'>".strip_tags($row['products_description'])."</td>";
										echo "<td class='dataTableContent'>".tep_image(DIR_WS_CATALOG_IMAGES . $new_name, 'Imagem', $vl_w, $vl_h)."</td>";
										echo "<td class='dataTableContent'>".$currencies->format($row['products_price'])." /<br>".$currencies->format($row['products_price_revenda'])." </td>";
										echo "<td class='dataTableContent'>".$row["products_quantity"]."</td>";
										echo "<td class='dataTableContent'>".$row["products_weight"]."</td>";
										echo "<td class='dataTableContent'>".$row['products_warranty']." dias</td>";
										echo "<td class='dataTableContent'>".$row["products_model"]."</td>";
										echo "<td class='dataTableContent'>".$status."</td>";
										
										echo "</tr>";
								}
								while($row = mysql_fetch_array($result));
							}
						?>
					</table>
				  <td>
			  </tr>
           </table>
		</td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<br>
</body>
</html>