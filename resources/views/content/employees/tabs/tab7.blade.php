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






<div class="modal fade text-start" id="showRecordEmployeeExperience" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">

          
          <div style="" class="card-datatable table-responsive pt-0">
            <table id="table" class="table table-sm">
              <thead>
                <tr>
                  <th rowspan="2">{{lang('Recruitment connection family')}}</th>
                  <th rowspan="2">{{lang('Recruitment full name')}}</th>
                  <th rowspan="2">{{lang('Recruitment gander lp')}}</th>
                  <th rowspan="2">{{lang('Recruitment age in this year')}}</th>
                  <th rowspan="2">{{lang('Recruitment education')}}</th>
                  <th colspan="2" class="text-center">{{lang('Recruitment last job')}}</th>
                </tr>
                <tr>
                  <th>{{lang('Recruitment position')}}</th>
                  <th>{{lang('Recruitment company')}}</th>
                </tr>
              </thead>
              <tbody id="class-sibling">
                <tr>
                  <td>{{lang('Recruitment father')}}</td>
                  <td><input type="text" name="father" class="form-control"></td>
                  <td><select name="father_gender" class="form-control select2"><option value="L">{{lang('Recruitment male')}}</option><option value="P">{{lang('Recruitment female')}}</option></select></td>
                  <td><input type="number" name="father_age" class="form-control"></td>
                  <td><input type="text" name="father_education" class="form-control"></td>
                  <td><input type="text" name="father_position" class="form-control"></td>
                  <td><input type="text" name="father_company" class="form-control"></td>
                </tr>
                <tr>
                  <td>{{lang('Recruitment mother')}}</td>
                  <td><input type="text" name="mother" class="form-control"></td>
                  <td><select name="mother_gender" class="form-control select2"><option value="L">{{lang('Recruitment male')}}</option><option value="P">{{lang('Recruitment female')}}</option></select></td>
                  <td><input type="number" name="mother_age" class="form-control"></td>
                  <td><input type="text" name="mother_education" class="form-control"></td>
                  <td><input type="text" name="mother_position" class="form-control"></td>
                  <td><input type="text" name="mother_company" class="form-control"></td>
                </tr>
                <tr>
                  <td colspan="6"> {{lang('Recruitment sibling')}} </td>
                  <td class="text-end">
                    <a href="#" target="#class-sibling" prefix="sibling" class="btn btn-add-rows btn-sm btn-success"><i data-feather="plus"></i></a>
                  </td>
                </tr>
              </tbody>
              <tbody id="marital-status">
                <tr>
                  <td colspan=3"> {{lang('Recruitment marital status')}} </td>
                  <td colspan="4">
                    <select name="marital_status" class="form-control select2">
                      <option value="single">{{lang('Recruitment single')}}</option> 
                      <option value="married">{{lang('Recruitment married')}}</option>
                      <option value="widower">{{lang('Recruitment widower')}}</option>
                      <option value="widow">{{lang('Recruitment widow')}}</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td colspan=6"> {{lang('Recruitment child')}} </td>
                  <td class="text-end">
                    <a href="#" target="#marital-status" prefix="marital_status" class="btn btn-add-rows btn-sm btn-success"><i data-feather="plus"></i></a>
                  </td>
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