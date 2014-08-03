<?php
$TITLE = '';
$NAME = '';
$URL = '';

if (basename($_SERVER['PHP_SELF']) === FILENAME_PRODUCT_INFO)
{
  $NAME = htmlspecialchars($product_info['products_name'], ENT_QUOTES);
  $TITLE = $product_info['products_name'];
  $URL = StripSID(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product_info['products_id'], 'NONSSL', false ));
}
else if (! tep_not_null($TITLE) && isset($_GET['cPath']))
{
  $parts = explode("_", $_GET['cPath']);
  $category_id = $parts[count($parts) - 1];
  $category_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$languages_id . "'");
  $category = tep_db_fetch_array($category_query);
  $NAME = htmlspecialchars($category['categories_name'], ENT_QUOTES);
  $TITLE = $category['categories_name'];
  $URL = StripSID(tep_href_link(FILENAME_DEFAULT, 'cPath=' . $category_id , 'NONSSL', false ));
}
else 
  $URL = StripSID(tep_href_link(basename($_SERVER['PHP_SELF'])));
  
?>
<div class="socialDisplay">
<ul>
    <li><a rel="nofollow" target="_blank" href="http://del.icio.us/post?url=<?php echo $URL . '&title=' . $TITLE; ?>"><?php echo tep_image(DIR_WS_IMAGES . 'socialbookmark/delicious.png', 'Adicionar ' . $NAME . ' no del.icio.us'); ?></a></li>
    <li><a rel="nofollow" target="_blank" href="http://digg.com/submit?phase=2&url=<?php echo $URL . '&title=' . $TITLE; ?>"><?php echo tep_image(DIR_WS_IMAGES . 'socialbookmark/digg.png', 'Adicionar ' . $NAME . ' no Digg'); ?></a></li>
    <li><a rel="nofollow" target="_blank" href="http://ekstreme.com/socializer/?url=<?php echo $URL . '&title=' . $TITLE; ?>"><?php echo tep_image(DIR_WS_IMAGES . 'socialbookmark/Socializer16.png', 'Adicionar ' . $NAME . ' no Ekstreme'); ?></a></li>
    <li><a rel="nofollow" target="_blank" href="http://www.facebook.com/share.php?u=<?php echo $URL . '&title=' . $TITLE; ?>"><?php echo tep_image(DIR_WS_IMAGES . 'socialbookmark/facebook.png', 'Adicionar ' . $NAME . ' no Facebook'); ?></a></li>
    <li><a rel="nofollow" target="_blank" href="http://furl.net/snoreIt.jsp?t=<?php echo $URL . '&title=' . $TITLE; ?>"><?php echo tep_image(DIR_WS_IMAGES . 'socialbookmark/furl.png', 'Adicionar ' . $NAME . ' no Furl'); ?></a></li>
    <li><a rel="nofollow" target="_blank" href="http://www.google.com/bookmarks/mark?op=edit&bkmk=<?php echo $URL . '&title=' . $TITLE; ?>"><?php echo tep_image(DIR_WS_IMAGES . 'socialbookmark/google.png', 'Adicionar ' . $NAME . ' no Google'); ?></a></li>
    <li><a rel="nofollow" target="_blank" href="http://www.newsvine.com/_nools/seed&save?u==<?php echo $URL . '&h=' . $TITLE; ?>"><?php echo tep_image(DIR_WS_IMAGES . 'socialbookmark/newsvine.png', 'Adicionar ' . $NAME . ' no Newsvine'); ?></a></li>
    <li><a rel="nofollow" target="_blank" href="http://reddit.com/submit?url=<?php echo $URL . '&title=' . $TITLE; ?>"><?php echo tep_image(DIR_WS_IMAGES . 'socialbookmark/reddit.png', 'Adicionar ' . $NAME . ' no Reddit'); ?></a></li>
    <li><a rel="nofollow" target="_blank" href="http://technorati.com/cosmos/search.html?url=<?php echo $URL . '&title=' . $TITLE; ?>"><?php echo tep_image(DIR_WS_IMAGES . 'socialbookmark/technorati.png', 'Adicionar ' . $NAME . ' no Technorati'); ?></a></li>
    <li><a rel="nofollow" target="_blank" href="http://twitter.com/home?status=Check out <?php echo $URL . '&title=' . $TITLE; ?>"><?php echo tep_image(DIR_WS_IMAGES . 'socialbookmark/twitter.png', 'Adicionar ' . $NAME . ' no Twitter'); ?></a></li>
    <li><a rel="nofollow" target="_blank" href="http://myweb.yahoo.com/myresults/bookmarklet?u=<?php echo $URL . '&t=' . $TITLE; ?>"><?php echo tep_image(DIR_WS_IMAGES . 'socialbookmark/yahoo.png', 'Adicionar ' . $NAME . ' no Yahoo myWeb'); ?></a></li>
    <li><span style="font-family:Tahoma; font-size:10px; color:#CCC">(<a href="javascript:compartilhe('compartilhe.html');" style="font-family:Tahoma; font-size:10px; color:#CCC">O que é isto ?</a>)</span></li>
</ul>
</div>