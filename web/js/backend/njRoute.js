$(document).ready(function() {

  $('label#NjTrips').click(function() {
    if($(this).parents('[class*="NjTrip"]').find('table>tbody>tr>td').length > 0){
      $(this).parents('[class*="NjTrip"]').children('table').toggle();
    }
  })

  $('label#NjStopTimes').click(function() {
    if ($(this).parents('[class*="NjStopTime"]').find('table>tbody>tr>td').length > 0){ 
      $(this).parents('[class*="NjStopTime"]').children('table').toggle();
    }
  })

  $('a#addTrip').click(addNewTrip);
});

var addNewTrip = function(e) {
  $(this).unbind('click'); 
  $(this).fadeOut('normal');

  // This selector looks for input of type hidden field that stores the id of a trip to discover how many trips have been added
  num = parseInt($('tbody tr td input[type=hidden][name^="nj_route[new]"]').size()+1);
  if ($('#nj_route_NjTrips_'+num+'_id').length == 0) {
    $('.sf_admin_form_field_NjTrips table:first').append('<tr><th>'+num+'</th><td></td></tr>');
    $('.sf_admin_form_field_NjTrips table:first tbody:first > tr:last > td').load($(location).attr('href')+'/add-trip?num='+num, function(){

      //googleMaps = $("#map_canvas").initMaps();
      //loadControls();
      loadMaps(this);
      
      
      $('a#addTrip').fadeIn('normal');
      $('a#addTrip').click(addNewTrip);
      $('label#NjTrips').parents('[class*="NjTrip"]').children('table').show();
    });
  }
}

var addNewStopTime = function(e) {
  $(this).unbind('click'); 
  $(this).fadeOut('normal');

  // This selector looks for input of type hidden field that stores the id of a stop time to discover how many stop times have been added
  num = parseInt($('tbody tr td input[type=hidden][name^="nj_trip[new]"]').size()+1);
  if ($('#nj_trip_NjStopTimes_'+num+'_id').length == 0) {
    $('.sf_admin_form_field_NjStopTimes table:first').append('<tr><th>'+num+'</th><td></td></tr>');
    $('.sf_admin_form_field_NjStopTimes table:first tbody:first > tr:last > td').load('edit/add-stop-time?num='+num, function(){

      loadMaps(this);

      $('a#addTrip').fadeIn('normal');
      $('a#addTrip').click(addNewStopTime);
    });
  }
}