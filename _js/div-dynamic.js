$(document).ready(function(){
    var divPai = $('#');
    var btnCriar = $('#');

    btnCriar.click(function(){
        divPai.append("<div class="col-sm-3 mt-1 mb-1" data-tag="brand">
        <a style="text-decoration: none;" data-target="#modalView" data-toggle="modal"
        href="#modalView">
            <div class="card text-white bg-danger" style="border-radius: 10px;">
            <div class="card-header name">
            <i class="material-icons md-18">person </i>
        {nome_paciente0} ({id_paciente0})
        <div class="float-right">
            <i class="mdc-icon-toggle md-18 material-icons">
            warning
            </i>
            </div>
            </div>
            <div class="card-body mt-0" style="background-color: rgba(255,255,255,.9); color: black;">
            <div class="container-fluid">
            <div class="row mb-0">
            <div class="col-xl-12 mb-0" id="icons0" style="margin-top: -69px;
        margin-left: -10px; margin-right: -10px;">
        <i class="material-icons" style="margin-left: -10px;">event</i> {data_internacao0}&nbsp;&nbsp;
            <i class="material-icons float-right">adjust </i> {tempo_gravidez0}<br>

        {TIPOPARTO0}
    &nbsp;&nbsp;
    <i class="material-icons pregnant600">arrow_upward</i>
            &nbsp;&nbsp;
    <i class="material-icons md-dark">grain</i>
            <span class="badge badge-pill badge-success float-right">4</span>

            &nbsp;&nbsp;&nbsp;
    <i class="material-icons md-dark" style="margin-left: -10px;">toll</i>
            <i class="material-icons pregnant600">slow_motion_video</i>
            <i class="material-icons md-dark">radio_button_unchecked</i>
            &nbsp;&nbsp;&nbsp;
    <i class="material-icons md-dark">favorite_border</i>
            &nbsp;&nbsp;
    <i class="material-icons pregnant600">notifications_none</i>
            </div>
            </div>
            </div>
            </div>
            </div>
            </a>
            </div>"

    });

});

