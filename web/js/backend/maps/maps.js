var googleMaps;
$(document).ready(function(){
  if ($("#map_canvas").length > 0) {
    googleMaps = $("#map_canvas").initMaps();
      google.maps.event.addListenerOnce(googleMaps.map,'tilesloaded', function(){
        $.ajax({
          url: 'route.json?id='+$('input#nj_route_id').val(),
          dataType: 'json',
          success: function(data) {
            googleMaps.route = {};
            googleMaps.route.positions = data.route;
            googleMaps.route.markers = data.markers;
            map = $("#map_canvas").calcMapsRoute(googleMaps);
            googleMaps.markersArray = map.markersArray;
        }
      });
    });
  }
});

function clearMaps() {
  var path = poly.getPath();
  while (path.getLength()) {
    path.pop();
  }
  
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(null);
    }
    markersArray.length = 0;
  }
}
