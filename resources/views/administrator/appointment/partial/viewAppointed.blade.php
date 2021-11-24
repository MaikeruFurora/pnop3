<!-- Modal -->
<div class="modal fade" id="appointedModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="appointedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointedModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="table-responsive">
                <div class="float-left">
                    <button type="button" class="btn btn-icon icon-left btn-primary mr-3" id="printAppointed">
                        <i class="fas fa-print"></i> Print Now
                    </button>
                    <button type="button" class="btn btn-icon icon-left btn-primary mr-3" id="btnSendEmail">
                        <i class="fa fa-paper-plane"></i> Send Email for All
                    </button>
                </div>
                <table class="table table-striped" id="appointedTable" style="font-size: 12px;width:100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th width="13%">Transaction No.</th>
                            <th width="15%">Name</th>
                            <th width="15%">Contact</th>
                            <th width="10%">Email</th>
                            <th width="25%">Address</th>
                            <th>Purpose</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
               </div>
               
               <form class="was-validated mt-5" id="sendEmailForm">
                <div class="mb-3">
                  <h6>Compose email message</h6>
                  <input type="hidden" name="selectedDateNow">
                  <textarea name="bodyEmail" class="summernote"  data-height="50" placeholder="Compose message here" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btnSendEmail">Send</button>
                <button type="button" class="btn btn-warning sendCancel">Close</button>
               </form>
            </div>
        </div>
    </div>
</div>