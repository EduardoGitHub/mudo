<?php
/*
  $Id: info_shopping_cart.php,v 1.19 2003/02/13 03:01:48 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require("includes/application_top.php");

  $navigation->remove_current_page();

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_INFO_SHOPPING_CART);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel=stylesheet href=stylesheet.css>
</head>
<body >



  <table cellspacing=0 cellpadding=0 width=100%>
   <tr><td valign=top align=center>
    <table cellspacing=0 cellpadding=0 width=392 align=center>
     <tr><td><img src=images/m40.gif width=190 height=98 border=0></td>
     <td valign=top style="padding-left: 105px; padding-top: 35px; "><a class=ml8 href="javascript:window.close();"><?php echo TEXT_CLOSE_WINDOW; ?></a></td></tr>
    </table>
   </td></tr>
   <tr><td bgcolor=#0B0B0B height=2></td></tr>
   <tr><td align=center valign=top>
    <table cellspacing=0 cellpadding=0 width=392 align=center>
     <tr><td height=19></td></tr>
     <tr><td class=ch12><b>Visitors Cart  /  Members Cart</b></td></tr>
     <tr><td height=4></td></tr>
     <tr><td background=images/m41.gif height=1></td></tr>
     <tr><td height=20></td></tr>
     <tr><td class=ch14><b>Visitors Cart</b></td></tr>
     <tr><td>
<p class="main" ><b><?php echo HEADING_TITLE; ?></b><br><?php echo tep_draw_separator(); ?></p>
<p class="main" ><b><i><?php echo SUB_HEADING_TITLE_1; ?></i></b><br><?php echo SUB_HEADING_TEXT_1; ?></p>
<p class="main" ><b><i><?php echo SUB_HEADING_TITLE_2; ?></i></b><br><?php echo SUB_HEADING_TEXT_2; ?></p>
<p class="main" ><b><i><?php echo SUB_HEADING_TITLE_3; ?></i></b><br><?php echo SUB_HEADING_TEXT_3; ?></p>
<p align="right" class="main"><a href="javascript:window.close();"><?php echo TEXT_CLOSE_WINDOW; ?></a></p>           

     </td></tr>
     <tr><td height=7></td></tr>
     <tr><td height=25></td></tr>
    </table>
   </td></tr>
   <tr><td bgcolor=#0B0B0B height=2></td></tr>
   <tr><td height=16></td></tr>
   <tr><td align=center class=ch15>Copyright &copy; Companyname 2006. All Rights Reserved</td></tr>
   <tr><td height=20></td></tr>
  </table>




</html>
<?php
  require("includes/counter.php");
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>