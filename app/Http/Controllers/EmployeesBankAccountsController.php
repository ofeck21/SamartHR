<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeesBankAccountsRequest;
use App\Services\EmployeesBankAccountsServices;
use App\Services\EmployeesServices;
use App\Services\OptionServices;
use Illuminate\Http\Request;

class EmployeesBankAccountsController extends Controller
{
        protected 
        $employeesServices,
        $optionsServices,
        $employeesBankAccountsServices;

    public function __construct() {
        $this->employeesServices = new EmployeesServices();
        $this->optionsServices = new OptionServices();
        $this->employeesBankAccountsServices = new EmployeesBankAccountsServices();
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
        $data['data']               = $this->employeesBankAccountsServices->getById($id);
        if (!$data['show']) return redirect('employee');

        $data['view']               = 'content.employees.tabs.tab9';
        $data['list']               = 'content.employees.list.basic';

        // return $data['data'];
        $data['breadcrumbs']    = [
            ['name' => lang('Employees.View Employees')],
            ['name' => $data['show']->first_name." ".$data['show']->last_name],
            ['name' => lang('Employees.Bank Account')]
        ];
        return view('content.employees.show', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesBankAccountsRequest $request)
    {
        return $this->employeesBankAccountsServices->insertData($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesBankAccountsServices
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeesBankAccountsRequest $request,$id, $id_fs)
    {
        return $this->employeesBankAccountsServices->updateData($id, $id_fs, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesBankAccountsServices
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_fs)
    {
        return $this->employeesBankAccountsServices->deleteData($id, $id_fs);
        
    }
}
