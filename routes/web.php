<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboarController;
use App\Http\Controllers\JobLevelController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\BpjsPph21Controller;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CompanyDetailController;
use App\Http\Controllers\JobLevelFacilityController;
use App\Http\Controllers\EmployeesImmigrationController;
use App\Http\Controllers\EmployeesAllDocumentsController;
use App\Http\Controllers\EmployeesBankAccountsController;
use App\Http\Controllers\EmployeesSocialProfileController;
use App\Http\Controllers\EmployeesWorkExperienceController;
use App\Http\Controllers\EmployeesSalaryController;
use App\Http\Controllers\JobPositionController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\RecruitmentsController;
use App\Http\Controllers\SalaryComponentController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\EmployeesFamilyStructureController;
use App\Http\Controllers\EmployeesEducationProfileController;
use App\Http\Controllers\EmployeesSalaryComponentsController;
use App\Http\Controllers\EmployeesEmergencyContactsController;
use App\Http\Controllers\EmployeesShiftController;
use App\Http\Controllers\PaymentController;
use App\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/recruitment', [RecruitmentController::class, 'create'])->name('recruitment');
Route::post('/recruitment', [RecruitmentController::class, 'store'])->name('recruitment');

// Route::post('/register', [AuthController::class, 'registerProcess']);

// Route For Authentication //
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/register', [AuthController::class, 'register'])->name('register');
// Route::post('/register', [AuthController::class, 'registerProcess']);
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot');
Route::post('/forgot-password', [AuthController::class, 'forgotPasswordProcess']);
Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('reset');
Route::post('/reset-password', [AuthController::class, 'resetPasswordProcess']);

