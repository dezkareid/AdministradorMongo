var map;
var imagen = 'img/UV.png';
var markerOrigen=null;
var markerDestino=null;
var markerParadaOrigen=null;
var markerParadaDestino=null;
var nombreDependencias;
var infoOrigen;
var infoDestino;
var latOrigen=null;
var latDestino=null;
var longOrigen=null;
var longDestino=null;
var Autobuses;
var bus="img/bus.png";


$(document).on("ready",cargar);
function geolocalizar(){
    /*A la etitqueta P le escribimos un mensaje de espera*/
    /*Funcion para obtener la geolocalizacion, Parametro de geolocalzacion: mostrar, Parametro de error: error*/
    if (navigator.geolocation) 
    navigator.geolocation.getCurrentPosition(mostrar,error);
    else{
        $("#checkGeo").attr('disabled', true);
        alert("Tu navegador no soporta la geolocalización");
    }    
}

function mostrar(posicion){
    /* posicion es el parametro que tiene los valores, las variables para latitud y longitud las obtenemos del parametro posicion.coords*/
    latOrigen = posicion.coords.latitude; //obtengo la latitud
    longOrigen = posicion.coords.longitude; //obtengo la longitud
    if(markerOrigen==null)
        markerOrigen= new google.maps.Marker({
        position: new google.maps.LatLng(latOrigen,longOrigen), 
                map: map,
                icon: imagen
            });
    else{
            markerOrigen .setPosition(new google.maps.LatLng(latOrigen,longOrigen));
            markerOrigen.setTitle("Tu estas aqui");
            infoOrigen.close();
            infoOrigen = null;
            google.maps.event.clearInstanceListeners(markerOrigen);  // just in case handlers continue to stick aroun
            
        }
    if(longDestino!=null)
        cargarContenido();
    llenaComboDestino(-1);
            /*Escribir en la etiqueta las coordenandas*/            
}
        
function error(error){
            //El parametro error tambien tiene valores de los errores exactos, pero aqui no lo usaremos.
            console.log(error);
}

function agregarM(marker,json,index){

    if(marker==null){
        marker= new google.maps.Marker({
            position: new google.maps.LatLng(parseFloat(json.LATITUD),parseFloat(json.LONGITUD)), 
            map: map,
            icon: imagen,
            title: json.NOMBRE
        });
 
        }else{
            marker.setPosition(new google.maps.LatLng(parseFloat(json.LATITUD),parseFloat(json.LONGITUD)));
            marker.setTitle(json.NOMBRE);

        }
    if (index==0) {
        latOrigen=parseFloat(json.LATITUD);
        longOrigen=parseFloat(json.LONGITUD);
        if(infoOrigen!=null)
            infoOrigen.close();
        infoOrigen=new google.maps.InfoWindow({
                content: regresaContenido(json)
            });
        google.maps.event.addListener(marker, 'click', function() {
                infoOrigen.open(map,marker);
            });
    }
    else{
        latDestino=parseFloat(json.LATITUD);
        longDestino=parseFloat(json.LONGITUD);
        if(infoDestino!=null)
            infoDestino.close();
        infoDestino=new google.maps.InfoWindow({
                content: regresaContenido(json)
            });
        google.maps.event.addListener(marker, 'click', function() {
                infoDestino.open(map,marker);
            });
    }    
    return marker;
}

function regresaContenido(json){
    return '<h5><b>'+json.NOMBRE+'</b></h5>'+
    '<label><b>Calle: </b>'+json.CALLE+'</label>'+
    '<label><b>Colonia: </b>'+json.COLONIA+'</label>'+
    '<label><b>Telefono: </b>'+json.TELEFONO+'</label>';
}

function agregaParadas(latitudOrigen,longitudOrigen,latitudDestino,longitudDestino){
    if(markerParadaOrigen==null){
        markerParadaOrigen= new google.maps.Marker({
                position: new google.maps.LatLng(parseFloat(latitudOrigen),parseFloat(longitudOrigen)), 
                map: map,
                icon: bus
            });
        markerParadaDestino=new google.maps.Marker({
                position: new google.maps.LatLng(parseFloat(latitudDestino),parseFloat(longitudDestino)), 
                map: map,
                icon: bus
            });
        return;
    }

    markerParadaOrigen.setPosition(new google.maps.LatLng(parseFloat(latitudOrigen),parseFloat(longitudOrigen)));
    markerParadaDestino.setPosition(new google.maps.LatLng(parseFloat(latitudDestino),parseFloat(longitudDestino)));
    hacerVisible(true);
}

