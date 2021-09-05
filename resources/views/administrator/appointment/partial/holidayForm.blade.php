<form id="exportForm">@csrf
    <div class="modal fade" id="holidayForm" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="holidayFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content pb-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="holidayFormLabel">Holiday</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <div class="form-group">
                        <label for="myFormat">Select Date</label>
                        <input class="form-control datepicker">
                    </div>
                    <div class="form-group">
                        <label for="myFormat">Description</label>
                        <textarea class="form-control" data-height="80"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="mystatus">Status</label>
                        <select id="mystatus" class="form-control">
                            <option value="Enable">Enable</option>
                            <option value="Disable">Disable</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btnCancelHoliday" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnSaveHoliday">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>