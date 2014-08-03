<?php
/*
  $Id: monitor.php,v 1.2 2004/01/23

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Contribution by wdo (waldosoc@yahoo.com.mx)

  Released under the GNU General Public License
*/

  $backto = str_replace("*","&",$backto);
  require('includes/application_top.php');

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'delete':
		  if (isset($mid)){
			$delete_query = "delete from " . TABLE_MONITOR_PAGE . " where monitor_page_id='".$mid."'";
			if (tep_db_query($delete_query))
				$messageStack->add(SUCCESS_DELETED, 'success');
			else
				$messageStack->add(ERROR_DELETED, 'error');
		  }
        break;
      case 'delall':
		  $delete_query = "delete from " . TABLE_MONITOR_PAGE;
		  if (tep_db_query($delete_query))
			  $messageStack->add(SUCCESS_DELETED, 'success');
		  else
			  $messageStack->add(ERROR_DELETED, 'error');
        break;
      case 'backup':
		$backup_text = '';
//Cabecera
        $Cabecera = '# Soluciones en Comercio Electrónico' . "\n" .
                  '# http://www.soluciones-e.com' . "\n" .
                  '#' . "\n" .
                  '# Transactions Table Backup For ' . STORE_NAME . "\n" .
                  '# Copyright (c) ' . date('Y') . ' ' . STORE_OWNER . "\n" .
                  '#' . "\n" .
                  '# Database: ' . DB_DATABASE . "\n" .
                  '# Database Server: ' . DB_SERVER . "\n" .
                  '#' . "\n" .
                  '# Backup Date: ' . date(PHP_DATE_TIME_FORMAT) . "\n\n";

// Eliminar tabla anterior y agregar estructura de la tabla
		$Cuerpo = 'drop table if exists ' . TABLE_MONITOR_PAGE . ";\n";
		$Cuerpo.= 'create table ' . TABLE_MONITOR_PAGE . " (\n";
		$fields_query = tep_db_query('show fields from '.TABLE_MONITOR_PAGE);
		while ($fields = tep_db_fetch_array($fields_query)) {
            $table_list[] = $fields['Field'];
            $Cuerpo .= '  '.$fields['Field'].' '.$fields['Type'];
            if (strlen($fields['Default']) > 0) $Cuerpo .= ' default \''.$fields['Default'].'\'';
            if ($fields['Null'] != 'YES') $Cuerpo .= ' not null';
            if (isset($fields['Extra'])) $Cuerpo .= ' ' . $fields['Extra'];
            $Cuerpo .= ',' . "\n";
        }
        $Cuerpo = ereg_replace(",\n$", '', $Cuerpo);

// Agregar las llaves (keys)
        $index = array();
        $keys_query = tep_db_query("show keys from " . TABLE_MONITOR_PAGE);
        while ($keys = tep_db_fetch_array($keys_query)) {
			$kname = $keys['Key_name'];
			if (!isset($index[$kname])) {
				$index[$kname] = array('unique' => !$keys['Non_unique'],
                                       'columns' => array());
			}
            $index[$kname]['columns'][] = $keys['Column_name'];
        }
        while (list($kname, $info) = each($index)) {
			$Cuerpo .= ',' . "\n";
            $columns = implode($info['columns'], ', ');
            if ($kname == 'PRIMARY') {
              $Cuerpo .= '  PRIMARY KEY (' . $columns . ')';
            } elseif ($info['unique']) {
              $Cuerpo .= '  UNIQUE ' . $kname . ' (' . $columns . ')';
            } else {
              $Cuerpo .= '  KEY ' . $kname . ' (' . $columns . ')';
            }
        }
        $Cuerpo .= "\n" . ');' . "\n\n";

// Agregar informacion (data)
        $rows_query = tep_db_query("select " . implode(',', $table_list) . " from " . TABLE_MONITOR_PAGE);
		while ($rows = tep_db_fetch_array($rows_query)) {
			$Datos = 'insert into ' . TABLE_MONITOR_PAGE . ' (' . implode(', ', $table_list) . ') values (';
            reset($table_list);
            while (list(,$i) = each($table_list)) {
				if (!isset($rows[$i])) {
					$Datos .= 'NULL, ';
				}elseif (tep_not_null($rows[$i])) {
					$row = addslashes($rows[$i]);
					$row = ereg_replace("\n#", "\n".'\#', $row);
					$Datos .= '\'' . $row . '\', ';
				}else {
					$Datos .= '\'\', ';
				}
            }
            $Datos = ereg_replace(', $', '', $Datos) . ');' . "\n";
			$Cuerpo .= $Datos;
        }
