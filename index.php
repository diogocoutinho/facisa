<?php
//include ("lib2/raelgc/view/Template.php");
require_once("lib/template/Template.php");
use raelgc\view\Template;
include_once "../lib/database/class.databaseFetchAssoc.php";
include("../lib/database/dbconfig.php");


    $_SESSION['login']=false;
    // esse bloco de código em php verifica se existe a sessão, pois o usuário pode simplesmente não fazer o login e digitar na barra de endereço do seu navegador o caminho para a página principal do site (sistema), burlando assim a obrigação de fazer um login, com isso se ele não estiver feito o login não será criado a session, então ao verificar que a session não existe a página redireciona o mesmo para a index.php.
    session_start();
    if(!isset ($_SESSION['login']) == true)
    {
        unset($_SESSION['login']);

        header('location:login.html');
    }else{


        $DB = new ConexaoBD();
        $DB->ligarBD($NOME_BD, $USER_DB, $PASS_DB, $NOME_SERVIDOR);
        $sql = "SELECT * FROM teste_paciente order by numero_paciente";
        $resultado = $DB->executarSQL($sql);
        $DB->fecharBD();
        $tpl = new Template("calmaDiogo.html");
        $teste=mysqli_fetch_assoc($resultado);

        for($i=0;$i<=19;$i++){
            $tpl->{"nome_paciente".strtoupper($i)}=$resultado[$i]['nome_paciente'];
            if(isset($resultado[$i]['numero_paciente'])){
                $tpl->{"id_paciente".strtoupper($i)}=$resultado[$i]['numero_paciente'];
            }else{
                $tpl->{"id_paciente".strtoupper($i)}='...';
            }

            $tpl->{"data_internacao".strtoupper($i)}= $resultado[$i]['dtInter_paciente'];
            $tpl->{"tempo_gravidez".strtoupper($i)}=$resultado[$i]['dtParto_paciente'];
            //$tpl->{"TIPOPARTOMODAL".strtoupper($i)}=$resultado[$i]['tipoParto_paciente'];
            if($resultado[$i]['tipoParto_paciente']=='Anteparto'){
                $tpl->{"TIPOPARTO".strtoupper($i)}='<i class="material-icons md-light" style="margin-right: -3px;">record_voice_over</i>
                <i class="material-icons md-dark md-inactive">pregnant_woman</i>
                <i class="material-icons md-dark md-inactive">child_friendly</i>';
                //$tpl->{"TIPOPARTOMODAL".strtoupper($i)}='Anteparto';

            }elseif ($resultado[$i]['tipoParto_paciente']=='Parto'){
                $tpl->{"TIPOPARTO".strtoupper($i)}='<i class="material-icons md-dark md-inactive">record_voice_over</i>
                 <i class="material-icons md-light" style="margin-right: -3px;">pregnant_woman</i>
                 <i class="material-icons md-dark md-inactive">child_friendly</i>';
                //$tpl->{"TIPOPARTOMODAL".strtoupper($i)}='Parto';

            }elseif ($resultado[$i]['tipoParto_paciente']=='pos'){
                $tpl->{"TIPOPARTO".strtoupper($i)}='<i class="material-icons md-dark md-inactive">record_voice_over</i>
                 <i class="material-icons md-dark md-inactive" style="margin-right: -3px;">pregnant_woman</i>
                 <i class="material-icons md-light">child_friendly</i>';
                //$tpl->{"TIPOPARTOMODAL".strtoupper($i)}='Pos parto';
            }else{
                $tpl->{"TIPOPARTO".strtoupper($i)}='<i class="material-icons md-dark md-inactive">record_voice_over</i>
                 <i class="material-icons md-dark md-inactive" style="margin-right: -3px;">pregnant_woman</i>
                 <i class="material-icons md-dark md-inactive">child_friendly</i>';
            }
            if($resultado[$i]['risco_paciente']=="Habitual"){
               $tpl->{"RISCO".strtoupper($i)}='<i class="material-icons md-light">arrow_downward</i>';
            }elseif($resultado[$i]['risco_paciente']=="Alto Risco"){
                $tpl->{"RISCO".strtoupper($i)}='<i class="material-icons md-light" >arrow_upward</i>';
            }
            if($resultado[$i]['tipoTP_paciente']=="Espontâneo"){
                $tpl->{"TP".strtoupper($i)}='<i class="material-icons md-light" style="margin-left: -10px;">toll</i>
                <i class="material-icons md-dark md-inactive">slow_motion_video</i>
                <i class="material-icons md-dark md-inactive">radio_button_unchecked</i>';

            }elseif ($resultado[$i]['tipoTP_paciente']=="Induzido"){
                $tpl->{"TP".strtoupper($i)}='<i class="material-icons md-dark md-inactive" style="margin-left: -10px;">toll</i>
                <i class="material-icons md-light">slow_motion_video</i>
                <i class="material-icons md-dark md-inactive">radio_button_unchecked</i>';

            }elseif ($resultado[$i]['tipoTP_paciente']=="Sem TP"){
                $tpl->{"TP".strtoupper($i)}='<i class="material-icons md-dark md-inactive" style="margin-left: -10px;">toll</i>
                <i class="material-icons md-dark md-inactive">slow_motion_video</i>
                <i class="material-icons md-light">radio_button_unchecked</i>';

            }else{
                $tpl->{"TP".strtoupper($i)}='<i class="material-icons md-dark md-inactive" style="margin-left: -10px;">toll</i>
                <i class="material-icons md-dark md-inactive">slow_motion_video</i>
                <i class="material-icons md-dark md-inactive">radio_button_unchecked</i>';
            }
            if($resultado[$i]['evento_paciente']!="                            "){
                if(isset($resultado[$i]['numero_paciente'])) {
                    $tpl->{"NOTIFICACAO" . strtoupper($i)} = '<i class="material-icons md-light">add_alert</i>';
                }
            }else{

                    $tpl->{"NOTIFICACAO" . strtoupper($i)} = '<i class="material-icons md-light">notifications_none</i>';

            }

            switch ($resultado[$i]['class_rob']){
                case 1:
                    $tpl->{"CLASSROB".strtoupper($i)}='<span class="badge badge-pill bg-success">1</span>';
                    break;
                case 2:
                    $tpl->{"CLASSROB".strtoupper($i)}='<span class="badge badge-pill bg-success">2</span>';
                    break;
                case 3:
                    $tpl->{"CLASSROB".strtoupper($i)}='<span class="badge badge-pill bg-success">3</span>';
                    break;
                case 4:
                    $tpl->{"CLASSROB".strtoupper($i)}='<span class="badge badge-pill bg-success">4</span>';
                    break;
                case 5:
                    $tpl->{"CLASSROB".strtoupper($i)}='<span class="badge badge-pill bg-warning">5</span>';
                    break;
                case 6:
                    $tpl->{"CLASSROB".strtoupper($i)}='<span class="badge badge-pill bg-warning">6</span>';
                    break;
                case 7:
                    $tpl->{"CLASSROB".strtoupper($i)}='<span class="badge badge-pill bg-warning">7</span>';
                    break;
                case 8:
                    $tpl->{"CLASSROB".strtoupper($i)}='<span class="badge badge-pill bg-danger">8</span>';
                    break;
                case 9:
                    $tpl->{"CLASSROB".strtoupper($i)}='<span class="badge badge-pill bg-danger">9</span>';
                break;
                case 10:
                    $tpl->{"CLASSROB".strtoupper($i)}='<span class="badge badge-pill bg-danger">10</span>';
                    break;

            }
            if($resultado[$i]['transfusao_paciente']=="Sim"){
                if(isset($resultado[$i]['numero_paciente'])) {
                    $tpl->{"TR".strtoupper($i)}='<i class="material-icons md-light">favorite</i>';
                }
            }else{

                if(isset($resultado[$i]['numero_paciente'])) {
                    try{
                        $tpl->{"TR".strtoupper($i)} = '<i class="material-icons md-light">favorite_border</i>';
                    }catch (Exception $a){
                        echo $a;
                    }
                }
            }

            /*if($resultado[$i]['transfusao_paciente']=="Sim"){

                $tpl->{"TR".strtoupper($i)}='<i class="material-icons md-light">favorite</i>';
            }else{
                $tpl->{"TR".strtoupper($i)}='<i class="material-icons md-light">favorite_border</i>';
            }*/


        }
        //$tpl->nome_paciente=$resultado[0]['nome_paciente'];
        //<i class="material-icons pregnant600">arrow_upward</i>


        $tpl->show();

    }





?>
