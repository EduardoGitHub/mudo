<?
$chat_q = tep_db_query("SELECT status_boxes FROM boxes WHERE file_boxes = 'chat.php'");
$chat_r = tep_db_fetch_array($chat_q);
?>

<?php
//Verifica se o usuário esta logado ou não e exibi a mensagem que melhor adque!1
if (tep_session_is_registered('customer_id')) {
    $customers_query = tep_db_query("select customers_firstname from " . TABLE_CUSTOMERS. " where customers_id =".$_SESSION['customer_id']);
    $customers = tep_db_fetch_array($customers_query);
    $stringShow = 'Seja bem  vindo, <b>'.$customers['customers_firstname'].'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.tep_href_link(FILENAME_ACCOUNT).'" style="color:#FFF">Minha Conta</a> | <a href="'.tep_href_link('logoff.php').'" style="color:#FFF"> Sair</a>';

}else $stringShow = 'Olá visitante! Faça seu <a href="'.tep_href_link(FILENAME_LOGIN).'" style="font-family:Tahoma; font-size:15px; color:#FFF; text-decoration:underline">login</a> ou <a href="'.tep_href_link(FILENAME_LOGIN).'" style="font-family:Tahoma; font-size:15px; color:#FFF; text-decoration:underline">cadastre-se</a> | <a href="'.tep_href_link('account.php').'" style="color:#FFF">Veja seu cadastro</a> | <a href="'.tep_href_link('account_history.php').'" style="color:#FFF">Veja seus pedidos</a>';
?>


<div class="HeaderTop">
    <div class="HeaderTop_txt">
        <div style="float:left; width:440px;"><?=$stringShow?></div>
        <div style="float:right; width:510px; font-size:13px;">
            <div style="width:200px; float:left"><a href='<?=tep_href_link('fale-conosco.html')?>' style="color:#FFF">Central de Atendimento</a></div>
            <div style="width:280px; float:left; padding-left:10px;"><img src="images/icon_telefone.png" align="left"/>&nbsp;&nbsp;Compre pelo telefone: <b>0800 032 1777</b></div>
            <div style="clear:both;"></div>
        </div>
        <div style="clear:both;"></div>
    </div>
</div>



<div class="header_default">
<div class="header_infor">
<div style="margin:0 0 0 5px; float:left; width:307px;"><h1 style="font-size: 1px; margin: 0; padding: 0; color: #CC6E6E">Mudo Minha Casa <?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'logo.png', (isset($header_tags_array['logo_text']) ? $header_tags_array['logo_text'] : STORE_NAME)) . '</a>'; ?></h1></div>
<div  style="float:left; width:400px; margin:32px 0 0 8%;">
    <div style="position:relative;">
        <!-- PROCURAR -->
        <?=tep_draw_form('quick_find', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT), 'get')?>
        <?=tep_draw_input_field('keywords', '', 'id="txtSearch" onkeyup="searchSuggest();" size="150"  placeholder="Informe uma palavra chave para busca"  class="se" style="width:240px; background-color:#D58B8A; border:0; -webkit-border-radius: 10px;  -moz-border-radius: 10px; border-radius: 10px; color:#FFF; padding-left:10px;"') . ' ' . tep_hide_session_id()?><div id="search_suggest"></div>
        <div style="position:absolute; top:2px; left:260px"><?php echo tep_image_submit('lupa.png','Buscar','style="background:none;"')?></div><br />
        <!--<div style="position:absolute; top:35px; left:0px;"><a href="<?=tep_href_link('busca-avancada.html')?>" style="font-family:Tahoma; font-size:11px; color:#FFF; text-transform:none">Busca avançada</a></div>-->
        </form>
    </div>
    <!-- FIM PROCURAR -->
</div>
<div  style="float:left; width:120px; margin:27px 0 0 0">
    <a href="<?=tep_href_link('meu-carrinho-de-compras.html')?>" style="font-weight:bold; color:#FFF; text-transform:lowercase; font-size:11px;"><img src="images/icon-cesta.png" align="left" border="0" /><div style="text-align:center; padding-left:5px; padding-top:5px"> minha cesta<br /><? if($cart->count_contents() <=1) echo $cart->count_contents().' item'; elseif($cart->count_contents() >1) echo $cart->count_contents().' itens'; ?></div></a>
