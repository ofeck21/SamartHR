<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeesFamilyStructureRequest;
use App\Services\EmployeesFamilyStructureServices;
use App\Services\EmployeesServices;
use App\Services\OptionServices;
use Illuminate\Http\Request;

class EmployeesFamilyStructureController extends Controller
{
    protected $employeesServices,
              $optionsServices,
              $employeesFamlyStructureServices;

    public function __construct() {
        $this->employeesServices = new EmployeesServices();
        $this->optionsServices = new OptionServices();
        $this->employeesFamlyStructureServices = new EmployeesFamilyStructureServices();
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
        $data['data']               = $this->employeesFamlyStructureServices->getById($id);
        // return $data['data'];
        if (!$data['show']) return redirect('employee');

        $data['list']               = 'content.employees.list.basic';

        $data['view']               = 'content.employees.tabs.tab8';
        // return $data['data'];
        $data['breadcrumbs']    = [
            ['name' => lang('Employees.View Employees')],
            ['name' => $data['show']->first_name." ".$data['show']->last_name],
            ['name' => lang('Employees.Family Structure')]
        ];
        return view('content.employees.show', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesFamilyStructureRequest $request)
    {
        return $this->employeesFamlyStructureServices->insertData($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesFamlyStructureServices
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeesFamilyStructureRequest $request,$id, $id_fs)
    {
        return $this->employeesFamlyStructureServices->updateData($id, $id_fs, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesFamlyStructureServices
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_fs)
    {
        return $this->employeesFamlyStructureServices->deleteData($id, $id_fs);
        
    }
}
