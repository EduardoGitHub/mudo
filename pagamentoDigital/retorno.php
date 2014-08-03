<?php

  /**
  * Desenvolvido por Webtask Serviços para Internet
  * Módulo de Pagamento osCommerce 2.2 para o Pagamento Digital
  * http://www.webtask.com.br
  * Programador: Luiz Fumes
  */
  if ($_POST) {
    require_once("../includes/configure.php");
    require_once("./includes/classes/PagamentoDigital.class.php");
    $objPagamentoDigital = new PagamentoDigital();
    
    $languageDir = $objPagamentoDigital->getLanguageDir();
    
    require_once("../includes/languages/".$languageDir."/modules/payment/pagamentodigital.php");
    
    // Variáveis de retorno

    // Obtenha seu TOKEN entrando no menu Ferramentas do Pagamento Digital
    $token = $objPagamentoDigital->getChaveAcesso();
    
    $key = array_keys($_POST);
    $teste = "RECEBIDO POR POST: ";
    for ($i=0, $total=count($_POST); $i<$total; $i++) {
      $teste .= 'Key: '.$key[$i].'=>'.$_POST[$key[$i]]."\n";
    }
    
    $key = array_keys($_GET);
    $teste2 = "RECEBIDO POR GET: ";
    for ($i=0, $total=count($_GET); $i<$total; $i++) {
      $teste2 .= 'Key: '.$key[$i].'=>'.$_GET[$key[$i]]."\n";  
    }


    /* Montando as variáveis de retorno */
    $id_transacao = $_POST['id_transacao'];
    $id_pedido = $_POST['id_pedido'];
    $data_transacao = $_POST['data_transacao'];
    $valor_original = $_POST['valor_original'];
    $tipo_pagamento = $_POST['tipo_pagamento'];
    $parcelas = $_POST['parcelas'];
    $status = $_POST['status'];
    $cliente_nome = $_POST['cliente_nome'];
    $cliente_email = $_POST['cliente_email'];
    $cliente_cpf = $_POST['cliente_cpf'];
    $cliente_endereco = $_POST['cliente_endereco'];
    $cliente_complemento = $_POST['cliente_complemento'];
    $status = $_POST['status'];
    $cliente_bairro = $_POST['cliente_bairro'];
    $cliente_cidade = $_POST['cliente_cidade'];
    $cliente_estado = $_POST['cliente_estado'];
    $cliente_cep = $_POST['cliente_cep'];
    $tipo_frete = $_POST['tipo_frete'];
    $informacoes_loja = $_POST['informacoes_loja'];

    /* Essa variável indica a quantidade de produtos retornados */
    $qtde_produtos = $_POST['qtde_produtos'];


    $post = "transacao=$id_transacao"."&status=$status"."&valor_original=$valor_original"."&valor_loja=$valor_loja"."&token=$token";
    $enderecoPost = "https://www.pagamentodigital.com.br/checkout/verify/";

    ob_start();
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL, $enderecoPost);
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
    curl_exec ($ch);
    $resposta = ob_get_contents();
    ob_end_clean();
    
    $title = EMAIL_TITLE_PG;
    
    $email = EMAIL_PG_STATUS.$status."\n";
    $email .= EMAIL_PG_ID_PEDIDO.$id_pedido."\n";
    $email .= EMAIL_PG_ID_TRANSACAO.$id_transacao."\n";
    $email .= EMAIL_PG_DATA.$data_transacao."\n";
    $email .= EMAIL_PG_VALOR.$valor_original."\n";
    $email .= EMAIL_PG_TIPO_PAGAMENTO.$tipo_pagamento."\n";
    $email .= EMAIL_PG_PARCELAS.$parcelas."\n";
    $email .= EMAIL_PG_CLIENTE_NOME.$cliente_nome."\n";
    $email .= EMAIL_PG_CLIENTE_EMAIL.$cliente_email."\n";
    $email .= EMAIL_PG_CLIENTE_CPF.$cliente_cpf."\n";
    $email .= EMAIL_PG_CLIENTE_ENDERECO.$cliente_endereco."\n";
    $email .= EMAIL_PG_COMPLEMENTO.$cliente_complemento."\n";
    $email .= EMAIL_PG_BAIRRO.$cliente_bairro."\n";
    $email .= EMAIL_PG_CIDADE.$cliente_cidade."\n";
    $email .= EMAIL_PG_ESTADO.$cliente_estado."\n";
    $email .= EMAIL_PG_CEP.$cliente_cep."\n";
    $email .= EMAIL_PG_FRETE.$tipo_frete."\n";
    $email .= EMAIL_PG_REPOSTA.$resposta."\n\n";

    mail($objPagamentoDigital->getEmailLoja(), $title, $email, 'From: '.$objPagamentoDigital->getEmailLoja());
  }
?> 
