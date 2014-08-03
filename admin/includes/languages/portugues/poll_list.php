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
  define('HEADING_TITLE', 'Veja o que os outros estão pensando');
  define('SUB_BAR_TITLE', 'Resultados da enquete');
}
if ($HTTP_GET_VARS['op']=='list') {
  define('TOP_BAR_TITLE', 'Polling Booth');
  define('HEADING_TITLE', 'Nós valorizamos os seus pensamentos');
  define('SUB_BAR_TITLE', 'Votações anteriores');
}
if ($HTTP_GET_VARS['op']=='vote') {
  define('TOP_BAR_TITLE', 'Polling Booth');
  define('HEADING_TITLE', 'Dê a sua opinião');
  define('SUB_BAR_TITLE', 'Vote nesta enquete');
}
if ($HTTP_GET_VARS['op']=='comment') {
  define('HEADING_TITLE', 'Comente esta enquete');
}
define('_WARNING', 'Atenção : ');
define('_ALREADY_VOTED', 'Recentemente, você votou nesta enquete.');
define('_NO_VOTE_SELECTED', 'Você não selecionou nenhuma opção para votar.');
define('_TOTALVOTES', 'Total de votos');
define('_OTHERPOLLS', 'Outras Enquetes');
define('NAVBAR_TITLE_1', 'Polling Booth');
define('_POLLRESULTS', 'Clique aqui para ver o resultado da enquete');
define('_VOTING', 'Vote Agora');
define('_RESULTS', 'Resultados');
define('_VOTES', 'Votos');
define('_VOTE', 'VOTAR');
define('_COMMENT', 'Comentário');
define('_COMMENTS', 'Comentários');
define('_COMMENTS_POSTED', 'Comentários Postados');
define('_COMMENTS_BY', 'Comentário feito por ');
define('_COMMENTS_ON', ' on ');
define('_YOURNAME', 'Seu nome');
define('_PUBLIC','Público');
define('_PRIVATE','Particular');
define('_POLLOPEN','Enquete em andamento');
define('_POLLCLOSED','Enquete Finalizada');
define('_POLLPRIVATE','Voto restrito, você precisa estar logado para votar');
define('_ADD_COMMENTS', 'Comentar');
define('TEXT_DISPLAY_NUMBER_OF_COMMENTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> comments)');
?>