//Display*/
		$backup_text = $Cabecera . $Cuerpo;
//Limpiar tabla si se selecciono dicha opcion
		if (tep_not_null($delall)){
			$query = 'DELETE from ' . TABLE_MONITOR_PAGE;
			tep_db_query ($query);
		}
        break;
    }
  }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top" id="main"><table border="0" width="100%" cellspacing="0" cellpadding="2"><!--Tamaño de tabla (900px)-->
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">&nbsp;<span class="titulo"><?php echo HEADING_TITLE; ?></span></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?
//Detección de variables GET
	if (!tep_not_null($page)){
		$page = " limit 0, ".MAX_ROWS_MONITOR;   // MAX_ROWS_MONITOR
		$PageNumber = 1;
	}else{
		$PageNumber = $page;
		$page = " limit ".MAX_ROWS_MONITOR*($page-1).", ".MAX_ROWS_MONITOR;    // MAX_ROWS_MONITOR em ambos
	}
	if (!tep_not_null($customers))
		$where_customer = "";
	else{
		switch ($customers){
			//case 'all' : $where_customer = " where 1"; break;
			case 'all' : $where_customer = " "; break;
			default: $where_customer = " where customer_id='".$customers."'";
		}
		if (tep_not_null($filtro)) {
			if ($filtro=="site") {
				$where_customer .= ' and page != ""';
			}
			if ($filtro=="admin") {
				$where_customer .= ' and page = ""';
			}
		}
	}
	if (!tep_not_null($orderby) || !tep_not_null($orderbydir)) {
		// $monitor_orderby = " order by monitor_page_id ASC";
		// $monitor_orderby = " order by monitor_date, monitor_time ASC";
		//echo "*** ".$orderby;
		if (!tep_not_null($orderby)) $orderby = "customer";
		//$orderby = "company";
	}else{
		switch ($orderbydir){
			case 'asc': $monitor_orderdir = " ASC"; break;
			case 'desc': $monitor_orderdir = " DESC"; break;
			default: $monitor_orderdir = " ASC";
		}
		switch ($orderby){
			case 'page': $monitor_orderby = " order by page"; break;
			//case 'customer': $monitor_orderby = " order by customer_id"; break;
			case 'customer': $monitor_orderby = " order by customer_id"; break;
			case 'date': $monitor_orderby = " order by monitor_date"; break;
			case 'time': $monitor_orderby = " order by monitor_time"; break;
			case 'company': $monitor_orderby = " order by entry_company"; break;
			//default: $monitor_orderby = " order by monitor_page_id";
			default: $monitor_orderby = " order by c.customers_firstname ASC";
		}
	}
