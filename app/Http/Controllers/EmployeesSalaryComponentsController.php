<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeesSalaryComponentsRequest;
use App\Http\Requests\EmployeesSalaryRequest;
use App\Services\EmployeesSalaryComponentsServices;
use App\Services\EmployeesSalaryServices;
use App\Services\EmployeesServices;
use App\Services\OptionServices;
use App\Services\SalaryComponentsServices;
use App\Services\SalaryServices;
use Illuminate\Http\Request;

class EmployeesSalaryComponentsController extends Controller
{
    protected 
    $employeesServices,
    $optionsServices,
    $employeesBasicComponentsSalary,
    $salaryComponents,
    $salary;

    public function __construct() {
        $this->employeesServices = new EmployeesServices();
        $this->optionsServices = new OptionServices();
        $this->employeesBasicComponentsSalary = new EmployeesSalaryComponentsServices();
        $this->salary = new SalaryServices();
        $this->salaryComponents = new SalaryComponentsServices();
    }

    protected function master()
    {
        $data['options']            = $this->optionsServices->getAll();
        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $components)
    {
        $data = $this->master();
        $data['show']               = $this->employeesServices->getById($id);
        $data['salary']             = $this->salary->getAll();
        $data['components']         = $this->salaryComponents->getAll();
        $data['componentsid']       = $this->salaryComponents->getById($components);
        
        $data['data']               = $this->employeesBasicComponentsSalary->getById($id, $components);
        // return $data;
        if (!$data['show']) return redirect('employee');



        $data['view']               = 'content.employees.step.tab2';
        $data['list']               = 'content.employees.list.salary';

        // return $data['data'];
        $data['breadcrumbs']    = [
            ['name' => lang('Employees.View Employees')],
            ['name' => $data['show']->first_name." ".$data['show']->last_name],
            ['name' => lang('Employees.Set Salary')],
            ['name' => $data['componentsid']->name]
        ];
        return view('content.employees.show', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesSalaryComponentsRequest $request , $id, $code)
    {
        return $this->employeesBasicComponentsSalary->insertData($request, $id, $code);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesBasicComponentsSalary
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeesSalaryComponentsRequest $request, $id, $code, $id_data)
    {
        return $this->employeesBasicComponentsSalary->updateData($id, $code, $id_data, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesBasicComponentsSalary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_fs)
    {
        return $this->employeesBasicComponentsSalary->deleteData($id, $id_fs);
        
    }
}