function hacerVisible(bandera){
    markerParadaOrigen.setVisible(bandera);
    markerParadaDestino.setVisible(bandera);
}

function autoCompleta(){
    (function( $ ) {
        $.widget( "ui.combobox", {
            _create: function() {
                var input,
                    that = this,
                    select = this.element.hide(),
                    selected = select.children( ":selected" ),
                    value = selected.val() ? selected.text() : "",
                    wrapper = this.wrapper = $( "<span>" )
                        .addClass( "ui-combobox" )
                        .insertAfter( select );

                input = $( "<input>" )
                    .appendTo( wrapper )
                    .val( value )
                    .attr( "title", "" )
                    .addClass( "ui-state-default ui-combobox-input" )
                    .autocomplete({
                        delay: 0,
                        minLength: 0,
                        source: function( request, response ) {
                            var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                            response( select.children( "option" ).map(function() {
                                var text = $( this ).text();
                                if ( this.value && ( !request.term || matcher.test(text) ) )
                                    return {
                                        label: text.replace(
                                            new RegExp(
                                                "(?![^&;]+;)(?!<[^<>]*)(" +
                                                $.ui.autocomplete.escapeRegex(request.term) +
                                                ")(?![^<>]*>)(?![^&;]+;)", "gi"
                                            ), "<strong>$1</strong>" ),
                                        value: text,
                                        option: this
                                    };
                            }) );
                        },
                        select: function( event, ui ) {
                            $("#checkGeo").attr('checked', false);
                            llenaComboDestino(ui.item.option.value);
                            cargarMarcador (ui.item.option.value,0);
                            $("#Autobuses").empty();
                            $("#contenido").empty();
                            if(longDestino!=null){
                                setTimeout("cargarContenido()",100);
                            }
                            ui.item.option.selected = true;
                            that._trigger( "selected", event, {
                                item: ui.item.option
                            });
                        }
                    })
                    .addClass( "ui-widget ui-widget-content ui-corner-left" );

                input.data( "autocomplete" )._renderItem = function( ul, item ) {
                    return $( "<li>" )
                        .data( "item.autocomplete", item )
                        .append( "<a>" + item.label + "</a>" )
                        .appendTo( ul );
                };

            },

            destroy: function() {
                this.wrapper.remove();
                this.element.show();
                $.Widget.prototype.destroy.call( this );
            }
        });
    })( jQuery );

    $(function() {
        $( "#origen" ).combobox();
      
    });  
}

function autoCompleta2(){
    (function( $ ) {
        $.widget( "ui.combobox", {
            _create: function() {
                var input,
                    that = this,
                    select = this.element.hide(),
                    selected = select.children( ":selected" ),
                    value = selected.val() ? selected.text() : "",
                    wrapper = this.wrapper = $( "<span>" )
                        .addClass( "ui-combobox" )
                        .insertAfter( select );

                input = $( "<input>" )
                    .appendTo( wrapper )
                    .val( value )
                    .attr( "title", "" )
                    .addClass( "ui-state-default ui-combobox-input" )
                    .autocomplete({
                        delay: 0,
                        minLength: 0,
                        source: function( request, response ) {
                            var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                            response( select.children( "option" ).map(function() {
                                var text = $( this ).text();
                                if ( this.value && ( !request.term || matcher.test(text) ) )
                                    return {
                                        label: text.replace(
                                            new RegExp(
                                                "(?![^&;]+;)(?!<[^<>]*)(" +
                                                $.ui.autocomplete.escapeRegex(request.term) +
                                                ")(?![^<>]*>)(?![^&;]+;)", "gi"
                                            ), "<strong>$1</strong>" ),
                                        value: text,
                                        option: this
                                    };
                            }) );
                        },
                        select: function( event, ui ) {
                            
                            cargarMarcador(ui.item.option.value,1);
                            setTimeout("cargarContenido()",100);
                            ui.item.option.selected = true;
                            that._trigger( "selected", event, {
                                item: ui.item.option
                            });
                        }
                    })
                    .addClass( "ui-widget ui-widget-content ui-corner-left" );

                input.data( "autocomplete" )._renderItem = function( ul, item ) {
                    return $( "<li>" )
                        .data( "item.autocomplete", item )
                        .append( "<a>" + item.label + "</a>" )
                        .appendTo( ul );
                };

               
            },

            destroy: function() {
                this.wrapper.remove();
                this.element.show();
                $.Widget.prototype.destroy.call( this );
            }
        });
    })( jQuery );

    $(function() {
        $( "#destino" ).combobox();
      
    });
}

