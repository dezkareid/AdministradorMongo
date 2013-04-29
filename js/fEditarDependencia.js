$(document).on('ready',asignaFuncion);

function asignaFuncion () {
	$('#listaDependencias').on('change',buscaDependencia);
    $('#dependencia-actualizar').on('click',actualizarDependencia);
}


function actualizarDependencia () {
    var id= $('#listaDependencias').val();
    var nombre= $('#nombre').val();
    var unidad= $('#unidad').val();
    var colonia= $('#colonia').val();
    var calle= $('#calle').val();
    var numero= $('#numero').val();
    var cp= $('#cp').val();
    var telefono= $('#telefono').val();
    var pagina= $('#pagina').val();
    var latitud= $('#lat').val();
    var longitud= $('#long').val();
    $.ajax({
            data:{id: id,nombre: nombre, unidad:unidad, colonia: colonia, calle: calle, numero:numero, cp: cp, telefono:telefono, pagina: pagina, latitud: latitud, longitud: longitud},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/dependencias/actualizarDependencia',
            success: function(json){
                console.log(json);
            }
        });
}


function asignarDatosDependencia (json) {
    $('#nombre').val(json[0].NOMBRE);
    $('#unidad').val(json[0].UNIDAD);
    $('#colonia').val(json[0].COLONIA);
    $('#calle').val(json[0].CALLE);
    $('#numero').val(json[0].NUMERO);
    $('#cp').val(json[0].COD_POSTAL);
    $('#telefono').val(json[0].TELEFONO);
    $('#pagina').val(json[0].WWW);
    $('#lat').val(json[0].LATITUD);
    $('#long').val(json[0].LONGITUD);    
    if(json[0].LATITUD==""|json[0].LONGITUD=="")
      return;
    var posicion= new google.maps.LatLng(parseFloat(json[0].LATITUD),parseFloat(json[0].LONGITUD));
    agregarMarcador(posicion);
    map.setCenter(posicion);
}

function buscaDependencia (e) {
    var id= $('#listaDependencias').val();
        if (id=="")
            return;
    $.ajax({
            async: false,
            data:{id: id},
            async: false,
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/dependencias/consultarDependencia',
            success: function(json){
                asignarDatosDependencia(json);


            }
        });
}

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
