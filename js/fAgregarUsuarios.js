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
	if(json.Men==1)
    {
       $('#msg').text('Usuario agregado con éxito'); 
       limpiar();
    }
    else
    {
        if(json.Men==0)
            $('#msg').text('Hubo un problema al realizar la operación');
        else
            $('#msg').text('Datos no validos');
    }
}

function limpiar () {
    $('input').val("");
}
