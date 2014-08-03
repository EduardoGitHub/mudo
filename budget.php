<?php
  require('includes/application_top.php'); 
  switch ($_GET['opcao']){
  	case 1:
		Header( "HTTP/1.1 301 Moved Permanently" );
        Header( "Location: http://www.mudominhacasa.com.br/projetos-corporativos.php" );
	break;
	case 2:
		Header( "HTTP/1.1 301 Moved Permanently" );
        Header( "Location: http://www.mudominhacasa.com.br/frases.php" );
	break;
	case 3:
		Header( "HTTP/1.1 301 Moved Permanently" );
        Header( "Location: http://www.mudominhacasa.com.br/foto-art.php" );
	break;
	case 4:
		Header( "HTTP/1.1 301 Moved Permanently" );
        Header( "Location: http://www.mudominhacasa.com.br/foto-wall.php" );
	break;
	case 6:
		Header( "HTTP/1.1 301 Moved Permanently" );
        Header( "Location: http://www.mudominhacasa.com.br/produtos-personalizados.php" );
	break;
	case 7:
		Header( "HTTP/1.1 301 Moved Permanently" );
        Header( "Location: http://www.mudominhacasa.com.br/alterar-tamanho-de-sua-imagem.php" );
	break;
	case 8:
		Header( "HTTP/1.1 301 Moved Permanently" );
        Header( "Location: http://www.mudominhacasa.com.br/envie-seu-modelo.php" );
	break;
  }
?>

