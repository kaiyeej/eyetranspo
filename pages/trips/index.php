<div class="content-wrapper">
    <br>
    <div class="page-header flex-wrap">
        <div class="header-left">
            <h3 class="page-title">Trips</h3>
        </div>
        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
            <button type="button" onclick="addTrips()" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
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
                                <th>Bus</th>
                                <th>Schedule</th>
                                <th>Conductor</th>
                                <th>Headings</th>
                                <th>Status</th>
                                <th>Date Departed</th>
                                <th>Date Arrived</th>
                                <th>Date Added</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "modal_trip.php"; ?>
<script type="text/javascript">

    function addTrips(){
        $("#btn_arrived").hide();
        addModal();
    }

    function getTrips(id, status){
        if(status != "A"){
            $("#btn_arrived").show();
        }else{
            $("#btn_arrived").hide();
        }

        getEntryDetails(id);
        
    }

    function arrived() {
        $("#btn_arrived").prop('disabled', true);
        $("#btn_arrived").html("<span class='fa fa-spinner fa-spin'></span>");

        var id = $("#hidden_id").val();

        swal({
            title: "Are you sure?",
            text: "This entries will be mark arrived!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            cancelButtonClass: "btn-primary",
            confirmButtonText: "Yes, mark as arrived!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: "controllers/sql.php?c=" + route_settings.class_name + "&q=arrived",
                    data: {
                        input: {
                            id: id
                        }
                    },
                    success: function(data) {
                        getEntries();
                        var json = JSON.parse(data);
                        if (json.data == 1) {
                            success_arrived();
                            $("#modalEntry").modal('hide');
                        } else {
                            failed_query(json);
                        }
                    }
                });
            } else {
                swal("Cancelled", "Entries are safe :)", "error");
            }

            $("#btn_arrived").prop('disabled', false);
            $("#btn_arrived").html("<span class='mdi mdi-check-all'></span> Arrived");
        });
       
    }

    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
                "dataSrc": "data"
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return "<center><button class='btn btn-sm btn-danger' onclick='deleteEntry(" + row.trip_id + ")'><span class='mdi mdi-delete'></span></button><button class='btn btn-sm btn-info' onclick='getTrips(" + row.trip_id + ",\""+ row.status + "\")'><span class='mdi mdi-lead-pencil'></span></button></center>";
                    }
                },
                {
                    "data": "bus"
                },
                {
                    "data": "schedule"
                },
                {
                    "data": "conductor"
                },
                {
                    "data": "headings"
                },
                {
                    "mRender": function(data, type, row) {
                        return row.status == "A" ? "<strong style='color:green;'>Arrived</strong>" : row.status == "C" ? "<strong style='color:#f44336;'>Cancel</strong>" : row.status == "D" ? "<strong style='color:#ff9800;'>Departed</strong>" : "---" ;
                    }
                },
                {
                    "data": "date_departed"
                },
                {
                    "data": "date_arrived"
                },
                {
                    "data": "date_added"
                }
            ]
        });
    }

    $(document).ready(function() {
        getEntries();
        getSelectOption('Buses', 'bus_id', 'bus_number');
        getSelectOption('TripSchedule', 'trip_schedule_id', 'trip_schedule_time');
        getSelectOption('Users', 'user_id', 'user_fullname', "user_category = 'C'");
    });
</script>