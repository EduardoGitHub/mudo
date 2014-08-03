<?php
/*
 * coupons_exclusions.php
 * September 26, 2006
 * author: Kristen G. Thorson
 * ot_discount_coupon_codes version 3.0
 *
 *
 * Released under the GNU General Public License
 *
 */

define('HEADING_TITLE', 'Exclusões cupons de desconto para cupom %s');
define('HEADING_TITLE_VIEW_MANUAL', 'Clique aqui para ler o manual de ajuda do Cumpo de Desconto.');
if( isset( $HTTP_GET_VARS['type'] ) && $HTTP_GET_VARS['type'] != '' ) {
	switch( $HTTP_GET_VARS['type'] ) {
		//category exclusions
		case 'categories':
			$heading_available = 'Este cupom pode ser aplicada a produtos nestas categorias.';
			$heading_selected = 'Este desconto <b>não</b> pode ser aplicada a produtos nestas categorias.';
			break;
		//end category exclusions
		//manufacturer exclusions
		case 'manufacturers':
			$heading_available = 'Este cupom pode ser aplicada a produtos atribuídos a estes fabricantes.';
			$heading_selected = 'Este cupom <b>não</b> pode ser aplicada a produtos atribuídos a estes fabricantes.';
			break;
		//end manufacturer exclusions
    //customer exclusions
		case 'customers':
			$heading_available = 'Este cupom pode ser utilizado por estes clientes.';
			$heading_selected = 'Este cupom <b>não</b> pode ser utilizado por estes clientes.';
			break;
		//end customer exclusions
		//product exclusions
		case 'products':
      $heading_available = 'Este cupom pode ser aplicada a estes produtos.';
			$heading_selected = 'Este cupom <b>não</b> pode ser aplicada a estes produtos.';
			break;
		//end product exclusions
    //shipping zone exclusions
    case 'zones' :
      $heading_available = 'Este cupom pode ser usado para as zonas de entrega.';
      $heading_selected = 'Este cupom <b>não</b> pode ser usado para esta zona de entrega.';
      break;
    //end zone exclusions
	}
}
define('HEADING_AVAILABLE', $heading_available);
define('HEADING_SELECTED', $heading_selected);

define('MESSAGE_DISCOUNT_COUPONS_EXCLUSIONS_SAVED', 'Novas regras de exclusão salvas');

define('ERROR_DISCOUNT_COUPONS_NO_COUPON_CODE', 'Nenhum cupom selecionado' );
define('ERROR_DISCOUNT_COUPONS_INVALID_TYPE', 'Não é possível criar exclusões desse tipo.');
define('ERROR_DISCOUNT_COUPONS_SELECTED_LIST', 'Houve um erro ao determinar os já excluídos '.$HTTP_GET_VARS['type'].'.');
define('ERROR_DISCOUNT_COUPONS_ALL_LIST', 'Houve um erro ao determinar a disposição '.$HTTP_GET_VARS['type'].'.');
define('ERROR_DISCOUNT_COUPONS_SAVE', 'Erro ao salvar novas regras de exclusão.');

?>
