<?php
$Homepage = new Homepage();
$con = new Connection();
?>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<div class="content-wrapper pb-0">
  <div class="row">
    <div class="col-sm-4 stretch-card grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="d-flex border-bottom mb-4 pb-2">
            <div class="hexagon">
              <div class="hex-mid hexagon-warning">
                <i class="mdi mdi-clock-outline"></i>
              </div>
            </div>
            <div class="ps-4">
              <h4 class="font-weight-bold text-warning mb-0"> <?= $Homepage->total_trips(); ?></h4>
              <h6 class="text-muted">Trip Schedule</h6>
            </div>
          </div>
          <div class="d-flex border-bottom mb-4 pb-2">
            <div class="hexagon">
              <div class="hex-mid hexagon-danger">
                <i class="mdi mdi-account-multiple"></i>
              </div>
            </div>
            <div class="ps-4">
              <h4 class="font-weight-bold text-danger mb-0"> <?= $Homepage->total_users(); ?></h4>
              <h6 class="text-muted">Users</h6>
            </div>
          </div>
          <div class="d-flex border-bottom mb-4 pb-2">
            <div class="hexagon">
              <div class="hex-mid hexagon-success">
                <i class="mdi mdi-seat-recline-normal"></i>
              </div>
            </div>
            <div class="ps-4">
              <h4 class="font-weight-bold text-success mb-0"> <?= $Homepage->total_drivers(); ?></h4>
              <h6 class="text-muted">Drivers</h6>
            </div>
          </div>
          <div class="d-flex border-bottom mb-4 pb-2">
            <div class="hexagon">
              <div class="hex-mid hexagon-info">
                <i class="mdi mdi-bus"></i>
              </div>
            </div>
            <div class="ps-4">
              <h4 class="font-weight-bold text-info mb-0"> <?= $Homepage->total_buses(); ?></h4>
              <h6 class="text-muted">Buses</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-8 stretch-card grid-margin">
      <div class="card" style="padding-top:10px;">
        <article id="map_canvas" class="entry">

          <header class="entry-header">
            <!-- <h1>Our Locations</h1> -->
          </header>

          <div class="entry-content">

            <?php /* === THIS IS WHERE WE WILL ADD OUR MAP USING JS ==== */ ?>
            <div class="google-map-wrap" itemscope itemprop="hasMap" itemtype="http://schema.org/Map">
              <div id="google-map" class="google-map">
              </div><!-- #google-map -->
            </div>

            <?php /* === MAP DATA === */ ?>


            <input type="text" id="r_location">

          </div><!-- .entry-content -->

        </article>
        <hr>
        <div class="card-body">
          <div class="table-responsive">
            <h3 style="color: #607d8b;">On-Going Trips</h3>
            <table id="dt_entries" class="table table-striped">
              <thead class="">
                <tr>
                  <th>#</th>
                  <th>Bus</th>
                  <th>Schedule</th>
                  <th>Date</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoePlR12j4XnPgKCc0YWpI_7rtI6TPNms&callback=initMap&v=weekly" defer></script>
<script type="text/javascript">
  function getEntries() {
    var param = "status='D'";
    $("#dt_entries").DataTable().destroy();
    $("#dt_entries").DataTable({
      "processing": true,
      "bInfo": false,
      "paging": false,
      "ajax": {
        "type": "POST",
        "url": "controllers/sql.php?c=Trips&q=show",
        "dataSrc": "data",
        "data": {
          input: {
            param: param
          }
        }
      },
      "columns": [{
          "data": "count"
        },
        {
          "data": "bus"
        },
        {
          "data": "schedule"
        },
        {
          "data": "date"
        }
      ]
    });
  }

  $(document).ready(function() {

    getEntries();
    map_loc();
  });

  setTimeout(function() {

  }, 5000);

  setInterval(myTimer, 30000);

  function myTimer() {
    const d = new Date();
    var location = $("#r_location").val();
    $.ajax({
      type: "POST",
      url: "controllers/sql.php?c=Users&q=loc_checker",
      data: {
        input: {
          location: location
        }
      },
      success: function(data) {
        var json = JSON.parse(data);
        console.log(json);
        if (json.data == 1) {
          //window.location.reload(1);
          //map_loc();
          $(".map_canvas").load("pages/homepage/index.php");
          map_loc();
        }
      }
    });
  }

  function map_loc() {
    <?php

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
    mapWidth();
    $(window).resize(mapWidth);
    
    $("#r_location").val(r_data);

  }

  function mapWidth() {
    var size = $('.google-map-wrap').width();
    $('.google-map').css({
      width: size + 'px',
      height: (size / 2) + 'px'
    });
  }
</script>