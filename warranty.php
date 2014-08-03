<?php
  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_WARRANTY);
  if (isset($_GET['action']) && ($_GET['action'] == 'send')) {

    $num_pedido = tep_db_prepare_input($_POST['numpedido']);
	$codeofbars = tep_db_prepare_input($_POST['codeofbars']);
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<?php
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
  <title><?php echo TITLE; ?></title>
<?php
}
?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<style type="text/css">
.classTitulos{ font-family:Arial;  font-size:10px; color:#333333; font-weight:bold; height:20px; }
.classTexto{ font-family:Arial;  font-size:10px;  color:#333333;  border-bottom:1px #CCCCCC solid; height:20px; }
</style>
</head>
<body>
<div id="container">
  <div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
  <div id="sidebar1"><?php require(DIR_WS_INCLUDES . 'column_left.php'); ?></div>
  <div id="sidebar2"><?php require(DIR_WS_INCLUDES . 'column_right.php'); ?></div>
  <div id="mainContent">
  
  <div class="pagestitulo"><span><?php echo HEADING_TITLE; ?></span></div>
  <?php echo tep_draw_form('warranty', tep_href_link(FILENAME_WARRANTY, 'action=send')); ?>
  
  <div class="pagestexto">	
  <span class="main"><?php echo TEXT_INFORMATION; ?></span><br /><br />
  
	  <?php if(CLIENT_ZEUS =='True'){?>
      <div>
        <b><?php echo ENTRY_PURCHASE; ?></b> <?php echo tep_draw_radio_field('purchase', '2', '', 'onClick="desabilita(this.value)" checked="checked"') . '&nbsp;&nbsp;' . ENTRY_PURCHASE_PHYSICALSTORE. '&nbsp;&nbsp;' . tep_draw_radio_field('purchase', '1','', 'onClick="desabilita(this.value)"') . '&nbsp;&nbsp;' . ENTRY_PURCHASE_VITUALSTORE . '&nbsp;' ; ?>
      </div>	
      <? }?>
      <br />
      <?php echo ENTRY_ORDER; ?><br />
      <?php echo tep_draw_input_field('numpedido','','size="30" onKeyUp="apagar(1)" '); ?> <?php if(CLIENT_ZEUS =='True'){?><b>ou</b><? }?><br />
      <?php if(CLIENT_ZEUS =='True'){?>
		<?php echo ENTRY_CODEOFBARS; ?><br />
        <?php echo tep_draw_input_field('codeofbars','','size="30" onKeyUp="apagar(2)"'); ?>
	  <? }?>
      <br /><br />
      <?php echo tep_image_submit('button_consult.gif', IMAGE_BUTTON_CONTINUE); ?>
      <br /><br />
      <div>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" >
		  <?php
            $imprimi ='';
            if(CLIENT_ZEUS =='True')
                {
                    if(isset($_POST['numpedido']) && $_POST['numpedido'] <> '' && $_POST['purchase'] ==2){
                        $query = mysql_query('select * from warranty where num_order ="'.$num_pedido.'"');
                        if(mysql_num_rows($query)>=1){
                            $imprimi .= '<tr bgcolor="#CCCCCC">
                                            <td width="185" class="classTitulos">&nbsp;PRODUTO</td>
                                            <td width="127" class="classTitulos">DATA DA COMPRA </td>
                                            <td width="114" class="classTitulos">TEMPO DE GARANTIA </td>
                                            <td width="82" class="classTitulos">FIM GARANTIA </td>
                                          </tr>';
                            while($query_info = mysql_fetch_assoc($query)){
                                $raw_date = $query_info['date_purchased'];
                                $year = substr($raw_date, 0, 4);
                                $month = substr($raw_date, 5, 2);
                                $day = substr($raw_date, 8, 2);
                                $hour = substr($raw_date, 11, 2);
                                $minutes = substr($raw_date, 14, 2);
                                $seconds = substr($raw_date, 17, 2);
                                $date_purchase = date("Ymd", mktime(0, 0, 0, $month, $day, $year));
                                $end_warranty = addDayIntoDate($date_purchase,$query_info['warranty']);
                                $date_detalhada = date("d/m/Y - g:i a", mktime($hour, $minutes, $seconds, $month, $day, $year));
                                $year2 = substr($end_warranty, 0, 4);
                                $month2 = substr($end_warranty, 4, 2);
                                $day2 = substr($end_warranty, 6, 2);
                                $end_warranty = date("d/m/Y", mktime(0, 0, 0, $month2, $day2, $year2));
                                
                                $imprimi .= '<tr>
                                                <td class="classTexto">'.$query_info['products'].'</td>
                                                <td class="classTexto">'.$date_detalhada.'</td>
                                                <td class="classTexto">'.$query_info['warranty'].' dias</td>
                                                <td class="classTexto">'.$end_warranty.'</td>
                                              </tr>';
                            }
                        }else{
                            $imprimi = '<img src="../comum/images/alert.gif">&nbsp;&nbsp;Número do pedido não encontrado em nosso Banco de dados. Favor verificar o número do pedido.'; 
                        }	
                    }else if(isset($_POST['numpedido']) && $_POST['numpedido'] <> '' && $_POST['purchase'] ==1){
                        $query = mysql_query('SELECT o.date_purchased, op.products_name, p.products_warranty FROM orders o, orders_products op, products p WHERE o.orders_id = '.$num_pedido.' and op.orders_id ='.$num_pedido.' and p.products_id = op.products_id');
                            if(mysql_num_rows($query)>=1){
                                $imprimi .= '<tr bgcolor="#CCCCCC">
                                                <td width="185" class="classTitulos">&nbsp;PRODUTO</td>
                                                <td width="127" class="classTitulos">DATA DA COMPRA </td>
                                                <td width="114" class="classTitulos">TEMPO DE GARANTIA </td>
                                                <td width="82" class="classTitulos">FIM GARANTIA </td>
                                              </tr>';
                                while($query_info = mysql_fetch_assoc($query)){
                                    
                                    $raw_date = $query_info['date_purchased'];
                                    $year = substr($raw_date, 0, 4);
                                    $month = substr($raw_date, 5, 2);
                                    $day = substr($raw_date, 8, 2);
                                    $hour = substr($raw_date, 11, 2);
                                    $minutes = substr($raw_date, 14, 2);
                                    $seconds = substr($raw_date, 17, 2);
                                    $date_purchase = date("Ymd", mktime(0, 0, 0, $month, $day, $year));
                                    $end_warranty = addDayIntoDate($date_purchase,$query_info['products_warranty']);
                                    $date_detalhada = date("d/m/Y - g:i a", mktime($hour, $minutes, $seconds, $month, $day, $year));
                                    $year2 = substr($end_warranty, 0, 4);
                                    $month2 = substr($end_warranty, 4, 2);
                                    $day2 = substr($end_warranty, 6, 2);
                                    $end_warranty = date("d/m/Y", mktime(0, 0, 0, $month2, $day2, $year2));
                                    
                                    $imprimi .= '<tr>
                                                    <td class="classTexto">'.$query_info['products_name'].'</td>
                                                    <td class="classTexto">'.$date_detalhada.'</td>
                                                    <td class="classTexto">'.$query_info['products_warranty'].' dias</td>
                                                    <td class="classTexto">'.$end_warranty.'</td>
                                                  </tr>';
                                }
                            }else{
                                $imprimi = '<img src="../comum/images/alert.gif">&nbsp;&nbsp;Número do pedido não encontrado em nosso Banco de dados. Favor verificar o número do pedido.'; 
                            }

                    }else if(isset($_POST['codeofbars']) and $_POST['codeofbars'] <> '' && $_POST['purchase'] ==2){
                        $query = mysql_query('select * from warranty where barcode ="'.$codeofbars.'"');
                        if(mysql_num_rows($query)>=1){
                            $imprimi .= '<tr bgcolor="#CCCCCC">
                                            <td width="185" class="classTitulos">&nbsp;PRODUTO</td>
                                            <td width="127" class="classTitulos">DATA DA COMPRA </td>
                                            <td width="114" class="classTitulos">TEMPO DE GARANTIA </td>
                                            <td width="82" class="classTitulos">FIM GARANTIA </td>
                                          </tr>';
                            while($query_info = mysql_fetch_assoc($query)){
                            
                                $raw_date = $query_info['date_purchased'];
                                $year = substr($raw_date, 0, 4);
                                $month = substr($raw_date, 5, 2);
                                $day = substr($raw_date, 8, 2);
                                $hour = substr($raw_date, 11, 2);
                                $minutes = substr($raw_date, 14, 2);
                                $seconds = substr($raw_date, 17, 2);
                                $date_purchase = date("Ymd", mktime(0, 0, 0, $month, $day, $year));
                                $end_warranty = addDayIntoDate($date_purchase,$query_info['warranty']);
                                $date_detalhada = date("d/m/Y - g:i a", mktime($hour, $minutes, $seconds, $month, $day, $year));
                                $year2 = substr($end_warranty, 0, 4);
                                $month2 = substr($end_warranty, 4, 2);
                                $day2 = substr($end_warranty, 6, 2);
                                $end_warranty = date("d/m/Y", mktime(0, 0, 0, $month2, $day2, $year2));
                                
                                $imprimi .= '<tr>
                                                <td class="classTexto">'.$query_info['products'].'</td>
                                                <td class="classTexto">'.$date_detalhada.'</td>
                                                <td class="classTexto">'.$query_info['warranty'].' dias</td>
                                                <td class="classTexto">'.$end_warranty.'</td>
                                              </tr>';
                            }
                        }else{
                        
                            $imprimi = '<img src="../comum/images/alert.gif">&nbsp;&nbsp;Código de barras não encontrado em nosso Banco de dados. Favor verificar o número do código de barras.'; 
                        }
                    
                    }
                }else{//SENAO FOR CLIENTE ZEUS O USUÁRIO PODE CONSULTAR SOMENTE PRO PEDIDO FEITO NA LOJA.
        
                        if(isset($_POST['numpedido']) && $_POST['numpedido'] <> ''){
                $query = mysql_query('SELECT o.date_purchased, op.products_name, p.products_warranty FROM orders o, orders_products op, products p WHERE o.orders_id = '.$num_pedido.' and op.orders_id ='.$num_pedido.' and p.products_id = op.products_id');
                        if(mysql_num_rows($query)>=1){
                            $imprimi .= '<tr bgcolor="#CCCCCC">
                                            <td width="185" class="classTitulos">&nbsp;PRODUTO</td>
                                            <td width="127" class="classTitulos">DATA DA COMPRA </td>
                                            <td width="114" class="classTitulos">TEMPO DE GARANTIA </td>
                                            <td width="82" class="classTitulos">FIM GARANTIA </td>
                                          </tr>';
                            while($query_info = mysql_fetch_assoc($query)){
                                $raw_date = $query_info['date_purchased'];
                                $year = substr($raw_date, 0, 4);
                                $month = substr($raw_date, 5, 2);
                                $day = substr($raw_date, 8, 2);
                                $hour = substr($raw_date, 11, 2);
                                $minutes = substr($raw_date, 14, 2);
                                $seconds = substr($raw_date, 17, 2);
                                $date_purchase = date("Ymd", mktime(0, 0, 0, $month, $day, $year));
                                $end_warranty = addDayIntoDate($date_purchase,$query_info['products_warranty']);
                                $date_detalhada = date("d/m/Y - g:i a", mktime($hour, $minutes, $seconds, $month, $day, $year));
                                $year2 = substr($end_warranty, 0, 4);
                                $month2 = substr($end_warranty, 4, 2);
                                $day2 = substr($end_warranty, 6, 2);
                                $end_warranty = date("d/m/Y", mktime(0, 0, 0, $month2, $day2, $year2));
                                
                                $imprimi .= '<tr>
                                                <td class="classTexto">'.$query_info['products_name'].'</td>
                                                <td class="classTexto">'.$date_detalhada.'</td>
                                                <td class="classTexto">'.$query_info['products_warranty'].' dias</td>
                                                <td class="classTexto">'.$end_warranty.'</td>
                                              </tr>';
                            }
                        }else{
                            $imprimi = '<img src="../comum/images/alert.gif">&nbsp;&nbsp;Número do pedido não encontrado em nosso Banco de dados. Favor verificar o número do pedido.'; 
                        }
            }
                }
            echo $imprimi;
          ?>
        </table>
      </div>
  </div>  
</form>
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<script type="text/javascript">
function apagar(id){
	if(id=='1'){
		if(document.warranty.numpedido.value !=''){
		document.warranty.codeofbars.value = '';
		}
	}else if(id=='2'){
		if(document.warranty.codeofbars.value !=''){
		document.warranty.numpedido.value = '';
		}
	}	
}

function desabilita(id){
	if(id==1){
		document.warranty.codeofbars.disabled = true;
		document.warranty.codeofbars.value = '';
		document.warranty.codeofbars.style.background = '#CCCCCC';
	}else if(id==2){
		document.warranty.codeofbars.disabled = false;
		document.warranty.codeofbars.style.background = '#FFFFFF';

	}
}
</script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>