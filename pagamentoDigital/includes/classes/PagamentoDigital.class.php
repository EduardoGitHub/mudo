<?php
  /**
  * Desenvolvido por Webtask Serviços para Internet
  * Módulo de Pagamento osCommerce 2.2 para o Pagamento Digital
  * http://www.webtask.com.br
  * Programador: Luiz Fumes
  */
  
  class PagamentoDigital {
    
    var $boletoVencimento;
    
    var $urlRetorno;
    
    var $emailLoja;
    
    var $tipoIntegracao;
    
    var $chaveAcesso;
    
    var $connect;
    
    var $database;
    
    function PagamentoDigital() {
      
      $this->connect = mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
      $this->database = mysql_select_db(DB_DATABASE, $this->connect);
      
      $this->start();
            
    }
    
    function start() {
      $query = 'select 
                  configuration_key, 
                  configuration_value 
                from 
                  configuration 
                where 
                  configuration_key like "MODULE_PAYMENT_PD%"';
      $select = mysql_query($query);
      while($show = mysql_fetch_array($select)) {
        switch($show['configuration_key']) {
          case 'MODULE_PAYMENT_PD_DIAS_VENCIMENTO_BOLETO': $this->boletoVencimento = $show['configuration_value'];break;
          case 'MODULE_PAYMENT_PD_URL_RETORNO': $this->urlRetorno = $show['configuration_value'];break;
          case 'MODULE_PAYMENT_PD_EMAIL_LOJA': $this->emailLoja = $show['configuration_value'];break;
          case 'MODULE_PAYMENT_PD_TIPO_INTEGRACAO': $this->tipoIntegracao = $show['configuration_value'];break;
          case 'MODULE_PAYMENT_PD_CHAVE': $this->chaveAcesso = $show['configuration_value'];break;
        }
      }
    }
    
    function getVencimentoBoleto() {
      return $this->boletoVencimento;
    }
    
    function getUrlRetorno() {
      return $this->urlRetorno;
    }
    
    function getEmailLoja() {
      return $this->emailLoja;
    }
    
    function getTipoIntegracao() {
      return $this->tipoIntegracao;
    }
    
    function getChaveAcesso() {
      return $this->chaveAcesso;
    }
    
    function getLanguageDir() {
      $query = "select
                  l.directory
                from
                  languages l,
                  configuration c
                where
                  c.configuration_value=l.code and
                  c.configuration_key='DEFAULT_LANGUAGE'";
      $select = mysql_query($query, $this->connect);
      $show = mysql_fetch_array($select);
      
      return $show['directory'];
    }
    
  }
?>
