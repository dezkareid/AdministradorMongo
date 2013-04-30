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
                escribe(json);
            }
        });
}

function asignarDatosParada (indice) {
    marcadores[indice].setIcon(imagen);
    $('#tiempo').val(paradas[indice].Tiempo);
    $('#latitud').val(paradas[indice].Latitud); 
    $('#longitud').val(paradas[indice].Longitud);
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
                paradas=json;
                $("<option value='"+"'>Selecciona un indice</option>").appendTo("#indicep");
                
                for(var i=0;i<json.length;i++){
                    $("<option value='"+(i+1)+"'>"+(i+1)+"</option>").appendTo("#indicep");
                    }


                cargarMarcadores(json);

            }
        });

}

/*
function getNumerosParadas (e) {
    var id= $('#AutobusesPEditar').val();
        if (id=="")
            return;
    $.ajax({
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/paradas/getNumeroParadas',
            success: function(json){
                $('#indicep').empty();
                $("<option value='"+"'>Selecciona un indice</option>").appendTo("#indicep");
                
                for(var i=0;i<json;i++){
                    $("<option value='"+(i+1)+"'>"+(i+1)+"</option>").appendTo("#indicep");
                    }


            }
        });

}*/


function escribe(json){
	if(json.Men==1)
    {
       $('#msg').text('Usuario agregado con éxito'); 
       limpiar();
    }
    else
    {
        $('#msg').text('Hubo un problema al realizar la operación');
    }
}

function limpiar () {
    $('input').val("");
}
