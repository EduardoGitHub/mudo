<?php
  require('includes/application_top.php');

define('ENTRY_COLOR_MESH_TYPE', 'Cores Claras');
define('ENTRY_COLOR_MESH_TYPE2', 'Cores Escuras');
define('ENTRY_COLOR_MESH_TYPE3', 'Cores Especiais');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<?php
/*** Begin Header Tags SEO ***/
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
  <title><?php echo TITLE; ?></title>
<?php
}
/*** End Header Tags SEO ***/
?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />

<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<link rel="stylesheet" type="text/css" href="includes/librays/galeria/jquery.ad-gallery.css">
<style type="text/css">
.OrcTitulosLink{font-size:12px; font-weight:bold; text-transform:uppercase; background-color:#1B4B89; color:#FFF; padding-left:5px; height:25px; padding-top:5px;}
.OrcTitulosLink a{ color:#FFF; text-decoration:none; cursor:pointer}
.OrcTitulosLink a:hover{ text-decoration:underline;cursor:pointer}
.OrcTitulos{font-size:12px; font-weight:bold; text-transform:uppercase; background-color:#ccc; color:#000; padding-left:10px; height:30px; padding-top:10px;}
.OrcOpcao{font-family:Tahoma; color:#666; font-size:12px; padding-bottom:10px; padding-top:10px; text-align:left;  text-decoration:none; width:100%; text-align:justify;}
.OrcOpcao .titulos{ font-family:Tahoma; font-size:12px; font-weight:bold; text-transform:uppercase; background-color:#CCC; color:#000; height:20px; padding-top:5px; padding-left:5px; width:100%; margin-top:10px; margin-bottom:10px;}
</style>
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">

  <div id="sidebar1"><?php require(DIR_WS_INCLUDES . 'column_left.php'); ?></div>
  <div id="mainContent">
      <div class="pagestitulo"><span>Quero escrever minha própria frase!</span></div><br/>
      <?php if ($messageStack->size('frases') > 0) echo $messageStack->output('frases'); ?>
 
      <div class="pagestexto">
      <?php echo tep_draw_form('frases', tep_href_link('envie-seus-arquivos.php', 't=Frases'), 'post'); ?>
      <input type="hidden" name="action" value="sendfrases" />
                  <!--<div class="OrcTitulosLink"><a href="<?= tep_href_link('frases.php')?>">Quero fazer meu Projeto Exclusivo!</a></div>-->
                    <div class="OrcOpcao">
                        <span class="main">&nbsp;&nbsp;&nbsp;Sem problema! Faremos a frase que quiser, para você mudar sua casa! Nesta seção você escolhe o tamanho e a cor que desejar. Envie-nos sua própria frase, poesia ou letra de música e nós criaremos um produto espetacular para você.</span><br /><br />
                        
                        <?
						$products_new_query = tep_db_query("select * from ".TABLE_GALLERY_STUDIO." WHERE gallery_type = 7");
						$num_rows = tep_db_num_rows($products_new_query);
                        if($num_rows>0){
						?>
                        <center>
                            <div id="gallery" class="ad-gallery">
                                  <div class="ad-nav">
                                    <div class="ad-thumbs">
                                      <ul class="ad-thumb-list">
                                        <?PHP
                                            $image_need_resize = 1;          // 1 on, 0 off - 1 acik, 0 kapali
                                            $width = 80;                                 // image width - resim genisligi
                                            $height = 80;   
                                            while($products_new = tep_db_fetch_array($products_new_query)){
                                                $new_image = $products_new['gallery_foto'].thumb_galery(DIR_WS_IMAGES_PRODUTOS.'Fotos/'.$products_new['gallery_foto'], $width, $height,false);
                                                $mostra_galeria .= '<li><a href="'.DIR_WS_IMAGES_PRODUTOS.'Fotos/'.$products_new['gallery_foto'].'"><img src="'.DIR_WS_IMAGES_PRODUTOS.'Fotos/'.$new_image.'" border="0" title="'.$products_new['gallery_adesivo'].'" longdesc="'.$products_new['gallery_description'].'"/></a> </li>';
                                            }
                                        	echo $mostra_galeria;
                                        ?>
                                      </ul>
                                    </div>
                                  </div>
                                  <div class="ad-controls"> </div>
                                  <div class="ad-image-wrapper"> </div>
                            </div> 
                        </center>
                        <br />
                        <? } ?>
                        
                        <div class="titulos">1° Passo - Seus dados:</div>
                        
                        	Informe seus dados corretamente para que nossa equipe entre em contato com você.<br />
                            <br />	<b>Nome:</b><br />
                            <?php echo tep_draw_input_field('nome','','size="45"'); ?><br />
                            
                            <br />	<b>Email:</b><br />
                            <?php echo tep_draw_input_field('email','','size="45"'); ?><br />
                            
                            <br />	<b>Confirme seu e-mail:</b><br />
                            <?php echo tep_draw_input_field('confirme-email','','size="45"'); ?><br />
                            
                            <br />	<b>Telefone:</b><br />
                            <?php echo tep_draw_input_field('telefone','','size="25"'); ?><br />
                            
                            <br />	<b>CEP:</b><br />
                            <?php echo tep_draw_input_field('cep','','size="25"'); ?><br /><br />
                        
                        <div class="titulos">2° Passo - Preencha os campos abaixo:</div>
                        <b>Infome a frase que você deseja colocar.</b><br />
                        <!--Qual é sua frase?  --><?php //echo tep_draw_input_field('fraseop2','','size="50"'); ?>
                        <?php echo tep_draw_textarea_field('fraseop2', 'soft', 30, 15); ?>
                        <br /><br />
                        
                        <b>Qual o espaço que você tem disponível, ao qual o modelo deve se adaptar?</b><br />
                        Largura:<?php echo tep_draw_input_field('tamanhoLarop2','','size="15"'); ?>cm <b>X</b> Altura:<?php echo tep_draw_input_field('tamanhoAltop2','','size="15"'); ?>cm.&nbsp;&nbsp;<small>(Obs.: Letras não podem ser menores que 3cm)</small>
                        <br /><br />
                        
                        <b>Selecione a cor:</b> <a href=<?=tep_href_link('mmc_paletadecores.php')?>>"Consulte nossa paleta de Cores!"</a>
                        <br /><br />
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="191" class="main" style="border:1px solid #666; text-align:center"><b><?php echo ENTRY_COLOR_MESH_TYPE ?></b></td>
                            <td rowspan="3" width="20"></td>
                            <td width="200" class="main" style="border:1px solid #666; text-align:center"><b><?php echo ENTRY_COLOR_MESH_TYPE2 ?></b></td>
                            <td rowspan="3" width="21"></td>
                            <td width="200" class="main" style="border:1px solid #666; text-align:center"><b><?php echo ENTRY_COLOR_MESH_TYPE3 ?></b></td>
                          </tr>
                          <tr><td colspan="5" height="5"></td></tr>
                          <tr>
                            <td valign="top">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="6%" height="20" class="main"><?php echo tep_draw_radio_field('corop2', 'Branco','','checked="checked"');?></td>
                                    <td width="94%">Branco</td>
                                  </tr>
                                  <tr bgcolor="#FEEC40">
                                    <td class="main" height="20"><?php echo tep_draw_radio_field('corop2', 'Amarelo');?></td>
                                    <td>Amarelo</td>
                                  </tr>
                                   <tr bgcolor="#B0E0F2">
                                    <td class="main" bgcolor="#FFCC00" height="20" style="color:#FFF"><?php echo tep_draw_radio_field('corop2', 'Amarelo Ouro');?> </td>
                                    <td bgcolor="#FFCC00" height="20" style="color:#FFF">Amarelo Ouro</td>
                                  </tr>
                                  <tr bgcolor="#B0E0F2">
                                    <td class="main" bgcolor="#F4962D" height="20" style="color:#FFF"><?php echo tep_draw_radio_field('corop2', 'Laranja');?></td>
                                    <td bgcolor="#F4962D" height="20" style="color:#FFF">Laranja</td>
                                  </tr>
                                  <tr bgcolor="#F548B3">
                                    <td class="main" height="20"><?php echo tep_draw_radio_field('corop2', 'Magenta');?></td>
                                    <td style="color:#FFF">Magenta</td>
                                  </tr>
                                  <tr bgcolor="#C40202">
                                    <td class="main" height="20"><?php echo tep_draw_radio_field('corop2', 'Vermelho Tomate');?></td>
                                    <td style="color:#FFF">Vermelho Tomate</td>
                                  </tr>
                                  <tr bgcolor="#B0AFAB">
                                    <td class="main" height="20"><?php echo tep_draw_radio_field('corop2', 'Cinza Clar');?></td>
                                    <td style="color:#FFF">Cinza Claro</td>
                                  </tr>
                                  <tr bgcolor="#4DBA2D">
                                    <td class="main" height="20"><?php echo tep_draw_radio_field('corop2', 'Verde Claro');?></td>
                                    <td style="color:#FFF">Verde Claro</td>
                                  </tr>
                                  <tr bgcolor="#37CAF5">
                                    <td class="main" height="20"><?php echo tep_draw_radio_field('corop2', 'Azul Claro');?></td>
                                    <td style="color:#FFF">Azul Claro</td>
                                  </tr>
                                  
                                </table>
                            </td>
                            <td valign="top">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="6%" class="main" bgcolor="#000"><?php echo tep_draw_radio_field('corop2', 'Preto');?></td>
                                    <td width="94%" bgcolor="#000" height="20" style="color:#FFF">Preto</td>
                                  </tr>
                                  <tr>
                                    <td class="main" bgcolor="#5C5C5A"><?php echo tep_draw_radio_field('corop2', 'Cinza');?></td>
                                    <td bgcolor="#5C5C5A" height="20" style="color:#FFF">Cinza</td>
                                  </tr>
                                  <tr>
                                    <td class="main" bgcolor="#6B3103"><?php echo tep_draw_radio_field('corop2', 'Marrom');?></td>
                                    <td bgcolor="#6B3103" height="20" style="color:#FFF">Marrom</td>
                                  </tr>
                                  <tr>
                                    <td class="main" bgcolor="#A70302"><?php echo tep_draw_radio_field('corop2', 'Vermelho');?></td>
                                    <td bgcolor="#A70302" height="20" style="color:#FFF">Vermelho</td>
                                  </tr>
                                  <tr>
                                    <td class="main" bgcolor="#026900"><?php echo tep_draw_radio_field('corop2', 'Verde');?></td>
                                    <td bgcolor="#026900" height="20" style="color:#FFF">Verde</td>
                                  </tr>
                                  <tr>
                                    <td class="main" bgcolor="#08290A"><?php echo tep_draw_radio_field('corop2', 'Verde Escuro');?></td>
                                    <td bgcolor="#08290A" height="20" style="color:#FFF">Verde Escuro</td>
                                  </tr>
                                  <tr>
                                    <td class="main" bgcolor="#2A04AF"><?php echo tep_draw_radio_field('corop2', 'Azul');?></td>
                                    <td bgcolor="#2A04AF" height="20" style="color:#FFF">Azul</td>
                                  </tr>
                                  <tr>
                                    <td class="main" bgcolor="#010161"><?php echo tep_draw_radio_field('corop2', 'Azul Escuro');?></td>
                                    <td bgcolor="#010161" height="20" style="color:#FFF">Azul Escuro</td>
                                  </tr>
                                </table>
                            </td>
                            <td valign="top">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr bgcolor="#652464">
                                    <td width="6%" height="20" class="main"><?php echo tep_draw_radio_field('corop2', 'Violeta','');?></td>
                                    <td width="94%" style="color:#FFF">Violeta</td>
                                  </tr>
                                  <tr bgcolor="#57010C">
                                    <td class="main" height="20"><?php echo tep_draw_radio_field('corop2', 'Bordeaux');?></td>
                                    <td style="color:#FFF">Bordeaux</td>
                                  </tr>
                                  <tr bgcolor="#EDA1EB">
                                    <td class="main" height="20"><?php echo tep_draw_radio_field('corop2', 'Lilás');?></td>
                                    <td style="color:#FFF">Lilás</td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                        </table>
                        <br /><br />
                        <b>&nbsp;&nbsp;&nbsp;Use o campo abaixo para fazer observações e comentários sobre o orçamento, indicar o tipo de letra ou fonte de preferência, pedir para acrescentar uma figura ou desenho, etc...</b>
                          <?php echo tep_draw_textarea_field('enquiryop2', 'soft', 50, 15); ?>
                    

                    <div class="titulos">3° Passo - Enviar formulário:</div>
                    <div style="text-align:center; font-size:18px; color:#ccc">Você pode nos enviar arquivos na próxima tela!</div>
                                <div style="text-align:center; font-size:15px; color:#000; width:600px; margin:10px auto">Fique a vontade para nos enviar imagens, desenhos ou qualquer outro material que possa nos ajudar a entender o que deseja. Se possível nos envie fotos do local onde deseja decorar.</div>
                                <br /><br />
                                <div>
                                    <div style="float:left; width:200px;"><a onclick="history.go(-1)" style="cursor:pointer"><?=tep_image_button('button_back.gif', IMAGE_BUTTON_BACK)?></a></div>
                                    <div style="float:right; width:220px; text-align:right"><?php echo tep_image_submit('button_buguet.gif', IMAGE_BUTTON_CONTINUE); ?></div>
                                    <div style="clear:both"></div>
                                </div> 
                  </div> 
                </form>     
      </div>
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
<script type="text/javascript" src="includes/librays/galeria/jquery.ad-gallery.js"></script>
  <script type="text/javascript">
  $(function() {
    var galleries = $('.ad-gallery').adGallery();
    $('#switch-effect').change(
      function() {
        galleries[0].settings.effect = $(this).val();
        return false;
      }
    );
    $('#toggle-slideshow').click(
      function() {
        galleries[0].slideshow.toggle();
        return false;
      }
    );
  });
</script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>