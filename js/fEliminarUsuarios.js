$(document).on('ready',asignaFuncion);

function asignaFuncion () {
    $('#eliminar').on('click', eliminar);
    }



function eliminar () {
    var id= $('#listaUsuarios').val();
    if (id=="")
            return;
    $.ajax({
            async: false,
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/usuarios/eliminarUsuario',
            success: function(json){
                escribe(json);
            }
        });
}


function escribe(json){
	if(json.Men==1)
    {
       $('#msg').text('Usuario eliminado con éxito'); 
       limpiar();
    }
    else
    {
        $('#msg').text('Hubo un problema al realizar la operación');
    }
}

function limpiar () {
    $("#listaUsuarios :selected").remove();
    $('#listaUsuarios').val("");
}
