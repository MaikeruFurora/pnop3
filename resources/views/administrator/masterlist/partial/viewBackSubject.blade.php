<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-3">
                @csrf
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Subject & Grade Level</th>
                            <th>Final Rating</th>
                            <th>Recomputed Final Grade</th>
                            <th>Remarks</th>
                            <th>Conducted From</th>
                            <th>Conducted To</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="viewTable"></tbody>
                </table>
            </div>
            <div class="modal-footer pt-0">
                <button type="button" class="btn btn-warning pl-2 pr-2" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>