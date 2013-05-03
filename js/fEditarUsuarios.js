$(document).on('ready',asignaFuncion);

function asignaFuncion () {
	$('#usuarios').on('change',buscaUsuario);
    $('#actualizar').on('click',actualizar);
    
}



function actualizar () {
    var id= $('#usuarios').val();
    var nombre= $('#nombre').val();
    var correo= $('#correo').val();
    var usuario= $('#usuario').val();
    var password= $('#password').val();
    var acceso= $('#acceso').val();

    $.ajax({
            async: false,
            data:{id: id, nombre: nombre, correo: correo, usuario: usuario, password: password, acceso: acceso},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/usuarios/actualizarUsuario',
            success: function(json){
                escribe(json);
            }
        });
}

function asignarDatos(json) {
    $('#nombre').val(json[0].Nombre);
    $('#correo').val(json[0].Correo);
    $('#usuario').val(json[0].Usuario);
    $('#acceso option[value='+json[0].Acceso+']').attr('selected',true);
}

function buscaUsuario (e) {
    var id= $('#usuarios').val();
        if (id=="")
            return;
    $.ajax({
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/usuarios/consultarUsuario',
            success: function(json){
                asignarDatos(json);


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
            $('#msg').text('Usuario actualizado con éxito'); 
            limpiar();
            break;
        case 2:
            $('#msg').text('Datos no validos');
            break;
        case 3:
            $('#msg').text('Ya existe un usuario con ese nombre de usuario');
            break;
    }

}

function limpiar () {
    $('input').val("");
    $("#usuarios").val("");
    }
