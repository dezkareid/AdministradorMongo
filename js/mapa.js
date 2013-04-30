var map;
var marker=null;
var lat=0;
var lon=0;
var marcadores= [];
var imagen = 'http://localhost/img/UV.png';

$(document).on("ready",cargar);


function agregarMarcadores(posicion,numero)
{
 
  var marcador= new google.maps.Marker({
        position: posicion, 
        map: map,
        title: "Parada "+(parseInt(numero)+1)
      });
  marcadores.push(marcador);
    
}


function agregarMarcador(posicion)
{

  $('#latitud').val(posicion.lat());
  $('#longitud').val(posicion.lng());
    if(marker==null){
        marker= new google.maps.Marker({
            position: posicion, 
            map: map,
            icon: imagen,
            title: "Parada que marco el usuario"
        });
 
        }else{
            marker.setPosition(posicion);
        }
    
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


    google.maps.event.addListener(map, 'click', function(e) {
          agregarMarcador(e.latLng);
        });
    $('#ver-Coordenadas').on('click', marcarCoordenadas);
}

function cargarMarcadores(json)
{
    var posicion;
    for(feat in json){
      posicion= new google.maps.LatLng(parseFloat(json[feat].Latitud),parseFloat(json[feat].Longitud)), 
      agregarMarcadores(posicion,feat);
    }
    
}


function marcarCoordenadas () {
    var latitud= $('#latitud').val();
    var longitud= $('#longitud').val();
    var posicion= new google.maps.LatLng(parseFloat(latitud),parseFloat(longitud));
    agregarMarcador(posicion);
    map.setCenter(posicion);
}

function eliminarMarcadores()
{
  if (marcadores) {
    for (i in marcadores) {
      marcadores[i].setMap(null);
    }
    marcadores.length = 0;
  }

  if(marker!=null)
    marker.setMap(null);
}