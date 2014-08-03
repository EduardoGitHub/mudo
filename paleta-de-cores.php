<?php
  require('includes/application_top.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<?php
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title><?php echo TITLE; ?></title>
<?php
}
?>
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<style>
#paleta{ position:relative;width:429px; height:751px; margin:0 auto;}
#infoTextos{ position:absolute; width:180px; height:135px; top: 180px; left:85px; color:#000; font-family:Tahoma; font-size:12px; text-align:left; padding-left:3px; line-height:19px; }
#infoTextos2{ position:absolute; width:180px; height:135px; left: 120px; top:430px; color:#000; font-family:Tahoma; font-size:12px; text-align:left; padding-left:3px; line-height:19px;}
#infoTextos div{ background-color:#FFFFFF; min-width:180px; min-height:130px; position:absolute; padding:5px; text-align:left; border:2px dashed #666; filter:alpha(opacity=85); -moz-opacity:0.85; -khtml-opacity: 0.85;opacity: 0.85; display:none}
#infoTextos2 div{background-color:#FFFFFF;min-width:180px;min-height:130px;position:absolute;padding:5px;text-align:left;border:2px dashed #666;filter:alpha(opacity=85);-moz-opacity:0.85;-khtml-opacity: 0.85;opacity: 0.85; display:none}
area{cursor:pointer}
</style>
</head>
<body>
<div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
<div id="container">
  <div id="sidebar1"><?php require(DIR_WS_INCLUDES . 'column_left.php'); ?></div>
  <div id="mainContent">
      <h1 class="pagestitulo"><span>Paleta de Cores</span></h1>
      
      <p class="pagestexto">
      <br />
	  &nbsp;&nbsp;&nbsp;Você sabe qual é o significado das cores? Você já reparou que as cores exercem grande influência psicológica sobre nós, seres humanos? Algumas cores nos transmitem a idéia de paz, tranquilidade, serenidade. Outras já nos passam a idéia de agitação, medo ou mesmo de fome. Esta simbologia é usada a todo o momento por profissionais de publicidade em suas peças publicitárias, por artistas, designers, decoradores e diversos outros profissionais. As cores têm, portanto, finalidades e funcionalidades muito mais abrangentes do que simplesmente estéticas.<br><br>

