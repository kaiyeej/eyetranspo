<form method='POST' id='frm_submit' class="drivers">
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 50px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> Add Entry</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id" name="input[driver_id]">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control input-item" name="input[driver_fname]" id="driver_fname" placeholder="Driver first name" maxlength="50" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input type="text" class="form-control input-item" name="input[driver_mname]" id="driver_mname" placeholder="Driver middle name" maxlength="50" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control input-item" name="input[driver_lname]" id="driver_lname" placeholder="Driver last name" maxlength="50" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Contact #</label>
                                <input type="text" class="form-control input-item" name="input[driver_contact_number]" id="driver_contact_number" placeholder="Driver contact number" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Address</label>
                                <div>
                                    <textarea class="form-control input-item" name="input[driver_address]" autocomplete="off" id="driver_address" placeholder="Driver address"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <div>
                                    <textarea class="form-control input-item" name="input[driver_remarks]" autocomplete="off" id="driver_remarks" placeholder="Remarks"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" id="div_image">
                            <div class="form-group">
                                <label>Image</label>
                                <div>
                                    <input type="file" class="form-control" name="file" id="driver_img" autocomplete="off">
                                </div>
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