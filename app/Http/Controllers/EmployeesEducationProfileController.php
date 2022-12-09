<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeesEducationProfileRequest;
use App\Models\EmployeesEducationProfile;
use App\Services\EmployeesEducationsProfileServices;
use App\Services\EmployeesServices;
use App\Services\OptionServices;
use Illuminate\Http\Request;

class EmployeesEducationProfileController extends Controller
{
    protected $employeesServices,
              $optionsServices,
              $employeesEducationProfileServices;

    public function __construct() {
        $this->employeesServices = new EmployeesServices();
        $this->optionsServices = new OptionServices();
        $this->employeesEducationProfileServices = new EmployeesEducationsProfileServices();
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
        $data['data']               = $this->employeesEducationProfileServices->getById($id);
        if (!$data['show']) return redirect('employee');

        $data['list']               = 'content.employees.list.basic';

        // return $data['data'];
        $data['view']               = 'content.employees.tabs.tab5';
        $data['breadcrumbs']    = [
            ['name' => lang('Employees.View Employees')],
            ['name' => $data['show']->first_name." ".$data['show']->last_name],
            ['name' => lang('Employees.Education profile')]
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
    public function store(EmployeesEducationProfileRequest $request)
    {
        return $this->employeesEducationProfileServices->insertData($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeesEducationProfile  $employeesEducationProfile
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeesEducationProfile $employeesEducationProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeesEducationProfile  $employeesEducationProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeesEducationProfile $employeesEducationProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeesEducationProfile  $employeesEducationProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeesEducationProfile $employeesEducationProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeesEducationProfile  $employeesEducationProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_img)
    {
        return $this->employeesEducationProfileServices->deleteData($id, $id_img);
        
    }
}
