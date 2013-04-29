$(document).on('ready',asignaFuncion);

function asignaFuncion () {
	$('#dependencia-agregar').on('click', agregarDependencia);
    }




function agregarDependencia () {
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
            async: false,
            data:{nombre: nombre, unidad:unidad, colonia: colonia, calle: calle, numero:numero, cp: cp, telefono:telefono, pagina: pagina, latitud: latitud, longitud: longitud},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/dependencias/agregarDependencia',
            success: function(json){
                escribe(json);
            }
        });
}


function escribe(json){
	if(json.Men==1)
    {
       $('#msg').text('Dependencia agregada con éxito'); 
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
