(function($){
  
  //Prototype declarations.
  google.maps.Polyline.prototype.totalDistance = function() {
    var dist = 0;
    for (var i=1; i < this.getPath().getLength(); i++) {
      dist += google.maps.geometry.spherical.computeDistanceBetween(this.getPath().getAt(i), this.getPath().getAt(i-1));
    }
    return dist;
  }
  
  //Common variables used
  var map;
  var polyline = [];
  var markers = [];
  var pathMarkers = [];
  var infoWindow;
  var createPointListener;
  var createStopListener;
  var opts;
  var directionsService;
  var controlerEnabled;
  var geoCoder;
  var liveTrackingPolyline = [];
  var liveTrackingTransportPosition;
  var liveTrackingInterval;
  
  
  function locatePlace(address) {
    if (geoCoder == undefined) {
      geoCoder = new google.maps.Geocoder();
    }
    
    geoCoder.geocode( {'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
  
  //Based on a given origin and destination call google maps service to create a route for DRIVING directions.
  function getDirectionsFromGoogle(origin, destination, insertAtEnd, insertAtIndex) {
    var request = {
      origin: origin,
      destination: destination,
      travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    
    if (insertAtIndex == undefined) {
      insertAtIndex = 0;
    }
    
    if (directionsService == undefined) {
      directionsService = new google.maps.DirectionsService();
    }
    
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        
        if (response.routes && response.routes.length > 0){
          route = response.routes[0];
          
          if (route.overview_path && route.overview_path.length > 0){
            $.each(route.overview_path, function(index, point){
              if (insertAtEnd) {
                polyline.getPath().push(point);
                createCustomMarker(point, {setMap: true});
              }
              else {
                polyline.getPath().insertAt(insertAtIndex, point);
                createCustomMarker(point, {setMap: true}, insertAtIndex);
              }
            });
            
          }
        }
      }
    });
    
  }
  
  //Convert an Google Maps array of LatLng to the normal form like {lat: '-22.0', lng: '-44.0'} so,
  //handlers can manipulate it correctly.
  function convertPositionsToNormalForm(array) {
    var convertedArray = [];
    
    $.each(array, function(index, item) {
      convertedArray.push({
                            lat: item.getPosition().lat(),
                            lng: item.getPosition().lng()
                          });
    });
    return convertedArray
  }
  
  //Check where is the user attemp to insert the item on the map, whether it's closest 
  //to end or the beggining of the array.
  function insertAtEnd(point, firstItem, lastItem) {
    var distanceFromBeggining = google.maps.geometry.spherical.computeDistanceBetween (point.latLng, firstItem);
    var distanceFromEnd = google.maps.geometry.spherical.computeDistanceBetween (point.latLng, lastItem)
    //Compare the current point being set against the beginning and the end of the polyline to check
    //whether the point is closest to the begin or to the end.
    if (distanceFromBeggining < distanceFromEnd) {
      return false;
    }
    else {
      return true;
    }
  }
  
  //Create a point on the map while editing a route. This point will be actually a marker
  //as they are used to create new points on the map.
  function createPoint(point) {
    if (polyline.getPath().length > 0) {
      var polylineStart = polyline.getPath().getAt(0);
      var polylineEnd = polyline.getPath().getAt(polyline.getPath().length - 1);
      var positionInsertAt = insertAtEnd(point, polylineStart, polylineEnd);

      if (positionInsertAt) {
        getDirectionsFromGoogle(polylineEnd, point.latLng, true);
      }
      else {
        getDirectionsFromGoogle(polylineStart, point.latLng, false);
      }
    }
    else {
      getDirectionsFromGoogle(point.latLng, point.latLng, true);
    }
  }
  
  //Create a stop on the map while editing a route.
  function createStop(point) {
    var marker = createSimpleMarker({
                          setMap: true, 
                          lat: point.latLng.lat(), 
                          lng: point.latLng.lng(),
                          desc: ''
                        });
    markers.push(marker);
  }
  
  //Get bounds for a given path
  function getBoundsForPath(path) {
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0; i < path.getLength(); i++) {
       bounds.extend(path.getAt(i));
    }
    return bounds;
  }
  
  //Set a polyline on the given map. For routePath is expected an array of objects in the 
  //following format {lat: '-22.0', lng: '-44.0'}
  function createPolyline(routePath, polylineOptions){
    
    var defaultPolylineOptions = {
      clickable:      false,
      strokeColor:    '#5E9DC8',
      strokeOpacity:  0.75,
      strokeWeight:   6,
      map:            map
    }
    defaultPolylineOptions = $.extend({}, defaultPolylineOptions, polylineOptions);
    
    var path = [];
    
    $.each(routePath, function(index, element) {
      var pointPosition = new google.maps.LatLng(parseFloat(element.lat),parseFloat(element.lng));
      path.push(pointPosition);
      if (opts.editable) {
        createCustomMarker(pointPosition);
      }
    });
    defaultPolylineOptions.path = path;
    polyline = new google.maps.Polyline(defaultPolylineOptions);
    polyline.setMap(defaultPolylineOptions.map);
    return polyline;
  }
  
  //Set all stops of a given path. For this is expected an array of objects in the
  //following format {lat: '-22.0', lng: '-44.0', desc: 'Stop description'}
  function createStops(stops, setMap) {
    //In case map is being edited
    if (!setMap) {
      $.each(stops, function(index, stop){
        stop.setMap = setMap;

        $('table tbody:eq(0) > tr', $('div.sf_admin_form_field_NjStopTimes')).each(function(index, value){
          var form_create_stop_time = $('td:eq(0)', $(this)).clone(true);
          latitude = $('td:eq(0) table tbody:eq(0) > tr:eq(7) td input', $(this)).val();
          longitude = $('td:eq(0) table tbody:eq(0) > tr:eq(8) td input', $(this)).val();
          holder = $('<div class="holder-stop-' + index + '"></div>');
          overflow = $('<div style="overflow:auto;"></div>');

          $(holder).append(form_create_stop_time);
          saveButton = $('<a href="#confirm">Confirm</a>');

          $('table tbody tr:eq(0)', form_create_stop_time).hide();
          $('table tbody tr:eq(7)', form_create_stop_time).hide();
          $('table tbody tr:eq(8)', form_create_stop_time).hide();

          saveButton.click(function(){
            $('select#nj_trip_NjStopTimes_' + index + '_arrival_time_hour', $('div.sf_admin_form_field_NjStopTimes')).val($('select#nj_trip_NjStopTimes_' + index + '_arrival_time_hour', form_create_stop_time).val());
            $('select#nj_trip_NjStopTimes_' + index + '_arrival_time_minute', $('div.sf_admin_form_field_NjStopTimes')).val($('select#nj_trip_NjStopTimes_' + index + '_arrival_time_minute', form_create_stop_time).val());

            $('select#nj_trip_NjStopTimes_' + index + '_departure_time_hour', $('div.sf_admin_form_field_NjStopTimes')).val($('select#nj_trip_NjStopTimes_' + index + '_departure_time_hour', form_create_stop_time).val());
            $('select#nj_trip_NjStopTimes_' + index + '_departure_time_minute', $('div.sf_admin_form_field_NjStopTimes')).val($('select#nj_trip_NjStopTimes_' + index + '_departure_time_minute', form_create_stop_time).val());

            $('input#nj_trip_NjStopTimes_' + index + '_stop_sequence', $('div.sf_admin_form_field_NjStopTimes')).val($('input#nj_trip_NjStopTimes_' + index + '_stop_sequence', form_create_stop_time).val());
            $('input#nj_trip_NjStopTimes_' + index + '_description', $('div.sf_admin_form_field_NjStopTimes')).val($('input#nj_trip_NjStopTimes_' + index + '_description', form_create_stop_time).val());
            $('textarea#nj_trip_NjStopTimes_' + index + '_detail', $('div.sf_admin_form_field_NjStopTimes')).val($('textarea#nj_trip_NjStopTimes_' + index + '_detail', form_create_stop_time).val());
            $('input#nj_trip_NjStopTimes_' + index + '_dist_traveled', $('div.sf_admin_form_field_NjStopTimes')).val($('input#nj_trip_NjStopTimes_' + index + '_dist_traveled', form_create_stop_time).val());
            $('input#nj_trip_NjStopTimes_' + index + '_delete', $('div.sf_admin_form_field_NjStopTimes')).attr('checked', $('input#nj_trip_NjStopTimes_' + index + '_delete', form_create_stop_time).attr('checked'));
          });

          $(holder).append(saveButton);

          $(overflow).append(holder);

          markers.push(createSimpleMarker({
            setMap: stop.setMap, 
            lat: latitude, 
            lng: longitude,
            infoWindowContent: overflow
          }));

          $(this).hide();

        });

      });
    }
    else {
      $.each(stops, function(index, stop){
        stop.setMap = setMap;
        markers.push(createSimpleMarker({
          setMap: stop.setMap, 
          lat: stop.lat, 
          lng: stop.lng,
          infoWindowContent: stop.desc
        }));
      });
    }
  }
  
  //Generates an info window with the given content.
  function createInfoWindow(content) {
    if (infoWindow == undefined) {
      infoWindow = new google.maps.InfoWindow({content: content});
    }
    else {
      infoWindow.setContent(content);
    }
    return infoWindow;
  }
  
  //Creates a simple marker with default maps settings. Options should be in the
  //following format {lat: '-22.0', lng: '-44.0', desc: 'Stop description'}
  function createSimpleMarker(options) {
    //TODO Review this to be more generic.
    var marker = new google.maps.Marker({
      map: options.setMap ? map : null,
      position: new google.maps.LatLng(parseFloat(options.lat), parseFloat(options.lng)),
      title: options.desc,
      zIndex: 1
    });
    
    if (options.infoWindowContent == undefined) {
      options.infoWindowContent = '';
    }
    
    google.maps.event.addListener(marker, 'click', function() {
      if (opts.editable) {
        
        if (typeof options.infoWindowContent == 'object') {
          infoWindowContent = options.infoWindowContent.get(0);
        }
        else {
          infoWindowContent = options.infoWindowContent;
        }
        
        if (infoWindowContent == '') {
          descStop = $('<input type="text" value="' + options.desc + '"/>')

          saveStop = $('<a href="#save-stop" title="Save Stop">Save Stop</a>');
          saveStop.click(function(){
            //TODO Pass as argument the item removed, added or edited.
            if (opts.callbackMarkerChanged != null) {
              opts.callbackMarkerChanged(convertPositionsToNormalForm(markers), true);
            }

            return false;
          });

          removeStop = $('<a href="#remove-stop" title="Remove Stop">Remove Stop</a>');
          removeStop.click(function(){
            marker.setMap(null);
            markers.splice(markers.indexOf(marker), 1);
            if (opts.callbackMarkerChanged != null) {
              opts.callbackMarkerChanged(convertPositionsToNormalForm(markers), false);
            }
            return false;
          });

          editStopHolder = $('<div class="edit-stop-holder"></div>').append(descStop).append(saveStop).append(removeStop);
          
          infoWindowContent = editStopHolder.get(0);
        }
      } 
      else {
        infoWindowContent = '<p>' + options.infoWindowContent + '</p>';
      }
      
      
      createInfoWindow(infoWindowContent);
      infoWindow.open(map, marker);
    });
    
    return marker;
  }
  
  //Create a marker based on the point given and options array. If editable true, this marker
  //will have some listeners assigned to edit the marker.
  function createCustomMarker(point, options, insertAtIndex) {
    
    //If options is undefined it should be set as an empty object to be used on $.extend. 
    if (options == undefined) {
      options = {};
    }
    
    var defaultValues = {
      imageSize: {x: 11, y: 11},
      imageNormalStatePath: 'http://localhost/graviola/web/images/square.png',
      imageHoverStatePath: 'http://localhost/graviola/web/images/square_over.png',
      imageOrigin: {x: 0, y: 0},
      imageAnchor: {x: 6, y: 6}
    };
    defaultValues = $.extend({}, defaultValues, options);
    
    defaultValues.imageSize = new google.maps.Size(defaultValues.imageSize.x, defaultValues.imageSize.y);
    defaultValues.imageOrigin = new google.maps.Point(defaultValues.imageOrigin.x, defaultValues.imageOrigin.x);
    defaultValues.imageAnchor = new google.maps.Point(defaultValues.imageAnchor.x, defaultValues.imageAnchor.x);
    
    imageNormalState = new google.maps.MarkerImage(defaultValues.imageNormalStatePath, defaultValues.imageSize, defaultValues.imageOrigin, defaultValues.imageAnchor);
    imageHoverState = new google.maps.MarkerImage(defaultValues.imageHoverStatePath, defaultValues.imageSize, defaultValues.imageOrigin, defaultValues.imageAnchor);
    
    var marker = new google.maps.Marker({
      position: point,
      map: options.setMap ? map : null,
      icon: imageNormalState,
      draggable: true
    });
    
    //If this is an editable marker, events for edition should be set properly.
    if (opts.editable) {
      google.maps.event.addListener(marker, "mouseover", function() {
        marker.setIcon(imageHoverState);
      });
      
      google.maps.event.addListener(marker, "mouseout", function() {
        marker.setIcon(imageNormalState);
      });
      
      //Removes a point.
      google.maps.event.addListener(marker, "click", function() {
        for (var index = 0; index < pathMarkers.length; index++) {
          if (pathMarkers[index] == marker) {
            marker.setMap(null);
            pathMarkers.splice(index, 1);
            polyline.getPath().removeAt(index);
            break;
          }
        }
        
        if (opts.callbackPathChanged != null) {
          opts.callbackPathChanged(convertPositionsToNormalForm(pathMarkers), false);
        }
      });
      
      //Change the position of a point.
      google.maps.event.addListener(marker, "drag", function() {
        for (var index = 0; index < pathMarkers.length; index++) {
          if (pathMarkers[index] == marker) {
            polyline.getPath().setAt(index, marker.getPosition());
            break;
          }
        }
        //TODO Not changing the value of array pathMarkers
        if (opts.callbackPathChanged != null) {
          opts.callbackPathChanged(convertPositionsToNormalForm(pathMarkers), true);
        }
      });
      
      
    }
    //TODO Try to get the markers from the map object keep saving these markers in separated
    //arrays is not good.
    if (insertAtIndex == undefined) {
      pathMarkers.push(marker);
    } 
    else {
      pathMarkers.splice(0, 0, marker);
    }
    
    if (opts.callbackPathChanged != null) {
      opts.callbackPathChanged(convertPositionsToNormalForm(pathMarkers), true);
    }
    return marker;
  }
  
  //Remove Polyline and Markers on the map. Basically set the map to null for these so, if the map
  //is set again in these elements they will appear again.
  function clearMap() {
    polyline.setMap(null);
    
    $.each(pathMarkers, function(index, marker){
      marker.setMap(null);
    });
    
    $.each(markers, function(index, marker){
      marker.setMap(null);
    });
  }
  
  //Control callback to enable path edition
  function enablePathEdition() {
    if (controlerEnabled != 'path') {
      clearMap();
      polyline.setMap(map);

      $.each(pathMarkers, function(index, marker){
        marker.setMap(map);
      });

      //Click listener to create a new point on the path 
      createPointListener = google.maps.event.addListener(map, 'click', createPoint);

      if (createStopListener != undefined) {
        google.maps.event.removeListener(createStopListener);
      }
      controlerEnabled = 'path';
      $('div.add-stop-wrapper').hide();
    }
    
  }
  
  //Control callback to enable stops edition
  function enableStopsEdition() {
    if (controlerEnabled != 'stops') {
      clearMap();

      polyline.setMap(map);
      $.each(markers, function(index, marker){
        marker.setMap(map);
      });

      if (createPointListener != undefined) {
        google.maps.event.removeListener(createPointListener);
      }
      controlerEnabled = 'stops';
      
      
      if ($('div.add-stop-wrapper').length > 0) {
        if (map.controls[google.maps.ControlPosition.LEFT_BOTTOM].length == 0) {
          map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push($('div.add-stop-wrapper').get(0));
          $('div.add-stop-wrapper a.btn-add-stop').click(function(){
            var numberStops = $('div.sf_admin_form_field_NjStopTimes table tbody:eq(0) > tr').length;
            //Call WS from here to get the stop point.
            $.ajax({
              url: 'edit/add-stop-time?stop_id=' + $('div.add-stop-wrapper select#nj_stop_id').val() +'&num=' + numberStops,
              success: function(data){
                $('div.sf_admin_form_field_NjStopTimes table tbody:eq(0)').append('<tr><th>New Stop</th><td>' + data + '</td></tr>').hide();
                
                var njStopTime = $(data).clone(true);
                latitude = $('input#nj_trip_new_' + numberStops + '_nj_stop_latitude', njStopTime).val();
                longitude = $('input#nj_trip_new_' + numberStops + '_nj_stop_longitude', njStopTime).val();
                
                var holder = $('<div class="holder-stop-' + numberStops + '"></div>');
                overflow = $('<div style="overflow:auto;"></div>');
                
                $('tbody tr:eq(1)', njStopTime).hide();
                $('tbody tr:eq(8)', njStopTime).hide();
                $('tbody tr:eq(9)', njStopTime).hide();
                
                $(holder).append(njStopTime);
                saveButton = $('<a href="#confirm">Confirm</a>');
                
                saveButton.click(function(){
                  
                  $('select#nj_trip_new_' + numberStops + '_arrival_time_hour', $('div.sf_admin_form_field_NjStopTimes')).val(
                    $('select#nj_trip_new_' + numberStops + '_arrival_time_hour',  holder).val()
                  );
                    
                  $('select#nj_trip_new_' + numberStops + '_arrival_time_minute', $('div.sf_admin_form_field_NjStopTimes')).val(
                    $('select#nj_trip_new_' + numberStops + '_arrival_time_minute', holder).val()
                  );

                  $('select#nj_trip_new_' + numberStops + '_departure_time_hour', $('div.sf_admin_form_field_NjStopTimes')).val(
                    $('select#nj_trip_new_' + numberStops + '_departure_time_hour', holder).val()
                  );
                    
                  $('select#nj_trip_new_' + numberStops + '_departure_time_minute', $('div.sf_admin_form_field_NjStopTimes')).val(
                    $('select#nj_trip_new_' + numberStops + '_departure_time_minute', holder).val()
                  );

                  $('input#nj_trip_new_' + numberStops + '_stop_sequence', $('div.sf_admin_form_field_NjStopTimes')).val(
                    $('input#nj_trip_new_' + numberStops + '_stop_sequence', holder).val()
                  );
                    
                  $('input#nj_trip_new_' + numberStops + '_description', $('div.sf_admin_form_field_NjStopTimes')).val(
                    $('input#nj_trip_new_' + numberStops + '_description', holder).val()
                  );
                    
                  $('textarea#nj_trip_new_' + numberStops + '_detail', $('div.sf_admin_form_field_NjStopTimes')).val(
                    $('textarea#nj_trip_new_' + numberStops + '_detail', holder).val()
                  );
                    
                  $('input#nj_trip_new_' + numberStops + '_dist_traveled', $('div.sf_admin_form_field_NjStopTimes')).val(
                    $('input#nj_trip_new_' + numberStops + '_dist_traveled', holder).val()
                  );
                    
                  $('input#nj_trip_new_' + numberStops + '_delete', $('div.sf_admin_form_field_NjStopTimes')).attr(
                    'checked', $('input#nj_trip_new_' + numberStops + '_delete', holder).attr('checked')
                  );
                    
                });
                
                $(holder).append(saveButton);

                $(overflow).append(holder);
                
                point = new google.maps.LatLng(parseFloat(latitude),parseFloat(longitude));
                
                marker = createSimpleMarker({
                  setMap: true, 
                  lat: point.lat(), 
                  lng: point.lng(),
                  infoWindowContent: overflow
                });
                markers.push(marker);
                
              },
              error: function() {
                alert('error');
              }
            });
            return false;
          });
        }
        $('div.add-stop-wrapper').show();
      }
      else {
        //Click listener to create a new stop
        createStopListener = google.maps.event.addListener(map, 'click', createStop);
      }
      
    }
    
  }
  
  //Load all additional map controls
  function loadAdditionalMapControls(selector_object) {
    var controls = [];
    if (opts.editable) {
      //TODO Change the path of the images, these should be more dynamic.
      controls = [{title: 'Route', src: 'http://localhost/graviola/web/images/icons/route.png', clickCallback: enablePathEdition},
                      {title: 'Stop', src: 'http://localhost/graviola/web/images/icons/stop.png', clickCallback: enableStopsEdition}]
                   
                   
      $.each(controls, function(index, control){
        map_controler = $("<div class='additional-map-controls'></div>").append("<img src='" + control.src  +"' title='" + control.title  +"'/>");
        //TODO If the editor is already enabled it should not be clickable again.
        $(map_controler).click(function(){
          control.clickCallback(control.clickCallbackParams);
        });
      
        //Convert to format used by google maps API
        map_controler = map_controler.get(0);
        map_controler.index = index;
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(map_controler);
      });
      
      //Search map position
      geocoder_input = $("<input type='text' id='geocoder-map-control'/>");
      geocoder_button = $("<a href='#find-place' id='geocoder-button'>Find Place</a>");
      geocoder_button.click(function(){
        locatePlace(geocoder_input.val());
        return false;
      });
      geocoder_controler = $("<div class='additional-map-controls geocoder'></div>").append(geocoder_input).append(geocoder_button);
      map.controls[google.maps.ControlPosition.TOP_CENTER].push(geocoder_controler.get(0));
      $('div.add-stop-wrapper').hide();
    }
    
    
  }
  
  function transportLiveTracking(transportPosition) {
    
    if (liveTrackingTransportPosition == null) {
      liveTrackingTransportPosition = new google.maps.Marker({
        map: map,
        animation: google.maps.Animation.DROP,
        icon: "http://localhost/graviola/web/images/symb_bus.png",
        zIndex: 1000
      });
    }
    liveTrackingTransportPosition.setPosition(new google.maps.LatLng(parseFloat(transportPosition.lat),parseFloat(transportPosition.lng)));
    
  }
  
  $.fn.googlemaps = function(options) {
    //Override the default settings with the values passed on options.
    opts = $.extend({}, $.fn.googlemaps.defaults, options);
    
    opts.mapOptions.disableDoubleClickZoom = opts.editable;
    //Initialize maps with settings passed on options otherwise set the default values.
    map = new google.maps.Map($(this).get(0), opts.mapOptions);

    //TODO Handle cases when polyline and stops array are empty
    polyline = createPolyline(opts.routePath);

    //When not in edition mode we should set the markers on the map
    createStops(opts.routeStops, !opts.editable);

    //If no bounds is empty the map bounds should not be set.
    bounds = getBoundsForPath(polyline.getPath());
    if (!bounds.isEmpty()) {
      map.fitBounds(bounds);
    }

    //Load additional
    loadAdditionalMapControls(this);

    //Init live tracking components
    if (!opts.editable) {
        if (opts.liveTrackingElement != null) {
          opts.liveTrackingElement.change(function(){
            if (opts.callbackLiveTracking != null) {
              if (liveTrackingInterval != undefined) {
                clearInterval(liveTrackingInterval);
              }
              transportLiveTracking(opts.callbackLiveTracking($(':selected', opts.liveTrackingElement).val()));
            }
          });
        }
    }
    return map;
  }
  
  $.fn.googlemaps.addStopMarker = function(coords) {
    createSimpleMarker(coords);
  }
  
  //Set default values to init maps. These values will be overwritten in case
  //they're passed to options on $.fn.initMaps.
  $.fn.googlemaps.defaults = 
  {
    mapOptions:
    {
      zoom:       7, 
      mapTypeId:  google.maps.MapTypeId.ROADMAP,
      center:     new google.maps.LatLng(-22.567566, -47.975715)
    },
    //Set in here one or points for a route. This should be a single array of objects 
    //The object should be in the format {lat: '-22.0', lng: '-44.0'}
    routePath:[],
    routeStops:[],
    //Set whether or not map is on edition on mode.
    editable:  false,
    callbackPathChanged: null,
    callbackMarkerChanged: null,
    liveTrackingElement: null,
    callbackLiveTracking: null,
    liveTrackingDelay: 4
  }
  
})(jQuery);