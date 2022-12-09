<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeesSalaryRequest;
use App\Services\EmployeesServices;
use App\Services\EmployeesSalaryServices;
use App\Services\OptionServices;
use App\Services\SalaryComponentsServices;
use App\Services\SalaryServices;
use Illuminate\Http\Request;

class EmployeesSalaryController extends Controller
{
    protected 
    $employeesServices,
    $optionsServices,
    $employeesBasicSalary,
    $salaryComponents,
    $salary;

    public function __construct() {
        $this->employeesServices = new EmployeesServices();
        $this->optionsServices = new OptionServices();
        $this->employeesBasicSalary = new EmployeesSalaryServices();
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
    public function index($id)
    {
        $data = $this->master();
        $data['show']               = $this->employeesServices->getById($id);
        $data['salary']             = $this->salary->getAll();
        $data['components']         = $this->salaryComponents->getAll();
        
        $data['data']               = $this->employeesBasicSalary->getById($id);
        // return $data['salary'];
        if (!$data['show']) return redirect('employee');



        $data['view']               = 'content.employees.step.tab1';
        $data['list']               = 'content.employees.list.salary';

        // return $data['data'];
        $data['breadcrumbs']    = [
            ['name' => lang('Employees.View Employees')],
            ['name' => $data['show']->first_name." ".$data['show']->last_name],
            ['name' => lang('Employees.Set Salary')],
            ['name' => lang('Employees.Basic Salary')]
        ];
        return view('content.employees.show', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesSalaryRequest $request)
    {
        return $this->employeesBasicSalary->insertData($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesBasicSalary
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeesSalaryRequest $request,$id, $id_fs)
    {
        return $this->employeesBasicSalary->updateData($id, $id_fs, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesBasicSalary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_fs)
    {
        return $this->employeesBasicSalary->deleteData($id, $id_fs);
        
    }
}
