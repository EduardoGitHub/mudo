<?php
/*
  $Id: form_check.js.php,v 1.9 2003/05/19 19:50:14 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<script language="javascript"><!--
var form = "";
var submitted = false;
var error = false;
var error_message = "";

function check_input(field_name, field_size, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value == '' || field_value.length < field_size) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_radio(field_name, message) {
  var isChecked = false;

  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var radio = form.elements[field_name];

    for (var i=0; i<radio.length; i++) {
      if (radio[i].checked == true) {
        isChecked = true;
        break;
      }
    }

    if (isChecked == false) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_select(field_name, field_default, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value == field_default) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_password(field_name_1, field_name_2, field_size, message_1, message_2) {
  if (form.elements[field_name_1] && (form.elements[field_name_1].type != "hidden")) {
    var password = form.elements[field_name_1].value;
    var confirmation = form.elements[field_name_2].value;

    if (password == '' || password.length < field_size) {
      error_message = error_message + "* " + message_1 + "\n";
      error = true;
    } else if (password != confirmation) {
      error_message = error_message + "* " + message_2 + "\n";
      error = true;
    }
  }
}

function check_password_new(field_name_1, field_name_2, field_name_3, field_size, message_1, message_2, message_3) {
  if (form.elements[field_name_1] && (form.elements[field_name_1].type != "hidden")) {
    var password_current = form.elements[field_name_1].value;
    var password_new = form.elements[field_name_2].value;
    var password_confirmation = form.elements[field_name_3].value;

    if (password_current == '' || password_current.length < field_size) {
      error_message = error_message + "* " + message_1 + "\n";
      error = true;
    } else if (password_new == '' || password_new.length < field_size) {
      error_message = error_message + "* " + message_2 + "\n";
      error = true;
    } else if (password_new != password_confirmation) {
      error_message = error_message + "* " + message_3 + "\n";
      error = true;
    }
  }
}

function check_form(form_name) {
  if (submitted == true) {
    alert("<?php echo JS_ERROR_SUBMITTED; ?>");
    return false;
  }

  error = false;
  form = form_name;
  error_message = "<?php echo JS_ERROR; ?>";
  
<?php if (ACCOUNT_GENDER == 'true') echo '  check_radio("gender", "' . ENTRY_GENDER_ERROR . '");' . "\n"; ?>

  check_input("firstname", <?php echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>, "<?php echo ENTRY_FIRST_NAME_ERROR; ?>");
  check_input("lastname", <?php echo ENTRY_LAST_NAME_MIN_LENGTH; ?>, "<?php echo ENTRY_LAST_NAME_ERROR; ?>");

<?php if (ACCOUNT_DOB == 'true') echo '  check_input("dob", ' . ENTRY_DOB_MIN_LENGTH . ', "' . ENTRY_DATE_OF_BIRTH_ERROR . '");' . "\n"; ?>

  check_input("email_address", <?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>, "<?php echo ENTRY_EMAIL_ADDRESS_ERROR; ?>");
  
  check_password("email_address", "email_address_confirmation", <?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>, "<?php echo ENTRY_EMAIL_ADDRESS_ERROR; ?>", "Os e-mails não conferem. Verifique se o e-mails esta digita corretamente.");
  
  check_input("street_address", <?php echo ENTRY_STREET_ADDRESS_MIN_LENGTH; ?>, "<?php echo ENTRY_STREET_ADDRESS_ERROR; ?>");
  check_input("street_number", <?php echo ENTRY_STREET_NUMBER_MIN_LENGTH; ?>, "<?php echo ENTRY_STREET_NUMBER_ERROR; ?>");
  check_input("cpf", <?php echo ENTRY_STREET_CPF_MIN_LENGTH; ?>, "<?php echo ENTRY_STREET_CPF_ERROR; ?>");
  check_input("rg", <?php echo ENTRY_STREET_RG_MIN_LENGTH; ?>, "<?php echo ENTRY_STREET_RG_ERROR; ?>");
  check_input("postcode", <?php echo ENTRY_POSTCODE_MIN_LENGTH; ?>, "<?php echo ENTRY_POST_CODE_ERROR; ?>");
  check_input("city", <?php echo ENTRY_CITY_MIN_LENGTH; ?>, "<?php echo ENTRY_CITY_ERROR; ?>");

<?php if (ACCOUNT_STATE == 'true') echo '  check_input("state", ' . ENTRY_STATE_MIN_LENGTH . ', "' . ENTRY_STATE_ERROR . '");' . "\n"; ?>

  check_select("country", "", "<?php echo ENTRY_COUNTRY_ERROR; ?>");

  check_input("telephone", <?php echo ENTRY_TELEPHONE_MIN_LENGTH; ?>, "<?php echo ENTRY_TELEPHONE_NUMBER_ERROR; ?>");

  check_password("password", "confirmation", <?php echo ENTRY_PASSWORD_MIN_LENGTH; ?>, "<?php echo ENTRY_PASSWORD_ERROR; ?>", "<?php echo ENTRY_PASSWORD_ERROR_NOT_MATCHING; ?>");
  check_password_new("password_current", "password_new", "password_confirmation", <?php echo ENTRY_PASSWORD_MIN_LENGTH; ?>, "<?php echo ENTRY_PASSWORD_ERROR; ?>", "<?php echo ENTRY_PASSWORD_NEW_ERROR; ?>", "<?php echo ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING; ?>");

  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}



function check_form2(form_name) {
  if (submitted == true) {
    alert("<?php echo JS_ERROR_SUBMITTED; ?>");
    return false;
  }

  error = false;
  form = form_name;
  error_message = "<?php echo JS_ERROR; ?>";
  

  check_input("firstname", <?php echo ENTRY_RAZAO_SOCIAL_MIN_LENGTH; ?>, "<?php echo ENTRY_RAZAO_SOCIAL_ERROR; ?>");
  check_input("lastname", <?php echo ENTRY_NOME_FANTASIA_MIN_LENGTH; ?>, "<?php echo ENTRY_NOME_FANTASIA_ERROR; ?>");
  check_input("email_address", <?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>, "<?php echo ENTRY_EMAIL_ADDRESS_ERROR; ?>");
  check_input("company", <?php echo ENTRY_RESPONSAVEL_MIN_LENGTH; ?>, "<?php echo ENTRY_RESPONSAVEL_ERROR; ?>");
  check_input("street_address", <?php echo ENTRY_STREET_ADDRESS_MIN_LENGTH; ?>, "<?php echo ENTRY_STREET_ADDRESS_ERROR; ?>");
  check_input("street_number", <?php echo ENTRY_STREET_NUMBER_MIN_LENGTH; ?>, "<?php echo ENTRY_STREET_NUMBER_ERROR; ?>");
  check_input("cpf", <?php echo ENTRY_CNPJ_MIN_LENGTH; ?>, "<?php echo ENTRY_CNPJ_ERROR; ?>");
  check_input("postcode", <?php echo ENTRY_POSTCODE_MIN_LENGTH; ?>, "<?php echo ENTRY_POST_CODE_ERROR; ?>");
  check_input("city", <?php echo ENTRY_CITY_MIN_LENGTH; ?>, "<?php echo ENTRY_CITY_ERROR; ?>");

<?php if (ACCOUNT_STATE == 'true') echo '  check_input("state", ' . ENTRY_STATE_MIN_LENGTH . ', "' . ENTRY_STATE_ERROR . '");' . "\n"; ?>

  check_select("country", "", "<?php echo ENTRY_COUNTRY_ERROR; ?>");

  check_input("telephone", <?php echo ENTRY_TELEPHONE_MIN_LENGTH; ?>, "<?php echo ENTRY_TELEPHONE2_NUMBER_ERROR; ?>");

  check_password("password", "confirmation", <?php echo ENTRY_PASSWORD_MIN_LENGTH; ?>, "<?php echo ENTRY_PASSWORD_ERROR; ?>", "<?php echo ENTRY_PASSWORD_ERROR_NOT_MATCHING; ?>");
  check_password_new("password_current", "password_new", "password_confirmation", <?php echo ENTRY_PASSWORD_MIN_LENGTH; ?>, "<?php echo ENTRY_PASSWORD_ERROR; ?>", "<?php echo ENTRY_PASSWORD_NEW_ERROR; ?>", "<?php echo ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING; ?>");

  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}

function MM_formtTelefone(e,src,mask) { 
    if(window.event) { _TXT = e.keyCode; } 
    else if(e.which) { _TXT = e.which; } 
    if(_TXT > 47 && _TXT < 58) { 
var i = src.value.length; var saida = mask.substring(0,1); var texto = mask.substring(i) 
if (texto.substring(0,1) != saida) { src.value += texto.substring(0,1); } 
    return true; } else { if (_TXT != 8) { return false; } 
else { return true; } 
    } 
}

function MM_formtCPF(e,src,mask) { 
    if(window.event) { _TXT = e.keyCode; } 
    else if(e.which) { _TXT = e.which; } 
    if(_TXT > 47 && _TXT < 58) { 
var i = src.value.length; var saida = mask.substring(0,1); var texto = mask.substring(i) 
if (texto.substring(0,1) != saida) { src.value += texto.substring(0,1); } 
    return true; } else { if (_TXT != 8) { return false; } 
else { return true; } 
    } 
}

function MM_formtCep(e,src,mask) {
    if(window.event) { _TXT = e.keyCode; }
    else if(e.which) { _TXT = e.which; }
    if(_TXT > 47 && _TXT < 58) {
var i = src.value.length; var saida = mask.substring(0,1); var texto = mask.substring(i)
if (texto.substring(0,1) != saida) { src.value += texto.substring(0,1); }
    return true; } else { if (_TXT != 8) { return false; }
else { return true; }
    }
}

function MM_formtdata(e,src,mask) {
    if(window.event) { _TXT = e.keyCode; }
    else if(e.which) { _TXT = e.which; }
    if(_TXT > 47 && _TXT < 58) {
var i = src.value.length; var saida = mask.substring(0,1); var texto = mask.substring(i)
if (texto.substring(0,1) != saida) { src.value += texto.substring(0,1); }
    return true; } else { if (_TXT != 8) { return false; }
else { return true; }
    }
}

function MM_formatacnpj(e,src,mask) {
    if(window.event) { _TXT = e.keyCode; }
    else if(e.which) { _TXT = e.which; }
    if(_TXT > 47 && _TXT < 58) {
var i = src.value.length; var saida = mask.substring(0,1); var texto = mask.substring(i)
if (texto.substring(0,1) != saida) { src.value += texto.substring(0,1); }
    return true; } else { if (_TXT != 8) { return false; }
else { return true; }
    }
}

function MM_formataie(e,src,mask) {
    if(window.event) { _TXT = e.keyCode; }
    else if(e.which) { _TXT = e.which; }
    if(_TXT > 47 && _TXT < 58) {
var i = src.value.length; var saida = mask.substring(0,1); var texto = mask.substring(i)
if (texto.substring(0,1) != saida) { src.value += texto.substring(0,1); }
    return true; } else { if (_TXT != 8) { return false; }
else { return true; }
    }
}

function check_inputEmail(field_name, message, message2)
{
  var field_value = form.elements[field_name].value;
  var txt = field_value;
  if ((txt.length != 0) && ((txt.indexOf("@") < 1) || (txt.indexOf('.') < 7)))
  {
    error_message = error_message + "* " + message + "\n";
	error = true;
  }else if (field_value == ''){
	error_message = error_message + "* " + message2 + "\n";
	error = true;
  }
}

function checkForm_budget(form_name) {
  if (submitted == true) {
    alert("<?php echo JS_ERROR_SUBMITTED; ?>");
    return false;
  }

  error = false;
  form = form_name;
  error_message = "<?php echo JS_ERROR; ?>";
  
  check_input("name", 3, "Informe o nome completo.");
  check_input("empresa", 3, "Infome corretamente o nome da empresa.");
  check_inputEmail("email", "E-mail incorreto, favor informar um e-mail valido.", "Informe seu e-mail.");
  check_input("telefone", 12, "Infome corretamente o telefone com o DDD.");
  check_input("estado", 2, "Infome o estado.");
  check_input("cidade", 3, "Infome a cidade.");
  check_radio("orcamento", "Infome o tipo de orçamento que deseja fazer.");
  

  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}




function SEDEX(URL){ 
   window.open(URL,"janela1","width=340,height=333,scrollbars=NO") 
}
//------------------------------------------------ FIM ---------------------------------------------//
function excuteAct(act){
//alert('Entrou');
var head = document.getElementsByTagName('head').item(0);
var eScript = document.createElement("script");
reg1 = document.getElementById('email').value;
eScript.setAttribute('src','putmailnewsletter.php?action='+act+'&email='+reg1);
head.appendChild(eScript);
}

function excuteAct2(act){
//alert('Entrou');
var head = document.getElementsByTagName('head').item(0);
var eScript = document.createElement("script");
reg1 = document.getElementById('email2').value;
eScript.setAttribute('src','putmailnewsletter.php?action='+act+'&email='+reg1);
head.appendChild(eScript);
}

//--></script>