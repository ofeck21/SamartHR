
{{lang('Employees.Social Profile')}}
<hr>
<section id="basic-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
            
            <div class="card-header border-bottom p-1">
                <button type="button" class="btn btn-outline-primary waves-effect"
                 onclick="
                 $('.method').attr('name', 'post');
                 $('#formNewRecordSocialProfile').attr('action', '{{url('employee/'.request()->segment(2).'/social-profile')}}');
                 $('.reset').click();
                 $('#addNewRecordSocilaProfileLabel').html('{{lang('Employees.Add New Social Profile')}}');
                 " data-bs-toggle="modal" data-bs-target="#addNewRecordSocilaProfile">
                    <i data-feather="plus"></i> Add New
                </button>
            </div>

            <div class="table-responsive">
                <table class="datatables-basic table table-sm" id="employee-immigration">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{lang('Employees.social.social_name')}}</th>
                            <th>{{lang('Employees.social.social_id')}}</th>
                            <th>{{lang('Employees.social.social_link')}}</th>
                            <th>{{lang('Employees.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$item->social_name}} </td>
                                <td> {{$item->social_id}} </td>
                                <td> {{$item->social_link}} </td>
                                <td>
                                    <button class="btn btn-icon btn-flat-primary rounded-circle waves-effect" data-bs-toggle="modal" data-bs-target="#addNewRecordSocilaProfile" 
                                    onclick="
                                        $('#addNewRecordSocilaProfileLabel').html('{{lang('Employees.Edit Social Profile')}}');
                                        $('#formNewRecordSocialProfile').attr('action', '{{url('employee/'.request()->segment(2).'/social-profile/'.$item->id)}}');
                                        $('.method').attr('name', '_method');
                                        $('.form-control').removeClass('is-invalid');
                                        $('.errs').remove();
                                        $('[name=social_name]').val('{{$item->social_name}}');
                                        $('[name=social_id]').val('{{$item->social_id}}');
                                        $('[name=social_link]').val('{{$item->social_link}}');
                                    ">
                                        <i data-feather="edit" class="font-medium-2"></i>
                                    </button>
                                    <button class="btn btn-icon btn-flat-danger rounded-circle waves-effect btn-delete" target_url="{{url('employee/'.request()->segment(2).'/social-profile/'.$item->id)}}" id_data="{{$item->id}}">
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



<div class="modal fade text-start" id="addNewRecordSocilaProfile" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addNewRecordSocilaProfileLabel"></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formNewRecordSocialProfile" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{request()->segment(2)}}">
            <input type="hidden" name="_method" value="put" class="method">
          <div class="modal-body">

            <div class="row">
                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.social.social_name')}} * </label>
                    <input type="text" name="social_name" id="social_name" placeholder="{{lang('Employees.social.social_name')}}" number="" required="" class="form-control">
                </div>


                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.social.social_id')}} * </label>
                    <input type="number" name="social_id" id="social_id" placeholder="{{lang('Employees.social.social_id')}}" required="" autocomplete="off" class="form-control date" value="">
                </div>

                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.social.social_link')}}</label>
                    <input type="text" name="social_link" id="social_link" placeholder="{{lang('Employees.social.social_link')}}" autocomplete="off" class="form-control date" value="">
                </div>
                
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="reset" style="display: none" class="reset"></button>
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
            <button type="button" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit" targetForm="formNewRecordSocialProfile"><i data-feather="save"></i> Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
