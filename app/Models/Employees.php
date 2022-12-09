<?php

namespace App\Models;

use App\Http\Resources\EmployeesCategoryResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $guarded = [];

    public function payloadInsert($request)
    {
        $paylodaInsert['first_name']                    = $request->first_name;
        $paylodaInsert['last_name']                     = $request->last_name;
        $paylodaInsert['users_id']                      = $request->users_id;
        $paylodaInsert['employee_id']                   = $request->employee_id;
        $paylodaInsert['id_card']                       = $request->id_card;
        $paylodaInsert['national_number']               = $request->national_number;
        $paylodaInsert['employee_id_number']            = $request->employee_id;
        $paylodaInsert['mobile_phone']                  = $request->contact_no;
        $paylodaInsert['original_address']              = $request->address;
        $paylodaInsert['country_id']                    = $request->country;
        $paylodaInsert['province']                      = $request->province;
        $paylodaInsert['city']                          = $request->city;
        $paylodaInsert['zip_code']                      = $request->zip_code;
        $paylodaInsert['date_of_birth']                 = $request->date_of_birth;
        $paylodaInsert['gender_id']                     = $request->gender;
        $paylodaInsert['marital_status_id']             = $request->marital_status;
        $paylodaInsert['job_levels']                    = $request->job_level_id;
        $paylodaInsert['job_position_id']               = $request->job_position_id;
        $paylodaInsert['department_id']                 = $request->department_id;
        $paylodaInsert['company_id']                    = $request->company_id;
        $paylodaInsert['employee_work_status_id']       = $request->employee_work_status_id;
        $paylodaInsert['employee_status_id']            = $request->employee_status_id;
        $paylodaInsert['employment_status_id']          = $request->employment_status_id;
        $paylodaInsert['employee_category_id']          = $request->employee_category_id;
        $paylodaInsert['tribes']                        = $request->tribes;
        return $paylodaInsert;
    }

    public function payloadUpdate($request)
    {
        $paylodaUpdate['first_name']                    = $request->first_name;
        $paylodaUpdate['last_name']                     = $request->last_name;
        $paylodaUpdate['users_id']                      = $request->users_id;
        $paylodaUpdate['employee_id']                   = $request->employee_id;
        $paylodaUpdate['id_card']                       = $request->id_card;
        $paylodaUpdate['national_number']               = $request->national_number;
        $paylodaUpdate['employee_id_number']            = $request->employee_id;
        $paylodaUpdate['mobile_phone']                  = $request->contact_no;
        $paylodaUpdate['original_address']              = $request->address;
        $paylodaUpdate['country_id']                    = $request->country;
        $paylodaUpdate['province']                      = $request->province;
        $paylodaUpdate['city']                          = $request->city;
        $paylodaUpdate['zip_code']                      = $request->zip_code;
        $paylodaUpdate['date_of_birth']                 = $request->date_of_birth;
        $paylodaUpdate['gender_id']                     = $request->gender;
        $paylodaUpdate['marital_status_id']             = $request->marital_status;
        $paylodaUpdate['job_levels']                    = $request->job_level_id;
        $paylodaUpdate['job_position_id']               = $request->job_position_id;
        $paylodaUpdate['department_id']                 = $request->department_id;
        $paylodaUpdate['company_id']                    = $request->company_id;
        $paylodaInsert['employee_work_status_id']       = $request->employee_work_status_id;
        $paylodaInsert['employee_status_id']            = $request->employee_status_id;
        $paylodaInsert['employment_status_id']          = $request->employment_status_id;
        $paylodaUpdate['employee_category_id']          = $request->employee_category_id;
        $paylodaUpdate['tribes']                        = $request->tribes;
 
        return $paylodaUpdate;
    }

    protected static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->user() ? auth()->user()->id : 1;
            $model->updated_by = auth()->user() ? auth()->user()->id : 1;
        });

        static::updating(function($model) {
            $model->updated_by = auth()->user() ? auth()->user()->id : 1;
        });
    }


    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function jobPosition()
    {
        return $this->hasOne(JobPosition::class, 'id', 'job_position_id');
    }

    public function jobLevel()
    {
        return $this->hasOne(JobLevel::class, 'id', 'job_levels');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    public function country()
    {
        return $this->hasOne(Countries::class, 'id', 'country_id');
    }

    public function gender()
    {
        return $this->hasOne(Option::class, 'id', 'gender_id');
    }

    public function maritalStatus()
    {
        return $this->hasOne(Option::class, 'id', 'marital_status_id');
    }

    public function religion()
    {
        return $this->hasOne(Option::class, 'id', 'religion_id');
    }

    public function bloodGroup()
    {
        return $this->hasOne(Option::class, 'id', 'blood_group_id');
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updatedBy()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }
    
    public function employeesStatus()
    {
        return $this->hasOne(Option::class, 'id', 'employee_status_id');
    }

    public function employeesWorkStatus()
    {
        return $this->hasOne(EmployeesStatus::class, 'id', 'employee_work_status_id');
    }

    public function employmentStatus()
    {
        return $this->hasOne(Option::class, 'id', 'employment_status_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id', 'id');
    }

    public function employeesCategory()
    {
        return $this->hasOne(EmployeesCategory::class, 'id', 'employee_category_id');
    }

    public function salary()
    {
        return $this->hasOne(EmployeeSalary::class, 'employee_id', 'id')->latestOfMany();
    }

    public function socialProfile()
    {
        return $this->hasMany(EmployeesSocialProfile::class, 'employees_id', 'id');
    }

    public function empShift()
    {
        return $this->hasOne(EmployeesShift::class, 'employees_id', 'id');
    }

    public function shift()
    {
        return $this->hasOne(Shift::class, 'id', 'shift_id');
    }

    public function pph21()
    {
        return $this->hasOne(Pph21::class, 'id', 'ptkp_id');
    }

    public function bank()
    {
        return $this->hasOne(EmployeesBankAccounts::class, 'employees_id', 'id');
    }
   
}
