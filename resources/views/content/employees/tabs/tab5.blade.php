{{lang('Employees.Education Profile')}}
<hr>
  <section id="basic-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
            
            <div class="card-header border-bottom p-1">
                <button type="button" class="btn btn-outline-primary waves-effect"
                 onclick="
                 $('.method').attr('name', 'post');
                 $('#formNewRecordEmployeeEducationFormal').attr('action', '{{url('employee/'.request()->segment(2).'/education-profile')}}');
                 $('.reset').click();
                 $('.switch-button').show();
                 $('#addNewRecordEducationFormalLabel').html('{{lang('Employees.Add New Formal Education')}}');
                 " data-bs-toggle="modal" data-bs-target="#addNewRecordEducationFormal">
                    <i data-feather="plus"></i> Add New
                </button>

                <div style="float: right">
                    <button class="btn btn-toggle-formal btn-outline-success"> {{lang('Employees.Education Formal')}} </button>
                    <button class="btn btn-toggle-informal btn-outline-secondary"> {{lang('Employees.Education Informal')}} </button>
                </div>

            </div>

            <div class="table-formal">
                <table class="datatables-basic table table-sm employee-data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{lang('Employees.School Level')}} </th>
                            <th>{{lang('Employees.School Name')}} </th>
                            <th>{{lang('Employees.City')}} </th>
                            <th>{{lang('Employees.Start')}} </th>
                            <th>{{lang('Employees.Finish')}} </th>
                            <th>{{lang('Employees.Graduated')}} </th>
                            <th>{{lang('Employees.Action')}} </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            @if ($item->school_type == 'formal')
                                <tr>
                                    <td> {{$key+1}} </td>
                                    <td> {{$item->school_level->name}} </td>
                                    <td> {{$item->school_name}} </td>
                                    <td> {{$item->city}} </td>
                                    <td> {{$item->start}} </td>
                                    <td> {{$item->finish}} </td>
                                    <td>  
                                        @if ($item->graduated == '1')
                                            <span class="badge rounded-pill  badge-light-success"> Lulus </span>                                        
                                        @else
                                            <span class="badge rounded-pill  badge-light-warning"> Tidak Lulus </span>                                        
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-icon btn-flat-primary rounded-circle waves-effect" data-bs-toggle="modal" data-bs-target="#addNewRecordEducationFormal" 
                                        onclick="
                                            $('#addNewRecordEducationFormalLabel').html('{{lang('Employees.Edit Education Informal')}}');
                                            $('#formNewRecordEmployeeEducationFormal').attr('action', '{{url('employee/'.request()->segment(2).'/education-profile/'.$item->id)}}');
                                            $('.method').attr('name', '_method');
                                            $('.form-control').removeClass('is-invalid');
                                            $('.errs').remove();
                                            $('.switch-button').hide();
                                            $('.form-school-level').show();
                                            $('#educations_profile_method').val('put');
                                            $('#educations_profile_type').val('formal');
                                            $('#educations_profile_school_level').val('{{$item->school_level->id}}').trigger('change');
                                            $('#educations_profile_school_name').val('{{$item->school_name}}');
                                            $('#educations_profile_city').val('{{$item->city}}');
                                            $('#educations_profile_start').val('{{$item->start}}');
                                            $('#educations_profile_finish').val('{{$item->finish}}');
                                            $('#educations_profile_graduated').val('{{$item->graduated}}').trigger('change');
                                        ">
                                            <i data-feather="edit" class="font-medium-2"></i>
                                        </button>
                                        <button class="btn btn-icon btn-flat-danger rounded-circle waves-effect btn-delete" target_url="{{url('employee/'.request()->segment(2).'/education-profile/'.$item->id)}}" id_data="{{$item->id}}">
                                            <i data-feather="trash" class="font-medium-2"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="display: none" class="table-informal">
                <table class="datatables-basic table table-sm employee-data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{lang('Employees.School Name')}} </th>
                            <th>{{lang('Employees.City')}} </th>
                            <th>{{lang('Employees.Start')}} </th>
                            <th>{{lang('Employees.Finish')}} </th>
                            <th>{{lang('Employees.Graduated')}} </th>
                            <th>{{lang('Employees.Action')}} </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            @if ($item->school_type == 'informal')
                                <tr>
                                    <td> {{$key+1}} </td>
                                    <td> {{$item->school_name}} </td>
                                    <td> {{$item->city}} </td>
                                    <td> {{$item->start}} </td>
                                    <td> {{$item->finish}} </td>
                                    <td> {{$item->graduated}} </td>
                                    <td>
                                        <button class="btn btn-icon btn-flat-primary rounded-circle waves-effect" data-bs-toggle="modal" data-bs-target="#addNewRecordEducationFormal" 
                                        onclick="
                                            $('#addNewRecordEducationFormalLabel').html('{{lang('Employees.Edit Education Informal')}}');
                                            $('#formNewRecordEmployeeEducationFormal').attr('action', '{{url('employee/'.request()->segment(2).'/education-profile/'.$item->id)}}');
                                            $('.method').attr('name', '_method');
                                            $('.form-control').removeClass('is-invalid');
                                            $('.errs').remove();
                                            $('.switch-button').hide();
                                            $('.form-school-level').hide();
                                            $('#educations_profile_method').val('put');
                                            $('#educations_profile_type').val('formal');
                                            $('#educations_profile_school_name').val('{{$item->school_name}}');
                                            $('#educations_profile_city').val('{{$item->city}}');
                                            $('#educations_profile_start').val('{{$item->start}}');
                                            $('#educations_profile_finish').val('{{$item->finish}}');
                                            $('#educations_profile_graduated').val('{{$item->graduated}}').trigger('change');
                                        ">
                                            <i data-feather="edit" class="font-medium-2"></i>
                                        </button>
                                        <button class="btn btn-icon btn-flat-danger rounded-circle waves-effect btn-delete" target_url="{{url('employee/'.request()->segment(2).'/education-profile/'.$item->id)}}" id_data="{{$item->id}}">
                                            <i data-feather="trash" class="font-medium-2"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
      </div>
    </div>
