
<?php
session_start();


updatePaciente();


function updatePaciente() {

    include_once "../lib/database/class.databaseFetchAssoc.php";
    include("../lib/database/dbconfig.php");
    $numero=$_POST['numero_paciente'];
    $nome=$_POST['nome_paciente'];
    $dtintera=$_POST['dtInter_paciente'];
    $dtparto=$_POST['dtParto_paciente'];
    $clasrobison=$_POST['clasRob'];
    $tipointerna=$_POST['TipoInter'];
    $admobstetrica=$_POST['adimis'];
    $risco=$_POST['risco'];
    $trasn=$_POST['tranfu'];
    $evento=$_POST['message'];

    if(empty($numero))
    {echo 'Tá Vazio ZÉ!!<br>';}


          echo 'teste1<br>';
        $DB = new ConexaoBD();
        $DB->ligarBD($NOME_BD, $USER_DB, $PASS_DB, $NOME_SERVIDOR);

    echo 'teste1<br>';

        $sql = "UPDATE teste_paciente SET tipoParto_paciente = '$tipointerna',tipoTP_paciente = '$admobstetrica',
        risco_paciente='$risco',dtParto_paciente='$dtparto',class_rob='$clasrobison' ,transfusao_paciente='$trasn',evento_paciente='$evento'
         WHERE numero_paciente = '$numero'";
    echo 'teste1<br>';
        $resultado = $DB->executarSQL($sql);
    echo 'teste1<br>';
        //echo '<pre>';print_r($resultado);echo '<pre>';
       header('Location:/src/index.php#');
    echo 'teste1<br>';
        $DB->fecharBD();









}



?>
