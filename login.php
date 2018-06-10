<?php
session_start();





consultarTabela_teste();


function consultarTabela_teste() {

    include_once "lib/database/class.databaseFetchAssoc.php";
    include("lib/database/dbconfig.php");
    $id1=$_POST['id'];
    $nome1=md5($_POST['senha']);
    $usuario_escape = addslashes($id1);
    $senha_escape = addslashes($nome1);
    if(($id1!="")&&($nome1!="d41d8cd98f00b204e9800998ecf8427e")){


    $DB = new ConexaoBD();
    $DB->ligarBD($NOME_BD, $USER_DB, $PASS_DB, $NOME_SERVIDOR);
    $sql = "SELECT * FROM Medico WHERE email = '$usuario_escape' and senha= '$senha_escape'";
    $sql2 = "SELECT * FROM Enfermeiro WHERE email = '$usuario_escape' and senha= '$senha_escape'";
    try {
        $resultado = $DB->executarSQL($sql);
    }catch (Exception $ex){
        echo '<script>alert("Falha ao Executar pesquisa no Bando de Dados")</script>';
    }
    try {
            $resultado2 = $DB->executarSQL($sql2);
    }catch (Exception $ex){
            echo '<script>alert("Falha ao Executar pesquisa no Bando de Dados")</script>';
    }

    foreach ($resultado as $valor){

            if (isset($valor)) {
                //echo "$valor";
                $_SESSION['login'] = $id1;


                header('Location: index.php');


            }


    }
    foreach ($resultado2 as $valor){

            if (isset($valor)) {
                //echo "$valor";
                $_SESSION['login'] = $id1;


                header('Location: index.php');


            }
    }
    if(empty($valor)) {
    unset ($_SESSION['login']);


    echo '<script> alert("Email ou Senha incorretos!")</script>';
        echo "<meta http-equiv=\"refresh\" content=1;url=\src/login.html>";
    }



   $DB->fecharBD();


    }else{

        echo '<script> alert("Email ou Senha incorretos!")</script>';
        echo "<meta http-equiv=\"refresh\" content=1;url=\src/login.html>";
    }

}

?>
