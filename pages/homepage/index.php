<?php
$Homepage = new Homepage();
?>
<div class="content-wrapper pb-0">
  <div class="row">
    <div class="col-sm-5 stretch-card grid-margin">
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
    <div class="col-xl-7 stretch-card grid-margin">
      <div class="card" style="padding-top:30px;">
       <img src="assets/images/logo-banner.png">
      </div>
    </div>
  </div>
</div>