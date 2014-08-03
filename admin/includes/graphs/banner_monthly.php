<?php
/*
  $Id: banner_monthly.php,v 1.3 2002/05/09 18:28:46 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  include(DIR_WS_CLASSES . 'phplot.php');

  $year = (($HTTP_GET_VARS['year']) ? $HTTP_GET_VARS['year'] : date('Y'));

  $stats = array();
  for ($i=1; $i<13; $i++) {
    $stats[] = array(strftime('%b', mktime(0,0,0,$i)), '0', '0');
  }

  $banner_stats_query = tep_db_query("select month(banners_history_date) as banner_month, sum(banners_shown) as value, sum(banners_clicked) as dvalue from " . TABLE_BANNERS_HISTORY . " where banners_id = '" . $banner_id . "' and year(banners_history_date) = '" . $year . "' group by banner_month");
  while ($banner_stats = tep_db_fetch_array($banner_stats_query)) {
    $stats[($banner_stats['banner_month']-1)] = array(strftime('%b', mktime(0,0,0,$banner_stats['banner_month'])), (($banner_stats['value']) ? $banner_stats['value'] : '0'), (($banner_stats['dvalue']) ? $banner_stats['dvalue'] : '0'));
  }

/*
  $graph = new PHPlot(600, 350, 'images/graphs/banner_monthly-' . $banner_id . '.' . $banner_extension);

  $graph->SetFileFormat($banner_extension);
  $graph->SetIsInline(1);
  $graph->SetPrintImage(0);

  $graph->SetSkipBottomTick(1);
  $graph->SetDrawYGrid(1);
  $graph->SetPrecisionY(0);
  $graph->SetPlotType('lines');

  $graph->SetPlotBorderType('left');
  $graph->SetTitleFontSize('4');
  $graph->SetTitle(sprintf(TEXT_BANNERS_MONTHLY_STATISTICS, $banner['banners_title'], $year));

  $graph->SetBackgroundColor('white');

  $graph->SetVertTickPosition('plotleft');
  $graph->SetDataValues($stats);
  $graph->SetDataColors(array('blue','red'),array('blue', 'red'));

  $graph->DrawGraph();

  $graph->PrintImage();

  */
   $arquivo = "includes/charts/xml/banner_monthly-".$banner_id.".xml";
	$newline = "<graph  caption='".sprintf(TEXT_BANNERS_MONTHLY_STATISTICS, $banner['banners_title'], $year)."' 
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
