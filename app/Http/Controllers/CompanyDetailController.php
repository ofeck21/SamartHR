<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyFile;
use App\Models\CompanyPic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class CompanyDetailController extends Controller
{
    public function index($company_id)
    {
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['name' => lang('Menu Application')],
            ['name' => lang('General.Company'), 'link'  => '/companies'],
            ['name' => lang('General.Detail Company')],
        ];

        $company = Company::where('id', $company_id)->first();

        return view('/content/company/detail', [
            'pageConfigs' => $pageConfigs, 
            'breadcrumbs' => $breadcrumbs,
            'company'       => $company
        ]);
    }

    public function updateLargeLogo(Request $request, $company_id)
    {
        $this->validate($request,[
            'file'  => 'required'
        ]);

        $file = $request->file('file');
        $name = $company_id.time().'.'.$file->getClientOriginalExtension();;

        try {
            Storage::putFileAs('public/images/company', $file, $name, 'public');

            Company::where('id', $company_id)->update([
                'big_logo'  => $name
            ]);

            return [
                'status'    => true,
                'data'      => asset('storage/images/company/'.$name),
                'message'   => lang('General.Logo Change')
            ];
        } catch (\Throwable $th) {
            return [
                'status'    => false,
                'message'   => $th->getMessage()
            ];
        }
        
    }

    public function updateSmallLogo(Request $request, $company_id)
    {
        $this->validate($request,[
            'file'  => 'required'
        ]);

        $file = $request->file('file');
        $name = $company_id.time().'.'.$file->getClientOriginalExtension();;

        try {
            Storage::putFileAs('public/images/company', $file, $name, 'public');

            Company::where('id', $company_id)->update([
                'smal_logo'  => $name
            ]);

            return [
                'status'    => true,
                'data'      => asset('storage/images/company/'.$name),
                'message'   => lang('General.Logo Change')
            ];
        } catch (\Throwable $th) {
            return [
                'status'    => false,
                'message'   => $th->getMessage()
            ];
        }
        
    }

    public function picDataTable(Request $request, $company_id)
    {
        return DataTables::of(CompanyPic::where('company_id', $company_id))
                    ->filter(function($query) use ($request){
                        if (!empty($request->search['value'])) {
                            $query->search($request->search['value']);
                        }
                    })
                    ->editColumn('actions', function(){
                        return [
                            'edit'  => $this->authorize('edit company') ? true : false,
                            'delete' => $this->authorize('delete company') ? true : false, 
                        ];
                    })
                    ->addIndexColumn()
                    ->rawColumns(['actions'])
                    ->make();
    }

    public function fileDataTable(Request $request, $company_id)
    {
        return DataTables::of(CompanyFile::where('company_id', $company_id))
                    ->filter(function($query) use ($request){
                        if (!empty($request->search['value'])) {
                            $query->search($request->search['value']);
                        }
                    })
                    ->editColumn('actions', function(){
                        return [
                            'edit'  => $this->authorize('edit company') ? true : false,
                            'delete' => $this->authorize('delete company') ? true : false, 
                        ];
                    })
                    ->addIndexColumn()
                    ->rawColumns(['actions'])
                    ->make();
    }

    public function storePIC(Request $request, $company_id)
    {
        $this->validate($request, [
            'name'      => 'required',
            'phone'     => 'required|numeric'
        ]);
        DB::beginTransaction();
        try {
            $create = CompanyPic::create([
                'company_id'    => $company_id,
                'name'          => $request->name,
                'phone'         => $request->phone,
                'description'   => $request->description
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

    public function storeFile(Request $request, $company_id)
    {
        $this->validate($request, [
            'file_name'     => 'required',
            'file'          => 'required|file'
        ]);

        DB::beginTransaction();
        $file = $request->file('file');
        $file_name = date('Ymd').'_'.$file->getClientOriginalName();
        try {
            Storage::putFileAs('public/file/company', $file, $file_name, 'public');

            $create = CompanyFile::create([
                'company_id'    => $company_id,
                'name'          => $request->file_name,
                'file'          => $file_name,
                'description'   => $request->file_description
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

    public function showPIC($id)
    {
        $data = CompanyPic::where('id', $id)->first();

        if($data!=null){
            return response()->json([
                'status'    => true,
                'message'   => 'Detail Data',
                'data'      => $data
            ]);
        }else{
            return response()->json([
                'status'    => false,
                'message'   => 'Data not found',
                'data'      => null
            ]);
        }
    }

    public function showFile($id)
    {
        $data = CompanyFile::where('id', $id)->first();

        if($data!=null){
            return response()->json([
                'status'    => true,
                'message'   => 'Detail Data',
                'data'      => $data
            ]);
        }else{
            return response()->json([
                'status'    => false,
                'message'   => 'Data not found',
                'data'      => null
            ]);
        }
    }

    public function updatePIC(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required',
            'phone'     => 'required'
        ]);

        $item = CompanyPic::find($id);
        if($item){
            $item->name              = $request->name;
            $item->phone             = $request->phone;
            $item->description       = $request->description;

            if ($item->save()) {
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

    public function updateFile(Request $request, $id)
    {
        $this->validate($request, [
            'file_name'     => 'required',
            'file'          => 'nullable|file'
        ]);

        $item = CompanyFile::find($id);
        if($item){
            $file = $request->file('file');
            if($file != null){
                $file_name = date('Ymd').'_'.str_replace(' ', '-',$file->getClientOriginalName());

                if(Storage::disk('public')->exists('file/company/'.$item->file))
                {
                    Storage::disk('public')->delete('file/company/'.$item->file);
                }
                Storage::putFileAs('public/file/company', $file, $file_name, 'public');

                $item->file             = $file_name;
            }

            $item->name              = $request->file_name;
            $item->description       = $request->file_description;

            if ($item->save()) {
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

    public function destroyPIC($id)
    {
        $data = CompanyPic::findOrFail($id);

        if($data->delete()){
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

    public function destroyFile($id)
    {
        $data = CompanyFile::findOrFail($id);

        if(Storage::exists('public/file/company/'.$data->file))
        {
            Storage::delete('public/file/company/'.$data->file);
        }
        if($data->delete()){
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
