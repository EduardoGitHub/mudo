<?php
  require('includes/application_top.php');

// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
  if ($session_started == false) {
    tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
  }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<head>
<?php
if ( file_exists(DIR_WS_INCLUDES . 'header_tags.php') ) {
  require(DIR_WS_INCLUDES . 'header_tags.php');
} else {
?>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
  <title><?php echo TITLE; ?></title>
<?php
}
?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link rel="stylesheet" type="text/css" href="stylesheet.css"/>
<style type="text/css">
.styleNewsDate {font-family: Arial, Helvetica, sans-serif; font-size: 20px; color: #FFFFFF; }
.styleNewsTitle {font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #000000; font-weight:bold; }
.styleNewsSubTitle {font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #000000; font-style:italic; }
.styleNews {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-weight:normal; }
</style>
</head>
<body>
<div id="container">
  <div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
  <div id="sidebar1"><?php require(DIR_WS_INCLUDES . 'column_left.php'); ?></div>
  <div id="sidebar2"><?php require(DIR_WS_INCLUDES . 'column_right.php'); ?></div>
  <div id="mainContent">
  
  	<div class="pagestitulo"><span>NOTÍCIAS</span></div>
	
    <div class="pagestexto">	
    <div class="addthis_toolbox addthis_default_style" style="padding-top:5px;">
        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
        <a class="addthis_button_tweet"></a>
        <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
        <a class="addthis_counter addthis_pill_style"></a>
      </div><br />
       <?php

			if(isset($_GET['idnot']) && $_GET['idnot'] != 0 )
			$sql = "SELECT * FROM news where UID = ".$_GET['idnot'];
			else
            $sql = "SELECT * FROM news ORDER BY date DESC";
            $result = mysql_query($sql) or die (mysql_error());
            $num = mysql_num_rows($result);
            if($num > 0)
            {
                
				if(!isset($_GET['idnot']) && $_GET['idnot'] <1 ){
				echo 'Veja abaixo todas as notícias postadas por nosso empresa.<br /><br />';	
				echo ' <table width="100%" border="0" cellspacing="0" cellpadding="0">';
                while($row = mysql_fetch_assoc($result))
                {
					$today = getdate(strtotime($row['date']));
					$cadastrado_dia = diaDaSemana($today["weekday"]).' '.$today["mday"].' '.mesReferente($today["month"]).' de '.$today["year"];
					$row_title = $row['title'];
					echo '
					<tr><td class="main">Publicação: '. $cadastrado_dia .'</td></tr>
					<tr><td class="styleNewsTitle">' . $row_title . '<a href="'.tep_href_link('news.php','idnot='.$row['UID']).'" target="_top" style="color:#0066CC; font-weight:normal; font-size:11px;"> (Ler notícia)</a></td></tr>
					<tr><td style="border-top:1px solid #ccc" height="20"></td></tr>';
                }
                echo '</table>';
				}
         }
		 
		 if(isset($_GET['idnot']) && $_GET['idnot'] != 0 ){
			 		$row = mysql_fetch_assoc($result);
		 			$row_phpdatetime = strtotime($row['date']);
                    $row_day = date("d", $row_phpdatetime);
                    $row_month = getdate(strtotime($row['date']));
                    $row_year = date("Y", $row_phpdatetime);
                    $row_title = $row['title'];
                    $row_subtitle = $row['subtitle'];
                    $row_body = str_replace("\n", "<br/>", $row['body']);
					
					if($row['foto']!='')
					$foto = '<img src="images/noticias/'.$row['foto'].'" alt="Imagem da notícia" align="left" width="200" />';
		  echo '
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20">&nbsp;</td>
                <td width="111" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="90" height="45" align="center" valign="middle" background="images/top.png"><span class="styleNewsDate">' . substr(mesReferente($row_month["month"]),0,3)  . ' '.$row_day.'</span></td>
                    <td width="20" align="center" valign="middle">&nbsp;</td>
                    <td rowspan="2" align="center" valign="middle"><table border="0" cellpadding="0" cellspacing="0" bgcolor="#cccccc">
                      <tr>
                        <td width="1" height="75"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td width="90" height="45" align="center" valign="middle" background="images/bottom.png"><span class="styleNewsDate">' . $row_year . '</span></td>
                    <td align="center" valign="middle">&nbsp;</td>
                    </tr>
                </table></td>
                <td width="20">&nbsp;</td>
                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="styleNewsTitle">' . $row_title . '</td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td class="styleNewsSubTitle" style="padding-left:20px">' . $row_subtitle . '</td>
                  </tr>
                  <tr>
                    <td class="styleNews">'.$foto.' ' . $row_body . '...</td>
                  </tr>
                </table></td>
                <td>&nbsp;</td>
              </tr>
              
            </table>
            </td>
          </tr>
          <tr>
          <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <td height="12"></td>
          </tr>
          <tr>
            <td height="1" bgcolor="#cccccc"></td>
          </tr>
          <tr>
            <td height="12"></td>
          </tr>
          </table>	  </td>
                    </table>';
		 }
        ?>
    </div>
	  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
<?php require(DIR_WS_INCLUDES . 'footer-rights.php'); ?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>