<?php
/*
  $Id: banner_daily.php,v 1.2 2002/05/09 14:09:38 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  include(DIR_WS_CLASSES . 'phplot.php');

  $year = (($HTTP_GET_VARS['year']) ? $HTTP_GET_VARS['year'] : date('Y'));
  $month = (($HTTP_GET_VARS['month']) ? $HTTP_GET_VARS['month'] : date('n'));

  $days = (date('t', mktime(0,0,0,$month))+1);
  $stats = array();
  for ($i=1; $i<$days; $i++) {
    $stats[] = array($i, '0', '0');
  }

  $banner_stats_query = tep_db_query("select dayofmonth(banners_history_date) as banner_day, banners_shown as value, banners_clicked as dvalue from " . TABLE_BANNERS_HISTORY . " where banners_id = '" . $banner_id . "' and month(banners_history_date) = '" . $month . "' and year(banners_history_date) = '" . $year . "'");
  while ($banner_stats = tep_db_fetch_array($banner_stats_query)) {
    $stats[($banner_stats['banner_day']-1)] = array($banner_stats['banner_day'], (($banner_stats['value']) ? $banner_stats['value'] : '0'), (($banner_stats['dvalue']) ? $banner_stats['dvalue'] : '0'));
  }
 /* 
  
	
  $graph = new PHPlot(600, 350, 'images/graphs/banner_daily-' . $banner_id . '.' . $banner_extension);

  $graph->SetFileFormat($banner_extension);
  $graph->SetIsInline(1);
  $graph->SetPrintImage(0);

  $graph->SetSkipBottomTick(1);
  $graph->SetDrawYGrid(1);
  $graph->SetPrecisionY(0);
  $graph->SetPlotType('lines');

  $graph->SetPlotBorderType('left');
  $graph->SetTitleFontSize('4');
  $graph->SetTitle(sprintf(TEXT_BANNERS_DAILY_STATISTICS, $banner['banners_title'], strftime('%B', mktime(0,0,0,$month)), $year));

  $graph->SetBackgroundColor('white');

  $graph->SetVertTickPosition('plotleft');
  $graph->SetDataValues($stats);
  $graph->SetDataColors(array('blue','red'),array('blue', 'red'));

  $graph->DrawGraph();

  $graph->PrintImage();

*/  
  $arquivo = "includes/charts/xml/banner_daily-".$banner_id.".xml";
	$newline = "<graph  caption='".sprintf(TEXT_BANNERS_DAILY_STATISTICS, $banner['banners_title'], strftime('%B', mktime(0,0,0,$month)), $year)."' 
                showValues='0' 
                numVDivLines='20'
                showAnchors='1'
				anchorRadius='4'
                divlinecolor='D7D8D3' 
                divLineAlpha='80' 
                showAlternateHGridColor='1' 
                alternateHGridColor='D7D8D3' 
                alternateHGridAlpha='20' 
                bgColor='E3E6D9' 
                bgAlpha='50' 
                baseFontColor='5D633F' 
                canvasBorderThickness='1' 
                decimalPrecision='0' 
				animation='1' 
                limitsDecimalPrecision='0' 
                divLineDecimalPrecision='0'
                yAxisMinValue='800000'>";
	
	
	
				
		$newline .= '<categories>';
	  for($cont = 0; $cont < sizeof($stats); $cont++){
	  	$newline .= '  <category name="'.$stats[$cont][0].'"/>';		
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
