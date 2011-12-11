$(document).ready(function() {
  loadMaps();
});


var loadMaps = function(context) {
  
  $('.map_wrapper:not(.map_processed)', context).each(function(){
    var map_path_data_save = $('.map_path_data textarea.polyline-coords', this);
    var stop_coords = $('.map_path_data div.stops-coords', this);
    var map_canvas = $('.map_canvas', this);
    var routePath = [];
    var routeStops = [];
    console.log(map_path_data_save);
    if (map_path_data_save.text() != "") {
      $.each(map_path_data_save.text().split("|"), function(index, item){
        var coords = item.split(';');
        routePath.push({lat: coords[0], lng: coords[1]});
      });
    }
    
    if (stop_coords.html()) {
      $.each(stop_coords.html().split("|"), function(index, item){
        var coords = item.split(';');
        routeStops.push({lat: coords[0], lng: coords[1], desc: coords[2]});
      });
    }
    
    var map = map_canvas.googlemaps({
      editable: false,
      routePath: routePath,
      routeStops: routeStops
    });
  });
}