function cargar() {
    var myOptions = {
   		zoomControlOptions: {
      		style: google.maps.ZoomControlStyle.llenarComboOrigen
      		},
      	zoom: 13,
      	center: new google.maps.LatLng(19.540649,-96.926408),
      	mapTypeId: google.maps.MapTypeId.HYBRID
    };
    map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions);
    cargarDependencias();
    $("#checkGeo").change(function(){
        if($(this).is(':checked'))
            geolocalizar();
    });

}

function cargarDependencias(){
        $.ajax({
            dataType: 'json',
            url: 'services/Dependencias.php',
            success: function(json){
               llenarComboOrigen(json);
               }
        });
}

function cargarMarcador(clave,index){
    $.ajax({
            data: {claveD: clave},
            dataType: 'json',
            type: 'post',
            url: 'services/buscar.php',
            success: function(json){
                if(index==0)
                    markerOrigen= agregarM(markerOrigen,json,index);
                else
                    markerDestino=agregarM(markerDestino,json,index);
               }
        });
}

function cargarContenido(){
    if(latOrigen==null|longOrigen==null|latDestino==null|longDestino==null){
        alert("Selecciona un origen y un destino");
        return;
    }
    if(latDestino==latOrigen){
         $("#contenido").append("<label>El origen y el destino son los mismos por favor elige distintos datos.</label>");
        return;
    }

       $.ajax({
            data:{latOrigen:latOrigen,longOrigen:longOrigen,latDestino:latDestino,longDestino:longDestino},
            dataType: 'json',
            type: 'post',
            url: 'services/ListaAutobuses.php',
            success: function(json){
                cargarCamiones(json);
            }
        });
}

function cargarCamiones(json){
    $("#Autobuses").empty();
    $("#contenido").empty();
    var lugarOrigen = new google.maps.LatLng(latOrigen, longOrigen);
    var lugarDestino = new google.maps.LatLng(latDestino, longDestino);
    var distancia = google.maps.geometry.spherical.computeDistanceBetween(lugarOrigen, lugarDestino);
    if(distancia<=301)
        $("#contenido").append("<label>Tu destino esta a menos de 300 metros, quizás deberías caminar</label>");

   if(json.length==0){
        $("#contenido").append("<label>No hay Corridas</label><br/>");
        if(markerParadaOrigen!=null)
            hacerVisible(false);
        return;
    }

    var $liNuevoNombre;
    Autobuses=json;
    for(feat in json){
        $liNuevoNombre=$('<li/>').html("<img src=\"img/"+json[feat].Imagen+"\"/><h5>Autobus: "+json[feat].Linea+"</h5><label>Trayecto: "+ json[feat].Trayecto+"</label><label>Descripcion: "+json[feat].Descripcion+". </label><label>Tiempo de espera: "+json[feat].Frecuencia+" minutos. </label><label>Tiempo de recorrido: "+json[feat].TiempoRecorrido+" minutos. </label><label>Próxima salida: "+json[feat].ProximaSalida+"</label><label>Hora de llegada aproximada: "+json[feat].HoraLlegada+"</label>");
        $("#Autobuses").append($liNuevoNombre);
    }

    $("#Autobuses li").click(function () {
        var numero = $("#Autobuses li").index(this);
        agregaParadas(
            Autobuses[numero].LatParadaOrigen,
            Autobuses[numero].LongParadaOrigen,
            Autobuses[numero].LatParadaDestino,
            Autobuses[numero].LongParadaDestino);
        $(this).css("background", "#F7D358");
        $( "#Autobuses li" ).each(function( index) {
            if(index!=numero)
                $(this).css("background", "#CEF6F5");
        });
        }
    );
    agregaParadas(
            Autobuses[0].LatParadaOrigen,
            Autobuses[0].LongParadaOrigen,
            Autobuses[0].LatParadaDestino,
            Autobuses[0].LongParadaDestino
            );

     $("#Autobuses li").eq(0).css("background", "#F7D358");
}

function llenarComboOrigen(json){
    $("<option value='"+"'>Selecciona una opcion</option>").appendTo("#origen");
    for(feat in json){
        $("<option value='"+json[feat]._id+"'>"+json[feat].NOMBRE+"</option>").appendTo("#origen");
    }
    nombreDependencias=json;
    autoCompleta();
}

function llenaComboDestino(clave){
    $("#destino").empty();
    $("<option value='"+"'>Selecciona una opcion</option>").appendTo("#destino");
    for(feat in nombreDependencias){
        if (nombreDependencias[feat]._id == clave)
            continue;
        $("<option value='"+nombreDependencias[feat]._id+"'>"+nombreDependencias[feat].NOMBRE+"</option>").appendTo("#destino");
  }

    
    autoCompleta2();
}