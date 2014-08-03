<? if($can_show == 'True'){ if(SHOW_LIST_PRICE == 'True'){?>
<div class="box" id="donwloads">
<div class="lay_bordaBox"><span>Downloads</span></div>
    <div class="boxconteudo">
    <?php
         $show = '';
          $SQL = mysql_query('select * from '.TABLE_TABLE_PRICE);

				$show .='<table width="100%" border="0" cellspacing="0" cellpadding="0">';
            while($query_arq = mysql_fetch_assoc($SQL)){
            $tipo = substr($query_arq['lp_arquivo'], (strpos($query_arq['lp_arquivo'], ".")+1), strlen($query_arq['lp_arquivo']));
                if(($tipo == 'doc')||($tipo == 'DOC'))
                    $imagem = '<img src="images/icone_word.gif" border="0">';
                elseif(($tipo == 'txt')||($tipo == 'TXT'))	
                    $imagem = '<img src="images/icone_txt.gif" border="0">';
                elseif(($tipo == 'pdf')||($tipo == 'PDF'))	
                    $imagem = '<img src="images/icone_pdf.gif" border="0">';
                elseif(($tipo == 'xls')||($tipo == 'XLS'))	
                    $imagem = '<img src="images/icone_xls.gif" border="0">';	
				 elseif(($tipo == 'jpg')||($tipo == 'JPG')||($tipo == 'GIF')||($tipo == 'gif')||($tipo == 'png')||($tipo == 'PNG')||($tipo == 'bmp')||($tipo == 'BMP'))	
				 $imagem = '<img src="images/icone_picture.gif" border="0">';	
          $show .='
          <tr><td colspan="2" height="5"></td></tr>
          <tr>
            <td width="19%" align="center">&nbsp;&nbsp;<a href="images/arquivos/'.$query_arq['lp_arquivo'].'" target="_blank">'.$imagem.'</a></td>
            <td width="81%">&nbsp;<a href="images/arquivos/'.$query_arq['lp_arquivo'].'" target="_blank" class="ml3">'.$query_arq['lp_desc'].'</a></td>
          </tr>
          <tr><td colspan="2" height="5"></td></tr>';
          
          
                 }
          ;
    $show .= '</table>';
        echo $show
    ?>
    </div>
</div>
<? }}?>