<?php
/*

  braspress.php 16/06/2005

  Módulo de Envio osCommerce 2.2 para Transportadora Braspress.

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License

*/


  class braspress {
    var $code, $title, $description, $icon, $enabled;

// class constructor
    function braspress() {
      $this->code = 'braspress';
      $this->title = MODULE_SHIPPING_BRASPRESS_TEXT_TITLE;
      $this->description = MODULE_SHIPPING_BRASPRESS_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_SHIPPING_BRASPRESS_SORT_ORDER;
      $this->icon = '';
      $this->enabled = MODULE_SHIPPING_BRASPRESS_STATUS;
    }

// class methods
    function selection() {
     $selection_string = '<table border="0" cellspacing="0" cellpadding="0" width="100%">' . "\n" .
                          '  <tr>' . "\n" .
                          '    <td class="main">&nbsp;' . MODULE_SHIPPING_BRASPRESS_TEXT_TITLE . '&nbsp;</td>' . "\n" .
                          '    <td align="right" class="main">&nbsp;' . tep_draw_checkbox_field('shipping_quote_braspress', '1', true) . '&nbsp;</td>' . "\n" .
                          '  </tr>' . "\n" .
                          '</table>' . "\n";

      return $selection_string;
    }


    function quote($method = '') {
      global $cart, $shipping_quoted, $address_values, $shipping_weight, $shipping_braspress_cost, $shipping_braspress_method, $order;

      $shipping_quoted = 'braspress';
      $cep= str_replace ("-", "", $order->delivery['postcode']);
      $cep= str_replace (".", "", $cep);
      $subtotal = $order->info['subtotal'];
      $braspress_cost= 0;

      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA1);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA1;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA1;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA1;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA2);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA2;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA2;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA2;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA3);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA3;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA3;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA3;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA4);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA4;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA4;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA4;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA5);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA5;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA5;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA5;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA6);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA6;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA6;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA6;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA7);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA7;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA7;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA7;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA8);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA8;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA8;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA8;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA9);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA9;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA9;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA9;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA10);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA10;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA10;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA10;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA11);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA11;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA11;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA11;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA12);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA12;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA12;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA12;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA13);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA13;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA13;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA13;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA14);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA14;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA14;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA14;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA15);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA15;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA15;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA15;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA16);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA16;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA16;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA16;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA17);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA17;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA17;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA17;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA18);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA18;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA18;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA18;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA19);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA19;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA19;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA19;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA20);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA20;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA20;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA20;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA21);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA21;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA21;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA21;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA22);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA22;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA22;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA22;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA23);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA23;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA23;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA23;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA24);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA24;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA24;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA24;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA25);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA25;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA25;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA25;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA26);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA26;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA26;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA26;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA27);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA27;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA27;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA27;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA28);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA28;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA28;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA28;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA29);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA29;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA29;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA29;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA30);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA30;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA30;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA30;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA31);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA31;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA31;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA31;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA32);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA32;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA32;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA32;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA33);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA33;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA33;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA33;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA34);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA34;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA34;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA34;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA35);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA35;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA35;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA35;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA36);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA36;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA36;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA36;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA37);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA37;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA37;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA37;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA38);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA38;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA38;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA38;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA39);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA39;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA39;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA39;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA40);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA40;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA40;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA40;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA41);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA41;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA41;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA41;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA42);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA42;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA42;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA42;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA43);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA43;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA43;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA43;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA44);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA44;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA44;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA44;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA45);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA45;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA45;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA45;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA46);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA46;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA46;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA46;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA47);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA47;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA47;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA47;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA48);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA48;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA48;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA48;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA49);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA49;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA49;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA49;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA50);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA50;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA50;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA50;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA51);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA51;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA51;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA51;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA52);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA52;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA52;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA52;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA53);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA53;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA53;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA53;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA54);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA54;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA54;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA54;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA55);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA55;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA55;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA55;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA56);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA56;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA56;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA56;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA57);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA57;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA57;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA57;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA58);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA58;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA58;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA58;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA59);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA59;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA59;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA59;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA60);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA60;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA60;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA60;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA61);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA61;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA61;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA61;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA62);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA62;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA62;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA62;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA63);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA63;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA63;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA63;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA64);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA64;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA64;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA64;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA65);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA65;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA65;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA65;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA66);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA66;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA66;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA66;}
      $braspress_CEP = split("[:]" , MODULE_SHIPPING_BRASPRESS_CEP_ZONA67);
            if (($cep >= $braspress_CEP[0]) && ($cep <= $braspress_CEP[1])) {
          $braspress_cost = MODULE_SHIPPING_BRASPRESS_ZONA67;
          $braspress_fv = MODULE_FV_BRASPRESS_ZONA67;
          $braspress_extras = MODULE_EXTRAS_BRASPRESS_ZONA67;}

        $braspress_table = split("[:,]" , $braspress_cost);

        $shipping = $braspress_table[count($braspress_table)-1];
        $shipping_braspress_method = $shipping_weight . ' kg';

        for ($i = 0; $i < count($braspress_table); $i+=2) {
          if ($shipping_weight <= $braspress_table[$i]){
            $shipping = $braspress_table[$i+1];
            break;
          }
        }

      if($order->delivery['state'] == "Santa Catarina") {
          $icms = 0.83;
      } else if(($order->delivery['state'] == "Parana") || ($order->delivery['state'] == "Rio Grande do Sul") || ($order->delivery['state'] == "Sao Paulo") || ($order->delivery['state'] == "Rio de Janeiro") || ($order->delivery['state'] == "Espirito Santo") || ($order->delivery['state'] == "Minas Gerais") || ($order->delivery['state'] == "Goias") || ($order->delivery['state'] == "Distrito Federal")) {
          $icms = 0.88;
      } else {
          $icms = 0.93;
      }

      if (($braspress_cost) && ($shipping_weight <= 1000) && ($shipping_weight >= 25)) {
          $shipping_braspress_cost = (($shipping * MODULE_SHIPPING_BRASPRESS_HANDLING) + ($subtotal * $braspress_fv) + $braspress_extras) / $icms;
            $this->quotes = array('id' => $this->code,
                          'module' => MODULE_SHIPPING_BRASPRESS_TEXT_TITLE,
                            'methods' => array(array('id' => $this->code,
                                                     'title' => $shipping_braspress_method,
                                                     'cost' => $shipping_braspress_cost)));
        return $this->quotes;

      } else {
        return false;
      }
     }

    function cheapest() {
      global $shipping_count, $shipping_cheapest, $shipping_cheapest_cost, $shipping_braspress_cost;

      if ( ($GLOBALS['shipping_quote_all'] == '1') || ($GLOBALS['shipping_quote_braspress'] == '1') ) {
        if ($shipping_count == 0) {
          $shipping_cheapest = 'braspress';
          $shipping_cheapest_cost = $shipping_braspress_cost;
        } else {
          if ($shipping_braspress_cost < $shipping_cheapest_cost) {
            $shipping_cheapest = 'braspress';
            $shipping_cheapest_cost = $shipping_braspress_cost;
          }
        }
        $shipping_count++;
      }
    }

    function display() {
      global $HTTP_GET_VARS, $address_values, $currencies, $shipping_cheapest, $shipping_braspress_method, $shipping_braspress_cost, $shipping_selected;

// set a global for the radio field (auto select cheapest shipping method)
      if (!$HTTP_GET_VARS['shipping_selected']) $shipping_selected = $shipping_cheapest;

      if ( ($GLOBALS['shipping_quote_all'] == '1') || ($GLOBALS['shipping_quote_braspress'] == '1') ) {
        $display_string = '<table border="0" width="100%" cellspacing="0" cellpadding="0">' . "\n" .
                          '  <tr>' . "\n" .
                          '    <td class="main">&nbsp;&nbsp;' . MODULE_SHIPPING_BRASPRESS_TEXT_TITLE . ' <small><i>(' . $shipping_braspress_method . ')</i></small>&nbsp;</td>' . "\n" .
                          '    <td align="right" class="main">&nbsp;' . $currencies->format($shipping_braspress_cost);
        if (tep_count_shipping_modules() > 1) {
          $display_string .= '&nbsp;&nbsp;' . tep_draw_radio_field('shipping_selected', 'braspress') .
                                              tep_draw_hidden_field('shipping_braspress_cost', $shipping_braspress_cost) .
                                              tep_draw_hidden_field('shipping_braspress_method', $shipping_braspress_method) . '&nbsp;</td>' . "\n";
        } else {
          $display_string .= '&nbsp;&nbsp;' . tep_draw_hidden_field('shipping_selected', 'braspress') .
                                              tep_draw_hidden_field('shipping_braspress_cost', $shipping_braspress_cost) .
                                              tep_draw_hidden_field('shipping_braspress_method', $shipping_braspress_method) . '&nbsp;</td>' . "\n";
        }
        $display_string .= '  </tr>' . "\n" .
                           '</table>' . "\n";
      }

      return $display_string;
    }

    function confirm() {
      global $HTTP_POST_VARS, $shipping_cost, $shipping_method;

      if ($HTTP_POST_VARS['shipping_selected'] == 'braspress') {
        $shipping_cost = $HTTP_POST_VARS['shipping_braspress_cost'];
        $shipping_method = $HTTP_POST_VARS['shipping_braspress_method'];
      }
    }

    function check() {
      $check = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_STATUS'");
      $check = tep_db_num_rows($check);

      return $check;
    }

    function install() {
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Habilitar Sedex', 'MODULE_SHIPPING_BRASPRESS_STATUS', 'Sim', 'Habilitar Transportadora? (0=NÃO 1=SIM)?', '6', '0', 'tep_cfg_select_option(array(\'Sim\', \'Não\'), ', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 01 (AC Interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA1', '69921000:69999999', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 01 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA1', '10:103.08,20:147.26,35:207.85,50:277.19,70:360.26,85:437.96,100:515.66,115:593.36,130:671.06,145:748.76,160:826.46,175:904.16,190:981.86,205:1059.56,220:1137.26,235:1214.96,250:1292.66', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA1', '0.0257', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA1', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 02 (AC Capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA2', '69900000:69920999', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 02 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA2', '10:68.72,20:98.17,35:138.57,50:184.79,70:240.18,85:291.78,100:343.38,115:394.98,130:446.58,145:498.18,160:549.78,175:601.38,190:652.98,205:704.58,220:756.18,235:807.78,250:859.38', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA2', '0.0126', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA2', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 03 (AL Interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA3', '57100000:57999999', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 03 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA3', '10:55.05,20:78.71,35:111.07,50:148.16,70:192.51,85:233.91,100:275.31,115:316.71,130:358.11,145:399.51,160:440.91,175:482.31,190:523.71,205:565.11,220:606.51,235:647.91,250:689.31', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA3', '0.011', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA3', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 04 (AL Capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA4', '57000000:57099999', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 04 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA4', '10:42.35,20:60.54,35:85.44,50:113.94,70:148.07,85:179.87,100:211.67,115:243.47,130:275.27,145:307.07,160:338.87,175:370.67,190:402.47,205:434.27,220:466.07,235:497.87,250:529.67', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA4', '0.01', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA4', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 05 (AM Interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA5', '69100000:69299999', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 05 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA5', '10:93.71,20:133.88,35:188.96,50:252.00,70:327.51,85:397.71,100:467.91,115:538.11,130:608.31,145:678.51,160:748.71,175:818.91,190:889.11,205:959.31,220:1029.51,235:1099.71,250:1169.91', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA5', '0.0257', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA5', '18.56', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 06 (AM Interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA6', '69400000:69899999', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 06 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA6', '10:93.71,20:133.88,35:188.96,50:252.00,70:327.51,85:397.71,100:467.91,115:538.11,130:608.31,145:678.51,160:748.71,175:818.91,190:889.11,205:959.31,220:1029.51,235:1099.71,250:1169.91', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA6', '0.0257', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA6', '18.56', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 07 (AM Capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA7', '69000000:69099999', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 07 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA7', '10:62.47,20:89.24,35:125.96,50:167.99,70:218.34,85:264.99,100:311.64,115:358.29,130:404.94,145:451.59,160:498.24,175:544.89,190:591.54,205:638.19,220:684.84,235:731.49,250:778.14', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA7', '0.0115', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA7', '18.56', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 08 (AP Interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA8', '68910000:68999999', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 08 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA8', '10:104.46,20:149.23,35:210.64,50:280.92,70:365.08,85:443.53,100:521.98,115:600.43,130:678.88,145:757.33,160:835.78,175:914.23,190:992.68,205:1071.13,220:1149.58,235:1228.03,250:1306.48', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA8', '0.0186', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA8', '18.56', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 09 (AP Capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA9', '68900000:68909999', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 09 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA9', '10:94.97,20:135.66,35:191.49,50:255.39,70:331.88,85:403.13,100:474.38,115:545.63,130:616.88,145:688.13,160:759.38,175:830.63,190:901.88,205:973.13,220:1044.38,235:1115.63,250:1186.88', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA9', '0.0176', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA9', '18.56', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 10 (BA Interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA10', '42500000:48999999', 'Listagem da sigla dos estados que compõem esta zona.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 10 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA10', '10:50.04,20:71.52,35:100.89,50:134.58,70:174.91,85:212.41,100:249.91,115:287.41,130:324.91,145:362.41,160:399.91,175:437.41,190:474.91,205:512.41,220:549.91,235:587.41,250:624.91', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA10', '0.011', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA10', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 11 (BA capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA11', '40000000:42499999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 11 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA11', '10:38.49,20:55.00,35:77.61,50:103.52,70:134.56,85:163.51,100:192.46,115:221.41,130:250.36,145:279.31,160:308.26,175:337.21,190:366.16,205:395.11,220:424.06,235:453.01,250:481.96', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA11', '0.01', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA11', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 12 (CE interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA12', '61600000:63999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 12 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA12', '10:60.80,20:86.84,35:122.59,50:163.48,70:212.48,85:258.38,100:304.28,115:350.18,130:396.08,145:441.98,160:487.88,175:533.78,190:579.68,205:625.58,220:671.48,235:717.38,250:763.28', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA12', '0.012', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA12', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 13 (CE capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA13', '60000000:61599999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 13 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA13', '10:46.77,20:66.81,35:94.30,50:125.76,70:163.45,85:193.28,100:223.11,115:252.94,130:282.77,145:312.60,160:342.43,175:372.26,190:402.09,205:431.92,220:461.75,235:491.58,250:521.41', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA13', '0.011', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA13', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 14 (DF interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA14', '70640000:70699999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 14 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA14', '10:38.70,20:43.97,35:52.76,50:58.03,70:75.44,85:92.09,100:108.74,115:125.39,130:142.04,145:158.69,160:175.34,175:191.99,190:208.64,205:225.29,220:241.94,235:258.59,250:275.24', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA14', '0.009', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA14', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 15 (DF interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA15', '71000000:72799999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 15 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA15', '10:38.70,20:43.97,35:52.76,50:58.03,70:75.44,85:92.09,100:108.74,115:125.39,130:142.04,145:158.69,160:175.34,175:191.99,190:208.64,205:225.29,220:241.94,235:258.59,250:275.24', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA15', '0.009', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA15', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 16 (DF interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA16', '73000000:73699999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 16 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA16', '10:38.70,20:43.97,35:52.76,50:58.03,70:75.44,85:92.09,100:108.74,115:125.39,130:142.04,145:158.69,160:175.34,175:191.99,190:208.64,205:225.29,220:241.94,235:258.59,250:275.24', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA16', '0.009', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA16', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 17 (DF capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA17', '70000000:70639999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 17 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA17', '10:38.70,20:43.97,35:52.76,50:58.03,70:75.44,85:92.09,100:108.74,115:125.39,130:142.04,145:158.69,160:175.34,175:191.99,190:208.64,205:225.29,220:241.94,235:258.59,250:275.24', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA17', '0.009', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA17', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 18 (DF capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA18', '70700000:70999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 18 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA18', '10:38.70,20:43.97,35:52.76,50:58.03,70:75.44,85:92.09,100:108.74,115:125.39,130:142.04,145:158.69,160:175.34,175:191.99,190:208.64,205:225.29,220:241.94,235:258.59,250:275.24', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA18', '0.009', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA18', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 19 (ES interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA19', '29100000:29999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 19 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA19', '10:35.17,20:38.70,35:46.41,50:52.76,70:68.58,85:84.03,100:99.48,115:114.93,130:130.38,145:145.83,160:161.28,175:176.73,190:192.18,205:207.63,220:223.08,235:238.53,250:253.98', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA19', '0.0085', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA19', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 20 (ES capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA20', '29000000:29099999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 20 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA20', '10:35.17,20:38.70,35:46.41,50:52.76,70:68.58,85:84.03,100:99.48,115:114.93,130:130.38,145:145.83,160:161.28,175:176.73,190:192.18,205:207.63,220:223.08,235:238.53,250:253.98', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA20', '0.0085', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA20', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 21 (GO interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA21', '72800000:72999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 21 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA21', '10:35.17,20:38.70,35:46.41,50:52.76,70:68.58,85:84.03,100:99.48,115:114.93,130:130.38,145:145.83,160:161.28,175:176.73,190:192.18,205:207.63,220:223.08,235:238.53,250:253.98', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA21', '0.009', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA21', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 22 (GO interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA22', '73700000:73999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 22 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA22', '10:35.17,20:38.70,35:46.41,50:52.76,70:68.58,85:84.03,100:99.48,115:114.93,130:130.38,145:145.83,160:161.28,175:176.73,190:192.18,205:207.63,220:223.08,235:238.53,250:253.98', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA22', '0.009', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA22', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 23 (GO interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA23', '74895000:76799999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 23 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA23', '10:35.17,20:38.70,35:46.41,50:52.76,70:68.58,85:84.03,100:99.48,115:114.93,130:130.38,145:145.83,160:161.28,175:176.73,190:192.18,205:207.63,220:223.08,235:238.53,250:253.98', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA23', '0.009', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA23', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 24 (GO capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA24', '74000000:74894999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 24 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA24', '10:35.17,20:38.70,35:46.41,50:52.76,70:68.58,85:84.03,100:99.48,115:114.93,130:130.38,145:145.83,160:161.28,175:176.73,190:192.18,205:207.63,220:223.08,235:238.53,250:253.98', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA24', '0.009', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA24', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 25 (MA interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA25', '65100000:65999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 25 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA25', '10:81.22,20:116.02,35:163.75,50:218.40,70:283.85,85:344.75,100:405.65,115:466.55,130:527.45,145:588.35,160:649.25,175:710.15,190:771.05,205:831.95,220:892.85,235:953.75,250:1014.65', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA25', '0.0125', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA25', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 26 (MA capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA26', '65000000:65099999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 26 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA26', '10:62.47,20:89.24,35:125.96,50:167.99,70:218.34,85:264.99,100:311.64,115:358.29,130:404.94,145:451.59,160:498.24,175:544.89,190:591.54,205:638.19,220:684.84,235:731.49,250:778.14', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA26', '0.0115', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA26', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 27 (MG interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA27', '32000000:39999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 27 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA27', '10:29.90,20:33.39,35:40.10,50:43.97,70:57.15,85:70.35,100:83.55,115:96.75,130:109.95,145:123.15,160:136.35,175:149.55,190:162.75,205:175.95,220:189.15,235:202.35,250:215.55', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA27', '0.0085', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA27', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 28 (MG capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA28', '30000000:31999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 28 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA28', '10:29.90,20:33.39,35:40.10,50:43.97,70:57.15,85:70.35,100:83.55,115:96.75,130:109.95,145:123.15,160:136.35,175:149.55,190:162.75,205:175.95,220:189.15,235:202.35,250:215.55'    , 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA28', '0.0085', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA28', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 29 (MS interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA29', '79125000:79999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 29 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA29', '10:35.17,20:38.70,35:46.41,50:52.76,70:68.58,85:84.03,100:99.48,115:114.93,130:130.38,145:145.83,160:161.28,175:176.73,190:192.18,205:207.63,220:223.08,235:238.53,250:253.98', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA29', '0.009', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA29', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 30 (MS capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA30', '79000000:79124999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 30 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA30', '10:35.17,20:38.70,35:46.41,50:52.76,70:68.58,85:84.03,100:99.48,115:114.93,130:130.38,145:145.83,160:161.28,175:176.73,190:192.18,205:207.63,220:223.08,235:238.53,250:253.98', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA30', '0.009', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA30', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 31 (MT interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA31', '78100000:78899999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 31 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA31', '10:48.53,20:53.38,35:64.04,50:72.80,70:94.64,85:116.39,100:138.14,115:159.89,130:181.64,145:203.39,160:225.14,175:246.89,190:268.64,205:290.39,220:312.14,235:333.89,250:355.64', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA31', '0.0105', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA31', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 32 (MT capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA32', '78000000:78099999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 32 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA32', '10:40.45,20:44.49,35:53.38,50:60.66,70:78.86,85:97.31,100:115.76,115:134.21,130:152.66,145:171.11,160:189.56,175:208.01,190:226.46,205:244.91,220:263.36,235:281.81,250:300.26', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA32', '0.0095', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA32', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 33 (PA interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA33', '67000000:68899999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 33 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA33', '10:86.34,20:123.32,35:174.08,50:232.17,70:301.72,85:366.52,100:431.32,115:496.12,130:560.92,145:625.72,160:690.52,175:755.32,190:820.12,205:884.92,220:949.72,235:1014.52,250:1079.32', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA33', '0.0166', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA33', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 34 (PA capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA34', '66000000:66999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 34 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA34', '10:62.47,20:89.24,35:125.96,50:167.99,70:218.34,85:264.99,100:311.64,115:358.29,130:404.94,145:451.59,160:498.24,175:544.89,190:591.54,205:638.19,220:684.84,235:731.49,250:778.14', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA34', '0.0115', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA34', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 35 (PB interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA35', '58100000:58999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 35 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA35', '10:58.12,20:83.01,35:117.16,50:156.24,70:203.08,85:246.88,100:290.68,115:334.48,130:378.28,145:422.08,160:465.88,175:509.68,190:553.48,205:597.28,220:641.08,235:684.88,250:728.68', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA35', '0.0115', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA35', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 36 (PB capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA36', '58000000:58099999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 36 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA36', '10:44.70,20:63.86,35:90.12,50:120.20,70:156.22,85:189.67,100:223.12,115:256.57,130:290.02,145:323.47,160:356.92,175:390.37,190:423.82,205:457.27,220:490.72,235:524.17,250:557.62', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA36', '0.0105', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA36', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 37 (PE interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA37', '53000000:56999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 37 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA37', '10:57.12,20:81.57,35:115.14,50:153.55,70:199.55,85:242.15,100:284.75,115:327.35,130:369.95,145:412.55,160:455.15,175:497.75,190:540.35,205:582.95,220:625.55,235:668.15,250:710.75', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA37', '0.011', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA37', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 38 (PE capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA38', '50000000:52999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 38 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA38', '10:43.92,20:62.75,35:88.56,50:118.12,70:153.50,85:186.50,100:219.50,115:252.50,130:285.50,145:318.50,160:351.50,175:384.50,190:417.50,205:450.50,220:483.50,235:516.50,250:549.50', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA38', '0.01', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA38', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 39 (PI interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA39', '64100000:64999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 39 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA39', '10:75.09,20:107.29,35:151.42,50:201.94,70:262.48,85:318.88,100:375.28,115:431.68,130:488.08,145:544.48,160:600.88,175:657.28,190:713.68,205:770.08,220:826.48,235:882.88,250:939.28', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA39', '0.0125', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA39', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 40 (PI capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA40', '64000000:64099999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 40 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA40', '10:57.77,20:82.53,35:116.49,50:155.36,70:201.90,85:245.25,100:288.60,115:331.95,130:375.30,145:418.65,160:462.00,175:505.35,190:548.70,205:592.05,220:635.40,235:678.75,250:722.10', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA40', '0.0115', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA40', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 41 (PR interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA41', '83150000:83319999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 41 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA41', '10:21.11,20:24.63,35:29.54,50:35.17,70:45.71,85:56.21,100:66.71,115:77.21,130:87.71,145:98.21,160:108.71,175:119.21,190:129.71,205:140.21,220:150.71,235:161.21,250:171.71', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA41', '0.0065', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA41', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 42 (PR interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA42', '83350000:83399999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 42 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA42', '10:21.11,20:24.63,35:29.54,50:35.17,70:45.71,85:56.21,100:66.71,115:77.21,130:87.71,145:98.21,160:108.71,175:119.21,190:129.71,205:140.21,220:150.71,235:161.21,250:171.71', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA42', '0.0065', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA42', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 43 (PR interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA43', '83416000:87999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 43 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA43', '10:21.11,20:24.63,35:29.54,50:35.17,70:45.71,85:56.21,100:66.71,115:77.21,130:87.71,145:98.21,160:108.71,175:119.21,190:129.71,205:140.21,220:150.71,235:161.21,250:171.71', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA43', '0.0065', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA43', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 44 (PR capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA44', '80000000:82999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 44 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA44', '10:21.11,20:24.63,35:29.54,50:35.17,70:45.71,85:56.21,100:66.71,115:77.21,130:87.71,145:98.21,160:108.71,175:119.21,190:129.71,205:140.21,220:150.71,235:161.21,250:171.71', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA44', '0.0065', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA44', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 45 (PR São José dos Pinhais)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA45', '83000000:83149999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 45 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA45', '10:21.11,20:24.63,35:29.54,50:35.17,70:45.71,85:56.21,100:66.71,115:77.21,130:87.71,145:98.21,160:108.71,175:119.21,190:129.71,205:140.21,220:150.71,235:161.21,250:171.71', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA45', '0.0065', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA45', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 46 (PR Pinhais)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA46', '83320000:83349999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 46 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA46', '10:21.11,20:24.63,35:29.54,50:35.17,70:45.71,85:56.21,100:66.71,115:77.21,130:87.71,145:98.21,160:108.71,175:119.21,190:129.71,205:140.21,220:150.71,235:161.21,250:171.71', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA46', '0.0065', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA46', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 47 (PR Colombo)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA47', '83400000:83415999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 47 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA47', '10:21.11,20:24.63,35:29.54,50:35.17,70:45.71,85:56.21,100:66.71,115:77.21,130:87.71,145:98.21,160:108.71,175:119.21,190:129.71,205:140.21,220:150.71,235:161.21,250:171.71', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA47', '0.0065', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA47', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 48 (RJ interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA48', '23800000:28999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 48 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA48', '10:29.90,20:33.39,35:40.10,50:43.97,70:57.15,85:70.35,100:83.55,115:96.75,130:109.95,145:123.15,160:136.35,175:149.55,190:162.75,205:175.95,220:189.15,235:202.35,250:215.55', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA48', '0.008', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA48', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 49 (RJ capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA49', '20000000:23799999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 49 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA49', '10:29.90,20:33.39,35:40.10,50:43.97,70:57.15,85:70.35,100:83.55,115:96.75,130:109.95,145:123.15,160:136.35,175:149.55,190:162.75,205:175.95,220:189.15,235:202.35,250:215.55', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA49', '0.008', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA49', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 50 (RN interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA50', '59150000:59999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 50 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA50', '10:59.77,20:85.43,35:120.56,50:160.78,70:208.96,85:253.51,100:298.06,115:342.61,130:387.16,145:431.71,160:476.26,175:520.81,190:565.36,205:609.91,220:654.46,235:699.01,250:743.56', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA50', '0.0115', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA50', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 51 (RN capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA51', '59000000:59149999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 51 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA51', '10:45.98,20:65.71,35:92.74,50:123.67,70:160.73,85:195.23,100:229.73,115:264.23,130:298.73,145:333.23,160:367.73,175:402.23,190:436.73,205:471.23,220:505.73,235:540.23,250:574.73', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA51', '0.0105', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA51', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 52 (RO interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA52', '78925000:78999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 52 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA52', '10:93.71,20:133.88,35:188.96,50:252.00,70:327.51,85:397.71,100:467.91,115:538.11,130:608.31,145:678.51,160:748.71,175:818.91,190:889.11,205:959.31,220:1029.51,235:1099.71,250:1169.91', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA52', '0.0257', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA52', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 53 (RO capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA53', '78900000:78924999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 53 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA53', '10:62.47,20:89.24,35:125.96,50:167.99,70:218.34,85:264.99,100:311.64,115:358.29,130:404.94,145:451.59,160:498.24,175:544.89,190:591.54,205:638.19,220:684.84,235:731.49,250:778.14', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA53', '0.0115', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA53', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 54 (RR interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA54', '69340000:69399999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 54 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA54', '10:113.95,20:162.79,35:229.80,50:306.46,70:398.28,85:483.93,100:569.58,115:655.23,130:740.88,145:826.53,160:912.18,175:997.83,190:1083.48,205:1169.13,220:1254.78,235:1340.43,250:1426.08', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA54', '0.0196', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA54', '18.56', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 55 (RR capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA55', '69300000:69339999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 55 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA55', '10:103.60,20:147.99,35:208.91,50:278.59,70:362.06,85:439.76,100:517.46,115:595.16,130:672.86,145:750.56,160:828.26,175:905.96,190:983.66,205:1061.36,220:1139.06,235:1216.76,250:1294.46', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA55', '0.0186', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA55', '18.56', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 56 (RS interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA56', '92000000:99999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 56 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA56', '10:21.11,20:24.63,35:29.54,50:35.17,70:45.71,85:56.21,100:66.71,115:77.21,130:87.71,145:98.21,160:108.71,175:119.21,190:129.71,205:140.21,220:150.71,235:161.21,250:171.71', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA56', '0.0065', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA56', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 57 (RS capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA57', '90000000:91999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 57 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA57', '10:21.11,20:24.63,35:29.54,50:35.17,70:45.71,85:56.21,100:66.71,115:77.21,130:87.71,145:98.21,160:108.71,175:119.21,190:129.71,205:140.21,220:150.71,235:161.21,250:171.71', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA57', '0.0065', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA57', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 58 (SC interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA58', '88100000:89999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 58 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA58', '10:17.60,20:21.11,35:25.32,50:31.66,70:41.15,85:50.15,100:59.15,115:68.15,130:77.15,145:86.15,160:95.15,190:113.15,205:122.15,220:131.15,235:140.15,250:149.15', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA58', '0.0055', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA58', '', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 59 (SC capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA59', '88000000:88099999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 59 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA59', '10:17.60,20:21.11,35:25.32,50:31.66,70:41.15,85:50.15,100:59.15,115:68.15,130:77.15,145:86.15,160:95.15,190:113.15,205:122.15,220:131.15,235:140.15,250:149.15', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA59', '0.0055', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA59', '', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 60 (SE interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA60', '49099000:49999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 60 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA60', '10:52.72,20:75.34,35:106.32,50:141.81,70:184.27,85:223.72,100:263.17,115:302.62,130:342.07,145:381.52,160:420.97,175:460.42,190:499.87,205:539.32,220:578.77,235:618.22,250:657.67', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA60', '0.011', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA60', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 61 (SE capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA61', '49000000:49098999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 61 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA61', '10:40.57,20:57.95,35:81.79,50:109.09,70:141.78,85:171.93,100:202.08,115:232.23,130:262.38,145:292.53,160:322.68,175:352.83,190:382.98,205:413.13,220:443.28,235:473.43,250:503.58', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA61', '0.01', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA61', '5.41', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 62 (SP interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA62', '06000000:07999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 62 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA62', '10:24.63,20:28.13,35:33.78,50:42.19,70:54.86,85:66.86,100:78.86,115:90.86,130:102.86,145:114.86,160:126.86,175:138.86,190:150.86,205:162.86,220:174.86,235:186.86,250:198.86', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA62', '0.007', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA62', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 63 (SP interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA63', '08500000:19999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 63 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA63', '10:24.63,20:28.13,35:33.78,50:42.19,70:54.86,85:66.86,100:78.86,115:90.86,130:102.86,145:114.86,160:126.86,175:138.86,190:150.86,205:162.86,220:174.86,235:186.86,250:198.86', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA63', '0.007', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA63', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 64 (SP capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA64', '01000000:05999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 64 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA64', '10:24.63,20:28.13,35:33.78,50:42.19,70:54.86,85:66.86,100:78.86,115:90.86,130:102.86,145:114.86,160:126.86,175:138.86,190:150.86,205:162.86,220:174.86,235:186.86,250:198.86', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA64', '0.007', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA64', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 65 (SP capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA65', '08000000:08499999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 65 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA65', '10:24.63,20:28.13,35:33.78,50:42.19,70:54.86,85:66.86,100:78.86,115:90.86,130:102.86,145:114.86,160:126.86,175:138.86,190:150.86,205:162.86,220:174.86,235:186.86,250:198.86', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA65', '0.007', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA65', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 66 (TO interior)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA66', '77250000:77999999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 66 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA66', '10:43.97,20:48.36,35:58.03,50:65.94,70:85.72,85:105.22,100:124.72,115:144.22,130:163.72,145:183.22,160:202.72,175:222.22,190:241.72,205:261.22,220:280.72,235:300.22,250:319.72', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA66', '0.0105', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA66', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 67 (TO capital)', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA67', '77000000:77249999', 'Faixa de CEP que compõe esta zona (sem \'-\').', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ZONA 67 (Tarifa)', 'MODULE_SHIPPING_BRASPRESS_ZONA67', '10:43.97,20:48.36,35:58.03,50:65.94,70:85.72,85:105.22,100:124.72,115:144.22,130:163.72,145:183.22,160:202.72,175:222.22,190:241.72,205:261.22,220:280.72,235:300.22,250:319.72', 'Tarifas para esta zona, baseadas no peso dos produtos através da forma peso:valor. Ex: 1:3.50,2:5.50,etc.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Frete Peso + Gris', 'MODULE_FV_BRASPRESS_ZONA67', '0.0105', 'Para cálculo de frete peso.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Extras', 'MODULE_EXTRAS_BRASPRESS_ZONA67', '3.28', 'Pedágios e outras tarifas.', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Forma de Envio', 'MODULE_SHIPPING_BRASPRESS_METODO', 'Convencional', 'Serviço a ser utilizado na remessa', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Taxa adicional ao frete (Handling Fee)', 'MODULE_SHIPPING_BRASPRESS_HANDLING', '0', 'Valor fixo a ser acrescido ao valor do frete (Handling Fee)', '6', '0', now())");

     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SHIPPING_BRASPRESS_SORT_ORDER', '0', 'Sort order of display.', '6', '0', now())");

    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_STATUS'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA1'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA2'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA3'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA4'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA5'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA6'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA7'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA8'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA9'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA10'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA11'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA12'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA13'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA14'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA15'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA16'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA17'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA18'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA19'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA20'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA21'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA22'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA23'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA24'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA25'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA26'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA27'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA28'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA29'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA30'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA31'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA32'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA33'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA34'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA35'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA36'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA37'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA38'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA39'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA40'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA41'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA42'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA43'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA44'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA45'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA46'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA47'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA48'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA49'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA50'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA51'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA52'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA53'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA54'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA55'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA56'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA57'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA58'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA59'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA60'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA61'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA62'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA63'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA64'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA65'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA66'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_ZONA67'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA1'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA2'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA3'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA4'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA5'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA6'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA7'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA8'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA9'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA10'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA11'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA12'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA13'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA14'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA15'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA16'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA17'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA18'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA19'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA20'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA21'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA22'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA23'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA24'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA25'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA26'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA27'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA28'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA29'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA30'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA31'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA32'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA33'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA34'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA35'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA36'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA37'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA38'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA39'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA40'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA41'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA42'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA43'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA44'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA45'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA46'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA47'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA48'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA49'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA50'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA51'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA52'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA53'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA54'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA55'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA56'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA57'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA58'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA59'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA60'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA61'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA62'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA63'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA64'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA65'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA66'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_FV_BRASPRESS_ZONA67'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA1'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA2'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA3'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA4'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA5'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA6'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA7'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA8'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA9'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA10'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA11'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA12'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA13'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA14'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA15'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA16'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA17'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA18'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA19'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA20'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA21'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA22'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA23'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA24'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA25'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA26'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA27'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA28'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA29'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA30'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA31'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA32'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA33'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA34'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA35'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA36'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA37'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA38'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA39'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA40'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA41'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA42'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA43'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA44'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA45'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA46'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA47'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA48'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA49'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA50'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA51'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA52'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA53'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA54'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA55'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA56'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA57'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA58'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA59'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA60'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA61'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA62'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA63'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA64'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA65'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA66'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_EXTRAS_BRASPRESS_ZONA67'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA1'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA2'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA3'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA4'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA5'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA6'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA7'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA8'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA9'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA10'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA11'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA12'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA13'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA14'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA15'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA16'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA17'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA18'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA19'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA20'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA21'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA22'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA23'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA24'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA25'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA26'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA27'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA28'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA29'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA30'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA31'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA32'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA33'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA34'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA35'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA36'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA37'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA38'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA39'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA40'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA41'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA42'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA43'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA44'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA45'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA46'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA47'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA48'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA49'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA50'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA51'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA52'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA53'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA54'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA55'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA56'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA57'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA58'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA59'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA60'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA61'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA62'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA63'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA64'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA65'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA66'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA67'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_METODO'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_HANDLING'");
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_BRASPRESS_SORT_ORDER'");

    }

    function keys() {
      $keys = array('MODULE_SHIPPING_BRASPRESS_STATUS', 'MODULE_SHIPPING_BRASPRESS_METODO', 'MODULE_SHIPPING_BRASPRESS_HANDLING', 'MODULE_SHIPPING_BRASPRESS_ZONA1', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA1', 'MODULE_FV_BRASPRESS_ZONA1', 'MODULE_EXTRAS_BRASPRESS_ZONA1',
'MODULE_SHIPPING_BRASPRESS_ZONA2', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA2', 'MODULE_FV_BRASPRESS_ZONA2', 'MODULE_EXTRAS_BRASPRESS_ZONA2',
'MODULE_SHIPPING_BRASPRESS_ZONA3', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA3', 'MODULE_FV_BRASPRESS_ZONA3', 'MODULE_EXTRAS_BRASPRESS_ZONA3',
'MODULE_SHIPPING_BRASPRESS_ZONA4', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA4', 'MODULE_FV_BRASPRESS_ZONA4', 'MODULE_EXTRAS_BRASPRESS_ZONA4',
'MODULE_SHIPPING_BRASPRESS_ZONA5', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA5', 'MODULE_FV_BRASPRESS_ZONA5', 'MODULE_EXTRAS_BRASPRESS_ZONA5',
'MODULE_SHIPPING_BRASPRESS_ZONA6', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA6', 'MODULE_FV_BRASPRESS_ZONA6', 'MODULE_EXTRAS_BRASPRESS_ZONA6',
'MODULE_SHIPPING_BRASPRESS_ZONA7', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA7', 'MODULE_FV_BRASPRESS_ZONA7', 'MODULE_EXTRAS_BRASPRESS_ZONA7',
'MODULE_SHIPPING_BRASPRESS_ZONA8', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA8', 'MODULE_FV_BRASPRESS_ZONA8', 'MODULE_EXTRAS_BRASPRESS_ZONA8',
'MODULE_SHIPPING_BRASPRESS_ZONA9', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA9', 'MODULE_FV_BRASPRESS_ZONA9', 'MODULE_EXTRAS_BRASPRESS_ZONA9',
'MODULE_SHIPPING_BRASPRESS_ZONA10', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA10', 'MODULE_FV_BRASPRESS_ZONA10', 'MODULE_EXTRAS_BRASPRESS_ZONA10',
'MODULE_SHIPPING_BRASPRESS_ZONA11', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA11', 'MODULE_FV_BRASPRESS_ZONA11', 'MODULE_EXTRAS_BRASPRESS_ZONA11',
'MODULE_SHIPPING_BRASPRESS_ZONA12', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA12', 'MODULE_FV_BRASPRESS_ZONA12', 'MODULE_EXTRAS_BRASPRESS_ZONA12',
'MODULE_SHIPPING_BRASPRESS_ZONA13', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA13', 'MODULE_FV_BRASPRESS_ZONA13', 'MODULE_EXTRAS_BRASPRESS_ZONA13',
'MODULE_SHIPPING_BRASPRESS_ZONA14', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA14', 'MODULE_FV_BRASPRESS_ZONA14', 'MODULE_EXTRAS_BRASPRESS_ZONA14',
'MODULE_SHIPPING_BRASPRESS_ZONA15', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA15', 'MODULE_FV_BRASPRESS_ZONA15', 'MODULE_EXTRAS_BRASPRESS_ZONA15',
'MODULE_SHIPPING_BRASPRESS_ZONA16', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA16', 'MODULE_FV_BRASPRESS_ZONA16', 'MODULE_EXTRAS_BRASPRESS_ZONA16',
'MODULE_SHIPPING_BRASPRESS_ZONA17', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA17', 'MODULE_FV_BRASPRESS_ZONA17', 'MODULE_EXTRAS_BRASPRESS_ZONA17',
'MODULE_SHIPPING_BRASPRESS_ZONA18', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA18', 'MODULE_FV_BRASPRESS_ZONA18', 'MODULE_EXTRAS_BRASPRESS_ZONA18',
'MODULE_SHIPPING_BRASPRESS_ZONA19', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA19', 'MODULE_FV_BRASPRESS_ZONA19', 'MODULE_EXTRAS_BRASPRESS_ZONA19',
'MODULE_SHIPPING_BRASPRESS_ZONA20', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA20', 'MODULE_FV_BRASPRESS_ZONA20', 'MODULE_EXTRAS_BRASPRESS_ZONA20',
'MODULE_SHIPPING_BRASPRESS_ZONA21', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA21', 'MODULE_FV_BRASPRESS_ZONA21', 'MODULE_EXTRAS_BRASPRESS_ZONA21',
'MODULE_SHIPPING_BRASPRESS_ZONA22', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA22', 'MODULE_FV_BRASPRESS_ZONA22', 'MODULE_EXTRAS_BRASPRESS_ZONA22',
'MODULE_SHIPPING_BRASPRESS_ZONA23', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA23', 'MODULE_FV_BRASPRESS_ZONA23', 'MODULE_EXTRAS_BRASPRESS_ZONA23',
'MODULE_SHIPPING_BRASPRESS_ZONA24', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA24', 'MODULE_FV_BRASPRESS_ZONA24', 'MODULE_EXTRAS_BRASPRESS_ZONA24',
'MODULE_SHIPPING_BRASPRESS_ZONA25', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA25', 'MODULE_FV_BRASPRESS_ZONA25', 'MODULE_EXTRAS_BRASPRESS_ZONA25',
'MODULE_SHIPPING_BRASPRESS_ZONA26', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA26', 'MODULE_FV_BRASPRESS_ZONA26', 'MODULE_EXTRAS_BRASPRESS_ZONA26',
'MODULE_SHIPPING_BRASPRESS_ZONA27', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA27', 'MODULE_FV_BRASPRESS_ZONA27', 'MODULE_EXTRAS_BRASPRESS_ZONA27',
'MODULE_SHIPPING_BRASPRESS_ZONA28', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA28', 'MODULE_FV_BRASPRESS_ZONA28', 'MODULE_EXTRAS_BRASPRESS_ZONA28',
'MODULE_SHIPPING_BRASPRESS_ZONA29', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA29', 'MODULE_FV_BRASPRESS_ZONA29', 'MODULE_EXTRAS_BRASPRESS_ZONA29',
'MODULE_SHIPPING_BRASPRESS_ZONA30', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA30', 'MODULE_FV_BRASPRESS_ZONA30', 'MODULE_EXTRAS_BRASPRESS_ZONA30',
'MODULE_SHIPPING_BRASPRESS_ZONA31', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA31', 'MODULE_FV_BRASPRESS_ZONA31', 'MODULE_EXTRAS_BRASPRESS_ZONA31',
'MODULE_SHIPPING_BRASPRESS_ZONA32', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA32', 'MODULE_FV_BRASPRESS_ZONA32', 'MODULE_EXTRAS_BRASPRESS_ZONA32',
'MODULE_SHIPPING_BRASPRESS_ZONA33', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA33', 'MODULE_FV_BRASPRESS_ZONA33', 'MODULE_EXTRAS_BRASPRESS_ZONA33',
'MODULE_SHIPPING_BRASPRESS_ZONA34', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA34', 'MODULE_FV_BRASPRESS_ZONA34', 'MODULE_EXTRAS_BRASPRESS_ZONA34',
'MODULE_SHIPPING_BRASPRESS_ZONA35', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA35', 'MODULE_FV_BRASPRESS_ZONA35', 'MODULE_EXTRAS_BRASPRESS_ZONA35',
'MODULE_SHIPPING_BRASPRESS_ZONA36', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA36', 'MODULE_FV_BRASPRESS_ZONA36', 'MODULE_EXTRAS_BRASPRESS_ZONA36',
'MODULE_SHIPPING_BRASPRESS_ZONA37', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA37', 'MODULE_FV_BRASPRESS_ZONA37', 'MODULE_EXTRAS_BRASPRESS_ZONA37',
'MODULE_SHIPPING_BRASPRESS_ZONA38', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA38', 'MODULE_FV_BRASPRESS_ZONA38', 'MODULE_EXTRAS_BRASPRESS_ZONA38',
'MODULE_SHIPPING_BRASPRESS_ZONA39', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA39', 'MODULE_FV_BRASPRESS_ZONA39', 'MODULE_EXTRAS_BRASPRESS_ZONA39',
'MODULE_SHIPPING_BRASPRESS_ZONA40', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA40', 'MODULE_FV_BRASPRESS_ZONA40', 'MODULE_EXTRAS_BRASPRESS_ZONA40',
'MODULE_SHIPPING_BRASPRESS_ZONA41', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA41', 'MODULE_FV_BRASPRESS_ZONA41', 'MODULE_EXTRAS_BRASPRESS_ZONA41',
'MODULE_SHIPPING_BRASPRESS_ZONA42', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA42', 'MODULE_FV_BRASPRESS_ZONA42', 'MODULE_EXTRAS_BRASPRESS_ZONA42',
'MODULE_SHIPPING_BRASPRESS_ZONA43', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA43', 'MODULE_FV_BRASPRESS_ZONA43', 'MODULE_EXTRAS_BRASPRESS_ZONA43',
'MODULE_SHIPPING_BRASPRESS_ZONA44', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA44', 'MODULE_FV_BRASPRESS_ZONA44', 'MODULE_EXTRAS_BRASPRESS_ZONA44',
'MODULE_SHIPPING_BRASPRESS_ZONA45', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA45', 'MODULE_FV_BRASPRESS_ZONA45', 'MODULE_EXTRAS_BRASPRESS_ZONA45',
'MODULE_SHIPPING_BRASPRESS_ZONA46', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA46', 'MODULE_FV_BRASPRESS_ZONA46', 'MODULE_EXTRAS_BRASPRESS_ZONA46',
'MODULE_SHIPPING_BRASPRESS_ZONA47', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA47', 'MODULE_FV_BRASPRESS_ZONA47', 'MODULE_EXTRAS_BRASPRESS_ZONA47',
'MODULE_SHIPPING_BRASPRESS_ZONA48', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA48', 'MODULE_FV_BRASPRESS_ZONA48', 'MODULE_EXTRAS_BRASPRESS_ZONA48',
'MODULE_SHIPPING_BRASPRESS_ZONA49', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA49', 'MODULE_FV_BRASPRESS_ZONA49', 'MODULE_EXTRAS_BRASPRESS_ZONA49',
'MODULE_SHIPPING_BRASPRESS_ZONA50', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA50', 'MODULE_FV_BRASPRESS_ZONA50', 'MODULE_EXTRAS_BRASPRESS_ZONA50',
'MODULE_SHIPPING_BRASPRESS_ZONA51', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA51', 'MODULE_FV_BRASPRESS_ZONA51', 'MODULE_EXTRAS_BRASPRESS_ZONA51',
'MODULE_SHIPPING_BRASPRESS_ZONA52', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA52', 'MODULE_FV_BRASPRESS_ZONA52', 'MODULE_EXTRAS_BRASPRESS_ZONA52',
'MODULE_SHIPPING_BRASPRESS_ZONA53', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA53', 'MODULE_FV_BRASPRESS_ZONA53', 'MODULE_EXTRAS_BRASPRESS_ZONA53',
'MODULE_SHIPPING_BRASPRESS_ZONA54', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA54', 'MODULE_FV_BRASPRESS_ZONA54', 'MODULE_EXTRAS_BRASPRESS_ZONA54',
'MODULE_SHIPPING_BRASPRESS_ZONA55', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA55', 'MODULE_FV_BRASPRESS_ZONA55', 'MODULE_EXTRAS_BRASPRESS_ZONA55',
'MODULE_SHIPPING_BRASPRESS_ZONA56', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA56', 'MODULE_FV_BRASPRESS_ZONA56', 'MODULE_EXTRAS_BRASPRESS_ZONA56',
'MODULE_SHIPPING_BRASPRESS_ZONA57', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA57', 'MODULE_FV_BRASPRESS_ZONA57', 'MODULE_EXTRAS_BRASPRESS_ZONA57',
'MODULE_SHIPPING_BRASPRESS_ZONA58', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA58', 'MODULE_FV_BRASPRESS_ZONA58', 'MODULE_EXTRAS_BRASPRESS_ZONA58',
'MODULE_SHIPPING_BRASPRESS_ZONA59', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA59', 'MODULE_FV_BRASPRESS_ZONA59', 'MODULE_EXTRAS_BRASPRESS_ZONA59',
'MODULE_SHIPPING_BRASPRESS_ZONA60', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA60', 'MODULE_FV_BRASPRESS_ZONA60', 'MODULE_EXTRAS_BRASPRESS_ZONA60',
'MODULE_SHIPPING_BRASPRESS_ZONA61', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA61', 'MODULE_FV_BRASPRESS_ZONA61', 'MODULE_EXTRAS_BRASPRESS_ZONA61',
'MODULE_SHIPPING_BRASPRESS_ZONA62', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA62', 'MODULE_FV_BRASPRESS_ZONA62', 'MODULE_EXTRAS_BRASPRESS_ZONA62',
'MODULE_SHIPPING_BRASPRESS_ZONA63', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA63', 'MODULE_FV_BRASPRESS_ZONA63', 'MODULE_EXTRAS_BRASPRESS_ZONA63',
'MODULE_SHIPPING_BRASPRESS_ZONA64', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA64', 'MODULE_FV_BRASPRESS_ZONA64', 'MODULE_EXTRAS_BRASPRESS_ZONA64',
'MODULE_SHIPPING_BRASPRESS_ZONA65', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA65', 'MODULE_FV_BRASPRESS_ZONA65', 'MODULE_EXTRAS_BRASPRESS_ZONA65',
'MODULE_SHIPPING_BRASPRESS_ZONA66', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA66', 'MODULE_FV_BRASPRESS_ZONA66', 'MODULE_EXTRAS_BRASPRESS_ZONA66',
'MODULE_SHIPPING_BRASPRESS_ZONA67', 'MODULE_SHIPPING_BRASPRESS_CEP_ZONA67', 'MODULE_FV_BRASPRESS_ZONA67', 'MODULE_EXTRAS_BRASPRESS_ZONA67', 'MODULE_SHIPPING_BRASPRESS_SORT_ORDER');
      return $keys;
    }
   }

?>