</section>



<div class="modal fade text-start" id="addNewRecordEducationFormal" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addNewRecordEducationFormalLabel">{{lang('Employees.Add New Formal Education')}}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formNewRecordEmployeeEducationFormal" method="POST" action="{{url('employee/'.request()->segment(2).'/education-profile')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{request()->segment(2)}}">
            <input type="hidden" name="method" id="educations_profile_method" value="put" class="method">
            <input type="hidden" name="type" id="educations_profile_type" value="formal" class="type-education">
          <div class="modal-body">

            <div class="row">

                <div class="col-md-12 form-group switch-button mb-1">
                    <button type="button" class="btn btn-outline-success btn-formal waves-effect waves-float waves-light">Formal Education</button>
                    <button type="button" class="btn btn-outline-secondary btn-informal waves-effect waves-float waves-light">Informal Education</button>
                </div>

                <div class="col-md-12 form-school-level form-group mb-1">
                    <label>{{lang('Employees.School Level')}} * </label>
                    <select name="school_level" id="educations_profile_school_level" required="" class="form-control select2">
                        <option class="bs-title-option" value="">Selecting...</option>
                        @foreach ($options as $item)
                            @if ($item->group == 'school_level')
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.School Name')}} * </label>
                    <input type="text" name="school_name" id="educations_profile_school_name" placeholder="{{lang('Employees.School Name')}}" number="" required="" class="form-control">
                </div>

                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.City')}} * </label>
                    <input type="text" name="city" id="educations_profile_city" placeholder="{{lang('Employees.City')}}" number="" required="" class="form-control">
                </div>

                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.Start')}} * </label>
                    <input type="number" name="start" id="educations_profile_start" placeholder="{{lang('Employees.Start')}}" number="" required="" class="form-control">
                </div>

                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.Finish')}} * </label>
                    <input type="number" name="finish" id="educations_profile_finish" placeholder="{{lang('Employees.Finish')}}" number="" required="" class="form-control">
                </div>

                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.Graduated')}} * </label>
                    <select name="graduated" id="educations_profile_graduated" required="" class="form-control select2">
                        <option value="y">Ya</option>
                        <option value="n">Tidak</option>
                    </select>
                </div>


            </div>
            
          </div>
          <div class="modal-footer">
            <button type="reset" style="display: none" class="reset"></button>
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
            <button type="button" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit" targetForm="formNewRecordEmployeeEducationFormal"><i data-feather="save"></i> Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

