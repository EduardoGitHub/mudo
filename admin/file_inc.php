<?php
/**
* @author F�bio Miranda Costa
* Usado para compactar arquivos JS e CSS, acrescenta-os ao cache do browser
* e faz algumas melhorias adicionais. <script src="incs/file_inc.php?file=funcs.js" type="text/javascript"><!--mce:0--></script>
*/
$file = $_GET["file"];
$ext = substr($file,strrpos($file, ".")+1,strlen($file));
ob_start ("ob_gzhandler");
if($ext=="js") $ext="javascript";
header( "Content-type: text/".$ext."; charset: <span class='attribute-value'>iso-8859-1</span>");//n�o se esque�a de mudar para o charset que voc� usa
header( "Content-Encoding: gzip,deflate");
header( "Expires: ".gmdate("D, d M Y H:i:s", time() + (168 * 60 * 60)) . " GMT");//adiciona 1 dia ao tempo de expira��o
header( "ETag: ");//a  id�ia � apagar o conte�do da Etag, ver post http://www.meiocodigo.com/2007/12/21/melhorando-o-tempo-de-carregamento-de-um-site/
header( "Cache-Control: must-revalidate, proxy-revalidate" );
include($file);
ob_flush();
