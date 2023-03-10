<div class="content-wrapper">
    <br>
    <div class="page-header flex-wrap">
        <div class="header-left">
            <h3 class="page-title">Daily VIP Passenger</h3>
        </div>
    </div>
    <div class="row">
        <div class="card" style="background: #dde2ff;border: 2px dashed #283593;">
            <div class="card-body row">
                <div class="col-md-4">
                    <label><strong>Date</strong></label>
                    <input type='date' class="form-control input-item" style="width: 100%;height: 35px;" name="input[date_added]" id="date_added" value="<?= date('Y-m-d'); ?>" required>
                </div>
                <div class="col-md-4">
                    <label><strong>Route</strong></label>
                    <select class="form-control input-item" style="width: 100%;height: 35px;" name="input[route_name]" id="route_name" required>
                        <option value="-1">&mdash; ALL &mdash;</option>
                        <option value="TO LA CASTELLANA">TO LA CASTELLANA</option>
                        <option value="TO BACOLOD">TO BACOLOD</option>
                    </select>
                </div>
                <div class="col-md-4" style="padding-top: 20px;">
                    <div class="btn-group">
                        <button type="submit" id="btn_generate" onclick="getEntries()" class="btn btn-primary btn-sm">
                            <span class="icon">
                                <i class="mdi mdi-reload"></i>
                            </span>
                            <span class="text"> Generate</span>
                        </button>
                        <button type="button" onclick="print_report('report_container')" class="btn btn-secondary btn-sm">
                            <span class="icon">
                                <i class="mdi mdi-printer"></i>
                            </span>
                            <span class="text"> Print</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="card" style="border: 1px dashed #c82a2b;">
            <div class="card-body">
                <div id="report_container">
                    <center>
                        <h4 class="page-title">Daily VIP Passenger Report</h4>
                        <span style="font-size: 12px;">LC Star Transport Cooperative</span>
                        <br><br>
                    </center>
                    <table id="dt_entries" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Bus</th>
                                <th>Trip</th>
                                <!-- <th>Fare</th> -->
                                <th>Passenger</th>
                                <th>Complaints</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    function getEntries() {
        var route_name = $("#route_name").val();
        var date_added = $("#date_added").val();
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "paging": false,
            "info": false,
            "bFilter": false,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show_daily",
                "dataSrc": "data",
                "method": "POST",
                "data": {
                    input: {
                        route_name: route_name,
                        date_added:date_added
                    }
                },
            },
            "columns": [{
                    "data": "count"
                },
                {
                    "data": "bus"
                },
                {
                    "data": "trip"
                },
                // {
                //     "data": "fare"
                // },
                {
                    "data": "passenger"
                },
                {
                    "data": "remarks"
                }
            ]
        });
    }

    $(document).ready(function() {
        //getSelectOption('Users', 'user_id', 'user_fullname', 'user_category="U" OR user_category="P"', [], -1, 'All');
        getEntries();
        
    });
</script>