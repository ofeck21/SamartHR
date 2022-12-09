<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeesRequest;
use App\Imports\Excel as ImportsExcel;
use App\Models\Employees;
use App\Models\Pph21;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


use App\Services\CompanyServices;
use App\Services\CountriesServices;
use App\Services\DepartmentsServices;
use App\Services\EmployeesCategoryServices;
use App\Services\EmployeesLeaveServices;
use App\Services\EmployeesOnLeaveServices;
use App\Services\EmployeesServices;
use App\Services\EmployeesStatusServices;
use App\Services\ImportEmpServices;
use App\Services\JobLevelsServices;
use App\Services\JobPositionServices;
use App\Services\OptionServices;
use App\Services\ShiftServices;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EmployeesController extends Controller
{
    protected $employeesServices,
              $importEmpServices,
              $optionsServices,
              $companyServices,
              $departementServices,
              $jobPositionServices,
              $jobLevelServices,
              $employeesStatusServices,
              $employeesCategoryServices,
              $employeesLeaveServices,
              $employeesOnLeaveServices,
              $shiftServices,
              $countriesServices;

    public function __construct() {
        $this->employeesServices = new EmployeesServices();
        $this->countriesServices = new CountriesServices();
        $this->optionsServices = new OptionServices();
        $this->companyServices = new CompanyServices();
        $this->departementServices = new DepartmentsServices();
        $this->jobPositionServices = new JobPositionServices();
        $this->jobLevelServices = new JobLevelsServices();
        $this->employeesStatusServices = new EmployeesStatusServices();
        $this->employeesCategoryServices = new EmployeesCategoryServices();
        $this->employeesLeaveServices = new EmployeesLeaveServices();
        $this->shiftServices = new ShiftServices();
        $this->employeesOnLeaveServices = new EmployeesOnLeaveServices();
        $this->importEmpServices = new ImportEmpServices();
        
    }


    protected function master()
    {
        $data['country']            = $this->countriesServices->getAll();
        $data['options']            = $this->optionsServices->getAll();
        $data['company']            = $this->companyServices->getAll();
        $data['departement']        = $this->departementServices->getAll();
        $data['position']           = $this->jobPositionServices->getAll();
        $data['job_level']          = $this->jobLevelServices->getAll();
        $data['status']             = $this->employeesStatusServices->getAll();
        $data['category']           = $this->employeesCategoryServices->getAll();
        $data['shift']              = $this->shiftServices->getAll();
        return $data;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            return $this->employeesServices->getAll($request);
        }
        $data = $this->master();

        // return $data['shift'];
        $data['breadcrumbs']    = [
            ['name' => lang('Employees.List Employes')]
        ];
        return view('content.employees.index', $data);
    }


    public function show($id)
    {
        $data = $this->master();

        $data['show']               = $this->employeesServices->getById($id);
        // return $data['show'];
        $data['leave']              = $this->employeesLeaveServices->getTotal($id);
        $data['remaining_leave']    = $this->employeesOnLeaveServices->getById($id);
        $data['view']               = 'content.employees.tabs.tab1';
        $data['list']               = 'content.employees.list.basic';
        $data['ptkp']               = Pph21::where('company_id', $data['show']->company_id)->get();
        if (request()->type) {
            return $data['show'];
        }
        $data['breadcrumbs']    = [
            ['name' => lang('Employees.View Employees')],
            ['name' => $data['show']->first_name." ".$data['show']->last_name],
            ['name' => lang('Employees.Basic Information')]
        ];

        return view('content.employees.show', $data);
    }

    public function import(Request $request)
    {
        
        $data = $this->master();

        $data['excel']   = [];
        if ($request->isMethod('POST')) {
            $request->validate(['excelfile' => ['required', 'mimes:xlsx']]);
            $array = Excel::toArray(new ImportsExcel , request()->file('excelfile'));
            $excel = $this->importEmpServices->beforeImport($array);
            $data['excel']   = $excel;
        }

        $data['breadcrumbs']    = [
            ['name' => lang('Employees.List Employes')]
        ];
        return view('content.employees.import', $data);
    }

    public function importEmp(Request $request)
    {
        $request->validate([
            'employee_id.*'                 => ['required', 'distinct', 'unique:employees,employee_id'],
            'id_card.*'                     => ['required', 'distinct', 'unique:employees,id_card'],
            'national_number.*'             => ['required', 'distinct', 'unique:employees,national_number'],
            'first_name.*'                  => ['required'],
            'last_name.*'                   => ['required'],
            'username.*'                    => ['required', 'unique:users,name', 'distinct'],
            'email.*'                       => ['required', 'unique:users,email', 'distinct'],
            'password.*'                    => ['required'],
            'contact_no.*'                  => ['required', 'distinct', 'unique:employees,mobile_phone'],
            'address.*'                     => ['required'],
            'city.*'                        => ['required'],
            'province.*'                    => ['required'],
            'zip_code.*'                    => ['required'],
            'country.*'                     => ['required'],
            'tribes.*'                      => ['required'],
            'date_of_birth.*'               => ['required'],
            'gender.*'                      => ['required'],
            'marital_status.*'              => ['required'],
            'company_id.*'                  => ['required'],
            'department_id.*'               => ['required'],
            'job_position_id.*'             => ['required'],
            'job_level_id.*'                => ['required'],
            'employee_category_id.*'        => ['required'],
            'employee_work_status_id.*'     => ['required'],
            'employee_status_id.*'          => ['required'],
            'employment_status_id.*'        => ['required'],
            'employment_shift_id.*'         => ['required'],
        ]);

        return $this->importEmpServices->insertData($request);
    }

    public function update($id, EmployeesRequest $request)
    {
        return $this->employeesServices->updatetData($id,$request);
    }

    public function store(EmployeesRequest $request)
    {
        return $this->employeesServices->insertData($request);
    }

    public function destroy($id)
    {
        return $this->employeesServices->deleteData($id);
    }
}
