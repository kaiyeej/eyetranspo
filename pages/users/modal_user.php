<form method='POST' id='frm_submit' class="users">
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 50px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> Add Entry</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id" name="input[user_id]">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>First name</label>
                                <input type="text" class="form-control input-item" name="input[user_fname]" id="user_fname" placeholder="User first name" maxlength="50" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Middle name</label>
                                <div>
                                    <input type="text" class="form-control input-item" name="input[user_mname]" id="user_mname" placeholder="User middle name" maxlength="50" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Last name</label>
                                <div>
                                    <input type="text" class="form-control input-item" name="input[user_lname]" id="user_lname" placeholder="User last name" maxlength="50" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="js-example-basic-single form-control input-item" style="width: 100%;" name="input[user_category]" id="user_category" required>
                                    <option value="">&mdash; Please Select &mdash;</option>
                                    <option value="A">Admin</option>
                                    <option value="U">Passenger</option>
                                    <option value="C">Conductor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Contact #</label>
                                <div>
                                    <input type="text" class="form-control input-item" name="input[user_contact_number]" autocomplete="off" id="user_contact_number" placeholder="Contact number" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Username</label>
                                <div>
                                    <input type="text" class="form-control input-item" name="input[username]" autocomplete="off" id="username" placeholder="Username" maxlength=15 required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div id="div_password" class="form-group">
                                <label>Password</label>
                                <div>
                                    <input type="text" class="form-control input-item" name="input[password]" autocomplete="off" id="password" onkeyup="checkPasswordStrength();"  placeholder="Password" required>
                                </div>
                                <div id="password-strength-status"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" id="btn_submit" class="btn btn-success">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>