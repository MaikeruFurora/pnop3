<div class="card card-info mt-4 shadow">
    <div class="card-body">
        <form id="assignForm">@csrf
            <div class="form-group">
                <div class="select-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <select class="custom-select select2" name="subject_id" required>
                                <option value="">Choose...</option>
                                @foreach ($subjects as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->subject_code.' > '.$item->descriptive_title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <select class="custom-select select2" name="teacher_id" required>
                                <option value="">Choose...</option>
                                @foreach ($teachers as $item)
                                <option value="{{ $item->id }}">{{ $item->teacher_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2">

                            @if (empty($activeAY))
                            <p>No active academic year</p>
                            @else
                            <select class="custom-select" name="term_assign">
                                @if ($activeAY->first_term=="Yes")
                                <option value="1st">1st Term</option>
                                @endif
                                @if ($activeAY->second_term=="Yes")
                                <option value="2nd">2nd Term</option>
                                @endif
                            </select>
                            @endif
                        </div>
                        <div class="col-lg-1">
                            <button class="btn btn-block btn-primary assignBtn " type="submit">Save</button>
                        </div>
                        <div class="col-lg-1">
                            <button class="btn btn-block btn-warning cancelNow" type="button">Cancel</button>
                        </div>
                    </div>



                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped" style="font-size: 11px">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject Name</th>
                        <th>Subject Teacher</th>
                        <th width="13%">Action</th>
                    </tr>
                </thead>
                <tbody id="tableAssign">
                </tbody>
            </table>
        </div>
        {{-- </div> --}}
    </div>
</div>