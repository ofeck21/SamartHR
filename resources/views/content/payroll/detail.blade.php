@extends('layouts/contentLayoutMaster')

@section('title', lang('Menu Payroll'))

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{asset('css/base/pages/ui-feather.css')}}">
@endsection

@section('content')
@php
    // dd($payroll->employee)
@endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title">Payment Detail</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-borderless">
                        <tr>
                            <th>NIK/Lokasi</th>
                            <th>: {{$payroll->employee->employee_id}}/{{$payroll->employee->work_place}}</th>
                            <th>{{lang('General.Company')}}</th>
                            <th>: {{$payroll->company->name ?? ''}}</th>
                        </tr>
                        <tr>
                            <th>{{lang('General.Name')}}</th>
                            <th>: {{$payroll->employee->first_name.' '.$payroll->employee->last_name}}</th>
                            <th>Department</th>
                            <th>: {{$payroll->employee->department->name ?? ''}}</th>
                        </tr>
                        <tr>
                            <th>Job Position</th>
                            <th>: {{$payroll->employee->jobPosition->name ?? ''}}</th>
                            <th>Job Level</th>
                            <th>: {{$payroll->employee->jobLevel->name ?? ''}}</th>
                        </tr>
                        <tr>
                            <th>Status Karyawan</th>
                            <th>: {{$payroll->employee->employeesStatus->name ?? ''}}</th>
                            <th>No. KTP/SIM</th>
                            <th>: {{$payroll->employee->national_number ?? ''}}</th>
                        </tr>
                        <tr>
                            <th>Status Kawin</th>
                            <th>: {{$payroll->employee->maritalStatus->name ?? ''}}</th>
                            <th>NPWP</th>
                            <th>: {{$payroll->employee->npwp}}</th>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <th>: {{$payroll->employee->gender->name ?? ''}}</th>
                            <th>No. Rek. Bank</th>
                            <th>: {{''}}</th>
                        </tr>
                        <tr>
                            <th>Tanggal Kerja</th>
                            <th>: {{date_format(date_create($payroll->employee->date_of_joining), 'd-m-Y')}}</th>
                            <th>Nama Bank</th>
                            <th>: {{''}}</th>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <th>: {{date_format(date_create($payroll->employee->date_of_birth), 'd-m-Y')}}</th>
                            <th>Periode</th>
                            <th>: {{date_format(date_create($payroll->date), 'm-Y')}}</th>
                        </tr>
                        <tr>
                            <th>Alamat KTP</th>
                            <th colspan="2">: {{$payroll->employee->original_address}}</th>
                        </tr>
                    </table>
                    <hr>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th colspan="6" class="text-center bg-secondary text-white">Penerimaan</th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Periode</th>
                                <th>Name</th>
                                <th>Current Month</th>
                                <th>Last Month</th>
                                <th>Difference</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_last_month   = 0;
                                $total_diference    = 0;
                                $total_allowance    = 0;
                            @endphp
                            @foreach ($payroll->payment_details as $key => $detail)
                                @if($detail->type == 'salary' || $detail->type == 'allowance')
                                @php
                                    $last_month = Helper::lastMonth($detail->employee_id, $detail->code, $payroll->date);
                                    $total_last_month += $last_month;
                                    $nominal = $detail->nominal;
                                    $diference = $nominal-$last_month;
                                    $total_diference += $diference;
                                    $total_allowance += $nominal;
                                @endphp
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{date_format(date_create($payroll->date), 'm-Y')}}</td>
                                    <td>{{$detail->name}}</td>
                                    <td>{{"Rp ".number_format($nominal,0,",",".")}}</td>
                                    <td>{{"Rp ".number_format($last_month,0,",",".")}}</td>
                                    <td>{{"Rp ".number_format($diference,0,",",".")}}</td>
                                </tr>
                                @endif
                            @endforeach
                                <tr>
                                    <th colspan="3">Total</th>
                                    <th>{{"Rp ".number_format($total_allowance,0,",",".")}}</th>
                                    <th>{{"Rp ".number_format($total_last_month,0,",",".")}}</th>
                                    <th>{{"Rp ".number_format($total_diference,0,",",".")}}</th>
                                </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th colspan="6" class="text-center bg-secondary text-white">Potongan</th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Periode</th>
                                <th>Name</th>
                                <th>Current Month</th>
                                <th>Last Month</th>
                                <th>Difference</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_last_month   = 0;
                                $total_diference    = 0;
                                $total_reduction    = 0;
                            @endphp
                            @foreach ($payroll->payment_details as $key => $detail)
                                @if($detail->type == 'pph21' || $detail->type == 'reduction')
                                @php
                                    $last_month = Helper::lastMonth($detail->employee_id, $detail->code, $payroll->date);
                                    $total_last_month += $last_month;
                                    $nominal = $detail->nominal;
                                    $diference = $nominal-$last_month;
                                    $total_diference += $diference;
                                    $total_reduction += $nominal;
                                @endphp
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{date_format(date_create($payroll->date), 'm-Y')}}</td>
                                    <td>{{$detail->name}}</td>
                                    <td>{{"Rp ".number_format($nominal,0,",",".")}}</td>
                                    <td>{{"Rp ".number_format($last_month,0,",",".")}}</td>
                                    <td>{{"Rp ".number_format($diference,0,",",".")}}</td>
                                </tr>
                                @endif
                            @endforeach
                                <tr>
                                    <th colspan="3">Total</th>
                                    <th>{{"Rp ".number_format($total_reduction,0,",",".")}}</th>
                                    <th>{{"Rp ".number_format($total_last_month,0,",",".")}}</th>
                                    <th>{{"Rp ".number_format($total_diference,0,",",".")}}</th>
                                </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th colspan="12" class="text-center bg-secondary text-white">BPJS</th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2">#</th>
                                        <th rowspan="2">Periode</th>
                                        <th rowspan="2">Name</th>
                                        <th colspan="2" class="text-center">Tarif (%)</th>
                                        <th colspan="2" class="text-center">Nominal</th>
                                        {{-- <th colspan="2" class="text-center">Last Month</th>
                                        <th colspan="2" class="text-center">Difference</th> --}}
                                    </tr>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Company</th>
                                        <th>Employee (-)</th>
                                        <th>Company (+)</th>
                                        {{-- <th>Employee</th>
                                        <th>Company</th>
                                        <th>Employee</th>
                                        <th>Company</th> --}}
                                    </tr>
                                </thead>
                            <tbody>
                            @php
                                $total_last_month   = 0;
                                $total_diference    = 0;
                                $total_company      = 0;
                                $total_employee     = 0;
                            @endphp
                            @foreach ($payroll->payment_details as $key => $detail)
                                @if($detail->type == 'bpjs')
                                @php
                                    $last_month = Helper::lastMonth($detail->employee_id, $detail->code, $payroll->date);
                                    $total_last_month += $last_month;
                                    $nominal_employee = $detail->nominal_employee;
                                    $nominal_company = $detail->nominal_company;
                                    $diference = $nominal-$last_month;
                                    $total_diference += $diference;
                                    $total_employee += $nominal_employee;
                                    $total_company += $nominal_company;
                                @endphp
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{date_format(date_create($payroll->date), 'm-Y')}}</td>
                                    <td>{{$detail->name}}</td>
                                    <td>{{$detail->employee_percentage}}%</td>
                                    <td>{{$detail->company_percentage}}%</td>
                                    <td>{{"Rp ".number_format($nominal_employee,0,",",".")}}</td>
                                    <td>{{"Rp ".number_format($nominal_company,0,",",".")}}</td>
                                    {{-- <td>{{"Rp ".number_format($last_month,0,",",".")}}</td>
                                    <td>{{"Rp ".number_format($last_month,0,",",".")}}</td>
                                    <td>{{"Rp ".number_format($last_month,0,",",".")}}</td>
                                    <td>{{"Rp ".number_format($diference,0,",",".")}}</td> --}}
                                </tr>
                                @endif
                            @endforeach
                                <tr>
                                    <th colspan="5">Total</th>
                                    <th>{{"Rp ".number_format($total_employee,0,",",".")}} (-)</th>
                                    {{-- <th>{{"Rp ".number_format($total_last_month,0,",",".")}}</th> --}}
                                    <th>{{"Rp ".number_format($total_company,0,",",".")}} (+)</th>
                                </tr>
                                <tr>
                                    <th colspan="5">Jumlah Diterima</th>
                                    <th colspan="3">{{"Rp ".number_format($payroll->nominal,0,",",".").",-"}}</th>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
@endsection