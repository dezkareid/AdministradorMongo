$(document).on('ready',asignaFuncion);

function asignaFuncion () {
	$('#autobus-eliminar').on('click',eliminarAutobus);
}




function eliminarAutobus () {
    var id= $('#Autobuses').val();
    if (id=="")
            return;

    $.ajax({
            async: false,
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/autobuses/eliminarAutobus',
            success: function(json){
                escribe(json);
            }
        });
}

function escribe(json){
	if(json.Men==1)
    {
       $('#msg').text('Autobus eliminado con éxito'); 
       limpiar();
    }
    else
    {
        $('#msg').text('Hubo un problema al realizar la operación');
    }
}

function limpiar () {
    $("#Autobuses :selected").remove();
    $('#Autobuses').val("");
}