Route::get('/lang/{lang}', [LanguageController::class, 'switch'])->name('switch.lang');
// Route with middleware
Route::middleware(['auth'])->group(function () {
    Route::get('laravel-logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

    Route::controller(DashboarController::class)->middleware('can:view dashboard')->group(function ()
    {
        Route::get('/', 'index')->name('dashboard');
    });
    Route::controller(CompanyController::class)->middleware('can:view company')->group(function ()
    {
        Route::get('/companies', 'index')->name('company')->middleware('can:view company');
        Route::get('/companies-datatable', 'companyDataTable')->name('company.datatable')->middleware('can:view company');
        Route::post('/companies', 'store')->name('company.store')->middleware('can:create company');
        Route::get('/companies/{id}', 'show')->name('company.show')->middleware('can:view company');
        Route::put('/companies/{id}', 'update')->name('company.update')->middleware('can:edit company');
        Route::delete('/companies/{id}', 'destroy')->name('company.destroy')->middleware('can:delete company');
    });
    Route::controller(ReligionController::class)->middleware('can:view religion')->group(function ()
    {
        Route::get('/religions', 'index')->name('religion');
    });
    Route::controller(UserController::class)->middleware('can:view user')->group(function ()
    {
        Route::get('/users', 'index')->name('user');
        Route::get('/users-datatable', 'userDataTable')->name('user.datatable');
        Route::post('/users', 'store')->name('user.store');
        Route::get('/users/{id}', 'show')->name('user.show');
        Route::put('/users/{id}', 'update')->name('user.update');
        Route::delete('/users/{id}', 'destroy')->name('user.destroy');
        Route::get('/profile', 'profile')->name('user.profile');
    });
    Route::controller(DepartmentController::class)->middleware('can:view department')->group(function ()
    {
        Route::get('/department', 'index')->name('department');
        Route::get('/department-datatable', 'departmentDataTable')->name('department.datatable');
        Route::post('/department', 'store')->name('department.store');
        Route::get('/department/{id}', 'show')->name('department.show');
        Route::put('/department/{id}', 'update')->name('department.update');
        Route::delete('/department/{id}', 'destroy')->name('department.destroy');
    });
    Route::controller(JobPositionController::class)->middleware('can:view job_position')->group(function ()
    {
        Route::get('/job-position', 'index')->name('job_position');
        Route::get('/job-position-datatable', 'jobPositionDataTable')->name('job-position.datatable');
        Route::post('/job-position', 'store')->name('job-position.store');
        Route::get('/job-position/{id}', 'show')->name('job-position.show');
        Route::put('/job-position/{id}', 'update')->name('job-position.update');
        Route::delete('/job-position/{id}', 'destroy')->name('job-position.destroy');
    });
    Route::controller(JobLevelController::class)->middleware('can:view job_level')->group(function ()
    {
        Route::get('/job-level', 'index')->name('job_level');
        Route::get('/job-level-datatable', 'jobLevelDataTable')->name('job-level.datatable');
        Route::post('/job-level', 'store')->name('job-level.store');
        Route::get('/job-level/{id}', 'show')->name('job-level.show');
        Route::put('/job-level/{id}', 'update')->name('job-level.update');
        Route::delete('/job-level/{id}', 'destroy')->name('job-level.destroy');
    });
    Route::controller(ShiftController::class)->middleware('can:view shift')->group(function ()
    {
        Route::get('/shift', 'index')->name('shift');
        Route::get('/shift-datatable', 'shiftDataTable')->name('shift.datatable');
        Route::post('/shift', 'store')->name('shift.store');
        Route::get('/shift/{id}', 'show')->name('shift.show');
        Route::put('/shift/{id}', 'update')->name('shift.update');
        Route::delete('/shift/{id}', 'destroy')->name('shift.destroy');
    });
    Route::controller(RoleController::class)->middleware('can:view role')->group(function ()
    {
        Route::get('/roles', 'index')->name('role');
        Route::post('/roles', 'store')->name('role.store');
        Route::get('/roles/{id}', 'show')->name('role.show');
        Route::put('/roles/{id}', 'update')->name('role.update');
        Route::delete('/roles/{id}', 'destroy')->name('role.destroy');
    });


    Route::controller(LangController::class)->middleware('can:view lang')->group(function ()
    {
        Route::get('/languages', 'index')->name('languages');
        Route::post('/languages', 'store')->name('lang.store');
        Route::get('/languages/{id}', 'show')->name('lang.show');
        Route::post('/languages/{id}', 'update')->name('lang.update');
        Route::post('/languages-update', 'edit')->name('languages.update');
        Route::post('/set-language', 'setLanguage')->name('set-language');
        
        Route::post('/languages-detete', 'destroy')->name('lang.destroy');
    });

    Route::controller(RecruitmentsController::class)->middleware('can:view recruitments')->group(function ()
    {
        Route::get('/recruitments', 'index')->name('recruitments');
        Route::get('/recruitments/{id}', 'show')->name('show');
        Route::post('/recruitments/{id}', 'update')->name('update');
        Route::delete('/recruitments/{id}', 'destroy')->name('destroy');
        Route::get('/recruitments/{id}/{tab2}', 'show')->name('show');
        
    });

    Route::controller(EmployeesController::class)->middleware('can:view employee')->group(function ()
    {
        Route::get('/employee', 'index')->name('employee');
        Route::post('/employee', 'store')->name('employee.store');
        Route::get('/employee/{id}', 'show')->name('employee.show');
        Route::put('/employee/{id}', 'update')->name('employee.update');
        Route::get('/import-employee/', 'import')->name('employee.import');
        Route::post('/import-employee/', 'import')->name('employee.import');
        Route::post('/import-emp/', 'importEmp')->name('emp.import');
        Route::delete('/employee/{id}', 'destroy')->name('employee.destroy');

        Route::group(['prefix' => '/employee/{id}'], function() {
            Route::controller(EmployeesImmigrationController::class)->group(function () {
                Route::get('/immigration', 'index');
                Route::post('/immigration', 'store');
                Route::put('/immigration/{id_img}', 'update');
                Route::delete('/immigration/{id_img}', 'destroy');
                Route::get('/employee-immigrations/{name}', 'files');
            });
        });
    
        Route::group(['prefix' => '/employee/{id}'], function() {
            Route::controller(EmployeesEmergencyContactsController::class)->group(function () {
                Route::get('/emergency-contacts', 'index');
                Route::post('/emergency-contacts', 'store');
                Route::put('/emergency-contacts/{id_img}', 'update');
                Route::delete('/emergency-contacts/{id_img}', 'destroy');
            });
        });
    
        Route::group(['prefix' => '/employee/{id}'], function() {
            Route::controller(EmployeesSocialProfileController::class)->group(function () {
                Route::get('/social-profile', 'index');
                Route::post('/social-profile', 'store');
                Route::put('/social-profile/{id_img}', 'update');
                Route::delete('/social-profile/{id_img}', 'destroy');

            });
        });
    
        Route::group(['prefix' => '/employee/{id}'], function() {
            Route::controller(EmployeesEducationProfileController::class)->group(function () {
                Route::get('/education-profile', 'index');
                Route::post('/education-profile', 'store');
                Route::put('/education-profile/{id_ep}', 'update');
                Route::delete('/education-profile/{id_ep}', 'destroy');
            });
        });
    
        Route::group(['prefix' => '/employee/{id}'], function() {
            Route::controller(EmployeesWorkExperienceController::class)->group(function () {
                Route::get('/work-experience', 'index');
                Route::post('/work-experience', 'store');
                Route::put('/work-experience/{id_we}', 'update');
                Route::delete('/work-experience/{id_we}', 'destroy');
            });
        });

        Route::group(['prefix' => '/employee/{id}'], function() {
            Route::controller(EmployeesFamilyStructureController::class)->group(function () {
                Route::get('/family-structure', 'index');
                Route::post('/family-structure', 'store');
                Route::put('/family-structure/{id_we}', 'update');
                Route::delete('/family-structure/{id_we}', 'destroy');
            });
        });

        Route::group(['prefix' => '/employee/{id}'], function() {
            Route::controller(EmployeesBankAccountsController::class)->group(function () {
                Route::get('/bank-accounts', 'index');
                Route::post('/bank-accounts', 'store');
                Route::put('/bank-accounts/{id_we}', 'update');
                Route::delete('/bank-accounts/{id_we}', 'destroy');
            });
        });

        Route::group(['prefix' => '/employee/{id}'], function() {
            Route::controller(EmployeesAllDocumentsController::class)->group(function () {
                Route::get('/all-documents', 'index');
                Route::post('/all-documents', 'store');
                Route::put('/all-documents/{id_we}', 'update');
                Route::delete('/all-documents/{id_we}', 'destroy');
            });
        });
        
        Route::group(['prefix' => '/employee/{id}'], function() {
            Route::controller(EmployeesSalaryController::class)->group(function () {
                Route::get('/employee-salary', 'index');
                Route::post('/employee-salary', 'store');
                Route::put('/employee-salary/{id_we}', 'update');
                Route::delete('/employee-salary/{id_we}', 'destroy');
            });
        });

        Route::group(['prefix' => '/employee/{id}'], function() {
            Route::controller(EmployeesSalaryComponentsController::class)->group(function () {
                Route::get('/salary-components/{components}', 'index');
                Route::post('/salary-components/{components}', 'store');
                Route::put('/salary-components/{components}/{id_we}', 'update');
                Route::delete('/salary-components/{components}/{id_we}', 'destroy');
            });
        });

        Route::group(['prefix' => '/employee/{id}'], function() {
            Route::controller(EmployeesShiftController::class)->group(function () {
                Route::get('/employee-shift', 'index');
                Route::post('/employee-shift', 'store');
                Route::put('/employee-shift/{id_we}', 'update');
                Route::delete('/employee-shift/{id_we}', 'destroy');
            });
        });

        
        
        
    });


    
    Route::controller(SalaryController::class)->middleware('can:view salary')->group(function ()
    {
       Route::get('/salaries', 'index')->name('salary'); 
       Route::get('/salaries-datatable', 'salaryDataTable')->name('salary.datatable');
       Route::get('/salaries-datatable/{id}', 'salaryDataTableDetail')->name('salary.datatable-detail');
       Route::post('/salaries', 'store')->name('salary.store');
       Route::get('/salaries/{id}/detail', 'detail')->name('salary.detail');
       Route::post('/salaries/{id}/detail', 'detailStore')->name('salary.detail.store');
       Route::get('/salary-detail/{id}', 'editSalaryDetail')->name('salary.detail.edit');
       Route::put('/salary-detail/{id}', 'updateSalaryDetail')->name('salary.detail.update');
       Route::get('/salaries/{id}', 'show')->name('salary.show');
       Route::put('/salaries/{id}', 'update')->name('salary.update');
       Route::delete('/salaries/{id}', 'destroy')->name('salary.destroy');
       Route::delete('/salary-detail/{id}', 'destroySalaryDetail')->name('salary.detail.destroy');
       Route::get('/salaries/download/template-all', 'downloadTemplateAll');
       Route::post('/salaries/import/all', 'importAllSalary');
       Route::get('/salaries/download/template-employee-salary', 'downloadTemplateEmployeeSalary');
       Route::post('/salaries/import/employee-salary', 'importEmployeeSalary');
    });
    Route::controller(SalaryComponentController::class)->middleware('can:view salary_component')->group(function ()
    {
       Route::get('/salary-components', 'index')->name('salary_component'); 
       Route::get('/salary-components-datatable', 'salaryComponentDataTable')->name('salary_component.datatable');
       Route::get('/salary-components-datatable/{id}', 'salaryComponentDataTableDetail')->name('salary_component.datatable-detail');
       Route::post('/salary-components', 'store')->name('salary_component.store');
       Route::get('/salary-components/{id}/detail', 'detail')->name('salary_component.detail');
       Route::post('/salary-components/{id}/detail', 'detailStore')->name('salary.detail.store');
       Route::get('/salary-components-detail/{id}', 'editComponentDetail')->name('salary.detail.edit');
       Route::put('/salary-components-detail/{id}', 'updateComponentDetail')->name('salary.detail.update');
       Route::get('/salary-components/{id}', 'show')->name('salary_component.show');
       Route::put('/salary-components/{id}', 'update')->name('salary_component.update');
       Route::delete('/salary-components/{id}', 'destroy')->name('salary_component.destroy');
       Route::delete('/salary-components-detail/{id}', 'destroyComponentDetail')->name('salary.detail.destroy');
       Route::get('/salary-components/download/template-all', 'downloadTemplateAllSalaryComponent');
       Route::post('/salary-components/import/all', 'importAllSalaryComponent');
       Route::get('/salary-components/download/template-employee-salary-component', 'downloadTemplateEmployeeSalaryComponent');
       Route::post('/salary-components/import/employee-salary-component', 'importEmployeeSalaryComponent');
    });
    Route::controller(AttendanceController::class)->middleware('can:view attendance')->group(function(){
        Route::get('/attendance', 'index')->name('attendance');
        Route::get('/attendance-datatable', 'dataTable')->name('attendance.datatable');
        Route::post('/attendance/import', 'import')->name('attendance.import');
        Route::get('/attendance/{id}/{month}', 'detail')->name('attendance.detail');
    });
    Route::controller(SelectController::class)->group(function(){
        Route::get('/select/employee-grouping-position-filter-by-department/{department_id}', 'employeeGroupingPositionByDepartment');
        Route::get('/select/deparment-by-company/{company_id}', 'departmentByCompany');
        Route::get('/select/shift-by-company/{company_id}', 'shiftByCompany');
        Route::get('/select/salary-by-company/{company_id}', 'salaryByCompany');
        Route::get('/select/allowance-by-company/{company_id}', 'allowanceByCompany');
    });
    Route::controller(BpjsPph21Controller::class)->middleware('can:view bpjs_pph21')->group(function(){
        Route::get('/bpjs-pph21', 'index')->name('bpjs_pph21');
        Route::get('/bpjs-datatable', 'bpjsDataTable')->name('bpjs.datatable');
        Route::get('/pph21-datatable', 'pph21DataTable')->name('pph21.datatable');
        Route::get('/pkp-datatable', 'pkpDataTable')->name('pkp.datatable');
        Route::get('/bpjs/{id}', 'detailBpjs')->name('bpjs.detail');
        Route::get('/pph21/{id}', 'detailPph21')->name('pph21.detail');
        Route::get('/pkp/{id}', 'detailPkp')->name('pkp.detail');
        Route::put('/bpjs/{id}', 'updateBpjs')->name('bpjs.update');
        Route::put('/pph21/{id}', 'updatePph21')->name('pph21.update');
        Route::put('/pkp/{id}', 'updatePkp')->name('pkp.update');
        Route::post('/setting/{type}', 'setting')->name('setting');
    });
    Route::controller(PayrollController::class)->middleware('can:view payroll')->group(function(){
        Route::get('/payroll', 'index')->name('payroll');
        Route::get('/payroll-datatable', 'payrollDataTable')->name('payroll.datatable');
        Route::get('/payroll/progress', 'progress')->name('payroll.progress');
        Route::post('/payroll/finish/{id}', 'finish')->name('payroll.finish');
        Route::get('/payroll/{id}/detail', 'show')->name('payroll.show');
        Route::post('/payroll/run', 'runPayroll')->name('payroll.run');
    });
    Route::controller(GroupController::class)->middleware('can:view group')->group(function(){
        Route::get('/group', 'index')->name('group');
        Route::get('/group-datatable', 'groupDataTable')->name('group.datatable');
        Route::post('/group', 'store')->name('group.store');
        Route::get('/group/{id}', 'show')->name('group.show');
        Route::put('/group/{id}', 'update')->name('group.update');
        Route::delete('/group/{id}', 'destroy')->name('group.destroy');
    });
    Route::controller(CompanyDetailController::class)->middleware('can:view company')->group(function(){
        Route::get('/company/{id}', 'index')->name('company.detail')->middleware('can:view company');
        Route::post('/company/{id}/large-logo', 'updateLargeLogo')->name('company.detail')->middleware('can:edit company');
        Route::post('/company/{id}/small-logo', 'updateSmallLogo')->name('company.detail')->middleware('can:edit company');
        Route::get('/company-pic-datatable/{id}', 'picDataTable')->name('company.pic_datatable')->middleware('can:view company');
        Route::get('/company-file-datatable/{id}', 'fileDataTable')->name('company.file_datatable')->middleware('can:view company');
        Route::post('/company-pic/{id}', 'storePIC')->name('company.store_pic')->middleware('can:edit company');
        Route::post('/company-file/{id}', 'storeFile')->name('company.store_file')->middleware('can:edit company');
        Route::put('/company-pic/{id}', 'updatePIC')->name('company.update_pic')->middleware('can:edit company');
        Route::post('/company-update-file/{id}', 'updateFile')->name('company.update_file')->middleware('can:edit company');
        Route::get('/company-pic/{id}', 'showPIC')->name('company.show_pic')->middleware('can:view company');
        Route::get('/company-file/{id}', 'showFile')->name('company.show_file')->middleware('can:view company');
        Route::delete('/company-pic/{id}', 'destroyPIC')->name('company.destroy_file')->middleware('can:delete company');
        Route::delete('/company-file/{id}', 'destroyFile')->name('company.destroy_file')->middleware('can:delete company');
    });

    Route::controller(JobLevelFacilityController::class)->middleware('can:view job_level')->group(function(){
        Route::get('/job-level/facility/{job_level_id}', 'index')->name('job_level.facility');
        Route::get('/job-level/facility/{job_level_id}/data-table', 'facilityDataTable')->name('job_level_facility.datatable');
        Route::post('/job-level/facility/{job_level_id}', 'store')->name('job_level_facility.store');
        Route::delete('/job-level/facility/{id}', 'destroy')->name('job_level_facility.destroy');
    });

    Route::controller(PaymentController::class)->middleware('can:view payment')->group(function(){
        Route::get('/payment', 'index')->name('payment');
        Route::get('/payment-datatable', 'paymentDataTable')->name('payment.datatable');
    });
});