//función para generar los links de ordenamiento y repaginado
function get_orderby_lnk ($by, $NumPage, $customer, $filtro=null){
global $backto;
	$img_up = tep_image(DIR_WS_ADMIN.DIR_WS_IMAGES.'icon_up.gif', TEXT_ALT_ORDER_ASC);
	$img_down = tep_image(DIR_WS_ADMIN.DIR_WS_IMAGES.'icon_down.gif', TEXT_ALT_ORDER_DESC);
	$value = '<a href="' . tep_href_link(FILENAME_MONITOR,'orderby='.$by.'&orderbydir=asc&page='.$NumPage.'&customers='.$customer.'&filtro='.$filtro.'&backto='.$backto) . '">' . $img_up . '</a>&nbsp;';
	$value .= '<a href="' . tep_href_link(FILENAME_MONITOR,'orderby='.$by.'&orderbydir=desc&page='.$NumPage.'&customers='.$customer.'&filtro='.$filtro.'&backto='.$backto) . '">' . $img_down . '</a>';
	return $value;
}
if (!tep_not_null($customers)){?>
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo get_orderby_lnk ('customer',$PageNumber,$customers,$filtro).'&nbsp;<br>'.TABLE_HEADING_CUSTOMER; ?></td>

				<?php if (ACCOUNT_COMPANY == 'true') { ?>
                <td class="dataTableHeadingContent"><?php echo get_orderby_lnk ('company',$PageNumber,$customers,$filtro).'&nbsp;<br>Empresa'; ?></td>
				<?php } ?>

                <td class="dataTableHeadingContent" align=center><?php echo get_orderby_lnk ('date',$PageNumber,$customers,$filtro).'&nbsp;<br>Últ. histórico'; ?></td>

                <!-- <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ACTION; ?></td> --> </tr> 
<?
}else{
?>
<tr class="dataTableHeadingRow"><td colspan=6 class="dataTableHeadingContent">
<?php
//Recuperando los datos del cliente
//echo "***". $customers;
	if ($customers == '0' || $customers == ''){
		$customer_name = NO_REGISTERED_USER_NAME;
		$customer_company = NO_REGISTERED_USER_COMPANY;
		$link_to_customer = $customer_name;
	}else{
		//$address_query = tep_db_query("select min(address_book_id) as primero from " . TABLE_ADDRESS_BOOK . " where customers_id='".$monitor['customer_id']."'");
		//$address_query = tep_db_query("select min(address_book_id) as primero from " . TABLE_ADDRESS_BOOK . " where customers_id='".$customers."'");
		$address_query = tep_db_query("select distinct(address_book_id) as primero from " . TABLE_ADDRESS_BOOK . " where customers_id='".$customers."'");
		//$address_query = tep_db_query("select distinct(address_book_id),entry_company as primero from " . TABLE_ADDRESS_BOOK . " where customers_id='".$customers."'");
	    $address = tep_db_fetch_array ($address_query);
		//$customer_query = tep_db_query("select entry_firstname, entry_lastname, entry_company from " . TABLE_ADDRESS_BOOK . " where address_book_id='".$address['primero']."'");
		$customer_query = tep_db_query("select a.entry_firstname, a.entry_lastname, a.entry_company from " . TABLE_ADDRESS_BOOK . " a inner join customers c on (c.customers_id=a.customers_id) where address_book_id='".$address['primero']."'");
		$customer = tep_db_fetch_array ($customer_query);
		$customer_name = $customer['entry_firstname'] .' '. $customer['entry_lastname'];
		$customer_company = $customer['entry_company'];
		$link_to_customer = '<a href="' . tep_href_link(FILENAME_CUSTOMERS, 'selected_box=customers&cID=' . $monitor['customer_id']) . '" style="color:#fff;">' . $customer_name . '</a>';

		// vamos verificar se o cliente tem pedidos...
		$cID = $monitor['customer_id'];
		$orders_query_raw = "select count(*) from " . TABLE_ORDERS . " o where o.customers_id = '" . $customers . "'";
//echo $orders_query_raw;
        //$orders_query_raw = "select count(*) from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and ot.class = 'ot_total' order by o.orders_id DESC";

		$orders_query = tep_db_query($orders_query_raw);
		$orders = tep_db_fetch_array($orders_query);
		//echo "***".$orders['count(*)'];
		if ($orders['count(*)']>0) {
			$plural='';
			if ($orders['count(*)']>1) $plural='s';
			$link_to_customer .= " - <a href='orders.php?cID=".$customers."' class='blinkblue' style='color:#fff;'>&nbsp;Cliente tem pedido$plural&nbsp;</a>";
		} else $link_to_customer .= " <small>(sem pedidos)</small>";
		
		//if (tep_not_null($customer['customers_atendente'])) $link_to_customer .= "<small> - Atendente: ".$customer['customers_atendente']."</small>";
		

	}
	if ($customers=="all") $link_to_customer = "TODOS";
	echo "<font size=1>".TABLE_HEADING_CUSTOMER." : ".$link_to_customer."</font>";
	
/*
	if (tep_not_null($filtro)) {
		echo "<table cellspacing=0 cellpadding=3 border=0><tr><td background=\"../images/blink_red.gif\"><font color=\"#FFFFFF\"><strong>";
		echo "Exibindo somente ";
		if ($filtro=="site")  echo "registros de rastreio no site";
		if ($filtro=="admin") echo "históricos feitos pelo administrador";
		echo "</strong></font></td></tr></table>";
	}
*/
?>
</td></tr>
<tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" nowrap><?php echo get_orderby_lnk ('date',$PageNumber,$customers,$filtro).'&nbsp; '.TABLE_HEADING_DATE; ?></td>
                <td class="dataTableHeadingContent" nowrap><?php echo get_orderby_lnk ('time',$PageNumber,$customers,$filtro).'&nbsp; '.TABLE_HEADING_TIME; ?></td>
               <!-- <td class="dataTableHeadingContent"><?php echo get_orderby_lnk ('page',$PageNumber,$customers,$filtro).'&nbsp; '.TABLE_HEADING_PAGE; ?></td> -->
                <!-- <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CUSTOMER; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_COMPANY; ?></td> -->
                <!-- <td class="dataTableHeadingContent" ><?php echo TABLE_HEADING_IP; ?></td> -->
                <!-- <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_USER_AGENT; ?></td> -->
                <td class="dataTableHeadingContent" valign="bottom"><?php echo TABLE_HEADING_COMMENTS; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ACTION; ?></td>
<?}?>
              </tr>
