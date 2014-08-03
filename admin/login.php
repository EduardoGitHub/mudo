<?php
/*
  $Id: $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  require('includes/functions/password_funcs.php');

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'process':
        $username = tep_db_prepare_input($HTTP_POST_VARS['username']);
        $password = tep_db_prepare_input($HTTP_POST_VARS['password']);

        $check_query = tep_db_query("select id, user_name, user_password from " . TABLE_ADMINISTRATORS . " where user_name = '" . tep_db_input($username) . "'");

        if (tep_db_num_rows($check_query) == 1) {
          $check = tep_db_fetch_array($check_query);

          if (tep_validate_password($password, $check['user_password'])) {
            tep_session_register('admin');

            $admin = array('id' => $check['id'],
                           'username' => $check['user_name']);

            if (tep_session_is_registered('redirect_origin')) {
              $page = $redirect_origin['page'];
              $get_string = '';

				  if (function_exists('http_build_query')) {
					$get_string = http_build_query($redirect_origin['get']);
				  }

              tep_session_unregister('redirect_origin');
			  if($admin['username']=='producao')tep_redirect(tep_href_link(FILENAME_ORDERS));
              tep_redirect(tep_href_link(FILENAME_DEFAULT));
            } else {
              tep_redirect(tep_href_link(FILENAME_DEFAULT));
            }
          }
        }

        $messageStack->add(ERROR_INVALID_ADMINISTRATOR, 'error');

        break;

      case 'logoff':
        tep_session_unregister('selected_box');
        tep_session_unregister('admin');
        tep_redirect(tep_href_link(FILENAME_DEFAULT));

        break;

      case 'create':
        $check_query = tep_db_query("select id from " . TABLE_ADMINISTRATORS . " limit 1");

        if (tep_db_num_rows($check_query) == 0) {
          $username = tep_db_prepare_input($HTTP_POST_VARS['username']);
          $password = tep_db_prepare_input($HTTP_POST_VARS['password']);

          tep_db_query('insert into ' . TABLE_ADMINISTRATORS . ' (user_name, user_password) values ("' . $username . '", "' . tep_encrypt_password($password) . '")');
        }

        tep_redirect(tep_href_link(FILENAME_LOGIN));

        break;
    }
  }

  $languages = tep_get_languages();
  $languages_array = array();
  $languages_selected = DEFAULT_LANGUAGE;
  for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $languages_array[] = array('id' => $languages[$i]['code'],
                               'text' => $languages[$i]['name']);
    if ($languages[$i]['directory'] == $language) {
      $languages_selected = $languages[$i]['code'];
    }
  }

  $admins_check_query = tep_db_query("select id from " . TABLE_ADMINISTRATORS . " limit 1");
  if (tep_db_num_rows($admins_check_query) < 1) {
    $messageStack->add(TEXT_CREATE_FIRST_ADMINISTRATOR, 'warning');
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<meta name="robots" content="noindex,nofollow">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body onLoad="SetFocus();">
<!-- header //-->
<div id="page">
      <div id="headerarea">
          <div style="background-image:url(images/bgBeforeMenuLeft.jpg); width:15px; height:54px; float:left"></div>
          <div style="background-image:url(images/bgBeforeMenuRight.jpg); width:15px; height:54px; float:right;"></div>
          
       	  <div style="background-image:url(images/logo.jpg); height:54px; width:147px; margin-left:15px;"></div>
        <div style="font-family:Tahoma; font-size:11px; color:#CCC; width:150px; position:absolute; right:0; top:15px;"><?php echo (tep_session_is_registered('admin') ? 'Logado com: ' . $admin['username']  . ' (<a href="' . tep_href_link(FILENAME_LOGIN, 'action=logoff') . '" class="headerLink">sair</a>)' : ''); ?></div>
        <div style="font-family:Tahoma; font-size:11px; color:#CCC; width:90px; position:absolute; right:0; top:37px;">Versão:3.0V</div>  	
              <div style="clear:both"></div>		
          </div>
      
      <?php
              if ($messageStack->size > 0) {
                echo $messageStack->output();
              }
            ?>
    
    <div class="content" style="height:400px;">
   		<div style="width:500px; height:150px; margin:0 auto; margin-top:80px;">
        	<table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
              <td width="22%" rowspan="2"><img src="images/icon_acessorestrito.jpg" /></td>
                <td width="78%" class="pageHeading"><?php echo HEADING_TITLE; ?></td>
              </tr>
              <tr>
              <td style="text-align:left">
                  <?php
                      $heading = array();
                      $contents = array();
                      if (tep_db_num_rows($admins_check_query) > 0) {
                        $contents = array('form' => tep_draw_form('login', FILENAME_LOGIN, 'action=process'));
                        $contents[] = array('text' => 
						'<table width="200" border="0" cellspacing="2" cellpadding="2">
						  <tr>
							<td>'.TEXT_USERNAME.'</td>
							<td>'. TEXT_PASSWORD . '</td>
							<td>&nbsp;</td>
						  </tr>
						  <tr>
							<td>' . tep_draw_input_field('username').'</td>
							<td>' . tep_draw_password_field('password').'</td>
							<td><input type="submit" value="' . BUTTON_LOGIN . '" /></td>
						  </tr>
						</table>');
                      } else {
                        $heading[] = array('text' => '<b>' . HEADING_TITLE . '</b>');
                    
                        $contents = array('form' => tep_draw_form('login', FILENAME_LOGIN, 'action=create'));
                        $contents[] = array('text' => TEXT_CREATE_FIRST_ADMINISTRATOR);
                        $contents[] = array('text' => '<br>' . TEXT_USERNAME . '<br>' . tep_draw_input_field('username'));
                        $contents[] = array('text' => '<br>' . TEXT_PASSWORD . '<br>' . tep_draw_password_field('password'));
                        $contents[] = array('align' => 'left', 'text' => '<br><input type="submit" value="' . BUTTON_CREATE_ADMINISTRATOR . '" />');
                      }
                    
                      $box = new box;
                      echo $box->infoBox($heading, $contents);
                    ?>
                </td>
              </tr>
            </table>
        </div>
    </div>
    <div id="spacer">
    &copy; <?=date("Y")?> - <a href="http://www.brim.com.br" target="_blank" style="font-size: 11px; color:#06C; font-family:Tahoma; text-decoration:underline; ">Brim Sistemas Ltda</a>.  Todos os diretos reservados<br />
  </div>
</div>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>