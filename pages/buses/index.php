<div class="content-wrapper">
    <br>
    <div class="page-header flex-wrap">
        <div class="header-left">
            <h3 class="page-title">Buses</h3>
        </div>
        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
            <button type="button" onclick="addModal()" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                <i class="mdi mdi-plus-circle"></i> Add
            </button>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dt_entries" class="table table-striped">
                        <thead class="">
                            <tr>
                                <th></th>
                                <th>Bus #</th>
                                <th>Driver</th>
                                <th>Plate #</th>
                                <th>Operator</th>
                                <th>Capacity</th>
                                <th>Date Added</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "modal_buses.php"; ?>
<script type="text/javascript">

    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
                "dataSrc": "data"
            },
            "columns": [
                {
                    "mRender": function(data, type, row) {
                        return "<center><button class='btn btn-sm btn-danger' onclick='deleteEntry(" + row.bus_id + ")'><span class='mdi mdi-delete'></span></button><button class='btn btn-sm btn-info' onclick='getEntryDetails(" + row.bus_id + ")'><span class='mdi mdi-lead-pencil'></span></button></center>";
                    }
                },
                {
                    "data": "bus_number"
                },
                {
                    "data": "driver"
                },
                {
                    "data": "bus_plate_number"
                },
                {
                    "data": "bus_operator"
                },
                {
                    "data": "bus_max_capacity"
                },
                {
                    "data": "date_added"
                }
            ]
        });
    }
    
    $(document).ready(function() {
        getEntries();
        getSelectOption('Drivers', 'driver_id', 'driver');
        getSelectOption('BusRoutes', 'route_id', 'route_name');
    });
</script>