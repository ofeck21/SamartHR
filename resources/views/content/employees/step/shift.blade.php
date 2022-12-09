

  <section id="basic-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
            
            <div class="card-header border-bottom p-1">
                <button type="button" class="btn btn-outline-primary waves-effect"
                 onclick="
                 $('.method').attr('name', 'post');
                 $('#formNewShift').attr('action', '{{url('employee/'.request()->segment(2).'/employee-shift')}}');
                 $('.reset').click();
                 $('#addNewShiftLabel').html('{{lang('Employees.Shift')}}');
                 " data-bs-toggle="modal" data-bs-target="#addNewRecordShift">
                    <i data-feather="plus"></i> Set Shift
                </button>
            </div>

            <table class="datatables-basic table table-sm" id="employee-immigration">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{lang('employees.Months')}}</th>
                        <th>{{lang('employees.ClockIn')}}</th>
                        <th>{{lang('employees.ClockOut')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data)
                        @foreach ($data->shift->shift_times as $key => $item)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$item->day_name}} </td>
                                <td> {{$item->clock_in}} </td>
                                <td> {{$item->clock_out}} </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>
      </div>
    </div>
</section>





<div class="modal fade text-start" id="addNewRecordShift" tabindex="-1" aria-labelledby="addNewRecord" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="addNewShiftLabel">{{lang('Employees.Add New Emergency Contact')}}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="formNewShift" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{request()->segment(2)}}">
            <input type="hidden" name="_method" value="put" class="method">
          <div class="modal-body">


            <div class="row">
                <div class="col-md-12 form-group mb-1">
                    <label>{{lang('Employees.Shift')}} * </label>
                    <select name="shift_id" id="salary_salary" required="" class="form-control select2">
                        <option class="bs-title-option" value="">Selecting...</option>
                        @foreach ($shift as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="reset" style="display: none" class="reset"></button>
            <button type="button" class="btn btn-outline-secondary waves-effect waves-float waves-light" data-bs-dismiss="modal"><i data-feather="x"></i> Close</button>
            <button type="button" class="btn btn-outline-primary waves-effect waves-float waves-light data-submit" targetForm="formNewShift"><i data-feather="save"></i> Save</button>
          </div>
        </form>
      </div>
    </div>
  </div> 