<?php
	if (!tep_not_null($customers))
		$what_i_search = 'distinct(customer_id)';
	//elseif ($order
	else
		$what_i_search = '*';
	$monitor_query = tep_db_query("select count(".$what_i_search.") as Total from " . TABLE_MONITOR_PAGE . $where_customer);
	$monitor = tep_db_fetch_array ($monitor_query);
	$TotalRows = $monitor['Total'];
	$monitor_string = "select ".$what_i_search;
	if ($orderby == "customer") {
		$monitor_string .= " ,mp.monitor_date,mp.monitor_time,c.customers_firstname,c.customers_lastname,mp.comments from " . TABLE_MONITOR_PAGE . " mp inner join customers c on (c.customers_id=mp.customer_id) ";
		if (empty($customers) ) {
			if (empty($backto)) $monitor_orderby = " group by customers_id  order by c.customers_firstname ";
			else $monitor_orderby = " order by c.customers_firstname ";
		} else {
			if (empty($backto)) $monitor_orderby = " order by c.customers_firstname ";
			else $monitor_orderby = " order by c.customers_firstname ";
		}
	}
	if ($orderby == "company") {
		$monitor_string .= " ,mp.monitor_date,mp.monitor_time,a.entry_firstname,a.entry_lastname,mp.comments from " . TABLE_MONITOR_PAGE . " mp inner join address_book a on (a.customers_id=mp.customer_id) ";
		$monitor_orderby = " group by a.entry_company order by a.entry_company ";
	}
	if ($orderby == "date") {
		//$monitor_string = "select * from " . TABLE_MONITOR_PAGE . " mp inner join address_book a on (a.customers_id=mp.customer_id) ";
		$monitor_string = "select distinct(customer_id),mp.monitor_date,mp.monitor_time,a.entry_firstname,a.entry_lastname,a.entry_company,mp.comments from " . TABLE_MONITOR_PAGE . " mp inner join address_book a on (a.customers_id=mp.customer_id) ";
			if (empty($backto) && empty($customers)) $monitor_orderby = " group by customers_id,mp.monitor_date order by mp.monitor_date ";
		else $monitor_orderby = " order by mp.monitor_date ";
	}
	
	if ($orderby == "time") {
		//$monitor_string = "select * from " . TABLE_MONITOR_PAGE . " mp inner join address_book a on (a.customers_id=mp.customer_id) ";
		$monitor_string = "select distinct(customer_id),mp.monitor_date,mp.monitor_time,a.entry_firstname,a.entry_lastname,a.entry_company,mp.comments from " . TABLE_MONITOR_PAGE . " mp inner join address_book a on (a.customers_id=mp.customer_id) ";
			if (empty($backto) && empty($customers)) $monitor_orderby = " group by customers_id,mp.monitor_date order by mp.monitor_date ";
		else $monitor_orderby = " order by mp.monitor_time ";
	}

			if (tep_not_null($filtro)) {
			if ($filtro=="site") {
				$where_customer .= ' and mp.page != ""';
			}
			if ($filtro=="admin") {
				$where_customer .= ' and mp.page = ""';
			}
			}
	$monitor_string .= $where_customer . $monitor_orderby . $monitor_orderdir;
	$contador_string = $monitor_string;	
	$monitor_string .= $page;
	
//echo "*** ".$monitor_string;
	$monitor_query = tep_db_query($monitor_string);
	$TotalRows_query = tep_db_num_rows($monitor_query);
	
	$contador_query = tep_db_query($contador_string);
	$contador = tep_db_num_rows($contador_query);
	//echo "***".$contador;

    while ($monitor = tep_db_fetch_array ($monitor_query)) {
//Efecto OnMouseOver
	  if (isset($buInfo) && is_object($buInfo) && ($monitor == $buInfo->file)) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
      }

