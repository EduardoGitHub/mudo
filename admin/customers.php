<?php
/*
  $Id: customers_improved.php, v1.3b 2006/04/26 23:12:52 kremit Exp $

Customers Improved v1.4.2

Copyright (c) 2005 Wesley Haines
<kremit AT wrpn.net>, http://wrpn.net/


  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  require("../includes/modules/email/class.phpmailer.php");
  
  error_reporting(0);
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  $type_register = tep_db_query("select customers_type_register, customers_sended_mail_revenda from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$HTTP_GET_VARS['cID'] . "'");
$type_is = tep_db_fetch_array($type_register);

if(isset($_POST['orderby'])) $orderby = tep_db_prepare_input($_POST['orderby']);
if(isset($_POST['sort'])) $sort = tep_db_prepare_input($_POST['sort']);
if(!$orderby) $orderby = 'firstname';
if(!$sort) $sort = 'ASC';

  $error = false;
  $processed = false;

  if (tep_not_null($action)) {
    switch ($action) {
      case 'update':
       case 'update':
        $customers_id = tep_db_prepare_input($HTTP_GET_VARS['cID']);
        $customers_firstname = tep_db_prepare_input($HTTP_POST_VARS['customers_firstname']);
        $customers_lastname = tep_db_prepare_input($HTTP_POST_VARS['customers_lastname']);
		
		$customers_cpf = tep_db_prepare_input($HTTP_POST_VARS['customers_cpf']);
		$customers_rg = tep_db_prepare_input($HTTP_POST_VARS['customers_rg']);
		
        $customers_email_address = tep_db_prepare_input($HTTP_POST_VARS['customers_email_address']);
        $customers_telephone = tep_db_prepare_input($HTTP_POST_VARS['customers_telephone']);
		$customers_telephone_comercial = tep_db_prepare_input($HTTP_POST_VARS['customers_telephone_comercial']);
		$customers_telephone_celular = tep_db_prepare_input($HTTP_POST_VARS['customers_telephone_celular']);
        $customers_fax = tep_db_prepare_input($HTTP_POST_VARS['customers_fax']);
        $customers_newsletter = tep_db_prepare_input($HTTP_POST_VARS['customers_newsletter']);
		$customers_revendedor = tep_db_prepare_input($HTTP_POST_VARS['customers_revendedor']);

        $customers_gender = tep_db_prepare_input($HTTP_POST_VARS['customers_gender']);
        $customers_dob = tep_db_prepare_input($HTTP_POST_VARS['customers_dob']);
		$partner = tep_db_prepare_input($HTTP_POST_VARS['customers_partner']);

        $default_address_id = tep_db_prepare_input($HTTP_POST_VARS['default_address_id']);
        $entry_street_address = tep_db_prepare_input($HTTP_POST_VARS['entry_street_address']);
		$entry_street_number = tep_db_prepare_input($HTTP_POST_VARS['entry_street_number']);
        $entry_suburb = tep_db_prepare_input($HTTP_POST_VARS['entry_suburb']);
		$entry_complemento = tep_db_prepare_input($HTTP_POST_VARS['entry_complemento']);
        $entry_postcode = tep_db_prepare_input($HTTP_POST_VARS['entry_postcode']);
        $entry_city = tep_db_prepare_input($HTTP_POST_VARS['entry_city']);
        $entry_country_id = tep_db_prepare_input($HTTP_POST_VARS['entry_country_id']);

        $entry_company = tep_db_prepare_input($HTTP_POST_VARS['entry_company']);
        $entry_state = tep_db_prepare_input($HTTP_POST_VARS['entry_state']);
        if (isset($_POST['entry_zone_id'])) $entry_zone_id = tep_db_prepare_input($_POST['entry_zone_id']);


		if (strlen($customers_firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
          $error = true;
          $entry_firstname_error = true;
        } else {
          $entry_firstname_error = false;
        }

        if (strlen($customers_lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
          $error = true;
          $entry_lastname_error = true;
        } else {
          $entry_lastname_error = false;
        }
			
			
        if ((ACCOUNT_DOB == 'true')&&($type_is['customers_type_register']== 'F'))
			{
          		if (checkdate(substr(tep_date_raw($customers_dob), 6, 2), substr(tep_date_raw($customers_dob), 4, 2), substr(tep_date_raw($customers_dob), 0, 4))) 
					{
						$entry_date_of_birth_error = false;
						$data_certa = substr(tep_date_raw($customers_dob), 0, 4).substr(tep_date_raw($customers_dob), 6, 2).substr(tep_date_raw($customers_dob), 4, 2);
         			} else {
							$error = true;
							$entry_date_of_birth_error = true;
          				   }
        	}
			
			

        if (strlen($customers_email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
          $error = true;
          $entry_email_address_error = true;
        } else {
          $entry_email_address_error = false;
        }

        if (!tep_validate_email($customers_email_address)) {
          $error = true;
          $entry_email_address_check_error = true;
        } else {
          $entry_email_address_check_error = false;
        }

        if (strlen($entry_street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
          $error = true;
          $entry_street_address_error = true;
        } else {
          $entry_street_address_error = false;
        }
		
		 if (strlen($entry_street_number) < ENTRY_STREET_NUMBER_MIN_LENGTH) {
          $error = true;
          $entry_street_number_error = true;
        } else {
          $entry_street_number_error = false;
        }
		
		if($type_is['customers_type_register']== 'F'){
		
			if (strlen($customers_cpf) < ENTRY_STREET_CPF_MIN_LENGTH) {
			$error = true;
			$customers_cpf_error = true;
			} else {
			$customers_cpf_error = false;
			}
			
			if (strlen($customers_rg) < ENTRY_STREET_RG_MIN_LENGTH) {
			$error = true;
			$customers_rg_error = true;
			} else {
			$customers_rg_error = false;
			}
		}else if($type_is['customers_type_register']== 'J'){
		
			if (strlen($customers_cpf) < ENTRY_CNPJ_MIN_LENGTH) {
			$error = true;
			$customers_cpf_error = true;
			} else {
			$customers_cpf_error = false;
			}
			/*
			if (strlen($customers_rg) < ENTRY_STREET_RG_MIN_LENGTH) {
			$error = true;
			$customers_rg_error = true;
			} else {
			$customers_rg_error = false;
			}
			*/
		}
		

        if (strlen($entry_postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
          $error = true;
          $entry_post_code_error = true;
        } else {
          $entry_post_code_error = false;
        }

        if (strlen($entry_city) < ENTRY_CITY_MIN_LENGTH) {
          $error = true;
          $entry_city_error = true;
        } else {
          $entry_city_error = false;
        }

        if ($entry_country_id == false) {
          $error = true;
          $entry_country_error = true;
        } else {
          $entry_country_error = false;
        }

        if (ACCOUNT_STATE == 'true') {
          if ($entry_country_error == true) {
            $entry_state_error = true;
          } else {
            $zone_id = 0;
            $entry_state_error = false;
            $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$entry_country_id . "'");
            $check_value = tep_db_fetch_array($check_query);
            $entry_state_has_zones = ($check_value['total'] > 0);
            if ($entry_state_has_zones == true) {
              $zone_query = tep_db_query("select zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$entry_country_id . "' and zone_name = '" . tep_db_input($entry_state) . "'");
              if (tep_db_num_rows($zone_query) == 1) {
                $zone_values = tep_db_fetch_array($zone_query);
                $entry_zone_id = $zone_values['zone_id'];
              } else {
                $error = true;
                $entry_state_error = true;
              }
            } else {
              if ($entry_state == false) {
                $error = true;
                $entry_state_error = true;
              }
            }
         }
      }

      if (strlen($customers_telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
        $error = true;
        $entry_telephone_error = true;
      } else {
        $entry_telephone_error = false;
      }

      $check_email = tep_db_query("select customers_email_address from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($customers_email_address) . "' and customers_id != '" . (int)$customers_id . "'");
      if (tep_db_num_rows($check_email)) {
        $error = true;
        $entry_email_address_exists = true;
      } else {
        $entry_email_address_exists = false;
      }

      if ($error == false) {


        $sql_data_array = array('customers_firstname' => $customers_firstname,
                                'customers_lastname' => $customers_lastname,
								'customers_cpf' => tep_removecaracters($customers_cpf),
								'customers_rg' => tep_removecaracters($customers_rg),
                                'customers_email_address' => $customers_email_address,
                                'customers_telephone' => tep_removecaracters($customers_telephone),
								'customers_telephone_comercial' => tep_removecaracters($customers_telephone_comercial),
								'customers_telephone_celular' => tep_removecaracters($customers_telephone_celular),
                                'customers_fax' => tep_removecaracters($customers_fax),
                                'customers_newsletter' => $customers_newsletter,
								'customers_revendedor' => $customers_revendedor,
								'customers_modified' => '1');
    
        if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $customers_gender;
		if (ACCOUNT_PARTNER == 'true') $sql_data_array['customers_partner'] = $partner;
        if ((ACCOUNT_DOB == 'true') && ($_POST['c']=='F')) $sql_data_array['customers_dob'] = $data_certa;

			tep_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$customers_id . "'");
			tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_account_last_modified = now() where customers_info_id = '" . (int)$customers_id . "'");

        if ($entry_zone_id > 0) $entry_state = '';

         $sql_data_array = array('entry_firstname' => $customers_firstname,
                                'entry_lastname' => $customers_lastname,
                                'entry_street_address' => $entry_street_address,
								'entry_street_number'  => $entry_street_number,
                                'entry_postcode' => tep_removecaracters($entry_postcode),
                                'entry_city' => $entry_city,
                                'entry_country_id' => $entry_country_id);

        if ((ACCOUNT_COMPANY == 'true')||($type_is['customers_type_register']== 'J')) $sql_data_array['entry_company'] = $entry_company;
        if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $entry_suburb;
		$sql_data_array['entry_complemento'] = $entry_complemento;

        if (ACCOUNT_STATE == 'true') {
          if ($entry_zone_id > 0) {
            $sql_data_array['entry_zone_id'] = $entry_zone_id;
            $sql_data_array['entry_state'] = '';
          } else {
            $sql_data_array['entry_zone_id'] = '0';
            $sql_data_array['entry_state'] = $entry_state;
          }
        }

			tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "customers_id = '" . (int)$customers_id . "' and address_book_id = '" . (int)$default_address_id . "'");
			
		   if($customers_revendedor == 1 and $type_is['customers_sended_mail_revenda']==0){	  
		    $sql_data_array = array('customers_sended_mail_revenda' => 1);
		    tep_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$customers_id . "'");
		   	$html =  EMAIL_TEXT;
   		   	tep_sendMail($customers_email_address, EMAIL_TEXT_SUBJECT, $html, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
		   }
			
			tep_redirect(tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $customers_id));
        } else if ($error == true) {
          $cInfo = new objectInfo($_POST);
          $processed = true;
        }

        break;
      case 'deleteconfirm':
        $customers_id = tep_db_prepare_input($_GET['cID']);

        if (isset($_POST['delete_reviews']) && ($_POST['delete_reviews'] == 'on')) {
          $reviews_query = tep_db_query("select reviews_id from " . TABLE_REVIEWS . " where customers_id = '" . (int)$customers_id . "'");
          while ($reviews = tep_db_fetch_array($reviews_query)) {
            tep_db_query("delete from " . TABLE_REVIEWS_DESCRIPTION . " where reviews_id = '" . (int)$reviews['reviews_id'] . "'");
          }

          tep_db_query("delete from " . TABLE_REVIEWS . " where customers_id = '" . (int)$customers_id . "'");
        } else {
          tep_db_query("update " . TABLE_REVIEWS . " set customers_id = null where customers_id = '" . (int)$customers_id . "'");
        }

        tep_db_query("delete from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customers_id . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customers_id . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customers_id . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customers_id . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customers_id . "'");
        tep_db_query("delete from " . TABLE_WHOS_ONLINE . " where customer_id = '" . (int)$customers_id . "'");
        tep_db_query("delete from " . TABLE_MONITOR_PAGE . " where customer_id = '" . (int)$customers_id . "'");

        tep_redirect(tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('cID', 'action'))));
        break;
      default:
        $customers_query = tep_db_query("select c.customers_id, c.customers_gender, c.customers_partner, c.customers_firstname, c.customers_lastname, c.customers_cpf, c.customers_rg, c.customers_dob, c.customers_email_address, c.customers_revendedor, a.entry_company, a.entry_complemento, a.entry_street_address, a.entry_street_number, a.entry_suburb, a.entry_postcode, a.entry_city, a.entry_state, a.entry_zone_id, a.entry_country_id, c.customers_telephone, c.customers_telephone_comercial, c.customers_telephone_celular, c.customers_fax, c.customers_newsletter, c.customers_default_address_id from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a on c.customers_default_address_id = a.address_book_id where a.customers_id = c.customers_id and c.customers_id = '" . (int)$HTTP_GET_VARS['cID'] . "'");
        $customers = tep_db_fetch_array($customers_query);
        $cInfo = new objectInfo($customers);
    }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<?php
  if ($action == 'edit' || $action == 'update') {
?>
<script language="javascript"><!--
function check_form() {
  var error = 0;
  var error_message = "<?php echo JS_ERROR; ?>";

  var customers_firstname = document.customers.customers_firstname.value;
  var customers_lastname = document.customers.customers_lastname.value;
<?php if ((ACCOUNT_COMPANY == 'true')||($type_is['customers_type_register']== 'J')) echo 'var entry_company = document.customers.entry_company.value;' . "\n"; ?>
<?php if ((ACCOUNT_DOB == 'true')&&($type_is['customers_type_register']== 'F')) echo 'var customers_dob = document.customers.customers_dob.value;' . "\n"; ?>
  var entry_complemento = document.customers.entry_complemento.value;
  var customers_email_address = document.customers.customers_email_address.value;
  var entry_street_address = document.customers.entry_street_address.value;
  var entry_street_number = document.customers.entry_street_number.value;
  var customers_cpf = document.customers.customers_cpf.value;
  var customers_rg = document.customers.customers_rg.value;
  var entry_postcode = document.customers.entry_postcode.value;
  var entry_city = document.customers.entry_city.value;
  var customers_telephone = document.customers.customers_telephone.value;

<?php if ((ACCOUNT_GENDER == 'true')&&($type_is['customers_type_register']== 'F')) { ?>
  if (document.customers.customers_gender[0].checked || document.customers.customers_gender[1].checked) {
  } else {
    error_message = error_message + "<?php echo JS_GENDER; ?>";
    error = 1;
  }
<?php } ?>

  
  <?php if($type_is['customers_type_register']== 'F'){ ?>
  
	  if (customers_firstname == "" || customers_firstname.length < <?php echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>) {
		error_message = error_message + "<?php echo JS_FIRST_NAME; ?>";
		error = 1;
	  }
	
	  if (customers_lastname == "" || customers_lastname.length < <?php echo ENTRY_LAST_NAME_MIN_LENGTH; ?>) {
		error_message = error_message + "<?php echo JS_LAST_NAME; ?>";
		error = 1;
	  }
	  
	  if (customers_cpf == "" || customers_cpf.length < <?php echo ENTRY_STREET_CPF_MIN_LENGTH; ?>) {
		error_message = error_message + "<?php echo JS_CPF; ?>";
		error = 1;
	  }
	  
	  if (customers_rg == "" || customers_rg.length < <?php echo ENTRY_STREET_RG_MIN_LENGTH; ?>) {
		error_message = error_message + "<?php echo JS_RG; ?>";
		error = 1;
	  }
  
  <? }else if($type_is['customers_type_register']== 'J'){?>
  
	  if (customers_firstname == "" || customers_firstname.length < <?php echo ENTRY_RAZAO_SOCIAL_MIN_LENGTH; ?>) {
		error_message = error_message + "<?php echo JS_RAZAO_SOCIAL; ?>";
		error = 1;
	  }
	
	  if (customers_lastname == "" || customers_lastname.length < <?php echo ENTRY_NOME_FANTASIA_MIN_LENGTH; ?>) {
		error_message = error_message + "<?php echo JS_NOME_FANTASIA; ?>";
		error = 1;
	  }
	  
	  if (customers_cpf == "" || customers_cpf.length < <?php echo ENTRY_CNPJ_MIN_LENGTH; ?>) {
		error_message = error_message + "<?php echo JS_CNPJ; ?>";
		error = 1;
	  }
	  
	/*  if (customers_rg == "" || customers_rg.length < <?php echo ENTRY_INSCRICAO_ESTADUAL_MIN_LENGTH; ?>) {
		error_message = error_message + "<?php echo JS_INSCRICAO_ESTADUAL; ?>";
		error = 1;
	  } */
	  
	  if (entry_company == "" || entry_company.length < <?php echo ENTRY_RESPONSAVEL_MIN_LENGTH; ?>) {
		error_message = error_message + "<?php echo JS_RESPONSAVEL; ?>";
		error = 1;
	  }
  
  <? } ?>
  

<?php if ((ACCOUNT_DOB == 'true')&&($type_is['customers_type_register']== 'F')) { ?>
  if (customers_dob == "" || customers_dob.length < <?php echo ENTRY_DOB_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_DOB; ?>";
    error = 1;
  }
<?php } ?>

  if (customers_email_address == "" || customers_email_address.length < <?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_EMAIL_ADDRESS; ?>";
    error = 1;
  }

  if (entry_street_address == "" || entry_street_address.length < <?php echo ENTRY_STREET_ADDRESS_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_ADDRESS; ?>";
    error = 1;
  }
  
  if (entry_street_number == "" || entry_street_number.length < <?php echo ENTRY_STREET_NUMBER_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_ADDRESS; ?>";
    error = 1;
  }
  
  
  if (entry_postcode == "" || entry_postcode.length < <?php echo ENTRY_POSTCODE_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_POST_CODE; ?>";
    error = 1;
  }

  if (entry_city == "" || entry_city.length < <?php echo ENTRY_CITY_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_CITY; ?>";
    error = 1;
  }

<?php
  if (ACCOUNT_STATE == 'true') {
?>
  if (document.customers.elements['entry_state'].type != "hidden") {
    if (document.customers.entry_state.value == '' || document.customers.entry_state.value.length < <?php echo ENTRY_STATE_MIN_LENGTH; ?> ) {
       error_message = error_message + "<?php echo JS_STATE; ?>";
       error = 1;
    }
  }
<?php
  }
?>

  if (document.customers.elements['entry_country_id'].type != "hidden") {
    if (document.customers.entry_country_id.value == 0) {
      error_message = error_message + "<?php echo JS_COUNTRY; ?>";
      error = 1;
    }
  }

  if (customers_telephone == "" || customers_telephone.length < <?php echo ENTRY_TELEPHONE_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_TELEPHONE; ?>";
    error = 1;
  }

  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}
//--></script>
<?php
  }
