
{{lang('Employees.Assigned Immigration')}}
<hr>
  <section id="basic-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
            
            <div class="card-header border-bottom p-1">
                <button type="button" class="btn btn-outline-primary waves-effect"
                 onclick="
                 $('.method').attr('name', 'post');
                 $('#formNewRecordImmigration').attr('action', '{{url('employee/'.request()->segment(2).'/immigration')}}');
                 $('.reset').click();
                 " data-bs-toggle="modal" data-bs-target="#addNewRecordImmigration">
                    <i data-feather="plus"></i> Add New
                </button>
            </div>

            <table class="datatables-basic table table-sm" id="employee-immigration">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{lang('employees.Document')}}</th>
                        <th>{{lang('employees.Document Number')}}</th>
                        <th>{{lang('employees.Issue Date')}}</th>
                        <th>{{lang('employees.Expired Date')}}</th>
                        <th>{{lang('employees.Issue By')}}</th>
                        <th>{{lang('employees.Review Date')}}</th>
                        <th>{{lang('Employees.Document File')}}</th>
                        <th>{{lang('Employees.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        <tr>
                            <td> {{$key+1}} </td>
                            <td> {{$item->document_type->name}} </td>
                            <td> {{$item->document_number}} </td>
                            <td> {{$item->issue_date}} </td>
                            <td> {{$item->expired_date}} </td>
                            <td> {{$item->issue_by->name}} </td>
                            <td> {{$item->review_date}} </td>
                            <td> 
                                <button class="btn btn-icon btn-flat-primary rounded-circle waves-effect" data-bs-toggle="modal" data-bs-target="#showDocumentFile" onclick="$('#showDocumentFileLabel').html('{{$item->document_type->name}} : {{$item->document_number}}');$('.img-view').attr('src', '{{url('employee/'.request()->segment(2).'/employee-immigrations/'.$item->document_file)}}')">
                                    <i data-feather="file" class="font-medium-2"></i>
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-icon btn-flat-primary rounded-circle waves-effect" data-bs-toggle="modal" data-bs-target="#addNewRecordImmigration" 
                                onclick="
                                    $('#addNewRecordImmigrationLabel').html('{{lang('Employees.Edit Immigration')}}');
                                    $('#formNewRecordImmigration').attr('action', '{{url('employee/'.request()->segment(2).'/immigration/'.$item->id)}}');
                                    $('[name=document_type_id]').val({{$item->document_type_id}}).trigger('change');
                                    $('[name=document_number]').val('{{$item->document_number}}');
                                    $('.method').attr('name', '_method');
                                    $('.form-control').removeClass('is-invalid');
                                    $('.errs').remove();
                                    $('[name=issue_date]').val('{{$item->issue_date}}');
                                    $('[name=expired_date]').val('{{$item->expired_date}}');
                                    $('[name=eligible_review_date]').val('{{$item->review_date}}');
                                    $('[name=country_id]').val({{$item->country_id}}).trigger('change');
                                ">
                                    <i data-feather="edit" class="font-medium-2"></i>
                                </button>
                                <button class="btn btn-icon btn-flat-danger rounded-circle waves-effect btn-delete" target_url="{{url('employee/'.request()->segment(2).'/immigration/'.$item->id)}}" id_data="{{$item->id}}">
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




<div class="modal fade text-start" id="addNewRecordImmigration" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addNewRecordImmigrationLabel">{{lang('Employees.Add New Immigration')}}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formNewRecordImmigration" method="POST" action="{{url('employee/'.request()->segment(2).'/immigration')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{request()->segment(2)}}">
            <input type="hidden" name="_method" value="put" class="method">
          <div class="modal-body">

            <div class="row">
                <div class="col-md-6 form-group mb-1">
                    <label>{{lang('Employees.Document Type')}} * </label>
                    <select name="document_type_id" id="immigration_document_type_id" required="" class="form-control select2">
                        <option class="bs-title-option" value="">Selecting...</option>
                        @foreach ($options as $item)
                            @if ($item->group == 'document_type')
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 form-group mb-1">
                    <label>{{lang('Employees.Document Number')}} * </label>
                    <input type="number" name="document_number" id="immigration_document_number" placeholder="Document" number="" required="" class="form-control">
                </div>


                <div class="col-md-6 form-group mb-1">
                    <label>{{lang('Employees.Issue Date')}} * </label>
                    <input type="date" name="issue_date" id="immigration_issue_date" required="" autocomplete="off" class="form-control date" value="">
                </div>

                <div class="col-md-6 form-group mb-1">
                    <label>{{lang('Employees.Expired Date ')}}</label>
                    <input type="date" name="expired_date" id="immigration_expired_date" autocomplete="off" class="form-control date" value="">
                </div>

                <div class="col-md-6 form-group mb-1">
                    <label>{{lang('Employees.Eligible Review Date ')}}</label>
                    <input type="date" name="eligible_review_date" id="immigration_eligible_review_date" autocomplete="off" class="form-control date" value="">
                </div>

                <div class="col-md-6 form-group mb-1">
                    <label>{{lang('Employees.Document File')}} * </label>
                    <input type="file" name="document_file" id="immigration_document_file" required="" class="form-control">
                    <span id="stored_immigration_document"></span>
                </div>

                <div class="col-md-6 form-group mb-1">
                    <label>{{lang('Employees.Country')}} * </label>
                    <select name="country_id" id="immigration_county_id" required="" class="form-control select2">
                        <option class="bs-title-option" value="">Selecting...</option>
                        @foreach ($country as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            
          </div>
          <div class="modal-footer">
            <button type="reset" style="display: none" class="reset"></button>
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
            <button type="button" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit" targetForm="formNewRecordImmigration"><i data-feather="save"></i> Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>