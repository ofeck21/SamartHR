<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecruitmentRequest;
use App\Models\LocalLang;
use App\Models\Recruitment;
use App\Services\CompanyServices;
use App\Services\CountriesServices;
use App\Services\DepartmentsServices;
use App\Services\EmployeesCategoryServices;
use App\Services\EmployeesLeaveServices;
use App\Services\EmployeesOnLeaveServices;
use App\Services\EmployeesServices;
use App\Services\EmployeesStatusServices;
use App\Services\JobLevelsServices;
use App\Services\JobPositionServices;
use App\Services\OptionServices;
use App\Services\RecruitmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use PDF;
class RecruitmentsController extends Controller
{


    protected $employeesServices,
              $optionsServices,
              $companyServices,
              $departementServices,
              $jobPositionServices,
              $jobLevelServices,
              $employeesStatusServices,
              $employeesCategoryServices,
              $employeesLeaveServices,
              $employeesOnLeaveServices,
              $recruitmentService,
              $countriesServices;

    public function __construct() {
        $this->employeesServices = new EmployeesServices();
        $this->countriesServices = new CountriesServices();
        $this->optionsServices = new OptionServices();
        $this->companyServices = new CompanyServices();
        $this->departementServices = new DepartmentsServices();
        $this->jobPositionServices = new JobPositionServices();
        $this->jobLevelServices = new JobLevelsServices();
        $this->employeesStatusServices = new EmployeesStatusServices();
        $this->employeesCategoryServices = new EmployeesCategoryServices();
        $this->employeesLeaveServices = new EmployeesLeaveServices();
        $this->employeesOnLeaveServices = new EmployeesOnLeaveServices();
        $this->recruitmentService = new RecruitmentService();
    }

    protected function master()
    {
        $data['country']            = $this->countriesServices->getAll();
        $data['options']            = $this->optionsServices->getAll();
        $data['company']            = $this->companyServices->getAll();
        $data['departement']        = $this->departementServices->getAll();
        $data['position']           = $this->jobPositionServices->getAll();
        $data['job_level']          = $this->jobLevelServices->getAll();
        $data['status']             = $this->employeesStatusServices->getAll();
        $data['category']           = $this->employeesCategoryServices->getAll();
        return $data;
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            return $this->recruitmentService->getAll($request);
        }
        $data = $this->master();

        $data['breadcrumbs']    = [
            ['name' => lang('Recruitment List')]
        ];
        return view('content.recruitment.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $tab = 'tab1';
        $bread = lang('Recruitment personal_data');

        if( request()->segment(3) ){
            $tab = request()->segment(3);
            if ($tab == 'tab2') {
                $bread = lang('Recruitment identification mark');
            }

            if ($tab == 'tab3') {
                $bread = lang('Recruitment family structure');
            }

            if ($tab == 'tab4') {
                $bread = lang('Recruitment formal education');
            }
            if ($tab == 'tab5') {
                $bread = lang('Recruitment Employment history');
            }

            if ($tab == 'tab6') {
                $bread = lang('Recruitment Employment Salary');
            }
        }
        $data['breadcrumbs']    = [
            ['name' => $bread]
        ];
        $data['view'] = 'content.recruitment.tabs.'.$tab;
        $data['data'] = $this->recruitmentService->getById($id);

        // return $data['data'];
        if ($tab == 'print') {
            $pdf = PDF::loadview( $data['view'],$data);
    	    // return $pdf->download('laporan-pegawai-pdf');

            return $pdf->stream('pdf.pdf');
        }

        // return $data['data'];
        if (request()->ajax()) {
            return $data['data'];
        }

        return view('content.recruitment.show', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecruitmentRequest $request)
    {
        return $this->recruitmentService->store($request);
    }

    public function update($id, Request $request)
    {
        return $this->recruitmentService->updateData($id, $request);
    }

    public function destroy($id)
    {
        return $this->recruitmentService->deleteData($id);
    }
}