?>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="SetFocus();">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top" id="main"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if ($action == 'edit' || $action == 'update') {
    $newsletter_array = array(array('id' => '1', 'text' => ENTRY_NEWSLETTER_YES),
                              array('id' => '0', 'text' => ENTRY_NEWSLETTER_NO));
							  
	$user_revenda = array(array('id' => '1', 'text' => ENTRY_USER_RVENDEDOR_YES),
                              array('id' => '0', 'text' => ENTRY_USER_RVENDEDOR_NO));						  
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table>
		</td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr><?php echo tep_draw_form('customers', FILENAME_CUSTOMERS, tep_get_all_get_params(array('action')) . 'action=update', 'post', 'onSubmit="return check_form();"') . tep_draw_hidden_field('default_address_id', $cInfo->customers_default_address_id); ?>
        <td class="formAreaTitle"><?php echo CATEGORY_PERSONAL; ?></td>
      </tr>
      <tr>
        <td class="formArea">
		
		<?php if($type_is['customers_type_register']== 'F'){?>
			<table border="0" cellspacing="2" cellpadding="2">
<?php
    if (ACCOUNT_GENDER == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_GENDER; ?></td>
            <td class="main">
<?php
    if ($error == true) {
      if ($entry_gender_error == true) {
        echo tep_draw_radio_field('customers_gender', 'm', false, $cInfo->customers_gender) . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('customers_gender', 'f', false, $cInfo->customers_gender) . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . ENTRY_GENDER_ERROR;
      } else {
        echo ($cInfo->customers_gender == 'm') ? MALE : FEMALE;
        echo tep_draw_hidden_field('customers_gender');
      }
    } else {
      echo tep_draw_radio_field('customers_gender', 'm', false, $cInfo->customers_gender) . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('customers_gender', 'f', false, $cInfo->customers_gender) . '&nbsp;&nbsp;' . FEMALE;
    }
?></td>
          </tr>
<?php
    }
?>
          <tr>
            <td class="main"><?php echo ENTRY_FIRST_NAME; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_firstname_error == true) {
      echo tep_draw_input_field('customers_firstname', $cInfo->customers_firstname, 'maxlength="32" size="40"') . '&nbsp;' . ENTRY_FIRST_NAME_ERROR;
    } else {
      echo $cInfo->customers_firstname . tep_draw_hidden_field('customers_firstname');
    }
  } else {
    echo tep_draw_input_field('customers_firstname', $cInfo->customers_firstname, 'maxlength="32" size="40"', true);
  }
