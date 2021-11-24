@extends('../layout/app')
@section('moreCss')
<link rel="stylesheet" href="{{ asset('css/datatable/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatable/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
@endsection

<!-- Modal -->
<form id="shsForm">@csrf
<div class="modal fade" id="shsModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">SHS SUBJECT</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         
                <input type="hidden" name="shs_id">
               <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Indidate type</label>
                        <select class="custom-select" name="shs_indicate_type" required>
                            <option value="">Choose type</option>
                            <option value="Core">Core</option>
                            <option value="Specialized">Specialized</option>
                            <option value="Applied">Applied</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Grade level</label>
                        <select class="custom-select" name="shs_grade_level">
                            <option value="">Grade Level</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Strand</label>
                        <select class="custom-select" name="shs_strand_id">
                            <option value="">Choose strand</option>
                            <option value="all">All strand</option>
                            @foreach ($strands as $item)
                            <option value="{{ $item->id }}">{{ $item->strand }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" class="form-control" placeholder="Subject Code" name="shs_subject_code" required>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Descriptive title</label>
                        <input type="text" class="form-control" placeholder="Decriptive Title"  name="shs_descriptive_title" required>
                    </div>
                    <div class="form-group">
                        <label>Term</label>
                        <select class="custom-select" id="" name="shs_term">
                            <option value="1st">First Term</option>
                            <option value="2nd">Second Term</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Prerequisite</label>
                        <select name="shs_prerequisite" class="form-control select2" id="mySelect2">
                            <option value=""></option>
                            @foreach ($subjects as $item)
                            <option value="{{ $item->id }}"><b>{{ $item->subject_code }}</b>{{ ' - '.$item->descriptive_title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
               </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btnClose" data-dismiss="modal">Close</button>
          <button class="btn btn-warning cancelSHS" type="button">Cancel</button>
          <button type="submit" class="btn btn-primary btnSHSsave">Save</button>
        </div>
      </div>
    </div>
  </div>
</form>
  {{--  --}}
  @include('administrator/management/partial/deleteModal')
@section('content')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Manage Subject for Junior High</h2>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right">
                            <div class="form-row align-items-center mt-3 ml-4 pb-0">

                                <div class="col-auto my-1">
                                    <select class="custom-select mr-sm-2" id="selectedGL">
                                        <option value="7">Grade 7</option>
                                        <option value="8">Grade 8</option>
                                        <option value="9">Grade 9</option>
                                        <option value="10">Grade 10</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" style="font-size: 11px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subject Code</th>
                                        <th>Descriptive Title</th>
                                        <th>Type</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="subjectTable">
                                    <tr>
                                        <td colspan="6" class="text-center">No available data</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- col-lg-8 -->
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body m-1">
                        <form id="subjectForm">@csrf
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label>Grade Level</label>
                                <select name="grade_level" class="form-control" required>
                                    <option value="7">Grade 7</option>
                                    <option value="8">Grade 8</option>
                                    <option value="9">Grade 9</option>
                                    <option value="10">Grade 10</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Subject Code</label>
                                <input type="text" class="form-control" name="subject_code" required>
                            </div>
                            <div class="form-group">
                                <label>Descriptive Title</label>
                                <input type="text" class="form-control" name="descriptive_title" required>
                            </div>
                            <div class="form-group" id="forJHS">
                                <label>Type</label>
                                <select name="subject_for" class="form-control">
                                    <option value="GENERAL">General</option>
                                    <option value="STEM">STEM - Science Technology Engineering and Mathematics</option>
                                    <option value="BEC">BEC - Basic Education Curriculum</option>
                                    <option value="SPA">SPA - Special Program Art</option>
                                    <option value="SPJ">SPJ - Special Program Journalism</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btnSaveSubject">Submit</button>
                            <button type="submit" class="btn btn-warning cancelSubject">Cancel</button>
                        </form>
                    </div>
                </div>
            </div><!-- col-lg-4 -->
        </div><!-- row -->
        <!--
        
            for senior high

        -->
        
        <h2 class="section-title">Manage Subject for Senior High</h2>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Configure</h4>
                        <div class="card-header-action">
                            <button class="btn btn-primary add_subject">
                              ADD SUBJECT
                            </button>
                          </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                               <div class="input-group mb-5 mt-4">
                                   <div class="input-group-prepend">
                                       <label class="input-group-text" for="inputGroupSelect01">Filter</label>
                                     </div>
                                   <select class="custom-select" id="" name="filter_strand">
                                    @foreach ($strands as $item)
                                    <option value="{{ $item->id }}">{{ $item->strand }}</option>
                                    @endforeach
                                   </select>
                                   
                                   <select class="custom-select" name="filter_grade_level">
                                    <option value="11">Grade 11</option>
                                    <option value="12">Grade 12</option>
                                  </select>

                                   <select class="custom-select" id="" name="filter_term">
                                       <option value="1st">First Term</option>
                                       <option value="2nd">Second Term</option>
                                     </select>
                                 </div>
                        <table class="table table-striped" id="shsTable">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    {{-- <th>Strand</th> --}}
                                    <th>Subject Code</th>
                                    <th>Descriptive Title</th>
                                    <th>Prerequisite</th>
                                    <th>Action Taken</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- section-body -->
</section>
@endsection

@section('moreJs')
<script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/select2/select2.full.min.js') }}"></script>>
<script src="{{ asset('administrator/management/subject.js') }}"></script>
<script src="{{ asset('administrator/management/subject.shs.js') }}"></script>
@endsection