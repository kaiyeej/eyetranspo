<div class="content-wrapper">
    <br>
    <div class="page-header flex-wrap">
        <div class="header-left">
            <h3 class="page-title">Bus History</h3>
        </div>
    </div>
    <div class="row">
        <div class="card" style="background: #dde2ff;border: 2px dashed #283593;">
            <div class="card-body row">
                <div class="col-md-4">
                    <label><strong>Bus</strong></label>
                    <select class="form-control input-item" style="width: 100%;height: 35px;" name="input[bus_id]" id="bus_id" required>
                        <option value="">Please Select:</option>
                    </select>
                </div>
                <div class="col-md-8" style="padding-top: 20px;">
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
                    <table id="dt_entries" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Bus</th>
                                <th>Schedule</th>
                                <th>Conductor</th>
                                <th>Headings</th>
                                <th>Status</th>
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
        var bus_id = $("#bus_id").val();
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "paging": false,
            "info": false,
            "bFilter": false,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
                "dataSrc": "data",
                "method": "POST",
                "data": {
                    input: {
                        bus_id: bus_id
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
                        return row.status == "A" ? "<strong style='color:green;'>Arrived</strong>" : row.status == "C" ? "<strong style='color:#f44336;'>Cancel</strong>" : row.status == "D" ? "<strong style='color:#ff9800;'>Departed</strong>" : "---";
                    }
                },
            ]
        });
    }

    $(document).ready(function() {
        getSelectOption('Buses', 'bus_id', 'bus_number', '', [], -1, 'All');
        getEntries();
        
    });
</script>