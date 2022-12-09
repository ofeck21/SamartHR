
{{lang('Employees.Emergency Contacts')}}
<hr>
  <section id="basic-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
            
            <div class="card-header border-bottom p-1">
                <button type="button" class="btn btn-outline-primary waves-effect"
                 onclick="
                 $('.method').attr('name', 'post');
                 $('#formNewRecordEmergency').attr('action', '{{url('employee/'.request()->segment(2).'/emergency-contacts')}}');
                 $('.reset').click();
                 $('#addNewRecordEmergencyLabel').html('{{lang('Employees.Add New Emergency Contact')}}');
                 " data-bs-toggle="modal" data-bs-target="#addNewRecordEmergency">
                    <i data-feather="plus"></i> Add New
                </button>
            </div>

            <table class="datatables-basic table table-sm" id="employee-immigration">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{lang('employees.Family Structure Status')}}</th>
                        <th>{{lang('employees.Name')}}</th>
                        <th>{{lang('employees.Phone Number')}}</th>
                        <th>{{lang('Employees.Descriptions')}}</th>
                        <th>{{lang('Employees.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        <tr>
                            <td> {{$key+1}} </td>
                            <td> {{$item->family_status->name}} </td>
                            <td> {{$item->name}} </td>
                            <td> {{$item->phone_number}} </td>
                            <td> {{$item->description}} </td>
                            <td>
                                <button class="btn btn-icon btn-flat-primary rounded-circle waves-effect" data-bs-toggle="modal" data-bs-target="#addNewRecordEmergency" 
                                onclick="
                                    $('#addNewRecordEmergencyLabel').html('{{lang('Employees.Edit Emergency Contacts')}}');
                                    $('#formNewRecordEmergency').attr('action', '{{url('employee/'.request()->segment(2).'/emergency-contacts/'.$item->id)}}');
                                    $('.method').attr('name', '_method');
                                    $('.form-control').removeClass('is-invalid');
                                    $('.errs').remove();
                                    $('[name=family_structure_status]').val({{$item->family_status->id}}).trigger('change');
                                    $('[name=name]').val('{{$item->name}}');
                                    $('[name=phone_number]').val('{{$item->phone_number}}');
                                    $('[name=description]').val('{{$item->description}}');
                                ">
                                    <i data-feather="edit" class="font-medium-2"></i>
                                </button>
                                <button class="btn btn-icon btn-flat-danger rounded-circle waves-effect btn-delete" target_url="{{url('employee/'.request()->segment(2).'/emergency-contacts/'.$item->id)}}" id_data="{{$item->id}}">
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
</section>




<div class="modal fade text-start" id="showDocumentFile" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="showDocumentFileLabel">{{lang('Employees.Document File')}}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <img src="" width="100%" alt="document-file" class="img-view" srcset="">
            
        </div>
      </div>
    </div>
  </div>




<div class="modal fade text-start" id="addNewRecordEmergency" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addNewRecordEmergencyLabel">{{lang('Employees.Add New Emergency Contact')}}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formNewRecordEmergency" method="POST" action="{{url('employee/'.request()->segment(2).'/immigration')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{request()->segment(2)}}">
            <input type="hidden" name="_method" value="put" class="method">
          <div class="modal-body">

            <div class="row">
                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.Family Structure Status')}} * </label>
                    <select name="family_structure_status" id="emergency_family_structure_status" required="" class="form-control select2">
                        <option class="bs-title-option" value="">Selecting...</option>
                        @foreach ($options as $item)
                            @if ($item->group == 'family_structure')
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.Name')}} * </label>
                    <input type="text" name="name" id="emergency_name" placeholder="{{lang('Employees.Name')}}" number="" required="" class="form-control">
                </div>


                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.Phone Number')}} * </label>
                    <input type="number" name="phone_number" id="emergency_phone_number" placeholder="{{lang('Employees.Phone Number')}}" required="" autocomplete="off" class="form-control date" value="">
                </div>

                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.Descriptions')}}</label>
                    <input type="text" name="description" id="emergency_description" placeholder="{{lang('Employees.Descriptions')}}" autocomplete="off" class="form-control date" value="">
                </div>

            </div>
            
          </div>
          <div class="modal-footer">
            <button type="reset" style="display: none" class="reset"></button>
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
            <button type="button" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit" targetForm="formNewRecordEmergency"><i data-feather="save"></i> Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

