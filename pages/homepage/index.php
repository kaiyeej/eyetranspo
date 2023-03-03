<?php
$Homepage = new Homepage();
$con = new Connection();
?>
<style>
  #map {
    width: 100%;
    height: 400px;
  }
</style>
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
        <div id="map"></div>
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

  <input type="hidden" id="r_location">
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
    checker_loc()
  });

  setInterval(myTimer, 10000);

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
          initMap();
          checker_loc();
        }
      }
    });
  }



  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: {
        lat: 10.52633,
        lng: 122.94318
      }
    });

    setMarkers(map);
  }


  function setMarkers(map) {
    // var dest_locations = [];
    $.ajax({
      type: "POST",
      url: "controllers/sql.php?c=Users&q=location",
      data: {
        // input: {
        //   location: location
        // }
      },
      success: function(data) {
        var jsonParse = JSON.parse(data);

        //console.log(jsonParse.data);


        var dest_locations = jsonParse.data;
        for (var i = 0; i < dest_locations.length; i++) {
          var beach = dest_locations[i];
          var marker = new google.maps.Marker({
            position: {
              lat: beach[1],
              lng: beach[2]
            },
            map: map,
            title: beach[0],
            zIndex: beach[3]
          });
        }
      }
    });
  }

  
  function checker_loc() {
      $.ajax({
        type: "POST",
        url: "controllers/sql.php?c=Users&q=get_loc",
        success: function(data) {
          var jsonParse = JSON.parse(data);
          console.log(jsonParse.data);
          $("#r_location").val(jsonParse.data);
        }

      });
    }
</script>