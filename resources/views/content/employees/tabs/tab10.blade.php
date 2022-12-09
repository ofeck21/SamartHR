
{{lang('Employees.All Documents')}}
<hr>
  <section id="basic-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
            
            <div class="card-header border-bottom p-1">
                <button type="button" class="btn btn-outline-primary waves-effect"
                 onclick="
                 $('.method').attr('name', 'post');
                 $('#formNewRecordAllDocument').attr('action', '{{url('employee/'.request()->segment(2).'/all-documents')}}');
                 $('.reset').click();
                 $('#addNewRecordAllDocumentLabel').html('{{lang('Employees.Add New Document')}}');
                 " data-bs-toggle="modal" data-bs-target="#addNewRecordAllDocument">
                    <i data-feather="plus"></i> Add New
                </button>
            </div>

            <div class="table-responsive">
                <table class="datatables-basic table table-sm" id="employee-immigration">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{lang('Employees.document_type_id')}}</th>
                            <th>{{lang('Employees.document_title')}}</th>
                            <th>{{lang('Employees.expiry_date')}}</th>
                            <th>{{lang('Employees.description')}}</th>
                            <th>{{lang('Employees.document_file')}}</th>
                            <th>{{lang('Employees.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$item->document_type->name}} </td>
                                <td> {{$item->document_title}} </td>
                                <td> {{$item->expiry_date}} </td>
                                <td> {{$item->description}} </td>
                                <td> 
                                    <button class="btn btn-icon btn-flat-primary rounded-circle waves-effect" data-bs-toggle="modal" data-bs-target="#showDocumentFile" onclick="$('.img-view').attr('src', '{{url('employee/'.request()->segment(2).'/employee-immigrations/'.$item->document_file)}}')">
                                        <i data-feather="file" class="font-medium-2"></i>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-icon btn-flat-primary rounded-circle waves-effect" data-bs-toggle="modal" data-bs-target="#addNewRecordAllDocument" 
                                    onclick="
                                        $('#addNewRecordAllDocumentLabel').html('{{lang('Employees.Edit Document')}}');
                                        $('#formNewRecordAllDocument').attr('action', '{{url('employee/'.request()->segment(2).'/all-documents/'.$item->id)}}');
                                        $('.method').attr('name', '_method');
                                        $('.form-control').removeClass('is-invalid');
                                        $('.errs').remove();

                                        $('[name=document_type_id]').val('{{$item->document_type->id}}').trigger('change');
                                        $('[name=document_title]').val('{{$item->document_title}}');
                                        $('[name=expiry_date]').val('{{$item->expiry_date}}');
                                        $('[name=description]').val('{{$item->description}}');
                                    ">
                                        <i data-feather="edit" class="font-medium-2"></i>
                                    </button>
                                    <button class="btn btn-icon btn-flat-danger rounded-circle waves-effect btn-delete" target_url="{{url('employee/'.request()->segment(2).'/all-documents/'.$item->id)}}" id_data="{{$item->id}}">
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


<div class="modal fade text-start" id="addNewRecordAllDocument" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addNewRecordAllDocumentLabel"></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formNewRecordAllDocument" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{request()->segment(2)}}">
            <input type="hidden" name="_method" value="put" class="method">
          <div class="modal-body">

            <div class="row">
                <div class="col-md-6 mb-1 form-group">
                    <label>{{lang('Employees.document_type_id')}}</label>
                    <select name="document_type_id" id="document_document_type" required="" class="form-control select2">
                        <option class="bs-title-option" value="">Selecting...</option>
                        @foreach ($options as $item)
                            @if ($item->group == 'document_type')
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-1 form-group">
                    <label>{{lang('Employees.document_title')}} *</label>
                    <input type="text" name="document_title" id="document_document_title" placeholder="Title" required="" class="form-control">
                </div>

                <div class="col-md-6 mb-1 form-group">
                    <label>{{lang('Employees.expiry_date')}} *</label>
                    <input type="date" name="expiry_date" id="document_expiry_date" required="" autocomplete="off" class="form-control date" value="">
                </div>

                <div class="col-md-6 mb-1 form-group">
                    <label>{{lang('Employees.Document_File')}} *</label>
                    <input type="file" name="document_file" id="document_document_file" class="form-control">
                </div>

                <div class="col-md-12 mb-1">
                    <div class="form-group">
                        <label>{{lang('Employees.Description')}}</label>
                        <textarea class="form-control" name="description" id="document_description" rows="3"></textarea>
                    </div>
                </div>

            </div>

          </div>
          <div class="modal-footer">
            <button type="reset" style="display: none" class="reset"></button>
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
            <button type="button" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit" targetForm="formNewRecordAllDocument"><i data-feather="save"></i> Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

