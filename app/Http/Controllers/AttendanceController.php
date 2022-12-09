<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Company;
use App\Models\Employees;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Imports\ImportAttendance;
use App\Models\Department;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    public function index()
    {
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['name' => lang('Menu Application')],
            ['name' => lang('Menu Attendance')]
        ];

        $user = Auth::user();
        $companies      = Company::all();

        $departments    = Department::when(!$user->hasRole('Super Admin'), function($q) use ($user){
                                $q->where('company_id', $user->company_id);
                            })->get();
        
        $shifts          = Shift::when(!$user->hasRole('Super Admin'), function($q) use ($user){
                                $q->where('company_id', $user->company_id);
                            })->get();

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

        return view('/content/attendance/index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'companies'     => $companies,
            'months'        => $months,
            'departments'   => $departments,
            'shifts'        => $shifts,
        ]);
    }

    public function dataTable(Request $request)
    {
        $month = Carbon::parse('01-'.$request->month)->format('m');
        $year = Carbon::parse('01-'.$request->month)->format('Y');
        $user = Auth::user();
        $company = $request->company;
        $department = $request->department;
        $shift = $request->shift;
        return DataTables::of(
                    Employees::select('id','employee_id_number', 'first_name', 'last_name', 'department_id', 'shift_id')
                            ->when(!$user->hasRole('Super Admin'), function($q) use ($user){
                                $q->where('company_id', $user->company_id);
                            })
                            ->when($company!=null, function($q) use ($company){
                                $q->where('company_id', $company);
                            })
                            ->when($department!=null, function($q) use ($department){
                                $q->where('department_id', $department);
                            })
                            ->when($shift!=null, function($q) use ($shift){
                                $q->where('shift_id', $shift);
                            })
                            ->with(['department', 'department.company', 'shift'])
                            ->whereHas('attendances', function($q) use ($month, $year){
                                $q->whereMonth('date', $month)->whereYear('date', $year);
                            })
                            ->withCount(['attendances' => function($q) use ($month, $year){
                                $q->whereMonth('date', $month)->whereYear('date', $year);
                            }])
                )
                ->filter(function($query) use ($request){
                    if (!empty($request->search['value'])) {
                        $query->search($request->search['value']);
                    }
                })
                ->editColumn('name', function($row){
                    return $row->first_name.' '.$row->last_name;
                })
                ->addIndexColumn()
                ->rawColumns(['name'])
                ->make();
    }

    public function detail(Request $request, $id, $month)
    {
        if($request->ajax()){
            return $this->showAttendances($request, $id, $month);
        }
        $employee = Employees::select('first_name', 'last_name')->with('company')->first();
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['name' => lang('Menu Application')],
            ['link' => '/attendance', 'name' => lang('Menu Attendance')],
            ['name' => $employee->first_name.' '.$employee->last_name]
        ];

        $item = (object) [
            'employee'   => $employee,
            'month'      => Carbon::parse('01-'.$month)->format('F-Y')
        ];

        return view('content.attendance.detail', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'item'          => $item
        ]);
    }

    public function showAttendances($request, $id, $date)
    {
        $month = Carbon::parse('01-'.$date)->format('m');
        $year = Carbon::parse('01-'.$date)->format('Y');
        return DataTables::of(
                Attendance::where('employee_id', $id)
                ->whereMonth('date', $month)->whereYear('date', $year)->orderBy('id', 'asc')
            )
            ->filter(function($query) use ($request){
                if (!empty($request->search['value'])) {
                    $query->search($request->search['value']);
                }
            })
            ->editColumn('date', function($row){
                return $row->date != null ? Carbon::parse($row->date)->format('d-m-Y') : '';
            })
            ->editColumn('clock_in', function($row){
                return $row->clock_in != null ? Carbon::createFromFormat('H:i:s',$row->clock_in)->format('H:i') : '';
            })
            ->editColumn('clock_out', function($row){
                return $row->clock_out != null ? Carbon::createFromFormat('H:i:s',$row->clock_out)->format('H:i') : '';
            })
            ->editColumn('late', function($row){
                return $row->late != null ? Carbon::createFromFormat('H:i:s',$row->late)->format('H:i') : '';
            })
            ->editColumn('early', function($row){
                return $row->early != null ? Carbon::createFromFormat('H:i:s',$row->early)->format('H:i') : '';
            })
            ->editColumn('overtime', function($row){
                return $row->overtime != null ? Carbon::createFromFormat('H:i:s',$row->overtime)->format('H:i') : '';
            })
            ->editColumn('working_hours', function($row){
                return $row->working_hours != null ? Carbon::createFromFormat('H:i:s',$row->working_hours)->format('H:i') : '';
            })
            ->addIndexColumn()
            ->make();
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file'      => 'required|file',
            'company'   => 'required|exists:companies,id'
        ]);


        Excel::import(new ImportAttendance($request->company), $request->file('file'));
        
        return response()->json([
            'status'    => true,
            'message'   => 'Import Done'
        ], 201);
    }
}