</div>
<div style="clear:both;"></div>
<div style="margin-top:5px;">
<ul id="cssmenu">
<li><a>Adesivos de Parede</a>
    <div class="dropdown_5columns">
        <div class="col_5">
            <h2>Adesivos de Parede</h2>
        </div>
        <div class="col_1">
            <h3>Ambientes</h3>
            <ul>
                <?php
                $GLOBALS['this_level'] = 0;
                $categories_string = tep_make_catsf_ullist(0, 0, 'and c.categories_highlights = 0 and c.categories_temas = 0 and c.categories_id <> 115');
                echo $categories_string;
                ?>
            </ul>
        </div>
        <div class="col_1">
            <h3>Temas</h3>
            <ul>
                <?php
                $GLOBALS['this_level'] = 0;
                $categories_string2 = tep_make_catsf_ullist(0, 0, 'and c.categories_highlights = 0 and c.categories_temas = 1', ' LIMIT 12');
                echo $categories_string2;
                ?>
            </ul>
        </div>
        <div class="col_1">
            <h3>&nbsp;</h3>
            <ul>
                <?php
                $GLOBALS['this_level'] = 0;
                $categories_string2 = tep_make_catsf_ullist(0, 0, 'and c.categories_highlights = 0 and c.categories_temas = 1 ', ' LIMIT 12, 20');
                echo $categories_string2;
                ?>
            </ul>
        </div>
        <div class="col_1" style="position:inherit; display:block; margin:410px 0 0 280px; width:150px;">
            <span style="color:#CC6E6E">Adesivos de Parede</span>
            <span><a style="color:#666; font-size:16px; border:0;">Coleções Especiais</a></span>
        </div>
        <div class="col_2"><? if ($banner = tep_banner_exists('dynamic', 'banner_menu_adesivos')){ echo tep_display_banner('static', $banner);} ?></div>
    </div>
</li>

<li><a>Coleções Especiais</a>
    <div class="dropdown_4columns">
        <div class="col_4">
            <h2>Coleções Especiais</h2>
        </div>
        <div class="col_1" style="width:140px;">
            <h3>Adesivos de Parede</h3>
            <ul>
                <?php
                $show_full_tree = true;
                $classname_for_selected = false;  // see superfish.css
                $classname_for_parent = false;  //see superfish.css
                $GLOBALS['this_level'] = 0;
                $categories_string = tep_make_catsf_ullist(0, 0, 'and c.categories_highlights = 1');
                echo $categories_string;
                ?>
            </ul>
        </div>
        <div class="col_1">&nbsp;
            <!--
                <h3>Mural de Parede</h3>
                <ul>
                    <li><a href="#">Pintores Famosos</a></li>
                    <li><a href="#">Arte de Rua</a></li>
                </ul>   
             -->
        </div>
        <div class="col_1" style="position:inherit; display:block; margin:410px 0 0 140px; width:150px;">
            <span style="color:#CC6E6E">Produtos Personalizados</span>
            <span><a style="color:#666; font-size:16px; border:0;">Projetos Exclusivos</a></span>
        </div>
        <div class="col_2"><? if ($banner = tep_banner_exists('dynamic', 'banner_menu_especiais')){ echo tep_display_banner('static', $banner);} ?></div>
    </div>
</li>

<li><a>Personalizados</a>
    <div class="dropdown_4columns align_center">
        <div class="col_4">
            <h2>Personalizados e Exclusivos</h2>
        </div>
        <div class="col_1" style="width:140px;">
            <h3>Adesivos de Parede</h3>
            <ul>
                <li><a href="<?=tep_href_link('produtos-personalizados.php')?>">Produtos Personalizados</a></li>
                <li><a href="<?=tep_href_link('projetos-corporativos.php')?>">Projetos Corporativovs</a></li>
                <li><a href="<?=tep_href_link('foto-wall.php')?>">Foto Wall</a></li>
                <li><a href="<?=tep_href_link('foto-art.php')?>">Foto Art</a></li>
                <li><a href="<?=tep_href_link('frases.php')?>">Frases</a></li>
                <li><a href="<?=tep_href_link('envie-seu-modelo.php')?>">Envie seu modelo</a></li>
            </ul>
        </div>
        <div class="col_1">&nbsp;
            <!--
                <h3>Mural de Parede</h3>
                <ul>
                    <li><a href="#">Painel Personalizado</a></li>
                </ul>   
                -->
        </div>

        <div class="col_1" style="position:inherit; display:block; margin:410px 0 0 130px; width:160px;">

            <span style="color:#CC6E6E">Produtos Personalizados</span>
            <span><a style="color:#666; font-size:16px; border:0;">Projetos para Empresa</a></span>

        </div>
        <div class="col_2"><? if ($banner = tep_banner_exists('dynamic', 'banner_menu_personalizados')){ echo tep_display_banner('static', $banner);} ?></div>
    </div>
