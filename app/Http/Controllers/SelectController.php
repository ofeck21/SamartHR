<?php

namespace App\Http\Controllers;

use App\Services\SelectService;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function employeeGroupingPositionByDepartment($department_id)
    {
        return SelectService::getEmployeeGroupingByJobPosistionFilterByDepartment($department_id);
    }

    public function departmentByCompany($company_id)
    {
        return SelectService::getDepartmentByCompany($company_id);
    }

    public function shiftByCompany($company_id)
    {
        return SelectService::getShiftByCompany($company_id);
    }

    public function salaryByCompany($company_id)
    {
        return SelectService::getSalaryByCompany($company_id);
    }

    public function allowanceByCompany($company_id)
    {
        return SelectService::getAllowanceByCompany($company_id);
    }
}