//Recuperando los datos del cliente
	if ($monitor['customer_id'] == '0' || $monitor['customer_id'] == ''){
		$customer_name = NO_REGISTERED_USER_NAME;
		$customer_company = NO_REGISTERED_USER_COMPANY;
		$link_to_customer = $customer_name;
	}else{
		$address_query = tep_db_query("select min(address_book_id) as primero from " . TABLE_ADDRESS_BOOK . " where customers_id='".$monitor['customer_id']."'");
	    $address = tep_db_fetch_array ($address_query);
		$customer_query = tep_db_query("select ab.entry_firstname, ab.entry_lastname, ab.entry_company, mp.monitor_date from " . TABLE_ADDRESS_BOOK . " ab
		inner join monitor_page mp on (mp.customer_id='".$monitor['customer_id']."')
		where address_book_id='".$address['primero']."' order by ab.entry_firstname, mp.monitor_date DESC");
		$customer = tep_db_fetch_array ($customer_query);
		$customer_name = $customer['entry_firstname'] .' '. $customer['entry_lastname'];
		$customer_company = $customer['entry_company'];
		$data = $customer['monitor_date'];
		$link_to_customer = '<a href="' . tep_href_link(FILENAME_CUSTOMERS, 'selected_box=customers&cID=' . $monitor['customer_id']) . '">' . $customer_name . '</a>';
		
	}
// Recuperando comentarios
	if (tep_not_null($customers)){
		$final_comment = $monitor['comments'];
		$comments = split ('=', $monitor['comments']);
/*
		switch ($comments[0]){
			case 'P':
				$product_query = tep_db_query("select products_name from ".TABLE_PRODUCTS_DESCRIPTION." where language_id='".$languages_id."' && products_id='".trim($comments[1])."'");
				$product = tep_db_fetch_array ($product_query);
				$category_query = tep_db_query("select categories_id from ".TABLE_PRODUCTS_TO_CATEGORIES." where products_id='".trim($comments[1])."'");
				$category = tep_db_fetch_array ($category_query);
				$final_comment = 'Visitou '.PRODUCT_TEXT . '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'selected_box=catalog&cPath='.$category['categories_id'].'&pID=' . trim($comments[1])) . '">' . $product['products_name'] . '</a>';
				break;
			case 'C':
				$category_query = tep_db_query("select categories_name from ".TABLE_CATEGORIES_DESCRIPTION." where 	language_id='".$languages_id."' && categories_id='".trim($comments[1])."'");
				$category = tep_db_fetch_array ($category_query);
				$final_comment = CATEGORY_TEXT . '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'selected_box=catalog&cID=' . trim($comments[1])) . '">' . $category['categories_name'] . '</a>';
				break;
			//default:
				//$final_comment = '';
		}//switch
*/
	unset($comments);
// Pintando cada renglon
?>
                <td class="dataTableContent" align="left" nowrap ><?php 
					$_data = substr($monitor['monitor_date'],8,2).'/'.substr($monitor['monitor_date'],5,2).'/'.substr($monitor['monitor_date'],0,4);
					echo $_data; ?>
				</td>
                <td class="dataTableContent" align="left" nowrap ><?php echo $monitor['monitor_time'] . '&nbsp; ';?> </td>
                <!-- <td class="dataTableContent" align="left"  > <?php echo $monitor['page']; ?> </td> -->
                <!-- <td class="dataTableContent" align="left"  ><?php echo $link_to_customer; ?> </td>
                <td class="dataTableContent" align="left"  ><?php echo $customer_company; ?> </td>  -->
                <!-- <td class="dataTableContent" align="left" nowrap ><?php echo $monitor['ip']; ?> </td> -->
                <!-- <td class="dataTableContent" align="left"  ><?php echo $monitor['user_agent']; ?> </td> -->
                <td class="dataTableContent" align="left"><?php echo $final_comment; ?> </td>
                <td class="dataTableContent" align="left"  ><?php echo '<a onclick="return confirm(\''.TEXT_DELETE_INTRO.'\')" href="' . tep_href_link(FILENAME_MONITOR, 'action=delete&mid='.$monitor['monitor_page_id']) . '&customers='.$monitor['customer_id'].'" >' . tep_image('images/delete.gif', IMAGE_DELETE) . '</a>' ?>&nbsp;&nbsp;&nbsp;<a href="monitor_manage.php?customers=<?php echo $customers; ?>&controle=edit&action=read&linha=<?php echo $monitor['monitor_page_id']; ?>&filtro=<?php echo $filtro; ?>&backto=<?php echo str_replace("&","*",$backto); ?>"><?php echo tep_image("images/edit.gif","Editar"); ?></a></td>
<?php
	}else{?>
                <td class="dataTableContent" align="left"  ><?php 
				//echo $customer_name; 
				echo '<a href="' . tep_href_link(FILENAME_MONITOR, 'customers=' . $monitor['customer_id']) . '&orderby='.$orderby.'" >' .$customer_name. '</a>'; 
				?> </td>
				
				<?php if (ACCOUNT_COMPANY == 'true') { 
				echo '<td class="dataTableContent" align="left">';
				echo '<a href="' . tep_href_link(FILENAME_MONITOR, 'customers=' . $monitor['customer_id']) . '&orderby='.$orderby.'" >' .$customer_company. '</a>'; 
				echo '</td>';
				}
				?>

                <td class="dataTableContent" align="center"><?php 
					$_data = substr($customer['monitor_date'],8,2).'/'.substr($customer['monitor_date'],5,2).'/'.substr($customer['monitor_date'],0,4);
					echo $_data; 
				?></td>
<!--				
                <td class="dataTableContent" align="left"  ><?php 
				//echo '<a href="' . tep_href_link(FILENAME_MONITOR, 'customers=' . $monitor['customer_id']) . '" >' . tep_image_button('button_details.gif', IMAGE_DETAILS) . '</a>'; 
				//echo '<a href="' . tep_href_link(FILENAME_MONITOR, 'customers=' . $monitor['customer_id']) . '" >Ver histórico</a>'; 
				echo '<a href="' . tep_href_link(FILENAME_MONITOR, 'customers=' . $monitor['customer_id']) . '" >' . tep_image('images/olho.png', IMAGE_DETAILS) . '</a>'; 
				?> </td>
-->
<?	}?>
              </tr>
<?}//while?>
              <tr>
              <td class="dataTableContent" align='right' colspan='6'><? 
				if (tep_not_null($customers)) $maximo = MAX_ROWS_MONITOR;
				else                          $maximo = MAX_DISPLAY_SEARCH_RESULTS;
				//echo "*** $customers ".$maximo;
				if ($TotalRows !=0){
					$first_row = (($PageNumber-1)*$maximo+1);     // MAX_ROWS_MONITOR
					//printf (TEXT_SHOWING, $first_row, $first_row+$TotalRows_query-1,$TotalRows);
					$Repage = '&nbsp; &nbsp; [ ';
					for ($i=1; $i<=ceil($TotalRows/$maximo);$i++){    // MAX_ROWS_MONITOR
						$Repage.= '<a href="'.tep_href_link(FILENAME_MONITOR,'orderby='.$orderby.'&orderbydir='.$orderbydir.'&page='.$i. '&customers='.$customers).'&backto='.$backto.'">' . $i . '</a> | ';
					}
					//echo substr($Repage,0,strlen($Repage)-2) .']';
					if (tep_not_null($customers) && $customers!='all')
						//echo ' &nbsp; <a href="' . tep_href_link(FILENAME_MONITOR,'customers=all') . '">'.TEXT_SHOW_ALL_REGISTERS.'</a>';
						//echo ' &nbsp; <a href="' . tep_href_link(FILENAME_MONITOR) . '">'.TEXT_SHOW_ALL_REGISTERS.'</a>';

					if (tep_not_null($backto))
						echo ' &nbsp; <a href="' . $backto . '">'.tep_image_button('button_back.gif', IMAGE_BACK) .'</a>';
					else
					if (tep_not_null($customers))
						echo ' &nbsp; <a href="' . tep_href_link(FILENAME_MONITOR) . '?orderby='.$orderby.'&orderbydir='.$orderbydir.'&page='.($i-1).'&customers=&search='.$search.'">'.tep_image_button('button_back.gif', IMAGE_BACK) .'</a>';

						
					
$paginas = ceil($contador/$maximo);
//echo "***".$paginas;
					
					    $monitor_split = new splitPageResults($_GET['page'], MAX_ROWS_MONITOR, $contador_string, $paginas);
//echo "***".$monitor_query_numrows;
	
						echo '<table border="0" width="100%" cellspacing="0" cellpadding="2"><tr>';
                        echo '<td class="smallText" valign="top">';
						//echo $monitor_split->display_count($TotalRows, MAX_ROWS_MONITOR, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_CUSTOMERS);
						printf (TEXT_SHOWING, $first_row, $first_row+$TotalRows_query-1,$contador);
						echo '</td>';
                        echo '<td class="smallText" align="right">';
					    echo $monitor_split->display_links($contador, MAX_ROWS_MONITOR, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'xinfo', 'x', 'y', 'cID')));
						echo '</td></tr>';
                echo '</table>';
						
						









						
						
						
						
				}else
					echo TEXT_NO_REGISTERS_IN_DB;
					?>
			  </td>
              </tr>