</li>

<li class="menu_right" style="width:125px;"><a >&nbsp;</a></li>

<li class="menu_right"><a ><span>Participe</span></a>
    <div class="dropdown_4columns align_right" style="width:685px">
        <div class="col_4">
            <h2>Participe!</h2>
        </div>
        <div class="col_1" style="width:160px;">
            <h3>Conheça nossas Redes</h3>
            <ul>
                <li><a href="http://www.mudominhacasa.com.br/blog/" target="_blank">Blog</a></li>
                <li><a href="https://www.facebook.com/mudominhacasa" target="_blank" rel="nofollow">Facebook</a></li>
                <li><a href="https://plus.google.com/u/0/b/115039582647226412178/115039582647226412178/posts" target="_blank" rel="nofollow">G+</a></li>
                <li><a href="http://www.pinterest.com/mudominhacasa/" target="_blank" rel="nofollow">Pinterest</a></li>
                <li><a href="http://instagram.com/mudominhacasa" target="_blank" rel="nofollow">Instagram</a></li>
                <li><a href="https://twitter.com/mudominhacasa" target="_blank" rel="nofollow">Twitter</a></li>
            </ul>
        </div>

        <div class="col_1" style="width:160px;">&nbsp;

            <h3>Ganhe Dinheiro Conosco</h3>
            <ul>
                <!--<li><a href="#">Seja um Revendedor</a></li>-->
                <li><a href="<?=tep_href_link('parceiros.html')?>">Seja um Parceiro</a></li>
                <li><a href="<?=tep_href_link('afiliados.html')?>">Afiliados Mudominhacasa</a></li>
            </ul>
            <!--
                            <h3>Concurso de Arte</h3>
                            <ul>
                                <li><a href="#">Envie sua Arte</a></li>
                                <li><a href="#">Produtos em Promoção</a></li>
                            </ul>
                            -->
        </div>
        <div class="col_1" style="position:inherit; display:block; margin:410px 0 0 200px; width:160px;">
            <span style="color:#CC6E6E">Trabalhe Conosco</span>
            <span><a style="color:#666; font-size:16px; border:0;">Seja um Revendedor</a></span>
        </div>
        <div class="col_2"><? if ($banner = tep_banner_exists('dynamic', 'banner_menu_participe')){ echo tep_display_banner('static', $banner);} ?></div>
    </div><!-- End 4 columns container -->

</li>

<li class="menu_right"><a ><span>Dúvidas</span></a>
    <div class="dropdown_4columns align_right" style="width:750px;"><!-- Begin 4 columns container -->

        <div class="col_4">
            <h2>Dúvidas</h2>
        </div>

        <div class="col_1" style="width:200px;">

            <h3>Tire suas Dúvidas</h3>
            <ul>
                <li><a href="<?=tep_href_link('como-comprar-i-1.html')?>">Como Comprar</a></li>
                <li><a href="<?=tep_href_link('como-aplicar.php')?>">Como Aplicar</a></li>
                <li><a href="<?=tep_href_link('formas-pagamento-i-5.html')?>">Formas de Pagamento</a></li>
                <li style="width:180px;"><a href="<?=tep_href_link('formas-entrega-i-6.html')?>">Tempo e Formas de Entrega</a></li>
                <li><a href="<?=tep_href_link('garantia-durabilidade-i-4.html')?>">Garantia e Durabilidade</a></li>
                <li style="width:180px;"><a href="<?=tep_href_link('seguranca-privacidade-i-7.html')?>">Segurança e Privacidade</a></li>
                <li style="width:180px;"><a href="<?=tep_href_link('troca-devolucao-pedido-i-11.html')?>">Troca e Devolução do pedido</a></li>
                <li><a href="<?=tep_href_link('faq-i-8.html')?>">Perguntas Frequentes</a></li>
                <li><a href="<?=tep_href_link('paleta-de-cores.php')?>">Significado das Cores</a></li>

            </ul>

        </div>

        <div class="col_1" style="width:180px;">
            <h3>Rastrear o seu Pedido</h3>
            <b>Acompanhe seu Pedido!</b>

            <form method="get" target="_blank" action="http://websro.correios.com.br/sro_bin/txect01$.QueryList?" name="rastreamento">
                <input type="hidden" name="P_TIPO" value="001" />
                <input name="P_COD_UNI" style="border:1px solid #CCC;" onClick="limpa_modelo();" />
                <input type="hidden" name="P_LINGUA" value="001" checked="checked" />
                <input type="submit" value="Rastrear" />
            </form>
        </div>
        <div class="col_2"><? if ($banner = tep_banner_exists('dynamic', 'banner_menu_duvidas')){ echo tep_display_banner('static', $banner);} ?></div>
    </div>
