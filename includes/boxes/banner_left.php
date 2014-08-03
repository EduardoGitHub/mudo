<?php  
$random_partner_select = tep_db_query("select banners_group from banners where banners_group LIKE 'banner_esq%'");
$random_partner = tep_db_fetch_array($random_partner_select);
$ramdon_num_rows = tep_db_num_rows($random_partner_select);
if($ramdon_num_rows > 0){
	for($cont3 =1; $cont3 <= $ramdon_num_rows; $cont3++){
		if ($banner = tep_banner_exists('dynamic', 'banner_esq'.$cont3)) 
		echo "<center><br/>".tep_display_banner('static', $banner)."<br/></center>";
 	} 
}
?>