<?	    echo '<tr><td>&nbsp;<BR></td></tr>' . "\n";
/*
	if (tep_not_null($filtro)) {
		echo "<tr><td align=center colspan=5>";
		echo "<table cellspacing=0 cellpadding=3 border=0><tr><td background=\"../images/blink_red.gif\"><font color=\"#FFFFFF\"><strong>";
		echo "Exibindo somente ";
		if ($filtro=="site")  echo "registros de rastreio no site";
		if ($filtro=="admin") echo "históricos feitos pelo administrador";
		echo "</strong></font></td></tr></table>";
		echo "</td></tr>\n";
	}


if ($customers>0) {
	echo "<tr><td align=center colspan=5><a href='monitor_manage.php?customers=".$customers."&controle=novo&action=new&filtro=".$filtro."&orderby=".$orderby."&backto=".str_replace("&","*",$backto)."'>".tep_image_button('button_insert.gif', "Inserir novo registro de histórico para este cliente")."</a>
<br><br>
  <a href='".$PHP_SELF."?customers=".$customers."&filtro=site&backto=".$backto."'>[Filtrar rastreio no site]</a> -
  <a href='".$PHP_SELF."?customers=".$customers."&filtro=admin&backto=".$backto."'>[Filtrar históricos feitos pelo administrador]</a> -
  <a href='".$PHP_SELF."?customers=".$customers."&filtro=&backto=".$backto."'>[Desativar filtro]</a></td></tr>\n";
}*/
/*
if ($customers=="") {
//BOX: Opción pára respaldar y limpiar la Tabla de Monitoreo
	  $heading = array();
	  $contents = array();
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_BACKUP . '</b>');
        $contents[] = array('align' => 'center', 'text' => '<form name="bkform" method="post" action="'.tep_href_link(FILENAME_MONITOR, 'action=backup') .'"><input type="checkbox" name="delall"> ' . TEXT_DEL_ALL_REGISTERS . '</form>'.'<a onclick="return confirm(\''.TEXT_DELETE_BACKUP.'\')" href="javascript:document.bkform.submit();">' . tep_image_button('button_backup.gif', TEXT_BACKUP_TAB) . '</a>');
	    echo '            <tr><td width="25%" valign="top">' . "\n";
        $contents[] = array('align' => 'left', 'text' => TEXT_INFO_BACKUP); 
        $contents[] = array('align' => 'center', 'text' => '<a onclick="return confirm(\''.TEXT_DELETE_ALL.'\')" href="' . tep_href_link(FILENAME_MONITOR, 'action=delall') . '">' . tep_image_button('button_delall.gif', TEXT_DELETE_ALL_TAB) . '</a>'); 
        $contents[] = array('align' => 'center', 'text' => '<br>*' . TEXT_INFO_BEST_THROUGH_HTTPS); 
		$box = new box;
	    //echo $box->infoBox($heading, $contents);
	    //echo '            </td>' . "\n";

//Cuadro de texto por si se realiza un backup
		if (isset($backup_text) && $backup_text != ''){
			$onfocus = 'onfocus="this.select();alert(\''.TEXT_SELECTED_BACKUP.'\');"';
			echo '<td colspan="6" class="menuBoxHeading">&nbsp;&nbsp;' . TEXT_INTRO_BACKUP . "\n";
			echo '&nbsp;&nbsp;'. "\n";
			echo '<textarea rows="15" cols="70" '.$onfocus.'>' . $backup_text;
			echo '</textarea><br>'."\n";
			echo '<a href="' . tep_href_link(FILENAME_MONITOR) . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a></td>' . "\n";
		}else{
			if (isset($day_stat)){
				//Calculando el total de clicks X dia
				$Total_day=0;
				$Tot_Clicks_query = tep_db_query("select ip, monitor_date as date, monitor_time as time from " . TABLE_MONITOR_PAGE);
				while ($Tot_Clicks = tep_db_fetch_array ($Tot_Clicks_query)){
					$Total_dia = substr($Tot_Clicks['date'],8,2);
					$Total_hor = substr($Tot_Clicks['time'],0,2);
					if ($Total_dia==date("d")-$day_stat){
						$Total_day++;
						$Stat_Hor[(int)$Total_hor] = (isset($Stat_Hor[$Total_hor]))?$Stat_Hor[$Total_hor]+1:1;
						$Visits[$Tot_Clicks['ip']] = (isset($Visits[$Tot_Clicks['ip']]))? $Visits[$Tot_Clicks['ip']] : $Total_hor;
					}
				}
				$Titles_Row = '';			
				$Visits_Row = '';			
				$Clicks_Row = '';
				if (is_array($Visits)) $Ordered_Visits = array_count_values ($Visits);
				for ($i=0;$i<24;$i++){
					$Txt_Stat = (!isset($Stat_Hor[$i]))?'0':$Stat_Hor[$i];
					$Tit_Stat = ($i>=0 && $i<10)?'0'.$i:$i;
					$Visit_Stat = (!isset($Ordered_Visits[$i]))?'0':$Ordered_Visits[$i];
					$Titles_Row .= "\n  ".'<td class="formArea" align="center">'.$Tit_Stat.' hrs</td>';
					$Visits_Row .= "\n  ".'<td align="center">'.$Visit_Stat.'</td>';
					$Clicks_Row .= "\n  ".'<td align="center">'.$Txt_Stat.'</td>';
				}
				$STAT_TABLE_WIDTH = '100%';
				$STAT_COL_SPAN = 25;
				$STAT_TITLE = TEXT_STAT_TITLE_DAY;
				$STAT_TOTAL = $Total_day;
				$STAT_EXTRA = '<a href="' . tep_href_link(FILENAME_MONITOR) . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a></td>' . "\n";
			}else{
				//Calculando el total de clicks X semana
				$Tot_Clicks_query = tep_db_query("select monitor_date as date from " . TABLE_MONITOR_PAGE);
				$Total_sem=0;
				while ($Tot_Clicks = tep_db_fetch_array ($Tot_Clicks_query)){
					$Total_ano = substr($Tot_Clicks['date'],0,4);
					$Total_mes = substr($Tot_Clicks['date'],5,2);
					$Total_dia = substr($Tot_Clicks['date'],8,2);
					if ($Total_ano==date("Y") && $Total_mes==date("m")){
						if ($Total_dia>date("d")-7 && $Total_dia<date("d"))
							$Total_sem++;
					}
				}
				//Calculando Visitas y Clicks
				$Titles_Row = '';
				$Visits_Row = '';
				$Clicks_Row = '';
				for ($i=6;$i>=0;$i--){
					$fecha = array ('dia' => date("d"),
									'mes' => date("m"),
									'ano' => date("Y"));
					switch ($i){
						case '0': $Stat_Title = TEXT_STAT_TODAY; break;
						case '1': $Stat_Title = TEXT_STAT_YESTERDAY; break;
						default: $Stat_Title = date("D", mktime(0,0,0,$fecha['mes'], $fecha['dia']-$i, $fecha['ano']) );
					}
					$Numeric_Date = date("Y-m-d", mktime(0,0,0,$fecha['mes'], $fecha['dia']-$i, $fecha['ano']) );
					$Num_Visits_query = tep_db_query("select count(distinct(ip)) as total from " . TABLE_MONITOR_PAGE . " 	where monitor_date='" . $Numeric_Date . "'");
					$Num_Visits = tep_db_fetch_array ($Num_Visits_query);
					$Num_Clicks_query = tep_db_query("select count(ip) as total from " . TABLE_MONITOR_PAGE . " where 	monitor_date='" . $Numeric_Date . "'");
					$Num_Clicks = tep_db_fetch_array ($Num_Clicks_query);
					$Titles_Row .= "\n  " . '<td class="formArea" align="center"><a href="' . tep_href_link(FILENAME_MONITOR, 'day_stat='.$i) . '">' . $Stat_Title . ' ' . (date('d')-$i) . '</a></td>';
					$Visits_Row .= "\n  ".'<td align="center">'.$Num_Visits['total'].'</td>';
					$Clicks_Row .= "\n  ".'<td align="center">'.$Num_Clicks['total'].'</td>';
				}
				$STAT_TABLE_WIDTH = '80%';
				$STAT_COL_SPAN = 8;
				$STAT_TITLE = TEXT_STAT_TITLE_WEEK;
				$STAT_TOTAL = $Total_sem;
				$STAT_EXTRA = '</td>' . "\n";
			}
			/*************TABLA: Titulo Estadísticas********************/
