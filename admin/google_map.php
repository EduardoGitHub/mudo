<?php

/*
  Google Delivery Maps V1.0.2
  
  This program is free software; you can redistribute it and/or modify it under the terms
  of the GNU General Public License as published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
  without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
  See the GNU General Public License for more details.
  
  This program requires interface with the Google Maps API and your usage of this program must 
  comply with the terms of the Google API.
*/

require('includes/application_top.php');

// get orderID
$order = $HTTP_GET_VARS['oID']; 

// get delivery information
		$order_query = tep_db_query("select delivery_name, delivery_company, delivery_street_address, billing_street_number, delivery_city, delivery_state, delivery_postcode from orders where orders_id = $order");
		$order_info = tep_db_fetch_array($order_query);

// build name/company and full address
$deliveryName = $order_info[delivery_name] . ", " . $order_info[delivery_company];
//$deliveryAddress = $order_info[delivery_street_address] . ", " . $order_info[delivery_city] . ", " . $order_info[delivery_state] . ", " . $order_info[delivery_postcode];
$deliveryAddress = $order_info[delivery_street_address] . ", " . $order_info[billing_street_number]." ".$order_info[delivery_city];

// hardcoded start address (couldn't pull from configuration)
$storeAddress = GOOGLE_STORE_STREET_ADDRESS . ' ' . GOOGLE_STORE_CITY . ' ' . GOOGLE_STORE_STATE . ' ' . GOOGLE_STORE_POSTCODE . ' ' . GOOGLE_STORE_COUNTRY;


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
	<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo GOOGLE_MAP_API_KEY; ?>" type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[
    var map;
    var gdir;
    var geocoder = null;
    var addressMarker;
	
	// define variable from PHP and bring into JS
	var	storeAddress = "<?php echo $storeAddress ?>";
	var	deliveryAddress = "<?php echo $deliveryAddress ?>";
	var	deliveryName = "<?php echo $deliveryName ?>";
	

    function initialize() {
      if (GBrowserIsCompatible()) {	
		//build map
			map = new GMap2(document.getElementById("map_canvas"));
    	    gdir = new GDirections(map, document.getElementById("directions"));
			GEvent.addListener(gdir, "load", onGDirectionsLoad);
        	GEvent.addListener(gdir, "error", handleErrors);
			map.addControl(new GSmallMapControl());
			map.addControl(new GMapTypeControl());
			setDirections(storeAddress, deliveryAddress, "pt-BR");
   		 }
    }
	   

    function setDirections(fromAddress, toAddress, locale) {
      gdir.load("from: " + fromAddress + " to: " + toAddress,
                { "locale": locale });
    }

    function handleErrors(){
	   if (gdir.getStatus().code == G_GEO_UNKNOWN_ADDRESS)
	     alert("No corresponding geographic location could be found for one of the specified addresses. This may be due to the fact that the address is relatively new, or it may be incorrect.\nError code: " + gdir.getStatus().code);
	   else if (gdir.getStatus().code == G_GEO_SERVER_ERROR)
	     alert("A geocoding or directions request could not be successfully processed, yet the exact reason for the failure is not known.\n Error code: " + gdir.getStatus().code);
	   
	   else if (gdir.getStatus().code == G_GEO_MISSING_QUERY)
	     alert("The HTTP q parameter was either missing or had no value. For geocoder requests, this means that an empty address was specified as input. For directions requests, this means that no query was specified in the input.\n Error code: " + gdir.getStatus().code);

	//   else if (gdir.getStatus().code == G_UNAVAILABLE_ADDRESS)  <--- Doc bug... this is either not defined, or Doc is wrong
	//     alert("The geocode for the given address or the route for the given directions query cannot be returned due to legal or contractual reasons.\n Error code: " + gdir.getStatus().code);
	     
	   else if (gdir.getStatus().code == G_GEO_BAD_KEY)
	     alert("The given key is either invalid or does not match the domain for which it was given. \n Error code: " + gdir.getStatus().code);

	   else if (gdir.getStatus().code == G_GEO_BAD_REQUEST)
	     alert("A directions request could not be successfully parsed.\n Error code: " + gdir.getStatus().code);
	    
	   else alert("An unknown error occurred.");
	   
	}

	function onGDirectionsLoad(){ 
      // Use this function to access information about the latest load()
      // results.

      // e.g.
      // document.getElementById("getStatus").innerHTML = gdir.getStatus().code;
	  // and yada yada yada...
	}
    </script>

  </head>
  
  
  
  <body onLoad="initialize()" onUnload="GUnload()" style="background-color:#FFF; background-image:none;">
<table width="710">
 <tr> 
 <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
</tr>
</table>
<table width="710">
				<tr>
<td width="134" class="dataTableHeadingContent"></td> 
<br /><tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="left"><?php echo HEADING_TITLE_SEARCH; ?></td>
                <td width="564" align="left" class="dataTableHeadingContent"><?php echo $order ?></td>
				</tr>
				<tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_CUSTOMER; ?></td>
                <td class="dataTableHeadingContent" align="left"><?php echo $deliveryName ?></td>
              </tr>
			  <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
  </table>
  <form action="#" onSubmit="setDirections(this.from.value, this.to.value, this.locale.value); return false">

  <table width="710">

   <tr><th width="134" align="right" class="smallText"><?php echo TABLE_HEADING_DELIVERY_FROM; ?>&nbsp;</th>

   <td colspan="2"><input type="text" size="60" id="fromAddress" name="from"
     value="<?php echo $storeAddress ?>"></td></tr>
   
   <tr><th align="right" class="smallText"><?php echo TABLE_HEADING_DELIVERY_TO; ?>&nbsp;</th>
   <td colspan="2"><input type="text" size="60" id="toAddress" name="to"
     value="<?php echo $deliveryAddress ?>"></td></tr>

   <tr><th align="right" class="smallText"><?php echo TABLE_HEADING_LANGUAGES; ?>&nbsp;</th>
   <td width="564" colspan=""><select id="locale" name="locale">
	<option value="pt" selected>Brasil</option>
    <option value="en">English</option>    
    </select>

    <input name="submit" type="submit" value="<?php echo IMAGE_GET_DIRECTIONS; ?>" />

   </td>
   <td>
   <script type="text/javascript">

	var message = "<?php echo IMAGE_PRINT_DIRECTIONS; ?>";

		function printpage() {
		window.print();  
		}

		document.write("<form><input type=button "
		+"value=\""+message+"\" onClick=\"printpage()\"></form>");

   </script>
   </tr>
   </table>

    
  </form>

    <br/>
    <table class="directions">
    <tr class="dataTableHeadingRow"><th width="300" class="dataTableHeadingContent"><?php echo TABLE_HEADING_FORMATTED_DIRECTIONS; ?></th>
    <th width="400" class="dataTableHeadingContent"><?php echo TABLE_HEADING_MAP; ?></th>
    </tr>
    <tr>
    <td valign="top"><div id="directions" style="width: 300px"></div></td>
    <td valign="top"><div id="map_canvas" style="width: 400px; height: 500px"></div></td>

    </tr>
    </table> 

  </body>
</html>
