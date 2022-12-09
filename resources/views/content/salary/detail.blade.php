@extends('layouts/contentLayoutMaster')

@section('title', 'Salaries')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{asset('css/base/pages/ui-feather.css')}}">
@endsection
  
@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header border-bottom">
                <input type="hidden" id="salary_id" value="{{$item->id}}">
                <strong>{{$item->name}}</strong> 
                @role('Super Admin')
                    <strong>{{$item->company->name ?? ''}}</strong>
                @endrole
            </div>
            <div class="card-body p-2">
                <div class="row mb-2">
                    <div class="col-md-2">
                        Code
                    </div>
                    <div class="col-md-3">
                        : <strong>{{$item->code}}</strong>
                    </div>
                    <div class="col-md-3">
                        Nominal 
                    </div>
                    <div class="col-md-4">
                        : <strong>Rp {{number_format($item->nominal,0,",",".");}},-</strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card shadow-none bg-transparent border-primary">
                            <div class="card-header border-bottom">
                                <strong>Applied to</strong>
                                <div class="filter">
                                    <select name="" id="filter_month" class="form-select select2">
                                        @foreach ($months as $month)
                                            <option value="{{$month['value']}}" @if($month['value'] == date('m-Y')) selected @endif>{{$month['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-outline-primary waves-effect" data-bs-toggle="modal" data-bs-target="#importModal">
                                        <i data-feather="file"></i> Import
                                    </button>
                                    <button type="button" class="btn btn-outline-primary waves-effect" data-bs-toggle="modal" data-bs-target="#addNewRecord">
                                        <i data-feather="plus"></i> Apply
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <table class="datatables-basic table">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Employee</th>
                                        <th>Nominal</th>
                                        <th>Actions</th>
                                      </tr>
                                    </thead>
                                  </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal to add new record -->
<div class="modal fade text-start" id="addNewRecord" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="addNewRecordLabel">Apply {{$item->name}}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formNewRecord">
            <div class="modal-body">
            <input type="hidden" id="item_id">
            <div class="row mb-1">
                <div class="col">
                <label class="form-label">Department<span class="text-danger">*</span></label>
                <select name="department" id="department" class="select2 form-control">
                    <option value="">Select Department</option>
                    @foreach ($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col">
                <label class="form-label">Employees<span class="text-danger">*</span></label>
                <select name="employees" id="employees" class="select2"></select>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col">
                <label class="form-label">Nominal<span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="text" class="form-control" id="nominal" placeholder="Nominal" name="nominal" value="{{number_format($item->nominal,0,",",".");}}">
                </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
            <button type="submit" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit"><i data-feather="save"></i> Save</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal to editrecord -->
<div class="modal fade text-start" id="editRecord" tabindex="-1" aria-labelledby="editRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="editRecordLabel">Edit Salary</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formEditRecord">
            <div class="modal-body">
            <input type="hidden" id="edit_id">
            <div class="row mb-1">
                <div class="col">
                <label class="form-label">Nominal<span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="text" class="form-control" id="edit_nominal" placeholder="Nominal" name="nominal">
                </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
            <button type="submit" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit"><i data-feather="save"></i> Save</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal to Import -->
<div class="modal fade text-start" id="importModal" tabindex="-1" aria-labelledby="importModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="importModalLabel">Import Employee Salary</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formImport">
          <div class="modal-body">
            <input type="hidden" name="salary_id" id="salary_id" value="{{$item->id}}">
            <input type="hidden" name="salary_name" id="salary_name" value="{{$item->name}}">
            <input type="file" name="file" id="file" class="form-control">
            <hr>
            <i>Download template <strong><a href="/salaries/download/template-employee-salary" target="_blank">here</a></strong></i>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
            <button type="submit" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit"><i data-feather="save"></i> Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
@endsection
  @section('page-script')
  {{-- Page js files --}}
  <script>
    let token = "{{ csrf_token() }}"
  </script>
  <script src="{{ asset(mix('js/scripts/apps/salary_detail.js')) }}"></script>
@endsection