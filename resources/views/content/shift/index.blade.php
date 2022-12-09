@extends('layouts/contentLayoutMaster')

@section('title', __('menu.Shift'))

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{asset('css/base/pages/ui-feather.css')}}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
  
@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css'))}}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
@endsection

@section('content')
<!-- Basic table -->
<section id="basic-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        @can('create job_position')
          <div class="card-header border-bottom p-1">
              <button type="button" class="btn btn-outline-primary waves-effect" data-bs-toggle="modal" data-bs-target="#addNewRecord">
                  <i data-feather="plus"></i> Add New
              </button>
          </div>
        @endcan
        <table class="datatables-basic table">
          <thead>
            <tr>
              <th>#</th>
              <th>Shift Name</th>
              <th>Actions</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal to add new record -->
  <div class="modal fade text-start" id="addNewRecord" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addNewRecordLabel">Add New Shift</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formNewRecord">
          <div class="modal-body">
            <input type="hidden" id="item_id">
            <div class="row mb-2">
              <div class="col">
                  <label class="form-label">Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="name" placeholder="Shift Name" name="name">
              </div>
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
            <hr>
            <div class="row mb-2">
              <div class="col">
                <label class="form-label">Monday</label>
                <div class="row">
                  <div class="col">
                    <input type="text" class="form-control flatpickr-time" id="clock_in1" data-id="" placeholder="In Time" name="clock_in1">
                  </div>
                  <div class="col">
                    <input type="text" class="form-control flatpickr-time" id="clock_out1" data-id="" placeholder="Out Time" name="clock_out1">
                  </div>
                </div>
              </div>
              <div class="col">
                <label class="form-label">Tuesday</label>
                <div class="row">
                  <div class="col">
                    <input type="text" class="form-control flatpickr-time" id="clock_in2" data-id="" placeholder="In Time" name="clock_in2">
                  </div>
                  <div class="col">
                    <input type="text" class="form-control flatpickr-time" id="clock_out2" data-id="" placeholder="Out Time" name="clock_out2">
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <label class="form-label">Wednesday</label>
                <div class="row">
                  <div class="col">
                    <input type="text" class="form-control flatpickr-time" id="clock_in3" data-id="" placeholder="In Time" name="clock_in3">
                  </div>
                  <div class="col">
                    <input type="text" class="form-control flatpickr-time" id="clock_out3" data-id="" placeholder="Out Time" name="clock_out3">
                  </div>
                </div>
              </div>
              <div class="col">
                <label class="form-label">Thursday</label>
                <div class="row">
                  <div class="col">
                    <input type="text" class="form-control flatpickr-time" id="clock_in4" data-id="" placeholder="In Time" name="clock_in4">
                  </div>
                  <div class="col">
                    <input type="text" class="form-control flatpickr-time" id="clock_out4" data-id="" placeholder="Out Time" name="clock_out4">
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <label class="form-label">Friday</label>
                <div class="row">
                  <div class="col">
                    <input type="text" class="form-control flatpickr-time" id="clock_in5" data-id="" placeholder="In Time" name="clock_in5">
                  </div>
                  <div class="col">
                    <input type="text" class="form-control flatpickr-time" id="clock_out5" data-id="" placeholder="Out Time" name="clock_out5">
                  </div>
                </div>
              </div>
              <div class="col">
                <label class="form-label">Saturday</label>
                <div class="row">
                  <div class="col">
                    <input type="text" class="form-control flatpickr-time" id="clock_in6" data-id="" placeholder="In Time" name="clock_in6">
                  </div>
                  <div class="col">
                    <input type="text" class="form-control flatpickr-time" id="clock_out6" data-id="" placeholder="Out Time" name="clock_out6">
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <label class="form-label">Sunday</label>
                <div class="row">
                  <div class="col">
                    <input type="text" class="form-control flatpickr-time" id="clock_in0" data-id="" placeholder="In Time" name="clock_in0">
                  </div>
                  <div class="col">
                    <input type="text" class="form-control flatpickr-time" id="clock_out0" data-id="" placeholder="Out Time" name="clock_out0">
                  </div>
                </div>
              </div>
              <div class="col">
                <label class="form-label">Allow Overtime</label>
                <div class="row">
                  <div class="col">
                    <select name="allow_overtime" id="allow_overtime" class="form-select select2">
                      <option value="no">No</option>
                      <option value="yes">Yes</option>
                    </select>
                  </div>
                  <div class="col">
                    <div class="input-group input-group-merge mb-2" id="overtime_limit">
                      <input type="number" class="form-control" placeholder="Limit" name="limit" id="limit">
                      <span class="input-group-text">Hours</span>
                    </div>
                  </div>
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
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  @endsection
  @section('page-script')
  {{-- Page js files --}}
  <script>
    let token = "{{ csrf_token() }}"
  </script>
  <script src="{{ asset(mix('js/scripts/apps/shift.js')) }}"></script>
@endsection
