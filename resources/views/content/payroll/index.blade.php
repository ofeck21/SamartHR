@extends('layouts/contentLayoutMaster')

@section('title', lang('Menu Payroll'))

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
                <div class="card-header border-bottom p-1">
                    <div class="filter">
                      <div class="row">
                          <div class="col">
                            <select name="" id="filter_month" class="form-select select2">
                                @foreach ($months as $month)
                                    <option value="{{$month['value']}}" @if($month['value'] == date('m-Y')) selected @endif>{{$month['name']}}</option>
                                @endforeach
                            </select>
                          </div>
                          @if (Auth::user()->hasRole('Super Admin'))
                          <div class="col">
                            <select name="" id="filter_company" class="form-select select2">
                              <option value="all">All Company</option>
                              @foreach ($companies as $company)
                                  <option value="{{$company->id}}">{{$company->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col filter_department">
                            <select name="" id="filter_department" class="form-select select2">
                              <option value="all">All Department</option>
                            </select>
                          </div>
                          @else
                          <input type="hidden" id="filter_company" value="{{auth()->user()->company_id}}">
                          <div class="col filter_department">
                            <select name="" id="filter_department" class="form-select select2">
                              <option value="all">All Department</option>
                            </select>
                          </div>
                          @endif
                        </div>
                      </div>
                    <div>
                      <button class="btn btn-outline-info" id="btn-import" style="display: none">Import</button>
                      <button class="btn btn-outline-primary" id="btn-run" data-bs-toggle="modal" data-bs-target="#runPayroll"
                      >Run Payroll</button>
                      <button class="btn btn-outline-info" id="btn-progress" style="display: none;">
                        Payroll in progress... (<span class="executed">0</span>/<span class="total">0</span>) (<span class="percent">0</span>%)
                      </button>
                      <button class="btn btn-outline-primary" id="btn-finish" data-payroll="" style="display: none;">
                        Finish Payroll
                      </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="datatables-basic table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Periode</th>
                            <th>Employee Name</th>
                            <th>@if (Auth::user()->hasRole('Super Admin')) Company @else Department @endif</th>
                            <th>Job</th>
                            <th>Nominal</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                      </table>
                </div>
            </div>
        </div>
    </div>
  <!-- Modal to add new record -->
  <div class="modal fade text-start" id="runPayroll" tabindex="-1" aria-labelledby="runPayroll" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="runPayrollLabel">Run Payroll</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formRunPayroll">
          <div class="modal-body">
            <div class="row mb-2">
              <div class="col-md-6">
                <label class="form-label">Month <span class="text-danger">*</span></label>
                <select name="" id="month" class="form-select select2">
                  @foreach ($months as $month)
                  <option value="{{$month['value']}}" @if($month['value'] == date('m-Y')) selected @endif>{{$month['name']}}</option>
                  @endforeach
                </select>
              </div>
              @if (Auth::user()->hasRole('Super Admin'))
                <div class="col-md-6">
                    <label class="form-label">Company <span class="text-danger">*</span></label>
                    <select name="company" id="company" class="form-select select2">
                        <option value="all">All</option>
                        @foreach ($companies as $company)
                          <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                </div>
                @else
                <input type="hidden" name="company" id="company" value="{{Auth::user()->company_id}}">
                @endif
            </div>
            <div class="row mb-2">
              <div class="col-md-6">
                <label for="" class="form-label">Department</label>
                <select name="department" id="department" class="select2">
                    <option value="all">All</option>
                    @foreach ($companies as $company)
                      <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Employees</label>
                <select name="employees" id="employees" class="select2"></select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
            <button type="submit" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit"><i data-feather="save"></i> Run</button>
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
  <script src="{{ asset(mix('js/scripts/apps/payroll.js')) }}"></script>
@endsection