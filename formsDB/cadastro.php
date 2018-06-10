
<?php
session_start();


insertMedico();


function insertMedico() {

    include_once "../lib/database/class.databaseFetchAssoc.php";
    include("../lib/database/dbconfig.php");
    $nome=$_POST['nome'];
    $senha=md5($_POST['senha']);
    $email=$_POST['email'];
    $crm=$_POST['crm'];
    $espec=$_POST['espec'];
    $repetesenha=md5($_POST['repetesenha']);



if($senha==$repetesenha) {
    if (($nome!="")&&($email!="")&&($crm!="")&&($espec!="")) {
        if ($senha != 'd41d8cd98f00b204e9800998ecf8427e') {
            $DB = new ConexaoBD();
            $DB->ligarBD($NOME_BD, $USER_DB, $PASS_DB, $NOME_SERVIDOR);
            $sqlpesc="SELECT * FROM Medico WHERE email = '$email'";
            $resultpesc=$DB->executarSQL($sqlpesc);
            $sqlpesc2="SELECT * FROM Medico WHERE crm = '$crm'";
            $resultpesc2=$DB->executarSQL($sqlpesc2);

            foreach ($resultpesc as $pesc){
                echo '<script>alert("Este Email já esta cadastrado em nossa Base de Dados!") </script>';
                echo "<meta http-equiv=\"refresh\" content=1;url=\src/login.html>";
            }foreach ($resultpesc2 as $pesc2){
                echo '<script>alert("Este CRM já esta cadastrado em nossa Base de Dados!") </script>';
                echo "<meta http-equiv=\"refresh\" content=1;url=\src/login.html>";
            }
            if(!isset($pesc) && !isset($pesc2)) {
                $sql = "INSERT INTO Medico VALUES('$nome' , '$crm' , '$espec' , '$senha','$email')";
                $resultado = $DB->executarSQL($sql);
                echo '<script> alert("Cadastrado com Sucesso!")</script>';
                echo "<meta http-equiv=\"refresh\" content=1;url=\src/login.html>";


                //echo '<pre>';print_r($resultado);echo '<pre>';
            }
            $DB->fecharBD();


        } else {
            echo '<script> alert("Preencha todos os campos!")</script>';
            echo "<meta http-equiv=\"refresh\" content=1;url=\src/login.html>";

        }
    } else {
        echo '<script> alert("Preencha todos os campos!")</script>';
        echo "<meta http-equiv=\"refresh\" content=1;url=\src/login.html>";

    }
  }else{
    echo '<script> alert("Senhas estão diferentes!")</script>';
    echo "<meta http-equiv=\"refresh\" content=1;url=\src/login.html>";

}

}

?>