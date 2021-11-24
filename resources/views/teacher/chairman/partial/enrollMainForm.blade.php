    <!-- Modal -->
  <div class="modal fade" id="mainForm" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Enrollment Maintenance</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pb-0">
            
            <ul class="nav nav-pills" id="myTab3" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true">Student</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false">History</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent2">
                <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                    {{--  --}}
                    <div class="form-group ">
                        <label for="">Fullname</label>
                        <input type="text" class="form-control" id="" readonly name="show_fullname">
                    </div>
                   <div class="form-row">
                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="">Learning Reference Number</label>
                            <input type="text" class="form-control" id="" readonly name="show_lrn">
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="">Strand | Specialized</label>
                            <input type="text" class="form-control" id="" readonly name="show_strand">
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label for="">Semester</label>
                            <input type="text" class="form-control" id="" readonly name="show_term">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-4 col-md-4 col-sm-4">
                            <label for="">Status</label>
                            <input type="text" class="form-control" id="" readonly name="show_status">
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4">
                            <label for="">State</label>
                            <input type="text" class="form-control" id="" readonly name="show_state">
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4">
                            <label for="">Section</label>
                            <input type="text" class="form-control" name="show_section" readonly>
                        </div>
                    </div>

                        <input type="hidden" name="enroll_id">
                        <input type="hidden" name="student_id">
                        <input type="hidden" name="term">
                        <input type="hidden" name="section_id">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered mt-2">
                                <thead>
                                    <tr>
                                        {{-- <input type="checkbox" id="selectAll"> --}}
                                        <th></th>
                                        <th>Subject Code</th>
                                        <th>Subject</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody id="studentSubjectList">
                                    <tr>
                                        <td colspan="3" class="text-center">No Data</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                           
                           <table class="table table-bordered mt-2">
                            <thead>
                                <tr>
                                    <th colspan="3">Back Subject with prerequisite</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>Subject Code</th>
                                    <th>Subject</th>
                                </tr>
                            </thead>
                            <tbody id="studentBackSubjectList">
                                <tr>
                                    <td colspan="3" class="text-center">No Data</td>
                                </tr>
                            </tbody>
                           </table>
                        </div>
                        {{--  --}}
                </div>
                <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                    {{--  --}}
                    <div class="input-group mb-3 mt-4">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="inputGroupSelect01">Filter</label>
                        </div>
                        {{-- <select class="custom-select" id="inputGroupSelect01">
                            <option value="">School year</option>
                            @foreach ($school_years as $item)
                            <option value="{{$item->id}}">{{ $item->from.'-'.$item->to }}</option>
                            @endforeach    
                          </select> --}}
                        <select class="custom-select" id="select_grade_level">
                          <option value="">Grade level</option>
                          <option value="11">Grade 11</option>
                          <option value="12">Grade 12</option>
                        </select>
                        <select class="custom-select" id="select_term">
                            <option value="1st">First term</option>
                            <option value="2nd">Second term</option>
                          </select>
                      </div>

                      <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Descriptive Title</th>
                                    <th>Grade</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody id="retriveGrade">
                                <tr>
                                    <td colspan="3" class="text-center">No data</td>
                                </tr>
                            </tbody>
                         </table>
                      </div>
                    {{--  --}}
                </div>
            </div>

        </div>
      </div>
    </div>
  </div>