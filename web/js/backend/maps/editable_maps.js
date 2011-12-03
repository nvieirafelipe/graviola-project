/*var loadMaps = function(context) {
  
  $('.map_wrapper:not(.map_processed)', context).each(function(){
    var map_path_data_save = $('.map_path_data textarea', this);
    var map_canvas = $('.map_canvas', this);
    var routePath = [];
    
    if (map_path_data_save.text() != "") {
      $.each(map_path_data_save.text().split("|"), function(index, item){
        var coords = item.split(';');
        routePath.push({lat: coords[0], lng: coords[1]});
      });
    }
    
    map_canvas.googlemaps({
      editable: true,
      routePath: routePath,
      callbackPathChanged: function(pathArray, isChangeSavePoint) {
        var formatedItems = [];
        $.each(pathArray, function(index, item){
          formatedItems.push(item.lat + ';' + item.lng);
        });
        map_path_data_save.text(formatedItems.join('|'));
      }
    }).addClass('map_processed');
  });
}

$(document).ready(function(){
  loadMaps(this);
});*/