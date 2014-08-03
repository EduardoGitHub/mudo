<?php
/*
//////////////////////////////////////////////////////////////////////////////////////////////////////

				TABELA PARA MOSTRAR OS METODOS DE PAGAMENTO ACEITOS EM LOJAS OSCOMMERCE

Atualizações
=============
				
1.0 Valmy Gomes in 29-8-07				
1.1 Marcelo_73 in 14 Feb 2008			
1.2 Marcelo_73 in 28 Fev 2008
1.3 Valmy Gomes in 23 Feb 2008
2.0 Marcelo_73 in 30 Mar 2008
3.0 Osgregs in 12 Apr 2008  
3.1 marcelo_73 in 13 Apr 2008
3.2 jpd_br in 20 march 2009.
3.3 Kinomoto San
3.4 jpd_br in 31 july 2009
3.4 APOPULAR Marcelo_73 31 July 2009
		 - Construçao e adaptaçao para a configuraçao via ADMIN
		 - adaptaçao para as novas chaves geradas no ADMIN
		 - Corrigido erro de parcelas sem juros(by brunorios)
		
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

CASO TENHA ALGUMA DUVIDA OU QUEIRA ENTRAR EM CONTATO COM OS AUTORES USE O FORUM OFICIAL

http://www.omeunuke.com/modules.php?name=Forums&file=viewtopic&t=3254

*/

if(!isset($_GET['pr']))
$totalValue = $preco;
else
$totalValue = $_GET['pr'];


//if (PARCELAMENTO_CARTAO_ATIVO == 'true'){


////////////////////////////////////////////////////////////////////////////////////////////////////////
// ESTA PARTE PODE SER ALTERADA

