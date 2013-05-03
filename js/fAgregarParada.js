$(document).on('ready',asignaFuncion);

function asignaFuncion () {
	$('#parada-agregar').on('click', agregarParada);
    $('#AutobusesP').on('change',getParadas);
}

function agregarParada () {
    var id= $('#AutobusesP').val();
    var indice= $('#indice').val();
    var tiempo= $('#tiempo').val();
    var latitud= $('#latitud').val();
    var longitud= $('#longitud').val();
    $.ajax({
            async: false,
            data:{id: id, indice:indice, tiempo: tiempo, latitud: latitud, longitud:longitud},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/paradas/agregarParada',
            success: function(json){
                escribe(json);
            }
        });
}

function getParadas (e) {
    eliminarMarcadores();
    $('input').val("");
    var id= $('#AutobusesP').val();
        if (id=="")
            return;
    $.ajax({
            async: false,
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/paradas/getParadas',
            success: function(json){
                $('#indice').val(parseInt( json.length)+1);
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
            $('#msg').text('Parada agregado con éxito'); 
            marker.setIcon(null);
            marcadores.push(marker);
            marker=null;
            var numero=parseInt($('#indice').val())+1;
            $('#indice').val(numero);
            break;
        case 2:
            $('#msg').text('Datos no validos');
            break;

    }

}

