$(document).ready(function() {
  loadMaps();
});

var loadMaps = function(context) {
  $('.map_wrapper:not(.map_processed)', context).each(function(){
    var map_canvas = $('.map_canvas', this);
    
    if ($('div.field-latitude').length > 0 && $('div.field-longitude').length > 0) {
      latitude = $('div.field-latitude', context).html();
      longitude = $('div.field-longitude', context).html();
      latitudeSelector = $('div.field-latitude', context);
      longitudeSelector = $('div.field-longitude', context);
      editable = false;
    }
    else {
      latitude = $('input#nj_stop_latitude', context).val();
      longitude = $('input#nj_stop_longitude', context).val();
      latitudeSelector = $('input#nj_stop_latitude', context);
      longitudeSelector = $('input#nj_stop_longitude', context);
      editable = true;
    }
    
    
    var map = map_canvas.routemaps({
      latitude: latitude,
      longitude: longitude,
      latitudeSelector:  latitudeSelector,
      longitudeSelector: longitudeSelector,
      editable: editable
    });
  });
}