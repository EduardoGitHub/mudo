<?php
/*
  $Id: create_account.php,v 1.65 2003/06/09 23:03:54 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  require_once("includes/modules/email/class.phpmailer.php");
  
  
  // needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);
  
  $process = false;
  if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
    $process = true;

    if ((ACCOUNT_GENDER == 'true')&&($_POST['c']=='F')) {
      if (isset($_POST['gender'])) {
        $gender = tep_db_prepare_input($_POST['gender']);
      } else {
        $gender = false;
      }
    }

	$firstname = tep_db_prepare_input($_POST['firstname']);
    $lastname = tep_db_prepare_input($_POST['lastname']);
    if ((ACCOUNT_DOB == 'true')&&($_POST['c']=='F')) $dob = tep_db_prepare_input($_POST['dob']);
    $email_address = tep_db_prepare_input($_POST['email_address']);
	$email_address_confirmation = tep_db_prepare_input($_POST['email_address_confirmation']);
    if ((ACCOUNT_COMPANY == 'true')||($_POST['c']=='J')) $company = tep_db_prepare_input($_POST['company']);
    $street_address = tep_db_prepare_input($_POST['street_address']);
	$street_number = tep_db_prepare_input($_POST['street_number']);
	$cpf = tep_db_prepare_input($_POST['cpf']);
	$rg = tep_db_prepare_input($_POST['rg']);
	$revenda = tep_db_prepare_input($_POST['revenda']);
    if (ACCOUNT_SUBURB == 'true') $suburb = tep_db_prepare_input($_POST['suburb']);
	

	if (ACCOUNT_PARTNER == 'true') $partner = tep_db_prepare_input($_POST['customers_partner']);
	
	$complemento = tep_db_prepare_input($_POST['complemento']);
    $postcode = tep_db_prepare_input($_POST['postcode']);
    $city = tep_db_prepare_input($_POST['city']);
    if (ACCOUNT_STATE == 'true') {
		
      $state = tep_db_prepare_input($_POST['state']);
      if (isset($_POST['zone_id'])) {
        $zone_id = tep_db_prepare_input($_POST['zone_id']);
      } else {
        $zone_id = false;
      }
    }
    $country = tep_db_prepare_input($_POST['country']);
    $telephone = tep_db_prepare_input($_POST['telephone']);
	$telephone_comercial = tep_db_prepare_input($_POST['telephone_comercial']);
	$telephone_celular = tep_db_prepare_input($_POST['telephone_celular']);
    $fax = tep_db_prepare_input($_POST['fax']);
    if (isset($_POST['newsletter'])) {
      $newsletter = tep_db_prepare_input($_POST['newsletter']);
    } else {
      $newsletter = false;
    }
    $password = tep_db_prepare_input($_POST['password']);
    $confirmation = tep_db_prepare_input($_POST['confirmation']);
	

    $error = false;

    if ((ACCOUNT_GENDER == 'true')&&($_POST['c']=='F')) {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;

        $messageStack->add('create_account', ENTRY_GENDER_ERROR);
      }
    }

    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_FIRST_NAME_ERROR);
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_LAST_NAME_ERROR);
    }
	

    if ((ACCOUNT_DOB == 'true')&&($_POST['c']=='F')) {
      if (checkdate(substr(tep_date_raw($dob), 4, 2), substr(tep_date_raw($dob), 6, 2), substr(tep_date_raw($dob), 0, 4)) == false) {
        $error = true;

        $messageStack->add('create_account', ENTRY_DATE_OF_BIRTH_ERROR);
      }
    }

    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR);
    } elseif (tep_validate_email($email_address) == false) {
      $error = true;

      $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }else if($email_address != $email_address_confirmation){
		$error = true;

      	$messageStack->add('create_account', 'Os e-mails não conferem. Verifique se o e-mails esta digita corretamente.');
	}else {
      $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
      $check_email = tep_db_fetch_array($check_email_query);
      if ($check_email['total'] > 0) {
        $error = true;

        $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
      }
    }
	
	/* if (strlen($password) < ENTRY_PASSWORD_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_PASSWORD_ERROR);
    } elseif ($password != $confirmation) {
      $error = true;

      $messageStack->add('create_account', ENTRY_PASSWORD_ERROR_NOT_MATCHING);
    }*/

    if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_STREET_ADDRESS_ERROR);
    }
	
	if (strlen($street_number) < ENTRY_STREET_NUMBER_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_STREET_NUMBER_ERROR);
    }

    if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_POST_CODE_ERROR);
    }

    if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_CITY_ERROR);
    }

    if (is_numeric($country) == false) {
      $error = true;

      $messageStack->add('create_account', ENTRY_COUNTRY_ERROR);
    }

    if (ACCOUNT_STATE == 'true') {
      $zone_id = 0;
      $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
      $check = tep_db_fetch_array($check_query);
      $entry_state_has_zones = ($check['total'] > 0);
      if ($entry_state_has_zones == true) {
        //$zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_name like '" . tep_db_input($state) . "%' or zone_code like '%" . tep_db_input($state) . "%')");
		$zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_code ='" . tep_db_input($state) . "')");
        if (tep_db_num_rows($zone_query) == 1) {
          $zone = tep_db_fetch_array($zone_query);
          $zone_id = $zone['zone_id'];
        } else {
          $error = true;

          $messageStack->add('create_account', ENTRY_STATE_ERROR_SELECT);
        }
      } else {
        if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
          $error = true;

          $messageStack->add('create_account', ENTRY_STATE_ERROR);
        }
      }
    }

    if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_TELEPHONE_NUMBER_ERROR);
    }


    if (strlen($password) < ENTRY_PASSWORD_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_PASSWORD_ERROR);
    } elseif ($password != $confirmation) {
      $error = true;

      $messageStack->add('create_account', ENTRY_PASSWORD_ERROR_NOT_MATCHING);
    }

    if ($error == false) {
      $sql_data_array = array('customers_type_register' => $_POST['c'],
	  						  'customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
							  'customers_cpf' => tep_removecaracters($cpf),
							  'customers_rg' => tep_removecaracters($rg),
                              'customers_email_address' => $email_address,
                              'customers_telephone' => tep_removecaracters($telephone),
							  'customers_telephone_comercial' => tep_removecaracters($telephone_comercial),
							  'customers_telephone_celular' => tep_removecaracters($telephone_celular),
                              'customers_fax' => tep_removecaracters($fax),
                              'customers_newsletter' => $newsletter,
                              'customers_password' => $password);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
	  if (ACCOUNT_PARTNER == 'true') $sql_data_array['customers_partner'] = $partner;
	  
      if ((ACCOUNT_DOB == 'true') && ($_POST['c']=='F')) $sql_data_array['customers_dob'] = tep_date_raw($dob);

      tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);

      $customer_id = tep_db_insert_id();

      $sql_data_array = array('customers_id' => $customer_id,
                              'entry_firstname' => $firstname,
                              'entry_lastname' => $lastname,
                              'entry_street_address' => $street_address,
							  'entry_street_number' => $street_number,
							  'entry_complemento' => $complemento,
                              'entry_postcode' => tep_removecaracters($postcode),
                              'entry_city' => $city,
                              'entry_country_id' => $country);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
      if ((ACCOUNT_COMPANY == 'true')||($_POST['c']=='J')) $sql_data_array['entry_company'] = $company;
      if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array['entry_zone_id'] = $zone_id;
          $sql_data_array['entry_state'] = $state;
        } else {
          $sql_data_array['entry_zone_id'] = '0';
          $sql_data_array['entry_state'] = $state;
        }
      }

      tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

      $address_id = tep_db_insert_id();

      tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");

      tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . (int)$customer_id . "', '0', now())");

      if (SESSION_RECREATE == 'True') {
        tep_session_recreate();
      }

      $customer_first_name = $firstname;
      $customer_default_address_id = $address_id;
      $customer_country_id = $country;
      $customer_zone_id = $zone_id;
      tep_session_register('customer_id');
      tep_session_register('customer_first_name');
      tep_session_register('customer_default_address_id');
      tep_session_register('customer_country_id');
      tep_session_register('customer_zone_id');

		// restore cart contents
			  $cart->restore_contents();
		// build the message content
      $name = $firstname . ' ' . $lastname;

      if (ACCOUNT_GENDER == 'true') {
         if ($gender == 'm') {
           $email_text = sprintf(EMAIL_GREET_MR, $firstname);
         } else {
           $email_text = sprintf(EMAIL_GREET_MS, $firstname);
         }
      } else {
        $email_text = sprintf(EMAIL_GREET_NONE, $firstname);
      }

      //$email_text .= EMAIL_WELCOME . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
	  $email_text .= EMAIL_WELCOME . EMAIL_TEXT . EMAIL_CONTACT;
      //tep_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
	  
	    $html = '<table width="760" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #CCC; padding:15px; background-color:#D7AB00" align="center">
		  
          <tr>
			<td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="56%" rowspan="2" align="center">'.$name.'¨&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><span style="font-size:20px">Seja</span><br><span style="font-size:40px">Bem Vindo!</span></td>
                    <td width="44%"><img src="images/mail/mudominhacasa.png" width="332" height="59"/></td>
                  </tr>
                  <tr>
                    <td style="color:#000; font-weight:bold; text-align:right; padding-right:3px;">wwww.mudominhacasa.com.br</td>
                  </tr>
                </table>

            </td>
		  </tr>
          <tr>
			<td class="texto">
            	<table width="760" border="0" cellspacing="0" cellpadding="0" style="background-color:#FFF; margin:5px">
                  <tr>
                    <td style="padding:5px"><p style="font-size:30px; text-align:center">Adesivos de Parede para Decoração da sua Casa, Quarto ou Escritório!</p><br>

