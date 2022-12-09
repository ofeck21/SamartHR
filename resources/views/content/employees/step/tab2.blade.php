
{{$componentsid->name}}
<hr>
  <section id="basic-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
            
            <div class="card-header border-bottom p-1">
                <button type="button" class="btn btn-outline-primary waves-effect"
                 onclick="
                 $('.method').attr('name', 'post');
                 $('#formNewSalary').attr('action', '{{url('employee/'.request()->segment(2).'/salary-components/'.$componentsid->code)}}');
                 $('.reset').click();
                 $('#addNewSalaryLabel').html('Add New {{$componentsid->name}}');
                 " data-bs-toggle="modal" data-bs-target="#addNewRecordSalary">
                    <i data-feather="plus"></i> Add New
                </button>
            </div>

            <table class="datatables-basic table table-sm" id="employee-immigration">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{lang('employees.Basic Salary')}}</th>
                        <th>{{lang('employees.Given')}}</th>
                        <th>{{lang('employees.Months')}}</th>
                        <th>{{lang('employees.Name')}}</th>
                        <th>{{lang('employees.Nominal')}}</th>
                        <th>{{lang('Employees.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $month = [];
                    @endphp
                    @foreach ($data as $key => $item)
                    @php
                        $month[] = $item->month_ymd;
                    @endphp
                        <tr>
                            <td> {{$key+1}} </td>
                            <td> {{($item->salary_component->is_primary)?'Ya':'Tidak'}} </td>
                            <td> {{$item->salary_component->given}} </td>
                            <td> {{$item->month}} </td>
                            <td> {{$item->name}} </td>
                            <td> @currency($item->nominal) </td>
                            <td>
                                <button class="btn btn-icon btn-flat-primary rounded-circle waves-effect" data-bs-toggle="modal" data-bs-target="#addNewRecordSalary" 
                                onclick="
                                    $('#addNewSalaryLabel').html('Edit {{$componentsid->name}}');
                                    $('#formNewSalary').attr('action', '{{url('employee/'.request()->segment(2).'/salary-components/'.$componentsid->code.'/'.$item->id)}}');
                                    $('.method').attr('name', '_method');
                                    $('.form-control').removeClass('is-invalid');
                                    $('.errs').remove();
                                    
                                    $('[name=month]').val('{{$item->month_ymd}}').trigger('change');
                                    $('[name=nominal]').val('{{$item->nominal}}');

                                    $('[name=nominal]').keyup();
                                ">
                                    <i data-feather="edit" class="font-medium-2"></i>
                                </button>
                                <button class="btn btn-icon btn-flat-danger rounded-circle waves-effect btn-delete" target_url="{{url('employee/'.request()->segment(2).'/salary-components/'.$componentsid->code.'/'.$item->id)}}" id_data="{{$item->id}}">
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





<div class="modal fade text-start" id="addNewRecordSalary" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addNewSalaryLabel">{{lang('Employees.Add New Emergency Contact')}}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formNewSalary" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{request()->segment(2)}}">
            <input type="hidden" name="_method" value="put" class="method">
          <div class="modal-body">


            <div class="row">

                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.Months')}} * </label>
                    <select name="month" id="salary_month" required="" class="form-control select2">
                        <option class="bs-title-option" value="">Selecting...</option>
                        @php
                            $m = 1;
                        @endphp
                        @foreach ($options as $key => $item)
                            @if ($item->group == 'month')
                                @php
                                    $value = date('Y').'-'.str_pad($m++, 2, '0', STR_PAD_LEFT).'-01';
                                @endphp
                                <option value="{{ $value }}"> {{(in_array($value, $month))?'[update]':''}} {{lang('Month.'.$item->name)}} - {{date('Y')}} </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.Nominal')}} * </label>
                    <input type="text" name="nominal" id="salary_nominal" placeholder="{{lang('Employees.Nominal')}}" required="" autocomplete="off" class="form-control rp" value="">
                </div>

            </div>
            
          </div>
          <div class="modal-footer">
            <button type="reset" style="display: none" class="reset"></button>
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
            <button type="button" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit" targetForm="formNewSalary"><i data-feather="save"></i> Save</button>
          </div>
        </form>
      </div>
    </div>
  </div> 

