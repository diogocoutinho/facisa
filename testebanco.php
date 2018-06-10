
<?php
    session_start();


    adicionaMedico();


function adicionaMedico() {

    include_once "../lib/database/class.databaseFetchAssoc.php";
    include("../lib/database/dbconfig.php");

    $DB = new ConexaoBD();
    $DB->ligarBD($NOME_BD, $USER_DB, $PASS_DB, $NOME_SERVIDOR);
    $sql = "SELECT * FROM teste_paciente";
    $resultado = $DB->executarSQL($sql);
    $DB->fecharBD();
    if(str_replace($resultado[1]['evento_paciente']=="")){
        echo 'teste';
    }


   echo '<pre>';print_r($resultado); echo '</pre>';


    //$linha = $resultado[0];
    //$tpl->ID_MEDICO =$linha['ID_MEDICO'];
    //$tpl->NOME_MEDICO =$linha['NOME_MEDICO'];


}

?>