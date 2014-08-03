<?php
/*
  $Id: banner_infobox.php,v 1.3 2003/07/11 18:15:42 project3000 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  include(DIR_WS_CLASSES . 'phplot.php');

  $stats = array();
  $banner_stats_query = tep_db_query("select dayofmonth(banners_history_date) as name, banners_shown as value, banners_clicked as dvalue from " . TABLE_BANNERS_HISTORY . " where banners_id = '" . $banner_id . "' and to_days(now()) - to_days(banners_history_date) < " . $days . " order by banners_history_date");
  while ($banner_stats = tep_db_fetch_array($banner_stats_query)) {
    $stats[] = array($banner_stats['name'], $banner_stats['value'], $banner_stats['dvalue']);
  }

  if (sizeof($stats) < 1) $stats = array(array(date('j'), 0, 0));

/*
  $graph = new PHPlot(200, 220, 'images/graphs/banner_infobox-' . $banner_id . '.' . $banner_extension);

  $graph->SetFileFormat($banner_extension);
  $graph->SetIsInline(1);
  $graph->SetPrintImage(0);

  $graph->draw_vert_ticks = 0;
  $graph->SetSkipBottomTick(1);
  $graph->SetDrawXDataLabels(0);
  $graph->SetDrawYGrid(0);
  $graph->SetPlotType('bars');
  $graph->SetDrawDataLabels(1);
  $graph->SetLabelScalePosition(1);
  $graph->SetMarginsPixels(15,15,15,30);

  $graph->SetTitleFontSize('4');
  $graph->SetTitle('TEXT_BANNERS_LAST_3_DAYS');

  $graph->SetDataValues($stats);
  $graph->SetDataColors(array('blue','red'),array('blue', 'red'));

  $graph->DrawGraph();

  $graph->PrintImage();

  */
  
  
  
  	$arquivo = "includes/charts/xml/banner_infobox-".$banner_id.".xml";
	$newline = "<graph  caption='Nos últimos 3 dias' shownames='1' showvalues='1' showAlternateHGridColor='1' AlternateHGridAlpha='30' AlternateHGridColor='E4E7D9' divLineColor='E4E7D9' divLineAlpha='80' canvasBorderThickness='1'  canvasBorderColor='114B78' limitsDecimalPrecision='0' divLineDecimalPrecision='0' decimalPrecision='0' yAxisName='Dias'>";
				
		$newline .= '<categories>';
	  for($cont = 0; $cont < sizeof($stats); $cont++){
	  	$newline .= '  <category name="Dia '.$stats[$cont][0].'"/>';		
	  }
		$newline .= '</categories>';  



	$newline .= '<dataset seriesName="Banners Visto" color="#0000FF">';
	for($cont3 =0; $cont3 < sizeof($stats); $cont3++){
		$newline .= '  <set value="'.$stats[$cont3][1].'"/>';
	}
	$newline .= '</dataset>';
	
	$newline .= '<dataset seriesName="Banners Clicados" color="#FF0000">';
	for($cont3 =0; $cont3 < sizeof($stats); $cont3++){
		$newline .= '  <set value="'.$stats[$cont3][2].'"/>';
	}
	$newline .= '</dataset>';
$newline .= '</graph>';	


	
	$open = fopen($arquivo,"w");
	chmod($arquivo, 0777);	
	$write = fwrite($open,$newline);
	fclose($open);
	
  
  
?>
