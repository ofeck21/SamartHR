<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Department;
use App\Models\JobPosition;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobPositionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['name' => "Job Position List"]
        ];
        $departments    = Department::when(!$user->hasRole('Super Admin'), function($q) use ($user){
                            $q->where('company_id', $user->company_id);
                        })->get();
        $companies      = Company::all();

        return view('/content/job-position/index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'departments'   => $departments,
            'companies'     => $companies
        ]);
    }

    public function jobPositionDataTable(Request $request)
    {
        $user = Auth::user();

        return DataTables::of(
                    JobPosition::query()->with('company')
                    ->when(!$user->hasRole('Super Admin'), function($q) use ($user){
                        $q->where('company_id', $user->company_id);
                    })->with('department')
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
                        'edit'      => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('update job_position')) ? true : false,
                        'delete'    => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('delete job_position')) ? true : false
                    ];
                })
                ->addIndexColumn()
                ->rawColumns(['actions', 'name'])
                ->make();
    }

    public function show($id)
    {
        $job_position = JobPosition::where('id', $id)->first();

        if($job_position!=null){
            return response()->json([
                'status'    => true,
                'message'   => 'Detail Data',
                'data'      => $job_position
            ]);
        }else{
            return response()->json([
                'status'    => false,
                'message'   => 'Data not found',
                'data'      => null
            ]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => ['required',
                            Rule::unique('job_positions', 'name')->where(fn ($query) => $query->where('company_id', $request->company_id)->where('department_id', $request->department_id))
                            ],
            'department_id' => ['required', 
                            Rule::exists('departments', 'id')]
        ]);

        DB::beginTransaction();
        try {
            $job_position = JobPosition::create([
                'name'      => $request->name,
                'description'      => $request->description,
                'department_id'      => $request->department_id,
                'company_id'    => $request->company_id
            ]);

            if ($job_position) {
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
                            Rule::unique('job_positions', 'name')->where(fn ($query) => $query->where('company_id', $request->company_id)->where('department_id', $request->department_id))->ignore($id. 'id')
                            ],
            'department_id' => ['required', 
                            Rule::exists('departments', 'id')]
        ]);


        DB::beginTransaction();
        try {
            $job_position = JobPosition::find($id);
            $job_position->name             = $request->name;
            $job_position->description      = $request->description;
            $job_position->department_id    = $request->department_id;
            $job_position->company_id = $request->company_id;

            if ($job_position->save()) {
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
        $job_position = JobPosition::findOrFail($id);

        if($job_position->delete()){
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
}
