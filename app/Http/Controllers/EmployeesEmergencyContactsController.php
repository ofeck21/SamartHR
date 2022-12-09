<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeesEmergencyContactsRequest;
use App\Models\EmployeesEmergencyContacts;
use Illuminate\Http\Request;

use App\Services\EmployeesEmergencyContactsServices;
use App\Services\EmployeesServices;
use App\Services\OptionServices;

class EmployeesEmergencyContactsController extends Controller
{
    protected $employeesServices,
              $optionsServices,
              $employeesEmergencyContactsServices;

    public function __construct() {
        $this->employeesServices = new EmployeesServices();
        $this->optionsServices = new OptionServices();
        $this->employeesEmergencyContactsServices = new EmployeesEmergencyContactsServices();
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
        $data['data']               = $this->employeesEmergencyContactsServices->getById($id);
        if (!$data['show']) return redirect('employee');

        $data['list']               = 'content.employees.list.basic';

        // return $data['data'];
        $data['view']               = 'content.employees.tabs.tab3';
        // return $data['data'];
        $data['breadcrumbs']    = [
            ['name' => lang('Employees.View Employees')],
            ['name' => $data['show']->first_name." ".$data['show']->last_name],
            ['name' => lang('Employees.Emergency Contacts')]
        ];
        return view('content.employees.show', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesEmergencyContactsRequest $request)
    {
        return $this->employeesEmergencyContactsServices->insertData($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesEmergencyContactsServices
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeesEmergencyContacts $employeesEmergencyContactsServices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesEmergencyContactsServices
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeesEmergencyContacts $employeesEmergencyContactsServices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesEmergencyContactsServices
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeesEmergencyContactsRequest $request,$id, $id_img)
    {
        return $this->employeesEmergencyContactsServices->updateData($id, $id_img, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesEmergencyContactsServices
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_img)
    {
        return $this->employeesEmergencyContactsServices->deleteData($id, $id_img);
        
    }
}
