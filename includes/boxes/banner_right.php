<?php  
$random_partner_select = tep_db_query("select banners_group from banners where banners_group LIKE 'banner_dir%'");
$random_partner = tep_db_fetch_array($random_partner_select);
$ramdon_num_rows = tep_db_num_rows($random_partner_select);
if($ramdon_num_rows > 0){
	for($cont4 =1; $cont4 <= $ramdon_num_rows; $cont4++){
		if ($banner = tep_banner_exists('dynamic', 'banner_dir'.$cont4)) 
		echo "<center><br/>".tep_display_banner('static', $banner)."<br/></center>";
 	} 
}
?>