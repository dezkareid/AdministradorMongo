$(document).on('ready',asignaFuncion);

function asignaFuncion () {
	$('#agregar').on('click',guarda);
    $('#usuarios').on('change',buscaUsuario);
    $('#listaDependencias').on('change',buscaDependencia);
    $('#actualizar').on('click',actualizar);
    $('#eliminar').on('click', eliminar);
    $('#dependencia-actualizar').on('click',actualizarDependencia);
    $('#dependencia-agregar').on('click', agregarDependencia);
    $('#dependencia-eliminar').on('click',eliminarDependencia);
}

function actualizar () {
    var id= $('#usuarios').val();
    var nombre= $('#nombre').val();
    var correo= $('#correo').val();
    var usuario= $('#usuario').val();
    var password= $('#password').val();
    var acceso= $('#acceso').val();

    $.ajax({
            data:{id: id, nombre: nombre, correo: correo, usuario: usuario, password: password, acceso: acceso},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/CI/index.php/usuarios/actualizarUsuario',
            success: function(json){
                escribe(json);
            }
        });
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
            url: 'http://localhost/CI/index.php/dependencias/actualizarDependencia',
            success: function(json){
                console.log(json);
            }
        });
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
            data:{nombre: nombre, unidad:unidad, colonia: colonia, calle: calle, numero:numero, cp: cp, telefono:telefono, pagina: pagina, latitud: latitud, longitud: longitud},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/CI/index.php/dependencias/agregarDependencia',
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
}

function asignarDatos(json) {
    $('#nombre').val(json[0].Nombre);
    $('#correo').val(json[0].Correo);
    $('#usuario').val(json[0].Usuario);
    $('#acceso option[value='+json[0].Acceso+']').attr('selected',true);
}

function buscaDependencia (e) {
    var id= $('#listaDependencias').val();
        if (id=="")
            return;
    $.ajax({
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/CI/index.php/dependencias/consultarDependencia',
            success: function(json){
                asignarDatosDependencia(json);


            }
        });
}


function buscaUsuario (e) {
    var id= $('#usuarios').val();
        if (id=="")
            return;
    $.ajax({
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/CI/index.php/usuarios/consultarUsuario',
            success: function(json){
                asignarDatos(json);


            }
        });
}

function eliminar () {
    var id= $('#listaUsuarios').val();
    if (id=="")
            return;

    $.ajax({
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/CI/index.php/usuarios/eliminarUsuario',
            success: function(json){
                escribe(json);
            }
        });
}

function eliminarDependencia () {
    var id= $('#Dependencias').val();
    if (id=="")
            return;

    $.ajax({
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/CI/index.php/dependencias/eliminarDependencia',
            success: function(json){
                escribe(json);
            }
        });
}

function guarda(){
    var nombre= $('#nombre').val();
    var correo= $('#correo').val();
	var usuario= $('#usuario').val();
	var password= $('#password').val();
    var acceso= $('#acceso').val();

	$.ajax({
            data:{nombre: nombre, correo: correo, usuario: usuario,password:password,acceso: acceso},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/CI/index.php/usuarios/guardaUsuario',
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
        $('#msg').text('Hubo un problema al realizar la operación');
    }
}

function limpiar () {
    $('input').val("");
}
