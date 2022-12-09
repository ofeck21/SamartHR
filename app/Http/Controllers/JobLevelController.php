<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobLevel;
use App\Models\JobPosition;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobLevelController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['name' => "Job Level List"]
        ];
        $positions    = JobPosition::when(!$user->hasRole('Super Admin'), function($q) use ($user){
            $q->where('company_id', $user->company_id);
        })->get();
        $companies      = Company::all();
        
        return view('/content/job-level/index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'positions'     => $positions,
            'companies'     => $companies
        ]);
    }

    public function jobLevelDataTable(Request $request)
    {
        $user = Auth::user();

        return DataTables::of(
                    JobLevel::query()
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
                ->editColumn('position', function($row){
                    return $row->jobPosition != null ? $row->jobPosition->name : '';
                })
                ->editColumn('actions', function() use ($user){
                    return [
                        'edit'      => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('update job_level')) ? true : false,
                        'delete'    => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('delete job_level')) ? true : false
                    ];
                })
                ->addIndexColumn()
                ->rawColumns(['actions', 'name'])
                ->make();
    }

    public function show($id)
    {
        $job_level = JobLevel::where('id', $id)->first();

        if($job_level!=null){
            return response()->json([
                'status'    => true,
                'message'   => 'Detail Data',
                'data'      => $job_level
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
                            Rule::unique('job_levels', 'name')->where(fn ($query) => $query->where('company_id', $request->company_id)->where('job_position_id', $request->position_id))],
            'position_id' => ['required', 
                            Rule::exists('job_positions', 'id')]
        ]);

        DB::beginTransaction();
        try {
            $job_level = JobLevel::create([
                'job_position_id'   => $request->position_id,
                'name'              => $request->name,
                'company_id'        => $request->company_id,
                'description'       => $request->description
            ]);

            if ($job_level) {
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
                            Rule::unique('job_levels', 'name')->where(fn ($query) => $query->where('company_id', $request->company_id)->where('job_position_id', $request->position_id))->ignore($id, 'id')],
            'position_id' => ['required', 
                            Rule::exists('job_positions', 'id')]
        ]);

        $user = Auth::user();

        DB::beginTransaction();
        try {
            $job_level = JobLevel::find($id);
            $job_level->name     = $request->name;
            $job_level->company_id = $request->company_id;
            $job_level->job_position_id = $request->position_id;
            $job_level->description = $request->description;

            if ($job_level->save()) {
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
        $job_level = JobLevel::findOrFail($id);

        if($job_level->delete()){
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
