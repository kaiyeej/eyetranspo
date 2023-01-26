<div class="content-wrapper">
    <br>
    <div class="page-header flex-wrap">
        <div class="header-left">
            <h3 class="page-title">Drivers</h3>
        </div>
        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
            <button type="button" onclick="addDriver()" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
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
                                <th>Driver</th>
                                <th>Address</th>
                                <th>Contact #</th>
                                <th>Image</th>
                                <th>Date Added</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "modal_drivers.php"; ?>
<?php include "modal_upload.php"; ?>
<script type="text/javascript">

    function getDriverDetails(id){
        $("#div_image").hide();
        $("#driver_img").prop("disabled", true);
        getEntryDetails(id);
    }

    function addDriver(){
        addModal();
        $("#div_image").show();
        $("#driver_img").prop("disabled", false);
    }

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
                        return "<center><button class='btn btn-sm btn-danger' onclick='deleteEntry(" + row.driver_id + ")'><span class='mdi mdi-delete'></span></button><button class='btn btn-sm btn-info' onclick='getDriverDetails(" + row.driver_id + ")'><span class='mdi mdi-lead-pencil'></span></button></center>";
                    }
                },
                {
                    "data": "driver"
                },
                {
                    "data": "driver_address"
                },
                {
                    "data": "driver_contact_number"
                },
                {
                    "mRender": function(data, type, row) {
                        return row.driver_img == "" ? "<img style='width:70px;' src='assets/images/no_image.jpg' onclick=\"uploadImage('" + row.driver_id + "')\">" : "<img src='assets/drivers/" + row.driver_img + "' style='width: 70px;height: fit-content;border-radius: 0%;' onclick=\"uploadImage('" + row.driver_id + "')\">";
                    }
                },
                {
                    "data": "date_added"
                }
            ]
        });
    }

    function uploadImage(id) {
      // alert(id);
      $("#hidden_id_3").val(id);
      $("#modalUpload").modal('show');

    }

    $("#frm_upload_img_animal").submit(function(e) {
      e.preventDefault();

      //var formData = new FormData(this);
      $("#btn_submit").prop('disabled', true);
      $("#btn_submit").html("<span class='fa fa-spinner fa-spin'></span>");
      // console.log(formData);

      var url = "controllers/sql.php?c=" + route_settings.class_name + "&q=uploadImage";
      $.ajax({
        url: url,
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {

          var json = JSON.parse(data);
          if (json.data == 1) {
            $("#modalUpload").modal('hide');
            success_update();
            getEntries();

          }
            $("#btn_submit").prop('disabled', false);
            $("#btn_submit").html("Submit");
        }
      });

    });

    
    $(document).ready(function() {
        getEntries();
        getSelectOption('Drivers', 'driver_id', 'driver');
    });
</script>