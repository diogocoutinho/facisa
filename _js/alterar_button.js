$(document).on('click', '#alterar', function() {
    $(this).attr("id","salvar").html("Salvar");
    $(this).attr("onclick","myFunction()").html("Salvar");
});
$(document).on('click', '#salvar', function() {
    $(this).attr("id","alterar").html("Alterar");
    $(this).attr("type","submit").html("Salvar");
    $(this).attr("value","enviar").html("Salvar");

});

$(document).on('click','#alta',function () {
  document.getElementById("camada").disabled = false;
  document.dadosPaciente.action = "formsDB/Delete.php";
  document.dadosPaciente.submit();

});
$(document).on('click','#salvar',function () {
  document.dadosPaciente.action = "formsDB/Update.php";
  document.dadosPaciente.submit();
});


function disableField() {
    document.getElementById("camada").disabled = true;
}

function undisableFieldset() {
    document.getElementById("camada").disabled = false;
}

function HabCampos() {
    if (document.getElementById('medico').checked) {
        document.getElementById('form_medico').style.display = "";
        document.getElementById('form_enfermeiro').style.display = "none";
        document.getElementById('text').focus();

    }  if (document.getElementById('enfermeiro').checked){
        document.getElementById('form_medico').style.display = "none";
        document.getElementById('form_enfermeiro').style.display = "";
        document.getElementById('text').focus();
    }}

function desabilita_a(){

    document.getElementById('form_enfermeiro').style.display = "none";
    document.getElementById('form_medico').style.display = "none";
}
