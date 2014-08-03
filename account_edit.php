<?php
/*
  $Id: account_edit.php,v 1.65 2003/06/09 23:03:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_EDIT);
  
  $type_register = tep_db_query("select customers_type_register from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
  $type_is = tep_db_fetch_array($type_register);

  if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
    if ((ACCOUNT_GENDER == 'true')&&($type_is['customers_type_register']=='F')) $gender = tep_db_prepare_input($_POST['gender']);
    $firstname = tep_db_prepare_input($_POST['firstname']);
    $lastname = tep_db_prepare_input($_POST['lastname']);
	$rg = tep_db_prepare_input($_POST['rg']);
	$cpf = tep_db_prepare_input($_POST['cpf']);
    if ((ACCOUNT_DOB == 'true')&&($type_is['customers_type_register']=='F')) $dob = tep_db_prepare_input($_POST['dob']);
    $email_address = tep_db_prepare_input($_POST['email_address']);
    $telephone = tep_db_prepare_input($_POST['telephone']);
	$telephone_comercial = tep_db_prepare_input($_POST['telephone_comercial']);
	$telephone_celular = tep_db_prepare_input($_POST['telephone_celular']);
    $fax = tep_db_prepare_input($_POST['fax']);

    $error = false;

    if ((ACCOUNT_GENDER == 'true')&&($type_is['customers_type_register']=='F')) {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;

        $messageStack->add('account_edit', ENTRY_GENDER_ERROR);
      }
    }
	
	if($type_is['customers_type_register']=='F'){

		if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
		  $error = true;
	
		  $messageStack->add('account_edit', ENTRY_FIRST_NAME_ERROR);
		}
	
		if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
		  $error = true;
	
		  $messageStack->add('account_edit', ENTRY_LAST_NAME_ERROR);
		}
		
		if (strlen($cpf) < ENTRY_STREET_CPF_MIN_LENGTH) {
		  $error = true;
	
		  $messageStack->add('account_edit', ENTRY_STREET_CPF_ERROR);
		}
		
		if (strlen($rg) < ENTRY_STREET_RG_MIN_LENGTH) {
		  $error = true;
	
		  $messageStack->add('account_edit', ENTRY_STREET_RG_ERROR);
		}
	}else if($type_is['customers_type_register']=='J'){
	
		if (strlen($firstname) < ENTRY_RAZAO_SOCIAL_MIN_LENGTH) {
		  $error = true;
	
		  $messageStack->add('account_edit', ENTRY_RAZAO_SOCIAL_ERROR);
		}
	
		if (strlen($lastname) < ENTRY_NOME_FANTASIA_MIN_LENGTH) {
		  $error = true;
	
		  $messageStack->add('account_edit', ENTRY_NOME_FANTASIA_ERROR);
		}
		
		if (strlen($cpf) < ENTRY_CNPJ_MIN_LENGTH) {
		  $error = true;
	
		  $messageStack->add('account_edit', ENTRY_CNPJ_ERROR);
		}
		/*
		if (strlen($rg) < ENTRY_INSCRICAO_ESTADUAL_MIN_LENGTH) {
		  $error = true;
	
		  $messageStack->add('account_edit', ENTRY_INSCRICAO_ESTADUAL_ERROR);
		}
		*/
	
	}

    if ((ACCOUNT_DOB == 'true')&&($type_is['customers_type_register']=='F')) {
      if (!checkdate(substr(tep_date_raw($dob), 4, 2), substr(tep_date_raw($dob), 6, 2), substr(tep_date_raw($dob), 0, 4))) {
        $error = true;

        $messageStack->add('account_edit', ENTRY_DATE_OF_BIRTH_ERROR);
      }
    }

    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_ERROR);
    }

    if (!tep_validate_email($email_address)) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }

    $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "' and customers_id != '" . (int)$customer_id . "'");
    $check_email = tep_db_fetch_array($check_email_query);
    if ($check_email['total'] > 0) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
    }

    if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_TELEPHONE_NUMBER_ERROR);
    }

    if ($error == false) {
      $sql_data_array = array('customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
							  'customers_rg' => tep_removecaracters($rg),
							  'customers_cpf' => tep_removecaracters($cpf),
                              'customers_email_address' => $email_address,
                              'customers_telephone' => tep_removecaracters($telephone),
							  'customers_telephone_comercial' => tep_removecaracters($telephone_comercial),
							  'customers_telephone_celular' => tep_removecaracters($telephone_celular),
                              'customers_fax' => tep_removecaracters($fax),
							  'customers_modified' => '1');

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = tep_date_raw($dob);

      tep_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$customer_id . "'");

      tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_account_last_modified = now() where customers_info_id = '" . (int)$customer_id . "'");

      $sql_data_array = array('entry_firstname' => $firstname,
                              'entry_lastname' => $lastname);

      tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$customer_default_address_id . "'");

