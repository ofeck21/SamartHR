<?php

namespace App\Http\Controllers;

use App\Models\Bpjs;
use App\Models\Pph21;
use App\Models\Company;
use App\Models\Pph21Pkp;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BpjsPph21Controller extends Controller
{
    public function index()
    {
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['name' => lang('Menu Settings')],
            ['name' => "BPJS & PPH21"]
        ];

        $companies = Company::all();

        return view('/content/settings/bpjs-pph21', [
            'pageConfigs' => $pageConfigs, 
            'breadcrumbs' => $breadcrumbs,
            'companies'   => $companies
        ]);
    }

    public function bpjsDataTable(Request $request)
    {
        $company_id = $request->company ?? 0;
        $user = Auth::user();
        return DataTables::of(Bpjs::query()->where('company_id', $company_id))
                ->editColumn('actions', function() use ($user){
                    return [
                        'edit'      => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('update bpjs_pph21')) ? true : false,
                    ];
                })
                ->addIndexColumn()
                ->rawColumns(['actions'])
                ->make();
    }

    public function pph21DataTable(Request $request)
    {
        $company_id = $request->company ?? 0;
        $user = Auth::user();
        return DataTables::of(Pph21::query()->where('company_id', $company_id))
                ->editColumn('actions', function() use ($user){
                    return [
                        'edit'      => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('update bpjs_pph21')) ? true : false,
                    ];
                })
                ->addIndexColumn()
                ->rawColumns(['actions'])
                ->make();
    }

    public function pkpDataTable(Request $request)
    {
        $company_id = $request->company ?? 0;
        $user = Auth::user();
        return DataTables::of(Pph21Pkp::query()->where('company_id', $company_id))
                ->editColumn('actions', function() use ($user){
                    return [
                        'edit'      => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('update bpjs_pph21')) ? true : false,
                    ];
                })
                ->addIndexColumn()
                ->rawColumns(['actions'])
                ->make();
    }

    public function detailBpjs($id)
    {
        $bpjs = Bpjs::where('id', $id)->first();
        
        if($bpjs!=null){
            return response()->json([
                'status'    => true,
                'message'   => 'Detail Data',
                'data'      => $bpjs
            ]);
        }else{
            return response()->json([
                'status'    => false,
                'message'   => 'Data not found',
                'data'      => null
            ]);
        }
    }

    public function detailPph21($id)
    {
        $pph21 = Pph21::where('id', $id)->first();

        if($pph21!=null){
            return response()->json([
                'status'    => true,
                'message'   => 'Detail Data',
                'data'      => $pph21
            ]);
        }else{
            return response()->json([
                'status'    => false,
                'message'   => 'Data not found',
                'data'      => null
            ]);
        }
    }

    public function detailPkp($id)
    {
        $pph21 = Pph21Pkp::where('id', $id)->first();

        if($pph21!=null){
            return response()->json([
                'status'    => true,
                'message'   => 'Detail Data',
                'data'      => $pph21
            ]);
        }else{
            return response()->json([
                'status'    => false,
                'message'   => 'Data not found',
                'data'      => null
            ]);
        }
    }

    public function updateBpjs(Request $request, $id)
    {
        $this->validate($request, [
            'employee'      => 'required',
            'company'       => 'required'
        ]);

        $bpjs = Bpjs::find($id);
        if($bpjs){
            $bpjs->employee     = $request->employee;
            $bpjs->company      = $request->company;
            $bpjs->total        = $request->employee+$request->company;

            if ($bpjs->save()) {
                return response()->json([
                    'status'    => true,
                    'message'   => 'Data has been updated'
                ]);
            }else{
                return response()->json([
                    'status'    => false,
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

    public function updatePph21(Request $request, $id)
    {
        $this->validate($request, [
            'ptkp'      => 'required',
        ]);

        $pph21 = Pph21::find($id);
        if($pph21){
            $pph21->ptkp     = str_replace('.', '', $request->ptkp);

            if ($pph21->save()) {
                return response()->json([
                    'status'    => true,
                    'message'   => 'Data has been updated'
                ]);
            }else{
                return response()->json([
                    'status'    => false,
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

    public function updatePkp(Request $request, $id)
    {
        $this->validate($request, [
            'from'          => 'required',
            'until'         => 'required',
            'rate'          => 'required',
            'description'   => 'required',
        ]);

        $pkp = Pph21Pkp::find($id);
        if($pkp){
            $pkp->from          = str_replace('.', '', $request->from);
            $pkp->until         = str_replace('.', '', $request->until);
            $pkp->rate          = $request->rate;
            $pkp->description   = $request->description;

            if ($pkp->save()) {
                return response()->json([
                    'status'    => true,
                    'message'   => 'Data has been updated'
                ]);
            }else{
                return response()->json([
                    'status'    => false,
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

    public function setting(Request $request, $type)
    {
        $this->validate($request, [
            'company' => 'required'
        ]);

        switch ($type) {
            case 'bpjs':
                return $this->setBPJS($request->company);
                break;
            case 'ptkp':
                return $this->setPTKP($request->company);
                break;
            case 'pkp':
                return $this->setPKP($request->company);
                break;
            default:
                break;
        }
    }

    public function setBPJS($company_id)
    {
        $check = Bpjs::where('company_id', $company_id)->count();
        if($check > 0){
            return response()->json([
                'status'    => false,
                'message'   => 'Setting already exists'
            ], 400);
        }else{
            try {
                $data = [
                    [
                        'name'      => 'Jaminan Hari Tua',
                        'code'      => 'JHT',
                        'employee'  => '2',
                        'company'   => '3.7',
                        'total'     => '5.7',
                        'company_id'=> $company_id
                    ],
                    [
                        'name'      => 'Jaminan Kecelakaan Kerja',
                        'code'      => 'JKK',
                        'employee'  => '0',
                        'company'   => '0.89',
                        'total'     => '0.89',
                        'company_id'=> $company_id
                    ],
                    [
                        'name'      => 'Jaminan Kematian',
                        'code'      => 'JKM',
                        'employee'  => '0',
                        'company'   => '0.3',
                        'total'     => '0.3',
                        'company_id'=> $company_id
                    ],
                    [
                        'name'      => 'Jaminan Pensiun',
                        'code'      => 'JP',
                        'employee'  => '1',
                        'company'   => '2',
                        'total'     => '3',
                        'company_id'=> $company_id
                    ],
                    [
                        'name'      => 'Jaminan Kesehatan',
                        'code'      => 'JKS',
                        'employee'  => '1',
                        'company'   => '4',
                        'total'     => '5',
                        'company_id'=> $company_id
                    ],
                    [
                        'name'      => 'Asuransi Kecelakaan Diluar Hari Kerja',
                        'code'      => 'AKDHK',
                        'employee'  => '0',
                        'company'   => '0.24',
                        'total'     => '0.24',
                        'company_id'=> $company_id
                    ],
                ];
                DB::beginTransaction();
                foreach ($data as $bpjs) {
                    Bpjs::updateOrCreate(['code' => $bpjs['code'], 'company_id' => $company_id],$bpjs);
                }
                DB::commit();
                return response()->json([
                    'status'    => true,
                    'message'   => 'BPJS Setting has been created'
                ]);

            } catch (\Throwable $th) {
                return response()->json([
                    'status'    => false,
                    'message'   => $th->getMessage()
                ]);
            }
    
        }
    }

    public function setPTKP($company_id)
    {
        $check = Pph21::where('company_id', $company_id)->count();
        if($check > 0){
            return response()->json([
                'status'    => false,
                'message'   => 'Setting already exists'
            ], 400);
        }else{
            try {
                $data = [
                    [
                        'golongan'      => 'Tidak Kawin',
                        'code'          => 'TK-0',
                        'ptkp'          => '54000000',
                        'description'   => 'Tidak Kawin, Tanpa Tanggungan',
                        'company_id'    => $company_id
                    ],
                    [
                        'golongan'      => 'Tidak Kawin',
                        'code'          => 'TK-1',
                        'ptkp'          => '58500000',
                        'description'   => 'Tidak Kawin, 1 Tanggungan',
                        'company_id'    => $company_id
                    ],
                    [
                        'golongan'      => 'Tidak Kawin',
                        'code'          => 'TK-2',
                        'ptkp'          => '63000000',
                        'description'   => 'Tidak Kawin, 2 Tanggungan',
                        'company_id'    => $company_id
                    ],
                    [
                        'golongan'      => 'Tidak Kawin',
                        'code'          => 'TK-3',
                        'ptkp'          => '67500000',
                        'description'   => 'Tidak Kawin, 3 Tanggungan',
                        'company_id'    => $company_id
                    ],
                    [
                        'golongan'      => 'Kawin',
                        'code'          => 'K-0',
                        'ptkp'          => '58500000',
                        'description'   => 'Kawin, Tanpa Tanggungan',
                        'company_id'    => $company_id
                    ],
                    [
                        'golongan'      => 'Kawin',
                        'code'          => 'K-1',
                        'ptkp'          => '63000000',
                        'description'   => 'Kawin, 1 Tanggungan',
                        'company_id'    => $company_id
                    ],
                    [
                        'golongan'      => 'Kawin',
                        'code'          => 'K-2',
                        'ptkp'          => '67500000',
                        'description'   => 'Kawin, 2 Tanggungan',
                        'company_id'    => $company_id
                    ],
                    [
                        'golongan'      => 'Kawin',
                        'code'          => 'K-3',
                        'ptkp'          => '72000000',
                        'description'   => 'Kawin, 3 Tanggungan',
                        'company_id'    => $company_id
                    ],
                    [
                        'golongan'      => 'Kawin + Istri',
                        'code'          => 'KI-0',
                        'ptkp'          => '112500000',
                        'description'   => 'Penghasilan Suami dan Istri Digabung, Tanpa Tanggungan',
                        'company_id'    => $company_id
                    ],
                    [
                        'golongan'      => 'Kawin + Istri',
                        'code'          => 'KI-1',
                        'ptkp'          => '117000000',
                        'description'   => 'Penghasilan Suami dan Istri Digabung, 1 Tanggungan',
                        'company_id'    => $company_id
                    ],
                    [
                        'golongan'      => 'Kawin + Istri',
                        'code'          => 'KI-2',
                        'ptkp'          => '121500000',
                        'description'   => 'Penghasilan Suami dan Istri Digabung, 2 Tanggungan',
                        'company_id'    => $company_id
                    ],
                    [
                        'golongan'      => 'Kawin + Istri',
                        'code'          => 'KI-3',
                        'ptkp'          => '126000000',
                        'description'   => 'Penghasilan Suami dan Istri Digabung, 3 Tanggungan',
                        'company_id'    => $company_id
                    ],
                ];
                DB::beginTransaction();
                foreach ($data as $pph21) {
                    Pph21::updateOrCreate(['code' => $pph21['code'], 'company_id' => $company_id],$pph21);
                }
                DB::commit();
                return response()->json([
                    'status'    => true,
                    'message'   => 'PPH21 PTKP Setting has been created'
                ]);

            } catch (\Throwable $th) {
                return response()->json([
                    'status'    => false,
                    'message'   => $th->getMessage()
                ]);
            }
    
        }
    }

    public function setPKP($company_id)
    {
        $check = Pph21Pkp::where('company_id', $company_id)->count();
        if($check > 0){
            return response()->json([
                'status'    => false,
                'message'   => 'Setting already exists'
            ], 400);
        }else{
            try {
                $data = [
                    [
                        'code'  => 'pkp0',
                        'from'  => 0,
                        'until' => 50000000,
                        'rate'  => 5,
                        'description'   => 'PKP sampai dengan 50 juta rupiah'
                    ],
                    [
                        'code'  => 'pkp1',
                        'from'  => 50000001,
                        'until' => 250000000,
                        'rate'  => 15,
                        'description'   => 'PKP 50 sampai dengan 250 juta rupiah'
                    ],
                    [
                        'code'  => 'pkp2',
                        'from'  => 250000001,
                        'until' => 500000000,
                        'rate'  => 25,
                        'description'   => 'PKP 250 sampai dengan 500 juta rupiah '
                    ],
                    [
                        'code'  => 'pkp3',
                        'from'  => 500000001,
                        'until' => 0,
                        'rate'  => 30,
                        'description'   => 'PKP diatas 500 juta rupiah'
                    ]
                ];
        
                DB::beginTransaction();
                foreach ($data as $value) {
                    Pph21Pkp::updateOrCreate(['code' => $value['code'], 'company_id' => $company_id],$value);
                }
                DB::commit();
                return response()->json([
                    'status'    => true,
                    'message'   => 'PPH21 PKP Setting has been created'
                ]);

            } catch (\Throwable $th) {
                return response()->json([
                    'status'    => false,
                    'message'   => $th->getMessage()
                ]);
            }
    
        }
    }
}
