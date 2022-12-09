
@extends('layouts/contentLayoutMaster')

@section('title', lang('Menu Attendance'))

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
<!-- Basic table -->
<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header border-bottom mb-1"><strong>Filters</strong></div>
        <div class="card-body">
          <div class="filters">
            <div class="row">
              @if (Auth::user()->hasRole('Super Admin'))
                <div class="col-md-4">
                  <select name="" id="filter_company" class="form-select select2">
                    <option value="">Filter Company</option>
                    @foreach ($companies as $company)
                        <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                  </select>
                </div>
              @endif
              <input type="hidden" id="current_company" value="@if (!Auth::user()->hasRole('Super Admin')){{Auth::user()->company_id}}@endif">
              <div class="col-md-4">
                <select name="" id="filter_department" class="form-select select2">
                  <option value="">Filter Department</option>
                  @foreach ($departments as $department)
                      <option value="{{$department->id}}">{{$department->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <select name="" id="filter_shift" class="form-select select2">
                  <option value="">Filter Shift</option>
                  @foreach ($shifts as $shift)
                      <option value="{{$shift->id}}">{{$shift->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header border-bottom p-1">
          <div class="filter">
              <select name="" id="filter_month" class="select2">
                  @foreach ($months as $month)
                      <option value="{{$month['value']}}" @if($month['value'] == date('m-Y')) selected @endif>{{$month['name']}}</option>
                  @endforeach
              </select>
          </div>
          <button type="button" class="btn btn-outline-primary waves-effect" data-bs-toggle="modal" data-bs-target="#importModal">
            <i data-feather="file"></i> Import Attendances
        </button>
        </div>
        <table class="datatables-basic table">
          <thead>
            <tr>
              <th>#</th>
              <th>NIK</th>
              <th>Name</th>
              <th>Department</th>
              <th>Shift</th>
              <th>Attendance</th>
              <th>Actions</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal to add new record -->
  <div class="modal fade text-start" id="importModal" tabindex="-1" aria-labelledby="importModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="importModalLabel">Import {{lang('Menu Attendance')}}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formImport">
          <div class="modal-body">
            <div class="row mb-1">
              <div class="col">
                <label class="form-label">Brows File<span class="text-danger">*</span></label>
                <input type="file" class="form-control" id="file" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
              </div>
            </div>
            <div class="row">
              @if (Auth::user()->hasRole('Super Admin'))
                  <div class="col" id="select_company">
                      <label class="form-label">Company <span class="text-danger">*</span></label>
                      <select name="company" id="company" class="form-select select2">
                          <option value="">Select</option>
                          @foreach ($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                          @endforeach
                      </select>
                  </div>
              @else
                <input type="hidden" name="company" id="company" value="{{Auth::user()->company_id}}">]
              @endif
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
</section>
<!--/ Basic table -->
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
  <script src="{{ asset(mix('js/scripts/apps/attendance.js')) }}"></script>
@endsection
