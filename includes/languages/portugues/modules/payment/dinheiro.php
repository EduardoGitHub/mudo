<?php
/*
  $Id: moneyorder.php,v 1.6 2003/01/24 21:36:04 thomasamoulton Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_DINHEIRO_TEXT_TITLE', 'Dinheiro');
  define('MODULE_PAYMENT_DINHEIRO_TEXT_DESCRIPTION', 'Somente após o pagamento em dinheiro na loja é que poderá enviar ou retirar a mercadoria da loja. Segue abaixo o local onde deve ser feito o pagamento:<br><br>' . nl2br(STORE_NAME_ADDRESS));
  define('MODULE_PAYMENT_DINHEIRO_TEXT_EMAIL_FOOTER', "Somente após o pagamento em dinheiro na loja é que poderá enviar ou retirar a mercadoria da loja. Segue abaixo o local onde deve ser feito o pagamento: :\n\n" . STORE_NAME_ADDRESS );
?>