</li>



<li><a href='<?=tep_href_link(FILENAME_CONTACT_US)?>' ><span>Fale Conosco</span></a></li>


</ul>

</div>
</div>
</div>
<div style="background-color:#FFF; width:990px; margin:0 auto; -webkit-box-shadow: 0px 7px 11px rgba(50, 50, 50, 0.76); -moz-box-shadow:    0px 7px 11px rgba(50, 50, 50, 0.76);
box-shadow:         0px 7px 11px rgba(50, 50, 50, 0.76);">
    <div style="width:990px; margin:0 auto; position:relative">
        <ul id="demo">
            <?

            if(strpos($_SERVER['PHP_SELF'],'Index.php') !== false or strpos($_SERVER['PHP_SELF'],'index.php') !== false && $cPath == 0){
                $random_banner_select = tep_db_query("select banners_url, banners_image from banners where banners_group LIKE 'bPrincipal_%' and status = 1 order by banners_group ");
                $random_banner = tep_db_fetch_array($random_banner_select);
                $ramdon_num_rows = tep_db_num_rows($random_banner_select);
                if($ramdon_num_rows > 0){
                    for($cont4 =1; $cont4 <= $ramdon_num_rows; $cont4++){
                        if($random_banner['banners_url']=='')
                            echo "<li style='width: 990px; height:400px;'><img src='images/banners/".$random_banner['banners_image']."' /></li>\n\r";
                        else
                            echo "<li style='width: 990px; height:400px;'><a href='".$random_banner['banners_url']."'><img src='images/banners/".$random_banner['banners_image']."' /></a></li>\n\r";

                        $random_banner = tep_db_fetch_array($random_banner_select);
                    }
                }
            }



            if(isset($cPath) and  $cPath <> '' and $cPath <> 0 && (strpos($_SERVER['PHP_SELF'],'Index.php') !== false or strpos($_SERVER['PHP_SELF'],'index.php') !== false)){
                $random_banner_select = tep_db_query("select banners_url, banners_image from banners where banners_group LIKE 'bCategoria".$cPath."%' and status = 1 order by banners_group ");
                $random_banner = tep_db_fetch_array($random_banner_select);
                $ramdon_num_rows = tep_db_num_rows($random_banner_select);
                if($ramdon_num_rows > 0){
                    for($cont4 =1; $cont4 <= $ramdon_num_rows; $cont4++){
                        if($random_banner['banners_url']=='')
                            echo "<li style='width: 990px; height:90px;'><img src='images/banners/".$random_banner['banners_image']."' /></li>\n\r";
                        else
                            echo "<li style='width: 990px; height:90px;'><a href='".$random_banner['banners_url']."'><img src='images/banners/".$random_banner['banners_image']."' /></a></li>";

                        $random_banner = tep_db_fetch_array($random_banner_select);
                    }
                }
            }

            ?>
        </ul>
        <? if(isset($cPath) and $cPath == 0){ if(isset($ramdon_num_rows) && $ramdon_num_rows > 0) echo'<div style="position:absolute; top:150px; left:10px; z-index:1;"><button id="prev" class="btnP"></button></div><div style="position:absolute; top:150px; right:10px; z-index:1;"><button id="next" class="btnN"></button></div>';}?>
        <? if ($banner = tep_banner_exists('dynamic', 'banner_principal'.$cPath)) echo tep_display_banner('static', $banner);?>
    </div>

    <? if(strpos($_SERVER['PHP_SELF'],'Index.php') !== false or strpos($_SERVER['PHP_SELF'],'index.php') !== false && $cPath == 0){?>
        <div style="width:990px; margin:0 0 5px 0;">
            <ul id="carousel" class="elastislide-list">
                <?
                $random_banner_select = tep_db_query("select banners_group, banners_url, banners_image from banners where banners_group LIKE 'bRotativo%' and status = 1 order by rand() ");
                $random_banner = tep_db_fetch_array($random_banner_select);
                $ramdon_num_rows = tep_db_num_rows($random_banner_select);
                if(isset($ramdon_num_rows) && $ramdon_num_rows > 0){
                    for($cont4 =1; $cont4 <= $ramdon_num_rows; $cont4++){
                        
                        if($random_banner['banners_url']=='') echo "<li><img src='images/banners/".$random_banner['banners_image']."' /></li>\n\r";
                        else echo "<li><a href='".$random_banner['banners_url']."'><img src='images/banners/".$random_banner['banners_image']."' /></a></li>";
                        $random_banner = tep_db_fetch_array($random_banner_select);
                    }
                }
                ?>
            </ul>
        </div>
    <? } ?>

    <? if(strrpos($_SERVER['PHP_SELF'],'product_info.php') === false){?>
    <div class="Social" <? if(isset($ramdon_num_rows) && $ramdon_num_rows > 0) echo 'style="margin-top:0px;"'?>>
        <div style="width:990px; margin:0 auto;">

            <div style="float:left; margin-top:8px; width:450px">
                <div class="addthis_toolbox addthis_default_style ">
                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
                    <a class="addthis_button_tweet"></a>
                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                    <a class="addthis_counter addthis_pill_style"></a>
                </div>
            </div>


            <div style="float:right; font-size:11px; font-family:Tahoma; color:#FFF; width:540px;  margin-top:8px; text-align:right">
                <div style="text-align:right; float:left">Receba Dicas de Decoração, Novidades. Oferta Exclusivas e <br />muito mais em 1 mão.</div>
                <div style="float:left; margin-left:10px;"> <?=tep_draw_input_field('email', '', 'size="20" maxlength="50" id="email"    onclick="this.value=\'\'" value="Informe seu e-mail"  style="width:150px; height:25px; background-color:#DEA6A5; border:0; -webkit-border-radius: 10px;  -moz-border-radius: 10px; border-radius: 10px; color:#FFF; padding-left:10px;" ');?>
                </div>
                <div style="margin:3px 0 0 3px; width:25px; height:17px; float:left;"><img style="cursor:pointer;" onClick="javascript: _gaq.push(['_trackPageview', '/virtual-assinatura-newsletter']); excuteAct('inReg');" alt="Recebe informativos" src="includes/languages/portugues/images/buttons/button_newletter_cad.png"></div>
                <div style="clear:both;"></div>
            </div></div>
        <div style="clear:both;"></div>

    </div>
</div>
<? } ?>

