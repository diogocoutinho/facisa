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
    $corpo='';
    $i=0;


    foreach ($resultado as $p) {




        if ($resultado[$i]['tipoParto_paciente'] == 'Anteparto') {
            $tipo = '<i class="material-icons md-light" style="margin-right: -3px;">record_voice_over</i>
                <i class="material-icons md-dark md-inactive">pregnant_woman</i>
                <i class="material-icons md-dark md-inactive">child_friendly</i>';


        } elseif ($resultado[$i]['tipoParto_paciente'] == 'Parto') {
            $tipo = '<i class="material-icons md-dark md-inactive">record_voice_over</i>
                 <i class="material-icons md-light" style="margin-right: -3px;">pregnant_woman</i>
                 <i class="material-icons md-dark md-inactive">child_friendly</i>';


        } elseif ($resultado[$i]['tipoParto_paciente'] == 'pos') {
            $tipo = '<i class="material-icons md-dark md-inactive">record_voice_over</i>
                 <i class="material-icons md-dark md-inactive" style="margin-right: -3px;">pregnant_woman</i>
                 <i class="material-icons md-light">child_friendly</i>';

        } else {
            $tipo = '<i class="material-icons md-dark md-inactive">record_voice_over</i>
                 <i class="material-icons md-dark md-inactive" style="margin-right: -3px;">pregnant_woman</i>
                 <i class="material-icons md-dark md-inactive">child_friendly</i>';
        }
        if ($resultado[$i]['risco_paciente'] == "Habitual") {
            $risco = '<i class="material-icons md-light">arrow_downward</i>';
        } elseif ($e['risco_paciente'] == "Alto Risco") {
            $risco = '<i class="material-icons md-light" >arrow_upward</i>';
        }
        if ($resultado[$i]['tipoTP_paciente'] == "Espontâneo") {
            $tp = '<i class="material-icons md-light" style="margin-left: -10px;">toll</i>
                <i class="material-icons md-dark md-inactive">slow_motion_video</i>
                <i class="material-icons md-dark md-inactive">radio_button_unchecked</i>';

        } elseif ($resultado[$i]['tipoTP_paciente'] == "Induzido") {
            $tp = '<i class="material-icons md-dark md-inactive" style="margin-left: -10px;">toll</i>
                <i class="material-icons md-light">slow_motion_video</i>
                <i class="material-icons md-dark md-inactive">radio_button_unchecked</i>';

        } elseif ($resultado[$i]['tipoTP_paciente'] == "Sem TP") {
            $tp = '<i class="material-icons md-dark md-inactive" style="margin-left: -10px;">toll</i>
                <i class="material-icons md-dark md-inactive">slow_motion_video</i>
                <i class="material-icons md-light">radio_button_unchecked</i>';

        } else {
            $tp = '<i class="material-icons md-dark md-inactive" style="margin-left: -10px;">toll</i>
                <i class="material-icons md-dark md-inactive">slow_motion_video</i>
                <i class="material-icons md-dark md-inactive">radio_button_unchecked</i>';
        }
        if ($resultado[$i]['evento_paciente'] != "                            ") {
            if (isset($resultado[$i]['numero_paciente'])) {
                $evento = '<i class="material-icons md-light">add_alert</i>';
            }
        } else {

            $evento = '<i class="material-icons md-light">notifications_none</i>';

        }

        switch ($resultado[$i]['class_rob']) {
            case 1:
                $rob = '<span class="badge badge-pill bg-success">1</span>';
                break;
            case 2:
                $rob = '<span class="badge badge-pill bg-success">2</span>';
                break;
            case 3:
                $rob = '<span class="badge badge-pill bg-success">3</span>';
                break;
            case 4:
                $rob = '<span class="badge badge-pill bg-success">4</span>';
                break;
            case 5:
                $rob = '<span class="badge badge-pill bg-warning">5</span>';
                break;
            case 6:
                $rob = '<span class="badge badge-pill bg-warning">6</span>';
                break;
            case 7:
                $rob = '<span class="badge badge-pill bg-warning">7</span>';
                break;
            case 8:
                $rob = '<span class="badge badge-pill bg-danger">8</span>';
                break;
            case 9:
                $rob = '<span class="badge badge-pill bg-danger">9</span>';
                break;
            case 10:
                $rob = '<span class="badge badge-pill bg-danger">10</span>';
                break;

        }
        if ($resultado[$i]['transfusao_paciente'] == "Sim") {
            if (isset($e['numero_paciente'])) {
                $tranfusao = '<i class="material-icons md-light">favorite</i>';
            }
        } else {

            if (isset($resultado[$i]['numero_paciente'])) {
                try {
                    $tranfusao = '<i class="material-icons md-light">favorite_border</i>';
                } catch (Exception $a) {
                    echo $a;
                }
            }
        }

        $corpo = $corpo.'
        
        
        
        
        <div class="col-sm-3 mt-1 mb-1" data-tag="grave">
                            <a style="text-decoration: none;" data-target="#modalView" data-toggle="modal"
                               href="#modalView">
                            <div class="card text-white bg-light border-danger" style="border-radius: 10px;">
                                <div class="card-header bg-danger text-dark header" id="cabeca">
                                    <i class="material-icons md-18">person </i>
                                    ' . $resultado[$i]['nome_paciente'] .' '. $resultado[$i]['numero_paciente'] . '
                                </div>
                                <div class="card-body text-dark" style="margin-right: -25px;">
                                    <div class="container-fluid">
                                        <div class="row mb-0">
                                            <div class="col-xl-12 mb-0" id="icons0" style="margin-top: -78px;
                                            margin-left: -10px; margin-right: -40px;">
                                                <i class="material-icons" style="margin-left: -10px;">event
                                                </i>
                                                ' . $resultado[$i]['dtInter_paciente'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <span class="text-uppercase font-weight-bold"
                                                      style="margin-left: -15px;">ig</span> ' . $resultado[$i]['dtParto_paciente'] . ' sem
                                                <br>
                                                <div class="border col-sm-7"
                                                     style="margin-left: -15px;margin-right: -80px;width: 112px;">
                                                <span class="text-uppercase font-weight-bold float-left"
                                                      style="margin-left: -15px;">
                                                    ti ' . $tipo . '</span> </div>
                                                <div class="col-sm-8 float-right" style="margin-right: -25px;">
                                                    <span class="text-uppercase font-weight-bold">rg' . $risco . '</span>
                                                    <span class="text-uppercase font-weight-bold">cr'.$rob.'</span>
                                                </div><br><br>
                                                <div class="border col-sm-7 float-left"
                                                     style="margin-left: -15px;width: 112px;">
                                                <span class="text-uppercase font-weight-bold float-left"
                                                      style="margin-left: -15px;margin-right: -10px;">
                                                    tp &nbsp;&nbsp;&nbsp;'.$tp.'</span>
                                                </div>
                                                <div class="col-sm-8 float-right" style="margin-right: -50px;">
                                                    <span class=" text-uppercase font-weight-bold float-left"
                                                          style="margin-left: -30px;">
                                                        tr '.$tranfusao.'</span>
                                                    <span class="font-weight-bold">
                                                    Ad'.$evento.'</span>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
        
        
        <!-- Inicio Modal view/update paciente -->
<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content mb-0">
            <div class="modal-header">
                <h3 class="modal-title" id="modalViewTitle">Visualisar paciente </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mb-0">
              <form id="dadosPaciente" onchange="this.form.submit();" name="dadosPaciente" method="post">
                    <fieldset id="camada" disabled>
                        Numero do Paciente :<br>
                        <input class="form-control" type="number" name="numero_paciente" value="'.$resultado[$i]['numero_paciente'].'" readonly/>
                        <br>Nome do paciente:<br>
                        <input class="form-control" type="text" name="nome_paciente" value="'.$resultado[$i]['nome_paciente'].'" readonly/>
                        <br>Data de Internação :<br>
                        <input class="form-control" type="date" name="dtInter_paciente" value="'.$resultado[$i]['dtInter_paciente'].'" readonly/>
                        <br>Tempo de gravidez: <br>
                        <input class="form-control" type="number" name="dtParto_paciente"
                              placeholder="'.$resultado[$i]['dtParto_paciente'].' semanas"/>
                        <br>Classificação de Robson: <br>
                        <select class="custom-select mr-sm-1" name="clasRob">
                            <option value="">'.$rob.'</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select><br>
                        <br>Tipo Internação : (Anteparto, Parto, Pós-parto)<br>
                        <select class="custom-select mr-sm-1" name="TipoInter">
                            <option value="">{TIPOPARTOMODAL0}</option>
                            <option value="Anteparto">Anteparto</option>
                            <option value="Parto">Parto</option>
                            <option value="pos">Pós-Parto</option>
                        </select>
                        <br><br>Admissão obstétrica (TP espontâneo, TP induzido, Sem TP)<br>
                        <select class="custom-select mr-sm-1" name="adimis">
                            <option value="{TP0}"></option>
                            <option value="Espontâneo">Espontâneo</option>
                            <option value="Induzido">Induzido</option>
                            <option value="Sem TP">Sem Tp</option>
                        </select>
                        <br><br>Risco Gestacional (risco habitual e alto risco)<br>
                        <select class="custom-select mr-sm-1" name="risco">
                            <option value=""></option>
                            <option value="Habitual">Habitual</option>
                            <option value="Alto Risco">Alto Risco</option>
                        </select>
                        <br><br>Transfusão (sim ou não)<br>
                        <label for="sim">Sim</label>
                        <input type="radio" name="tranfu" id="sim" value="Sim" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="não">Não</label>
                        <input type="radio" name="tranfu" id="não" value="Não" />
                        <br><br>Evento adverso (se teve ou não - detalhar)<br>
                        <font size="1" face="arial, helvetica, sans-serif"> ( Limite de 1000 caracteres. )<br>
                            <textarea class="form-control" wrap="physical" name="message" rows="5" cols="30"
                                      onKeyDown="textCounter(this.form.message,this.form.remLen,1000);"
                                      onKeyUp="textCounter(this.form.message,this.form.remLen,1000);"></textarea>
                            faltam&nbsp;<input readonly type=text name=remLen size=1 maxlength=1 value="1000"
                                               style="border: none;width: 30px;"><br></font><br>
                    </fieldset>
                        <div class="modal-footer mb-0">
                          <button type="button" value="alta" id="alta" class="float-left btn btn-success">Alta
                          </button>
                            <button onclick="disableField()" type="button" class="btn btn-secondary"
                                    data-dismiss="modal">Fechar
                            </button>
                            <button onclick="undisableFieldset();" value="up" type="button" class="btn btn-primary"
                                    id="alterar">Alterar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal view/update paciente -->
        
        
        
        
        
        ';









        /*if($resultado[$i]['transfusao_paciente']=="Sim"){

            $tpl->{"TR".strtoupper($i)}='<i class="material-icons md-light">favorite</i>';
        }else{
            $tpl->{"TR".strtoupper($i)}='<i class="material-icons md-light">favorite_border</i>';
        }*/

        $i++;
    }
    //$tpl->nome_paciente=$resultado[0]['nome_paciente'];
    //<i class="material-icons pregnant600">arrow_upward</i>

    $tpl->CORPO=$corpo;
    $tpl->show();

}





?>
