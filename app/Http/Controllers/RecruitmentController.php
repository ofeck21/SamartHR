<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecruitmentRequest;
use App\Models\LocalLang;
use App\Services\CountriesServices;
use App\Services\OptionServices;
use App\Services\RecruitmentService;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    protected $optionsServices,
            //   $companyServices,
            //   $departementServices,
            //   $jobPositionServices,
            //   $jobLevelServices,
            //   $employeesStatusServices,
            //   $employeesCategoryServices,
            //   $employeesLeaveServices,
            //   $employeesOnLeaveServices,
              $countriesServices,
              $recruitmentService;

    public function __construct() {
        $this->countriesServices = new CountriesServices();
        $this->optionsServices = new OptionServices();
        // $this->companyServices = new CompanyServices();
        // $this->departementServices = new DepartmentsServices();
        // $this->jobPositionServices = new JobPositionServices();
        // $this->jobLevelServices = new JobLevelsServices();
        // $this->employeesStatusServices = new EmployeesStatusServices();
        // $this->employeesCategoryServices = new EmployeesCategoryServices();
        // $this->employeesLeaveServices = new EmployeesLeaveServices();
        // $this->employeesOnLeaveServices = new EmployeesOnLeaveServices();
        $this->recruitmentService = new RecruitmentService();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function master()
    {
        $data['option'] = $this->optionsServices->getAll();
        return $data;
    }

    public function create()
    {
        $data = $this->master();
        return view('content.lamaran.recruitment', $data);
        return view('content.auth.recruitment', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecruitmentRequest $request)
    {
        if($request->step == '6'){
            return $this->recruitmentService->store($request);
        }
    }

}
