<?php
/*
  $Id: database.php,v 1.21 2003/06/09 21:21:59 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  function tep_db_connect($server = DB_SERVER, $username = DB_SERVER_USERNAME, $password = DB_SERVER_PASSWORD, $database = DB_DATABASE, $link = 'db_link') {
    global $$link;

    if (USE_PCONNECT == 'true') {
      $$link = mysql_pconnect($server, $username, $password);
    } else {
      $$link = mysql_connect($server, $username, $password);
    }

    if ($$link) mysql_select_db($database);

    return $$link;
  }

  function tep_db_close($link = 'db_link') {
    global $$link;

    return mysql_close($$link);
  }

  function tep_db_error($query, $errno, $error) { 
    die('<font color="#000000"><b>' . $errno . ' - ' . $error . '<br><br>' . $query . '<br><br><small><font color="#ff0000">[TEP STOP]</font></small><br><br></b></font>');
  }

  function tep_db_query($query, $link = 'db_link') {
    global $$link;

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
      error_log('QUERY ' . $query . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }

    $result = mysql_query($query, $$link) or tep_db_error($query, mysql_errno(), mysql_error());

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
       $result_error = mysql_error();
       error_log('RESULT ' . $result . ' ' . $result_error . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }

    return $result;
  }

  function tep_db_perform($table, $data, $action = 'insert', $parameters = '', $link = 'db_link') {
    reset($data);
    if ($action == 'insert') {
      $query = 'insert into ' . $table . ' (';
      while (list($columns, ) = each($data)) {
        $query .= $columns . ', ';
      }
      $query = substr($query, 0, -2) . ') values (';
      reset($data);
      while (list(, $value) = each($data)) {
        switch ((string)$value) {
          case 'now()':
            $query .= 'now(), ';
            break;
          case 'null':
            $query .= 'null, ';
            break;
		  case '':
            $query .= 'DEFAULT, ';
            break;
          default:
            $query .= '\'' . tep_db_input($value) . '\', ';
            break;
        }
      }
      $query = substr($query, 0, -2) . ')';
    } elseif ($action == 'update') {
      $query = 'update ' . $table . ' set ';
      while (list($columns, $value) = each($data)) {
        switch ((string)$value) {
          case 'now()':
            $query .= $columns . ' = now(), ';
            break;
          case 'null':
            $query .= $columns .= ' = null, ';
            break;
		  case '':
            $query .= $columns .= ' = DEFAULT, ';
            break;
          default:
            $query .= $columns . ' = \'' . tep_db_input($value) . '\', ';
            break;
        }
      }
      $query = substr($query, 0, -2) . ' where ' . $parameters;
    }

    return tep_db_query($query, $link);
  }

  function tep_db_fetch_array($db_query) {
    return mysql_fetch_array($db_query, MYSQL_ASSOC);
  }

  function tep_db_num_rows($db_query) {
    return mysql_num_rows($db_query);
  }

  function tep_db_data_seek($db_query, $row_number) {
    return mysql_data_seek($db_query, $row_number);
  }

  function tep_db_insert_id() {
    return mysql_insert_id();
  }

  function tep_db_free_result($db_query) {
    return mysql_free_result($db_query);
  }

  function tep_db_fetch_fields($db_query) {
    return mysql_fetch_field($db_query);
  }

  function tep_db_output($string) {
    return htmlspecialchars($string);
  }

  function tep_db_input($string) {
    return addslashes($string);
  }

  function tep_db_prepare_input($string) {
    if (is_string($string)) {
      return trim(tep_sanitize_string(stripslashes($string)));
    } elseif (is_array($string)) {
      reset($string);
      while (list($key, $value) = each($string)) {
        $string[$key] = tep_db_prepare_input($value);
      }
      return $string;
    } else {
      return $string;
    }
  }
  
  function execute_db ($table, $values = '', $parameters = '', $action = 'salvar', $ver_sql = false)
	{
	    if ((isset($values)) && $values != '') reset($values);
	    
	    if ($action == 'salvar') {
	        $query = 'insert into ' . $table . ' (';
	        foreach ($values as $columns => $value) $query .= $columns . ', ';
	        
	        $query = substr($query, 0, - 2) . ') values (';
	        
	        if ((isset($values)) && $values != '')reset($values);
	        
	        foreach ($values as $columns => $value) {
	            switch ((string) $value) {
	                case 'now()':
	                    $query .= 'now(), ';
	                    break;
	                case 'null':
	                    $query .= 'null, ';
	                    break;
	                default:
	                    $query .= '\'' . addslashes($value) . '\', ';
	                    break;
	            }
	        }
	        $query = substr($query, 0, - 2) . ')';
	       if($ver_sql == true) echo $query;
	    }elseif ($action == 'replace') {
	        $query = 'replace into ' . $table . ' (';
	        foreach ($values as $columns => $value) $query .= $columns . ', ';
	        
	        $query = substr($query, 0, - 2) . ') values (';
	        
	        if ((isset($values)) && $values != '')reset($values);
	        
	        foreach ($values as $columns => $value) {
	            switch ((string) $value) {
	                case 'now()':
	                    $query .= 'now(), ';
	                    break;
	                case 'null':
	                    $query .= 'null, ';
	                    break;
	                default:
	                    $query .= '\'' . addslashes(utf8_decode($value)) . '\', ';
	                    break;
	            }
	        }
	        $query = substr($query, 0, - 2) . ')';
	       if($ver_sql == true) echo $query;
	    } elseif ($action == 'alterar') {
	        $query = 'update ' . $table . ' set ';
	        foreach ($values as $columns => $value) {
	            switch ((string) $value) {
	                case 'now()':
	                    $query .= $columns . ' = now(), ';
	                    break;
	                case 'null':
	                    $query .= $columns .= ' = null, ';
	                    break;
	                default:
	                    $query .= $columns . ' = \'' . addslashes($value) . '\', ';
	                    break;
	            }
	        }
	        $query = substr($query, 0, - 2) . ' where ' . $parameters;
	        if($ver_sql == true) echo $query;
	    } elseif ($action == 'remover') {
	        $query = 'delete from ' . $table . ' where ' . $parameters;
	        if($ver_sql == true) echo $query;
	    }
	    return mysql_query($query)or die($query." ".mysql_error());
	}
	
	function process_db ($table, $values, $parameters = '', $action = 'listar', $ver_sql = false)
	{
	    if ((isset($values)) && $values != '*')reset($values);

	    if ($action == 'listar') {
	        if ((isset($values)) && $values != '*') {
	            $query = 'select ';
	           foreach ($values as $columns => $value) {
	                $query .= $value . ', ';
	            }
	            $query = substr($query, 0, - 2) . ' from ' . $table . ' ' . $parameters;
	        } else {
	            $query = 'select * from ' . $table . ' ' . $parameters;
	        }
	        
	        if($ver_sql == true) echo $query; // mostra a query que esta sendo executada no banco de dados
	        //echo $query;

		        $res = mysql_query($query);
		        if($res){
			        $ret = array();
			        $num = mysql_num_rows($res);
			        if ($num > 0) {
			            for ($i = 0; $i < $num; $i ++) {
			                $ret[] = mysql_fetch_array($res,MYSQL_ASSOC) or die(mysql_error());
			            }
			        }
		        }
	    }
	    if(isset($ret))return $ret;
	}
?>
