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
            <div class="card-header border-bottom mb-1"><strong>Tenplate</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    Download Template <br>
                                    <a href="{{url('import excel.xlsx')}}" class="btn btn-outline-success btn-block waves-effect">
                                        <i data-feather="file"></i> Download Template
                                    </a> 
                                </div>
                                <div class="col-md-4">
                                    File Excel <br>
                                    <input class="form-control" name="excelfile" type="file">
                                    <div><small class="text-danger">@error('excelfile'){{$message}}@enderror</small></div>
                                </div>
                                <div class="col-md-4">
                                    View <br>
                                    
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i data-feather="check"></i> View Excel
                                    </button> 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <form action="" id="form-import" method="post">
        @csrf
      <div class="card">
        @can('create department')
          <div class="card-header border-bottom p-1">
            <strong>View</strong>
            <div>
                @if ($excel)
                    <button type="button" class="btn btn-import btn-outline-primary waves-effect" data-bs-toggle="modal" data-bs-target="#addNewRecord">
                        <i data-feather="plus"></i> Import Data
                    </button>
                @endif
            </div>
          </div>
        @endcan
        

        <div class="table-responsive">
            <table class="datatables-basic table-bordered table table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th class="px-4 py-1" style="white-space: nowrap;">employee id</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">id card</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">national number</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">first name</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">last name</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">username</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">email</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">password</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">contact</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">address</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">city</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">province</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">zip code</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">country</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">tribes</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">date of birth</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">gender</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">marital status</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">company</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">department</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">position</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">position level</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">category</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">work status</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">status</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">employment status</th>
                        <th class="px-4 py-1" style="white-space: nowrap;">shift</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($excel as $item)
                        <tr>
                            <td>
                                <button type="button" onclick="$(this).parent().parent().remove()" class="btn btn-icon btn-flat-danger rounded-circle  waves-effect">
                                    <i data-feather='trash-2'></i>
                                </button>
                            </td>
                            <td class="p-1"> 
                                <input type="text" name="employee_id[]" class="form-control" value="{{$item['employee_id']}}">
                                <div class="err err-employee_id text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <input type="text" name="id_card[]" class="form-control" value="{{$item['id_card']}}">
                                <div class="err err-id_card text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <input type="text" name="national_number[]" class="form-control" value="{{$item['national_number']}}">
                                <div class="err err-national_number text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <input type="text" name="first_name[]" class="form-control" value="{{$item['first_name']}}">
                                <div class="err err-first_name text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <input type="text" name="last_name[]" class="form-control" value="{{$item['last_name']}}">
                                <div class="err err-last_name text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <input type="text" name="username[]" class="form-control" value="{{$item['username']}}">
                                <div class="err err-username text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <input type="text" name="email[]" class="form-control" value="{{$item['email']}}">
                                <div class="err err-email text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <input type="text" name="password[]" class="form-control" value="{{$item['password']}}">
                                <div class="err err-password text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <input type="text" name="contact_no[]" class="form-control" value="{{$item['contact_no']}}">
                                <div class="err err-contact_no text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <input type="text" name="address[]" class="form-control" value="{{$item['address']}}">
                                <div class="err err-address text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <input type="text" name="city[]" class="form-control" value="{{$item['city']}}">
                                <div class="err err-city text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <input type="text" name="province[]" class="form-control" value="{{$item['province']}}">
                                <div class="err err-province text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <input type="text" name="zip_code[]" class="form-control" value="{{$item['zip_code']}}">
                                <div class="err err-zip_code text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <select name="country[]" class="form-control">
                                    <option value=""> -- Select country -- </option>
                                    @foreach ($country as $v1)
                                        <option value="{{$v1->id}}" @if($item['country'] == $v1->name) selected  @endif > {{$v1->name}} </option>
                                    @endforeach
                                </select>
                                <div class="err err-country text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <input type="text" name="tribes[]" class="form-control" value="{{$item['tribes']}}">
                                <div class="err err-tribes text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <input type="date" name="date_of_birth[]" class="form-control" value="{{$item['date_of_birth']}}">
                                <div class="err err-date_of_birth text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <select name="gender[]" class="form-control">
                                    <option value=""> -- Select Gender -- </option>
                                    @foreach ($options as $v1)
                                        @if ($v1->group == 'gender')
                                            <option value="{{$v1->id}}" @if($item['gender'] == 'L' && $v1->name == 'male') selected  @endif > {{$v1->name}} </option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="err err-gender text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <select name="marital_status[]" class="form-control">
                                    <option value=""> -- Select marital status -- </option>
                                    @foreach ($options as $v1)
                                        @if ($v1->group == 'maratial_status')
                                            <option value="{{$v1->id}}" @if($item['marital_status'] == $v1->name) selected  @endif > {{$v1->name}} </option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="err err-marital_status text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <select name="company_id[]" class="form-control">
                                    <option value=""> -- Select company -- </option>
                                    @foreach ($company as $v1)
                                        <option value="{{$v1->id}}" @if($item['company_id'] == $v1->name) selected  @endif > {{$v1->name}} </option>
                                    @endforeach
                                </select>
                                <div class="err err-company_id text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <select name="department_id[]" class="form-control">
                                    <option value=""> -- Select departement -- </option>
                                    @foreach ($departement as $v1)
                                        <option value="{{$v1->id}}" @if($item['department_id'] == $v1->name) selected  @endif > {{$v1->name}} </option>
                                    @endforeach
                                </select>
                                <div class="err err-department_id text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <select name="job_position_id[]" class="form-control">
                                    <option value=""> -- Select position -- </option>
                                    @foreach ($position as $v1)
                                        <option value="{{$v1->id}}" @if($item['job_position_id'] == $v1->name) selected  @endif > {{$v1->name}} </option>
                                    @endforeach
                                </select>
                                <div class="err err-job_position_id text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <select name="job_level_id[]" class="form-control">
                                    <option value=""> -- Select position level -- </option>
                                    @foreach ($job_level as $v1)
                                        <option value="{{$v1->id}}" @if($item['job_level_id'] == $v1->name) selected  @endif > {{$v1->name}} </option>
                                    @endforeach
                                </select>
                                <div class="err err-job_level_id text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <select name="employee_category_id[]" class="form-control">
                                    <option value=""> -- Select category -- </option>
                                    @foreach ($category as $v1)
                                        <option value="{{$v1->id}}" @if($item['employee_category_id'] == $v1->name) selected  @endif > {{$v1->name}} </option>
                                    @endforeach
                                </select>
                                <div class="err err-employee_category_id text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <select name="employee_work_status_id[]" class="form-control">
                                    <option value=""> -- Select work status -- </option>
                                    @foreach ($status as $v1)
                                        <option value="{{$v1->id}}" @if($item['employee_work_status_id'] == $v1->name) selected  @endif > {{$v1->name}} </option>
                                    @endforeach
                                </select>
                                <div class="err err-employee_work_status_id text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <select name="employee_status_id[]" class="form-control">
                                    <option value=""> -- Select marital status -- </option>
                                    @foreach ($options as $v1)
                                        @if ($v1->group == 'employee_status')
                                            <option value="{{$v1->id}}" @if($item['employee_status_id'] == $v1->name) selected  @endif > {{$v1->name}} </option>
                                        @endif
                                    @endforeach
                                </select>
                                
                                <div class="err err-employee_status_id text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <select name="employment_status_id[]" class="form-control">
                                    <option value=""> -- Select employment status -- </option>
                                    @foreach ($options as $v1)
                                        @if ($v1->group == 'employment_status')
                                            <option value="{{$v1->id}}" @if($item['employment_status_id'] == $v1->name) selected  @endif > {{$v1->name}} </option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="err err-employment_status_id text-danger"></div>
                            </td>
                            <td class="p-1"> 
                                <select name="employment_shift_id[]" class="form-control">
                                    <option value=""> -- Select shift -- </option>
                                    @foreach ($shift as $v1)
                                        <option value="{{$v1->id}}" @if($item['employment_shift_id'] == $v1->name) selected  @endif > {{$v1->name}} </option>
                                    @endforeach
                                </select>
                                <div class="err err-employment_shift_id text-danger"></div>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </form>
    </div>
  </div>


