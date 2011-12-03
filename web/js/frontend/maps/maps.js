var googleMaps;
var liveRouteTimeout;
var indexBusTracking = 0;
$(document).ready(function(){
  if ($("#map_canvas").length > 0) {
    googleMaps = $('.map_canvas', this);
    
    //Get polyline path
    var polyline = $('textarea.path-polyline').text();
    var points = polyline.split('|');
    var routePath = [];
    if (polyline != '') {
      $.each(points, function(index, value){
        coords = value.split(';');
        routePath.push({lat:$.trim(coords[0]), lng:$.trim(coords[1])});
      });
    }
    //Get stops from path
    var stops = $('textarea.path-stops').text();
    var stopPoints = stops.split('|');
    var routeStops = [];
    if (stops != '') {
      $.each(stopPoints, function(index, value){
        coords = value.split(';');
        routeStops.push({lat:$.trim(coords[0]), lng:$.trim(coords[1]), desc: $.trim(coords[2])});
      });    
    }
    
    googleMaps.googlemaps({
      editable: false,
      routePath: routePath,
      routeStops: routeStops
    });

    /*$('select#nj_route_id').change(function(){
      routeSelected = $(':selected', this).val();
      if (liveRouteTimeout != undefined) {
        clearTimeout(liveRouteTimeout);
      }
      $('#messages_container').html('');
      loadTransports(routeSelected);
      loadRoute(routeSelected);
    });*/
  }
});

//Get current bus position and reload it every 5 seconds
function loadBusPosition(bus_selected) {
  if (bus_selected != '') {
    $.ajax({
      //TODO Remove last param as we are using only as test
      url: 'get-transport-position/'+ bus_selected +'/'+ $('select#nj_route_id :selected').val() + '/' + indexBusTracking,
      dataType: 'json',
      success: function(data) {
        if (googleMaps.currentTransportPosition == undefined) {
          googleMaps.currentTransportPosition = {lat: data.lat, lng: data.lng};
        }
        else {
          googleMaps.currentTransportPosition.lat = data.lat;
          googleMaps.currentTransportPosition.lng = data.lng;
        }
        
        if ($('#messages_container ul.message-list').length == 0) {
          $('#messages_container').append('<ul class="message-list"></ul>');
        }
        
        $('#messages_container').append('<li class="item">Latitude: '+ googleMaps.currentTransportPosition.lat +' - '+
                                                       'Longitude: '+ googleMaps.currentTransportPosition.lng +'</li>');
        googleMaps = $("#map_canvas").setCurrentTransportPosition(googleMaps);
        
        if (googleMaps.liveTracking.polyline != undefined) {
          if (indexBusTracking < (googleMaps.polyline.getPath().getLength() - 1)) {
            indexBusTracking++;
          }
          else {
            indexBusTracking = 0;
          }
        }
        //If googleMaps.liveTracking.polyline means is the first step indexBusTracking should be increased 
        //without checking if is the end of the path.
        else {
          indexBusTracking++;
        }
        
        liveRouteTimeout = setTimeout(function(){
          loadBusPosition(bus_selected);
        }, 5000);
        

      }
    });
  }
}

function loadTransports(routeSelected) {
  $.ajax({
    url: 'load-transports/'+ routeSelected,
    dataType: 'json',
    beforeSend: function() {
      $('div.container div.filter select#buses_from_route').remove();
    },
    success: function(data) {

      $('div.container div.filter').append(data.buses);
      indexBusTracking = 0;
      /*if (!$.isEmptyObject(googleMaps.currentTransportPosition)) {
        googleMaps.currentTransportPosition.marker.setMap(null);
        googleMaps.currentTransportPosition = {};
      }*/
      
      $('select#buses_from_route').change(function(){
        bus_selected = $(':selected', this).val();
        if (liveRouteTimeout != undefined) {
          clearTimeout(liveRouteTimeout);
        }
        $('#messages_container').html('');
        loadBusPosition(bus_selected);
      });

    }
  });
}

function loadRoute(routeSelected) {
  $.ajax({
    url: 'routes/route.json?id='+ routeSelected,
    dataType: 'json',
    success: function(data) {
      googleMaps.route = {};
      googleMaps.route.positions = data.route;
      googleMaps.route.markers = data.markers;
      map = $("#map_canvas").calcMapsRoute(googleMaps);
      googleMaps.markersArray = map.markersArray;
    }
  }); 
}
