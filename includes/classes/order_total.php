<?php
/*
  $Id: order_total.php,v 1.4 2003/02/11 00:04:53 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class order_total {
    var $modules;

// class constructor
    function order_total() {
      global $language;

      if (defined('MODULE_ORDER_TOTAL_INSTALLED') && tep_not_null(MODULE_ORDER_TOTAL_INSTALLED)) {
        $this->modules = explode(';', MODULE_ORDER_TOTAL_INSTALLED);

        reset($this->modules);
        while (list(, $value) = each($this->modules)) {
		
		/*echo "<script>alert ('Value: ".$value."')</script>";*/
          include(DIR_WS_LANGUAGES . $language . '/modules/order_total/' . $value);
          include(DIR_WS_MODULES . 'order_total/' . $value);

          $class = substr($value, 0, strrpos($value, '.'));
          $GLOBALS[$class] = new $class;
		  /*echo "<script>alert ('Classe: ".$class."')</script>";*/
        }
      }
    }

    function process() {
      $order_total_array = array();
      if (is_array($this->modules)) {
        reset($this->modules);
        while (list(, $value) = each($this->modules)) {
          $class = substr($value, 0, strrpos($value, '.'));
          if ($GLOBALS[$class]->enabled) {
            $GLOBALS[$class]->process();

            for ($i=0, $n=sizeof($GLOBALS[$class]->output); $i<$n; $i++) {
              if (tep_not_null($GLOBALS[$class]->output[$i]['title']) && tep_not_null($GLOBALS[$class]->output[$i]['text'])) {
                $order_total_array[] = array('code' => $GLOBALS[$class]->code,
                                             'title' => $GLOBALS[$class]->output[$i]['title'],
                                             'text' => $GLOBALS[$class]->output[$i]['text'],
                                             'value' => $GLOBALS[$class]->output[$i]['value'],
                                             'sort_order' => $GLOBALS[$class]->sort_order);
              }
			 
            }
          }
        }
      }

      return $order_total_array;
    }
	

    function output() {
      $output_string = '';
      if (is_array($this->modules)) {
        reset($this->modules);
        while (list(, $value) = each($this->modules)) {
          $class = substr($value, 0, strrpos($value, '.'));
          if ($GLOBALS[$class]->enabled) {
            $size = sizeof($GLOBALS[$class]->output);
            for ($i=0; $i<$size; $i++) {
              $output_string .= '              <tr>' . "\n" .
                                '                <td align="right" class="main">' . $GLOBALS[$class]->output[0]['title'] . '</td>' . "\n" .
                                '                <td style="text-align:right" class="main">' . $GLOBALS[$class]->output[0]['text'] . '</td>' . "\n" .
                                '              </tr>';			
            }
          }
        }
      }

      return $output_string;
    }
  }  
  
  //GERA O NUMERO DE PARCELAS
  function parcelas(){
  $parcelas_string = '';
  $quntparcelas = MODULE_ORDER_TOTAL_NUM_PARCELAS_SORT_ORDER + 1;
  $valorminimo = MODULE_ORDER_TOTAL_VALOR_PARCELAS_SORT_ORDER;
  $tot = $GLOBALS[ot_total]->output[0]['value'];
  if($tot > $valorminimo){
	  for($cont =1; $cont < $quntparcelas; $cont++)
		{
			if($cont ==1){$selecionado = 'checked';}
			
			$valor_with_tax = '';
			$valor_with_tax = $tot;
			
			$juros = str_replace ("%", "", MODULE_ORDER_TOTAL_TAX_PARCELAS);
			$juros = str_replace (",", ".", MODULE_ORDER_TOTAL_TAX_PARCELAS);
			$juros = $juros/100;
			
			for($i=0; $i < $cont; $i++){
				$parc_with_tax = $valor_with_tax * $juros;
				$valor_with_tax = $valor_with_tax + $parc_with_tax; 
			}
			/*echo "<script>alert('".$cont."x parcelas valor:".$valor_with_tax."')</script>";*/
			$total_with_tax = number_format($valor_with_tax/$cont, 2, ',', '.');
			
			$parc = $tot / $cont;
			$vl_parc = number_format($parc, 2, ',', '.');
				
				if($cont <> 1){
				$parcelas_string .= 	'             <table border="0" cellspacing="0" cellpadding="0">'. "\n" .
										'				<tr>' . "\n" .
										'                <td align="right">'.tep_draw_radio_field('numparc', $cont).'</td>' . "\n" .
										'                <td align="left">'.$cont.'x de <b>R$'.$total_with_tax.'</b></td>' . "\n" .
										'              </tr>'. "\n" .
										'			</table>';
				}else{
				
					$parcelas_string .= 	'             <table border="0" cellspacing="0" cellpadding="0">'. "\n" .
										'				<tr>' . "\n" .
										'                <td align="right">'.tep_draw_radio_field('numparc', $cont, 'checked').'</td>' . "\n" .
										'                <td align="left">'.$cont.'x de <b>R$'.$vl_parc.'</b></td>' . "\n" .
										'              </tr>'. "\n" .
										'			</table>';
				}						
		}
	}else{
		$parcelas_string = '<span style="font-family:Arial, Helvetica, sans-serif; color:#FF0000; font-size:10px;"><b>Não é possivel parcelar.</b></span>';
	}
	return $parcelas_string;
  }
  //FIM PARCELAS 
?>