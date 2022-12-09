<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Company;
use App\Models\ShiftTime;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\RequiredIf;

class ShiftController extends Controller
{
    public function index()
    {
        $pageConfigs = ['pageHeader' => true];
        $breadcrumbs = [
            ['name' => "Shift List"]
        ];

        $companies      = Company::all();

        return view('/content/shift/index', [
            'pageConfigs'   => $pageConfigs,
            'breadcrumbs'   => $breadcrumbs,
            'companies'     => $companies
        ]);
    }

    public function shiftDataTable(Request $request)
    {
        $user = Auth::user();

        return DataTables::of(
                    Shift::query()->with('company')
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
                        'edit'      => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('update shift')) ? true : false,
                        'delete'    => ($user->hasRole('Super Admin') OR $user->hasPermissionTo('delete shift')) ? true : false
                    ];
                })
                ->addIndexColumn()
                ->rawColumns(['actions', 'name'])
                ->make();
    }

    public function show($id)
    {
        $shift = Shift::where('id', $id)->with('shiftTimes')->first();

        if($shift!=null){
            return response()->json([
                'status'    => true,
                'message'   => 'Detail Data',
                'data'      => $shift
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
                            Rule::unique('shifts', 'name')->where(fn ($query) => $query->where('company_id', $request->company_id))
                            ],
            'company_id' => ['required', 
                            Rule::exists('companies', 'id')],
            'allow_overtime' => 'required|boolean',
            'overtime_limit' => 'required_if:allow_overtime,true|max:24',
            'days'           => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            $shift = Shift::create([
                'name'      => $request->name,
                'company_id'    => $request->company_id,
                'allow_overtime' => $request->allow_overtime,
                'overtime_limit' => $request->overtime_limit
            ]);

            if ($shift) {
                // Create Shift Time
                foreach ($request->days as $day) {
                    ShiftTime::create([
                        'shift_id'  => $shift->id,
                        'day_num'    => date('w', strtotime($day['name'])),
                        'day_name'  => $day['name'],
                        'clock_in'  => $day['clock_in'],
                        'clock_out'  => $day['clock_out']
                    ]);
                }
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
                            Rule::unique('shifts', 'name')->where(fn ($query) => $query->where('company_id', $request->company_id))->ignore($id. 'id')
                            ],
            'company_id' => ['required', 
                            Rule::exists('companies', 'id')],
            'allow_overtime' => 'required|boolean',
            'overtime_limit' => 'required_if:allow_overtime,true|max:24',
            'days'           => 'required|array'
        ]);

        DB::beginTransaction();
        try {
            $shift = Shift::find($id);
            $shift->name            = $request->name;
            $shift->company_id      = $request->company_id;
            $shift->allow_overtime  = $request->allow_overtime;
            $shift->overtime_limit  = $request->overtime_limit;

            if ($shift->save()) {
                // Update Shift Time
                foreach ($request->days as $day) {
                    ShiftTime::where('id', $day['id'])->update([
                        'clock_in'  => $day['clock_in'],
                        'clock_out'  => $day['clock_out']
                    ]);
                }
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
        $shift = Shift::findOrFail($id);

        if($shift->delete()){
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
