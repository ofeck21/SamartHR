{{lang('Employees.Work Experiences')}}
<hr>
  <section id="basic-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
            
            <div class="card-header border-bottom p-1">
                <button type="button" class="btn btn-outline-primary waves-effect"
                 onclick="
                 $('.method').attr('name', 'post');
                 $('#formNewRecordEmployeeWorkExperience').attr('action', '{{url('employee/'.request()->segment(2).'/work-experience')}}');
                 $('.reset').click();
                 $('.switch-button').show();
                 $('#addNewRecordEmployeeExperienceLabel').html('{{lang('Employees.Add New Work Experiences')}}');
                 " data-bs-toggle="modal" data-bs-target="#addNewRecordEmployeeExperience">
                    <i data-feather="plus"></i> Add New
                </button>

            </div>

            <div class="table-formal">
                <table class="datatables-basic table table-border table-sm employee-data-table">
                    <thead>
                        <tr>
                          <th rowspan="2" class="text-center align-middle">#</th>
                          <th colspan="2" class="text-center align-middle">{{lang('Recruitment Years of service')}}</th>
                          <th rowspan="2" class="text-center align-middle">{{lang('Recruitment salary')}}</th>
                          <th rowspan="2" class="text-center align-middle">{{lang('Recruitment subsidy')}}</th>
                          <th rowspan="2" class="text-center align-middle">{{lang('Recruitment Position/position')}}</th>
                          <th rowspan="2" class="text-center align-middle">{{lang('Employees.Action')}}</th>
                        </tr>
                        <tr>
                          <th>{{lang('Recruitment Years of service month')}}</th>
                          <th>{{lang('Recruitment Years of service year')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td> 
                                    <div>
                                        {{lang('Employees.start')}} 
                                    </div>
                                    <div>
                                        {{lang('Employees.finish')}} 
                                    </div>
                                </td>
                                <td> <div> {{$item->start_month->name}} </div> <div> {{$item->finish_month->name}} </div> </td>
                                <td> <div> {{$item->start_year}} </div> <div> {{$item->finish_year}} </div> </td>
                                <td> <div> {{$item->start_salary}} </div> <div> {{$item->finish_salary}} </div> </td>
                                <td> <div> {{$item->start_subsidy}} </div> <div> {{$item->finish_subsidy}} </div> </td>
                                <td> <div> {{$item->start_position}} </div> <div> {{$item->finish_position}} </div> </td>
                                <td>
                                    <button class="btn btn-icon btn-flat-success rounded-circle waves-effect" data-bs-toggle="modal" data-bs-target="#showRecordEmployeeExperience" 
                                    onclick="
                                        $('#view_employees_work_experience_start_month').html('{{$item->start_month->name}}');
                                        $('#view_employees_work_experience_start_year').html('{{$item->start_year}}');
                                        $('#view_employees_work_experience_start_salary').html('{{$item->start_salary}}');
                                        $('#view_employees_work_experience_start_subsidy').html('{{$item->start_subsidy}}');
                                        $('#view_employees_work_experience_start_position').html('{{$item->start_position}}');
                                        $('#view_employees_work_experience_finish_month').html('{{$item->finish_month->name}}');
                                        $('#view_employees_work_experience_finish_year').html('{{$item->finish_year}}');
                                        $('#view_employees_work_experience_finish_salary').html('{{$item->finish_salary}}');
                                        $('#view_employees_work_experience_finish_subsidy').html('{{$item->finish_subsidy}}');
                                        $('#view_employees_work_experience_finish_position').html('{{$item->finish_position}}');
                                        $('#view_employees_work_experience_company_name_and_address').html('{{$item->company_name_and_address}}');
                                        $('#view_employees_work_experience_type_of_business').html('{{$item->type_of_business}}');
                                        $('#view_employees_work_experience_reason_to_stop').html('{{$item->reason_to_stop}}');
                                        $('#view_employees_work_experience_brief_overview').html('{{$item->brief_overview}}');
                                        $('#view_employees_work_experience_position_struktur_organisasi').html('{{$item->position_struktur_organisasi}}');
                                    ">
                                        <i data-feather="eye" class="font-medium-2"></i>
                                    </button>
                                    <button class="btn btn-icon btn-flat-primary rounded-circle waves-effect" data-bs-toggle="modal" data-bs-target="#addNewRecordEmployeeExperience" 
                                    onclick="
                                        $('#addNewRecordEmployeeExperienceLabel').html('{{lang('Employees.Edit Work Experiences')}}');
                                        $('#formNewRecordEmployeeWorkExperience').attr('action', '{{url('employee/'.request()->segment(2).'/work-experience/'.$item->id)}}');
                                        $('.method').attr('name', '_method');
                                        $('.form-control').removeClass('is-invalid');
                                        $('.errs').remove();
                                        $('#educations_profile_method').val('put');
                                        $('#educations_profile_type').val('formal');

                                        $('#employees_work_experience_start_month').val('{{$item->start_month->id}}').trigger('change');
                                        $('#employees_work_experience_start_year').val('{{$item->start_year}}');
                                        $('#employees_work_experience_start_salary').val('{{$item->start_salary}}');
                                        $('#employees_work_experience_start_subsidy').val('{{$item->start_subsidy}}');
                                        $('#employees_work_experience_start_position').val('{{$item->start_position}}');
                                        $('#employees_work_experience_finish_month').val('{{$item->finish_month->id}}').trigger('change');
                                        $('#employees_work_experience_finish_year').val('{{$item->finish_year}}');
                                        $('#employees_work_experience_finish_salary').val('{{$item->finish_salary}}');
                                        $('#employees_work_experience_finish_subsidy').val('{{$item->finish_subsidy}}');
                                        $('#employees_work_experience_finish_position').val('{{$item->finish_position}}');
                                        $('#employees_work_experience_company_name_and_address').val('{{$item->company_name_and_address}}');
                                        $('#employees_work_experience_type_of_business').val('{{$item->type_of_business}}');
                                        $('#employees_work_experience_reason_to_stop').val('{{$item->reason_to_stop}}');
                                        $('#employees_work_experience_brief_overview').val('{{$item->brief_overview}}');
                                        $('#employees_work_experience_position_struktur_organisasi').val('{{$item->position_struktur_organisasi}}');
                                    ">
                                        <i data-feather="edit" class="font-medium-2"></i>
                                    </button>
                                    <button class="btn btn-icon btn-flat-danger rounded-circle waves-effect btn-delete" target_url="{{url('employee/'.request()->segment(2).'/work-experience/'.$item->id)}}" id_data="{{$item->id}}">
                                        <i data-feather="trash" class="font-medium-2"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
      </div>
    </div>
</section>



<div class="modal fade text-start" id="addNewRecordEmployeeExperience" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addNewRecordEmployeeExperienceLabel">{{lang('Employees.Add New Formal Education')}}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formNewRecordEmployeeWorkExperience" method="POST" action="{{url('employee/'.request()->segment(2).'/work-experience')}}" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{request()->segment(2)}}">
          <input type="hidden" name="method" id="employees_work_experience_method" value="put" class="method">
          <input type="hidden" name="type" id="employees_work_experience_type" value="formal" class="type-education">
          <div class="modal-body">

            

            <div style="overflow-x:unset" id="Employment_history" class="card-datatable table-responsive pt-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th rowspan="2" class="text-center align-middle">#</th>
                      <th colspan="2" class="text-center align-middle">{{lang('Employees.Years of service')}}</th>
                      <th rowspan="2" class="text-center align-middle">{{lang('Employees.salary')}}</th>
                      <th rowspan="2" class="text-center align-middle">{{lang('Employees.subsidy')}}</th>
                      <th rowspan="2" class="text-center align-middle">{{lang('Employees.Position/position')}}</th>
                    </tr>
                    <tr>
                      <th>{{lang('Employees.Years of service month')}}</th>
                      <th>{{lang('Employees.Years of service year')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><b>{{lang('Employees.start')}}</b></td>
                      <td>
                        <select name="start_month" id="employees_work_experience_start_month" class="form-control select2">
                            @foreach ($options as $item)
                                @if ($item->group == 'month')
                                    <option value="{{$item->id}}"> {{lang('Month.'.$item->name)}} </option>
                                @endif
                            @endforeach
                        </select>
                      </td>
                      <td><input type="number" name="start_year" id="employees_work_experience_start_year" placeholder="{{lang('Employees.start_year')}}" class="form-control"></td>
                      <td><input type="number" name="start_salary" id="employees_work_experience_start_salary" placeholder="{{lang('Employees.start_salary')}}" class="form-control"></td>
                      <td><input type="number" name="start_subsidy" id="employees_work_experience_start_subsidy" placeholder="{{lang('Employees.start_subsidy')}}" class="form-control"></td>
                      <td><input type="text" name="start_position" id="employees_work_experience_start_position" placeholder="{{lang('Employees.start_position')}}" class="form-control"></td>
                    </tr>
                    <tr>
                      <td><b>{{lang('Employees.finish')}}</b></td>
                      <td>
                        <select name="finish_month" id="employees_work_experience_finish_month" class="form-control select2">
                            @foreach ($options as $item)
                                @if ($item->group == 'month')
                                    <option value="{{$item->id}}"> {{lang('Month.'.$item->name)}} </option>
                                @endif
                            @endforeach
                        </select>
                      </td>
                      <td><input type="number" name="finish_year" id="employees_work_experience_finish_year" placeholder="{{lang('Employees.finish_year')}}" class="form-control"></td>
                      <td><input type="number" name="finish_salary" id="employees_work_experience_finish_salary" placeholder="{{lang('Employees.finish_salary')}}" class="form-control"></td>
                      <td><input type="number" name="finish_subsidy" id="employees_work_experience_finish_subsidy" placeholder="{{lang('Employees.finish_subsidy')}}" class="form-control"></td>
                      <td><input type="text" name="finish_position" id="employees_work_experience_finish_position" placeholder="{{lang('Employees.finish_position')}}" class="form-control"></td>
                    </tr>
                    <tr>
                      <td colspan="6">{{lang('Employees.Company Name, Address & Telephone')}}</td>
                    </tr>
                    <tr>
                      <td colspan="6"><textarea name="company_name_and_address" id="employees_work_experience_company_name_and_address" placeholder="{{lang('Employees.company_name_and_address')}}" class="form-control" rows="2"></textarea></td>
                    </tr>
                    <tr>
                      <td colspan="2">{{lang('Employees.Type of business')}}</td>
                      <td colspan="4"><input type="text" name="type_of_business" id="employees_work_experience_type_of_business" placeholder="{{lang('Employees.type_of_business')}}" class="form-control"></td>
                    </tr>
                    <tr>
                      <td colspan="2">{{lang('Employees.Reason to stop')}}</td>
                      <td colspan="4"><input type="text" name="reason_to_stop" id="employees_work_experience_reason_to_stop" placeholder="{{lang('Employees.reason_to_stop')}}" class="form-control"></td>
                    </tr>
                    <tr>
                      <td colspan="6">{{lang('Employees.Brief Overview of Duties, Responsibilities & Authorities in Last Position')}}</td>
                    </tr>
                    <tr>
                      <td colspan="4">
                        <textarea name="brief_overview" id="employees_work_experience_brief_overview" placeholder="{{lang('Employees.brief_overview')}}" class="form-control" rows="2"></textarea>
                      </td>
                      <td colspan="2">
                        <textarea name="position_struktur_organisasi" id="employees_work_experience_position_struktur_organisasi" placeholder="{{lang('Employees.position_struktur_organisasi')}}" class="form-control" rows="2"></textarea>
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>


            
          </div>
          <div class="modal-footer">
            <button type="reset" style="display: none" class="reset"></button>
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
            <button type="button" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit" targetForm="formNewRecordEmployeeWorkExperience"><i data-feather="save"></i> Save</button>
          </div>
        </form>
      </div>
    </div>
</div>




<div class="modal fade text-start" id="showRecordEmployeeExperience" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">

            

            <div style="overflow-x:unset" id="Employment_history" class="card-datatable table-responsive pt-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th rowspan="2" class="text-center align-middle">#</th>
                      <th colspan="2" class="text-center align-middle">{{lang('Employees.Years of service')}}</th>
                      <th rowspan="2" class="text-center align-middle">{{lang('Employees.salary')}}</th>
                      <th rowspan="2" class="text-center align-middle">{{lang('Employees.subsidy')}}</th>
                      <th rowspan="2" class="text-center align-middle">{{lang('Employees.Position/position')}}</th>
                    </tr>
                    <tr>
                      <th>{{lang('Employees.Years of service month')}}</th>
                      <th>{{lang('Employees.Years of service year')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><b>{{lang('Employees.start')}}</b></td>
                      <td id="view_employees_work_experience_start_month"></td>
                      <td id="view_employees_work_experience_start_year"></td>
                      <td id="view_employees_work_experience_start_salary"></td>
                      <td id="view_employees_work_experience_start_subsidy"></td>
                      <td id="view_employees_work_experience_start_position"></td>
                    </tr>
                    <tr>
                      <td><b>{{lang('Employees.finish')}}</b></td>
                      <td id="view_employees_work_experience_finish_month"></td>
                      <td id="view_employees_work_experience_finish_year"></td>
                      <td id="view_employees_work_experience_finish_salary"></td>
                      <td id="view_employees_work_experience_finish_subsidy"></td>
                      <td id="view_employees_work_experience_finish_position"></td>
                    </tr>
                    <tr>
                      <td colspan="6">{{lang('Employees.Company Name, Address & Telephone')}}</td>
                    </tr>
                    <tr>
                      <td colspan="6" id="view_employees_work_experience_company_name_and_address"></td>
                    </tr>
                    <tr>
                      <td colspan="2">{{lang('Employees.Type of business')}}</td>
                      <td colspan="4" id="view_employees_work_experience_type_of_business"></td>
                    </tr>
                    <tr>
                      <td colspan="2">{{lang('Employees.Reason to stop')}}</td>
                      <td colspan="4"  id="view_employees_work_experience_reason_to_stop"></td>
                    </tr>
                    <tr>
                      <td colspan="6">{{lang('Employees.Brief Overview of Duties, Responsibilities & Authorities in Last Position')}}</td>
                    </tr>
                    <tr>
                      <td colspan="4" id="view_employees_work_experience_brief_overview"></td>
                      <td colspan="2" id="view_employees_work_experience_position_struktur_organisasi"></td>
                    </tr>
                  </tbody>
                </table>
            </div>


            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
          </div>
        </form>
      </div>
    </div>
</div>