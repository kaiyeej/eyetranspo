<form method='POST' id='frm_submit' class="buses">
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 50px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"><span class='fa fa-pen'></span> Add Entry</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id" name="input[bus_id]">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Bus #</label>
                                <input type="text" class="form-control input-item" name="input[bus_number]" id="bus_number" placeholder="Bus number" maxlength="50" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Driver</label>
                                <select class="js-example-basic-single form-control input-item" style="width: 100%;" name="input[driver_id]" id="driver_id" required>
                                    <option value="">&mdash; Please Select &mdash;</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Plate #</label>
                                <div>
                                    <input type="text" class="form-control input-item" name="input[bus_plate_number]" id="bus_plate_number" placeholder="Bus plate number" maxlength="50" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Operator</label>
                                <div>
                                    <input type="text" class="form-control input-item" name="input[bus_operator]" id="bus_operator" placeholder="Bus operator" maxlength="50" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Capacity</label>
                                <div>
                                    <input type="number" class="form-control input-item" name="input[bus_max_capacity]" autocomplete="off" id="bus_max_capacity" placeholder="Maximum capacity" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Route</label>
                                <div>
                                    <input type="text" class="form-control input-item" name="input[bus_route]" autocomplete="off" id="bus_route" placeholder="Bus Route" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <div>
                                    <textarea class="form-control input-item" name="input[bus_remarks]" autocomplete="off" id="bus_remarks" placeholder="Bus remarks"></textarea>
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