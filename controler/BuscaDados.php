<?php

class Buscar
{

    function buscaDados()
    {



        include_once "../lib/database/class.databaseFetchAssoc.php";
        include("../lib/database/dbconfig.php");

        $DB = new ConexaoBD();
        $DB->ligarBD($NOME_BD, $USER_DB, $PASS_DB, $NOME_SERVIDOR);

        $sql = "SELECT * FROM teste_paciente";
        $resultado = $DB->executarSQL($sql);
        $DB->fecharBD();
        return ($resultado);



    }


}

?>