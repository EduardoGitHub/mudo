<? 
// set the level of error reporting
  error_reporting(E_ALL & ~E_NOTICE);

// Set the local configuration parameters - mainly for developers
  if (file_exists('includes/local/configure.php')) include('includes/local/configure.php');

// include server parameters
  require('includes/configure.php');

// include the list of project filenames
  require(DIR_WS_INCLUDES . 'filenames.php');

// include the list of project database tables
  require(DIR_WS_INCLUDES . 'database_tables.php');

// include the database functions
  require(DIR_WS_FUNCTIONS . 'database.php');
// make a connection to the database... now
  tep_db_connect() or die('Unable to connect to database server!');

// set the application parameters
  $configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
  }
  
if(STORE_OPENED == 'True'){
echo "<script>window.location = 'index.php'</script>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script>
function Cxpassword(valor){
	if(valor == 1){
		document.formulario.conv.disabled = false;
		document.getElementById("trCat").style.display="inline";
	}	

}	
</script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=STORE_NAME; ?></title>
</head>

<body bottommargin="0" leftmargin="0" rightmargin="0" topmargin="50">
<table width="100" border="0" cellspacing="0" cellpadding="0" align="center">

  <tr>
  	<td align="center"><img src="images/logomarca.jpg" align="center" /></td>
  </tr>	
  <tr>
    <td>
		<table width="578" height="282" border="0" cellspacing="0" cellpadding="0" align="center" background="images/loja_manutencao.jpg">
		  <tr>
			<td style="padding-left:18px">
				<table width="96%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="37%" rowspan="2"><img src="images/alert_informativo.gif" /></td>
				  </tr>
				  <tr>
					<td valign="bottom">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td style="font-family:Verdana; font-size:16px; font-weight:bolder;"><strong>LOJA FECHADA PARA MANUTENÇÃO</strong></td>
						  </tr>
						  <tr>
							<td height="80" style="font-family:Verdana; font-size:11px; color:#333333; vertical-align:top; padding-top:3px;"><?php echo ENTRY_TEXT_STORE_CLOSED;?></td>
						  </tr>
						</table>
					</td>
				  </tr>
				</table>
			</td>
		  </tr>
		</table>
	</td>
  </tr>
  <tr>
    <td align="right" style="padding-right:20px;"><a href="#" style="color:#666666; font-family:Verdana; font-size:10px;" onClick="Cxpassword('1')">ADMIN</a></td>
  </tr>
  <tr>
  	<td height="10"></td>
  </tr>	
	<tr id="trCat" style="display:none; padding-left:360px;">
		<td style="color:#666666; font-family:Verdana; font-size:10px; padding-right:20px;">
			<form name="formulario" method="post" action="index.php">
			<input type="hidden" id="conv" />
			Senha: <input type="password" name="store_open_admin" style="font-family:Verdana; font-size:10px;:"/>
			&nbsp;<input type="submit" value="OK" style="font-size:10px; font-weight:bold; font-family:Arial;" />
			</form>
		</td>
		
	</tr>
</table>
</body>
</html>