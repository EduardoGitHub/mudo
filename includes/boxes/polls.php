<?php
  $hide = tep_hide_session_id();

function pollnewest() {
	$extra_query = '';
	global $customer_id, $HTTP_GET_VARS;
	if (DISPLAY_POLL_HOW==3) {
	        $extra_query=" and pollID='" . DISPLAY_POLL_ID . "'";
	        }
	if (!isset($customer_id)) {
		$extra_query.=" and poll_type='0' ";
		}
	if (DISPLAY_POLL_HOW==2) {
		$order = 'voters DESC';
 		} else {
		$order = 'timestamp DESC';
		}
	$query= tep_db_query("select pollid, catID FROM phesis_poll_desc where poll_open='0'".$extra_query."and catID != 0 order by ".$order);
	$count=tep_db_num_rows($query);
        $result = tep_db_fetch_array($query);
	$pollid = false;
        if ($count>0) {
           if ($HTTP_GET_VARS['cPath']) $mypath = $HTTP_GET_VARS['cPath'];
           if ($HTTP_GET_VARS['products_id'])$mypath = tep_get_product_path($HTTP_GET_VARS['products_id']);
           if ($mypath) {
             $sub_cat_ids = split("[_]", $mypath);
             for ($i = 0; $i < count($sub_cat_ids); $i++) { 
               if ($sub_cat_ids[$i] == $result['catID']) $pollid = $result['pollid'];                              
             }
           }
        }
	$query= tep_db_query("select pollid, catID FROM phesis_poll_desc where poll_open='0'".$extra_query." and catID = 0 order by ".$order);
	$count=tep_db_num_rows($query);
       	if ((!DISPLAY_POLL_HOW==0 || $count==1) && !$pollid) {
		if ($result=tep_db_fetch_array($query)) {
			$pollid = $result['pollid'];
		}
	} elseif (!$pollid) {
		mt_srand((double) microtime() * 1000000);
		$rand = mt_rand(1,$count);
		for($i=0;$i<$rand;$i++) {
			$result=tep_db_fetch_array($query);
			$pollid = $result['pollid'];
			}
	}
	return $pollid;
}
if (basename($PHP_SELF) !='pollbooth.php') {
$pollid=pollnewest();
if ($pollid) {
?>
<div class="box" id="enquete">
<div class="lay_bordaBox"><span>Enquete</span></div>
<div class="boxconteudo">
    
	<?php
     $poll_query=tep_db_query("select voters from phesis_poll_desc where pollid=$pollid and poll_open='0'");
     $poll_details=tep_db_fetch_array($poll_query);
     $title_query = tep_db_query("select optionText from phesis_poll_data where pollid=$pollid and voteid='0' and language_id = '" . $languages_id . "'");
     $title = tep_db_fetch_array($title_query);
                
     $url = tep_href_link('pollbooth.php', 'op=results&amp;pollid='.$pollid);
     $content = tep_draw_form('poll', tep_href_link('pollbooth.php', 'action=update', 'NONSSL'));
     $content .= '<input type="hidden" name="pollid" value="'.$pollid.'" />';
     $content .= '<input type="hidden" name="forwarder" value="'.$url.'" />';
     $content .= '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
     $content .= '<tr class="pollOptRow"><td colspan="2" class="pollBoxRow"><b>' . $title['optionText'] . '</b></td></tr>';
                for ($i=1;$i<=8;$i++) {
                    $query=tep_db_query("select pollid, optiontext, optioncount, voteid from phesis_poll_data where (pollid=$pollid) and (voteid=$i) and (language_id=$languages_id)");
                    if ($result=tep_db_fetch_array($query)) {
                     if ($result['optiontext']) {
                        $content.= '<tr  class="pollOptRow"><td class="pollBoxRow" width="20%"><input type="radio" name="voteid" class="styled" value="'.$i.'" /></td><td class="pollBoxRow" width="80%">'.$result['optiontext'].'</td></tr>';
                        }
                    }
                }
    $content .= '<tr class="pollFooter"><td colspan="2"><center><input type="submit" value="'._VOTE.'" style="background-image:url(images/button-enquete.gif); width:65px; height:18px; border:0px; font-family:Arial; font-size:11px; color:#000; font-weight:bold;" /></center></td></tr>';
    $query = tep_db_query("select sum(optioncount) as sum from phesis_poll_data where pollid=$pollid");
    $query1 = tep_db_query("select count(pollid) as comments from phesis_comments where pollid=$pollid and language_id=$languages_id");
    $result1 = tep_db_fetch_array($query1);
    $comments = $result1['comments'];
      if ($result=tep_db_fetch_array($query)) {
         $sum=$result['sum'];
      }
    $content .= '<tr class="pollFooter"><td colspan="2" class="pollBoxText"><center>[ <a href="' . tep_href_link('pollbooth.php', 'op=results&amp;pollid=' .$pollid, 'NONSSL').'">'._RESULTS.'</a> | <a href="' .tep_href_link('pollbooth.php', 'op=list').'">'._POLLS.'</a> ]</center></td></tr>';
    $content .= '<tr class="pollFooter"><td class="pollBoxText" colspan="2"><center>' . $sum . ' '._VOTES.'</center></td></tr>';
    $content .= '</table></form>';           
    echo $content;
   ?>	
	
</div>
</div>
<?php
} elseif (SHOW_NOPOLL==1) {
	echo _NOPOLLS;
	echo _NOPOLLSCONTENT;
	}
}
?>
