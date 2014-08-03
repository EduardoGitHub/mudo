<?php
/*
  $Id: pollbooth.php,v 1.5 2003/04/06 21:45:33 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/
if (!isset($HTTP_GET_VARS['op'])) {
	$HTTP_GET_VARS['op']="list";
	}
if ($HTTP_GET_VARS['op']=='results') {
  define('TOP_BAR_TITLE', 'Polling Booth');
  define('HEADING_TITLE', 'Veja o que os outros est�o pensando');
  define('SUB_BAR_TITLE', 'Resultados da enquete');
}
if ($HTTP_GET_VARS['op']=='list') {
  define('TOP_BAR_TITLE', 'Polling Booth');
  define('HEADING_TITLE', 'N�s valorizamos os seus pensamentos');
  define('SUB_BAR_TITLE', 'Vota��es anteriores');
}
if ($HTTP_GET_VARS['op']=='vote') {
  define('TOP_BAR_TITLE', 'Polling Booth');
  define('HEADING_TITLE', 'D� a sua opini�o');
  define('SUB_BAR_TITLE', 'Vote nesta enquete');
}
if ($HTTP_GET_VARS['op']=='comment') {
  define('HEADING_TITLE', 'Comente esta enquete');
}
define('_WARNING', 'Aten��o : ');
define('_ALREADY_VOTED', 'Recentemente, voc� votou nesta enquete.');
define('_NO_VOTE_SELECTED', 'Voc� n�o selecionou nenhuma op��o para votar.');
define('_TOTALVOTES', 'Total de votos');
define('_OTHERPOLLS', 'Outras Enquetes');
define('NAVBAR_TITLE_1', 'Polling Booth');
define('_POLLRESULTS', 'Clique aqui para ver o resultado da enquete');
define('_VOTING', 'Vote Agora');
define('_RESULTS', 'Resultados');
define('_VOTES', 'Votos');
define('_VOTE', 'VOTAR');
define('_COMMENT', 'Coment�rio');
define('_COMMENTS', 'Coment�rios');
define('_COMMENTS_POSTED', 'Coment�rios Postados');
define('_COMMENTS_BY', 'Coment�rio feito por ');
define('_COMMENTS_ON', ' on ');
define('_YOURNAME', 'Seu nome');
define('_PUBLIC','P�blico');
define('_PRIVATE','Particular');
define('_POLLOPEN','Enquete em andamento');
define('_POLLCLOSED','Enquete Finalizada');
define('_POLLPRIVATE','Voto restrito, voc� precisa estar logado para votar');
define('_ADD_COMMENTS', 'Comentar');
define('TEXT_DISPLAY_NUMBER_OF_COMMENTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> comments)');
?>