?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_LAST_NAME; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_lastname_error == true) {
      echo tep_draw_input_field('customers_lastname', $cInfo->customers_lastname, 'maxlength="32" size="40"') . '&nbsp;' . ENTRY_LAST_NAME_ERROR;
    } else {
      echo $cInfo->customers_lastname . tep_draw_hidden_field('customers_lastname');
    }
  } else {
    echo tep_draw_input_field('customers_lastname', $cInfo->customers_lastname, 'maxlength="32" size="40"', true);
  }
?></td>
	</tr>
	<tr>
		<td class="main"><?php echo ENTRY_CPF; ?></td>
		<td class="main">
			<?php
			if ($error == true) {
			if ($customers_cpf_error == true) {
			echo tep_draw_input_field('customers_cpf', $cInfo->customers_cpf, 'id="customers_cpf"') . '&nbsp;' . 
			
			ENTRY_STREET_CPF_ERROR;
			} else {
			echo $cInfo->customers_cpf . tep_draw_hidden_field('customers_cpf');
			}
			} else {
			echo tep_draw_input_field('customers_cpf', $cInfo->customers_cpf, 'id="customers_cpf"', true);
			}
			?>
		</td>
	</tr>
	<tr>
		<td class="main"><?php echo ENTRY_RG; ?></td>
		<td class="main">
			<?php
			if ($error == true) {
			if ($customers_rg_error == true) {
			echo tep_draw_input_field('customers_rg', $cInfo->customers_rg, 'maxlength="15"') . '&nbsp;' . 
			
			ENTRY_STREET_RG_ERROR;
			} else {
			echo $cInfo->customers_rg . tep_draw_hidden_field('customers_rg');
			}
			} else {
			echo tep_draw_input_field('customers_rg', $cInfo->customers_rg, 'maxlength="15"', true);
			}
			?>
		</td>
	</tr>

<?php
    if (ACCOUNT_DOB == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_DATE_OF_BIRTH; ?></td>
            <td class="main">

<?php
    if ($error == true) {
      if ($entry_date_of_birth_error == true) {
        echo tep_draw_input_field('customers_dob', tep_date_short($cInfo->customers_dob), 'id="customers_dob"') . '&nbsp;' . ENTRY_DATE_OF_BIRTH_ERROR;
      } else {
        echo $cInfo->customers_dob . tep_draw_hidden_field('customers_dob');
      }
    } else {
      echo tep_draw_input_field('customers_dob', tep_date_short($cInfo->customers_dob), 'id="customers_dob"', true);
    }
?></td>
          </tr>
<?php
    }
