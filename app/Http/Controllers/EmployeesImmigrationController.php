<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeesImmigrationRequest;
use App\Models\EmployeesImmigration;
use App\Http\Requests\EmployeesRequest;
use App\Models\Employees;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


use App\Services\CompanyServices;
use App\Services\CountriesServices;
use App\Services\DepartmentsServices;
use App\Services\EmployeesCategoryServices;
use App\Services\EmployeesImmigrationsServices;
use App\Services\EmployeesLeaveServices;
use App\Services\EmployeesOnLeaveServices;
use App\Services\EmployeesServices;
use App\Services\EmployeesStatusServices;
use App\Services\JobLevelsServices;
use App\Services\JobPositionServices;
use App\Services\OptionServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeesImmigrationController extends Controller
{
    protected $employeesServices,
              $optionsServices,
              $companyServices,
              $departementServices,
              $jobPositionServices,
              $jobLevelServices,
              $employeesStatusServices,
              $employeesCategoryServices,
              $employeesLeaveServices,
              $employeesOnLeaveServices,
              $employeesImmigrationsServices,
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
        $this->employeesImmigrationsServices = new EmployeesImmigrationsServices();
        $this->employeesOnLeaveServices = new EmployeesOnLeaveServices();

    }


    protected function master()
    {
        $data['country']            = $this->countriesServices->getAll();
        $data['options']            = $this->optionsServices->getAll();
        return $data;
    }

    public function index($id)
    {
        $data = $this->master();
        $data['show']               = $this->employeesServices->getById($id);
        $data['data']               = $this->employeesImmigrationsServices->getById($id);
        if (!$data['show']) return redirect('employee');

        $data['view']               = 'content.employees.tabs.tab2';
        $data['list']               = 'content.employees.list.basic';

        // return $data['data'];
        $data['breadcrumbs']    = [
            ['name' => lang('Employees.View Employees')],
            ['name' => $data['show']->first_name." ".$data['show']->last_name],
            ['name' => lang('Employees.Assigned Immigration')]
        ];
        return view('content.employees.show', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function files($id, $file)
    {
        return Storage::get('employeeImmigrationFiles/'.$file);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesImmigrationRequest $request)
    {
        return $this->employeesImmigrationsServices->insertData($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeesImmigration  $employeesImmigration
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeesImmigration $employeesImmigration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeesImmigration  $employeesImmigration
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeesImmigration $employeesImmigration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeesImmigration  $employeesImmigration
     * @return \Illuminate\Http\Response
     */
    public function update( EmployeesImmigrationRequest $request, $id, $id_img)
    {
        return $this->employeesImmigrationsServices->updateData($id, $id_img,$request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeesImmigration  $employeesImmigration
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_img)
    {
        return $this->employeesImmigrationsServices->deleteData($id, $id_img);
    }
}
