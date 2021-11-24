<form id="holidayForm">@csrf
    <div class="modal fade" id="holidayModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="holidayModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content pb-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="holidayModalLabel"> Event &amp; Holiday</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label>Select date from</label>
                        <input class="form-control datepicker1" name="holi_date_from" required>
                    </div>
                    <div class="form-group">
                        <label>Select date to</label>
                        <input class="form-control datepicker2" name="holi_date_to">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" data-height="80" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="mystatus">Status</label>
                        <select id="mystatus" class="form-control" name="status" required>
                            <option value="Enable">Enable</option>
                            <option value="Disable">Disable</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btnCancelHoliday">Close</button>
                    <button type="submit" class="btn btn-primary btnSaveHoliday">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>