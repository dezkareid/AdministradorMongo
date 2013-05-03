$(document).on('ready',asignaFuncion);

function asignaFuncion () {
    $('#autobus-agregar').on('click', agregarAutobus);
}

function agregarAutobus () {
    var linea= $('#linea').val();
    var descripcion= $('#descripcion').val();
    var trayecto= $('#trayecto').val();
    var primeraSalida= $('#primeraSalida').val();
    var ultimaSalida= $('#ultimaSalida').val();
    var tiempoEspera= $('#espera').val();
    $.ajax({
            async: false,
            data:{linea: linea, descripcion:descripcion, trayecto: trayecto, primeraSalida: primeraSalida, ultimaSalida:ultimaSalida, tiempoEspera:tiempoEspera},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/autobuses/agregarAutobus',
            success: function(json){
                escribe(json);
            }
        });
}


function escribe(json){
    switch(json.Men)
    {
        case 0: 
            $('#msg').text('Hubo un problema al realizar la operación');
            break;
        case 1:
            $('#msg').text('Autobus agregado con éxito'); 
            limpiar();
            break;
        case 2:
            $('#msg').text('Datos no validos');
            break;

    }
}

function limpiar () {
    $('input').val("");
    $('textarea').val("");
}