?>
          <tr>
            <td class="main"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_email_address_error == true) {
      echo tep_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96" size="40"') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_ERROR;
    } elseif ($entry_email_address_check_error == true) {
      echo tep_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96" size="40"') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_CHECK_ERROR;
    } elseif ($entry_email_address_exists == true) {
      echo tep_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96" size="40"') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_ERROR_EXISTS;
    } else {
      echo $customers_email_address . tep_draw_hidden_field('customers_email_address');
    }
  } else {
    echo tep_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96" size="40"', true);
  }
?></td>
          </tr>
          
          
          <?php if (ACCOUNT_PARTNER == 'true') { ?>
              <tr>
                <td class="main">Parceiro:</td>
                <td class="main">
                    <?php
                        
                            $partner_array = array();
                            $partner_query = tep_db_query("select banners_id, banners_title  from " . TABLE_PARTNERS . " order by banners_title");
                            $partner_array[] = array('id' => 0, 'text' => 'Nenhum');
                            while ($partner_values = tep_db_fetch_array($partner_query)) {
                              $partner_array[] = array('id' => $partner_values['banners_id'], 'text' => $partner_values['banners_title']);
                            }
                            echo tep_draw_pull_down_menu('customers_partner', $partner_array, $cInfo->customers_partner);
                    ?> 
                </td>
              </tr>
            <?php } ?>
            
            
            
            
          
          
        </table>
		<?php }else if($type_is['customers_type_register']== 'J'){?>
			<table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo ENTRY_RAZAO_SOCIAL; ?></td>
            <td class="main">
				<?php
				  if ($error == true) {
					if ($entry_firstname_error == true) {
					  echo tep_draw_input_field('customers_firstname', $cInfo->customers_firstname, 'size="40" maxlength="32"') . '&nbsp;' . ENTRY_RAZAO_SOCIAL_ERROR;
					} else {
					  echo $cInfo->customers_firstname . tep_draw_hidden_field('customers_firstname');
					}
				  } else {
					echo tep_draw_input_field('customers_firstname', $cInfo->customers_firstname, 'size="40" maxlength="32"', true);
				  }
				?>
			</td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_NOME_FANTASIA; ?></td>
            <td class="main">
				<?php
				  if ($error == true) {
					if ($entry_lastname_error == true) {
					  echo tep_draw_input_field('customers_lastname', $cInfo->customers_lastname, 'size="40" maxlength="32"') . '&nbsp;' . ENTRY_NOME_FANTASIA_ERROR;
					} else {
					  echo $cInfo->customers_lastname . tep_draw_hidden_field('customers_lastname');
					}
				  } else {
					echo tep_draw_input_field('customers_lastname', $cInfo->customers_lastname, 'size="40" maxlength="32"', true);
				  }
				?>
			</td>
		</tr>
		<tr>
			<td class="main"><?php echo ENTRY_CNPJ; ?></td>
			<td class="main">
				<?php
				if ($error == true) {
				if ($customers_cpf_error == true) {
				echo tep_draw_input_field('customers_cpf', $cInfo->customers_cpf, 'id="customers_cpf"') . '&nbsp;' . ENTRY_CNPJ_ERROR;
				} else {
				echo $cInfo->customers_cpf . tep_draw_hidden_field('customers_cpf');
				}
				} else {
				echo tep_draw_input_field('customers_cpf', $cInfo->customers_cpf, 'id="customers_cpf"', true);
				}
				?>
			</td>
		</tr>
		<tr>
			<td class="main"><?php echo ENTRY_INSCRICAO_ESTADUAL; ?></td>
			<td class="main">
				<?php
				if ($error == true) {
				if ($customers_rg_error == true) {
				echo tep_draw_input_field('customers_rg', $cInfo->customers_rg, 'id="customers_rg"') . '&nbsp;' . 
				
				ENTRY_INSCRICAO_ESTADUAL_ERROR;
				} else {
				echo $cInfo->customers_rg . tep_draw_hidden_field('customers_rg');
				}
				} else {
				echo tep_draw_input_field('customers_rg', $cInfo->customers_rg, 'id="customers_rg"', false);
				}
				?>
			</td>
		</tr>
          <tr>
            <td class="main"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
            <td class="main">
				<?php
				  if ($error == true) {
					if ($entry_email_address_error == true) {
					  echo tep_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96" size="40"') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_ERROR;
					} elseif ($entry_email_address_check_error == true) {
					  echo tep_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96" size="40"') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_CHECK_ERROR;
					} elseif ($entry_email_address_exists == true) {
					  echo tep_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96" size="40"') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_ERROR_EXISTS;
					} else {
					  echo $customers_email_address . tep_draw_hidden_field('customers_email_address');
					}
				  } else {
					echo tep_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96" size="40"', true);
				  }
				?>
			</td>
          </tr>
		  <tr>
            <td class="main"><?php echo ENTRY_RESPONSAVEL; ?></td>
            <td class="main">
				<?php
					if ($error == true) {
					  if ($entry_company_error == true) {
						echo tep_draw_input_field('entry_company', $cInfo->entry_company, 'maxlength="32" size="40"') . '&nbsp;' . ENTRY_RESPONSAVEL_ERROR;
					  } else {
						echo $cInfo->entry_company . tep_draw_hidden_field('entry_company');
					  }
					} else {
					  echo tep_draw_input_field('entry_company', $cInfo->entry_company, 'maxlength="32" size="40"', true);
					}
				?>
			</td>
          </tr>
        </table>
		<?php }?>
		
		</td>
      </tr>
<?php
    if ((ACCOUNT_COMPANY == 'true')&&($type_is['customers_type_register']== 'F')) {
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="formAreaTitle"><?php echo CATEGORY_COMPANY; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo ENTRY_COMPANY; ?></td>
            <td class="main">
<?php
    if ($error == true) {
      if ($entry_company_error == true) {
        echo tep_draw_input_field('entry_company', $cInfo->entry_company, 'maxlength="32" size="40"') . '&nbsp;' . ENTRY_COMPANY_ERROR;
      } else {
        echo $cInfo->entry_company . tep_draw_hidden_field('entry_company');
      }
    } else {
      echo tep_draw_input_field('entry_company', $cInfo->entry_company, 'maxlength="32" size="40"');
    }
?></td>
          </tr>
        </table></td>
      </tr>
<?php
    }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="formAreaTitle"><?php echo CATEGORY_ADDRESS; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo ENTRY_STREET_ADDRESS; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_street_address_error == true) {
      echo tep_draw_input_field('entry_street_address', $cInfo->entry_street_address, 'maxlength="64" size="40"') . '&nbsp;' . ENTRY_STREET_ADDRESS_ERROR;
    } else {
      echo $cInfo->entry_street_address . tep_draw_hidden_field('entry_street_address');
    }
  } else {
    echo tep_draw_input_field('entry_street_address', $cInfo->entry_street_address, 'maxlength="64" size="40"', true);
  }
?></td>
          </tr>
		  
<tr>
            <td class="main"><?php echo ENTRY_STREET_NUMBER; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_street_number_error == true) {
      echo tep_draw_input_field('entry_street_number', $cInfo->entry_street_number, 'maxlength="64" size="40"') . '&nbsp;' . ENTRY_STREET_NUMBER_ERROR;
    } else {
      echo $cInfo->entry_street_number . tep_draw_hidden_field('entry_street_number');
    }
  } else {
    echo tep_draw_input_field('entry_street_number', $cInfo->entry_street_number, 'maxlength="64" size="40"', true);
  }
?></td>
          </tr>		  
<?php
    if (ACCOUNT_SUBURB == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_SUBURB; ?></td>
            <td class="main">
<?php
    if ($error == true) {
      if ($entry_suburb_error == true) {
        echo tep_draw_input_field('suburb', $cInfo->entry_suburb, 'maxlength="32" size="40"') . '&nbsp;' . ENTRY_SUBURB_ERROR;
      } else {
        echo $cInfo->entry_suburb . tep_draw_hidden_field('entry_suburb');
      }
    } else {
      echo tep_draw_input_field('entry_suburb', $cInfo->entry_suburb, 'maxlength="32" size="40"');
    }
?></td>
          </tr>
<?php
    }
