<?php
  require('includes/application_top.php');
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
      <div class="pagestitulo"><span>Quero minha FOTOART na parede!</span></div><br/>
      <?php if ($messageStack->size('foto-art') > 0) echo $messageStack->output('foto-art'); ?>
 
      <div class="pagestexto">
      <?php echo tep_draw_form('foto-art', tep_href_link('envie-seus-arquivos.php', 't=Foto-Art'), 'post'); ?>
      <input type="hidden" name="action" value="sendart" />
                  <!--<div class="OrcTitulosLink"><a href="<?= tep_href_link('foto-art.php')?>">Quero fazer meu Projeto Exclusivo!</a></div>-->
                    <div class="OrcOpcao">
                        <span class="main">&nbsp;&nbsp;&nbsp;Sabe aquela foto que você tirou e achou que ficou bem legal? Vai ficar IMPRESSIONANTE na parede da sua casa! Podemos dar à sua foto um tratamento especial, confeccionando um produto totalmente exclusivo, que pode ter por base uma imagem de pessoa, paisagens, monumentos, etc...</span><br /><br />
                      
                        <?
						$products_new_query = tep_db_query("select * from ".TABLE_GALLERY_STUDIO." WHERE gallery_type = 6");
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
        
                    <b>Qual o espaço que você tem disponível, ao qual o modelo deve se adaptar?</b><br /><br />
                    Largura:<?php echo tep_draw_input_field('tamanhoLarop3','','size="15"'); ?>cm <b>X</b> 
                    Altura:<?php echo tep_draw_input_field('tamanhoAltop3','','size="15"'); ?>cm. <br />
                    <br />
                    <div style="width:400px; float:left">
                           <b>Qual o nome ou número do modelo escolhido:</b><br /><br />
                        <?php echo tep_draw_input_field('modelo','','size="60"'); ?>
                    <br /><br />   
                           
                           <br />	<b>Qual o tema preferido para aplicarmos a sua foto?</b><br />
                            <?php echo tep_draw_input_field('information1op3','','size="25"'); ?><br /><br />
                            
                            <b>Descreva sua ideia</b>
                            <?php echo tep_draw_textarea_field('ideiaop3', 'soft', '10', '10'); ?>
                            
                           </div>
                            <div style="width:300px; float:left; margin-left:10px;">
                            ex.: Infantil, Personagem Predileto, Flores, Borboletas, Casamento, Artista Preferido, Animais, Filmes, Tecnológico, Textos, Foto Montagem, Paisagem, Viagens, Artistas, Cervejas, Celebridades, Exportes e etc...<br /> <br />
                           ex.: Quero uma montagem com a foto dos meus filhos e o tema do filme Carros...<br /> <br />
                            ex.: Quero minha foto com efeitos visuais tecnlógicos que lembrem um personagem em uma viagem ao futuro...<br /><br />
ex.: Quero a foto da minha família aplicado sobre um fundo com tenda de Viagens Fantásticas da Família Silva....
<br /> <br />
                            </div>
                           
                           <br style="clear:both" />
                           <br />
                            <b>Quais estilos você gostaria que valorizássemos no projeto? (Marque quantos quiser!)</b><br /><br />
                            <fieldset style="width:340px; float:left">
                            <legend>Estilo Pessoal</legend>
                           <div style="float:left; width:90px;">
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Bebê |');?> Bebê<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Infantil |');?> Infantil<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Jovem |');?> Jovem<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Adulto |');?> Adulto<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Idoso |');?> Idoso<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Masculino |');?> Masculino<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Feminino |');?> Feminino<br />
                            </div>
                            
                            <div style="float:left; width:120px;">
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Sério |');?> Sério<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Irreverente |');?> Irreverente<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Conservador |');?> Conservador<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Arrojado |');?> Arrojado<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Extravagante |');?> Extravagante<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'A moda Antiga |');?> A moda Antiga<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Racional |');?> Racional<br />
                           </div>
                           
                           <div style="float:left; width:120px;">
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Alternativo |');?> Alternativo<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Vaidoso |');?> Vaidoso<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Sensível |');?> Sensível<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Independente |');?> Independente<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Família |');?> Família<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Prático |');?> Prático<br />
                           <?php echo tep_draw_checkbox_field('estilop[]', 'Perfeccionista |');?> Perfeccionista<br />
                           </div>
                           <br style="clear:both" />
                           </fieldset>
                           
                           <fieldset style="width:250px; float:left">
                            <legend>Estilo da Arte</legend>
                           <div style="float:left; width:110px;">
                           <?php echo tep_draw_checkbox_field('estiloa[]', 'Preto e Branco |');?> Preto e Branco<br />
                           <?php echo tep_draw_checkbox_field('estiloa[]', 'Envelhecido |');?> Envelhecido<br />
                           <?php echo tep_draw_checkbox_field('estiloa[]', 'Colorido |');?> Colorido<br />
                           <?php echo tep_draw_checkbox_field('estiloa[]', 'Moderno |');?> Moderno<br />
                           <?php echo tep_draw_checkbox_field('estiloa[]', 'Tecnológico |');?> Tecnológico<br />
                           <?php echo tep_draw_checkbox_field('estiloa[]', 'Clássico |');?> Clássico<br />
                           <?php echo tep_draw_checkbox_field('estiloa[]', 'Artístico |');?> Artístico<br />
                           </div>
                           <div style="float:left; width:140px;">
                           <?php echo tep_draw_checkbox_field('estiloa[]', 'Romântico |');?> Romântico<br />
                           <?php echo tep_draw_checkbox_field('estiloa[]', 'Clean |');?> Clean<br />
                           <?php echo tep_draw_checkbox_field('estiloa[]', 'Dark |');?> Dark<br />
                           <?php echo tep_draw_checkbox_field('estiloa[]', 'Relax |');?> Relax<br />
                           <?php echo tep_draw_checkbox_field('estiloa[]', 'Com bastante Humor |');?> Com bastante Humor<br />
                           <?php echo tep_draw_checkbox_field('estiloa[]', 'Bizarro |');?> Bizarro<br />
                           <?php echo tep_draw_checkbox_field('estiloa[]', 'Maluco |');?> Maluco<br />
                           </div>
                           <br style="clear:both" />
                           </fieldset>
                            <br style="clear:both" />
                            
                            <br /><br />
                            
                            <b>Tamanhos, medidas e observações<br />
                            
                            &nbsp;&nbsp;&nbsp;Use o campo abaixo para descrever as medidas, fazer observações, comentários sobre o orçamento e tirar dúvidas. Se julgar mais fácil, desenhe num papel, digitalize e nos envie no passo a seguir.</b>
                            <br />
                            <?php echo tep_draw_textarea_field('enquiryop3', 'soft', 50, 15); ?>
                                
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