<!-- Modal -->
<div class="modal fade" id="enrolledSubjectModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"></h5>
            </div>
            <div class="modal-body pb-0">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card card-info">
                            <div class="card-header pb-0 pt-0">
                                <h4 class="text-black font-weight-lighter">Student Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="media">
                                    <img alt="image" class="mr-3 rounded-circle" width="50"
                                        src="{{ asset('image/avatar-1.png') }}">
                                    <div class="media-body">
                                        <div class="media-title selected-name"></div>
                                        <div class="text-job text-muted selected-lrn"></div>
                                        <div class="text-job text-muted selected-id"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--  fail subject --}}
                        <div class="card card-info">
                            <div class="card-header pb-0 pt-0">
                                <h4 class="text-black font-weight-lighter">Back Subject&nbsp;&nbsp;<i
                                        class="fas fa-exclamation-triangle" style="font-size: 20px"></i></h4>
                            </div>
                            <div class="card-body pl-1 pr-1" style="font-size: 12px">
                                <ul class="list-group list-group-flush" id="showFailSubject">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="card card-info">
                            <div class="card-header pb-0 pt-0">
                                <h4 class="text-black font-weight-lighter">Enroll Subject</h4>
                                <div class="card-header-action">
                                    <span class="showAlert"></span>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="AddFormSubject">@csrf
                                    <input type="hidden" name="student_id">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select class="custom-select" name="assign_subject_id" required>
                                            </select>
                                            <div class="input-group-append">
                                                <button type="submit"
                                                    class="btn btn-primary addOn pl-4 pr-4">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <table class="table table-striped" style="font-size:11px">
                                    <thead>
                                        <tr>
                                            <th witdh="8%">#</th>
                                            <th witdh="84%">Subject(s)</th>
                                            <th witdh="8%">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody id="showSubjectSelect">
                                        <tr>
                                            <td colspan="3" class="text-center">No Subject Available</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                <button type="button" class="btn btn-secondary closeModal">Close</button>
            </div>
        </div>
    </div>
</div>