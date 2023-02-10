<?php
$Homepage = new Homepage();
?>
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
        <center><img style="width: 80%;" src="assets/images/logo-banner.png"></center>
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
<script type="text/javascript">
  function getEntries() {
    var param = "status='D'";
    $("#dt_entries").DataTable().destroy();
    $("#dt_entries").DataTable({
      "processing": true,
      "bInfo": false,
      "paging": false,
      "ajax": {
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
  });
</script>