<?php
include_once('includes/configure.php');
$conexao = mysql_connect ( DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db(DB_DATABASE,$conexao) or die("erro ao conectar");

switch($_GET['action']){	
case 'inReg'; 
function checa_email($email)
{
	// Expressao regular para verificar e-mail
	$regex = '/^[A-z0-9][\w.-]*@[A-z0-9][\w\-\.]+\.[A-z0-9]{2,6}$/';
	
	// caso o email seja valido, verifica se ja esta cadastrado
	$sql = "SELECT * FROM newsletter WHERE email = '".$email."'";
	$resultq = mysql_query($sql);
	// Caso o e-mail seja invalido
	if(!preg_match($regex, $email, $match))
	{
		// Escreve mensagem de erro
		$erro = "Erro";
		print 'alert("Informe um e-mail válido!")';
	}else if(mysql_num_rows($resultq) > 0)
			{
				// Caso esteja, escreve mensagem de erro
				$erro = "Erro";
				print 'alert("E-mail já existente! Informe outro e-mail.")';
			}else{
				$erro = "";
			}
	
	return $erro;
}	

$erro_email = checa_email($_GET['email']);
if($erro_email == ""){
print 'alert("Email cadastrado com sucesso!")';
$sql = mysql_query("INSERT INTO newsletter(email,nome)VALUES('".$_GET['email']."','".$_GET['nome']."')");
}
break;
}
?>
