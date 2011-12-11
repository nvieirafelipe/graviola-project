$(document).ready(function() {
  loadMaps();
});

/**
 * Init items  
 */
function initTripItems() {
  $('div.add-stop-wrapper a.btn-add-stop').click(function(){
    return false;
  });
}


function getStopAlreadyCreated() {
  var routeStops = [];
  $('div.sf_admin_form_field_NjStopTimes table:first tbody:first > tr').each(function(){
    var tableRow = $(this);
    var tableRowData = $('td:first table:first > tbody', tableRow);
    
    stopSelected = $('> tr:eq(0) td input', tableRowData).val();
    arrivalTime = $('> tr:eq(1) td select', tableRowData);    
    departureTime = $('> tr:eq(2) td select', tableRowData);
    stopSequence = $('> tr:eq(3) td input', tableRowData).val();
    description = $('> tr:eq(4) td input', tableRowData).val();
    detail = $('> tr:eq(5) td textarea', tableRowData).text();
    distTraveled = $('> tr:eq(6) td input', tableRowData).val();
    latitude = $('> tr:eq(7) td input', tableRowData).val();
    longitude = $('> tr:eq(8) td input', tableRowData).val();
    routeStops.push({
      lat: latitude, 
      lng: longitude,
      stopSelected: stopSelected,
      stopSequence: stopSequence,
      description: description,
      detail: detail,
      distTraveled: distTraveled
    });
  });
  return routeStops;
}

var loadMaps = function(context) {
  
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
    
    
    var map = map_canvas.googlemaps({
      editable: true,
      routePath: routePath,
      routeStops: getStopAlreadyCreated(),
      callbackPathChanged: function(pathArray, isChangeSavePoint) {
        var formatedItems = [];
        $.each(pathArray, function(index, item){
          formatedItems.push(item.lat + ';' + item.lng);
        });
        map_path_data_save.text(formatedItems.join('|'));
      }
    });
  });
}