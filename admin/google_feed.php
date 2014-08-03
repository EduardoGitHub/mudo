<?php
/*
  $Id: google_products.php,v 1.1 2011/06/28 by Kevin L. Shelton
  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// html entity name to ISO-8859-1 character code
$trans_table = array('&apos;' => '&#39;', '&nbsp;' => '&#160;', '&iexcl;' => '&#161;', '&cent;' => '&#162;', '&pound;' => '&#163;', '&curren;' => '&#164;', '&yen;' => '&#165;', '&brvbar;' => '&#166;', '&sect;' => '&#167;', '&uml;' => '&#168;', '&copy;' => '&#169;', '&ordf;' => '&#170;', '&laquo;' => '&#171;', '&not;' => '&#172;', '&shy;' => '&#173;', '&reg;' => '&#174;', '&macr;' => '&#175;', '&deg;' => '&#176;', '&plusmn;' => '&#177;', '&sup2;' => '&#178;', '&sup3;' => '&#179;', '&acute;' => '&#180;', '&micro;' => '&#181;', '&para;' => '&#182;', '&middot;' => '&#183;', '&cedil;' => '&#184;', '&sup1;' => '&#185;', '&ordm;' => '&#186;', '&raquo;' => '&#187;', '&frac14;' => '&#188;', '&frac12;' => '&#189;', '&frac34;' => '&#190;', '&iquest;' => '&#191;', '&Agrave;' => '&#192;', '&Aacute;' => '&#193;', '&Acirc;' => '&#194;', '&Atilde;' => '&#195;', '&Auml;' => '&#196;', '&Aring;' => '&#197;', '&AElig;' => '&#198;', '&Ccedil;' => '&#199;', '&Egrave;' => '&#200;', '&Eacute;' => '&#201;', '&Ecirc;' => '&#202;', '&Euml;' => '&#203;', '&Igrave;' => '&#204;', '&Iacute;' => '&#205;', '&Icirc;' => '&#206;', '&Iuml;' => '&#207;', '&ETH;' => '&#208;', '&Ntilde;' => '&#209;', '&Ograve;' => '&#210;', '&Oacute;' => '&#211;', '&Ocirc;' => '&#212;', '&Otilde;' => '&#213;', '&Ouml;' => '&#214;', '&times;' => '&#215;', '&Oslash;' => '&#216;', '&Ugrave;' => '&#217;', '&Uacute;' => '&#218;', '&Ucirc;' => '&#219;', '&Uuml;' => '&#220;', '&Yacute;' => '&#221;', '&THORN;' => '&#222;', '&szlig;' => '&#223;', '&agrave;' => '&#224;', '&aacute;' => '&#225;', '&acirc;' => '&#226;', '&atilde;' => '&#227;', '&auml;' => '&#228;', '&aring;' => '&#229;', '&aelig;' => '&#230;', '&ccedil;' => '&#231;', '&egrave;' => '&#232;', '&eacute;' => '&#233;', '&ecirc;' => '&#234;', '&euml;' => '&#235;', '&igrave;' => '&#236;', '&iacute;' => '&#237;', '&icirc;' => '&#238;', '&iuml;' => '&#239;', '&eth;' => '&#240;', '&ntilde;' => '&#241;', '&ograve;' => '&#242;', '&oacute;' => '&#243;', '&ocirc;' => '&#244;', '&otilde;' => '&#245;', '&ouml;' => '&#246;', '&divide;' => '&#247;', '&oslash;' => '&#248;', '&ugrave;' => '&#249;', '&uacute;' => '&#250;', '&ucirc;' => '&#251;', '&uuml;' => '&#252;', '&yacute;' => '&#253;', '&thorn;' => '&#254;', '&yuml;' => '&#255;', '&OElig;' => '&#338;', '&oelig;' => '&#339;', '&Scaron;' => '&#352;', '&scaron;' => '&#353;', '&Yuml;' => '&#376;', '&fnof;' => '&#402;', '&circ;' => '&#710;', '&tilde;' => '&#732;', '&Alpha;' => '&#913;', '&Beta;' => '&#914;', '&Gamma;' => '&#915;', '&Delta;' => '&#916;', '&Epsilon;' => '&#917;', '&Zeta;' => '&#918;', '&Eta;' => '&#919;', '&Theta;' => '&#920;', '&Iota;' => '&#921;', '&Kappa;' => '&#922;', '&Lambda;' => '&#923;', '&Mu;' => '&#924;', '&Nu;' => '&#925;', '&Xi;' => '&#926;', '&Omicron;' => '&#927;', '&Pi;' => '&#928;', '&Rho;' => '&#929;', '&Sigma;' => '&#931;', '&Tau;' => '&#932;', '&Upsilon;' => '&#933;', '&Phi;' => '&#934;', '&Chi;' => '&#935;', '&Psi;' => '&#936;', '&Omega;' => '&#937;', '&alpha;' => '&#945;', '&beta;' => '&#946;', '&gamma;' => '&#947;', '&delta;' => '&#948;', '&epsilon;' => '&#949;', '&zeta;' => '&#950;', '&eta;' => '&#951;', '&theta;' => '&#952;', '&iota;' => '&#953;', '&kappa;' => '&#954;', '&lambda;' => '&#955;', '&mu;' => '&#956;', '&nu;' => '&#957;', '&xi;' => '&#958;', '&omicron;' => '&#959;', '&pi;' => '&#960;', '&rho;' => '&#961;', '&sigmaf;' => '&#962;', '&sigma;' => '&#963;', '&tau;' => '&#964;', '&upsilon;' => '&#965;', '&phi;' => '&#966;', '&chi;' => '&#967;', '&psi;' => '&#968;', '&omega;' => '&#969;', '&thetasym;' => '&#977;', '&upsih;' => '&#978;', '&piv;' => '&#982;', '&ensp;' => '&#8194;', '&emsp;' => '&#8195;', '&thinsp;' => '&#8201;', '&zwnj;' => '&#8204;', '&zwj;' => '&#8205;', '&lrm;' => '&#8206;', '&rlm;' => '&#8207;', '&ndash;' => '&#8211;', '&mdash;' => '&#8212;', '&lsquo;' => '&#8216;', '&rsquo;' => '&#8217;', '&sbquo;' => '&#8218;', '&ldquo;' => '&#8220;', '&rdquo;' => '&#8221;', '&bdquo;' => '&#8222;', '&dagger;' => '&#8224;', '&Dagger;' => '&#8225;', '&bull;' => '&#8226;', '&hellip;' => '&#8230;', '&permil;' => '&#8240;', '&prime;' => '&#8242;', '&Prime;' => '&#8243;', '&lsaquo;' => '&#8249;', '&rsaquo;' => '&#8250;', '&oline;' => '&#8254;', '&frasl;' => '&#8260;', '&euro;' => '&#8364;', '&image;' => '&#8465;', '&weierp;' => '&#8472;', '&real;' => '&#8476;', '&trade;' => '&#8482;', '&alefsym;' => '&#8501;', '&larr;' => '&#8592;', '&uarr;' => '&#8593;', '&rarr;' => '&#8594;', '&darr;' => '&#8595;', '&harr;' => '&#8596;', '&crarr;' => '&#8629;', '&lArr;' => '&#8656;', '&uArr;' => '&#8657;', '&rArr;' => '&#8658;', '&dArr;' => '&#8659;', '&hArr;' => '&#8660;', '&forall;' => '&#8704;', '&part;' => '&#8706;', '&exist;' => '&#8707;', '&empty;' => '&#8709;', '&nabla;' => '&#8711;', '&isin;' => '&#8712;', '&notin;' => '&#8713;', '&ni;' => '&#8715;', '&prod;' => '&#8719;', '&sum;' => '&#8721;', '&minus;' => '&#8722;', '&lowast;' => '&#8727;', '&radic;' => '&#8730;', '&prop;' => '&#8733;', '&infin;' => '&#8734;', '&ang;' => '&#8736;', '&and;' => '&#8743;', '&or;' => '&#8744;', '&cap;' => '&#8745;', '&cup;' => '&#8746;', '&int;' => '&#8747;', '&there4;' => '&#8756;', '&sim;' => '&#8764;', '&cong;' => '&#8773;', '&asymp;' => '&#8776;', '&ne;' => '&#8800;', '&equiv;' => '&#8801;', '&le;' => '&#8804;', '&ge;' => '&#8805;', '&sub;' => '&#8834;', '&sup;' => '&#8835;', '&nsub;' => '&#8836;', '&sube;' => '&#8838;', '&supe;' => '&#8839;', '&oplus;' => '&#8853;', '&otimes;' => '&#8855;', '&perp;' => '&#8869;', '&sdot;' => '&#8901;', '&lceil;' => '&#8968;', '&rceil;' => '&#8969;', '&lfloor;' => '&#8970;', '&rfloor;' => '&#8971;', '&lang;' => '&#9001;', '&rang;' => '&#9002;', '&loz;' => '&#9674;', '&spades;' => '&#9824;', '&clubs;' => '&#9827;', '&hearts;' => '&#9829;', '&diams;' => '&#9830;');
$translate_from = array();
$translate_to = array();
foreach ($trans_table as $entity => $code) {
  $translate_from[] = $entity;
  $translate_to[] = $code;
}
// the following characters that might be found in the database must be translated since converting directly to the character code causes a feed error
$chars_for_coding = array(chr(32) . chr(28) => '&ldquo;', chr(32) . chr(29) => '&rdquo;', chr(32) . chr(24) => '&lsquo;', chr(32) . chr(25) => '&rsquo;', chr(128) => '&euro;', chr(130) => '&bsquo;', chr(131) => '&fnof;', chr(132) => '&bdquo;', chr(133) => '&hellip;', chr(134) => '&dagger;', chr(135) => '&Dagger;', chr(136) => '&circ;', chr(137) => '&permil;', chr(138) => '&Scaron;', chr(139) => '&lsaquo;', chr(140) => '&OElig;', chr(145) => '&lsquo;', chr(146) => '&rsquo;', chr(147) => '&ldquo;', chr(148) => '&rdquo;', chr(149) => '&bull;', chr(150) => '&ndash;', chr(151) => '&mdash;', chr(152) => '&tilde;', chr(153) => '&trade;', chr(154) => '&scaron;', chr(155) => '&rsaquo;', chr(156) => '&oelig;', chr(159) => '&Yuml;');
$from_char = array();
$char_code = array();
foreach ($chars_for_coding as $char => $entity) {
  $from_char[] = $char;
  $char_code[] = $entity;
}

function create_text_description($str, $length = 9997) {
	// Strip HTML and Truncate to create a META description, Google doesn't care about META tags.
	$base_str = simple_strip_tags($str);
	$description = truncate_string($base_str, $length);
	if (strlen($base_str) > strlen($description)) {
		$description .= "...";
	}
	return tep_output_string($description);
}
function simple_strip_tags($str) {
// Strip HTML Tags function
  global $translate_from, $translate_to, $from_char, $char_code;
  $str = str_replace($from_char, $char_code, $str);
	$untagged = "";
	$skippingtag = false;
	for ($i = 0; $i < strlen($str); $i++) {
		if ($skippingtag) {
			if ($str[$i] == ">") {
				$untagged .= " ";
				$skippingtag = false;
			}
		} else {
			if ($str[$i] == "<") {
				$skippingtag = true;
			} elseif ($str[$i] <= " ") {
				$untagged .= " ";
		  } elseif ($str[$i] == '>') {
		    $untagged .= '&gt;';
		  } elseif ($str[$i] == '"') {
		    $untagged .= '&quot;';
		  } elseif ($str[$i] == '&') {
		    $x = $i + 1;
		    while (preg_match("/[A-Za-z0-9#]/", $str[$x])) $x++; // skip characters found in entity tags
		    if ($str[$x] == ';') { // found html entity
		      $untagged .= '&';
		    } else { // found ampersand
		      $untagged .= '&amp;';
		    }
		  } elseif ($str[$i] > '~') { // convert character to entity
		    $untagged .= '&#' . ord($str[$i]) . ';';
			} else {
				$untagged .= $str[$i];
			}
		}
	}
	$untagged = preg_replace("/[\n\r\t\s ]+/i", " ", $untagged); // remove multiple spaces, returns, tabs, etc.
	$untagged = trim($untagged); // remove space from beginning & end of string
	$untagged = str_replace($translate_from, $translate_to, $untagged);
	return $untagged;
}

function truncate_string($string, $length = 70)
// This function will truncate a string to a specified length.
{
  if (strlen($string) > $length) {
	$split = preg_split("/\n/", wordwrap($string, $length));
	return ($split[0]);
  }
  return ($string);
}
// Return all subcategory IDs
  function get_subcategories(&$subcategories_array, $parent_id = 0) {
    $subcategories_query = tep_db_query("select categories_id from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$parent_id . "'");
    while ($subcategories = tep_db_fetch_array($subcategories_query)) {
      $subcategories_array[] = $subcategories['categories_id'];
      if ($subcategories['categories_id'] != $parent_id) {
        get_subcategories($subcategories_array, $subcategories['categories_id']);
      }
    }
  }

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'process':
        $condition = tep_db_prepare_input($HTTP_POST_VARS['condition']);
        if (!in_array($condition, array('new', 'used', 'refurbished'))) $condition = 'new';
        break;
    }
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv=Content-Type content="text/html; charset=<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <link rel=stylesheet type=text/css href="includes/stylesheet.css">
    <script language=javascript src="includes/general.js"></script>
  </head>

  <body marginwidth=0 marginheight=0 topmargin=0 bottommargin=0 leftmargin=0 rightmargin=0 bgcolor=#FFFFFF>
    <!-- header //--><?php require(DIR_WS_INCLUDES . 'header.php'); ?><!-- header_eof //--><!-- body //-->
    <table border=0 width=100% cellspacing=2 cellpadding=2>
      <tr>

        <!-- body_text //-->
        <?php if ($action == 'process') {
        ?>
        <td width="100%" valign="top" id="main"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
            <tr>
              <td width=100% class="main"><br>
              <b>ID &rarr; Name</b><br>
            <?php
//create Googl products listing feed
$xml_head = '<?xml version="1.0"?>
<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">
<channel>' . "\n";
$xml_head .= '<title>' . simple_strip_tags(STORE_NAME) . "</title>\n";
$xml_head .= '<link>' .  DIR_WS_CATALOG . "</link>\n";
$xml_head .= '<description>' . simple_strip_tags('O Mudo Minha Casa oferece todo tipo de adesivo de parede para compor qualquer ambiente. Deixe sua casa mais bonita e com a sua cara. Compre seu adesivo!') . "</description>\n";
$xml_head .= '<pubDate>' . date('r') . "</pubDate>\n";
$xml_foot = "</channel>
</rss>";
$sm = DIR_FS_CATALOG . 'google_product_feed.xml';
$fh = fopen($sm, 'w') or die(ERROR_PRODUCTS_FILE);
fwrite($fh, $xml_head);
$cnt = 0;
// check for existance of hidden categories
$hidehiddencatprods = (!defined('HIDE_HIDDEN_CAT_PRODS') || (HIDE_HIDDEN_CAT_PRODS == 'true'));
$hiddencats = array();
$check_query = tep_db_query("select * from " . TABLE_CATEGORIES); // look for category status variables
$check = tep_db_fetch_array($check_query);
if (isset($check['status_categ'])) { // skips if this is not set to avoid SQL error
  $hcquery = tep_db_query("select categories_id from " . TABLE_CATEGORIES . " where status_categ = 0");
  while ($cat = tep_db_fetch_array($hcquery)) {// build array of hidden categories and their subcategories
    $hiddencats[] = $cat['categories_id'];
    get_subcategories($hiddencats, $cat['categories_id']);
  }
} elseif (isset($check['categories_status'])) { // skips if this is not set to avoid SQL error
  $hcquery = tep_db_query("select categories_id from " . TABLE_CATEGORIES . " where categories_status = 0");
  while ($cat = tep_db_fetch_array($hcquery)) {// build array of hidden categories and their subcategories
    $hiddencats[] = $cat['categories_id'];
    get_subcategories($hiddencats, $cat['categories_id']);
  }
}
if ($hidehiddencatprods && !empty($hiddencats)) { // if products found only in hidden categories should be hidden and hidden categories exist
  $query = tep_db_query("select p.products_id, if(products_last_modified > products_date_added, products_last_modified, products_date_added) as rev_date, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, p.products_price, m.manufacturers_name,  p.products_weight, p.products_date_available from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on m.manufacturers_id = p.manufacturers_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where products_status = 1 and pd.products_id = p.products_id and pd.language_id = " . (int)$languages_id . " and p.products_id = p2c.products_id and (not (p2c.categories_id in (" . implode(',', $hiddencats) . "))) group by p2c.products_id order by rev_date desc");
} else {
  $query = tep_db_query("select p.products_id, if(products_last_modified > products_date_added, products_last_modified, products_date_added) as rev_date, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, p.products_price, m.manufacturers_name, p.products_weight, p.products_date_available from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on m.manufacturers_id = p.manufacturers_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd where products_status = 1 and pd.products_id = p.products_id and pd.language_id = " . (int)$languages_id . " order by rev_date desc");
}
while($product = tep_db_fetch_array($query)) { // list all in stock items that aren't hidden
  $output = "<item>\n";
  $output .= "<g:id>" . $product['products_id'] . "</g:id>\n";
  $output .= '<title>' . simple_strip_tags($product['products_name']) . "</title>\n";
  $url = tep_catalog_href_link("product_info.php", "products_id=" . $product['products_id']); // url to the product page
  $output .= '<link>'. $url . "</link>\n";
  $output .= '<g:price>' . $product['products_price'] . "</g:price>\n";
  $output .= '<g:brand>mudominhacasa'."</g:brand>\n";
  $output .= '<g:identifier_exists>true'."</g:identifier_exists>\n";
  $output .= '<g:google_product_category>Adesivos'."</g:google_product_category>\n";
  $output .= '<g:product_type>Adesivos'."</g:product_type>\n";
  
  $output .= '<description>' . create_text_description($product['products_description']) . "</description>\n";
  $output .= '<g:condition>new'."</g:condition>\n";
  $output .= '<g:mpn>' . $product['products_id'] . "</g:mpn>\n";
  //$output .= '<g:mpn>' . simple_strip_tags($product['products_model']) . "</g:mpn>\n";
  if (tep_not_null($product['products_image'])) {
    $output .= '<g:image_link>' . DIR_WS_CATALOG_IMAGES . rawurlencode($product['products_image']) . "</g:image_link>\n";
  }
  if (($product['products_date_available'] == '') || ($product['products_date_available'] == '0000-00-00 00:00:00') || (($product['products_date_available'] != '') && ($product['products_date_available'] != '0000-00-00 00:00:00') && ($product['products_date_available'] < date('Y-m-d H:i:s')))) {
    $output .= '<g:quantity>' . $product['products_quantity'] . "</g:quantity>\n";
    if ($product['products_quantity'] < 1) {
      $output .= "<g:availability>out of stock</g:availability>\n";
    } elseif ($product['products_quantity'] < 6) {
      $output .= "<g:availability>limited availability</g:availability>\n";
    } else {
      $output .= "<g:availability>in stock</g:availability>\n";
    }
  } else { // if date available is set and greater than today then not assume not in stock
    $output .= "<g:quantity>0</g:quantity>\n<g:availability>out of stock</g:availability>\n";
  }
  $output .= '<g:manufacturer>' . simple_strip_tags($product['manufacturers_name']) . "</g:manufacturer>\n";
  $output .= '<g:shipping_weight>' . $product['products_weight'] . " pounds</g:shipping_weight>\n"; // osCommerce 2 shipping modules assume the weight is in pounds
  $sale_query = tep_db_query("select * from " . TABLE_SPECIALS . " where products_id = '" . (int)$product['products_id'] . "' and status order by specials_new_products_price");
  if (tep_db_num_rows($sale_query) > 0) { // product is on sale
    $sale = tep_db_fetch_array($sale_query);
    $output .= '<g:sale_price>' . $sale['specials_new_products_price'] . "</g:sale_price>\n";
    if (($sale['begins_date'] != '') && ($sale['begins_date'] != '0000-00-00 00:00:00')) {
      $begin = $sale['begins_date'];
    } else { // if beginning date not available set it to now
      $begin = date('Y-m-d H:i:s');
    }
    $begin = str_replace(' ', 'T', $begin);
    if (($sale['expires_date'] != '') && ($sale['expires_date'] != '0000-00-00 00:00:00')) {
      $end = $sale['expires_date'];
    } else { // if no ending date set it to 10 years from now
      $end = (date('Y') + 10) . date('-m-d H:i:s');
    }
    $end = str_replace(' ', 'T', $end);
    $output .= '<g:sale_price_effective_date>' . $begin . 'Z/' . $end . "Z</g:sale_price_effective_date>\n";
  }
  $output .= "</item>\n";
  echo $product['products_id'] . ' &rarr; ' . $product['products_name'] .'<br>';
	fwrite($fh, $output);
	$cnt++;
}
fwrite($fh, $xml_foot);
fclose($fh); 
echo '<br><b>' . $cnt . TEXT_TOTAL_PRODUCTS . '</b>';
?>
              </td>
            </tr>
          </table>
        </td>
        <?php
        } else { // not processing, show initial page
        ?>
        <td width=100% valign=top>
          <table border=0 width=100% cellspacing=0 cellpadding=2>
            <tr>
              <td width=100%>
                <table border=0 width=100% cellspacing=0 cellpadding=0>
                  <tr>
                    <td class=pageHeading><?php echo HEADING_TITLE; ?></td>
                    <td class=pageHeading align=right><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
                  </tr>
                  <tr><td><br></td></tr>
                  <tr>
                    <td class=main><?php echo tep_draw_form('preparation', FILENAME_GOOGLE_FEED, 'selected_box=tools&action=process');
          $condition = array('new' => TEXT_NEW,
                        'used' => TEXT_USED,
                        'refurbished' => TEXT_REFURB); ?>
                      <table border=0 width=100% cellspacing=1 cellpadding=2>
                        <tr>
                          <td class=main><?php echo TEXT_CHOOSE_CONDITION; ?></td>
                        </tr>
                        <tr>
                          <td class=main><?php
            foreach ($condition as $name => $text) {
              echo tep_draw_radio_field('condition', $name, ($name == 'new'));
              echo $text.'<br>'; } ?></td>
                        </tr>
                      </table>
                      <p><?php echo tep_draw_input_field('submit','','',false,'submit'); 
         echo TEXT_CREATE_XML .'</form><p>'; ?></p>
                    </td>
                    <td></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <?php } // end else on if action is process
        ?>
      </tr>
    </table>
    </td><!-- body_text_eof //--></tr></table><!-- body_eof //--><!-- footer //--><?php require(DIR_WS_INCLUDES . 'footer.php'); ?><!-- footer_eof //-->
  </body>

</html>

<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
