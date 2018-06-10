var $spnMostrarSenha = $('#spnMostrarSenha');
var $txtSenha = $('#txtSenha');

$spnMostrarSenha
    .on('mousedown mouseup', function() {
        var inputType = $txtSenha.attr('type') == 'password' ? 'text' : 'password';
        $txtSenha.attr('type', inputType);
    })
    .on('mouseout', function() {
        $txtSenha.attr('type', 'password');
    });