
{{lang('Employees.Bank Account')}}
<hr>
  <section id="basic-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
            
            <div class="card-header border-bottom p-1">
                <button type="button" class="btn btn-outline-primary waves-effect"
                 onclick="
                 $('.method').attr('name', 'post');
                 $('#formNewRecordBankAccounts').attr('action', '{{url('employee/'.request()->segment(2).'/bank-accounts')}}');
                 $('.reset').click();
                 $('#addNewRecordBankAccountsLabel').html('{{lang('Employees.Add New Bank Account')}}');
                 " data-bs-toggle="modal" data-bs-target="#addNewRecordBankAccounts">
                    <i data-feather="plus"></i> Add New
                </button>
            </div>

            <div class="table-responsive">
                <table class="datatables-basic table table-sm" id="employee-immigration">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{lang('Employees.account_title')}}</th>
                            <th>{{lang('Employees.account_number')}}</th>
                            <th>{{lang('Employees.bank_name')}}</th>
                            <th>{{lang('Employees.bank_code')}}</th>
                            <th>{{lang('Employees.bank_branch')}}</th>
                            <th>{{lang('Employees.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$item->account_title}} </td>
                                <td> {{$item->account_number}} </td>
                                <td> {{$item->bank_name}} </td>
                                <td> {{$item->bank_code}} </td>
                                <td> {{$item->bank_branch}} </td>
                                <td>
                                    <button class="btn btn-icon btn-flat-primary rounded-circle waves-effect" data-bs-toggle="modal" data-bs-target="#addNewRecordBankAccounts" 
                                    onclick="
                                        $('#addNewRecordBankAccountsLabel').html('{{lang('Employees.Edit Bank Account')}}');
                                        $('#formNewRecordBankAccounts').attr('action', '{{url('employee/'.request()->segment(2).'/bank-accounts/'.$item->id)}}');
                                        $('.method').attr('name', '_method');
                                        $('.form-control').removeClass('is-invalid');
                                        $('.errs').remove();

                                        $('[name=account_title]').val('{{$item->account_title}}');
                                        $('[name=account_number]').val('{{$item->account_number}}');
                                        $('[name=bank_name]').val('{{$item->bank_name}}');
                                        $('[name=bank_code]').val('{{$item->bank_code}}');
                                        $('[name=bank_branch]').val('{{$item->bank_branch}}');
                                    ">
                                        <i data-feather="edit" class="font-medium-2"></i>
                                    </button>
                                    <button class="btn btn-icon btn-flat-danger rounded-circle waves-effect btn-delete" target_url="{{url('employee/'.request()->segment(2).'/bank-accounts/'.$item->id)}}" id_data="{{$item->id}}">
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




<div class="modal fade text-start" id="addNewRecordBankAccounts" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addNewRecordBankAccountsLabel"></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formNewRecordBankAccounts" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{request()->segment(2)}}">
            <input type="hidden" name="_method" value="put" class="method">
          <div class="modal-body">

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>{{lang('Employees.account_title')}} *</label>
                    <input type="text" name="account_title" id="bank_account_title" placeholder="{{lang('Employees.account_title')}}" title="" required="" class="form-control">
                </div>
            
            
                <div class="col-md-6 form-group">
                    <label>{{lang('Employees.account_number')}} *</label>
                    <input type="text" name="account_number" id="bank_account_number" required="" autocomplete="off" class="form-control" placeholder="{{lang('Employees.account_number')}}" number="">
                </div>
            
                <div class="col-md-6 form-group">
                    <label>{{lang('Employees.bank_name')}} *</label>
                    <input type="text" name="bank_name" id="bank_bank_name" required="" autocomplete="off" class="form-control" placeholder="{{lang('Employees.bank_name')}}">
                </div>
            
                <div class="col-md-6 form-group">
                    <label>{{lang('Employees.bank_code')}} *</label>
                    <input type="text" name="bank_code" id="bank_bank_code" placeholder="{{lang('Employees.bank_code')}}" code="" required="" class="form-control">
                </div>
            
                <div class="col-md-6 form-group">
                    <label>{{lang('Employees.bank_branch')}} *</label>
                    <input type="text" name="bank_branch" id="bank_bank_branch" placeholder="{{lang('Employees.bank_branch')}}" code="" required="" class="form-control">
                </div>
            
            </div>

          </div>
          <div class="modal-footer">
            <button type="reset" style="display: none" class="reset"></button>
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
            <button type="button" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit" targetForm="formNewRecordBankAccounts"><i data-feather="save"></i> Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

