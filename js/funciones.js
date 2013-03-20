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
    $('#autobus-agregar').on('click', agregarAutobus);
    $('#autobus-eliminar').on('click',eliminarAutobus);
    $('#listaAutobuses').on('change',buscaAutobus);
    $('#parada-agregar').on('click', agregarParada);
    $('#AutobusesPEditar').on('change',getNumerosParadas);
    $('#indicep').on('change',buscaParada);
    $('#parada-actualizar').on('click', actualizarParada);
    $('#AutobusesPEliminar').on('change',getNumerosParadasEliminar);
    $('#parada-eliminar').on('click', eliminarParada);
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
            url: 'http://localhost/AdministradorMongo/index.php/usuarios/actualizarUsuario',
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
            url: 'http://localhost/AdministradorMongo/index.php/dependencias/actualizarDependencia',
            success: function(json){
                console.log(json);
            }
        });
}

function actualizarParada() {
    var id= $('#AutobusesPEditar').val();
    var indice= $('#indicep').val();
    var tiempo= $('#tiempo').val();
    var latitud= $('#latitud').val();
    var longitud= $('#longitud').val();
    $.ajax({
            data:{id: id, indice:indice, tiempo: tiempo, latitud: latitud, longitud:longitud},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/paradas/actualizarParada',
            success: function(json){
                console.log(json);
            }
        });
}

function agregarAutobus () {
    var linea= $('#linea').val();
    var descripcion= $('#descripcion').val();
    var trayecto= $('#trayecto').val();
    var primeraSalida= $('#primeraSalida').val();
    var ultimaSalida= $('#ultimaSalida').val();
    var tiempoEspera= $('#espera').val();
    $.ajax({
            data:{linea: linea, descripcion:descripcion, trayecto: trayecto, primeraSalida: primeraSalida, ultimaSalida:ultimaSalida, tiempoEspera:tiempoEspera},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/autobuses/agregarAutobus',
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
            url: 'http://localhost/AdministradorMongo/index.php/dependencias/agregarDependencia',
            success: function(json){
                console.log(json);
            }
        });
}

function agregarParada () {
    var id= $('#AutobusesP').val();
    var indice= $('#indice').val();
    var tiempo= $('#tiempo').val();
    var latitud= $('#latitud').val();
    var longitud= $('#longitud').val();
    $.ajax({
            data:{id: id, indice:indice, tiempo: tiempo, latitud: latitud, longitud:longitud},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/paradas/agregarParada',
            success: function(json){
                console.log(json);
            }
        });
}

function asignarDatosAutobus (json) {
    $('#linea').val(json[0].Linea);
    $('#descripcion').val(json[0].Descripcion); 
    $('#trayecto').val(json[0].Trayecto);
    $('#primeraSalida').val("0"+json[0].PrimeraSalida);
    $('#ultimaSalida').val(json[0].UltimaSalida);
    $('#espera').val(json[0].TiempoEspera);
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

function asignarDatosParada (json) {
    $('#tiempo').val(json.Tiempo);
    $('#latitud').val(json.Latitud); 
    $('#longitud').val(json.Longitud);
}

function asignarDatos(json) {
    $('#nombre').val(json[0].Nombre);
    $('#correo').val(json[0].Correo);
    $('#usuario').val(json[0].Usuario);
    $('#acceso option[value='+json[0].Acceso+']').attr('selected',true);
}

function buscaAutobus (e) {
    var id= $('#listaAutobuses').val();
        if (id=="")
            return;
    $.ajax({
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/autobuses/consultarAutobus',
            success: function(json){
                asignarDatosAutobus(json);


            }
        });
}

function buscaDependencia (e) {
    var id= $('#listaDependencias').val();
        if (id=="")
            return;
    $.ajax({
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/dependencias/consultarDependencia',
            success: function(json){
                asignarDatosDependencia(json);


            }
        });
}

function buscaParada (e) {
    var id= $('#AutobusesPEditar').val();
    var indice= $('#indicep').val();
        if (id==""||indice==""){
            console.log("Nada");
            return;
        }
    $.ajax({
            data:{id: id, indice: indice},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/paradas/getParada',
            success: function(json){
                asignarDatosParada(json);


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
            url: 'http://localhost/AdministradorMongo/index.php/usuarios/consultarUsuario',
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
            url: 'http://localhost/AdministradorMongo/index.php/usuarios/eliminarUsuario',
            success: function(json){
                escribe(json);
            }
        });
}

function eliminarAutobus () {
    var id= $('#Autobuses').val();
    if (id=="")
            return;

    $.ajax({
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/autobuses/eliminarAutobus',
            success: function(json){
                //escribe(json);
                console.log(json);
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
            url: 'http://localhost/AdministradorMongo/index.php/dependencias/eliminarDependencia',
            success: function(json){
                escribe(json);
            }
        });
}

function eliminarParada() {
    var id= $('#AutobusesPEliminar').val();
    var indice= $('#indicePEliminar').val();
    console.log(indice);
    console.log(id);
    $.ajax({
            data:{id: id, indice:indice},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/paradas/eliminarParada',
            success: function(json){
                console.log(json);
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
            url: 'http://localhost/AdministradorMongo/index.php/usuarios/guardaUsuario',
            success: function(json){
                escribe(json);
            }
        });
}

function getNumerosParadas (e) {
    var id= $('#AutobusesPEditar').val();
        if (id=="")
            return;
    $.ajax({
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/paradas/getNumeroParadas',
            success: function(json){
                $('#indicep').empty();
                $("<option value='"+"'>Selecciona un indice</option>").appendTo("#indicep");
                
                for(var i=0;i<json;i++){
                    $("<option value='"+(i+1)+"'>"+(i+1)+"</option>").appendTo("#indicep");
                    }


            }
        });

}

function getNumerosParadasEliminar (e) {
    var id= $('#AutobusesPEliminar').val();
        if (id=="")
            return;
    $.ajax({
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/paradas/getNumeroParadas',
            success: function(json){
                $('#indicePEliminar').empty();
                $("<option value='"+"'>Selecciona un indice</option>").appendTo("#indicePEliminar");
                
                for(var i=0;i<json;i++){
                    $("<option value='"+(i+1)+"'>"+(i+1)+"</option>").appendTo("#indicePEliminar");
                    }


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
