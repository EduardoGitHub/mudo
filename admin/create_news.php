<?
/*
	Id: create_news.php v1.0
		
	osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  
  Copyright (c) 2009 Nicholas Vergunst
*/

require('includes/application_top.php');
require("includes/browser_check.php");

$phpself_basename = basename(__FILE__);
$_SERVER['PHP_SELF'] = HTTP_SERVER . substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], $phpself_basename)) . $phpself_basename;
	
$action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : ''); 

if($action == "save")
{
	if (isset($_POST['news_form_title']) && isset($_POST['news_form_subtitle']) && isset($_POST['news_form_body']) && isset($_POST['news_form_date']))
	{
		$news_title = $_POST['news_form_title'];
		$news_subtitle = $_POST['news_form_subtitle'];
		$news_body = $_POST['news_form_body'];
		$news_date_orig = $_POST['news_form_date'];
		list($news_date_day, $news_date_month, $news_date_year, $news_date_hour, $news_date_minute, $news_date_second) = preg_split('(\D)', $news_date_orig);
		$news_date = date('Y-m-d H:i:s', mktime($news_date_hour, $news_date_minute, $news_date_second, $news_date_month, $news_date_day, $news_date_year));
		//echo $news_date_day . " " . $news_date_month . " " . $news_date_year . " " . $news_date_hour . " " . $news_date_minute . " " . $news_date_second . "<br><br>";

		//echo "Title: " . $news_title . "<br>Subtitle: " . $news_subtitle . "<br>Body: " . $news_body . "<br>Date: " . $news_date . "<br>";
		
		//echo "saving<br><br>";
			
		if(isset($HTTP_GET_VARS['UID']))
		{
			$edit_news_UID = $HTTP_GET_VARS['UID'];
			//editing
			//echo "editing<br>";
			
				$foto = new upload('news_form_foto');
				$foto->set_destination(DIR_FS_CATALOG.'images/noticias/');
				if ($foto->parse() && $foto->save()) {
				  unlink(DIR_FS_CATALOG.'images/noticias/'.$HTTP_POST_VARS['nome_foto']);	
				  $foto_name = $foto->filename;
				} else {
				  $foto_name = $HTTP_POST_VARS['nome_foto'];
				}
			
			$edit_news_result = mysql_query("UPDATE news SET title='$news_title', subtitle='$news_subtitle', body='$news_body', foto='$foto_name', date='$news_date' WHERE UID='$edit_news_UID'") or die(" Error: ".mysql_error());
		}
		else
		{
			//create new
			//echo "create new<br>";
			
				$foto = new upload('news_form_foto');
				$foto->set_destination(DIR_FS_CATALOG.'images/noticias/');
				if ($foto->parse() && $foto->save()) {
				  $foto_name = $foto->filename;
				} else {
				  $foto_name = (isset($HTTP_POST_VARS['news_form_foto']) ? $HTTP_POST_VARS['news_form_foto'] : '');
				}
			
			
			
			$create_news_sql = mysql_query("INSERT INTO news (`title`, `subtitle`, `body`, `date`, `foto`) VALUES ('$news_title', '$news_subtitle', '$news_body', '$news_date', '$foto_name')") or die (mysql_error());
		}
		//print_r($_POST);
	}
	else
	{
		//echo "error not enough info";
	}
	echo "<META HTTP-EQUIV=\"refresh\" content=\"0; URL=" . $_SERVER['PHP_SELF'] . "\">";
	exit();
}
else if($action == "delete")
{
	//echo "delete<br>";
	if (isset($_POST['confirm_delete']) && isset($HTTP_GET_VARS['UID']))
	{
		
		$delete_news_UID = $HTTP_GET_VARS['UID'];
		$news_sql = mysql_query("SELECT foto FROM news where UID=".$delete_news_UID);
		$news= mysql_fetch_assoc($news_sql);
		unlink(DIR_FS_CATALOG.'images/noticias/'.$news['foto']);
		$delete_news_result = mysql_query("DELETE FROM news WHERE UID='$delete_news_UID' LIMIT 1") or die(" Error: ".mysql_error());
		//echo "delete confirmed";
		echo "<META HTTP-EQUIV=\"refresh\" content=\"0; URL=" . $_SERVER['PHP_SELF'] . "\">";
		exit();
	}
	else
	{
		//echo "delete NOT confirmed";	
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html <?php echo HTML_PARAMS; ?>>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">

<title><?php echo TITLE; ?></title>

<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script type="text/javascript" src="includes/librays/ckeditor/ckeditor.js"></script>
<link href="includes/librays/ckeditor/contents.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="includes/general.js"></script>

<script language="JavaScript" src="<?php echo CREATE_NEWS_JS . 'ts_picker.js'; ?>"></script>

<style type="text/css">
<!--
.news_dataTableContent
{
	white-space:nowrap;
	padding-right:10px;
	padding-left:20px;
}
-->
</style>

</head>

<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="SetFocus();">

<!-- header //-->

<?php require(DIR_WS_INCLUDES . 'header.php'); ?>

<!-- header_eof //-->

<!-- body //-->

<table border="0" width="100%" cellspacing="0" cellpadding="0">


<!--  begin create_news -->
<?php
	if($action == "")
	{
		$news_sql = "SELECT * FROM news ORDER BY date DESC";
	}
	else if($action == "edit" || $action == "delete")
	{
		$php_edit_UID = (isset($HTTP_GET_VARS['UID']) ? $HTTP_GET_VARS['UID'] : '');
		$news_sql = "SELECT * FROM news WHERE UID=" . $php_edit_UID . " ORDER BY date DESC";
	}
	
	if($action != "create") // Nothing to query if it is new...
	{
		$news_result = mysql_query($news_sql) or die (mysql_error());
	}
	
	if($action == "")
	{
		$news_heading_text = HEADING_TITLE_MAIN;
	}
	else if($action == "create")
	{
		$news_heading_text = HEADING_TITLE_CREATE;
	}
	else if($action == "edit")
	{
		$news_heading_text_title = mysql_result($news_result, 0, 'title');
		$news_heading_text = HEADING_TITLE_UPDATE . ' <span style="font-style:italic;">[' . $php_edit_UID . '] ' . $news_heading_text_title . '</span>';
		mysql_data_seek($news_result, 0);
	}
	else if($action == "delete")
	{
		$news_heading_text = HEADING_TITLE_CONFIRM_DELETE;
	}

?>
			<td width="100%" valign="top" id="main">
            	<table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                	<td valign="top">
                        <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td valign="middle" align="left" class="pageHeading">
                               <?php echo $news_heading_text; ?>
                            </td>
                            <!--<td width="90px">
                                <img src="<?= CREATE_NEWS_ICON ?>" width="90px" height="90px" align="right" /> 
                            </td> -->
                        </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                    <?php
						if($action == "")
						{
							//Normal View
					?>
                        <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0" width="100%">
                                <tr class="dataTableHeadingRow">
                                    <td class="dataTableHeadingContent" align="left" style="padding-right:15px;"><?php echo CREATE_NEWS_TABLE_HEADING_DATE; ?></td>
                                    <td class="dataTableHeadingContent" align="center" style="padding-right:10px; padding-left:10px;"><?php echo CREATE_NEWS_TABLE_HEADING_UID; ?></td>
                                    <td class="dataTableHeadingContent" align="left" width="100%"><?php echo CREATE_NEWS_TABLE_HEADING_TITLE; ?></td>
                                    <td class="dataTableHeadingContent" align="center" style="padding-right:10px;"><?php echo CREATE_NEWS_TABLE_HEADING_ACTION; ?></td>
                                </tr>
                                <?php
									$news_num = mysql_num_rows($news_result);
									if($news_num > 0)
									{
										while($news_row = mysql_fetch_assoc($news_result))
										{
											$news_row_phpdatetime = strtotime($news_row['date']);
											$news_row_date = date("d/m/y", $news_row_phpdatetime);
											$news_row_title = $news_row['title'];
											$news_row_subtitle = $news_row['subtitle'];
											$news_row_UID = $news_row['UID'];
								?>
                                <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="document.location.href='<?php echo $_SERVER['PHP_SELF'] . '?action=edit&UID=' . $news_row_UID; ?>'">
                                    <td class="dataTableContent" align="left"><?php echo $news_row_date; ?></td>
                                    <td class="dataTableContent" align="center"><?php echo $news_row_UID; ?></td>
                                    <td class="dataTableContent" align="left"><?php echo $news_row_title . '<br><span style="padding-left:20px; font-style:italic;">' . $news_row_subtitle . '</span>'; ?></td>
                                    <td class="dataTableContent" align="right" style="padding-right:10px;"><a href="<?= tep_href_link('create_news.php', 'action=edit&UID='. $news_row_UID); ?>"><img src="<?php echo CREATE_NEWS_IMAGE_EDIT_BUTTON ?>" alt="Edit" border="0" style="padding-left:5px; padding-right:5px;"/></a><a href="<?= tep_href_link('create_news.php', 'action=delete&UID='. $news_row_UID); ?>">
                                    <img src="<?php echo CREATE_NEWS_IMAGE_DELETE_BUTTON ?>" alt="Delete" border="0" style="padding-left:5px; padding-right:5px;"/></a></td>
                                </tr>
                                <?php
										}
									}
									else /* ($news_num == 0) */
									{
								?>
                                <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
                                	<td class="dataTableContent" colspan="4" align="center"><a href="<?= tep_href_link('create_news.php', 'action=create'); ?>"><span style="font-style:italic;">Não existem notícias. Clique para criar um artigo novo.</span></td>
                                </tr>
                                <?php
									}
								?>
                                <tr>
                                	<td align="right" colspan="4"><table border="0" cellpadding="15px" cellspacing="0"><tr>
                                    <?php /*<td><img src="<?php echo CREATE_NEWS_IMAGE_DELETE_BUTTON ?>" alt="Delete" /></td> */ ?><td><a href="<?= tep_href_link('create_news.php', 'action=create'); ?>"><img src="<?php echo CREATE_NEWS_IMAGE_CREATE_BUTTON ?>" alt="Create" border="0"/></a></td></tr></table></td>
                                </tr>
                                </table>
                            </td>
                        </tr>
                        </table>
                        <?php
						}
						else if($action == "delete")
						{
							$news_delete_results = mysql_fetch_assoc($news_result);
							$news_delete_title = $news_delete_results['title'];
							$news_delete_phpdatetime = strtotime($news_delete_results['date']);
							$news_delete_date = date("d-m-Y H:i:s", $news_delete_phpdatetime);
							
							?>
                            
							<!-- <table width="100%" border="0" cellspacing="0" cellpadding="0px" align="center">
                            <tr><td align="center"> -->
							<table width="80%" border="0" cellspacing="0" cellpadding="1px" align="center">
                              <tr>
                                <td bgcolor="#FF0000">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td bgcolor="#ffffa0" align="center"><?php echo CREATE_NEWS_CONFIRM_DELETE_MESSAGE; ?></td>
                                      </tr>
                                      <tr>
                                      	<td>
                                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td height="1px" bgcolor="#ffffa0" width="25px"></td>
                                              <td height="1px" bgcolor="#CCCCCC"></td>
                                              <td height="1px" bgcolor="#ffffa0" width="25px"></td>
                                            </tr>
                                            </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td bgcolor="#ffffa0" align="left" style="padding-left:25px;">
											<?php echo CREATE_NEWS_TABLE_FORM_DATA_HEADING_TITLE . ': ' . $news_delete_title; ?>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td bgcolor="#ffffa0" align="left" style="padding-left:25px;">
											<?php echo CREATE_NEWS_TABLE_FORM_DATA_HEADING_DATE . ': ' . $news_delete_date; ?>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td bgcolor="#ffffa0" align="center">&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td bgcolor="#ffffa0" align="center" style="padding-left:15px; padding-right:15px;">
                                        	<form id="delete_confirm_form" name="delete_confirm_form" method="post" action="
											<?php 
                                                echo $_SERVER['PHP_SELF'] . '?action=delete&UID=' . $php_edit_UID;
                                            ?>
                                            " enctype="multipart/form-data">
                                            <input type="hidden" name="confirm_delete" id="confirm_delete" value="confirmed" />
                                            <?php
												if ($FF || $OP)
												{
													echo '<input type="image" name="delete_confirm_form_submit" value="Yes" src="' . CREATE_NEWS_IMAGE_CONFIRM_DELETE_YES_BUTTON . '" onclick="javascript:document.delete_confirm_form.submit();" />';
												}
												else if($IE)
												{
													echo '<a href="javascript:document.delete_confirm_form.submit()"><img src="' . CREATE_NEWS_IMAGE_CONFIRM_DELETE_YES_BUTTON . '" alt="Yes" /></a>';
												}
												else
												{
													echo '<input type="submit" name="delete_confirm_form_submit" value="Yes">';
												}
											?>
                                            </form>
                                            <a href="<?= tep_href_link('create_news.php'); ?>"><img src="<?php echo CREATE_NEWS_IMAGE_CONFIRM_DELETE_NO_BUTTON ?>" alt="No" style="padding-left:15px; padding-right:15px;" border="0"/></a>
                                        </td>
                                      </tr>
                                    </table>
                                </td>
                              </tr>
                            </table>
                            <!--
                            </td>
                            </tr>
                            </table>
							-->
                            
                            <?php
						}
						else 
						{
							if($action == "create")
							{
								//Add New Entry
								$news_form_value_title = "";
								$news_form_value_subtitle = "";
								$news_form_value_body = "";
								$news_form_value_date = date("d-m-Y H:i:s");
							}
							else if($action == "edit")
							{
								//Edit Entry
								$news_edit_form_results = mysql_fetch_assoc($news_result);
								$news_form_value_title = $news_edit_form_results['title'];
								$news_form_value_subtitle = $news_edit_form_results['subtitle'];
								$news_form_value_body = $news_edit_form_results['body'];
								$news_form_value_foto = $news_edit_form_results['foto'];
								$news_form_row_phpdatetime = strtotime($news_edit_form_results['date']);
								$news_form_value_date = date("d-m-Y H:i:s", $news_form_row_phpdatetime);
							}
						?>
                        <form id="news_form" name="news_form" method="post" action="
						<?php 
							echo $_SERVER['PHP_SELF'] . '?action=save';
							if($action == "edit")
							{
								echo '&UID=' . $php_edit_UID;					
							}
						?>
                        " enctype="multipart/form-data" >
						<table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0" width="100%">
                                <tr class="dataTableHeadingRow">
                                    <td class="dataTableHeadingContent" align="left" style="padding-right:20px; white-space:nowrap;"><?php echo CREATE_NEWS_TABLE_HEADING_EDIT_NAME; ?></td>
                                    <td class="dataTableHeadingContent" align="left" width="100%"><?php echo CREATE_NEWS_TABLE_HEADING_EDIT_VALUE; ?></td>
                                </tr>
                                <tr class="dataTableRow">
                                    <td class="dataTableContent" align="left" valign="top"><span class="news_dataTableContent"><?php echo CREATE_NEWS_TABLE_FORM_DATA_HEADING_TITLE; ?></span></td>
                                    <td class="dataTableContent" align="left"><input type="text" name="news_form_title" id="news_form_title" tabindex="1" value="<?php echo $news_form_value_title; ?>" style="width:100%;" /></td>
                                </tr>
                                <tr class="dataTableRow">
                                    <td class="dataTableContent" align="left" valign="top"><span class="news_dataTableContent"><?php echo CREATE_NEWS_TABLE_FORM_DATA_HEADING_SUBTITLE; ?></span></td>
                                    <td class="dataTableContent" align="left"><input type="text" name="news_form_subtitle" id="news_form_subtitle" tabindex="2" value="<?php echo $news_form_value_subtitle; ?>" style="width:100%;" /></td>
                                </tr>
                                <tr class="dataTableRow">
                                    <td class="dataTableContent" align="left" valign="top"><span class="news_dataTableContent"><?php echo CREATE_NEWS_TABLE_FORM_DATA_HEADING_BODY; ?></span></td>
                                    <td class="dataTableContent" align="left"><textarea name="news_form_body" cols="80" rows="10" style="width:100%" tabindex="3"><?php echo $news_form_value_body; ?></textarea>
									<script type="text/javascript">
                                        CKEDITOR.replace( 'news_form_body',
                                            {
                                                enterMode		: Number( 2 ), //br
                                                shiftEnterMode	: Number( 1 ), //p
                                                extraPlugins 	: 'autogrow',
                                                toolbar :
                                                [
                                                    [ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ]
                                                ]
                                            });
                                    </script>   
                                    </td>
                                </tr>
                                
                                   <tr class="dataTableRow">
                                    <td class="dataTableContent" align="left" valign="top"><span class="news_dataTableContent">Imagem</span></td>
                                    <td class="dataTableContent" align="left"><input type="file" name="news_form_foto" id="news_form_foto" tabindex="2" /> <input type="hidden" name="nome_foto" id="nome_foto" value="<?php echo $news_form_value_foto; ?>"><?php echo $news_form_value_foto; ?></td>
                                </tr>
                                
                                 <tr class="dataTableRow">
                                    <td class="dataTableContent" align="left" valign="top"></td>
                                    <td class="dataTableContent" align="left"><small>A imagem deve ter 200px de largura</small></td>
                                </tr>
                                
                                <tr class="dataTableRow">
                                    <td class="dataTableContent" align="left" valign="top"><span class="news_dataTableContent"><?php echo CREATE_NEWS_TABLE_FORM_DATA_HEADING_DATE; ?></span></td>
                                    <td class="dataTableContent" align="left"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td width="100%"><input type="text" name="news_form_date" id="news_form_date" tabindex="4" value="<?php echo $news_form_value_date; ?>" style="width:100%;" /></td><td><a href="javascript:show_calendar('document.news_form.news_form_date', document.news_form.news_form_date.value, '<?php echo CREATE_NEWS_IMAGE_FORM_DATA_DATE_CALENDAR_NEXT; ?>', '<?php echo CREATE_NEWS_IMAGE_FORM_DATA_DATE_CALENDAR_PREV; ?>');"><img src="<?php echo CREATE_NEWS_IMAGE_FORM_DATA_DATE_CALENDAR_MAIN; ?>" width="16" height="16" border="0" alt="Click here to choose the date" style="padding-left:20px; padding-right:20px;"></a></td></tr></table></td>
                                </tr>
                                <tr>
                                	<td align="right" colspan="2"><table border="0" cellpadding="15px" cellspacing="0"><tr><td><a href="<?= tep_href_link('create_news.php'); ?>"><img src="<?php echo CREATE_NEWS_IMAGE_CANCEL_BUTTON ?>" alt="Cancel" border="0"/></a></td><td>
                                    <?php
                                    if ($FF || $OP)
									{
										echo '<input type="image" name="news_form_submit" value="Save" src="' . CREATE_NEWS_IMAGE_SAVE_BUTTON . '" onclick="javascript:document.news_form.submit();" />';
									}
									else if($IE)
									{
										echo '<a href="javascript:document.news_form.submit()"><img src="' . CREATE_NEWS_IMAGE_SAVE_BUTTON . '" alt="Save" /></a>';
									}
									else
									{
										echo '<input type="submit" name="news_form_submit" value="Save">';
									}
									/* <img src="<?php echo CREATE_NEWS_IMAGE_SAVE_BUTTON ?>" alt="Save" /> */
									?>
                                    
                                    </td></tr></table></td>
                                </tr>
                                </table>
                            </td>
                        </tr>
                        </table>
                        </form>
                        <?php
						}
						?>
                    </td>
                </tr>
                </table>
            </td>
  			<!--  end create_news -->
        </tr>
        </table>
		<? if ( ! $_REQUEST['print'] ) require(DIR_WS_INCLUDES . 'footer.php'); ?>
	</body>
</html>
  		