<?php
// check if the 'install' directory exists, and warn of its existence
if (WARN_INSTALL_EXISTENCE == 'true') {
    if (file_exists(dirname($_SERVER['SCRIPT_FILENAME']) . '/install')) {
        $messageStack->add('header', WARNING_INSTALL_DIRECTORY_EXISTS, 'warning');
    }
}

// check if the configure.php file is writeable
/* if (WARN_CONFIG_WRITEABLE == 'true') {
   if ( (file_exists(dirname($_SERVER['SCRIPT_FILENAME']) . '/includes/configure.php')) && (is_writeable(dirname($_SERVER['SCRIPT_FILENAME']) . '/includes/configure.php')) ) {
     $messageStack->add('header', WARNING_CONFIG_FILE_WRITEABLE, 'warning');
   }
 }*/

// check if the session folder is writeable
if (WARN_SESSION_DIRECTORY_NOT_WRITEABLE == 'true') {
    if (STORE_SESSIONS == '') {
        if (!is_dir(tep_session_save_path())) {
            $messageStack->add('header', WARNING_SESSION_DIRECTORY_NON_EXISTENT, 'warning');
        } elseif (!is_writeable(tep_session_save_path())) {
            $messageStack->add('header', WARNING_SESSION_DIRECTORY_NOT_WRITEABLE, 'warning');
        }
    }
}

// check session.auto_start is disabled
if ( (function_exists('ini_get')) && (WARN_SESSION_AUTO_START == 'true') ) {
    if (ini_get('session.auto_start') == '1') {
        $messageStack->add('header', WARNING_SESSION_AUTO_START, 'warning');
    }
}

if ( (WARN_DOWNLOAD_DIRECTORY_NOT_READABLE == 'true') && (DOWNLOAD_ENABLED == 'true') ) {
    if (!is_dir(DIR_FS_DOWNLOAD)) {
        $messageStack->add('header', WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT, 'warning');
    }
}

if ($messageStack->size('header') > 0) {
    echo $messageStack->output('header');
}


?>
<div>
