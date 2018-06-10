
<?php
session_start();


insertPaciente();


function insertPaciente() {

    include_once "../lib/database/class.databaseFetchAssoc.php";
    include("../lib/database/dbconfig.php");
    $numero=$_POST['numero_paciente'];
    $nome=$_POST['nome_paciente'];
    $dtintera=$_POST['dtInter_paciente'];
    $dtparto=$_POST['dtParto_paciente'];
    $tipointerna=$_POST['TipoInter'];
    $admobstetrica=$_POST['adimis'];
    $risco=$_POST['risco'];
    $trasn=$_POST['tranfu'];
    $evento=$_POST['message'];
    $rob=$_POST['clasRob'];
    $cor=$_POST['cor'];






    if (($nome!="")&&($numero!="")&&($dtintera!="")&&($dtparto!="")&&($tipointerna!="")&&($admobstetrica!="")&&($risco!="")&&($trasn!="")) {
       
        $DB = new ConexaoBD();
        $DB->ligarBD($NOME_BD, $USER_DB, $PASS_DB, $NOME_SERVIDOR);



        $sql = "INSERT INTO teste_paciente VALUES('$numero' , '$nome' , '$dtintera'
 ,'$tipointerna','$admobstetrica','$risco','$trasn','$evento','$dtparto','$rob',$cor)";
        try {
            $DB->executarSQL($sql);
            echo '<script>alert("Cadastro Realizado com sucesso!") </script>';
            echo "<meta http-equiv=\"refresh\" content=1;url=\src/index.php>";

        }catch (Exception $ex){
            echo '<script>alert("Falha ao Cadastrar, verifique os dados!") </script>';
            echo "<meta http-equiv=\"refresh\" content=1;url=\src/index.php>";
        }

        //echo '<pre>';print_r($resultado);echo '<pre>';
       //header('Location:/src/index.php#');
        $DB->fecharBD();

    }else{

        //echo "<a href=../htmlForms/CadastrarPaciente.php>Cilique aqui para Retornar</a><br>";
        echo '<script>alert("Falta preencher campos!") </script>';
        echo "<meta http-equiv=\"refresh\" content=1;url=\src/index.php>";

    }







}

?>