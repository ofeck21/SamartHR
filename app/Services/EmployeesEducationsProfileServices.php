<?php
namespace App\Services;

use App\Http\Resources\EmployeesEducationProfileResource;
use App\Http\Resources\EmployeesEmergencyContactsResource;
use App\Models\EmployeesEducationProfile;
use App\Models\EmployeesEmergencyContacts;
use App\ResponseServices\ResponseService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class EmployeesEducationsProfileServices 
{
    protected $employeesEducationsProfileModel;

    public function __construct() {
        $this->employeesEducationsProfileModel = new EmployeesEducationProfile();
    }

    public function getById($id)
    {
        try {
            $id = Crypt::decryptString($id);
            $data = $this->employeesEducationsProfileModel->where('employees_id', $id)->get();
            // return EmployeesEducationProfileResource::collection($data)->toJson();
            return ResponseService::toArray(EmployeesEducationProfileResource::collection($data)->toJson());
        } catch (\Throwable $th) {
            return ResponseService::toArray(EmployeesEducationProfileResource::collection([])->toJson());
        }
    }

    public function insertData($request)
    {
        try {
            DB::beginTransaction();
            
            $id = Crypt::decryptString($request->id);
            $payloadInsert['employees_id']              = $id;
            $payloadInsert['school_type']               = $request->type; 
            $payloadInsert['school_level']              = $request->school_level; 
            $payloadInsert['school_name']               = $request->school_name; 
            $payloadInsert['city']                      = $request->city; 
            $payloadInsert['start']                     = $request->start; 
            $payloadInsert['finish']                    = $request->finish; 
            $payloadInsert['graduated']                 = $request->graduated; 
            $newData = $this->employeesEducationsProfileModel->create($payloadInsert);
            DB::commit();

            return ['status'    => true,
                    'message'   => 'Success',
                    'data'      => $newData];
        } catch (\Throwable $th) {
            return ['status'    => false,
                    'message'   => 'Error',
                    'data'      => null];
        }
    }


    public function updateData($id, $id_img, $request)
    {
        $id = Crypt::decryptString($request->id);
        $checkData = $this->employeesEducationsProfileModel->find($id_img);
        $roles = [];
        if ($checkData->phone_number!= $request->phone_number) $roles['phone_number'] = ['required','unique:employees_emergency_contacts,phone_number'];
        $request->validate($roles);
        try {
            DB::beginTransaction();
            
            
            $payloadInsert['employees_id']              = $id;
            $payloadInsert['status_family_stucture_id'] = $request->family_structure_status;
            $payloadInsert['name']                      = $request->name;
            $payloadInsert['phone_number']              = $request->phone_number;
            $payloadInsert['description']               = $request->description;
            

            $checkData->update($payloadInsert);
            DB::commit();

            return ['status'    => true,
                    'message'   => 'Success',
                    'data'      => $checkData];
        } catch (\Throwable $th) {
            return ['status'    => false,
                    'message'   => 'Error',
                    'data'      => null];
        }
    }


    public function deleteData($id, $id_img)
    {
        try {
            DB::beginTransaction();
            
            $deleteData = $this->employeesEducationsProfileModel->find($id_img);
            $deleteData->delete();
            DB::commit();

            return ['status'    => true,
                    'message'   => 'Success',
                    'data'      => $deleteData];
        } catch (\Throwable $th) {
            return ['status'    => false,
                    'message'   => 'Error',
                    'data'      => null];
        }
    }
}