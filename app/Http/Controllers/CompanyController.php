<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index()
    {
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['name' => lang('Menu Application')],
            ['name' => lang('General.Company Data')]
        ];
        $categories = Option::where('group','company_type')->get();

        return view('/content/company/index', [
            'pageConfigs' => $pageConfigs, 
            'breadcrumbs' => $breadcrumbs,
            'categories'  => $categories
        ]);
    }

    public function companyDataTable(Request $request)
    {
        return DataTables::of(Company::query()->with(['type']))
                ->filter(function($query) use ($request){
                    if (!empty($request->search['value'])) {
                        $query->search($request->search['value']);
                    }
                })
                ->editColumn('status', function($row){
                    return $row->status == 'active' ? '<span class="badge bg-success">'.lang('General.Active').'</span>' : '<span class="badge bg-danger">'.lang('General.Non Active').'</span>';
                })
                ->editColumn('actions', function(){
                    return [
                        'edit'  => $this->authorize('edit company') ? true : false,
                        'delete' => $this->authorize('delete company') ? true : false, 
                    ];
                })
                ->addIndexColumn()
                ->rawColumns(['actions', 'status'])
                ->make();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'type'      => 'required|exists:options,id',
            'phone'     => 'nullable|numeric',
            'web'       => 'nullable|url',
            'address'   => 'required',
            'email'     => 'nullable|email'
        ]);
        DB::beginTransaction();
        try {
            $create = Company::create([
                'name'              => $request->name,
                'company_type_id'   => $request->type,
                'phone'             => $request->phone,
                'website'           => $request->web,
                'address'           => $request->address,
                'email'             => $request->email,
                'npwp'              => $request->npwp,
                'tdp'               => $request->tdp,
                'siup'              => $request->siup,
                'longitude'         => $request->longitude,
                'latitude'          => $request->latitude,
                'notes'             => $request->note
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

    public function show($id)
    {
        $company = Company::where('id', $id)->first();

        if($company!=null){
            return response()->json([
                'status'    => true,
                'message'   => 'Detail Data',
                'data'      => $company
            ]);
        }else{
            return response()->json([
                'status'    => false,
                'message'   => 'Data not found',
                'data'      => null
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required',
            'type'      => 'required|exists:options,id',
            'phone'     => 'nullable|numeric',
            'web'       => 'nullable|url',
            'address'   => 'required',
            'email'     => 'nullable|email'
        ]);

        $company = Company::find($id);
        if($company){
            $company->name              = $request->name;
            $company->company_type_id   = $request->type;
            $company->phone             = $request->phone;
            $company->website           = $request->web;
            $company->address           = $request->address;
            $company->email             = $request->email;
            $company->npwp              = $request->npwp;
            $company->tdp               = $request->tdp;
            $company->siup              = $request->siup;
            $company->status            = $request->status;
            $company->notes             = $request->note;
            $company->latitude          = $request->latitude;
            $company->longitude         = $request->longitude;

            if ($company->save()) {
                return response()->json([
                    'status'    => true,
                    'message'   => 'Data has been updated'
                ]);
            }else{
                return response()->json([
                    'status'    => true,
                    'message'   => 'Failed to update data'
                ], 400);
            }

        }else{
            return response()->json([
                'status'    => false,
                'message'   => 'Data not found',
                'data'      => null
            ]);
        }
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        if($company->delete()){
            return response()->json([
                'status'    => true,
                'message'   => 'Data has been deleted',
                'data'      => $company
            ]);
        }else{
            return response()->json([
                'status'    => false,
                'message'   => 'Data not found',
                'data'      => null
            ]);
        }
    }
}
