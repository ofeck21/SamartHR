<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeesSocialProfileRequest;
use App\Models\EmployeesSocialProfile;
use Illuminate\Http\Request;

use App\Services\EmployeesServices;
use App\Services\EmployeesSocialProfileServices;
use App\Services\OptionServices;

class EmployeesSocialProfileController extends Controller
{

    protected $employeesServices,
              $optionsServices,
              $employeesSocialProfileServices;

    public function __construct() {
        $this->employeesServices = new EmployeesServices();
        $this->optionsServices = new OptionServices();
        $this->employeesSocialProfileServices = new EmployeesSocialProfileServices();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data['show']               = $this->employeesServices->getById($id);
        $data['data']               = $this->employeesSocialProfileServices->getById($id);
        // return $data['data'];
        if (!$data['show']) return redirect('employee');

        $data['view']               = 'content.employees.tabs.tab4';
        $data['list']               = 'content.employees.list.basic';

        // return $data['data'];
        $data['breadcrumbs']    = [
            ['name' => lang('Employees.View Employees')],
            ['name' => $data['show']->first_name." ".$data['show']->last_name],
            ['name' => lang('Employees.Social Profile')]
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
    public function store(EmployeesSocialProfileRequest $request)
    {
        return $this->employeesSocialProfileServices->insertData($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeesSocialProfile  $employeesSocialProfile
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeesSocialProfile $employeesSocialProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeesSocialProfile  $employeesSocialProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeesSocialProfile $employeesSocialProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeesSocialProfile  $employeesSocialProfile
     * @return \Illuminate\Http\Response
     */
    public function update($id_s, $id, EmployeesSocialProfileRequest $request)
    {
        return $this->employeesSocialProfileServices->updateData($id_s, $id, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeesSocialProfile  $employeesSocialProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids, $id)
    {
        return $this->employeesSocialProfileServices->deleteData($id);
    }
}
