
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
<!-- Basic table -->
<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header border-bottom p-1">
            <button type="button" class="btn btn-outline-primary waves-effect" data-bs-toggle="modal" data-bs-target="#addNewRecord">
                <i data-feather="plus"></i> Add New
            </button>
            <button type="button" class="btn btn-outline-primary waves-effect" data-bs-toggle="modal" data-bs-target="#importModal">
              <i data-feather="file"></i> Import
          </button>
        </div>
        <table class="datatables-basic table">
          <thead>
            <tr>
              <th>#</th>
              <th>Code</th>
              <th>Name</th>
              <th>Nominal</th>
              <th>Actions</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal to add new record -->
  <div class="modal fade text-start" id="addNewRecord" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addNewRecordLabel">Add New Salary</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formNewRecord">
          <div class="modal-body">
            <input type="hidden" id="item_id">
            <div class="row mb-1">
              <div class="col">
                <label class="form-label">Code<span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="text" class="form-control" id="salary_code" maxlength="5" placeholder="Salary Code" name="salary_code">
                  <button class="btn btn-outline-primary waves-effect" id="btn_generate_code" type="button">Generate</button>
                </div>
              </div>
            </div>
            <div class="row mb-1">
              <div class="col">
                  <label class="form-label">Salary Name<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="name" placeholder="Salary Name" name="name">
              </div>
            </div>
            <div class="row mb-1">
              <div class="col">
                <label class="form-label">Nominal<span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text">Rp</span>
                  <input type="text" class="form-control" id="nominal" placeholder="Nominal" name="nominal">
                </div>
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
                <input type="hidden" name="company" id="company" value="{{Auth::user()->company_id}}">
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

  <!-- Modal to add new record -->
  <div class="modal fade text-start" id="importModal" tabindex="-1" aria-labelledby="importModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="importModalLabel">Import Employee Salary</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formImport">
          <div class="modal-body">
            <input type="file" name="file" id="file" class="form-control">
            <hr>
            <i>Download template <strong><a href="/salaries/download/template-all" target="_blank">here</a></strong></i>
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
  <script src="{{ asset(mix('js/scripts/apps/salary.js')) }}"></script>
@endsection
