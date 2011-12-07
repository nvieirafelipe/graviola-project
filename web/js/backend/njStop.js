$(document).ready(function() {
  loadMaps();
});

var loadMaps = function(context) {
  $('.map_wrapper:not(.map_processed)', context).each(function(){
    var map_canvas = $('.map_canvas', this);
    var latitude = $('input#nj_stop_latitude', context).val();
    var longitude = $('input#nj_stop_longitude', context).val();
    var map = map_canvas.routemaps({
      latitude: latitude,
      longitude: longitude,
      latitudeSelector:  $('input#nj_stop_latitude', context),
      longitudeSelector: $('input#nj_stop_longitude', context)
    });
  });
}