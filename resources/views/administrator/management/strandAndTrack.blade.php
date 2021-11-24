@extends('../layout/app')
@section('content')
@include('administrator/management/partial/deleteModal')
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Manage Strand and Track</h2>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" style="font-size: 13px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Strand and Specialization</th>
                                        <th>Description</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="strandTable">
                                    <tr>
                                        <td colspan="5" class="text-center">No available data</td>
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
                        <form id="strandForm">@csrf
                            <input type="hidden" name="id" id="idForStrand">
                            <div class="form-group">
                                <label>Strand Name</label>
                                <input type="text" class="form-control" name="strand" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input name="description" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary btnSaveStrand">Submit</button>
                            <button type="submit" class="btn btn-warning cancelStrand">Cancel</button>
                        </form>
                    </div>
                </div>
            </div><!-- col-lg-4 -->
        </div><!-- row -->

    </div><!-- section-body -->
</section>
@endsection

@section('moreJs')
<script src="{{ asset('administrator/management/strand.js') }}"></script>
@endsection