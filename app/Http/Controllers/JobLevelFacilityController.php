<?php

namespace App\Http\Controllers;

use App\Models\JobLevel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\JobLevelFacility;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobLevelFacilityController extends Controller
{
    public function index($job_level_id){
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['name' => "Master Data"],
            ['name' => lang("Menu Job Level"), 'link' => '/job-level'],
            ['name' => lang("Menu Job Level Facility")]
        ];

        $jobLevel = JobLevel::where('id', $job_level_id)->with(['company', 'jobPosition'])->first();

        return view('/content/job-level/facility', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'jobLevel'     => $jobLevel
        ]);
    }

    public function facilityDataTable(Request $request, $job_level_id)
    {
        $user = Auth::user();

        return DataTables::of(
                    JobLevelFacility::query()->where('job_level_id', $job_level_id)->with('component')
                    ->with('salary')
                )
                ->filter(function($query) use ($request){
                    if (!empty($request->search['value'])) {
                        $query->search($request->search['value']);
                    }
                })
                ->editColumn('name', function($row){
                    if($row->type == 'salary'){
                        $name = $row->salary->name;
                    }else{
                        $name = $row->component->name;
                    }
                    return $name;
                })
                ->editColumn('nominal', function($row){
                    if($row->type == 'salary'){
                        $nominal = $row->salary->nominal;
                    }else{
                        $nominal = $row->component->nominal;
                    }
                    return $nominal;
                })
                ->editColumn('actions', function() use ($user){
                    return [
                        'delete'    => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('delete job_position')) ? true : false
                    ];
                })
                ->addIndexColumn()
                ->rawColumns(['actions', 'name'])
                ->make();
    }

    public function store(Request $request, $job_level_id)
    {
        $this->validate($request, [
            'type'      => ['required','in:salary,allowance',
                            Rule::unique('job_level_facilities', 'type')->where(fn ($query) => $query->where('type', 'salary')->where('job_level_id', $job_level_id))],
            'salary'    => 'required_if:type,salary', 
            'allowance' => 'required_if:type,allowance'
        ]);

        DB::beginTransaction();
        try {
            $data = JobLevelFacility::create([
                'job_level_id'  => $job_level_id,
                'type'          => $request->type,
                'salary_id'     => $request->salary,
                'salary_component_id'    => $request->allowance
            ]);

            if ($data) {
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

    public function destroy($id)
    {
        $item = JobLevelFacility::findOrFail($id);

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
}
