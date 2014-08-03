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
	  &nbsp;&nbsp;&nbsp;Voc� sabe qual � o significado das cores? Voc� j� reparou que as cores exercem grande influ�ncia psicol�gica sobre n�s, seres humanos? Algumas cores nos transmitem a id�ia de paz, tranquilidade, serenidade. Outras j� nos passam a id�ia de agita��o, medo ou mesmo de fome. Esta simbologia � usada a todo o momento por profissionais de publicidade em suas pe�as publicit�rias, por artistas, designers, decoradores e diversos outros profissionais. As cores t�m, portanto, finalidades e funcionalidades muito mais abrangentes do que simplesmente est�ticas.<br><br>

&nbsp;&nbsp;&nbsp;Al�m de influenciar o humor, as cores revelam um pouco da personalidade. Muito utilizadas na decora��o de ambientes para estimular sensa��es, elas podem traduzir um pouco do jeito de ser, de acordo com as prefer�ncias de cada um.
<br><br>
<b>Conhe�a um pouco sobre as cores dispon�veis em nossa loja, passe o mouse em cima das cores para saber o significado:</b><br><br>
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
        &nbsp;&nbsp;&nbsp;Cor relacionada ao bom senso, <b>violeta</b> � a cor das pessoas que procuram realiza��o espiritual. Simboliza espiritualidade, criatividade, realeza, sabedoria. O violeta � a cor da magia e da inspira��o espiritual. Promove a purifica��o mental e emocional, elevando a intui��o. � excelente no combate � ins�nia.
        </div>
        <div id="Lil�s">
        &nbsp;&nbsp;&nbsp;A cor <b>lil�s</b> significa sensualidade, beleza, romance. O rosa est� associado ao feminino. Remete para algo amoroso, carinhoso, terno, suave e ao mesmo tempo para certa fragilidade e delicadeza. Est� ainda associado � compaix�o.
        </div>
        <div id="Magenta">
        &nbsp;&nbsp;&nbsp;A cor <b>magenta</b> � uma cor protetora e nutriente, quente e suave, cuja express�o mais elevada � o amor espiritual ou incondicional. Simboliza lux�ria, sofistica��o, sensualidade, feminilidade, desejo.
        </div>
        <div id="VermelhoTomate">
        &nbsp;&nbsp;&nbsp;O <b>vermelho tomate</b> � uma cor quente, estimulante. � a cor da paix�o e do sentimento. Significa paix�o, conquista, desejo, lideran�a e for�a de vontade. � tamb�m s�mbolo de agressividade e poder. Estimula os movimentos, ajuda a combater o estresse e a falta de energia.
        </div>
        <div id="Vermelho">
        &nbsp;&nbsp;&nbsp;O <b>vermelho</b> � uma cor quente, estimulante. � a cor da paix�o e do sentimento. Significa paix�o, conquista, desejo, lideran�a e for�a de vontade. � tamb�m s�mbolo de agressividade e poder. Estimula os movimentos, ajuda a combater o estresse e a falta de energia.
        </div>
        <div id="Bordeaux">
        &nbsp;&nbsp;&nbsp;A cor <b>bordeaux</b> est� associada a maturidade, const�ncia, disciplina, estabilidade, consci�ncia, responsabilidade. A cor est� relacionada a terra, solidez, seguran�a, calma, natureza e a algo r�stico.
        </div>
        <div id="Preto">
        &nbsp;&nbsp;&nbsp;O <b>preto</b> transmite a id�ia de mist�rio, sobriedade, fantasia. Esta cor passa id�ia de introspec��o, auto-an�lise e ainda induz a sensa��o de eleg�ncia. Alem do significado de dignidade, a cor tamb�m est� associada ao poder.
        </div>
        <div id="Cinza">
        &nbsp;&nbsp;&nbsp;A cor <b>cinza</b> transmite a id�ia de equil�brio, sucesso, qualidade, estabilidade. Simboliza eleg�ncia, humildade, respeito, rever�ncia, sutileza. Cor relacionada � organiza��o.
        </div>
        <div id="Cinzaclaro">
        &nbsp;&nbsp;&nbsp;A cor <b>cinza claro</b> esta relacionada a dignidade, auto-controle, sabedoria, responsabilidade, organiza��o e introspec��o. Estimula a auto-observa��o dos pr�prios pensamentos, desejos e sensa��es conscientes. 
        </div>
        <div id="Marrom">
        &nbsp;&nbsp;&nbsp;A cor <b>marrom</b> est� associada a maturidade, const�ncia, disciplina, estabilidade, consci�ncia, responsabilidade. A cor est� relacionada a terra, solidez, seguran�a, calma, natureza e a algo r�stico. 
        </div>
      </div>
      <div id="infoTextos2">
        <div id="Branco">
        &nbsp;&nbsp;&nbsp;O <b>branco</b> est� associado � paz, pureza, verdade, sinceridade, inoc�ncia e calma. � uma cor que transmite ainda o conceito de limpeza. O branco � a cor da sinceridade. Repele energias negativas e promove o equil�brio interior. 
        </div>
        <div id="AzulEscuro">
        &nbsp;&nbsp;&nbsp;O <b>azul escuro</b> � considerada uma cor rom�ntica, talvez porque lembre a cor do mar. � uma cor fria, por�m, mais pura e profunda. Representa a consci�ncia superior e as profundezas da alma. Simboliza a fidelidade, sendo indicado para concentra��o melhor na voz e percep��o interiores.
        </div>
        <div id="Azul">
        &nbsp;&nbsp;&nbsp;A cor <b>azul</b> traz em seu significado a tranquilidade, a lealdade e a confian�a. � uma cor que produz o efeito de afetuosidade, ternura, paz e seguran�a. A cor azul representa a verdade, o trabalho e a prosperidade.
        </div>
        <div id="AzulClaro">
        &nbsp;&nbsp;&nbsp;O <b>azul claro</b> significa tranquilidade, compreens�o e frescor. O azul � uma cor que transmite calma e seguran�a, traz clareza mental e sa�de emocional.
        </div>
        <div id="VerdeEscuro">
        &nbsp;&nbsp;&nbsp;O <b>Verde escuro</b> est� associado ao masculino, lembra grandeza, como um oceano. � uma cor  que simboliza tudo o que � viril. Fertilidade, juventude, desenvolvimento, riqueza s�o suas qualidades.
        </div>
        <div id="Verde">
        &nbsp;&nbsp;&nbsp;O <b>verde</b> � a mais harmoniosa das cores. A cor verde significa juventude, vigor, energia. Representa a energia da m�e natureza, perseveran�a, esperan�a e satisfa��o. Representa o crescimento, desenvolvimento e sa�de.
        </div>
        <div id="VerdeClaro">
        &nbsp;&nbsp;&nbsp;O <b>verde claro</b> significa contentamento, prote��o e calma. Representa o crescimento, desenvolvimento e sa�de.
        </div>
        <div id="Amarelo">
        &nbsp;&nbsp;&nbsp;A cor <b>amarelo</b> traz energia, otimismo, criatividade. � uma cor que desperta e traz esperan�a, transmite calor. O amarelo representa a luz do sol, simboliza a vida, a alegria, a for�a, o poder e o vigor da mente. Seu uso melhora a concentra��o e a facilidade de comunica��o. 
        </div>
        <div id="AmareloOuro">
        &nbsp;&nbsp;&nbsp;Essa cor traz consigo a esperan�a e o sentimento de que tudo correr� bem. Ela tem uma atmosfera de resplendor, brilho, jovialidade e alegria. O <b>amarelo ouro</b> � compreensivo e inspirador; ele refulge e ilumina e, em sua vibra��o mais positiva, essa cor corresponde ao conhecimento e � sabedoria.
        </div>
        <div id="Laranja">
        &nbsp;&nbsp;&nbsp;A cor <b>laranja</b> � uma cor ativa, quente, que significa espontaneidade, movimento, toler�ncia e prosperidade. Cor relacionada � energia, criatividade, equil�brio, entusiasmo e ludismo. � a cor das pessoas que cr�em que tudo � poss�vel.
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
  var cor = new Array("","Preto", "Cinza", "Cinzaclaro", "Marrom", "Violeta", "Lil�s", "Magenta", "VermelhoTomate", "Vermelho", "Bordeaux", "Branco", "AzulEscuro", "Azul", "AzulClaro", "VerdeEscuro", "Verde", "VerdeClaro", "Amarelo", "AmareloOuro", "Laranja");	
 document.getElementById(""+cor[x]+"").style.display ="inline";
	
}
function mouseOut(x){
	var cor = new Array("","Preto", "Cinza", "Cinzaclaro", "Marrom", "Violeta", "Lil�s", "Magenta", "VermelhoTomate", "Vermelho", "Bordeaux", "Branco", "AzulEscuro", "Azul", "AzulClaro", "VerdeEscuro", "Verde", "VerdeClaro", "Amarelo", "AmareloOuro", "Laranja");	
	document.getElementById(""+cor[x]+"").style.display ="none";
}
</script>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>