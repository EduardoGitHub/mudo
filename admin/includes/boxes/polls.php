<!-- polls //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('align' => 'left',
                               'text'  => BOX_HEADING_POLLS.'/Notícias',
                               'link'  => tep_href_link(FILENAME_POLLS, tep_get_all_get_params(array('selected_box')) . 'selected_box=polls')
                              );

  if ($selected_box == 'polls') {
    $contents[] = array('align' => 'left',
                                 'text'  => '<a href="' . tep_href_link(FILENAME_POLLS, 'action=config', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_POLLS_CONFIG . '</a><BR><a href="' . tep_href_link(FILENAME_POLLS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_POLLS_POLLS . '</a><br>'.
								 '<a href="' . tep_href_link(FILENAME_CREATE_NEWS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOOLS_CREATE_NEWS . '</a>' 
                                );
  }
  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- polls-eof //-->
