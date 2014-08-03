<?php
  require('includes/application_top.php');
  header("HTTP/1.1 301 Moved Permanently"); 
  header("Location: ".tep_href_link('product_info.php','products_id='.(int)$_GET['products_id'])); 
?>