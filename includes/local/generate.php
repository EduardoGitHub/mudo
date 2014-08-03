<?php

/**
 * @author Dave Howarth
 * @copyright 2007 - 2008
 * @web http://www.box25.net
 * @email sales@box25.net
 *
 * @Filename generate.php
 * @Desc Tag Cloud Generator for osCommerce RC2.2
 */




// now generate the cloud and the value
function generateCloud() {

    global $languages_id;

    // initialise the cloud
    $cloud = new tagCloud();

    // initialise the return text
    $returnData = '';

    $data = tep_db_query("SELECT pd.products_name, pd.products_id from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_status = '1' and p.products_quantity > 0 order by rand() limit 8");

    // loop through the results, and build an array
    while($result = tep_db_fetch_array($data))
    {
        $data_create = $result['products_id'] . '|' . $result['products_name'];
        $cloud->addWord($data_create);
    }
    // predefine certain tag elements
    $tag_style = 'font-family:Tahoma; padding:4px 4px 4px 4px; letter-spacing:3px; text-decoration:none; font-weight:normal;';
      // no go through the array, and build the output
    $myCloud = $cloud->showCloud('array');
    if (is_array($myCloud))
    {
         foreach ($myCloud as $key => $value)
           {
            $size = randSize();
            $color = randColor();
             // split apart the data
            $data_raw = explode('|', $key);
			//Monta parametro produto
	  $name = str_replace(" ", "_", $data_raw[1]);
	  $novo_nome = strtoupper($name);
            $returnData .= ' <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . urlencode($data_raw[0])). '" style="' . $tag_style . 'font-size:' . $size . 'px; color:#' . $color . ';">'.$data_raw[1].'</a> ';

           }
    }

    return $returnData;
}

// quick function to generate a random text size
function randSize() {

    // create a random number between 8, and 24
    $css = rand(12,28);


    return $css;
}

// quick function to create a random six digit hex color code
function randColor() {

    $str1 = 'abcdef1234567890';
    $tail ='';

   for ($j=0; $j<6; ++$j)
   {
        $tail .= substr($str1,rand(0,15),1);
   }


    return $tail;

}
?>
