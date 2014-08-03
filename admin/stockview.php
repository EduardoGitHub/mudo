<?php
/*
  $Id: stockview.php,v 1.2 2007/06/08
  Autor Tonbo Nuske

  osCommerce Confere o estoque por atributo

    osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 - 2006 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

	$result = mysql_query("SELECT p.products_id, pd.products_name, p.products_quantity, p.products_model, p.products_status
				FROM products p,  products_description pd WHERE p.products_id = pd.products_id ORDER BY products_name asc");
	$bd_without_stock = mysql_query("SELECT p.products_id, pd.products_name, p.products_quantity, p.products_model, p.products_status
FROM products p,  products_description pd WHERE p.products_id = pd.products_id and p.products_status = 0 ORDER BY products_name asc");	
	
	$total = mysql_num_rows($result);
	$numProducts_without_stock = mysql_num_rows($bd_without_stock);
	$numProducts_in_stock = $total - $numProducts_without_stock;
		
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
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top" id="main">
	
		<table width="100%" align="center" class="infoBoxContents" cellspacing="2" cellpadding="2">
			<tr>
				<td>
				   <table border="0" width="100%" cellspacing="0" cellpadding="0">
					 <tr>
						<td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
					 </tr>
					 <tr>
					   <td class="pageHeading"><?php echo 'Conferir Estoque' ?><br><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
					   <td class="pageHeading" align="right"></td>
					 </tr>
					   <tr class="dataTableHeadingRow">
				   	   <td class="dataTableHeadingContent"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '1'); ?></td>
				 	</tr>
				  </table>
	   			</td>
     		</tr>
			<tr>
				<td bgcolor="#F7F7F7">
				Produtos em estoque: <b><?php echo $numProducts_in_stock;?></b><br>	Produtos sem estoque: <b><?php echo $numProducts_without_stock;?></b><br>	Total de produtos cadastrados: <b><?php echo $total;?></b>
				</td>
			</tr>
			<tr>
				<td>
				<a href="<?= tep_href_link('stockcomplete.php')?>" target="_blank">Estoque completo</a>
				</td>
			</tr>	
			<tr>
				<td>
					<table width="100%" align="center" class="infoBoxContents" cellspacing="2" cellpadding="2">
						<?
							echo "<tr  class=\"dataTableHeadingRow\"><td  class=\"dataTableHeadingContent\" width=10%><b>". 'Produto ID' . "</b></td><td class=\"dataTableHeadingContent\" width=50%><b>" . 'Nome do Produto' . "</b></td> <td class=\"dataTableHeadingContent\" width=15%><b>" . 'Modelo do Produto ' . "</b></td> <td class=\"dataTableHeadingContent\" width=15%><b>" . 'Status do Produto ' . "</b></td><td class=\"dataTableHeadingContent\" width=10%><b>". 'Quant.Total' . "</b></td> </tr>";
						//	echo "SELECT * FROM products, products_description, products_attributes, products_options_values WHERE products.products_id = products_description.products_id and products.products_id = products_attributes.products_id and products_description.language_id = '" . $languages_id . "' and products_attributes.options_values_id = products_options_values.products_options_values_id ORDER BY products_description.products_name";
							if ($row = mysql_fetch_array($result)) {
								do {
									if($row["products_status"] == 1)$status = 'Em estoque';else $status = 'Sem saldo em estoque';
									echo "<tr class=\"dataTableRow\" onmouseover=\"rowOverEffect(this)\" onmouseout=\"rowOutEffect(this)\" ><td class='dataTableContent'>&nbsp;".$row["products_id"]."</td>";
									echo "<td class='dataTableContent'>".$row["products_name"]."</td>";
									echo "<td class='dataTableContent'>".$row["products_model"]."</td>";
									echo "<td class='dataTableContent'>".$status."</td>";
									echo "<td class='dataTableContent'>".$row["products_quantity"]."</td>";
									echo "</tr>";
								}
								while($row = mysql_fetch_array($result));
							}
						?>
						<!-- body_text_eof //-->
					</table>
				</td>	
			  </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
</body>
</html>
<?php //require('includes/application_bottom.php'); ?>
