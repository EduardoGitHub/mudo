<?php
/*
  $Id: monitor_manage.php,v 1.146 2003/07/11 14:40:27 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
  
*/

  require('includes/application_top.php');

  $action = (isset($_GET['action']) ? $_GET['action'] : $_POST['action']);
  $controle = (isset($_GET['controle']) ? $_GET['controle'] : $_POST['controle']);
  $linha = (isset($_GET['linha']) ? $_GET['linha'] : $_POST['linha']);
  $comments = (isset($_GET['comments']) ? $_GET['comments'] : $_POST['comments']);
  $products_date_available = (isset($_GET['products_date_available']) ? $_GET['products_date_available'] : $_POST['products_date_available']);


if ($controle != "novo") {
  if (tep_not_null($action)) {
	if ($action=="new") {
		//$products_date_available = tep_db_prepare_input($_POST['products_date_available']);
		$products_date_available = tep_db_prepare_input($products_date_available);
		$_string = "insert into ".TABLE_MONITOR_PAGE." 
		  (customer_id, monitor_date, comments) 
		  values
		  ('".$customers."','".$products_date_available."','".$comments."')";
		  //echo $_string;
		tep_db_query($_string);
		$messageStack->add("Registro incluido com sucesso", 'success');
		echo '<script> document.location.href="monitor.php?customers='.$customers.'&filtro='.$filtro.'"; </script>';
	}
	if ($action=="edit") {
		$_string = "update ".TABLE_MONITOR_PAGE." set comments = '".$comments."', monitor_date='".$products_date_available."' where monitor_page_id='".$linha."'";
		//echo $_string;
		tep_db_query($_string);
		$messageStack->add("Registro alterado com sucesso", 'success');
		echo '<script> document.location.href="monitor.php?customers='.$customers.'&filtro='.$filtro.'"; </script>';
	}

  }
}

if ($action=="read") $action="edit";

			if ($controle=="edit") {
					$_string = "select comments,monitor_date from " . TABLE_MONITOR_PAGE . " where monitor_page_id = ".$linha;
					$edita_query = tep_db_query($_string);
					$edita = tep_db_fetch_array ($edita_query);
					$comments = $edita['comments'];
					$products_date_available = $edita['monitor_date'];
				}

/*
echo "Customers ***".$customers."<br>";
echo "Data ***".$products_date_available."<br>";
echo "Comments ***".$comments."<br>";
echo "Controle ***".$controle."<br>";
echo "Action ***".$action."<br>";
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="SetFocus();">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top" id="main">

<?php
  if ($action == 'new') {
	}

?>


<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
<script language="javascript"><!--
  var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "new_monitor", "products_date_available","btnDate1","<?php echo $products_date_available; ?>",scBTNMODE_CUSTOMBLUE);
//--></script>

	<form name="new_monitor" action="monitor_manage.php" method="post">
	<input type=hidden name="customers" value="<?php echo $customers; ?>">
	<input type=hidden name="action" value="<?php echo $action; ?>">
	<input type=hidden name="controle" value="gravar">
	<input type=hidden name="linha" value="<?php echo $linha; ?>">
	<input type=hidden name="orderby" value="<?php echo $orderby; ?>">
	<input type=hidden name="backto" value="<?php echo $backto; ?>">
	
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">&nbsp;
			<?php
				if ($action=="new") echo "Novo registro no histórico";
				else                echo "Alteração de registro";
				$customer_query = tep_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id='".$customers."'");
				$customer = tep_db_fetch_array ($customer_query);
				$customer_name = $customer['customers_firstname'] .' '. $customer['customers_lastname'];
				echo "<br>Cliente: ".$customer_name;
			?>
			</td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
		<tr>
            <td class="main">Data<br><small>(YYYY-MM-DD)</small></td>
            <td class="main"><?php 
			//if ($action == "new") {
				echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;'; ?><script language="javascript">dateAvailable.writeControl(); dateAvailable.dateFormat="yyyy-MM-dd";</script>
				<?php //} else {
				//echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;';
				//echo $products_date_available;
			//}
			?>			
			</td>
          </tr>

          <tr>
            <td class="main" valign="top">Descrição</td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;'; ?>
			<?php 

			echo tep_draw_textarea_field('comments', 'soft', '90', '5', stripslashes(str_replace("<br>","",$comments))); ?></td>
          </tr>
		        <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main" colspan=2 align="center"><?php echo tep_image_submit('button_save.gif', "Gravar") . '&nbsp;&nbsp;';
		//if (tep_not_null($backto))
		//	echo '<a href="'.$backto.'">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; 
		//else
			echo '<a href="monitor.php?customers='.$customers.'&filtro='.$filtro.'&backto='.$backto.'">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; 
		?></td>
      </tr>

    </table></form>

    </td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
