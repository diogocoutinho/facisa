
<?php
session_start();


deletePaciente();


function deletePaciente() {

    include_once "../lib/database/class.databaseFetchAssoc.php";
    include("../lib/database/dbconfig.php");
    $numero=$_POST['numero_paciente'];
    echo 'teste1<br>';
        $DB = new ConexaoBD();
        $DB->ligarBD($NOME_BD, $USER_DB, $PASS_DB, $NOME_SERVIDOR);
     echo '1<br>';
     echo $numero;
     echo '2<br>';
        echo 'teste2<br>';
        $sql = "SELECT * FROM teste_paciente where numero_paciente='$numero'";
        //echo '<pre>';print_r($resultado);echo '<pre>';
        $resultado=$DB->executarSQL($sql);
        echo '<pre>';print_r($resultado);echo '<pre>';
    echo 'teste3<br>';

        //Cara não deu de jeito nenhum pra fazer diferente
        $a=$resultado[0]['numero_paciente'];
        $b=$resultado[0]['nome_paciente'];
        $c=$resultado[0]['dtInter_paciente'];
        $d=$resultado[0]['tipoParto_paciente'];
        $e=$resultado[0]['tipoTP_paciente'];
        $f=$resultado[0]['risco_paciente'];
        $g=$resultado[0]['transfusao_paciente'];
        $h=$resultado[0]['evento_paciente'];
        $i=$resultado[0]['dtParto_paciente'];
        $j=$resultado[0]['class_rob'];
        $historico="INSERT INTO historico_paciente VALUES('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j')";
    echo 'teste4<br>';
    try{
        $DB->executarSQL($historico);
    }catch (Exception $ex){
        echo $ex;
    }
    echo 'teste5<br>';
        $delete="DELETE FROM teste_paciente WHERE numero_paciente='$numero';";
        echo $delete;
        $DB->executarSQL($delete);
    echo 'teste5<br>';
        echo '<pre>';print_r($resultado);echo '<pre>';
       // echo '<script>alert("Realizado com Sucesso!!")</script>';
        header('Location:/src/index.php#');
        $DB->fecharBD();















}

?>
