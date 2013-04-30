$(document).on('ready',asignaFuncion);

function asignaFuncion () {
	$('#autobus-actualizar').on('click', actualizarAutobus);
    $('#listaAutobuses').on('change',buscaAutobus);
}

function actualizarAutobus() {
    var id= $('#listaAutobuses').val();
    console.log(id);
    var linea= $('#linea').val();
    var descripcion= $('#descripcion').val();
    var trayecto= $('#trayecto').val();
    var primeraSalida= $('#primeraSalida').val();
    var ultimaSalida= $('#ultimaSalida').val();
    var tiempoEspera= $('#espera').val();
    $.ajax({
            async: false,
            data:{id: id,linea: linea, descripcion:descripcion, trayecto: trayecto, primeraSalida: primeraSalida, ultimaSalida:ultimaSalida, tiempoEspera:tiempoEspera},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/autobuses/actualizarAutobus',
            success: function(json){
                escribe(json);
            }
        });

}

function asignarDatosAutobus (json) {
    $('#linea').val(json[0].Linea);
    $('#descripcion').val(json[0].Descripcion); 
    $('#trayecto').val(json[0].Trayecto);
    $('#primeraSalida').val(json[0].PrimeraSalida);
    $('#ultimaSalida').val(json[0].UltimaSalida);
    $('#espera').val(json[0].TiempoEspera);
}


function buscaAutobus (e) {
    var id= $('#listaAutobuses').val();
        if (id=="")
            return;
    $.ajax({
            async: false,
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/autobuses/consultarAutobus',
            success: function(json){
                asignarDatosAutobus(json);


            }
        });
}

function escribe(json){
	if(json.Men==1)
    {
       $('#msg').text('Autobus actualizado con éxito'); 
    }
    else
    {
        $('#msg').text('Hubo un problema al realizar la operación');
    }
}

