<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['name' => "Master Data"],
            ['name' => lang('Menu Group')]
        ];
        $groups    = Group::when(!$user->hasRole('Super Admin'), function($q) use ($user){
                            $q->where('company_id', $user->company_id);
                        })->get();
        $companies      = Company::all();

        return view('/content/group/index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'groups'        => $groups,
            'companies'     => $companies
        ]);
    }

    public function groupDataTable(Request $request)
    {
        $user = Auth::user();

        return DataTables::of(
                    Group::query()->with('company')
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
        $job_level = Group::where('id', $id)->first();

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
            'name'          => ['required', 
                                Rule::unique('groups', 'name')->where(fn ($query) => $query->where('company_id', $request->company_id)->where('grade', $request->grade))],
            'grade'         => ['required',
                                Rule::unique('groups', 'grade')->where(fn ($query) => $query->where('company_id', $request->company_id)->where('name', $request->name))],
            'company_id'    => ['required', Rule::exists('companies', 'id')]
        ]);

        DB::beginTransaction();
        try {
            $group = Group::create([
                'name'              => $request->name,
                'grade'             => $request->grade,
                'company_id'        => $request->company_id,
                'description'       => $request->description
            ]);

            if ($group) {
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
            'name'          => ['required', 
                                Rule::unique('groups', 'name')->where(fn ($query) => $query->where('company_id', $request->company_id)->where('grade', $request->grade))->ignore($id. 'id')],
            'grade'         => ['required',
                                Rule::unique('groups', 'grade')->where(fn ($query) => $query->where('company_id', $request->company_id)->where('name', $request->name))->ignore($id. 'id')],
            'company_id'    => ['required', Rule::exists('companies', 'id')]
        ]);

        DB::beginTransaction();
        try {
            $group = Group::find($id);
            $group->name            = $request->name;
            $group->grade           = $request->grade;
            $group->description     = $request->description;
            $group->company_id      = $request->company_id;

            if ($group->save()) {
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
        $group = Group::findOrFail($id);

        if($group->delete()){
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
