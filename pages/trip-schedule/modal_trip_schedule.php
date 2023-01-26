<form method='POST' id='frm_submit' class="buses">
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 50px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> Add Entry</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id" name="input[trip_schedule_id]">
                    <div class="row">
                        <!-- <div class="col-lg-12">
                            <div class="form-group">
                                <label>Marker</label>
                                <input type="text" class="form-control input-item" name="input[trip_schedule_marker]" id="trip_schedule_marker"  autocomplete="off" required>
                            </div>
                        </div> -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Time</label>
                                <input type="time" class="form-control input-item" name="input[trip_schedule_time]" id="trip_schedule_time"  autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Route</label>
                                <select class="js-example-basic-single form-control input-item" style="width: 100%;" name="input[route_id]" id="route_id" required>
                                    <option value="">Please Select:</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Fare</label>
                                <input type="number" class="form-control input-item" name="input[trip_schedule_fare]" id="trip_schedule_fare" placeholder="Fare" step="0.01" autocomplete="off" required>
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