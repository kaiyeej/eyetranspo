<div class="content-wrapper">
    <br>
    <div class="page-header flex-wrap">
        <div class="header-left">
            <h3 class="page-title">Transactions</h3>
        </div>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dt_entries" class="table table-striped">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Bus</th>
                                <th>Trip</th>
                                <th>User</th>
                                <th>Fare</th>
                                <th>Remarks</th>
                                <th>Status</th>
                                <th>Date Added</th>
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
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
                "dataSrc": "data"
            },
            "columns": [
                {
                    "data": "count"
                },
                {
                    "data": "bus"
                },
                {
                    "data": "trip"
                },
                {
                    "data": "user"
                },
                {
                    "data": "fare"
                },
                {
                    "data": "remarks"
                },
                {
                    "mRender": function(data, type, row) {
                        return row.status == "F" ? "<strong style='color:green;'>Finished</strong>" : row.status == "C" ? "<strong style='color:#f44336;'>Cancel</strong>" : "Pending" ;
                    }
                },
                {
                    "data": "date_added"
                }
            ]
        });
    }
    
    $(document).ready(function() {
        getEntries();
    });
</script>