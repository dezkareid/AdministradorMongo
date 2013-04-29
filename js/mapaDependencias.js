var map;
var marker=null;
var lat=0;
var lon=0;

$(document).on("ready",cargar);


function agregarMarcador(posicion)
{

  $('#lat').val(posicion.lat());
  $('#long').val(posicion.lng());
    if(marker==null){
        marker= new google.maps.Marker({
            position: posicion, 
            map: map,
            title: "Aqui esta la parada que marcaste"
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
}

function marcarCoordenadas () {
    var latitud= $('#lat').val();
    var longitud= $('#long').val();
    if(latitud==""|longitud=="")
      return;
    var posicion= new google.maps.LatLng(parseFloat(latitud),parseFloat(longitud));
    agregarMarcador(posicion);
    map.setCenter(posicion);
}