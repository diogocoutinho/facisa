<?php
session_start();
if(isset($_SESSION['teste'])){
echo $_session['teste'];
unset($_SESSION['teste']);
}
?>
<!DOCTYPE html>
<html>

<head>
    <script LANGUAGE="JavaScript">
        <!--
        function textCounter(field, countfield, maxlimit) {
            if (field.value.length > maxlimit)
                field.value = field.value.substring(0, maxlimit);
            else
                countfield.value = maxlimit - field.value.length;
        }
        // -->
    </script>
<meta charset="UTF-8">
    <title>Cadastro paciente</title>
</head>

<body>
<form onchange="this.form.submit();" name="dadosPaciente" action="../formsDB/cadastropaciente.php" method="POST">
    <br>Numero do Paciente :<br>
    <input type="number" name="numero_paciente" value="" />
    <br>Nome do paciente:<br>
    <input type="text" name="nome_paciente" value="" />
    <br>Data de Internação :<br>
    <input type="date" name="dtInter_paciente" value="" />
    <br>Data do Parto: <br>
    <input type="date" name="dtParto_paciente" value="" />
    <br>Tipo Internação : (Anteparto, Parto, Pós-parto)<br>
    <select name="TipoInter">
        <option value=""></option>
        <option value="Anteparto">Anteparto</option>
        <option value="Parto">Parto</option>
        <option value="pos">Pós-Parto</option>
    </select>
    <br>Admissão obstétrica (TP espontâneo, TP induzido, Sem TP)<br>
   <select name="adimis">
        <option value=""></option>
        <option value="Espontâneo">Espontâneo</option>
        <option value="Induzido">Induzido</option>
        <option value="Sem TP">Sem Tp</option>
    </select>

    <br>Risco Gestacional (risco habitual e alto risco)<br>
    <select name="risco">
        <option value=""></option>
        <option value="Habitual">Habitual</option>
        <option value="Alto Risco">Alto Risco</option>

    </select>
    <br>Transfusão (sim ou não)<br>
    <label for="sim">Sim</label>
    <input type="radio" name="tranfu" id="sim" value="Sim" />
    <label for="não">Não</label>
    <input type="radio" name="tranfu" id="não" value="Não" />
    <br>Evento adverso (se teve ou não -  detalhar)<br>
    <font size="1" face="arial, helvetica, sans-serif"> ( Limite de 1000 caracteres. )<br>
    <textarea wrap="physical" name="message"  rows="5" cols="30" onKeyDown="textCounter(this.form.message,this.form.remLen,1000);"
              onKeyUp="textCounter(this.form.message,this.form.remLen,1000);"></textarea><br>
        faltam&nbsp;<input readonly type=text name=remLen size=1 maxlength=1 value="1000"><br></font>
    <input type="submit" value="Enviar" name="Enviar" /><br>




</form>

</body>
</html>

