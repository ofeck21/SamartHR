<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeesWorkExperienceRequest;
use App\Models\EmployeesWorkExperience;
use App\Services\EmployeesServices;
use App\Services\EmployeesWorkExperienceServices;
use App\Services\OptionServices;
use Illuminate\Http\Request;

class EmployeesWorkExperienceController extends Controller
{
protected $employeesServices,
              $optionsServices,
              $employeesWorkExperienceServices;

    public function __construct() {
        $this->employeesServices = new EmployeesServices();
        $this->optionsServices = new OptionServices();
        $this->employeesWorkExperienceServices = new EmployeesWorkExperienceServices();
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
        $data['data']               = $this->employeesWorkExperienceServices->getById($id);
        // return $data['data'];
        if (!$data['show']) return redirect('employee');

        $data['view']               = 'content.employees.tabs.tab6';
        $data['list']               = 'content.employees.list.basic';

        // return $data['data'];
        $data['breadcrumbs']    = [
            ['name' => lang('Employees.View Employees')],
            ['name' => $data['show']->first_name." ".$data['show']->last_name],
            ['name' => lang('Employees.Work Experience')]
        ];
        return view('content.employees.show', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesWorkExperienceRequest $request)
    {
        return $this->employeesWorkExperienceServices->insertData($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesWorkExperienceServices
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeesWorkExperienceRequest $request,$id, $id_img)
    {
        return $this->employeesWorkExperienceServices->updateData($id, $id_img, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeesEmergencyContacts  $employeesWorkExperienceServices
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_img)
    {
        return $this->employeesWorkExperienceServices->deleteData($id, $id_img);
        
    }
}
