<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeesAllDocumentsRequest;
use App\Services\EmployeesAllDocumentsServices;
use App\Services\EmployeesServices;
use App\Services\OptionServices;
use Illuminate\Http\Request;

class EmployeesAllDocumentsController extends Controller
{
        protected 
        $employeesServices,
        $optionsServices,
        $employeesAllDocuments;

    public function __construct() {
        $this->employeesServices = new EmployeesServices();
        $this->optionsServices = new OptionServices();
        $this->employeesAllDocuments = new EmployeesAllDocumentsServices();
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
        $data['data']               = $this->employeesAllDocuments->getById($id);
        if (!$data['show']) return redirect('employee');

        $data['list']               = 'content.employees.list.basic';
        // return $data['data'];
        $data['view']               = 'content.employees.tabs.tab10';
        // return $data['data'];
        $data['breadcrumbs']    = [
            ['name' => lang('Employees.View Employees')],
            ['name' => $data['show']->first_name." ".$data['show']->last_name],
            ['name' => lang('Employees.All Documents')]
        ];
        return view('content.employees.show', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesAllDocumentsRequest $request)
    {
        return $this->employeesAllDocuments->insertData($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesAllDocuments
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeesAllDocumentsRequest $request,$id, $id_fs)
    {
        return $this->employeesAllDocuments->updateData($id, $id_fs, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesAllDocuments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_fs)
    {
        return $this->employeesAllDocuments->deleteData($id, $id_fs);
        
    }
}