?>

          <tr>
            <td class="main"><?php echo ENTRY_COMPLEMENTO; ?></td>
            <td class="main">
<?php
    if ($error == true) {
      if ($entry_complemento_error == true) {
        echo tep_draw_input_field('complemento', $cInfo->entry_complemento, 'maxlength="32" size="40"') . '&nbsp;' . ENTRY_COMPLEMENTO_ERROR;
      } else {
        echo $cInfo->entry_complemento . tep_draw_hidden_field('entry_complemento');
      }
    } else {
      echo tep_draw_input_field('entry_complemento', $cInfo->entry_complemento, 'maxlength="32" size="40"');
    }
?></td>
          </tr>

          <tr>
            <td class="main"><?php echo ENTRY_POST_CODE; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_post_code_error == true) {
      echo tep_draw_input_field('entry_postcode', $cInfo->entry_postcode, 'id="entry_postcode"') . '&nbsp;' . ENTRY_POST_CODE_ERROR;
    } else {
      echo $cInfo->entry_postcode . tep_draw_hidden_field('entry_postcode');
    }
  } else {
    echo tep_draw_input_field('entry_postcode', $cInfo->entry_postcode, 'id="entry_postcode"', true);
  }
?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_CITY; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_city_error == true) {
      echo tep_draw_input_field('entry_city', $cInfo->entry_city, 'maxlength="32"') . '&nbsp;' . ENTRY_CITY_ERROR;
    } else {
      echo $cInfo->entry_city . tep_draw_hidden_field('entry_city');
    }
  } else {
    echo tep_draw_input_field('entry_city', $cInfo->entry_city, 'maxlength="32"', true);
  }
?></td>
          </tr>
<?php
    if (ACCOUNT_STATE == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_STATE; ?></td>
            <td class="main">
<?php
    $entry_state = tep_get_zone_name($cInfo->entry_country_id, $cInfo->entry_zone_id, $cInfo->entry_state);
    if ($error == true) {
      if ($entry_state_error == true) {
        if ($entry_state_has_zones == true) {
          $zones_array = array();
          $zones_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . tep_db_input($cInfo->entry_country_id) . "' order by zone_name");
          while ($zones_values = tep_db_fetch_array($zones_query)) {
            $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
          }
          echo tep_draw_pull_down_menu('entry_state', $zones_array) . '&nbsp;' . ENTRY_STATE_ERROR;
        } else {
          echo tep_draw_input_field('entry_state', tep_get_zone_name($cInfo->entry_country_id, $cInfo->entry_zone_id, $cInfo->entry_state)) . '&nbsp;' . ENTRY_STATE_ERROR;
        }
      } else {
        echo $entry_state . tep_draw_hidden_field('entry_zone_id') . tep_draw_hidden_field('entry_state');
      }
    } else {
      echo tep_draw_input_field('entry_state', tep_get_zone_name($cInfo->entry_country_id, $cInfo->entry_zone_id, $cInfo->entry_state));
    }

?></td>
         </tr>
<?php
    }
?>
          <tr>
            <td class="main"><?php echo ENTRY_COUNTRY; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_country_error == true) {
      echo tep_draw_pull_down_menu('entry_country_id', tep_get_countries(), $cInfo->entry_country_id) . '&nbsp;' . ENTRY_COUNTRY_ERROR;
    } else {
      echo tep_get_country_name($cInfo->entry_country_id) . tep_draw_hidden_field('entry_country_id');
    }
  } else {
    echo tep_draw_pull_down_menu('entry_country_id', tep_get_countries(), $cInfo->entry_country_id);
  }
?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="formAreaTitle"><?php echo CATEGORY_CONTACT; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo ENTRY_TELEPHONE_NUMBER; ?></td>
            <td class="main">
				<?php
				  if ($error == true) {
					if ($entry_telephone_error == true) {
					  echo tep_draw_input_field('customers_telephone', $cInfo->customers_telephone, 'id="customers_telephone"') . '&nbsp;' . ENTRY_TELEPHONE_NUMBER_ERROR;
					} else {
					  echo $cInfo->customers_telephone . tep_draw_hidden_field('customers_telephone');
					}
				  } else {
					echo tep_draw_input_field('customers_telephone', $cInfo->customers_telephone, 'id="customers_telephone"', true);
				  }
				?>
			</td>
          </tr>
		  <tr>
            <td class="main"><?php echo ENTRY_TELEPHONE_COMERCIAL_NUMBER; ?></td>
            <td class="main">
				<?php
				  if ($processed == true) {
					echo $cInfo->customers_telephone_comercial . tep_draw_hidden_field('customers_telephone_comercial');
				  } else {
					echo tep_draw_input_field('customers_telephone_comercial', $cInfo->customers_telephone_comercial, 'id="customers_telephone_comercial"');
				  }
				?>
			</td>
          </tr>
		  <tr>
            <td class="main"><?php echo ENTRY_TELEPHONE_CELULAR_NUMBER; ?></td>
            <td class="main">
				<?php
				  if ($processed == true) {
					echo $cInfo->customers_telephone_celular . tep_draw_hidden_field('customers_telephone_celular');
				  } else {
					echo tep_draw_input_field('customers_telephone_celular', $cInfo->customers_telephone_celular, 'id="customers_telephone_celular"');
				  }
				?>
			</td>
          </tr>
		  
          <tr>
            <td class="main"><?php echo ENTRY_FAX_NUMBER; ?></td>
            <td class="main">
<?php
  if ($processed == true) {
    echo $cInfo->customers_fax . tep_draw_hidden_field('customers_fax');
  } else {
    echo tep_draw_input_field('customers_fax', $cInfo->customers_fax, 'id="customers_fax"');
  }
?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="formAreaTitle"><?php echo CATEGORY_OPTIONS; ?></td>
      </tr>
      <tr>
        <td class="formArea">
			<table border="0" cellspacing="2" cellpadding="2">
			  <tr>
				<td class="main"><?php echo ENTRY_NEWSLETTER; ?></td>
				<td class="main">
					<?php
					  if ($processed == true) {
						if ($cInfo->customers_newsletter == '1') {
						  echo ENTRY_NEWSLETTER_YES;
						} else {
						  echo ENTRY_NEWSLETTER_NO;
						}
						echo tep_draw_hidden_field('customers_newsletter');
					  } else {
						echo tep_draw_pull_down_menu('customers_newsletter', $newsletter_array, (($cInfo->customers_newsletter == '1') ? '1' : '0'));
					  }
					?>
				 </td>
			  </tr>
        	</table>
			
			<table border="0" cellspacing="2" cellpadding="2">
			  <tr>
				<td class="main"><?php echo ENTRY_USER_RVENDEDOR; ?></td>
				<td class="main">
					<?php
					  if ($processed == true) {
						if ($cInfo->customers_revendedor == '1') {
						  echo ENTRY_USER_RVENDEDOR_YES;
						} else {
						  echo ENTRY_USER_RVENDEDOR_NO;
						}
						echo tep_draw_hidden_field('customers_revendedor');
					  } else {
						echo tep_draw_pull_down_menu('customers_revendedor', $user_revenda, (($cInfo->customers_revendedor == '1') ? '1' : '0'));
					  }
					?>
				 </td>
			  </tr>
        	</table>
		</td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td align="right" class="main"><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('action'))) .'">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr></form>
<?php
  } else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr><?php echo tep_draw_form('search', FILENAME_CUSTOMERS, '', 'get'); ?>
            <td class="pageHeading">&nbsp;<span class="titulo"><?php echo HEADING_TITLE; ?></span></td>
            <td class="smallText" align="right"><?php echo HEADING_TITLE_SEARCH . ' ' . tep_draw_input_field('search'); ?></td>
          </form></tr>
        </table></td>
      </tr>

<?php

