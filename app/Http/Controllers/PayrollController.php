<?php

namespace App\Http\Controllers;

use App\Jobs\RunPayrollJob;
use App\Models\Company;
use App\Models\Employees;
use App\Models\Payment;
use App\Models\PayrollJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class PayrollController extends Controller
{
    public function index()
    {
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['name' => lang('Menu Application')],
            ['name' => lang('Menu Payroll')],
        ];
        $companies = Company::all();

        $month_name = [
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December'
        ];
        $months = [];
        
        for ($year = date('Y')-1; $year <= date('Y'); $year++) {
            for($m = 1; $m <= 12; $m++){
                $m = $m < 10 ? '0'.$m : $m;
                $months[] = [
                    'value' => $m.'-'.$year,
                    'name'  => $month_name[$m].' - '.$year
                ];
                if($m == date('m') && $year == date('Y')) break;
            }
        }
        
        return view('/content/payroll/index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'companies'     => $companies,
            'months'        => $months
        ]);
    }

    public function payrollDataTable(Request $request)
    {
        $user = Auth::user();

        return DataTables::of(
                    Payment::query()->with(['company', 'employee', 'employee.department', 'employee.jobPosition', 'employee.jobLevel', 'payroll'])
                    ->whereHas('payroll')
                    ->when(!$user->hasRole('Super Admin'), function($q) use ($user){
                        $q->where('company_id', $user->company_id);
                    })
                )
                ->filter(function($query) use ($request){
                    if (!empty($request->search['value'])) {
                        $query->search($request->search['value']);
                    }
                })
                ->editColumn('date', function($row){
                    return Carbon::parse($row->date)->format('m-Y');
                })
                ->editColumn('name', function($row){
                    $name = $row->employee->first_name.' '.$row->employee->last_name;
                    
                    return $name;
                })
                ->editColumn('company_department', function($row) use ($user){
                    if($user->hasRole('Super Admin')){
                        return $row->company->name ?? '';
                    }else{
                        return $row->employee->deparment->name ?? '';
                    }
                })
                ->editColumn('job', function($row){
                    return $row->employee->jobPosition->name.' @ '.$row->employee->jobLevel->name;
                })
                ->editColumn('actions', function($row) use ($user){
                    return [
                        'edit'      => (($user->hasRole('Super Admin') OR $user->hasPermissionTo('update payroll')) && ($row->payroll->status != 'finish')) ? true : false,
                        'delete'    => (($user->hasRole('Super Admin') OR $user->hasPermissionTo('delete payroll')) && ($row->payroll->status != 'finish')) ? true : false
                    ];
                })
                ->addIndexColumn()
                ->rawColumns(['actions', 'name', 'job', 'company_department'])
                ->make();
    }

    public function show($id)
    {
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['name' => lang('Menu Application')],
            ['name' => lang('Menu Payroll'), 'link' => '/payroll'],
            ['name' => lang('Menu Detail Payroll')]
        ];

        $payroll = Payment::where('id', $id)->with([
                    'payment_details', 
                    'company', 
                    'employee', 
                    'employee.department', 
                    'employee.jobPosition', 
                    'employee.jobLevel',
                    'employee.employeesStatus',
                    'employee.gender',
                    'employee.maritalStatus'
                    ])->first();

        return view('/content/payroll/detail', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'payroll'       => $payroll
        ]);
    }

    public function runPayroll(Request $request)
    {
        $this->validate($request, [
            'month'         => 'required',
            'company_id'    => 'required'
        ]);

        try {
            $user = Auth::user();
            $user_data = [
                'user_id'   => $user->id,
                'user_name' => $user->name,
                'company_id'=> $user->company_id,
                'email'     => $user->email    
            ];
            (new RunPayrollJob($request->month, $request->company_id, $user_data))->dispatch($request->month, $request->company_id, $user_data)->onQueue('run_payroll');

            return response()->json([
                'status'    => true,
                'message'   => 'Running Payroll'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'    => false,
                'message'   => $th->getMessage()
            ], 500);
        }
    }

    public function progress(Request $request)
    {
        $this->validate($request, [
            'month'     => 'required',
            'company'   => 'required'
        ]);

        $company = $request->company == 'all' ? null : $request->company;
        $month   = '01-'.$request->month;

        $progress = PayrollJob::where('company_id', $company)->whereMonth('created_at', Carbon::parse($month)->format('m'))->latest()->first();

        if($progress != null){
            $response = [
                'status'    => true,
                'payroll'   => $progress->id,
                'remaining' => $progress->remaining,
                'executed'  => $progress->executed,
                'progress'  => $progress->status,
                'total'     => $progress->remaining+$progress->executed,
                'percent'   => round((($progress->success + $progress->failed) / ($progress->remaining + $progress->executed)) * 100, 2) ?? 0  
            ];
        }else{
            $response = [
                'status'    => false,
                'message'   => 'No Payroll Found'
            ];
        }

        return response()->json($response, 200);
    }

    public function finish($payroll_id)
    {
        try {
            PayrollJob::where('id', $payroll_id)->update([
                'status'    => 'finish'
            ]);

            $response = [
                'status'    => true,
                'message'   => 'Payroll marked as finish'
            ];
        } catch (\Throwable $th) {
            $response = [
                'status'    => false,
                'message'   => $th->getMessage()
            ];
        }

        return response()->json($response, 200);
    }
}
