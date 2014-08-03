<?php


include('includes/configure.php');
require(DIR_WS_FUNCTIONS  . 'general.php');
require(DIR_WS_INCLUDES  . 'database_tables.php');
require(DIR_WS_FUNCTIONS . 'database.php');
tep_db_connect() or die('Unable to connect to database server!');



$action = $_REQUEST['action'];

switch ($action){

	case 'vEmailExist':
	 $email = process_db(TABLE_CUSTOMERS, array('customers_id'), ' WHERE customers_email_address="'.$_GET['email_address'].'"');
     if(count($email) > 0){
         echo 'false';
     }else echo 'true';
	break;


}

?>