$minvalor = PARCELAMENTO_CARTAO_MINIMO; // VALOR MINIMO DE CADA PARCELA
$desconto = 0;//Valor da percentagem de Desconto atribuída ao produto
$parcelaqtminimacc = PARCELAMENTO_CARTAO_PARCELAS; ///QUANTIDADE MÁXIMA DE PARCELAS
$taxaboleto_pagseguro = TAXA_BOLETO ; // TAXA DO BOLETO (zero se não cobrar esta taxa)
$taxaboleto_pagtodigital = '0' ; // TAXA DO BOLETO (zero se não cobrar esta taxa)
$tablewidth = '900' ; // tamanho da largura da tabela padrão 280
/////////////////////////////////////////
$splits = (int) ($totalValue/$minvalor);
$valor = $totalValue;
$totaldesconto =  $valor - (($desconto/100)*$valor);
$minSemJuros = PARCELAMENTO_CARTAO_SEM_JUROS - 1;
$table = ' 
<table width="' .$tablewidth. '"  cellpadding="0" cellspacing="0" >
  <tr>
  	<td>
		<table width="500" cellpadding="0" cellspacing="0">
		  <tr>
			<td><table width="450" cellpadding="0" cellspacing="0">';
					$table .= '<tr>	
									<td width="45">'.tep_image(DIR_WS_IMAGES.'bb.gif').'</td>						
									<td width="115" class="res1"> Depósito, transferência, DOC<br>ou TED para Banco do Brasil</td>
									<td width="60" class="res1">R$ '. number_format($totalValue+$taxa0 , 2 , "," , ".") .'</td>
									<td width="60" class="res1"><b>R$ '. number_format($totalValue+$taxa0*1 , 2 , "," , ".") .'</b></td>
							   </tr>';   
					$table .= '<tr>	
									<td width="45">'.tep_image(DIR_WS_IMAGES.'banco_itau.gif').'</td>						
									<td width="115" class="res2"> Transferência Online Banco Itaú</td>
									<td width="60" class="res2">R$ '. number_format($totalValue+$taxa0 , 2 , "," , ".") .'</td>
									<td width="60" class="res2"><b>R$ '. number_format($totalValue+$taxa0*1 , 2 , "," , ".") .'</b></td>
							   </tr>';
					$table .= '<tr>	
									<td width="45">'.tep_image(DIR_WS_IMAGES.'banco_bradesco.gif').'</td>						
									<td width="115" class="res1"> Transferência Online Banco Bradesco</td>
									<td width="60" class="res1">R$ '. number_format($totalValue+$taxa0 , 2 , "," , ".") .'</td>
									<td width="60" class="res1"><b>R$ '. number_format($totalValue+$taxa0*1 , 2 , "," , ".") .'</b></td>
							   </tr>';
					$table .= '<tr>	
									<td width="45">'.tep_image(DIR_WS_IMAGES.'banco_real.gif').'</td>						
									<td width="115" class="res2"> Transferência Online Banco Real</td>
									<td width="60" class="res2">R$ '. number_format($totalValue+$taxa0 , 2 , "," , ".") .'</td>
									<td width="60" class="res2"><b>R$ '. number_format($totalValue+$taxa0*1 , 2 , "," , ".") .'</b></td>
							   </tr>';
						$table .= '<tr>	
									<td width="45">'.tep_image(DIR_WS_IMAGES.'banco_unibanco.gif').'</td>						
									<td width="115" class="res1"> Transferência Online Banco Unibanco</td>
									<td width="60" class="res1">R$ '. number_format($totalValue+$taxa0 , 2 , "," , ".") .'</td>
									<td width="60" class="res1"><b>R$ '. number_format($totalValue+$taxa0*1 , 2 , "," , ".") .'</b></td>
							   </tr>';     			
					$table .= '<tr>
					
									<td width="45">'.tep_image(DIR_WS_IMAGES.'boleto_pagseguro.gif').'</td>
									<td width="115" class="res2">Boleto Bancário PagSeguro</td>
									<td width="60" class="res2">R$ '. number_format($totalValue+$taxa1+$taxaboleto_pagseguro , 2 , "," , ".") .'</td>
									<td width="60" class="res2">R$ '. number_format($totalValue+$taxa1+$taxaboleto_pagseguro*1 , 2 , "," , ".") .'</td>
							   </tr>';

					if (PARCELAMENTO_CHEQUE_ATIVO == 'true'){
								 
											
					$table .= '<tr>
									<td align="center">'.tep_image(DIR_WS_IMAGES.'cheque.gif').'</td>
									<td width="115" class="res1">2x Cheque(0,30 dias s/ juros)</td>
									<td width="60" class="res1">R$ '. number_format($totalValue/2 , 2 , "," , ".") .'</td>
									<td width="60" class="res1"><b>R$ '. number_format($totalValue/2*2 , 2 , "," , ".") .'</b></td>
							   </tr>';
					$table .= '<tr>
									<td align="center">'.tep_image(DIR_WS_IMAGES.'cheque.gif').'</td>
									<td width="115" class="res2">3x Cheque(0,30 E 60 dias s/ juros)</td>
									<td width="60" class="res2">R$ '. number_format($totalValue/3 , 2 , "," , ".") .'</td>
									<td width="60" class="res2"><b>R$ '. number_format($totalValue/3*3 , 2 , "," , ".") .'</b></td>
							   </tr>';
							   
							   }  // FECHA O IF DO PARCELAMENTO COM CHEQUE	   			   
		$table .= '</table>
			</td>
		  </tr>
		</table>
	</td>
	<td>
		<table width="400" cellpadding="0" cellspacing="0">
		  <tr>
			<td height="10"></td>
		  </tr>				 
		  <tr>
			<td height="10"></td>
		  </tr>
		  <tr>
		  	<td>
           
		   <table width="400" cellpadding="0" cellspacing="0">';

			for($i = 0; $i < $splits; $i++){
			
			if($i>$parcelaqtminimacc - 1){break;}
			
			$i % 2 == 0 ? $class = "res1" : $class = "res2";
			
			if($i <= $minSemJuros){
			$table .= '<tr>
			<td width="120" class="'.$class.'"><b>'. ($i+1) . 'x Sem Juros</b></td>
			<td width="80" class="'.$class.'"><b>R$ '. number_format($valor/($i+1), 2 , "," , ".") . '</b></td>
			<td width="80" class="'.$class.'"><b>&nbsp;R$ '. number_format($valor, 2 , "," , ".").'&nbsp;</b></td>
			</tr>';
			
			}else{
			
			if($i+1=='2'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),2))/2;}
			if($i+1=='3'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),3))/3;}
			if($i+1=='4'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),4))/4;}
			if($i+1=='5'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),5))/5;}
			if($i+1=='6'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),6))/6;}
			if($i+1=='7'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),7))/7;}
			if($i+1=='8'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),8))/8;}
			if($i+1=='9'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),9))/9;}
			if($i+1=='10'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),10))/10;}
			if($i+1=='11'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),11))/11;}
			if($i+1=='12'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),12))/12;}
			if($i+1=='13'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),13))/13;}
			if($i+1=='14'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),14))/14;}
			if($i+1=='15'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),15))/15;}
			if($i+1=='16'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),16))/16;}
			if($i+1=='17'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),17))/17;}
			if($i+1=='18'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),18))/18;}
			if($i+1=='19'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),19))/19;}
			if($i+1=='20'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),20))/20;}
			if($i+1=='21'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),21))/21;}
			if($i+1=='22'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),22))/22;}
			if($i+1=='23'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),23))/23;}
			if($i+1=='24'){$taxa = (pow((1+ PARCELAMENTO_CARTAO_JUROS/100),24))/24;}
			
			
			if (($totalValue/($i+1)) > $minvalor){
				
				
			$table .= '<tr>
			<td width="140" class="'.$class.'">&nbsp;'. ($i+1) . 'x com juros*</td>
			<td width="70" class="'.$class.'">R$ '. number_format($taxa*$totalValue, 2 , "," , ".") .'</td>
			<td width="70" class="'.$class.'">R$ '. number_format($totalValue*($taxa*($i+1)), 2 , "," , ".") .'</td>
			</tr>';
			
			
			} 
			
			
			}

			}

$table .= "</table>
		</td>
		</tr>
		<tr>
		 <td width='400'><center>".tep_image(DIR_WS_IMAGES.'cartao.gif')."</center></td>
	 </tr>
	 </table>
     </td>
			</tr>
 </table>   
";
	
echo $table;

//}//FIM DO IF PARA MODULO ATIVO

?>