if($action == 'confirm') {
	echo '<tr><td width="100%" align=center><div class="messageStackWarning" style="margin: 1em 0; padding: 5px;"><b><table cellspacing=0 cellpadding=3 border=0><tr><td background="../images/blink_red.gif"><font color="#FFFFFF">' . TEXT_INFO_HEADING_DELETE_CUSTOMER . ' <b> ' . $cInfo->customers_firstname . ' ' . $cInfo->customers_lastname.'</b></font></td></tr></table>'.
	''. TEXT_DELETE_CUSTOMER . '<br><a class="splitPageLink" href="' .
	tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=deleteconfirm') .
	'">' . TEXT_DELETE_ACCOUNT . '</a>&nbsp;/&nbsp;<a class="splitPageLink" href="' .
	tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('cID', 'action'))) .
	'">' . TEXT_DELETE_ACCOUNT_CANCEL . '</a></div></td></tr>';
}
/*
Function to print table headers based on current sort pattern
$name = Full name of header, usually defined in language files
$id = sort word used in URL
$current_dir = current sort direction (ASC or DESC)
*/
function print_sort( $name, $id, $default_sort ) {
	global $orderby, $sort;

	if( isset( $orderby ) && ( $orderby == $id ) ) {
		if( $sort == 'ASC' ) {
			$to_sort = 'DESC';
		} else {
			$to_sort = 'ASC';
		}
	} else {
		$to_sort = $default_sort;
	}
	$return = '<a href="' . tep_href_link(FILENAME_CUSTOMERS, 'orderby=' . $id . '&amp;sort='. $to_sort) .
	'" class="headerLink">' . $name . '</a>';
	if( $orderby == $id ) {
		$return .= '&nbsp;<img src="images/arrow_' . ( ( $to_sort == 'DESC' ) ? 'down' : 'up' ) .
		'.png" width="10" height="13" border="0" alt="" />';
	}
	return $return;
}
?>

<script>
//ie=document.all;
//ns=document.layers;
var agent = navigator.userAgent.toLowerCase();
//var major = parseInt(navigator.appVersion);
//var minor = parseFloat(navigator.appVersion);
var ns  = ((agent.indexOf('mozilla')!=-1) && ((agent.indexOf('spoofer')==-1) && (agent.indexOf('compatible') == -1)));
var ie   = (agent.indexOf("msie") != -1);
//var op3 = (agent.indexOf("opera") != -1);
//var mac = (navigator.appVersion.indexOf("Mac")!=-1);
//var chrome = (agent.indexOf("chrome") != -1);
if (ie) document.writeln('<div id="titulo" style="position:absolute; overflow: auto; width:350px; height:52px; z-index:1; background-color: #ffffe1; layer-background-color: #FFFFE1; border:1px solid #000000; padding-top: 1px; padding-right: 5px; padding-bottom: 1px; padding-left: 5px; visibility: hidden"></div>');
else document.writeln('<LAYER id="titulo" style="position:absolute; overflow: auto; width:350px; height:52px; z-index:1; background-color: #ffffe1; layer-background-color: #FFFFE1; border:1px solid #000000; padding-top: 1px; padding-right: 5px; padding-bottom: 1px; padding-left: 5px; visibility: hidden"></LAYER>');

function cursortogether(e) {
  obj=document.getElementById('titulo');
  if (ie) {
	var mouseX = (event.clientX + document.body.scrollLeft)-135;
	var mouseY = (event.clientY + document.body.scrollTop)-2;
  } else  {
	var mouseX = e.pageX-135;
	var mouseY = e.pageY+1;
  }
  largura = parseFloat(obj.style.width);
  maximo = ((document.all)?(document.body.clientWidth-largura) : ((window.innerWidth-28)-largura) );
  if (mouseX < maximo) obj.style.left = mouseX;
  obj.style.top  = mouseY+18;
}
function alttext( texto ) {
 if (document.layers) { 
   var oLayer; 
   oLayer = document.layers['titulo'].document; 
   oLayer.open(); 
   oLayer.write(texto); 
   oLayer.close();
   oLayer.visibility="show";
 } 
 else if (parseInt(navigator.appVersion)>=5&&navigator.appName=="Netscape") { 
   document.getElementById('titulo').innerHTML = texto; 
   document.getElementById('titulo').style.visibility="visible"; 
 } 
 else if (document.all) {
	document.all['titulo'].innerHTML = texto;
	document.all['titulo'].style.visibility="visible";
  }
//document.onmousemove=cursortogether;
}


function alttextoff() {
 if (document.layers) { 
   var oLayer; 
   oLayer = document.layers['titulo'].document; 
   oLayer.style.visibility="hide";   
   document.getElementById('titulo').style.visibility="hide"; 
 } 
 else if (parseInt(navigator.appVersion)>=5&&navigator.appName=="Netscape") { // chrome & firefox
   document.getElementById('titulo').style.visibility="hidden"; 
 } 
 else if (document.all) {
 	document.all['titulo'].style.visibility="hidden";
  }
  else    document.getElementById('titulo').style.visibility="hide"; 
  
 document.onmousemove=null;

}


</script>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="1" onMouseOver="javascript:document.onmousemove=cursortogether;" onMouseOut="alttextoff()">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_ACTIONS; ?></td>
<!--
                <td class="dataTableHeadingContent" nowrap><?php echo print_sort(TABLE_HEADING_LASTNAME, 'lastname', 'ASC'); ?></td>
                <td class="dataTableHeadingContent" nowrap><?php echo print_sort(TABLE_HEADING_FIRSTNAME, 'firstname', 'ASC'); ?></td>
-->
                <td class="dataTableHeadingContent" nowrap><?php echo print_sort(TABLE_HEADING_FIRSTNAME, 'firstname', 'ASC'); ?></td>

				<?php if (ACCOUNT_COMPANY == 'true') { ?>
                <td class="dataTableHeadingContent" align="left"><?php echo print_sort('Empresa', 'entry_company', 'ASC'); ?></td>
				<?php } ?>

<!--
                <td class="dataTableHeadingContent" align="center"><?php echo print_sort(TABLE_HEADING_ACCOUNT_CREATED, 'date_created', 'DESC'); ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo print_sort('Últ. log', 'date_login', 'DESC'); ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo print_sort('Logs', 'num_logins', 'DESC'); ?></td>
-->
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_TELEPHONE; ?></td>
                <!--<td class="dataTableHeadingContent" align="center"><?php echo print_sort(TABLE_HEADING_DOB, 'dob', 'ASC'); ?></td> -->
                <td class="dataTableHeadingContent" align="left"><?php echo print_sort(TABLE_HEADING_LOCATION, 'state', 'ASC'); ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo print_sort(TABLE_HEADING_ACCOUNT_CREATED, 'date_created', 'DESC'); ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo print_sort(TABLE_HEADING_NEWSLETTER, 'newsletter', 'ASC'); ?></td>
                <!-- <td class="dataTableHeadingContent" align="left"><?php echo print_sort("Atendente", 'atendente', 'ASC'); ?></td> -->
                <td class="dataTableHeadingContent" align="center"><?php echo "Últ. Hist."; ?></td>
              </tr>
<?php

$search = '';

