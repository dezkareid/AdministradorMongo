$(document).on('ready',asignaFuncion);

function asignaFuncion () {
    $('#dependencia-eliminar').on('click',eliminarDependencia);
}


function eliminarDependencia () {
    var id= $('#Dependencias').val();
    if (id=="")
            return;

    $.ajax({
            async: false,
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/dependencias/eliminarDependencia',
            success: function(json){
                escribe(json);
            }
        });
}


function escribe(json){
	if(json.Men==1)
    {
       $('#msg').text('Dependencia eliminada con éxito'); 
       limpiar();
    }
    else
    {
        $('#msg').text('Hubo un problema al realizar la operación');
    }
}

function limpiar () {
    $("#Dependencias :selected").remove();
    $('#Dependencias').val("");
}
