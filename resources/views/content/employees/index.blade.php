@extends('layouts/contentLayoutMaster')

@section('title', lang('Employees'))

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
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        {{-- <form action=""> --}}
                            <div class="row">
                                <div class="col-md-6">
                                    Departemen
                                    <select name="dept" class="form-control form_departemen select2" id="">
                                        <option value=""> Filter </option>
                                        @foreach ($departement as $item)
                                            <option value="{{$item->id}}" {{(request()->dept == $item->id) ? 'selected' : ''}}> {{$item->name}} </option>
                                        @endforeach
                                        <option value="all"> All </option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    Status
                                    <select name="sts" class="form-control form_status select2" id="">
                                        <option value=""> Filter </option>
                                        @foreach ($options as $item)
                                            @if ($item->group == 'employee_status')
                                                <option value="{{$item->id}}" {{(request()->sts == $item->id) ? 'selected' : ''}} > {{$item->name}} </option>
                                            @endif
                                        @endforeach
                                        <option value="all"> All </option>
                                    </select>
                                </div>
                            </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>

      <div class="card">
        @can('create department')
          <div class="card-header border-bottom p-1">
            <div>
                <button type="button" class="btn btn-outline-primary waves-effect" data-bs-toggle="modal" data-bs-target="#addNewRecord">
                    <i data-feather="plus"></i> Add New
                </button>
  
                <a href="{{route('employee.import')}}" class="btn btn-outline-success waves-effect">
                  <i data-feather="file"></i> Import Excel
                </a>
            </div>
          </div>
        @endcan
        


        <table class="datatables-basic table">
          <thead>
            <tr>
              <th>#</th>
              <th>{{lang('Employees.nik')}}</th>
              <th>{{lang('employees')}}</th>
              <th>{{lang('Employees.Company')}}</th>
              <th>{{lang('Employees.Contact')}}</th>
              <th>{{lang('Employees.Status')}}</th>
              <th>{{lang('Employees.Option')}}</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal to add new record -->
  <div class="modal fade text-start" id="addNewRecord" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addNewRecordLabel">{{lang('Employees.Add New Employee')}}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formNewRecord">
          <div class="modal-body">
            <div class="row">
                <div class="col-md-4 mb-1">
                    <label for="">{{lang('Employees.employee_id')}}</label>
                    <input type="text" name="employee_id" id="employee_id" class="form-control" autocomplete="off" placeholder="{{lang('employees.employee_id')}}">
                </div>
                <div class="col-md-4 mb-1">
                    <label for="">{{lang('Employees.id_card')}}</label>
                    <input type="text" name="id_card" id="id_card" class="form-control" autocomplete="off" placeholder="{{lang('employees.id_card')}}">
                </div>
                <div class="col-md-4 mb-1">
                    <label for="">{{lang('Employees.national_number')}}</label>
                    <input type="text" name="national_number" id="national_number" class="form-control" autocomplete="off" placeholder="{{lang('employees.national_number')}}">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.First Name')}}</label>
                    <input type="text" name="first_name" id="first_name" placeholder="{{lang('Employees.First Name')}}" class="form-control">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Last Name')}}</label>
                    <input type="text" name="last_name" id="last_name" placeholder="{{lang('Employees.Last Name')}}" class="form-control">
                </div>


                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Username')}}</label>
                    <input type="text" name="username" id="username" placeholder="{{lang('Employees.Username')}}" class="form-control">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Email')}}</label>
                    <input type="text" name="email" id="email" placeholder="{{lang('Employees.Email')}}" class="form-control">
                </div>

                <div class="col-md-4 mb-1">
                <label for="">{{lang('Employees.password')}}</label>
                <input type="text" name="password" id="password" class="form-control" autocomplete="off" placeholder="{{lang('employees.password')}}">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Phone')}}</label>
                    <input type="number" name="contact_no" id="contact_no" placeholder="{{lang('Employees.Phone')}}" class="form-control">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Address')}}</label>
                    <input type="text" name="address" id="address" placeholder="{{lang('Employees.Address')}}"" class="form-control">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.City')}}</label>
                    <input type="text" name="city" id="city" placeholder="{{lang('Employees.City')}}" class="form-control">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.State/Province')}}</label>
                    <input type="text" name="province" id="province" placeholder="{{lang('Employees.State/Province')}}"" class="form-control">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.ZIP')}}</label>
                    <input type="text" name="zip_code" id="zip_code" placeholder="{{lang('Employees.ZIP')}}" class="form-control">
                </div>


                <div class="col-md-4 mb-1">
                    <div class="form-group">
                        <label>{{lang('Employees.Country')}}</label>
                        <select name="country" id="country" class="form-control select2">
                            @foreach ($country as $item)
                                <option value="{{$item->id}}">{{$item->name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-1">
                    <label for="">{{lang('Employees.tribes')}}</label>
                    <input type="text" name="tribes" id="tribes" class="form-control" autocomplete="off"  placeholder="{{lang('employees.tribes')}}">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Date Of Birth')}}</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" autocomplete="off" class="form-control">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Gender')}}</label>
                    <select name="gender" id="gender" class="selectpicker form-control select2">
                        @foreach ($options as $item)
                            @if ($item->group == 'gender')
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Marital Status')}}</label>
                    <select name="marital_status" id="marital_status" class="select2 form-control">
                        @foreach ($options as $item)
                            @if ($item->group == 'maratial_status')
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-1">
                    <div class="form-group">
                        <label>{{lang('Employees.Company')}}</label>
                        <select name="company_id" id="company_id" class="form-control select2">
                            @foreach ($company as $item)
                                <option value="{{$item->id}}"> {{$item->name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-1">
                    <div class="form-group">
                        <label>{{lang('Employees.Department')}}</label>
                        <select name="department_id" id="department_id" class="form-control select2">
                            @foreach ($departement as $item)
                                <option value="{{$item->id}}"> {{$item->name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Job Position')}}</label>
                    <select name="job_position_id" id="job_position_id" class="form-control select2">
                        @foreach ($position as $item)
                            <option value="{{$item->id}}"> {{$item->name}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Job Level')}}</label>
                    <select name="job_level_id" id="job_level_id" class="select2 form-control">
                        @foreach ($job_level as $item)
                            <option value="{{$item->id}}"> {{$item->name}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-1">
                    <label for="">{{lang('Employees.employee_category_id')}}</label>
                    <select name="employee_category_id" id="employee_category_id" class="form-control select2">
                        @foreach ($category as $item)
                            <option value="{{$item->id}}"> {{$item->name}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-1">
                    <div class="form-group">
                        <label>{{lang('Employees.Work_Status')}}</label>
                        <select name="employee_work_status_id" id="employee_work_status_id" class="form-control select2">
                            @foreach ($status as $item)
                                <option value="{{$item->id}}"> {{$item->name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-1">
                    <div class="form-group">
                        <label>{{lang('Employees.Status')}}</label>
                        <select name="employee_status_id" id="employee_status_id" class="form-control select2">
                            @foreach ($options as $item)
                                @if ($item->group == 'employee_status')
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-1">
                    <div class="form-group">
                        <label>{{lang('Employees.Employment_Status')}}</label>
                        <select name="employment_status_id" id="employment_status_id" class="form-control select2">
                            @foreach ($options as $item)
                                @if ($item->group == 'employment_status')
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-1">
                    <div class="form-group">
                        <label>{{lang('Employees.Sift')}}</label>
                        <select name="employment_shift_id" id="employment_shift_id" class="form-control select2">
                            @foreach ($shift as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
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



  <div class="modal fade text-start" id="updateRecord" tabindex="-1" aria-labelledby="updateRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="updateRecordLabel">{{lang('Employees.Update Employee')}}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formUpdateRecord">
        <input type="hidden" name="id" id="edit_id">

          <div class="modal-body">
            <div class="row">
                <div class="col-md-4 mb-1">
                    <label for="">{{lang('Employees.employee_id')}}</label>
                    <input type="text" name="employee_id" id="edit_employee_id" class="form-control" autocomplete="off" placeholder="{{lang('employees.employee_id')}}">
                </div>
                <div class="col-md-4 mb-1">
                    <label for="">{{lang('Employees.id_card')}}</label>
                    <input type="text" name="id_card" id="edit_id_card" class="form-control" autocomplete="off" placeholder="{{lang('employees.id_card')}}">
                </div>
                <div class="col-md-4 mb-1">
                    <label for="">{{lang('Employees.national_number')}}</label>
                    <input type="text" name="national_number" id="edit_national_number" class="form-control" autocomplete="off" placeholder="{{lang('employees.national_number')}}">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.First Name')}}</label>
                    <input type="text" name="first_name" id="edit_first_name" placeholder="{{lang('Employees.First Name')}}" class="form-control">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Last Name')}}</label>
                    <input type="text" name="last_name" id="edit_last_name" placeholder="{{lang('Employees.Last Name')}}" class="form-control">
                </div>


                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Username')}}</label>
                    <input type="text" name="username" id="edit_username" placeholder="{{lang('Employees.Username')}}" class="form-control">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Email')}}</label>
                    <input type="text" name="email" id="edit_email" placeholder="{{lang('Employees.Email')}}" class="form-control">
                </div>

                <div class="col-md-4 mb-1">
                <label for="">{{lang('Employees.password')}}</label>
                <input type="text" name="password" id="edit_password" class="form-control" autocomplete="off" placeholder="{{lang('employees.password')}}">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Phone')}}</label>
                    <input type="number" name="contact_no" id="edit_contact_no" placeholder="{{lang('Employees.Phone')}}" class="form-control">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Address')}}</label>
                    <input type="text" name="address" id="edit_address" placeholder="{{lang('Employees.Address')}}"" class="form-control">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.City')}}</label>
                    <input type="text" name="city" id="edit_city" placeholder="{{lang('Employees.City')}}" class="form-control">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.State/Province')}}</label>
                    <input type="text" name="province" id="edit_province" placeholder="{{lang('Employees.State/Province')}}"" class="form-control">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.ZIP')}}</label>
                    <input type="text" name="zip_code" id="edit_zip_code" placeholder="{{lang('Employees.ZIP')}}" class="form-control">
                </div>


                <div class="col-md-4 mb-1">
                    <div class="form-group">
                        <label>{{lang('Employees.Country')}}</label>
                        <select name="country" id="edit_country" class="form-control select2">
                            @foreach ($country as $item)
                                <option value="{{$item->id}}">{{$item->name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-1">
                    <label for="">{{lang('Employees.tribes')}}</label>
                    <input type="text" name="tribes" id="edit_tribes" class="form-control" autocomplete="off"  placeholder="{{lang('employees.tribes')}}">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Date Of Birth')}}</label>
                    <input type="date" name="date_of_birth" id="edit_date_of_birth" autocomplete="off" class="form-control">
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Gender')}}</label>
                    <select name="gender" id="edit_gender" class="selectpicker form-control select2">
                        @foreach ($options as $item)
                            @if ($item->group == 'gender')
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Marital Status')}}</label>
                    <select name="marital_status" id="edit_marital_status" class="select2 form-control">
                        @foreach ($options as $item)
                            @if ($item->group == 'maratial_status')
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-1">
                    <div class="form-group">
                        <label>{{lang('Employees.Company')}}</label>
                        <select name="company_id" id="edit_company_id" class="form-control select2">
                            @foreach ($company as $item)
                                <option value="{{$item->id}}"> {{$item->name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-1">
                    <div class="form-group">
                        <label>{{lang('Employees.Department')}}</label>
                        <select name="department_id" id="edit_department_id" class="form-control select2">
                            @foreach ($departement as $item)
                                <option value="{{$item->id}}"> {{$item->name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Job Position')}}</label>
                    <select name="job_position_id" id="edit_job_position_id" class="form-control select2">
                        @foreach ($position as $item)
                            <option value="{{$item->id}}"> {{$item->name}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-1 form-group">
                    <label>{{lang('Employees.Job Level')}}</label>
                    <select name="job_level_id" id="edit_job_level_id" class="select2 form-control">
                        @foreach ($job_level as $item)
                            <option value="{{$item->id}}"> {{$item->name}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-1">
                    <label for="">{{lang('Employees.employee_category_id')}}</label>
                    <select name="employee_category_id" id="edit_employee_category_id" class="form-control select2">
                        @foreach ($category as $item)
                            <option value="{{$item->id}}"> {{$item->name}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-1">
                    <div class="form-group">
                        <label>{{lang('Employees.Work_Status')}}</label>
                        <select name="employee_work_status_id" id="edit_employee_work_status_id" class="form-control select2">
                            @foreach ($status as $item)
                                <option value="{{$item->id}}"> {{$item->name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-1">
                    <div class="form-group">
                        <label>{{lang('Employees.Status')}}</label>
                        <select name="employee_status_id" id="edit_employee_status_id" class="form-control select2">
                            @foreach ($options as $item)
                                @if ($item->group == 'employee_status')
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-1">
                    <div class="form-group">
                        <label>{{lang('Employees.Employment_Status')}}</label>
                        <select name="employment_status_id" id="edit_employment_status_id" class="form-control select2">
                            @foreach ($options as $item)
                                @if ($item->group == 'employment_status')
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-1">
                    <div class="form-group">
                        <label>{{lang('Employees.Sift')}}</label>
                        <select name="employment_shift_id" id="edit_employment_shift_id" class="form-control select2">
                            @foreach ($shift as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
  
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
            <button type="submit" class="btn btn-outline-primary waves-effect waves-float waves-light data-update"><i data-feather="save"></i> Save</button>
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
  {{-- <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script> --}}
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  @endsection
  @section('page-script')
  {{-- Page js files --}}
  {{-- <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script> --}}
  {{-- <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script> --}}
  <script>
    let token = "{{ csrf_token() }}"
  </script>
  <script src="{{ asset(mix('js/scripts/apps/employees.js')) }}"></script>

  {{-- <script src="{{ asset(mix('js/scripts/apps/departement.js')) }}"></script> --}}
@endsection