// Setup column sorting
if($orderby == 'lastname') {
	$db_orderby = 'c.customers_lastname ' . $sort . ', c.customers_firstname';
} elseif($orderby == 'firstname') {
	$db_orderby = 'c.customers_firstname ' . $sort . ', c.customers_lastname';
	
	
} elseif($orderby == 'entry_company') {
	$db_orderby = 'a.entry_company ' . $sort . ', c.customers_firstname';
} elseif($orderby == 'atendente') {
	$db_orderby = 'c.customers_atendente ' . $sort . ', c.customers_firstname';

	
} elseif($orderby == 'date_created') {
	$db_orderby = 'date_account_created ' . $sort . ', c.customers_firstname';
} elseif($orderby == 'date_login') {
	$db_orderby = 'last_logon ' . $sort . ', c.customers_firstname';
} elseif($orderby == 'num_logins') {
	$db_orderby = 'num_logons ' . $sort . ', c.customers_firstname';
} elseif($orderby == 'dob') {
	$db_orderby = 'customers_dob ' . $sort . ', c.customers_firstname';
} elseif($orderby == 'state') {
	$db_orderby = 'country ' . $sort . ', state ' . $sort . ', city ' . $sort . ', c.customers_firstname';
//DL BEGIN
} elseif($orderby == 'newsletter') {
//	$db_orderby = 'c.customers_newsletter ASC, date_account_created';	
	$db_orderby = 'customers_newsletter ';	
//} elseif($orderby == 'historico') {
//	$db_orderby = 'mp.monitor_date ';	
} else {
	$db_orderby = 'c.customers_newsletter ' . $sort . ', date_account_created';
}
//DL END
if(!$sort) $sort = 'ASC';

    if (isset($_GET['search']) && tep_not_null($_GET['search'])) {
      $keywords = tep_db_input(tep_db_prepare_input($_GET['search']));
      //$search = "where lower(c.customers_lastname) like '%" . strtolower($keywords) . "%' or lower(c.customers_firstname) like '%" . strtolower($keywords) . "%' or c.customers_email_address like '%" . $keywords . "%' or LOWER(c.customers_obs) like '%".strtolower($keywords)."%'";
      $search = "where lower(c.customers_lastname) like '%" . strtolower($keywords) . "%' or 
	  lower(c.customers_firstname) like '%" . strtolower($keywords) . "%' or 
	  c.customers_email_address like '%" . $keywords . "%' or
	  lower(a.entry_company) like '%".strtolower($keywords)."%' ";
    }
	//DL BEGIN - Fix from 1.4.2 package
 $customers_query_raw = "select c.customers_id, c.customers_lastname, c.customers_firstname, c.customers_email_address, c.customers_telephone, c.customers_dob, ci.customers_info_date_of_last_logon as last_logon, ci.customers_info_number_of_logons as num_logons, ci.customers_info_date_account_created as date_account_created, a.entry_city as city, a.entry_state as state_alt, z.zone_name as state, ctry.countries_iso_code_2 as country, c.customers_newsletter, a.entry_country_id, a.entry_company from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a on c.customers_id = a.customers_id and c.customers_default_address_id = a.address_book_id left join " . TABLE_CUSTOMERS_INFO . " ci on c.customers_id = ci.customers_info_id left join " . TABLE_COUNTRIES . " ctry on a.entry_country_id = ctry.countries_id left join " . TABLE_ZONES . " z on a.entry_zone_id = z.zone_id " . $search . " order by " . $db_orderby . " " . $sort; 
/* 
 $customers_query_raw = "select distinct(c.customers_id), c.customers_atendente, c.customers_lastname, c.customers_firstname, c.customers_email_address, c.customers_telephone, c.customers_celular, c.customers_dob, ci.customers_info_date_of_last_logon as last_logon, ci.customers_info_number_of_logons as num_logons, ci.customers_info_date_account_created as date_account_created, a.entry_city as city, a.entry_state as state_alt, z.zone_name as state, ctry.countries_iso_code_2 as country, c.customers_newsletter, a.entry_country_id, a.entry_company, mp.monitor_date
 from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a on c.customers_id = a.customers_id and c.customers_default_address_id = a.address_book_id left join " . TABLE_CUSTOMERS_INFO . " ci on c.customers_id = ci.customers_info_id left join " . TABLE_COUNTRIES . " ctry on a.entry_country_id = ctry.countries_id left join " . TABLE_ZONES . " z on a.entry_zone_id = z.zone_id 
 left join monitor_page mp on c.customers_id = mp.customer_id
 group by c.customers_id
 " . $search . " order by " . $db_orderby . " " . $sort; 
 echo $customers_query_raw; 
 */
    $customers_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $customers_query_raw, $customers_query_numrows);
    $customers_query = tep_db_query($customers_query_raw);
    while ($customers = tep_db_fetch_array($customers_query)) {
	//DL END
      $info_query = tep_db_query("select customers_info_date_account_created as date_account_created, customers_info_date_account_last_modified as date_account_last_modified, customers_info_date_of_last_logon as date_last_logon, customers_info_number_of_logons as number_of_logons from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . $customers['customers_id'] . "'");
      $info = tep_db_fetch_array($info_query);

      if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $customers['customers_id']))) && !isset($cInfo)) {
        $country_query = tep_db_query("select countries_name from " . TABLE_COUNTRIES . " where countries_id = '" . (int)$customers['entry_country_id'] . "'");
        $country = tep_db_fetch_array($country_query);

        $reviews_query = tep_db_query("select count(*) as number_of_reviews from " . TABLE_REVIEWS . " where customers_id = '" . (int)$customers['customers_id'] . "'");
        $reviews = tep_db_fetch_array($reviews_query);

        $customer_info = array_merge($country, $info, $reviews);

        $cInfo_array = array_merge($customers, $customer_info);
        $cInfo = new objectInfo($cInfo_array);
      }

$titulo = "e-mail: ".$customers['customers_email_address'].
		  //" - Conta criada em: ".tep_date_short($customers['date_account_created']).
          (tep_not_null(tep_date_short($info['date_last_logon']))?"<br>Último login: ".tep_date_short($info['date_last_logon']):"" ).
		  (($info['number_of_logons']>0)?" - Logs: ".number_format($info['number_of_logons'],0):""  ).
		  (tep_not_null($customers['customers_identificadores'])?"<br>Identificadores: ".$customers['customers_identificadores']:""  ).
		  (tep_not_null($customers['customers_atendente'])?"<br>Atendente: ".$customers['customers_atendente']:""  )
		  
		  ;
	  
?>
	<tr class="dataTableRow" onMouseOver="rowOverEffect(this);alttext('<?php echo $titulo; ?>')" onMouseOut="rowOutEffect(this)">
	<td nowrap class="dataTableContent" width="1%"><?php echo
	'<a href="' . tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('cID', 'action')) .
	'cID=' . $customers['customers_id'] . '&action=edit') . '">' . tep_image(DIR_WS_IMAGES . 'edit.gif', IMAGE_EDIT) . '</a>&nbsp;<a href="' .
	tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('cID', 'action')) .
	'cID=' . $customers['customers_id'] . '&action=confirm') . '">' . tep_image(DIR_WS_IMAGES . 'delete.gif', IMAGE_DELETE) . '</a>';

		$quant_query_raw = "select count(*) from " . TABLE_ORDERS . " o where o.customers_id = '" . $customers['customers_id'] . "'";
