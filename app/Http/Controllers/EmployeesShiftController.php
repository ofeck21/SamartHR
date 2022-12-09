<?php

namespace App\Http\Controllers;

use App\Services\EmployeesServices;
use App\Services\EmployeesSalaryServices;
use App\Services\EmployeesShiftServices;
use App\Services\OptionServices;
use App\Services\SalaryComponentsServices;
use App\Services\SalaryServices;
use App\Services\ShiftServices;
use Illuminate\Http\Request;

class EmployeesShiftController extends Controller
{
    protected 
    $employeesServices,
    $optionsServices,
    // $employeesBasicSalary,
    // $salaryComponents,
    $shiftServeices,
    $employeesShiftServices;

    public function __construct() {
        $this->employeesServices = new EmployeesServices();
        $this->optionsServices = new OptionServices();
        $this->shiftServeices = new ShiftServices();
        $this->employeesShiftServices = new EmployeesShiftServices();
        // $this->salary = new SalaryServices();
        // $this->salaryComponents = new SalaryComponentsServices();
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
        $data['shift']             = $this->shiftServeices->getAll();
        // $data['components']         = $this->salaryComponents->getAll();
        
        $data['data']               = $this->employeesShiftServices->getById($id);
        // return $data['data'];
        // return $data['shift'];
        if (!$data['show']) return redirect('employee');



        $data['view']               = 'content.employees.step.shift';
        // $data['list']               = 'content.employees.list.salary';

        // return $data['data'];
        $data['breadcrumbs']    = [
            ['name' => lang('Employees.View Employees')],
            ['name' => $data['show']->first_name." ".$data['show']->last_name],
            ['name' => lang('Employees.Shift')],
        ];
        return view('content.employees.show', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->employeesShiftServices->insertData($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesBasicSalary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id, $id_fs)
    {
        return $this->employeesBasicSalary->updateData($id, $id_fs, $request);
    }

}
