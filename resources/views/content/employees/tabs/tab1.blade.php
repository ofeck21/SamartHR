
    {{lang('Employees.Basic Information')}}
    <hr>
    <form method="post" id="basic_sample_form" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="row">

            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.First Name')}}</label>
                <input type="text" name="first_name" id="first_name" placeholder="First Name" required class="form-control" value="{{$show->first_name}}">
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.Last Name')}}</label>
                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required class="form-control" value="{{$show->last_name}}">
            </div>


            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.Username')}}</label>
                <input type="text" name="username" id="username" placeholder="Username" required class="form-control" value="{{$show->users->name}}">
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.Email')}}</label>
                <input type="text" name="email" id="email" placeholder="Email" required class="form-control" value="{{$show->users->email}}">
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.Phone')}}</label>
                <input type="text" name="contact_no" id="contact_no" placeholder="Phone" required class="form-control" value="{{$show->mobile_phone}}">
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.Address')}}</label>
                <input type="text" name="address" id="address" placeholder="Address" value="{{$show->original_address}}" class="form-control">
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.City')}}</label>
                <input type="text" name="city" id="city" placeholder="City" value="{{$show->city}}" class="form-control">
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.State/Province')}}</label>
            </label>
                <input type="text" name="state" id="state" placeholder="State/Province" value="{{$show->province}}" class="form-control">
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.ZIP')}}</label>
                <input type="text" name="zip_code" id="zip_code" placeholder="ZIP" value="{{$show->zip_code}}" class="form-control">
            </div>


            <div class="col-md-4 mb-1">
                <div class="form-group">
                    <label>{{lang('Employees.Country')}}</label>
                    <select name="country" id="country" class="form-control select2">
                        @foreach ($country as $item)
                            <option value="{{$item->id}}" {{($item->id == $show->country_id)?'selected':''}}> {{$item->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.Date Of Birth')}}</label>
                <input type="date" name="date_of_birth" id="date_of_birth" required autocomplete="off" class="form-control" value="{{$show->date_of_birth}}">
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.Gender')}}</label>
                <input type="hidden" name="gender_hidden" value="Female"/>
                <select name="gender" id="gender" class="selectpicker form-control select2">
                    @foreach ($options as $item)
                        @if ($item->group == 'gender')
                            <option value="{{$item->id}}" {{ ($item->id == $show->gender_id)?'selected':'' }} >{{$item->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.Marital Status')}}</label>
                <select name="marital_status" id="marital_status" class="select2 form-control">
                    @foreach ($options as $item)
                        @if ($item->group == 'maratial_status')
                            <option value="{{$item->id}}" {{ ($item->id == $show->gender_id)?'selected':'' }} >{{$item->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-1">
                <div class="form-group">
                    <label>{{lang('Employees.Company')}}</label>
                    <select name="company_id" id="company_id" class="form-control select2">
                        @foreach ($company as $item)
                            <option value="{{$item->id}}" {{($item->id == $show->company_id)?'selected':''}} > {{$item->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-1">
                <div class="form-group">
                    <label>{{lang('Employees.Department')}}</label>
                    <select name="department_id" id="department_id" class="form-control select2">
                        @foreach ($departement as $item)
                            <option value="{{$item->id}}" {{($item->id == $show->department_id)?'selected':''}} > {{$item->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.Job Position')}}</label>
                <select name="job_position_id" id="job_position_id" class="form-control select2">
                    @foreach ($position as $item)
                        <option value="{{$item->id}}" {{($item->id == $show->job_position_id)?'selected':''}} > {{$item->name}} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.Job Level')}}</label>
                <select name="job_level_id" id="job_level_id" class="select2 form-control">
                    @foreach ($job_level as $item)
                        <option value="{{$item->id}}" {{($item->id == $show->job_level_id)?'selected':''}} > {{$item->name}} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-1">
                <div class="form-group">
                    <label>{{lang('Employees.Work Status')}}</label>
                    <select name="employee_work_status_id" id="employee_work_status_id" class="form-control select2">
                        @foreach ($status as $item)
                            <option value="{{$item->id}}" {{($item->id == $show->employee_work_status_id)?'selected':''}} > {{$item->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-1">
                <div class="form-group">
                    <label>{{lang('Employees.Employee Status')}}</label>
                    <select name="employee_status_id" id="employee_status_id" class="form-control select2">
                        @foreach ($options as $item)
                            @if ($item->group == 'employee_status')
                                <option value="{{$item->id}}" {{ ($item->id == $show->employee_status_id)?'selected':'' }} >{{$item->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-1">
                <div class="form-group">
                    <label>{{lang('Employees.Employment Status')}}</label>
                    <select name="employee_employment_status_id" id="employee_employment_status_id" class="form-control select2">
                        @foreach ($options as $item)
                            @if ($item->group == 'employment_status')
                                <option value="{{$item->id}}" {{ ($item->id == $show->employment_status_id)?'selected':'' }} >{{$item->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.file.Office Shift')}}</label>
                <input type="hidden" name="office_shift_id_hidden" value="1"/>
                <select name="office_shift_id" id="office_shift_id" class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select file.Office Shift...">
                        <option value="1">Morning Shift</option>
                        <option value="2">MidDay</option>
                </select>
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.Date Of Joining')}}</label>
                <input type="date" name="joining_date" id="joining_date" autocomplete="off" class="form-control date" value="{{$show->date_of_joining}}">
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{lang('Employees.Date Of Leaving')}}</label>
                <input type="date" name="exit_date" id="exit_date" autocomplete="off" class="form-control date" value="{{$show->date_of_leaving}}">
            </div>

            <div class="col-md-4 mb-1">
                <label class="text-bold">Attendance Type <small class="text-muted">On progres</small> <span class="text-danger">*</span></label>
                <select name="attendance_type" id="attendance_type" required class="selectpicker form-control" data-live-search="true" data-live-search-style="begins" title="Select Login Type...">
                    <option value="general">General</option>
                    <option value="ip_based" selected>IP Based</option>
                </select>
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{str_replace(':tahun',date('Y'),lang('Employees.Total Annual Leave (Year - :tahun)'))}}</label>
                <input type="number" min="0" name="total_leave" id="total_leave" class="form-control" value="{{$leave}}">
            </div>
            <div class="col-md-4 mb-1 form-group">
                <label>{{str_replace(':tahun',date('Y'),lang('Employees.Remaining Leave (Year - :tahun)'))}}</label>
                <input type="number" readonly name="remaining_leave" id="remaining_leave" autocomplete="off" class="form-control" value="{{$leave - $remaining_leave}}">
                <small class="text-danger"><i>(Read Only)</i></small>
            </div>

            <div class="col-md-4 mb-1 form-group">
                <label>{{'PPh21'}}</label>
                <select name="ptkp_id" id="ptkp" class="select2">
                    <option value="">Select</option>
                    @foreach ($ptkp as $pph21)
                        <option value="{{$pph21->id}}">{{$pph21->code}}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- <div class="col-md-4 mb-1"></div>

            <div class="mt-3 form-group row">
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </div> --}}

        </div>
    </form>