//echo $orders_query_raw;
        //$orders_query_raw = "select count(*) from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and ot.class = 'ot_total' order by o.orders_id DESC";

		$quant_query = tep_db_query($quant_query_raw);
		$quant = tep_db_fetch_array($quant_query);
		//echo "***".$orders['count(*)'];
		if ($quant['count(*)']>0) {
			echo '&nbsp;<a href="' . tep_href_link(FILENAME_ORDERS, 'cID=' . $customers['customers_id']) . '&backto=customers.php?search='.$keywords.'*page='.$_GET['page'].'">' . tep_image(DIR_WS_IMAGES . 'orders.gif', IMAGE_ORDERS) . '</a>';
		} else {
			echo '&nbsp;'.tep_image(DIR_WS_IMAGES .'pixel_trans.gif','Cliente não tem pedidos',16,16);
		}

	echo '&nbsp;<a href="' .
	tep_href_link(FILENAME_MAIL, 'selected_box=tools&customer=' . $customers['customers_email_address']) . '&backto=customers.php?search='.$keywords.'*page='.$_GET['page'].'">' . tep_image(DIR_WS_IMAGES . 'email_send.gif', IMAGE_EMAIL) . '</a>';

	// verifica se o cliente tem algum histórico...
	$quant_hist_raw = "select count(*) from " . TABLE_MONITOR_PAGE . " where customer_id = '" . $customers['customers_id'] . "'";
	$quant_hist_query = tep_db_query($quant_hist_raw);
	$quant_hist = tep_db_fetch_array($quant_hist_query);
	if ($quant_hist['count(*)']>0) {
		$imagem = "historico-yes.gif";
		$alt = "Este cliente tem registros no histórico";
	} else {
		$imagem = "historico-no.gif";
		$alt = "Cliente ainda sem histórico";
	}
	echo "&nbsp;<a href='monitor.php?customers=".$customers['customers_id']."&backto=customers.php?search=".$keywords."*page=".$_GET['page']."'>".tep_image(DIR_WS_IMAGES . $imagem, $alt)."</a>"; ?></td>

    <td class="dataTableContent"><?php echo $customers['customers_firstname'] . " " . $customers['customers_lastname']; ?></td>
	<?php if (ACCOUNT_COMPANY == 'true') { ?>
    <td class="dataTableContent"><?php echo $customers['entry_company']; ?></td>
	<?php } ?>			
    <td class="dataTableContent" nowrap><?php                     // Esse absurdo de programação é pra previnir a teimosia do Sr. Miranda
				                                                              // que teima insistentemente em cadastrar telefones assim: 00 0000-0000
																			  // ou até assim 41 0000-0000
					if ((tep_not_null($customers['customers_telephone'])) and (substr($customers['customers_telephone'],0,2!="00") and substr($customers['customers_telephone'],3,4!="0000") ) ) echo $customers['customers_telephone']; 
					$barra = '';
					if (tep_not_null($customers['customers_telephone']) and tep_not_null($customers['customers_celular']) ) $barra = '/';
					if (tep_not_null($customers['customers_celular'])) {
						echo $barra."<font color='#8d0000'>".$customers['customers_celular']."</font>";
					} ?></td>
    <!-- <td class="dataTableContent"><?php echo tep_date_short($customers['customers_dob']); ?></td> -->
		<td class="dataTableContent"><?php
		$localizacao = '';
		if ($customers['country']!="BR") $localizacao = ($customers['country'] ? $customers['country'] : '<font color="#808080">'.TEXT_NONE.'</font>') . ', ';
		
		//echo ($customers['country'] ? $customers['country'] : '<font color="#808080">'.TEXT_NONE.'</font>') . ', ';
		$estado = '??';
		if( isset($customers['state']) ) {
			//echo ucwords($customers['state']);
			$estado = $customers['state'];
		} else if( ! empty($customers['state_alt']) ) {
			//echo ucwords($customers['state_alt']);
			$estado = $customers['state_alt'];
		//} else {
			//echo '<font color="#808080">'.TEXT_NONE.'</font>';
		//	$estado = '<font color="#808080">'.TEXT_NONE.'</font>';
		}
		// verificar siglas do estado somente para estados brasileiros...
		if ($customers['country']=='BR') {
			$array_estados = array("??","Acre","Alagoas","Amapa","Amazonas","Bahia","Ceara","Distrito Federal","Espirito Santo","Goias","Maranhao","Mato Grosso","Mato Grosso do Sul","Minas Gerais","Para","Paraiba","Parana","Pernambuco","Piaui","Rio de Janeiro","Rio Grande do Norte","Rio Grande do Sul","Rondonia","Roraima","Santa Catarina","Sao Paulo","Sergipe","Tocantins");
			$array_ufs     = array("??","AC",  "AL",     "AP",   "AM",      "BA",   "CE",   "DF",              "ES",            "GO",   "MA",      "MT",         "MS",                "MG",          "PA",  "PB",     "PR",    "PE",        "PI",   "RJ",            "RN",                 "RS",               "RO",      "RR",     "SC",            "SP",       "SE",     "TO");
			if (in_array($estado,$array_estados)) {
				$posicao = array_search($estado,$array_estados);
				$estado = $array_ufs[array_search($estado,$array_estados)];
			} else $estado = "<span class=blinkred>&nbsp;".$estado."&nbsp;</span>";
		}
		//echo ', ' . ucwords(($customers['city'] ? $customers['city'] : '<font color="#808080">'.TEXT_NONE.'</font>')); ? ></td>
		$localizacao .= $estado;
		$localizacao .=  ', ' . ($customers['city'] ? $customers['city'] : '<font color="#808080">'.TEXT_NONE.'</font>'); 
		echo "<small>".$localizacao."</small>"; ?></td>
                <td class="dataTableContent" align="center"><small><?php echo tep_date_short($customers['date_account_created']); ?></small></td>
		<td class="dataTableContent"><div align="center">
		    <?php   if ($customers['customers_newsletter'] > '0') {
      echo '<font color="#00CC33"><strong>' . tep_image(DIR_WS_IMAGES . 'yes.gif', "inscrito") . '</strong></font>';
    } else {
      echo '<font color="#FF0000"><strong>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', "não inscrito") . '</strong></font>';
    }?>
		</div></td>
		<!-- <td class="dataTableContent"><small><?php echo $customers['customers_atendente']; ?></small></td> -->
		<td class="dataTableContent" align="center"><small><?php 
			// verifica se o cliente tem algum histórico...
	$hist_raw = "select monitor_date from " . TABLE_MONITOR_PAGE . " where customer_id = '" . $customers['customers_id'] . "' order by monitor_date DESC limit 1";
	$hist_query = tep_db_query($hist_raw);
	$hist = tep_db_fetch_array($hist_query);

			$_data = substr($hist['monitor_date'],8,2).'/'.substr($hist['monitor_date'],5,2).'/'.substr($hist['monitor_date'],0,4);
			echo $_data; 
		?></small></td>

<?php
    }
?>
</tr>
<!--			<tr onMouseOver="javascript:document.onmousemove=null"><td align=center colspan=10><?php echo 	'<a href="' . tep_href_link("create_account.php", tep_get_all_get_params(array('cID', 'action')) .
	'cID=' . $customers['customers_id'] . '&action=insert') . '">' . tep_image(DIR_WS_IMAGES . 'mais.gif', "Novo",10,10) . '&nbsp;Adicionar novo cliente</a>';
	?>
			</td></tr>
-->
              <tr onMouseOver="javascript:document.onmousemove=null">
                <td colspan="10"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $customers_split->display_count($customers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_CUSTOMERS); ?></td>
                    <td class="smallText" align="right"><?php echo $customers_split->display_links($customers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y', 'cID'))); ?></td>
                  </tr>
<?php
    if (isset($_GET['search']) && tep_not_null($_GET['search'])) {
?>
                  <tr onMouseOver="javascript:document.onmousemove=null">
                    <td align="right" colspan="2"><?php echo '<a href="' . tep_href_link(FILENAME_CUSTOMERS) . '">' . tep_image_button('button_reset.gif', IMAGE_RESET) . '</a>'; ?></td>
                  </tr>
<?php
    }
?>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
  <tr><td height="30"></td></tr>
  <tr>
        <td>
		<a href="<?=FILENAME_EXPORT_ENDERECADOR_CLIENTS?>" TARGET="_top">
		<?php echo tep_image(DIR_WS_IMAGES . 'correiosEnderecador.jpg', 'Clique aqui para gerar o arquivo de importação do Endereçador do correios'); ?>
        </a>
        </td>
      </tr>
      <tr>
        <td>Se você não possui o sistema de etiquetas dos correios baixe agora mesmo no link <a href="http://www.correios.com.br/enderecador/escritorio/default.cfm" target="_blank" style="color:#06C">Download Endereçador</a></td>
      </tr>
</table>
<!-- body_eof //-->
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<!-- <br> -->
<script type="text/javascript" src="../includes/librays/jquery.js" ></script>
<script type="text/javascript" src="../includes/librays/jquery.maskedinput.js"></script>
<script type="text/javascript">
jQuery(function($){  
    $("#customers_dob").mask("99/99/9999");
	<? if($type_is['customers_type_register'] == 'F'){?>
	$("#customers_cpf").mask("999.999.999-99");
	<? }else if($type_is['customers_type_register'] == 'J'){?>
	$("#customers_rg").mask("999.999999-9999");
	$("#customers_cpf").mask("99.999.999/9999-99");
	<? }?>
	$("#entry_postcode").mask("99999-999"); 
	$("#customers_telephone").mask("(99) 9999-9999");   
	$("#customers_telephone_comercial").mask("(99) 9999-9999");
	$("#customers_telephone_celular").mask("(99) 9999-9999");
	$("#customers_fax").mask("(99) 9999-9999");
	$("#teste").mask("(99) 9999-9999");
});
</script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>