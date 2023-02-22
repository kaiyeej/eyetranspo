<style>
    #password-strength-status {
        padding: 5px 10px;
        border-radius: 4px;
        margin-top: 5px;
    }

    .medium-password {
        background-color: #fd0;
    }

    .weak-password {
        background-color: #FBE1E1;
    }

    .strong-password {
        background-color: #D5F9D5;
    }
</style>
<div class="content-wrapper">
    <br>
    <div class="page-header flex-wrap">
        <div class="header-left">
            <h3 class="page-title">Users</h3>
        </div>
        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
            <button type="button" onclick="addUser()" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                <i class="mdi mdi-plus-circle"></i> Add
            </button>
            <button style="background: #00cff4;" type="button" onclick="approvedUser()" class="btn btn-info mt-2 mt-sm-0 btn-icon-text">
                <i class="mdi mdi-check-circle" style="background: #0aa7c3;"></i> Verify
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
                                <th><input type='checkbox' onchange="checkAll(this, 'dt_id')"></th>
                                <th></th>
                                <th>Fullname</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Username</th>
                                <th>ID</th>
                                <th>Date Added</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "modal_user.php"; ?>
<?php include "modal_upload.php"; ?>
<script type="text/javascript">
    var pass_status = 0;

    function addUser() {
        addModal();
        $("#div_password").show();
        pass_status = 0;
    }

    function getUserDetails(id) {
        $("#div_password").hide();
        getEntryDetails(id);
        pass_status = 1;
    }

    function checkPasswordStrength() {
        var number = /([0-9])/;
        var alphabets = /([a-zA-Z])/;
        var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
        var password = $('#password').val().trim();
        if (password.length < 6) {
            $('#password-strength-status').removeClass();
            $('#password-strength-status').addClass('weak-password');
            $('#password-strength-status').html("Weak (should be atleast 6 characters.)");
        } else {
            if (password.match(number) && password.match(alphabets) && password.match(special_characters)) {
                $('#password-strength-status').removeClass();
                $('#password-strength-status').addClass('strong-password');
                $('#password-strength-status').html("Strong");
                pass_status = 1;
            } else {
                $('#password-strength-status').removeClass();
                $('#password-strength-status').addClass('medium-password');
                $('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
            }
        }
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
                        return row.status == "A" ? "" : "<input type='checkbox' value=" + row.user_id + " class='dt_id'>";
                    }
                }, {
                    "mRender": function(data, type, row) {
                        return "<center><button class='btn btn-sm btn-danger' onclick='deleteEntry(" + row.user_id + ")'><span class='mdi mdi-delete'></span></button><button class='btn btn-sm btn-info' onclick='getUserDetails(" + row.user_id + ")'><span class='mdi mdi-lead-pencil'></span></button></center>";
                    }
                },
                {
                    "data": "user_fullname"
                },
                {
                    "data": "category"
                },
                {
                    "mRender": function(data, type, row) {
                        return row.status == "A" ? "<strong style='color:green'>Verified</strong>" : (row.status == "B" ? "<strong style='color:red'>Blocked</strong>" : "<strong style='color:orange'>Pending</strong>");
                    }
                },
                {
                    "data": "username"
                },
                {
                    "mRender": function(data, type, row) {
                        return row.user_img == "" ? "<img style='width:70px;' src='assets/images/no_image.jpg' onclick=\"uploadImage('" + row.user_img + "')\">" : "<img src='assets/pwd_id_images/" + row.user_img + "' style='width: 70px;height: fit-content;border-radius: 0%;' onclick=\"uploadImage('" + row.user_img + "')\">";
                    }
                },
                {
                    "data": "date_added"
                }
            ]
        });
    }

    
    function uploadImage(user_img) {
      // alert(user_img);
      if(user_img != ""){
        $("#div_pwd_id").html("<img class='img-fluid' src='assets/pwd_id_images/" + user_img + "'>");
      }else{
        $("#div_pwd_id").html("<center><h4>No image found.</h4></center>");
      }
      
      $("#modalUpload").modal('show');

    }

    $(document).ready(function() {
        getEntries();

    });
</script>