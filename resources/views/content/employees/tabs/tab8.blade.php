
{{lang('Employees.Family Structure')}}
<hr>
  <section id="basic-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
            
            <div class="card-header border-bottom p-1">
                <button type="button" class="btn btn-outline-primary waves-effect"
                 onclick="
                 $('.method').attr('name', 'post');
                 $('#formNewRecordFamilySrtucture').attr('action', '{{url('employee/'.request()->segment(2).'/family-structure')}}');
                 $('.reset').click();
                 $('#addNewRecordFamilyStructureLabel').html('{{lang('Employees.Add New Family Structure')}}');
                 " data-bs-toggle="modal" data-bs-target="#addNewRecordFamilyStructure">
                    <i data-feather="plus"></i> Add New
                </button>
            </div>

            <div class="table-responsive">
                <table class="datatables-basic table table-sm" id="employee-immigration">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{lang('Employees.family.Family_Status')}}</th>
                            <th>{{lang('Employees.family.Name')}}</th>
                            <th>{{lang('Employees.family.Gender')}}</th>
                            <th>{{lang('Employees.family.Age')}}</th>
                            <th>{{lang('Employees.family.Educations')}}</th>
                            <th>{{lang('Employees.family.Position')}}</th>
                            <th>{{lang('Employees.family.Company')}}</th>
                            <th>{{lang('Employees.family.bpjs')}}</th>
                            <th>{{lang('Employees.family.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{($item->family_status) ? $item->family_status->name : ''}} </td>
                                <td> {{$item->name}} </td>
                                <td> {{($item->gender) ? $item->gender->name : ''}} </td>
                                <td> {{$item->age}} </td>
                                <td> {{($item->pendidikan) ? $item->pendidikan->name : ''}} </td>
                                <td> {{$item->position}} </td>
                                <td> {{$item->company}} </td>
                                <td> 
                                    @if ($item->is_bpjs == '1')
                                        <span class="badge rounded-pill  badge-light-success"> Aktif BPJS </span>                                        
                                    @else
                                        <span class="badge rounded-pill  badge-light-warning"> Tidak Katif BPJS </span>                                        
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-icon btn-flat-primary rounded-circle waves-effect" data-bs-toggle="modal" data-bs-target="#addNewRecordFamilyStructure" 
                                    onclick="
                                        $('#addNewRecordFamilyStructureLabel').html('{{lang('Employees.Edit Emergency Contacts')}}');
                                        $('#formNewRecordFamilySrtucture').attr('action', '{{url('employee/'.request()->segment(2).'/family-structure/'.$item->id)}}');
                                        $('.method').attr('name', '_method');
                                        $('.form-control').removeClass('is-invalid');
                                        $('.errs').remove();
                                        $('[name=family_structure_status]').val({{($item->family_status) ? $item->family_status->id : ''}}).trigger('change');
                                        $('[name=name]').val('{{$item->name}}');
                                        $('[name=gender]').val({{($item->gender) ? $item->gender->id : ''}}).trigger('change');

                                        $('[name=age]').val('{{$item->age}}');
                                        $('[name=education]').val('{{($item->pendidikan) ? $item->pendidikan->name : ''}}');
                                        $('[name=position]').val('{{$item->position}}');
                                        $('[name=company]').val('{{$item->company}}');
                                        $('[name=is_bpjs]').prop('checked',{{$item->is_bpjs}});
                                    ">
                                        <i data-feather="edit" class="font-medium-2"></i>
                                    </button>
                                    <button class="btn btn-icon btn-flat-danger rounded-circle waves-effect btn-delete" target_url="{{url('employee/'.request()->segment(2).'/family-structure/'.$item->id)}}" id_data="{{$item->id}}">
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




<div class="modal fade text-start" id="addNewRecordFamilyStructure" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addNewRecordFamilyStructureLabel"></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formNewRecordFamilySrtucture" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{request()->segment(2)}}">
            <input type="hidden" name="_method" value="put" class="method">
          <div class="modal-body">

            <div class="row">
                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.family.Family_Status')}} * </label>
                    <select name="family_structure_status" id="family_structure_family_structure_status" required="" class="form-control select2">
                        <option class="bs-title-option" value="">Selecting...</option>
                        @foreach ($options as $item)
                            @if ($item->group == 'family_structure')
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.family.Name')}} * </label>
                    <input type="text" name="name" id="family_structure_name" placeholder="{{lang('Employees.family.Name')}}" number="" required="" class="form-control">
                </div>

                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.family.Gender')}} * </label>
                    <select name="gender" id="family_structure_gender" required="" class="form-control select2">
                        <option class="bs-title-option" value="">Selecting...</option>
                        @foreach ($options as $item)
                            @if ($item->group == 'gender')
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>


                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.family.Age')}} * </label>
                    <input type="number" name="age" id="family_structure_age" placeholder="{{lang('Employees.family.Age')}}" required="" autocomplete="off" class="form-control date" value="">
                </div>

                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.family.Educations')}}</label>
                    <select name="education" id="family_structure_education" required="" class="form-control select2">
                        <option class="bs-title-option" value="">Selecting...</option>
                        @foreach ($options as $item)
                            @if ($item->group == 'school_level')
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.family.Position')}}</label>
                    <input type="text" name="position" id="family_structure_position" placeholder="{{lang('Employees.family.Position')}}" autocomplete="off" class="form-control date" value="">
                </div>

                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.family.Company')}}</label>
                    <input type="text" name="company" id="family_structure_company" placeholder="{{lang('Employees.family.Company')}}" autocomplete="off" class="form-control date" value="">
                </div>

                <div class="col-md-12 form-group mb-1">
                    <label class="mb-1">{{lang('Employees.family.bpjs')}}</label>
                    <div class="form-check form-check-primary">
                        <input type="checkbox" name="is_bpjs" id="family_structure_is_bpjs" class="form-check-input" />
                        <label class="form-check-label" for="family_structure_is_bpjs">{{lang('Employees.family.bpjs')}}</label>
                    </div>
                </div>

                
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="reset" style="display: none" class="reset"></button>
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
            <button type="button" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit" targetForm="formNewRecordFamilySrtucture"><i data-feather="save"></i> Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

