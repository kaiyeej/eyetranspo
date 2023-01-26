<form method='POST' id='frm_submit' class="buses">
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 50px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> Add Entry</h4>
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
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Heading</label>
                                <input type="text" class="form-control input-item" name="input[headings]" id="headings" placeholder="Heading" maxlength="10" autocomplete="off" required>
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