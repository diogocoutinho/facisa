<?php
/**
 **  ConexaoBD.php - Esta classe controla a conexao com a Base de Dados MySQL
 **  Copyright (C) 2009-2010 Juliano Gaspar - julianogaspar@hotmail.com
 **  Author(s): Juliano Gaspar
 **
 **  For more information on licensing, read the README file.
 **  Para mais informacoes sobre o licenciamento, leia o ficheiro README.
 **/

include("dbconfig.php");

class ConexaoBD {

	var $conn;

	function ligarBD($bdname, $user, $password, $server) {
		$this->conn = mysql_connect($server, $user, $password);
		if($this->conn<0) {
			return -1;
		}
		if(mysql_select_db($bdname, $this->conn)==false) {
			return -2;
		}
	}
	
	function executarSQL($sql_command) {
		$resultado = mysql_query($sql_command, $this->conn);
		$num = mysql_num_rows($resultado);
		$i = 0;
		$matriz = array();
		if ($num > 0) {
           			while ($row = mysql_fetch_row($resultado)) {
				$matriz[$i] = $row;
				$i++;
			}
			return $matriz;
		} else {
			return array();
		}
		return $resultado;
	}
        
        //ociFetchStatement($cursor, $rph, null, null, OCI_NUM + OCI_FETCHSTATEMENT_BY_COLUMN)
        //retorno de um array OCI_FETCHSTATEMENT_BY_COLUMN respeitante a uma query
        function simpleQuery_byname($sql_command){
                $stmt = consulta_cursor($sql_command);
                $arr = array();
                while ( OCIFetchInto($stmt, $values, OCI_ASSOC + OCI_RETURN_NULLS) )
                        $arr[] = $values;
                OCIFreeStatement($stmt);
                return $arr;
        }



		
	function insertSQL($sql_command) {
		mysql_query($sql_command, $this->conn);
		return mysql_insert_id();
	}
	
	function updateSQL($sql_command) {
		$resultado = mysql_query($sql_command, $this->conn);
		return $resultado;
	}

	function fecharBD() {
		mysql_close($this->conn);
	}

	/* Transactions functions */

   function begin(){
      $null = mysql_query("START TRANSACTION", $this->connection);
      return mysql_query("BEGIN", $this->connection);
   }

   function commit(){
      return mysql_query("COMMIT", $this->connection);
   }
   
   function rollback(){
      return mysql_query("ROLLBACK", $this->connection);
   }

   function transaction($q_array){
         $retval = 1;

      $this->begin();

         foreach($q_array as $qa){
            $result = mysql_query($qa['query'], $this->connection);
            if(mysql_affected_rows() == 0){ $retval = 0; }
         }

      if($retval == 0){
         $this->rollback();
         return false;
      }else{
         $this->commit();
         return true;
      }
   }
   

}


   //retorno de um cursor respeitante a uma query
function consulta_cursor($query){
	global $conn;
	//echo $query."<br><br><br>";
	$cursor = ociparse($conn, $query);
	if (! $cursor) {
		$query;
		echo OCIError($cursor) . "<BR>";
		exit();
	}
	$r = @ociexecute($cursor);
	if (! $r) {
		$e = OCIError($cursor); // For oci_execute errors pass the statementhandle
		if ($e['code'] == 904) {
			echo "<hr>";
			echo "ERRO: O campo  <b><i>" . htmlentities($e['message']) . "</i></b> não existe na tabela escolhida";
			echo "<pre>";
			echo htmlentities($e['sqltext']);
			//echo $e['sqltext'];
			printf("\n%" . ($e['offset'] + 13) . "s", "^ - Erro aqui!");
			printf("\n%" . ($e['offset']) . "s", "|");
			echo "</pre>";
			echo "<hr>";
			exit();
		} else {
			echo "<hr>";
			echo htmlentities($e['message']);
			echo "<pre>";
			echo htmlentities($e['sqltext']);
			//echo $e['sqltext'];
			printf("\n%" . ($e['offset'] + 13) . "s", "^ - Erro aqui!");
			printf("\n%" . ($e['offset']) . "s", "|");
			echo "</pre>";
			echo "<hr>";
			exit();
		}
	}
	return $cursor;
}

?>