</section>
<!--/ Basic table -->
@endsection


@section('vendor-script')
<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>

@endsection
@section('page-script')
<script>
    $(document).ready(function(){

        $('.btn-import').click(function(){
            $('.err small').remove();
            $('.table-warning').removeClass();
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = new FormData(document.getElementById('form-import'));
            $.ajax({
                url   : '/import-emp',
                type  : 'POST',
                data  : formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                enctype: 'multipart/form-data',
                success : function(data){
                    if (data.status == true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Import Data Success',
                            showConfirmButton: false,
                            timer: 1000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        }).then(function(){
                            window.location = '/employee';
                        });
                    }
                },
                error : function(err){
                    var errs = err.responseJSON.errors
                    Object.keys(errs).forEach( function(key, value){
                        
                        var result = key.split('.');
                        if(1 in result){
                            var errclass = document.getElementsByClassName('err-'+result[0])[result[1]];
                            $(errclass).html('<small>'+errs[result[0]+'.'+result[1]][0].replace(key, 'Field')+'</small>')
                            $(errclass).parent().parent().addClass('table-warning')
                        }else{
                            $('.err-'+key).html(errs[key][0].replace(key.replaceAll('_', ' '), ''))
                            $('[name='+key+']').addClass('is-invalid')
                            $('[name='+key+']').parent().append('<div class="text-danger err err-'+key+'"> <small> '+errs[key][0].replace(key.replaceAll('_', ' '), '')+' </small> </div>');
                        }

                    });
                }
            });
        })
    })
</script>
@endsection
