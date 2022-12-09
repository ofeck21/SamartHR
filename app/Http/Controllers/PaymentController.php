<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Company;
use App\Models\Payment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['name' => lang('Menu Application')],
            ['name' => lang('Menu Payment')],
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
        
        return view('/content/payment/index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'companies'     => $companies,
            'months'        => $months
        ]);
    }

    public function paymentDataTable(Request $request)
    {
        $user = Auth::user();

        return DataTables::of(
                    Payment::query()->with(['employee', 'employee.bank'])
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
                ->editColumn('nik', function($row){
                    return $row->employee->employee_id ?? '';
                })
                ->editColumn('code', function($row){
                    return $row->employee->bank->bank_code ?? 'TUNAI/CASH';
                })
                ->editColumn('bank_name', function($row){
                    return $row->employee->bank->bank_name ?? '';
                })
                ->editColumn('bank_account', function($row){
                    return $row->employee->bank->account_number ?? '';
                })
                ->editColumn('actions', function() use ($user){
                    return [
                        'edit'      => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('update payment')) ? true : false
                    ];
                })
                ->addIndexColumn()
                ->rawColumns(['actions', 'name', 'nik', 'code', 'bank_name', 'bank_account'])
                ->make();
    }

    public function checkCompanyBank($bank_name)
    {
        $company_bank = 's';
    }
}