/*
				echo "\n".'<td align="left" valign="top"><table class="dataTableContent" border="0" width="'.$STAT_TABLE_WIDTH.'" cellspacing="0" cellpadding="0">';
				echo "\n".'<tr class="formArea"><td class="tableHeading" colspan="'.$STAT_COL_SPAN.'" align="center"><b>' . TEXT_STAT_TITLE_DAY . 	'</b><br> </td></tr>';
			//Titulos de columna
				echo "\n".'<tr class="formArea"><td class="dataTableContent" width="80">&nbsp;</td>'.$Titles_Row.'</tr>';
			//No de visitas
				echo "\n".'<tr class="formArea"><td class="fieldKey" 	width="80">'.TEXT_STAT_NUM_VISITS.'</td>'.$Visits_Row.'</tr>';
			//No de clicks
				echo "\n".'<tr class="formArea"><td class="fieldKey" 	width="80">'.TEXT_STAT_NUM_CLICKS.'</td>'.$Clicks_Row.'</tr>';
			//Total de registros
				echo "\n".'<tr class="formArea"><td colspan="'.($STAT_COL_SPAN-1).'" align="right">'.TEXT_STAT_TOTALS.'</td><td class="formArea" align="center">'.$STAT_TOTAL.'</td></tr>';
				echo "\n".'</table><br>';
			//Extra
				echo $STAT_EXTRA;
			echo '		</tr>' . "\n";
		}
}
*/
?>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
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
