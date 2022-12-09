<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index()
    {
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['name' => "Deparment List"]
        ];
        $companies = Company::all();
        
        return view('/content/department/index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'companies'     => $companies
        ]);
    }

    public function departmentDataTable(Request $request)
    {
        $user = Auth::user();

        return DataTables::of(
                    Department::query()->with('company')
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
                        'edit'      => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('update department')) ? true : false,
                        'delete'    => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('delete department')) ? true : false, 
                    ];
                })
                ->addIndexColumn()
                ->rawColumns(['actions', 'name'])
                ->make();
    }

    public function show($id)
    {
        $deparment = Department::where('id', $id)->first();

        if($deparment!=null){
            return response()->json([
                'status'    => true,
                'message'   => 'Detail Data',
                'data'      => $deparment
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
                            Rule::unique('departments', 'name')->where(fn ($query) => $query->where('company_id', $request->company_id))
                        ]
        ]);

        DB::beginTransaction();
        try {
            $deparment = Department::create([
                'name'          => $request->name,
                'description'   => $request->description,
                'company_id'    => $request->company_id
            ]);

            if ($deparment) {
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
            'name'      => [
                'required',
                Rule::unique('departments', 'name')->where(fn ($query) => $query->where('company_id', $request->company_id))->ignore($id. 'id')
            ]
        ]);

        $user = Auth::user();

        DB::beginTransaction();
        try {
            $deparment = Department::find($id);
            $deparment->name            = $request->name;
            $deparment->description     = $request->description;
            $deparment->company_id      = $request->company_id;

            if ($deparment->save()) {
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
        $deparment = Department::findOrFail($id);

        if($deparment->delete()){
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