&nbsp;&nbsp;&nbsp;Além de influenciar o humor, as cores revelam um pouco da personalidade. Muito utilizadas na decoração de ambientes para estimular sensações, elas podem traduzir um pouco do jeito de ser, de acordo com as preferências de cada um.
<br><br>
<b>Conheça um pouco sobre as cores disponíveis em nossa loja, passe o mouse em cima das cores para saber o significado:</b><br><br>
	</p>

    <div id="paleta">
      <img src="images/mmc_paletadecores.jpg" width="429" height="751" alt="Mapa de imagens. Clique em cada um dos c&iacute;rculos." border="0" usemap="#mapa1" />
      <map name="mapa1">
        <area shape="circle" coords="120,100,29" onmouseover="mouseOver(4)" onmouseout="mouseOut(4)"/>
        <area shape="circle" coords="168,61,31" onmouseover="mouseOver(5)" onmouseout="mouseOut(5)"/>
        <area shape="circle" coords="241,53,30" onmouseover="mouseOver(6)" onmouseout="mouseOut(6)"/>
        <area shape="circle" coords="340,143,32" onmouseover="mouseOver(8)" onmouseout="mouseOut(8)"/>
        <area shape="circle" coords="344,219,32" onmouseover="mouseOver(9)" onmouseout="mouseOut(9)"/>
        <area shape="circle" coords="316,289,32" onmouseover="mouseOver(10)" onmouseout="mouseOut(10)"/>
        <area shape="circle" coords="58,287,32" onmouseover="mouseOver(1)" onmouseout="mouseOut(1)"/>
        <area shape="circle" coords="58,218,32" onmouseover="mouseOver(2)" onmouseout="mouseOut(2)"/>
        <area shape="circle" coords="81,153,32" onmouseover="mouseOver(3)" onmouseout="mouseOut(3)"/>
        <area shape="circle" coords="153,397,32" onmouseover="mouseOver(11)" onmouseout="mouseOut(11)"/>
        <area shape="circle" coords="104,460,32" onmouseover="mouseOver(12)" onmouseout="mouseOut(12)"/>
        <area shape="circle" coords="388,462,32" onmouseover="mouseOver(20)" onmouseout="mouseOut(20)"/>
        <area shape="circle" coords="340,604,32" onmouseover="mouseOver(18)" onmouseout="mouseOut(18)"/>
        <area shape="circle" coords="309,80,32" onmouseover="mouseOver(7)" onmouseout="mouseOut(7)"/>
        <area shape="circle" coords="288,653,32" onmouseover="mouseOver(17)" onmouseout="mouseOut(17)"/>
        <area shape="circle" coords="224,691,32" onmouseover="mouseOver(16)" onmouseout="mouseOut(16)"/>
        <area shape="circle" coords="142,685,32" onmouseover="mouseOver(15)" onmouseout="mouseOut(15)"/>
        <area shape="circle" coords="77,540,32" onmouseover="mouseOver(13)" onmouseout="mouseOut(13)"/>
        <area shape="circle" coords="90,626,32" onmouseover="mouseOver(14)" onmouseout="mouseOut(14)"/>
        <area shape="circle" coords="376,537,32" onmouseover="mouseOver(19)" onmouseout="mouseOut(19)"/>
      </map>
      <div id="infoTextos">	
        <div id="Violeta">
        &nbsp;&nbsp;&nbsp;Cor relacionada ao bom senso, <b>violeta</b> é a cor das pessoas que procuram realização espiritual. Simboliza espiritualidade, criatividade, realeza, sabedoria. O violeta é a cor da magia e da inspiração espiritual. Promove a purificação mental e emocional, elevando a intuição. É excelente no combate à insônia.
        </div>
        <div id="Lilás">
        &nbsp;&nbsp;&nbsp;A cor <b>lilás</b> significa sensualidade, beleza, romance. O rosa está associado ao feminino. Remete para algo amoroso, carinhoso, terno, suave e ao mesmo tempo para certa fragilidade e delicadeza. Está ainda associado à compaixão.
        </div>
        <div id="Magenta">
        &nbsp;&nbsp;&nbsp;A cor <b>magenta</b> é uma cor protetora e nutriente, quente e suave, cuja expressão mais elevada é o amor espiritual ou incondicional. Simboliza luxúria, sofisticação, sensualidade, feminilidade, desejo.
        </div>
        <div id="VermelhoTomate">
        &nbsp;&nbsp;&nbsp;O <b>vermelho tomate</b> é uma cor quente, estimulante. É a cor da paixão e do sentimento. Significa paixão, conquista, desejo, liderança e força de vontade. É também símbolo de agressividade e poder. Estimula os movimentos, ajuda a combater o estresse e a falta de energia.
        </div>
        <div id="Vermelho">
        &nbsp;&nbsp;&nbsp;O <b>vermelho</b> é uma cor quente, estimulante. É a cor da paixão e do sentimento. Significa paixão, conquista, desejo, liderança e força de vontade. É também símbolo de agressividade e poder. Estimula os movimentos, ajuda a combater o estresse e a falta de energia.
        </div>
        <div id="Bordeaux">
        &nbsp;&nbsp;&nbsp;A cor <b>bordeaux</b> está associada a maturidade, constância, disciplina, estabilidade, consciência, responsabilidade. A cor está relacionada a terra, solidez, segurança, calma, natureza e a algo rústico.
        </div>
        <div id="Preto">
        &nbsp;&nbsp;&nbsp;O <b>preto</b> transmite a idéia de mistério, sobriedade, fantasia. Esta cor passa idéia de introspecção, auto-análise e ainda induz a sensação de elegância. Alem do significado de dignidade, a cor também está associada ao poder.
        </div>
        <div id="Cinza">
        &nbsp;&nbsp;&nbsp;A cor <b>cinza</b> transmite a idéia de equilíbrio, sucesso, qualidade, estabilidade. Simboliza elegância, humildade, respeito, reverência, sutileza. Cor relacionada à organização.
        </div>
        <div id="Cinzaclaro">
        &nbsp;&nbsp;&nbsp;A cor <b>cinza claro</b> esta relacionada a dignidade, auto-controle, sabedoria, responsabilidade, organização e introspecção. Estimula a auto-observação dos próprios pensamentos, desejos e sensações conscientes. 
        </div>
        <div id="Marrom">
        &nbsp;&nbsp;&nbsp;A cor <b>marrom</b> está associada a maturidade, constância, disciplina, estabilidade, consciência, responsabilidade. A cor está relacionada a terra, solidez, segurança, calma, natureza e a algo rústico. 
        </div>
      </div>
      <div id="infoTextos2">
        <div id="Branco">
        &nbsp;&nbsp;&nbsp;O <b>branco</b> está associado à paz, pureza, verdade, sinceridade, inocência e calma. É uma cor que transmite ainda o conceito de limpeza. O branco é a cor da sinceridade. Repele energias negativas e promove o equilíbrio interior. 
        </div>
        <div id="AzulEscuro">
        &nbsp;&nbsp;&nbsp;O <b>azul escuro</b> é considerada uma cor romântica, talvez porque lembre a cor do mar. É uma cor fria, porém, mais pura e profunda. Representa a consciência superior e as profundezas da alma. Simboliza a fidelidade, sendo indicado para concentração melhor na voz e percepção interiores.
        </div>
        <div id="Azul">
        &nbsp;&nbsp;&nbsp;A cor <b>azul</b> traz em seu significado a tranquilidade, a lealdade e a confiança. É uma cor que produz o efeito de afetuosidade, ternura, paz e segurança. A cor azul representa a verdade, o trabalho e a prosperidade.
        </div>
        <div id="AzulClaro">
        &nbsp;&nbsp;&nbsp;O <b>azul claro</b> significa tranquilidade, compreensão e frescor. O azul é uma cor que transmite calma e segurança, traz clareza mental e saúde emocional.
        </div>
        <div id="VerdeEscuro">
        &nbsp;&nbsp;&nbsp;O <b>Verde escuro</b> está associado ao masculino, lembra grandeza, como um oceano. É uma cor  que simboliza tudo o que é viril. Fertilidade, juventude, desenvolvimento, riqueza são suas qualidades.
        </div>
        <div id="Verde">
        &nbsp;&nbsp;&nbsp;O <b>verde</b> é a mais harmoniosa das cores. A cor verde significa juventude, vigor, energia. Representa a energia da mãe natureza, perseverança, esperança e satisfação. Representa o crescimento, desenvolvimento e saúde.
        </div>
        <div id="VerdeClaro">
        &nbsp;&nbsp;&nbsp;O <b>verde claro</b> significa contentamento, proteção e calma. Representa o crescimento, desenvolvimento e saúde.
        </div>
        <div id="Amarelo">
        &nbsp;&nbsp;&nbsp;A cor <b>amarelo</b> traz energia, otimismo, criatividade. É uma cor que desperta e traz esperança, transmite calor. O amarelo representa a luz do sol, simboliza a vida, a alegria, a força, o poder e o vigor da mente. Seu uso melhora a concentração e a facilidade de comunicação. 
        </div>
        <div id="AmareloOuro">
        &nbsp;&nbsp;&nbsp;Essa cor traz consigo a esperança e o sentimento de que tudo correrá bem. Ela tem uma atmosfera de resplendor, brilho, jovialidade e alegria. O <b>amarelo ouro</b> é compreensivo e inspirador; ele refulge e ilumina e, em sua vibração mais positiva, essa cor corresponde ao conhecimento e à sabedoria.
        </div>
        <div id="Laranja">
        &nbsp;&nbsp;&nbsp;A cor <b>laranja</b> é uma cor ativa, quente, que significa espontaneidade, movimento, tolerância e prosperidade. Cor relacionada à energia, criatividade, equilíbrio, entusiasmo e ludismo. É a cor das pessoas que crêem que tudo é possível.
        </div>
      </div>
     </div> 
      
      <div><a onclick="history.go(-1)" style="cursor:pointer"><?=tep_image_button('button_back.gif', IMAGE_BUTTON_BACK)?></a></div>
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
<script type="text/javascript">
function mouseOver(x){
  var cor = new Array("","Preto", "Cinza", "Cinzaclaro", "Marrom", "Violeta", "Lilás", "Magenta", "VermelhoTomate", "Vermelho", "Bordeaux", "Branco", "AzulEscuro", "Azul", "AzulClaro", "VerdeEscuro", "Verde", "VerdeClaro", "Amarelo", "AmareloOuro", "Laranja");	
 document.getElementById(""+cor[x]+"").style.display ="inline";
	
}
function mouseOut(x){
	var cor = new Array("","Preto", "Cinza", "Cinzaclaro", "Marrom", "Violeta", "Lilás", "Magenta", "VermelhoTomate", "Vermelho", "Bordeaux", "Branco", "AzulEscuro", "Azul", "AzulClaro", "VerdeEscuro", "Verde", "VerdeClaro", "Amarelo", "AmareloOuro", "Laranja");	
	document.getElementById(""+cor[x]+"").style.display ="none";
}
</script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>