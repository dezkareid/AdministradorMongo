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
	if(json.Men==1)
    {
        $('#msg').text('Parada agregado con éxito'); 
        marker.setIcon(null);
        marcadores.push(marker);
        marker=null;
        var numero=parseInt($('#indice').val())+1;
        $('#indice').val(numero);
       
    }
    else
    {
        $('#msg').text('Hubo un problema al realizar la operación');
    }
}