<p style="text-align:center">O Mudominhacasa.com tem o prazer de lhe dar boas vindas, tendo em vista a sua recente inclusão em nosso cadastro de clientes.  </p>      	
<p style="text-indent:15px; text-align:justify">
Na nossa loja virtual você confere uma enorme variedade de adesivos decorativos para todos os tipos de ambientes e com temáticas atuais. Nossos modelos são modernos e descolados, e ajudam a personalizar qualquer ambiente com um toque de requinte. São adesivos criativos que abordam diversas categorias e assuntos com grande apelo artístico. Nós queremos realmente recriar as paredes brancas e os móveis comuns.</p><br>  Confira abaixo alguns serviços que você já pode desfrutar:<br><br>
</td>
                  </tr>
                  <tr>
                  	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="16%" align="center"><img src="images/mail/6vezes.png"></td>
                            <td width="2%">&nbsp;</td>
                            <td width="82%" style="background-color:#FFDAA3">PAGAMENTO FACILITADO <br>
Todos os produtos da loja podem ser divididos em 6 vezes sem juros!
</td>
                          </tr>
                          <tr><td colspan="3" height="10"></td></tr>
                          <tr> 
                            <td align="center"><img src="images/mail/comprasegura.png"></td>
                            <td>&nbsp;</td>
                            <td style="background-color:#FFDAA3">COMPRA SEGURA <br>
