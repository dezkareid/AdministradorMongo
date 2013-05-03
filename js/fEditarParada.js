var paradasEditar;
var ultimoMarker=null;
$(document).on('ready',asignaFuncion);

function asignaFuncion () {
	$('#AutobusesPEditar').on('change',getParadas);
    $('#indicep').on('change',buscaParada);
    $('#parada-actualizar').on('click', actualizarParada);
}


function actualizarParada() {
    var id= $('#AutobusesPEditar').val();
    var indice= $('#indicep').val();
    var tiempo= $('#tiempo').val();
    var latitud= $('#latitud').val();
    var longitud= $('#longitud').val();
    $.ajax({
            data:{id: id, indice:indice, tiempo: tiempo, latitud: latitud, longitud:longitud},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/paradas/actualizarParada',
            success: function(json){
                paradasEditar[ultimoMarker].Tiempo=tiempo;
                paradasEditar[ultimoMarker].Latitud=latitud;
                paradasEditar[ultimoMarker].Longitud=longitud;
                if(marker){
                    marker.setIcon(null);
                    marcadores[ultimoMarker].setMap(null);
                    marcadores[ultimoMarker]=marker;
                }
                marker=null;
                escribe(json);
            }
        });
}

function asignarDatosParada (indice) {
    marcadores[indice].setIcon(imagen);
    $('#tiempo').val(paradasEditar[indice].Tiempo);
    $('#latitud').val(paradasEditar[indice].Latitud); 
    $('#longitud').val(paradasEditar[indice].Longitud);
}

function buscaParada (e) {
    var id= $('#AutobusesPEditar').val();
    var indice= $('#indicep').val();
        if (id==""||indice==""){
            console.log("Nada");
            return;
        }
    if(ultimoMarker!=null)
        marcadores[ultimoMarker].setIcon(null);
    ultimoMarker=indice-1;
    asignarDatosParada(ultimoMarker);

}

function getParadas (e) {
    eliminarMarcadores();
    $('input').val("");
    $('#indicep').empty();
    var id= $('#AutobusesPEditar').val();
        if (id=="")
            return;
    $.ajax({
            async: false,
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/paradas/getParadas',
            success: function(json){
                paradasEditar=json;
                $("<option value='"+"'>Selecciona un indice</option>").appendTo("#indicep");
                
                for(var i=0;i<json.length;i++){
                    $("<option value='"+(i+1)+"'>"+(i+1)+"</option>").appendTo("#indicep");
                    }


                cargarMarcadores(json);

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
            $('#msg').text('Parada actualizada con éxito'); 
            limpiar();
            break;
        case 2:
            $('#msg').text('Datos no validos');
            break;

    }

}

function limpiar () {
    $('input').val("");
    $('#indicep').val("");

}
