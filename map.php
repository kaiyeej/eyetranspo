<script>
<?php

    $locations = array();
    $user_ids = array();
    $counter = 0;
    $r_data = "";
    $result = $con->select("tbl_trips", 'user_id,trip_schedule_id', "status='D'");
    while ($row = $result->fetch_assoc()) {

      $fetchDest = $con->select("tbl_users", 'location', "user_id='$row[user_id]'");
      $rowDest = $fetchDest->fetch_array();
      $destination = explode(",", $rowDest['location']);
      $lat = $destination[0];
      $lng = $destination[1];

      $counter += 1;
      $user_ids[] = $row['user_id'];


      $r_data .= $rowDest['location'];

      $fetchRoute = $con->select("tbl_trip_schedule", 'route', "trip_schedule_id='$row[trip_schedule_id]'");
      $rowRoute = $fetchRoute->fetch_array();

      /* Marker #1 */
      $locations[] = array(
        'google_map' => array(
          'lat' => $lat,
          'lng' => $lng,
        ),
        'location_address' => '',
        'location_name'    => $rowRoute['route'],
      );
    }
    


    /* Set Default Map Area Using First Location */
    $map_area_lat = isset($locations[0]['google_map']['lat']) ? $locations[0]['google_map']['lat'] : '';
    $map_area_lng = isset($locations[0]['google_map']['lng']) ? $locations[0]['google_map']['lng'] : '';
    ?>

    var r_data = "<?= $r_data ?>";
    /* Do not drag on mobile. */
    var is_touch_device = 'ontouchstart' in document.documentElement;

    var map = new GMaps({
      el: '#google-map',
      lat: '<?php echo $map_area_lat; ?>',
      lng: '<?php echo $map_area_lng; ?>',
      scrollwheel: false,
      draggable: !is_touch_device
    });

    /* Map Bound */
    var bounds = [];


    <?php /* For Each Location Create a Marker. */
    foreach ($locations as $location) {
      $name = $location['location_name'];
      $addr = $location['location_address'];
      $map_lat = $location['google_map']['lat'];
      $map_lng = $location['google_map']['lng'];
    ?>
      /* Set Bound Marker */
      var latlng = new google.maps.LatLng(<?php echo $map_lat; ?>, <?php echo $map_lng; ?>);
      bounds.push(latlng);
      /* Add Marker */
      map.addMarker({
        lat: <?php echo $map_lat; ?>,
        lng: <?php echo $map_lng; ?>,
        title: '<?php echo $name; ?>',
        infoWindow: {
          content: '<p><?php echo $name; ?></p>'
        }
      });
    <?php } //end foreach locations 
    ?>

    /* Fit All Marker to map */
    map.fitLatLngBounds(bounds);

    /* Make Map Responsive */
    var $window = $(window);
    var size = $('.google-map-wrap').width();
    $('.google-map').css({
      width: size + 'px',
      height: (size / 2) + 'px'
    });
    $(window).resize(mapWidth);
</script>
    