// reset the session variables
      $customer_first_name = $firstname;

      $messageStack->add_session('account', SUCCESS_ACCOUNT_UPDATED, 'success');

      tep_redirect(tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
    }
  }

  $account_query = tep_db_query("select customers_gender, customers_firstname, customers_lastname, customers_dob, customers_rg, customers_cpf, customers_email_address, customers_telephone, customers_telephone_comercial, customers_telephone_celular, customers_fax from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
  $account = tep_db_fetch_array($account_query);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<?php
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
  <title><?php echo TITLE; ?></title>
<?php
}
?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<?php require('includes/form_check.js.php'); ?>
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="mainContent">
  
  <div class="tituloCompra"><?php echo HEADING_TITLE; ?></div>
        <!-- body //-->
    <table border="0" width="99%" cellspacing="0" cellpadding="0">
      <tr>
    <!-- body_text //-->
        <td width="100%" valign="top"><?php if($type_is['customers_type_register']=='F') echo tep_draw_form('account_edit', tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'), 'post', 'onSubmit="return check_form(account_edit);"') . tep_draw_hidden_field('action', 'process'). tep_draw_hidden_field('customers_type_register', $type_is['customers_type_register']); else if($type_is['customers_type_register']=='J') echo tep_draw_form('account_edit', tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'), 'post', 'onSubmit="return check_form2(account_edit);"') . tep_draw_hidden_field('action', 'process'). tep_draw_hidden_field('customers_type_register', $type_is['customers_type_register']);?><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
           <?php if ($messageStack->size('account_edit') > 0) {  ?>
          <tr>
            <td><?php echo $messageStack->output('account_edit'); ?></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
            <?php  } ?>
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><b><?php echo MY_ACCOUNT_TITLE; ?></b></td>
                    <td class="inputRequirement" align="right"><?php echo FORM_REQUIRED_INFORMATION; ?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td>
                <?php if($type_is['customers_type_register']== 'F'){?>
                <table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
                  <tr class="infoBoxContents2">
                    <td>
                    <table border="0" cellspacing="2" cellpadding="2">
                    <?php
                      if (ACCOUNT_GENDER == 'true') {
                        if (isset($gender)) {
                          $male = ($gender == 'm') ? true : false;
                        } else {
                          $male = ($account['customers_gender'] == 'm') ? true : false;
                        }
                        $female = !$male;
                    ?>
                      <tr>
                        <td class="main"><?php echo ENTRY_GENDER; ?></td>
                        <td class="main"><?php echo tep_draw_radio_field('gender', 'm', $male) . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('gender', 'f', $female) . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . (tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); ?></td>
                      </tr>
                    <?php
                      }
                    ?>
                      <tr>
                        <td class="main"><?php echo ENTRY_FIRST_NAME; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('firstname', $account['customers_firstname'], 'size="40"') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?></td>
                      </tr>
                      <tr>
                        <td class="main"><?php echo ENTRY_LAST_NAME; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('lastname', $account['customers_lastname'], 'size="40"') . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?></td>
                      </tr>
                      <tr>
                        <td class="main"><?php echo ENTRY_STREET_RG; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('rg', $account['customers_rg']) . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_RG) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_RG . '</span>': ''); ?></td>
                      </tr>
                      <tr>
                        <td class="main"><?php echo ENTRY_STREET_CPF; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('cpf', tep_putcaracters($account['customers_cpf'],'###.###.###-##'),'onkeypress="return MM_formtCPF(event,this,\'###.###.###-##\');" maxlength="14" onKeyPress="if (!(MascaraNumero(this))) return false;"') . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_CPF) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_CPF . '</span>': ''); ?></td>
                      </tr>
                      
                        <?php
                          if (ACCOUNT_DOB == 'true') {
                        ?>
                      <tr>
                        <td class="main"><?php echo ENTRY_DATE_OF_BIRTH; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('dob', tep_date_short($account['customers_dob']), 'id="dob"') . '&nbsp;' . (tep_not_null(ENTRY_DATE_OF_BIRTH_TEXT) ? '<span class="inputRequirement">' . ENTRY_DATE_OF_BIRTH_TEXT . '</span>': ''); ?></td>
                      </tr>
                        <?php
                          }
                        ?>
                      <tr>
                        <td class="main"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('email_address', $account['customers_email_address'], 'size="40"') . '&nbsp;' . (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?></td>
                      </tr>
                      <tr> 
                        <td class="main"><?php echo ENTRY_TELEPHONE_NUMBER; ?></td>
                        <td> 
                        <?php echo tep_draw_input_field('telephone', $account['customers_telephone'], 'id="telephone"'); ?></td> 
                      </tr>
                      <tr> 
                        <td class="main"><?php echo ENTRY_TELEPHONE_COMERCIAL_NUMBER; ?></td>
                        <td> 
                        <?php echo tep_draw_input_field('telephone_comercial', $account['customers_telephone_comercial'], 'id="telephone_comercial"'); ?></td> 
                      </tr>
                      <tr> 
                        <td class="main"><?php echo ENTRY_TELEPHONE_CELULAR_NUMBER; ?></td>
                        <td> 
                            <?php echo tep_draw_input_field('telephone_celular', $account['customers_telephone_celular'], 'id="telephone_celular"'); ?>
                        </td> 
                      </tr>
                      <tr>
                        <td class="main"><?php echo ENTRY_FAX_NUMBER; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('fax', $account['customers_fax'], 'id="fax"'); ?></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                </table>
                <?php } else if($type_is['customers_type_register']=='J'){?>
                <table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
                  <tr class="infoBoxContents2">
                    <td>
                    <table border="0" cellspacing="2" cellpadding="2">
                      <tr>
                        <td class="main"><?php echo ENTRY_RAZAO_SOCIAL; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('firstname', $account['customers_firstname'], 'size="40"') . '&nbsp;' . (tep_not_null(ENTRY_RAZAO_SOCIAL_TEXT) ? '<span class="inputRequirement">' . ENTRY_RAZAO_SOCIAL_TEXT . '</span>': ''); ?></td>
                      </tr>
                      <tr>
                        <td class="main"><?php echo ENTRY_NOME_FANTASIA; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('lastname', $account['customers_lastname'], 'size="40"') . '&nbsp;' . (tep_not_null(ENTRY_NOME_FANTASIA_TEXT) ? '<span class="inputRequirement">' . ENTRY_NOME_FANTASIA_TEXT . '</span>': ''); ?></td>
                      </tr>
                      <tr>
                        <td class="main"><?php echo ENTRY_CNPJ; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('cpf',  $account['customers_cpf'],'id="cpf"') . '&nbsp;' . (tep_not_null(ENTRY_CNPJ_TEXT) ? '<span class="inputRequirement">' . ENTRY_CNPJ_TEXT . '</span>': ''); ?></td>
                      </tr>
                      <tr>
                        <td class="main"><?php echo ENTRY_INSCRICAO_ESTADUAL; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('rg',  $account['customers_rg'],'style="text-transform:uppercase" id="rg"') . '&nbsp;' . (tep_not_null(ENTRY_INSCRICAO_ESTADUAL_TEXT) ? '<span class="inputRequirement">' . ENTRY_INSCRICAO_ESTADUAL_TEXT . '</span>': ''); ?></td>
                      </tr>
                      <tr>
                        <td class="main"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('email_address', $account['customers_email_address'], 'size="40"') . '&nbsp;' . (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?></td>
                      </tr>
                      <tr> 
                        <td class="main"><?php if($type_is['customers_type_register']== 'F') echo ENTRY_TELEPHONE_NUMBER; else if($type_is['customers_type_register']== 'J') echo ENTRY_TELEPHONE2_NUMBER;  ?></td>
                        <td> 
                        <?php echo tep_draw_input_field('telephone', $account['customers_telephone'], 'id="telephone"'); ?></td> 
                      </tr>
                      <tr> 
                        <td class="main"><?php echo ENTRY_TELEPHONE_COMERCIAL_NUMBER; ?></td>
                        <td> 
                        <?php echo tep_draw_input_field('telephone_comercial', $account['customers_telephone_comercial'], 'id="telephone_comercial"'); ?></td> 
                      </tr>
                      <tr> 
                        <td class="main"><?php echo ENTRY_TELEPHONE_CELULAR_NUMBER; ?></td>
                        <td> 
                            <?php echo tep_draw_input_field('telephone_celular', $account['customers_telephone_celular'], 'id="telephone_celular"'); ?>
                        </td> 
                      </tr>
                      <tr>
                        <td class="main"><?php echo ENTRY_FAX_NUMBER; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('fax', $account['customers_fax'], 'id="fax"'); ?></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                </table>
                
                
                
                <?php }?>
                
                
                </td>
              </tr>
            </table>
            </td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
              <tr class="infoBoxContents2">
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                    <td align="right"><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></form></td>
    <!-- body_text_eof //-->
      </tr>
    </table>
    <!-- body_eof //-->
          </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
<script type="text/javascript" src="includes/librays/jquery.maskedinput.js"></script>
<script type="text/javascript">
jQuery(function($){  
    $("#dob").mask("99/99/9999");
	<? if($_GET['c'] == 1){?>
	$("#cpf").mask("999.999.999-99");
	<? }else if($_GET['c'] == 2){?>
	$("#rg").mask("999.999999-9999");
	$("#cpf").mask("99.999.999/9999-99");
	<? }?>
	$("#postcode").mask("99999-999"); 
	$("#telephone").mask("(99) 9999-9999");   
	$("#telephone_comercial").mask("(99) 9999-9999");
	$("#telephone_celular").mask("(99) 9999-9999");
	$("#telefone4").mask("(99) 9999-9999");
	$("#fax").mask("(99) 9999-9999");
});
</script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>