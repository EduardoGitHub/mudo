<?php
/*
  $Id: pollbooth.php,v 1.15 2003/04/06 22:29:47 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2000,2001 The Exchange Project

  Released under the GNU General Public License
*/
  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/pollbooth.php');
  $location = ' : <a href="' . tep_href_link('pollbooth.php', 'op=results', 'NONSSL') . '" class="headerNavigation"> ' . NAVBAR_TITLE_1 . '</a>';
  DEFINE('MAX_DISPLAY_NEW_COMMENTS', '5');
	if ($_GET['action']=='do_comment') {
	  $comment_query_raw = "insert into phesis_comments (pollid, customer_id, name, date, host_name, comment,language_id) values ('" . $_GET['pollid'] . "', '" . $customer_id . "', '" . addslashes($_POST['comment_name']) . "', now(),'" . $REMOTE_ADDR . "','" . addslashes($_POST['comment']) . "','" . $languages_id . "')";
	  $comment_query = tep_db_query($comment_query_raw);
	  $_GET['action'] = '';
	  $_GET['op'] = 'results';
	}
	if (isset($_GET['action']) && ($_GET['action'] == 'update')) {
  	$pollid = $_POST['pollid'];
	$voteid = $_POST['voteid'];
	$forwarder = $_POST['forwarder'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$past = time()-90800;
	$votevalid = 1;
	$query="DELETE FROM phesis_poll_check WHERE time < ".$past;
	tep_db_query($query);
	if ($voteid) {
		$result=tep_db_query("select poll_type, poll_open from phesis_poll_desc where pollid=$pollid");
		$poll=tep_db_fetch_array($result);
		if ($poll['poll_open']=='1') {
			$votevalid=0;
			$warn="_POLLCLOSED";
			}
		if ($poll['poll_type']=='1' && !isset($customer_id)) {
			$votevalid=0;
			$warn="_POLLPRIVATE";
			}
		if ($votevalid==1 && POLL_SPAM==0) {
			$query = tep_db_query("SELECT ip FROM phesis_poll_check WHERE ip='".$ip."' and pollid='".$pollid."'");
			$result1 = tep_db_fetch_array($query);
			$ips = $result1['ip'];
			$ctime = time();
			if ($ip == $ips) {
				$votevalid = 0;
				$warn = "_ALREADY_VOTED";
	    	} else {
	      		$query = "INSERT INTO phesis_poll_check (ip, time, pollid) VALUES ('".$ip."', '".$ctime."' , '".$pollid."')";
			    tep_db_query($query);
				$votevalid = 1;
	    	}
		}
	}
	if (!$voteid){
	 	$votevalid=0;
		$warn="_NO_VOTE_SELECTED";
		}
	if($votevalid>0) {
	        $query1 = "UPDATE phesis_poll_data SET optionCount=optionCount+1 WHERE (pollid='".$pollid."') AND (voteid='".$voteid."') and (language_id='".$languages_id."')";
	        $query2 = "UPDATE phesis_poll_desc SET voters=voters+1 WHERE pollid='".$pollid."'";
	        $result1 = tep_db_query($query1);
	        $result2 = tep_db_query($query2);
	        Header("Location: $forwarder");
	    } else {
	        $forwarder .= "&warn=" . $warn; 
	
	        Header("Location: $forwarder");
	    }	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php echo HTML_PARAMS; ?>>
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
<base href="<?php echo (getenv('HTTPS') == 'on' ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
</head>
<body>
<div id="container">
  <div id="header"><?php require(DIR_WS_INCLUDES . 'header.php'); ?></div>
  <div id="sidebar1"><?php require(DIR_WS_INCLUDES . 'column_left.php'); ?></div>
  <div id="sidebar2"><?php require(DIR_WS_INCLUDES . 'column_right.php'); ?></div>
  <div id="mainContent">
  
  	<div class="pagestitulo"><span><?php echo HEADING_TITLE; ?></span></div>
  
<!-- body_text //-->
    <table border="0" width="99%" cellspacing="0" cellpadding="0">



<?php
if ($_GET['warn']) {
?>
          <tr class="headerError">
            <td class="headerError"><? echo (_WARNING);$warn=$_GET['warn'];eval("\$temp=$warn;");echo($temp);?></td>
          </tr>
<?php
}
?>
<tr>
       <td align="left">
       <table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding-left:5px;">
<?php
if (!isset($_GET['op'])) {
	$_GET['op']="list";
	}
switch ($_GET['op']) {
	case "results":
		if (isset($_GET['pollid'])) {
			$pollid=$_GET['pollid'];
		} else {
		$pollid=1;
		}
		      $poll_query = tep_db_query("SELECT pollid, timeStamp FROM phesis_poll_desc WHERE pollid='".$pollid."'");	
		      $polls = tep_db_fetch_array($poll_query);
                      $title_query = tep_db_query("select optionText from phesis_poll_data where pollid=$pollid and voteid='0' and language_id = '" . $languages_id . "'");
                      $title = tep_db_fetch_array($title_query);
?>
		<tr><td colspan="2" align="left"><b><br><br><? echo $title['optionText'];?></b></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
<?php
			$query="SELECT SUM(optionCount) AS sum FROM phesis_poll_data WHERE pollid='".$pollid."'";

			$result=tep_db_query($query);
			$polls=tep_db_fetch_array($result);
			$sum=$polls['sum'];
			for($i = 1; $i <= 12; $i++) {
				$query = "SELECT pollid, optiontext, optioncount, voteid FROM phesis_poll_data WHERE (language_id = '" . $languages_id . "') and (pollid='".$pollid."') AND (voteid='".$i."')";	
				$result=tep_db_query($query);$polls=tep_db_fetch_array($result);
				$optiontext=$polls['optiontext'];
				$optioncount=$polls['optioncount'];
				if ($optiontext) {
?>
					<tr><td align="left" width="5%">
					<?php echo $optiontext?></td>
<?php
					if ($sum) {
						$percent = 100 * $optioncount / $sum;
						} else {
						$percent = 0;
						}
?>
					<td align="left">
<?php
					$percentInt = (int)$percent * 4 * 1;
					$percent2 = (int)$percent;
					if ($percent > 0) {
?>
				   		<img src="images/leftbar.gif" height="15" width="7" Alt="<?echo $percent2?> %"><img src="images/mainbar.gif" height="15" width="<?echo $percentInt?>" Alt="<?echo $percent2?> %"><img src="images/rightbar.gif" height="15" width="7" Alt="<?echo $percent2?> %">
<?php

						} else {
?>
				    		<img src="images/leftbar.gif" height="15" width="7" Alt="<? echo $percent2?> %"><img src="images/mainbar.gif" height="15" width="3" Alt="<? echo $percent2?> %"><img src="images/rightbar.gif" height="15" width="7" Alt="<? echo $percent2?> %">
<?php
						}
					printf(" %.2f%% (%d)", $percent, $optioncount);
?>
					</td></tr>
<?php
					}
				}

                        $comments_query_raw = "select * from phesis_comments where pollid = '" . $pollid . "' and language_id = '" . $languages_id . "'";
                        $comments_split = new splitPageResults($comments_query_raw, MAX_DISPLAY_NEW_COMMENTS);
						//$comments_split = new splitPageResults($_GET['page'], MAX_DISPLAY_NEW_COMMENTS, $comments_query_raw, $comments_numrows);
                        $comments_query = tep_db_query($comments_query_raw);
  if ($comments_numrows > 0) {
?>
        <tr><td colspan="2">&nbsp;</td></tr>
        <tr><td class="pageheading" colspan="2"><?php echo _COMMENTS_POSTED; ?></td></tr>  
        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
<?php
}
  if (($comments_numrows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td colspan="2"><br><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo $comments_split->display_count($comments_numrows, MAX_DISPLAY_NEW_COMMENTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_COMMENTS); ?></td>
            <td align="right" class="main"><?php echo TEXT_RESULT_PAGE; ?> <?php echo $comments_split->display_links($comments_numrows, MAX_DISPLAY_NEW_COMMENTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
                        while ($comments = tep_db_fetch_array($comments_query)) {
  if ($comments['customer_id'] != '0') {
    $name_query = tep_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '". $comments['customer_id'] . "'");
    $name = tep_db_fetch_array($name_query);
    $comment_name = $name['customers_firstname'] . " " . $name['customers_lastname'];
  } else {
    $comment_name = $comments['name'];
  }
 
  $post_details = _COMMENTS_BY . $comment_name . '['. $comments['host_name'] . ']' . _COMMENTS_ON . $comments['date'];
?>

  <tr><td class="main" colspan="2"><b><?php echo $post_details; ?></b></td></tr>
        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
  <tr><td class="main" colspan="2"><?php echo htmlspecialchars($comments['comment']); ?></td></tr>
        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
  



<?php
}
  if (($comments_numrows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td colspan="2"><br/><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo $comments_split->display_count($comments_numrows, MAX_DISPLAY_NEW_COMMENTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_COMMENTS); ?></td>
            <td align="right" class="main"><?php echo TEXT_RESULT_PAGE; ?> <?php echo $comments_split->display_links($comments_numrows, MAX_DISPLAY_NEW_COMMENTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
			<tr><td colspan="2" align="left">&nbsp;</td></tr>
			<tr><td colspan="2" align="left" class="main"><? echo _TOTALVOTES?> = <? echo $sum?></td></tr>
			<tr><td colspan="2" align="left" class="main">[ <a href="<?php echo tep_href_link('pollbooth.php','pollid='.$pollid.'&op=vote','NONSSL')?>"><? echo _VOTING?></a> | <a href="<? echo tep_href_link('pollbooth.php','op=list','NONSSL')?>"><?echo _OTHERPOLLS?></a> ]</td></tr>
<?php
			break;
                case 'comment':
		if (isset($_GET['pollid'])) {
			$pollid=$_GET['pollid'];
		} else {
		$pollid=1;
		}
		      $poll_query = tep_db_query("SELECT pollid, timeStamp FROM phesis_poll_desc WHERE pollid='".$pollid."'");	
		      $polls = tep_db_fetch_array($poll_query);
                      $title_query = tep_db_query("select optionText from phesis_poll_data where pollid=$pollid and voteid='0' and language_id = '" . $languages_id . "'");
                      $title = tep_db_fetch_array($title_query);
?>
                <?php echo tep_draw_form('poll_comment', tep_href_link('pollbooth.php', 'action=do_comment&pollid=' . $pollid), 'post'); ?>
		<tr><td colspan="2" align="left"><b><br/><? echo $title['optionText']?></b></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
<?php
  if (!$customer_id) {
?>
                <tr><td><?php echo tep_draw_input_field('comment_name',''); ?>&nbsp;<?php echo _YOURNAME; ?></td></tr>
<?php
  }
?>
                <tr><td><?php echo tep_draw_textarea_field('comment', 'soft', '30', '4', ''); ?></td></tr>
                <tr><td><?php echo tep_image_submit('button_continue.gif','TEXT_CONTINUE'); ?></td></tr>
<?php
                $nolink = true;
                break;
		case 'list':
?>
		<tr><td colspan="3">&nbsp;</td></tr>
<?php
		$result=tep_db_query("SELECT pollid, timestamp, voters, poll_type, poll_open FROM phesis_poll_desc ORDER BY timestamp desc");
		$row=0;
		while ($polls=tep_db_fetch_array($result)) {
			$row++;
			$id=$polls['pollid'];
			if (($row / 2) == floor($row / 2)) {
?>
			<tr class="Payment-even">
<?php
		} else {
?>
			<tr class="Payment-odd">
<?php
		}
        $title_query = tep_db_query("select optionText from phesis_poll_data where pollid=$id and voteid='0' and language_id = '" . $languages_id . "'");
        $title = tep_db_fetch_array($title_query);
		$fullresults = '<a href="'.tep_href_link('pollbooth.php','op=results&pollid='.$id,'NONSSL').'">'._POLLRESULTS.'</a>';
		$result1 = tep_db_query("SELECT SUM(optioncount) AS sum FROM phesis_poll_data WHERE pollid='".$id."'");
		$poll_sum = tep_db_fetch_array($result1);
		$sum = $poll_sum['sum'];
	    $query1=tep_db_query("select count(pollid) as comments from phesis_comments where pollid=$id and language_id=$languages_id");
        $result1 = tep_db_fetch_array($query1);
        $comments = $result1['comments'];
		echo '<td class="main">'.$title['optionText'].'</td>
			  <td class="main">'.$sum.' '._VOTES.'</td>
			  <td class="main">'.$comments.' '._COMMENTS.'</td>
			  <td class="main">'.$fullresults.'</td>';
		
		if ($polls['poll_type']=='0') echo '<td class="main">'._PUBLIC.'</td>'; else echo '<td class="main">'._PRIVATE.'</td>';
		if ($polls['poll_open']=='0') echo '<td class="main">'._POLLOPEN.'</td>';else echo '<td class="main">'._POLLCLOSED.'</td>';
			

		echo '</tr>';
	} 
	break;
	case "vote":
	if (isset($_GET['pollid'])) $pollid=$_GET['pollid']; else $pollid=1;
	$poll_query=tep_db_query("select voters from phesis_poll_desc where pollid=$pollid");
	$poll_details=tep_db_fetch_array($poll_query);
    $title_query = tep_db_query("select optionText from phesis_poll_data where pollid=$pollid and voteid='0' and language_id = '" . $languages_id . "'");
    $title = tep_db_fetch_array($title_query);
?>
		<tr>
		<td align="left"><b><? echo $title['optionText']?></b><br/></td>
		</tr>
        <tr>
        	<td>
			<?php		
			$url = tep_href_link('pollbooth.php','op=results&pollid='.$pollid,'NONSSL');
			$content =  '<input type="hidden" name="pollid" value="'.$pollid.'">';
			$content .= '<input type="hidden" name="forwarder" value="'.$url.'">';
			for ($i=1;$i<=12;$i++) {
			      $query = tep_db_query("select pollid, optiontext, optioncount, voteid from phesis_poll_data where (pollid=$pollid) and (voteid=$i) and (language_id=$languages_id)");
			      if ($result=tep_db_fetch_array($query)) {
			      	if ($result['optiontext']) {
			       		$content.= '<input type="radio" name="voteid" value="'.$i.'" class="styled">&nbsp;'.$result['optiontext'].'<br/><br/>';
			       	}
			    }
			}
			$content .= '<input type="submit" value="'._VOTE.'"><br/>';
			$query = tep_db_query("select sum(optioncount) as sum from phesis_poll_data where pollid=".$pollid);
			if ($result=tep_db_fetch_array($query)) {
				$sum = $result['sum'];
			}
			$content .= '<br>[ <a href="'.tep_href_link('pollbooth.php','op=results&pollid='.$pollid,'NONSSL').'">'._RESULTS.'</a> | <a href="'.tep_href_link('pollbooth.php','op=list','NONSSL').'">'._OTHERPOLLS.'</a> ]';
			$content .= '</br>' . $sum . '&nbsp;'._VOTES;
			echo tep_draw_form('poll', tep_href_link('pollbooth.php', 'action=update', 'NONSSL')); 
			echo $content;
			echo '<form>';
			?>
			</td>
		</tr>
<?php
	break;
		}
?>
     </table>
      </tr>
<?php 
  if (!$nolink) {
?>
      <tr>
        <td align="left" class="main"><br/><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
      </tr>
<?php
}
?>
    </table>
  </div>
  <br class="clearfloat" />
  <div id="footer"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>