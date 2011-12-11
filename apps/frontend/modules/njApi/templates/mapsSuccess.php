<head>
  <meta content="initial-scale=1.0, user-scalable=no" name="viewport">
  <?php include_javascripts() ?>
</head>
<body style="margin:0px; padding:0px;" >
  <div class="map_wrapper">
    <div class="map_path_data" style="display:none">
      <textarea class="polyline-coords" id="polyline-coords"><?php print $trip_polyline; ?></textarea>
      <div class="stops-coords" id="stops-coords"><?php print html_entity_decode($stop_time_coords); ?></div>
    </div>
    <div id="map_canvas" class="map_canvas" style="width: 100%; height: 100%"></div>
  </div>
</body>