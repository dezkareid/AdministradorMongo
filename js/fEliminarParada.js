var map;
var ultimoMarker=null;
var paradas;
var marcadores= [];
var imagen = 'http://localhost/img/UV.png';
$(document).on('ready',asignaFuncion);

function asignaFuncion () {
	$('#indicePEliminar').on('change',marcarParada);
    $('#AutobusesPEliminar').on('change',getParadas);
    $('#parada-eliminar').on('click', eliminarParada);
    cargar();
}


function agregarMarcadores(posicion,numero)
{
 
  var marcador= new google.maps.Marker({
        position: posicion, 
        map: map,
        title: "Parada "+(parseInt(numero)+1)
      });
  marcadores.push(marcador);
    
}



function cargar() 
{
    var myOptions = 
    {
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.DEFAULT
            },
        zoom: 13,
        center: new google.maps.LatLng(19.540649,-96.926408),
        mapTypeId: google.maps.MapTypeId.HYBRID
    };
    map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions);
}

function cargarMarcadores(json)
{
    var posicion;
    for(feat in json){
      posicion= new google.maps.LatLng(parseFloat(json[feat].Latitud),parseFloat(json[feat].Longitud)), 
      agregarMarcadores(posicion,feat);
    }
    
}

function eliminarMarcadores()
{
  if (marcadores) {
    for (i in marcadores) {
      marcadores[i].setMap(null);
    }
    marcadores.length = 0;
  }

}

function eliminarParada() {
    var id= $('#AutobusesPEliminar').val();
    var indice= $('#indicePEliminar').val();
    $.ajax({
            data:{id: id, indice:indice},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/paradas/eliminarParada',
            success: function(json){
                escribe(json);
            }
        });
}

function getParadas (e) {
    eliminarMarcadores();
    $('#indicePEliminar').empty();
    var id= $('#AutobusesPEliminar').val();
        if (id=="")
            return;
    $.ajax({
            async: false,
            data:{id: id},
            dataType: 'json',
            type: 'post',
            url: 'http://localhost/AdministradorMongo/index.php/paradas/getParadas',
            success: function(json){
                paradas=json;
                $("<option value='"+"'>Selecciona un indice</option>").appendTo("#indicePEliminar");
                
                for(var i=0;i<json.length;i++){
                    $("<option value='"+(i+1)+"'>"+(i+1)+"</option>").appendTo("#indicePEliminar");
                    }


                cargarMarcadores(json);

            }
        });

}

function escribe(json){
	if(json.Men==1)
    {
       $('#msg').text('Parada eliminada con éxito'); 
       limpiar();
       marcadores[ultimoMarker].setMap(null);
       marcadores.splice(ultimoMarker,1);
        renombrarMarcadores();
       ultimoMarker=null;

    }
    else
    {
        $('#msg').text('Hubo un problema al realizar la operación');
    }
}

function limpiar () {
    $("#indicePEliminar :selected").remove();
    $('#indicePEliminar').val("");
}

function marcarParada () {
    var id= $('#AutobusesPEditar').val();
    var indice= $('#indicePEliminar').val();
        if (id==""||indice==""){
            console.log("Nada");
            return;
        }
    if(ultimoMarker!=null)
        marcadores[ultimoMarker].setIcon(null);
    ultimoMarker=indice-1;
    marcadores[ultimoMarker].setIcon(imagen);

}

function renombrarMarcadores () {
    $('#indicePEliminar').empty();
    $("<option value='"+"'>Selecciona un indice</option>").appendTo("#indicePEliminar");            
        for(var i=0;i<marcadores.length;i++)
        {
            $("<option value='"+(i+1)+"'>"+(i+1)+"</option>").appendTo("#indicePEliminar");
        }
    for (marcador in marcadores){
          marcadores[marcador].setTitle('Parada '+(parseInt(marcador)+1));
    }

}