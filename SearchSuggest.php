<?php
	include('includes/application_top.php');
	$gmtDate = gmdate("D, d M Y H:i:s");
      header("Expires: {$gmtDate} GMT");
      header("Last-Modified: {$gmtDate} GMT");
      header("Cache-Control: no-cache, must-revalidate");
      header("Pragma: no-cache");
      header("Content-Type: text/html; charset=iso-8859-1");
	if($_GET['search'] !=''){
		$var = explode(' ', $_GET['search']);
		//var_dump($var);
		$num_var = count($var);
		
		if($num_var > 1){
		
			$insert .= "like('%" . tep_db_input($var[0]) . "%')";
			$cont = 1;
			while($cont < $num_var){
				$insert .= " and products_name like('%" . tep_db_input($var[$cont]) . "%')";
				$cont++;
			}
		}else{
			$insert .= "like('%" . tep_db_input($_GET['search']) . "%')";
		}
		
		$array = array();
		$cont2 =0;
		while($cont2 <$num_var){
			$array[] = '<B>'.$var[$cont2].'</B>';
			$cont2++;
		}

		$sql = "SELECT pd.products_name FROM products_description pd, products p 
				WHERE p.products_status = 1 and p.products_id = pd.products_id and pd.products_name ".$insert." LIMIT 5";
		$product_query = tep_db_query($sql);
		while($product_array = tep_db_fetch_array($product_query)) {
			//echo $product_array['products_name'] . "\n";.
			echo str_ireplace($var,$array,$product_array['products_name']) . "\n";
		}

	}
?> 