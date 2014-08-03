<?
if(SHOW_CATEGORIES_DROPDOWN == 'True'){
	require(DIR_WS_BOXES . 'categories_dropdown.php');
	require(DIR_WS_BOXES . 'manufacturers.php'); 
}else{
?>
<!--
<div style="margin:5px 0 5px 0; text-align:center">
<a href="http://mudominhacasa.wordpress.com/" target="_blank"><img src="images/icon-blog.jpg" /></a>&nbsp;&nbsp;
<a href="https://www.facebook.com/#!/mudominhacasa?fref=ts" target="_blank"><img src="images/icon-facebook.jpg" /></a>&nbsp;&nbsp;
<a href="https://twitter.com/mudominhacasa" target="_blank"><img src="images/icon-twitter.jpg" /></a>&nbsp;&nbsp;
<a href="#" target="_blank"><img src="images/icon-pi.jpg" /></a>
</div>


<div>
    <a href="http://www.mudominhacasa/blog/" target="_blank"><img src="images/blog-rodape.png" width="25" height="24"/></a>
    <a href="https://www.facebook.com/mudominhacasa?fref=ts" target="_blank"><img src="images/facebook-rodape.png" width="25" height="24"/></a>
    <a href="#" target="_blank"><img src="images/gplus-rodape.png" width="25" height="24"/></a>
    <a href="https://twitter.com/mudominhacasa" target="_blank"><img src="images/twitter-rodape.png" width="25" height="24"/></a>
    <a href="#" target="_blank"><img src="images/pinterest-rodape.png" width="25" height="24"/></a>
    <a href="#" target="_blank"><img src="images/instagram-rodape.png" width="25" height="24" /></a>
</div>
-->
<div style="color:#A94F4E; font-family:Tahoma; font-size:17px; height:30px; padding-top:10px; background-color:#FEFEFC"> Adesivos de Parede</div>

<div class="box">
<div class="lay_bordaBox"><span>Ambientes</span></div>
<div class="boxconteudo" style=" padding:0; padding-top:5px; padding-bottom:5px;">
    <div class="sidebarmenu">
    <ul>
    <?php
        $show_full_tree = true;	
        $classname_for_selected = false;  // see superfish.css
        $classname_for_parent = false;  //see superfish.css
        $before_html = '<div class="sidebarmenu">';
        $after_html = '</div>';	
        
        $GLOBALS['this_level'] = 0;
    
        $categories_string = tep_make_catsf_ullist(0, 0, 'and c.categories_highlights = 0 and c.categories_temas = 0 and c.categories_id <> 115');
    
        echo $before_html;	
        echo $categories_string;
        echo $after_html;	
    ?>
    </ul>
    </div>
</div>
</div>

<div class="box">
<div class="lay_bordaBox"><span>Temas</span></div>
<div class="boxconteudo" style=" padding:0; padding-top:5px; padding-bottom:5px;">
    <div class="sidebarmenu">
    <ul>
    <?php
        $show_full_tree = true;	
        $classname_for_selected = false;  // see superfish.css
        $classname_for_parent = false;  //see superfish.css
        $before_html = '<div class="sidebarmenu">';
        $after_html = '</div>';	
        
        $GLOBALS['this_level'] = 0;
    
        $categories_string = tep_make_catsf_ullist(0, 0, 'and c.categories_highlights = 0 and c.categories_temas = 1');
    
        echo $before_html;	
        echo $categories_string;
        echo $after_html;	
    ?>
    </ul>
    </div>
</div>
</div>

<div class="box">
<div class="lay_bordaBox"><span>Coleções Especiais</span></div>
<div class="boxconteudo" style=" padding:0; padding-top:5px; padding-bottom:5px;">
    <div class="sidebarmenu">
    <ul>
    <?php
        $show_full_tree = true;	
        $classname_for_selected = false;  // see superfish.css
        $classname_for_parent = false;  //see superfish.css
        $before_html = '<div class="sidebarmenu">';
        $after_html = '</div>';	
        
        $GLOBALS['this_level'] = 0;
    
        $categories_string = tep_make_catsf_ullist(0, 0, 'and c.categories_highlights = 1');
    
        echo $before_html;	
        echo $categories_string;
        echo $after_html;	
    ?>
    </ul>
    </div>
</div>
</div>

<div class="box">
<div class="lay_bordaBox"><span>Personalizados</span></div>
<div class="boxconteudo" style=" padding:0; padding-top:5px; padding-bottom:5px;">
<div class="sidebarmenu">
	<ul>
    	<li><a href="<?=tep_href_link('produtos-personalizados.php')?>">Produtos Personalizados</a></li>
        <li><a href="<?=tep_href_link('projetos-corporativos.php')?>">Projetos Corporativos</a></li>
        <li><a href="<?=tep_href_link('foto-wall.php')?>">Foto Wall</a></li>
        <li><a href="<?=tep_href_link('foto-art.php')?>">Foto Art</a></li>
        <li><a href="<?=tep_href_link('frases.php')?>">Frases</a></li>
        <li><a href="<?=tep_href_link('envie-seu-modelo.php')?>">Envie seu modelo</a></li>
    </ul>
</div>
</div>
</div>
<? } ?>