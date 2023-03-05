<form method='POST' id='frm_submit' class="buses">
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 50px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> Add Entry</h4>
                    <button class="btn btn-info btn-sm" id="btn_arrived" onclick="arrived()"><i class="mdi mdi-check-all"></i> Arrived</button>
                    <button class="btn btn-primary btn-sm" id="btn_departed" onclick="departed()"><i class="mdi mdi-bus"></i> Departed</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id" name="input[trip_id]">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Bus</label>
                                <select class="js-example-basic-single form-control input-item" style="width: 100%;" name="input[bus_id]" id="bus_id" required>
                                    <option value="">Please Select:</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Schedule</label>
                                <select class="js-example-basic-single form-control input-item" style="width: 100%;" name="input[trip_schedule_id]" id="trip_schedule_id" required>
                                    <option value="">Please Select:</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Conductor</label>
                                <select class="js-example-basic-single form-control input-item" style="width: 100%;" name="input[user_id]" id="user_id" required>
                                    <option value="">Please Select:</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Date Departed</label>
                                <input type="datetime-local" class="form-control input-item" name="input[date_departed]" id="date_departed"  autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Date Arrived</label>
                                <input type="datetime-local" class="form-control input-item" name="input[date_arrived]" id="date_arrived" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-12" style="display: none;">
                            <div class="form-group">
                                <label>Heading</label>
                                <select class="js-example-basic-single form-control input-item" style="width: 100%;" name="input[headings]" id="headings">
                                    <option value="">Please Select:</option>
                                    <option value="TO BACOLOD">TO BACOLOD</option>
                                    <option value="TO LA CASTELLANA">TO LA CASTELLANA</option>
                                </select>
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