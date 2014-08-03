<?php
/*
 * ot_discount_coupon.php
 * August 4, 2006
 * author: Kristen G. Thorson
 * ot_discount_coupon_codes version 3.0
 *
 * 
 * Released under the GNU General Public License
 * 
 */

  define('MODULE_ORDER_TOTAL_DISCOUNT_COUPON_TITLE', 'Cupom de Desconto');
  define('MODULE_ORDER_TOTAL_DISCOUNT_COUPON_TAX_NOT_APPLIED', 'Taxa não aplicada');
/*
Use this to define how the order total line will display on the order confirmation, invoice, etc.
You can insert variables to have dynamic data display.
Variables:
[code]
[coupon_desc]
[discount_amount]
[min_order]
[number_available]
[tax_desc]
*/
  define('MODULE_ORDER_TOTAL_DISCOUNT_COUPON_DISPLAY_FILE', 'Cupom de desconto [code] aplicado');
  define('MODULE_ORDER_TOTAL_DISCOUNT_COUPON_TEXT_SHIPPING_DISCOUNT', 'off shipping');
?>
