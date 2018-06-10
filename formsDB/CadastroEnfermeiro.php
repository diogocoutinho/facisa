
<?php
session_start();


insertEnfermeiro();


function insertEnfermeiro() {

    include_once "../lib/database/class.databaseFetchAssoc.php";
    include("../lib/database/dbconfig.php");
    $nome=$_POST['nome'];
    $senha=md5($_POST['senha']);
    $email=$_POST['email'];
    $crm=$_POST['coren'];
    $repetesenha=md5($_POST['repetesenha']);



    if($senha==$repetesenha) {
        if (($nome!="")&&($email!="")&&($crm!="")) {
            if ($senha != 'd41d8cd98f00b204e9800998ecf8427e') {
                $DB = new ConexaoBD();
                $DB->ligarBD($NOME_BD, $USER_DB, $PASS_DB, $NOME_SERVIDOR);
                $sqlpesc="SELECT * FROM Enfermeiro WHERE email = '$email'";
                $resultpesc=$DB->executarSQL($sqlpesc);
                $sqlpesc2="SELECT * FROM Enfermeiro WHERE coren = '$crm'";
                $resultpesc2=$DB->executarSQL($sqlpesc2);

                foreach ($resultpesc as $pesc){
                    echo '<script>alert("Este Email já esta cadastrado em nossa Base de Dados!") </script>>';
                    echo "<meta http-equiv=\"refresh\" content=1;url=\src/login.html>";
                }foreach ($resultpesc2 as $pesc2){
                    echo '<script>alert("Este COREN já esta cadastrado em nossa Base de Dados!") </script>>';
                    echo "<meta http-equiv=\"refresh\" content=1;url=\src/login.html>";
                }
                if(!isset($pesc) && !isset($pesc2)) {

                    $sql = "INSERT INTO Enfermeiro VALUES('$nome' , '$crm' ,'$email' ,'$senha')";
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