Compra efetuada em ambiente seguro. Não temos acesso a seus Dados Bancários.
</td>
                          </tr>
                          <tr><td colspan="3" height="10"></td></tr>
                          <tr>
                            <td align="center"><img src="images/mail/personalizados.png"></td>
                            <td>&nbsp;</td>
                            <td style="background-color:#FFDAA3">PRODUTOS PERSONALIZADOS<br/>
Não encontrou o que procura? Criamos Produtos Exclusivos para você!
</td>
                          </tr>
                          <tr><td colspan="3" height="10"></td></tr>
                          <tr>
                            <td align="center"><img src="images/mail/qualidade.png"/></td>
                            <td>&nbsp;</td>
                            <td style="background-color:#FFDAA3">QUALIDADE INDISCUTÍVEL<br/>
Produzido com adesivo ultrafino, de melhor desempenho encontrado no mercado.
</td>
                          </tr>
                          <tr><td colspan="3" height="10"></td></tr>
                          <tr>
                            <td align="center"><img  src="images/mail/entrega.png"></td>
                            <td>&nbsp;</td>
                            <td style="background-color:#FFDAA3">ENTREGA RÁPIDA PARA TODO O BRASIL<br/>
Entregamos em todo o Brasil via Correios. Escolha a melhor opção de entrega.
</td>
                          </tr>
                        </table>

                    </td>
                  </tr>  
                  <tr><td style="text-align:center; font-size:25px; font-weight:bold">www.mudominhacasa.com.br</td></tr>
                  <tr><td align="center">Em caso de dúvidas entre em contato através do e-mail: atendimento@mudominhacasa.com.br</td></tr>
                </table>
			</td>
		  </tr>
		  <tr>
			<td style="text-align:center; font-size:13px; font-family:Tahoma; padding:10px">
            Muito obrigado pela sua preferência e compreensão!<br>
            Esperamos sua total satisfação na aquisição do seu produto Mudominhacasa - Adesivos Decorativos
            </td>
		  </tr>
		</table>';
				
      tep_sendMailOrders($email_address, EMAIL_SUBJECT, $html, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
	  
	  if(isset($revenda) and $revenda == 1){
	  	$html = sprintf(EMAIL_TEXT_TO_OWNER, $firstname);
	  	tep_sendMail(STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT_TO_OWNER, $html, $firstname, $email_address);//Este email so será enviado se o cadastro for de pessoa Juridica e se tiver marcado a opção para ser um revendedor		
		tep_redirect(tep_href_link(FILENAME_CREATE_ACCOUNT_SUCCESS, 'rev='.$revenda, 'SSL'));
	  }else{
      tep_redirect(tep_href_link(FILENAME_CREATE_ACCOUNT_SUCCESS, '', 'SSL'));
	  }
    }
  }

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'));
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
<style type="text/css">
.infoBox2{ border:1px solid #CCC;}
.inputRequirement{ font-family:Tahoma; font-size:11px; color:#F00;}
</style>
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  
  <div id="mainContent" style="width:100%; margin:0; padding:10px 0 0 0;">
  
  <div class="tituloCompra"><span><?php echo HEADING_TITLE; ?></span></div>

<?php if($_REQUEST['c'] == 'F') echo tep_draw_form('create_account', tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post', 'onSubmit="return check_form(create_account);"') . tep_draw_hidden_field('action', 'process').tep_draw_hidden_field('c', $_REQUEST['c']); else if($_REQUEST['c'] == 'J') echo tep_draw_form('create_account', tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post', 'onSubmit="return check_form2(create_account);"') . tep_draw_hidden_field('action', 'process'). tep_draw_hidden_field('c', $_REQUEST['c']);?>
    <table border="0" width="99%" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
		</td>
      </tr>
      <tr>
        <td class="smallText"><br/><?php echo sprintf(TEXT_ORIGIN_LOGIN, tep_href_link(FILENAME_LOGIN, tep_get_all_get_params(), 'SSL')); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
		<?php if ($messageStack->size('create_account') > 0) { ?>
      <tr>
        <td><?php echo $messageStack->output('create_account'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
		<?php }?>
      <tr>
        <td>
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><b><?php if($_REQUEST['c'] == 'F') echo CATEGORY_PERSONAL; else echo CATEGORY_COMPANY; ?></b></td>
               <td class="inputRequirement" align="right"><?php echo FORM_REQUIRED_INFORMATION; ?></td>
              </tr>
            </table>
	  	</td>
      </tr>
	  <?php if($_REQUEST['c'] == 'F'){?>
	  <tr>
		<td>
            <table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
              <tr>
                <td>
                    <table border="0" cellspacing="2" cellpadding="2">
                    <?php if (ACCOUNT_GENDER == 'true') { ?>
                      <tr>
                        <td class="main"><?php echo ENTRY_GENDER; ?></td>
                        <td class="main"><?php echo tep_draw_radio_field('gender', 'm') . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('gender', 'f') . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . (tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); ?></td>
                      </tr>
                    <?php } ?>
                      <tr>
                        <td class="main"><?php echo ENTRY_FIRST_NAME; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('firstname','','size="40" maxlength="200"') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?></td>
                      </tr>
                      <tr>
                        <td class="main"><?php echo ENTRY_LAST_NAME; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('lastname','','size="40" maxlength="200"') . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?></td>
                      </tr>
                      <tr>
                        <td class="main"><?php echo ENTRY_STREET_CPF; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('cpf','','id="cpf"') . (tep_not_null(ENTRY_STREET_ADDRESS_CPF) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_CPF . '</span>': '');?></td> 
                      </tr>
                       <tr>
                        <td class="main"><?php echo ENTRY_STREET_RG; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('rg','','style="text-transform:uppercase"') . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_RG) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_RG . '</span>': '');?></td>
                      </tr>	
                     <?php if (ACCOUNT_DOB == 'true') { ?>
                      <tr>
                        <td class="main"><?php echo ENTRY_DATE_OF_BIRTH; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('dob','','id="dob"') . '&nbsp;' . (tep_not_null(ENTRY_DATE_OF_BIRTH_TEXT) ? '<span class="inputRequirement">' . ENTRY_DATE_OF_BIRTH_TEXT . '</span>': ''); ?></td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td class="main"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('email_address','','size="40" maxlength="200"') . '&nbsp;' . (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?></td>
                      </tr>
                      
                      <tr>
                        <td class="main">Confirme o <?php echo ENTRY_EMAIL_ADDRESS; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('email_address_confirmation','','size="40" maxlength="200"') . '&nbsp;' . (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?></td>
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
                                    echo tep_draw_pull_down_menu('customers_partner', $partner_array);
                            ?> 
                        </td>
                      </tr>
					<?php } ?>
                    </table>
                </td>
              </tr>
            </table>
        </td>
      </tr>
	  <?php if (ACCOUNT_COMPANY == 'true') { ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo CATEGORY_COMPANY; ?></b></td>
      </tr>
      <tr>
        <td>
        	<table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          		<tr class="infoBoxContents2">
            		<td>
                    	<table border="0" cellspacing="2" cellpadding="2">
                          <tr>
                            <td class="main"><?php echo ENTRY_COMPANY; ?></td>
                            <td class="main"><?php echo tep_draw_input_field('company','','size="40" maxlength="200"') . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?></td>
                          </tr>
                        </table>
                    </td>
          		</tr>
        	</table>
        </td>
      </tr>
    <?php  }  }else if($_REQUEST['c'] == 'J'){ ?>
	  <tr>
        <td>
            <table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
              <tr class="infoBoxContents2">
                <td>
                    <table border="0" cellspacing="2" cellpadding="2">
                      <tr>
                        <td class="main"><?php echo ENTRY_RAZAO_SOCIAL; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('firstname','','size="40" maxlength="200"') . '&nbsp;' . (tep_not_null(ENTRY_RAZAO_SOCIAL_TEXT) ? '<span class="inputRequirement">' . ENTRY_RAZAO_SOCIAL_TEXT . '</span>': ''); ?></td>
                      </tr>
                      <tr>
                        <td class="main"><?php echo ENTRY_NOME_FANTASIA; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('lastname','','size="40" maxlength="200"') . '&nbsp;' . (tep_not_null(ENTRY_NOME_FANTASIA_TEXT) ? '<span class="inputRequirement">' . ENTRY_NOME_FANTASIA_TEXT . '</span>': ''); ?></td>
                      </tr>
                      <tr>
                        <td class="main"><?php echo ENTRY_CNPJ; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('cpf','','id="cpf"') .(tep_not_null(ENTRY_CNPJ_TEXT) ? '<span class="inputRequirement">' . ENTRY_CNPJ_TEXT . '</span>': '');?></td>
                      </tr>
                      <tr>
                        <td class="main"><?php echo ENTRY_INSCRICAO_ESTADUAL; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('rg','','id="rg" style="text-transform:uppercase"') . '&nbsp;' .(tep_not_null(ENTRY_INSCRICAO_ESTADUAL_TEXT) ? '<span class="inputRequirement">' . ENTRY_INSCRICAO_ESTADUAL_TEXT . '</span>': '');?></td>
                      </tr>	
                      <tr>
                        <td class="main"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('email_address','','size="40" maxlength="200"') . '&nbsp;' . (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?></td>
                      </tr>
                      <tr>
                        <td class="main">Confirme o <?php echo ENTRY_EMAIL_ADDRESS; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('email_address_confirmation','','size="40" maxlength="200"') . '&nbsp;' . (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?></td>
                      </tr>
                      <tr>
                        <td class="main"><?php echo ENTRY_RESPONSAVEL; ?></td>
                        <td class="main"><?php echo tep_draw_input_field('company','','size="40" maxlength="200"') . '&nbsp;' . (tep_not_null(ENTRY_RESPONSAVEL_TEXT) ? '<span class="inputRequirement">' . ENTRY_RESPONSAVEL_TEXT . '</span>': ''); ?></td>
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
                                        echo tep_draw_pull_down_menu('customers_partner', $partner_array);
                                ?> 
                            </td>
                          </tr>
                        <?php } ?>
                    </table>
                </td>
              </tr>
            </table>
        </td>
      </tr>
	 <?php } ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo CATEGORY_ADDRESS; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main" valign="top"><?php echo ENTRY_POST_CODE; ?></td>
                <td class="main"><?php echo tep_draw_input_field('postcode', '', 'id="postcode"') . '&nbsp;' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '&nbsp;': ''); ?><input type="button" name="buscacep" id="buscacep" style="border: 0px; width: 65px; height: 18px; background-image: url('images/button-cep.gif'); cursor:pointer; " /><span style="font-size:9px; font-style:italic;"> (PREENCHA SEU CEP E CLIQUE EM BUSCAR CEP PARA PREENCHIMENTO AUTOMÁTICO DO ENDEREÇO)</span><br /><a href="javascript:SEDEX('busca_cep.htm');" style="font-family:Arial, Helvetica, sans-serif; color:#000000; font-size:8px; vertical-align:top; display:table-cell"><B>NÃO SEI O CEP. QUERO PROCURAR</B></a></span><div id="validpostcode" style="color:#000000;" class="inputRequirement"></div></td>
              </tr>
			  <tr>
                <td class="main"><?php echo ENTRY_STREET_ADDRESS; ?></td>
                <td class="main"><?php echo tep_draw_input_field('street_address','','id="street_address" size="60" maxlength="200"') . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?></td>
              </tr>
			  <tr>
                <td class="main"><?php echo ENTRY_STREET_NUMBER; ?></td>
                <td class="main"><?php echo tep_draw_input_field('street_number','','id="street_number" size="10" maxlength="10"') . '&nbsp;' . (tep_not_null(ENTRY_STREET_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_NUMBER_TEXT . '</span>': ''); ?>  <?php echo ENTRY_COMPLEMENTO; ?> <?php echo tep_draw_input_field('complemento','','size="30" maxlength="200"') . '&nbsp;' .(tep_not_null(ENTRY_COMPLEMENTO_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPLEMENTO_TEXT . '</span>': '');?></td>
              </tr>
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
              <tr>
                <td class="main"><?php echo ENTRY_SUBURB; ?></td>
                <td class="main"><?php echo tep_draw_input_field('suburb','','id="suburb" size="60" maxlength="200"') . '&nbsp;' . (tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?></td>
              </tr>
<?php
  }
?>
              
              <tr>
                <td class="main"><?php echo ENTRY_CITY; ?>
</td>
                <td class="main"><?php echo tep_draw_input_field('city','','id="city" size="60" maxlength="200"') . '&nbsp;' . (tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''); ?></td>
              </tr>
<?php
  if (ACCOUNT_STATE == 'true') {
?>
              <tr>
                <td class="main"><?php echo ENTRY_STATE; ?></td>
                <td class="main">
<?php
    /*if ($process == true) {
      if ($entry_state_has_zones == true) {
        $zones_array = array();
        $zones_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' order by zone_name");
        while ($zones_values = tep_db_fetch_array($zones_query)) {
          $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
        }
        echo tep_draw_pull_down_menu('state', $zones_array);
      } else {
        echo tep_draw_input_field('state','','id="state"size="2" maxlength="2" style="text-transform:uppercase"');
      }
    } else {
      
    }*/
	echo tep_draw_input_field('state','','id="state" size="3" maxlength="2" style="text-transform:uppercase"');
    if (tep_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="inputRequirement">' . ENTRY_STATE_TEXT;
?> <span style="font-family:Tahoma; font-size:10px; color:#F00; ">Informe apenas sigla do seu  estado (MG, RJ, SP, MA, BA, TO, RS).</span>
                </td>
              </tr>
<?php
  }
?>
              <tr>
                <td class="main"><?php echo ENTRY_COUNTRY; ?></td>
                <td class="main"><?php echo tep_get_country_list('country','30') . '&nbsp;' . (tep_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo CATEGORY_CONTACT; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main"><?php if($_REQUEST['c'] == 'F'){ echo ENTRY_TELEPHONE_NUMBER; }else if($_REQUEST['c'] == 'J'){ echo ENTRY_TELEPHONE2_NUMBER;} ?></td>
                <td class="main"><?php echo tep_draw_input_field('telephone','','id="telephone"') . '&nbsp;' . (tep_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''); ?></td>
              </tr>
			  
			  <tr>
                <td class="main"><?php echo ENTRY_TELEPHONE_COMERCIAL_NUMBER; ?></td>
                <td class="main"><?php echo tep_draw_input_field('telephone_comercial','','id="telephone_comercial"') . '&nbsp;' . (tep_not_null(ENTRY_TELEPHONE_COMERCIAL_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_TELEPHONE_COMERCIAL_NUMBER_TEXT . '</span>': ''); ?></td>
              </tr>
			  
			  <tr>
                <td class="main"><?php echo ENTRY_TELEPHONE_CELULAR_NUMBER; ?></td>
                <td class="main"><?php echo tep_draw_input_field('telephone_celular','','id="telephone_celular"') . '&nbsp;' . (tep_not_null(ENTRY_TELEPHONE_CELULAR_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_TELEPHONE_CELULAR_NUMBER_TEXT . '</span>': ''); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_FAX_NUMBER; ?></td>
                <td class="main"><?php echo tep_draw_input_field('fax','','id="fax"') . '&nbsp;' . (tep_not_null(ENTRY_FAX_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_FAX_TEXT . '</span>': ''); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo CATEGORY_OPTIONS; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main"><?php echo ENTRY_NEWSLETTER; ?></td>
                <td class="main"><?php echo tep_draw_checkbox_field('newsletter', '1', true) . '&nbsp;' . (tep_not_null(ENTRY_NEWSLETTER_TEXT) ? '<span class="inputRequirement">' . ENTRY_NEWSLETTER_TEXT . '</span>': ''); ?></td>
              </tr>
              <? if(($_REQUEST['c'] == 'J') and (WORK_WITH_REVENDA == 'True')){ ?>
              <tr>
                <td class="main">Desejo ser revendedor:</td>
                <td class="main"><?php echo tep_draw_checkbox_field('revenda', '1') . '&nbsp;' . (tep_not_null(ENTRY_NEWSLETTER_TEXT) ? '<span class="inputRequirement">' . ENTRY_NEWSLETTER_TEXT . '</span>': ''); ?></td>
              </tr>
              <? }?>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo CATEGORY_PASSWORD; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox2">
          <tr class="infoBoxContents2">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main"><?php echo ENTRY_PASSWORD; ?></td>
                <td class="main"><?php echo tep_draw_password_field('password',' ') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_TEXT . '</span>': ''); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?></td>
                <td class="main"><?php echo tep_draw_password_field('confirmation','') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>
</form>
    
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
<script type="text/javascript" src="includes/busca-cep.js"></script>
<script type="text/javascript" src="includes/librays/jquery.maskedinput.js"></script>
<script type="text/javascript">
jQuery(function($){  
    $("#dob").mask("99/99/9999");
	<? if($_REQUEST['c'] == 'F'){?>
	$("#cpf").mask("999.999.999-99");
	<? }else if($_REQUEST['c'] == 'J'){?>
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
<?php require('includes/form_check.js.php'); ?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
