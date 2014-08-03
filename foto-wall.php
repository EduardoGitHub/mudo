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
      <div class="pagestitulo"><span>Quero fazer meu foto Wall personalizado!</span></div><br/>
      <?php if ($messageStack->size('foto-wall') > 0) echo $messageStack->output('foto-wall'); ?>
 
      <div class="pagestexto">
      <?php echo tep_draw_form('foto-wall', tep_href_link('envie-seus-arquivos.php', 't=Foto-Wall'), 'post'); ?>
      			<input type="hidden" name="action" value="sendwal" />
                  <!--<div class="OrcTitulosLink"><a href="<?= tep_href_link('foto-wall.php')?>">Quero fazer meu Projeto Exclusivo!</a></div>-->
                    <div class="OrcOpcao">
                        <span class="main">&nbsp;&nbsp;&nbsp;Quer imortalizar todos os seus momentos inesquecíveis e ainda causar um impacto no visual da sua casa? Fazemos uma montagem fotográfica super interessante para você mesmo aplicar. Pode ser uma foto de paisagem na parede, uma montagem com várias fotos de sua família ou amigos, ou o que você julgar interessante.</span><br /><br />
                        
                        <?
						$products_new_query = tep_db_query("select * from ".TABLE_GALLERY_STUDIO." WHERE gallery_type = 5");
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
                        
                        <b>Qual o nome ou número do modelo escolhido:</b><br /><br />
                        <?php echo tep_draw_input_field('modelo','','size="60"'); ?>
                    <br /><br />    
                        
                        <b>Qual o espaço que você tem disponível, ao qual o modelo deve se adaptar?</b><br /><br />
                        Largura:<?php echo tep_draw_input_field('tamanhoLarop4','','size="15"'); ?>cm <b>X</b> 
                        Altura:<?php echo tep_draw_input_field('tamanhoAltop4','','size="15"'); ?>cm. <br /> <br />
                        
                        <b>Qual a quantidade de fotos você quer distribuir no espaço?</b><br /><br />
                        <?php echo tep_draw_input_field('quantftop4','','size="15"'); ?> ex.: (01, 03, 10, 25, 50, 75, 100...)<br /><br />
                        
                        <b>Qual estilo da imagem final você gostaria?</b><br /><br />
                        
                        <div style="float:left; width:200px;"><input type="radio" name="estiloop4" value="Colorido" checked="checked" /> <b>Colorido</b><br /> <img src="images/fotowall imagem formulario _colorido.jpg" /></div>
                        <div style="float:left; width:200px;"><input type="radio" name="estiloop4" value="Envelhecido" /> <b>Envelhecido</b><br /> <img src="images/fotowall imagem formulario _envelhecido.jpg" /></div>
                        <div style="float:left; width:220px;"><input type="radio" name="estiloop4" value="Preto e Branco" /> <b>Preto e Branco</b><br /> <img src="images/fotowall imagem formulario _preto_e_branco.jpg" /></div>
                        <br style="clear:left;"/><br /><br />
                        
                        <br style="clear:left;"/><br /><br />
                        
                        <b>&nbsp;&nbsp;&nbsp;Use o campo abaixo para fazer observações e comentários sobre o orçamento, pedir para incluir nomes,fazer em outros formatos, incluir bordas, tirar dúvidas e apresentar suas próprias idéias...</b>
                        <?php echo tep_draw_textarea_field('enquiryop4', 'soft', 50, 15); ?>
                       
                        <div class="titulos">3° Passo - Envio das Fotos!</div>
                        <b>
                        &nbsp;&nbsp;&nbsp;- Junto com o orçamento você receberá as instruções para envio das fotografias e de pagamento.<br />
&nbsp;&nbsp;&nbsp;- As imagens deverão estar com qualidade compatível com o tamanho da impressão preterida.</b>
<br /><br />
                            <!--<div style="background-color:#CCD9FF; width:98%; padding-left:10px;">
                                <br /><b>ATENÇÃO</b><br />
                                - O envio de arquivos é opcional, para concluir esta etapa clique em CONTINUAR.<br />
                                - Não inclua caracteres especiais como acentos ou espaços em branco no nome.<br />
                                - Tamanho máximo para envio do arquivo: 16MB <br />
                                - Preferência no envio de arquivos em Corel Draw convertidos em curva<br />
                                - Serão aceitos arquivos .zip; .rar; .cdr; .psd; .jpg; .tif; .gif; .bmp;<br /><br />
                            </div><br /><br />
                            <input type="file" name="arquivoop4[]" size="40"><br /><br />
                            <input type="file" name="arquivoop4[]" size="40"><br /><br />
                            <input type="file" name="arquivoop4[]" size="40"><br /><br />
                            <input type="file" name="arquivoop4[]" size="40"><br /><br />
                            <input type="file" name="arquivoop4[]" size="40"><br /><br /> 
                        <br /><br />-->
                        <div class="titulos">4° Passo - Enviar formulário:</div>
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