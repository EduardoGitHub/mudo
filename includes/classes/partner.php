<?php 

class Partner{
	
	
	public function newPartner($dados){
		
		$dadosCustomers = array(
			'customers_type_register' 	=> 'P',//Parceiros      
			'customers_firstname' 		=> $dados['firstname'],
			'customers_rg' 				=> $dados['rg'],                 
			'customers_cpf' 			=> $dados['cpf'],                
			'customers_email_address' 	=> $dados['email_address'],     
			//'customers_default_address_id' => 
			'customers_telephone' 		=> $dados['telephone'],
			'customers_newsletter' 		=> 1,                  
			'customers_revendedor' 		=> 0,        
			'customers_fax' 			=> $dados['fax'],               
			'customers_password' 		=> $dados['password'],        
			'customers_type' 			=>  0        
		);
		execute_db(TABLE_CUSTOMERS, $dadosCustomers);
		$idCustomers = mysql_insert_id();
		
		//Pega areas de atua��o
			$atuacao = $dados['area'];
			$numReg = count($atuacao);
			$dadosAtua = '';
			for($cont =0; $cont < $numReg; $cont++){
				$dadosAtua .= $atuacao[$cont].', ';
			}
		//Fim pega areas de atuacao
		
		$dadosPartner = array(
			'partner_name' 		=> $dados['firstname'],   
			'partner_url' 		=> $dados['url'],     
			'partner_pageviews' => $dados['pageviews'],
			'partner_atuacao' 	=> $dadosAtua, 
			'partner_status' 	=> 0,  
			'partner_cod' 		=> $this->geraCod(),    
			'partner_desc' 		=> $dados['desc'],    
			'customers_id' 		=> $idCustomers    
		);
		execute_db(TABLE_PARTNERS, $dadosPartner);
		$idPartner = mysql_insert_id();
		
		
		$dadosEndereco = array(
			'customers_id'			=>  $idCustomers,      
			'partner_id'			=>  $idPartner,        
			'entry_company'			=>  $dados['company'],     
			'entry_firstname'		=> 	$dados['firstname'],    
			'entry_street_address' 	=>	$dados['street_address'],
			'entry_street_number'	=>	$dados['street_number'], 
			'entry_suburb'			=>  $dados['suburb'],      
			'entry_complemento'		=>  $dados['complemento'], 
			'entry_postcode'		=>  $dados['postcode'],    
			'entry_city'			=>  $dados['city'],        
			'entry_state'			=>  $dados['state'],       
			'entry_country_id'		=>  30,  
			'entry_zone_id'			=>  $this->getCodEstado($dados['state'])    
		
		);
		execute_db(TABLE_ADDRESS_BOOK, $dadosEndereco);

        define('EMAIL_SUBJECT', 'Bem Vindo - ' . STORE_NAME);
		$html = '<table width="760" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #CCC; padding:15px; background-color:#D7AB00" align="center">
		  
          <tr>
			<td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="56%" rowspan="2" align="center">'.$dados['firstname'].' - &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><span style="font-size:20px">Seja</span><br><span style="font-size:40px">Bem Vindo!</span></td>
                    <td width="44%"><img src="http://www.mudominhacasa.com.br/images/mail/mudominhacasa.png" width="332" height="59"/></td>
                  </tr>
                  <tr>
                    <td style="color:#000; font-weight:bold; text-align:right; padding-right:3px;">wwww.mudominhacasa.com.br</td>
                  </tr>
                </table>

            </td>
		  </tr>
          <tr>
			<td class="texto">
            	<table width="760" border="0" cellspacing="0" cellpadding="0" style="background-color:#FFF; margin:5px">
                  <tr>
                    <td style="padding:5px"><p style="font-size:30px; text-align:center">Adesivos de Parede para Decoração da sua Casa, Quarto ou Escritório!</p><br>

<p style="text-align:center">O Mudominhacasa.com tem o prazer de lhe dar boas vindas, tendo em vista a sua recente inclusão em nosso cadastro de clientes.  </p>
<p style="text-indent:15px; text-align:justify">
Na nossa loja virtual você confere uma enorme variedade de adesivos decorativos para todos os tipos de ambientes e com temáticas atuais. Nossos modelos são modernos e
descolados, e ajudam a personalizar qualquer ambiente com um toque de requinte.
São adesivos criativos que abordam diversas categorias e assuntos com grande apelo artístico. Nós queremos realmente recriar as paredes brancas e os móveis comuns.</p><br>
Confira abaixo alguns serviços que você já pode desfrutar:<br><br>
</td>
                  </tr>
                  <tr>
                  	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="16%" align="center"><img src="http://www.mudominhacasa.com.br/images/mail/6vezes.png"></td>
                            <td width="2%">&nbsp;</td>
                            <td width="82%" style="background-color:#FFDAA3">PAGAMENTO FACILITADO <br>
Todos os produtos da loja podem ser divididos em 6 vezes sem juros!
</td>
                          </tr>
                          <tr><td colspan="3" height="10"></td></tr>
                          <tr> 
                            <td align="center"><img src="http://www.mudominhacasa.com.br/images/mail/comprasegura.png"></td>
                            <td>&nbsp;</td>
                            <td style="background-color:#FFDAA3">COMPRA SEGURA <br>
Compra efetuada em ambiente seguro. Não temos acesso a seus Dados Banc�rios.
</td>
                          </tr>
                          <tr><td colspan="3" height="10"></td></tr>
                          <tr>
                            <td align="center"><img src="http://www.mudominhacasa.com.br/images/mail/personalizados.png"></td>
                            <td>&nbsp;</td>
                            <td style="background-color:#FFDAA3">PRODUTOS PERSONALIZADOS<br/>
N�o encontrou o que procura? Criamos Produtos Exclusivos para você!
</td>
                          </tr>
                          <tr><td colspan="3" height="10"></td></tr>
                          <tr>
                            <td align="center"><img src="http://www.mudominhacasa.com.br/images/mail/qualidade.png"/></td>
                            <td>&nbsp;</td>
                            <td style="background-color:#FFDAA3">QUALIDADE INDISCUTÍVEL<br/>
Produzido com adesivo ultrafino, de melhor desempenho encontrado no mercado.
</td>
                          </tr>
                          <tr><td colspan="3" height="10"></td></tr>
                          <tr>
                            <td align="center"><img  src="http://www.mudominhacasa.com.br/images/mail/entrega.png"></td>
                            <td>&nbsp;</td>
                            <td style="background-color:#FFDAA3">ENTREGA RÁPIDA PARA TODO O BRASIL<br/>
Entregamos em todo o Brasil via Correios. Escolha a melhor opção de entrega.
</td>
                          </tr>
                        </table>

                    </td>
                  </tr>  
                  <tr><td style="text-align:center; font-size:25px; font-weight:bold">www.mudominhacasa.com.br</td></tr>
                  <tr><td align="center">Em caso de dúvidas entre em contato através do e-mail: atendimento@mudominhacasa.com.br</td></tr>
                </table>
			</td>
		  </tr>
		  <tr>
			<td style="text-align:center; font-size:13px; font-family:Tahoma; padding:10px">
            Muito obrigado pela sua preferência e compreensão!<br>
            Esperamos sua total satisfação na aquisição do seu produto Mudominhacasa - Adesivos Decorativos
            </td>
		  </tr>
		</table>';
		
		tep_sendMailOrders($dados['email_address'], EMAIL_SUBJECT, $html, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
		
		return array('retorno' => 1);
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $tamanho
	 * @param unknown_type $maiusculas
	 * @param unknown_type $numeros
	 * @param unknown_type $simbolos
	 */
	public function geraCod($tamanho = 10, $maiusculas = true, $numeros = true, $simbolos = false)
	{
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%*-';
		$retorno = '';
		$caracteres = '';
		
		$caracteres .= $lmin;
		if ($maiusculas) $caracteres .= $lmai;
		if ($numeros) $caracteres .= $num;
		if ($simbolos) $caracteres .= $simb;
		
		$len = strlen($caracteres);
		for ($n = 1; $n <= $tamanho; $n++) {
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];
		}
		
		return $retorno;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $estado
	 */
	public function getCodEstado($estado){
		$retorno = process_db(TABLE_ZONES, array('zone_id'),' WHERE zone_code="'.$estado.'"');
		return $retorno[0]['zone_id'];
	}
	
	
	
}

?>