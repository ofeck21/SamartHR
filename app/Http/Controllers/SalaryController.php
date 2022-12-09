<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Salary;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\EmployeeSalary;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TemplateImportAllSalaryExport;
use App\Exports\TemplateImportEmployeeSalaryExport;
use App\Imports\EmployeeSalaryImport;
use App\Imports\SalaryImport;

class SalaryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['name' => "Master Data"],
            ['name' => "Salaries"]
        ];
        $salaries    = Salary::when(!$user->hasRole('Super Admin'), function($q) use ($user){
                            $q->where('company_id', $user->company_id);
                        })->get();
        $companies      = Company::all();

        return view('/content/salary/index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'salaries'      => $salaries,
            'companies'     => $companies
        ]);
    }

    public function salaryDataTable(Request $request)
    {
        $user = Auth::user();

        return DataTables::of(
                    Salary::query()->with('company')
                    ->when(!$user->hasRole('Super Admin'), function($q) use ($user){
                        $q->where('company_id', $user->company_id);
                    })
                )
                ->filter(function($query) use ($request){
                    if (!empty($request->search['value'])) {
                        $query->search($request->search['value']);
                    }
                })
                ->editColumn('name', function($row) use ($user){
                    $name = $row->name;
                    if($row->company_id != null && $row->company_id != $user->company_id){
                        $name .= $row->company != null ? " @ <span class=\"badge bg-success\">".$row->company->name ."</span>": '';
                    }
                    return $name;
                })
                ->editColumn('actions', function() use ($user){
                    return [
                        'edit'      => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('update salary')) ? true : false,
                        'delete'    => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('delete salary')) ? true : false, 
                    ];
                })
                ->addIndexColumn()
                ->rawColumns(['actions', 'name'])
                ->make();
    }

    public function salaryDataTableDetail(Request $request, $id)
    {
        $user = Auth::user();
        return DataTables::of(
            EmployeeSalary::query()->where('salary_id', $id)->with(['employee'])->whereDate('month', Carbon::parse('01-'.$request->month)->format('Y-m-d'))
            )
            ->filter(function($query) use ($request){
                if (!empty($request->search['value'])) {
                    $query->search($request->search['value']);
                }
            })
            ->editColumn('employee_name', function($row){
                $name = $row->employee != null ? $row->employee->first_name.' '.$row->employee->last_name : '';
                return $name;
            })
            ->editColumn('month', function($row){
                return Carbon::parse($row->month)->format('F-Y');
            })
            ->editColumn('actions', function() use ($user){
                return [
                    'edit'      => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('update salary')) ? true : false,
                    'delete'    => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('delete salary')) ? true : false, 
                ];
            })
            ->addIndexColumn()
            ->rawColumns(['actions', 'employee_name'])
            ->make();
    }

    public function detailStore(Request $request, $id)
    {
        $this->validate($request, [
            'employees' => 'required|array',
            'nominal'   => 'required',
            'month'     => 'required'
        ]);

        DB::beginTransaction();
        try {
            $salary = Salary::where('id', $id)->first();

            if($salary != null){
                $create = false;
                foreach ($request->employees as $employee) {
                    $create = EmployeeSalary::updateOrCreate([
                        'salary_id' => $salary->id,
                        'employee_id'=> $employee, 
                        'month'     => Carbon::parse('01-'.$request->month)->format('Y-m-d')
                    ],[
                        'employee_id'   => $employee,
                        'salary_id'     => $salary->id,
                        'name'          => $salary->name,
                        'month'         => Carbon::parse('01-'.$request->month)->format('Y-m-d'),
                        'nominal'       => str_replace('.', '', $request->nominal)
                    ]);
                }
                if ($create) {
                    DB::commit();
                    return response()->json([
                        'status'    => true,
                        'message'   => 'New data has been created'
                    ], 201);
                }else{
                    DB::rollBack();
                    return response()->json([
                        'status'    => true,
                        'message'   => 'Failed to create data'
                    ], 400);
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status'    => false,
                'message'   => $th->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $item = Salary::where('id', $id)->first();

        if($item!=null){
            return response()->json([
                'status'    => true,
                'message'   => 'Detail Data',
                'data'      => $item
            ]);
        }else{
            return response()->json([
                'status'    => false,
                'message'   => 'Data not found',
                'data'      => null
            ]);
        }
    }

    public function detail($id)
    {
        $user = Auth::user();
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['name' => "Master Data"],
            ['link' => '/salaries', 'name' => "Salaries"],
            ['name' => 'Detail']
        ];
        $item = Salary::where('id', $id)->with('company')->when(!$user->hasRole('Super Admin'), function($q) use ($user){
            $q->where('company_id', $user->company_id);
        })->first();
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

        $departments = Department::where('company_id', $item->company_id)->get();

        return view('/content/salary/detail', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'item'          => $item,
            'months'        => $months,
            'departments'   => $departments
        ]);
    }

    public function editSalaryDetail($id)
    {
        $item = EmployeeSalary::where('id', $id)->with('employee')->first();

        if($item!=null){
            return response()->json([
                'status'    => true,
                'message'   => 'Detail Data',
                'data'      => $item
            ]);
        }else{
            return response()->json([
                'status'    => false,
                'message'   => 'Data not found',
                'data'      => null
            ]);
        }
    }

    public function updateSalaryDetail(Request $request, $id)
    {
        $this->validate($request, [
            'nominal'   => 'required'
        ]);

        DB::beginTransaction();
        try {
            $item = EmployeeSalary::find($id);
            $item->nominal  = str_replace('.', '', $request->nominal);

            if ($item->save()) {
                DB::commit();
                return response()->json([
                    'status'    => true,
                    'message'   => 'Data has been updated'
                ], 201);
            }else{
                DB::rollBack();
                return response()->json([
                    'status'    => true,
                    'message'   => 'Failed to update data'
                ], 400);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status'    => false,
                'message'   => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => ['required', 
                            Rule::unique('salaries', 'name')->where(fn ($query) => $query->where('company_id', $request->company_id))],
            'code'      => ['required',
                            Rule::unique('salaries', 'code')->where(fn ($query) => $query->where('company_id', $request->company_id))],
            'nominal'   => 'required'
        ]);

        DB::beginTransaction();
        try {
            $create = Salary::create([
                'name'      => $request->name,
                'code'      => $request->code,
                'nominal'   => str_replace('.', '', $request->nominal),
                'company_id'=> $request->company_id
            ]);
            if ($create) {
                DB::commit();
                return response()->json([
                    'status'    => true,
                    'message'   => 'New data has been created'
                ], 201);
            }else{
                DB::rollBack();
                return response()->json([
                    'status'    => true,
                    'message'   => 'Failed to create data'
                ], 400);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status'    => false,
                'message'   => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => ['required', 
                            Rule::unique('salaries', 'name')->where(fn ($query) => $query->where('company_id', $request->company_id))->ignore($id, 'id')],
            'code'      => ['required',
                            Rule::unique('salaries', 'code')->where(fn ($query) => $query->where('company_id', $request->company_id))->ignore($id, 'id')],
            'nominal'   => 'required'
        ]);

        DB::beginTransaction();
        try {
            $item = Salary::find($id);
            $item->name     = $request->name;
            $item->company_id = $request->company_id;
            $item->code     = $request->code;
            $item->nominal  = str_replace('.', '', $request->nominal);

            if ($item->save()) {
                DB::commit();
                return response()->json([
                    'status'    => true,
                    'message'   => 'Data has been updated'
                ], 201);
            }else{
                DB::rollBack();
                return response()->json([
                    'status'    => true,
                    'message'   => 'Failed to update data'
                ], 400);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status'    => false,
                'message'   => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $item = Salary::findOrFail($id);

        if($item->delete()){
            return response()->json([
                'status'    => true,
                'message'   => 'Data has been deleted'
            ]);
        }else{
            return response()->json([
                'status'    => false,
                'message'   => 'Data not found'
            ]);
        }
    }

    public function destroySalaryDetail($id)
    {
        $item = EmployeeSalary::findOrFail($id);

        if($item->delete()){
            return response()->json([
                'status'    => true,
                'message'   => 'Data has been deleted'
            ]);
        }else{
            return response()->json([
                'status'    => false,
                'message'   => 'Data not found'
            ]);
        }
    }

    public function downloadTemplateAll()
    {
        return Excel::download(new TemplateImportAllSalaryExport, 'template-import-all-salary.xlsx');
    }

    public function downloadTemplateEmployeeSalary()
    {
        return Excel::download(new TemplateImportEmployeeSalaryExport, 'template-import-employee-salary.xlsx');
    }

    public function importAllSalary(Request $request)
    {
        $this->validate($request, [
            'file'      => 'required|file'
        ]);

        Excel::import(new SalaryImport, $request->file('file'));
        
        return response()->json([
            'status'    => true,
            'message'   => 'Import Done'
        ], 201);
    }

    public function importEmployeeSalary(Request $request)
    {
        $this->validate($request, [
            'file'      => 'required|file',
            'salary_id' => 'required|exists:salaries,id',
            'salary_name' => 'required'
        ]);

        Excel::import(new EmployeeSalaryImport($request->salary_id, $request->salary_name), $request->file('file'));
        
        return response()->json([
            'status'    => true,
            'message'   => 'Import Done'
        ], 201);
    }
}
