$(document).on('ready',asignaFuncion);

function asignaFuncion () {
	$('#agregar').on('click',guarda);
}

function guarda(){
    var nombre= $('#nombre').val();
    var correo= $('#correo').val();
	var usuario= $('#usuario').val();
	var password= $('#password').val();
    var acceso= $('#acceso').val();

	$.ajax({
            async: false,
            data:{nombre: nombre, correo: correo, usuario: usuario,password:password,acceso: acceso},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/usuarios/guardaUsuario',
            success: function(json){
                escribe(json);
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
            $('#msg').text('Usuario agregado con éxito'); 
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
}
