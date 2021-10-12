<form id="importForm" enctype="multipart/form-data">@csrf
    <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Import Grade</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pb-1">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button class="btn btn-outline-secondary" type="button" id="button-addon1">CSV Format</button>
                </div>
                <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="inputGroupFile02">
                    <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                  </div>
            </div>
            <p>
                Download excel file format <a href="">here</a>
            </p>
        </div>
        <div class="modal-footer p-2">
          <button type="button" class="btn btn-secondary clickCancel" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btnImportNow">Import Now</button>
        </div>
      </div>
    </div>
  </div>
</form>