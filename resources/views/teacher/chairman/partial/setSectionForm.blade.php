<form id="setSectionForm">@csrf
    <div class="modal fade" id="setSectionModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Assign Section</h5>
                </div>
                <div class="modal-body pb-0">
                    <div class="alert alert-warning text-center" role="alert"></div>
                    <input type="hidden" name="enroll_id">
                    <input type="hidden" name="status_now">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control nameOfStudent" readonly>
                    </div>
                    <div class="form-group mt-2">
                        <label for="sectionFilter">Section</label>
                        <select class="form-control" id="sectionFilter" name="section" required></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btnCancelSectionNow">Cancel</button>
                    <button type="submit"
                        class="btn btn-primary btnSaveSectionNow">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
                </div>
            </div>
        </div>
    </div>
</form>