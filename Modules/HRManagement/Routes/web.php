<?php

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



Route::prefix('hrmanagement')->group(function() {
    Route::get('/', 'HRManagementController@index');
});



Route::prefix('hr')->group(function () {
    Route::get('/', 'HRManagementController@index');

    Route::group(['prefix' => 'employee/'], function () {
        Route::get("", [Modules\HRManagement\Http\Controllers\Employees\EmployeesController::class, "viewEmployees"])->name("hr_employees");
        Route::get("add/", [Modules\HRManagement\Http\Controllers\Employees\EmployeesController::class, "addEmployee"])->name("hr_employees_add");
        Route::post("add/", [Modules\HRManagement\Http\Controllers\Employees\EmployeesController::class, "storeEmployee"])->name("hr_employees_store");
        Route::get("edit/{id}", [Modules\HRManagement\Http\Controllers\Employees\EmployeesController::class, "editEmployee"])->name("hr_employees_edit");
        Route::post("update/personal-information", [Modules\HRManagement\Http\Controllers\Employees\EmployeesController::class, "updatePersonalInformation"])->name("hr_employees_personal_information_update");
        Route::post("update/employment", [Modules\HRManagement\Http\Controllers\Employees\EmployeesController::class, "updateEmployment"])->name("hr_employees_employment_update");
        Route::post("update/bank", [Modules\HRManagement\Http\Controllers\Employees\EmployeesController::class, "updateBankDetails"])->name("hr_employees_bank_update");
        Route::post("update/leave-policy", [Modules\HRManagement\Http\Controllers\Employees\EmployeesController::class, "updateLeavePolicy"])->name("hr_employees_leave_policy_update");
        Route::post("update/salary", [Modules\HRManagement\Http\Controllers\Employees\EmployeesController::class, "updateSalary"])->name("hr_employees_salary_update");
        Route::get("delete/{id}", [Modules\HRManagement\Http\Controllers\Employees\EmployeesController::class, "destroyEmployee"])->name("hr_employees_delete");


    });
    Route::group(['prefix' => 'appreciation'], function () {
        Route::get("", [Modules\HRManagement\Http\Controllers\Appreciation\AppreciationController::class, "viewAppreciations"])->name("hr_appreciations");
        Route::get("add/", [Modules\HRManagement\Http\Controllers\Appreciation\AppreciationController::class, "createAppreciation"])->name("hr_appreciations_add");
        Route::post("add/", [Modules\HRManagement\Http\Controllers\Appreciation\AppreciationController::class, "storeAppreciation"])->name("hr_appreciations_store");
        Route::get("edit/{id}", [Modules\HRManagement\Http\Controllers\Appreciation\AppreciationController::class, "editAppreciation"])->name("hr_appreciations_edit");
        Route::post("edit/{id}", [Modules\HRManagement\Http\Controllers\Appreciation\AppreciationController::class, "updateAppreciation"])->name("hr_appreciations_update");
        Route::get("delete/{id}", [Modules\HRManagement\Http\Controllers\Appreciation\AppreciationController::class, "destroyAppreciation"])->name("hr_appreciations_delete");
    });
    Route::group(['prefix' => 'attendance/'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\Attendance\AttendanceController::class, "viewAttendance"])->name("hr_attendance");
        Route::post("add/", [\Modules\HRManagement\Http\Controllers\Attendance\AttendanceController::class, "storeAttendance"])->name("hr_attendance_add");
        Route::get("edit/", [\Modules\HRManagement\Http\Controllers\Attendance\AttendanceController::class, "editAttendance"])->name("hr_attendance_edit");
        Route::post("edit/", [\Modules\HRManagement\Http\Controllers\Attendance\AttendanceController::class, "updateAttendance"])->name("hr_attendance_update");
        // Ajax or others
        Route::post("get/employees/", [\Modules\HRManagement\Http\Controllers\Attendance\AttendanceController::class, "getEmployees"])->name("hr_attendance_get_employees");
    });
    Route::group(['prefix' => 'awards/'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\Awards\AwardsController::class, "viewAwards"])->name("hr_awards");
        Route::post("add/", [\Modules\HRManagement\Http\Controllers\Awards\AwardsController::class, "storeAward"])->name("hr_award_add");
        Route::get("edit/{id}", [\Modules\HRManagement\Http\Controllers\Awards\AwardsController::class, "editAward"])->name("hr_award_edit");
        Route::post("update/", [\Modules\HRManagement\Http\Controllers\Awards\AwardsController::class, "updateAward"])->name("hr_award_update");
        Route::get("delete/{id}", [\Modules\HRManagement\Http\Controllers\Awards\AwardsController::class, "destroyAward"])->name("hr_award_delete");

    });
    Route::group(['prefix' => 'deductions/'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\Deductions\DeductionsController::class, "viewDeductions"])->name("hr_deductions");
        Route::post("add/", [\Modules\HRManagement\Http\Controllers\Deductions\DeductionsController::class, "storeDeduction"])->name("hr_deduction_add");
        Route::get("edit/{id}", [\Modules\HRManagement\Http\Controllers\Deductions\DeductionsController::class, "editDeduction"])->name("hr_deduction_edit");
        Route::post("edit/", [\Modules\HRManagement\Http\Controllers\Deductions\DeductionsController::class, "updateDeduction"])->name("hr_deduction_update");
        Route::get("delete/{id}", [\Modules\HRManagement\Http\Controllers\Deductions\DeductionsController::class, "destroyDeduction"])->name("hr_deduction_delete");

        Route::get("status/{id}/{status}", [\Modules\HRManagement\Http\Controllers\Deductions\DeductionsController::class, "updateStatus"])->name("hr_deduction_status");
        Route::get("deduct/{id}/{deducted}", [\Modules\HRManagement\Http\Controllers\Deductions\DeductionsController::class, "deductDeduction"])->name("hr_deduction_deduct");

    });
    Route::group(['prefix' => 'departments/'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\Departments\DepartmentsController::class, "viewDepartments"])->name("hr_departments");
        Route::post("add/", [\Modules\HRManagement\Http\Controllers\Departments\DepartmentsController::class, "storeDepartment"])->name("hr_departments_add");
        Route::get("edit/{id}", [\Modules\HRManagement\Http\Controllers\Departments\DepartmentsController::class, "editDepartment"])->name("hr_departments_edit");
        Route::post("update/", [\Modules\HRManagement\Http\Controllers\Departments\DepartmentsController::class, "updateDepartment"])->name("hr_departments_update");
        Route::get("delete/{id}", [\Modules\HRManagement\Http\Controllers\Departments\DepartmentsController::class, "destroyDepartment"])->name("hr_departments_delete");

    });
    Route::group(['prefix' => 'department-members/{id}'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\Departments\DepartmentMembersController::class, "viewDepartmentMembers"])->name("hr_department_members");
        Route::post("add", [\Modules\HRManagement\Http\Controllers\Departments\DepartmentMembersController::class, "storeDepartmentMembers"])->name("hr_department_members_store");
        Route::get("delete/{member_id}", [\Modules\HRManagement\Http\Controllers\Departments\DepartmentMembersController::class, "destroyDepartmentMember"])->name("hr_department_members_delete");
        Route::get("make/{member_id}", [\Modules\HRManagement\Http\Controllers\Departments\DepartmentMembersController::class, "makeDepartmentManager"])->name("hr_department_members_make_manager");
        Route::get("remove/{member_id}", [\Modules\HRManagement\Http\Controllers\Departments\DepartmentMembersController::class, "removeDepartmentManager"])->name("hr_department_members_remove_manager");

    });
    Route::group(['prefix' => 'designations/'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\Designations\DesignationsController::class, "viewDesignations"])->name("hr_designations");
        Route::post("add/", [\Modules\HRManagement\Http\Controllers\Designations\DesignationsController::class, "storeDesignation"])->name("hr_designations_add");
        Route::get("edit/{id}", [\Modules\HRManagement\Http\Controllers\Designations\DesignationsController::class, "editDesignation"])->name("hr_designations_edit");
        Route::post("update/", [\Modules\HRManagement\Http\Controllers\Designations\DesignationsController::class, "updateDesignation"])->name("hr_designations_update");
        Route::get("delete/{id}", [\Modules\HRManagement\Http\Controllers\Designations\DesignationsController::class, "destroyDesignation"])->name("hr_designations_delete");
    });
    Route::group(['prefix' => 'events/'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\Events\EventsController::class, "viewEvents"])->name("hr_events");
        Route::post("add/", [\Modules\HRManagement\Http\Controllers\Events\EventsController::class, "storeEvent"])->name("hr_events_add");
        Route::get("edit/{id}", [\Modules\HRManagement\Http\Controllers\Events\EventsController::class, "editEvent"])->name("hr_events_edit");
        Route::post("update/", [\Modules\HRManagement\Http\Controllers\Events\EventsController::class, "updateEvent"])->name("hr_events_update");
        Route::get("delete/{id}", [\Modules\HRManagement\Http\Controllers\Events\EventsController::class, "destroyEvent"])->name("hr_events_delete");
    });
    Route::group(['prefix' => 'expense-reclaims/'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\ExpenseReclaims\ExpenseReclaimsController::class, "viewExpenseReclaims"])->name("hr_expense_reclaims");
        Route::get("add/expense-reclaim", [\Modules\HRManagement\Http\Controllers\ExpenseReclaims\ExpenseReclaimsController::class, "addExpenseReclaimsView"])->name("hr_expense_reclaims_add_view");
        Route::post("add/", [\Modules\HRManagement\Http\Controllers\ExpenseReclaims\ExpenseReclaimsController::class, "storeExpenseReclaim"])->name("hr_expense_reclaims_add");
        Route::get("edit/{id}", [\Modules\HRManagement\Http\Controllers\ExpenseReclaims\ExpenseReclaimsController::class, "editExpenseReclaim"])->name("hr_expense_reclaims_edit");
        Route::post("update", [\Modules\HRManagement\Http\Controllers\ExpenseReclaims\ExpenseReclaimsController::class, "updateExpenseReclaim"])->name("hr_expense_reclaims_update");
        Route::get("delete/{id}", [\Modules\HRManagement\Http\Controllers\ExpenseReclaims\ExpenseReclaimsController::class, "destroyExpenseReclaim"])->name("hr_expense_reclaims_delete");
    });
    Route::group(['prefix' => 'leave-applications/'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\LeaveApplications\LeaveApplicationsController::class, "viewLeaveApplications"])->name("hr_leave_applications");
        Route::get("add/leave-application", [\Modules\HRManagement\Http\Controllers\LeaveApplications\LeaveApplicationsController::class, "viewAddLeaveApplication"])->name("hr_leave_applications_add");
        Route::post('add/',[\Modules\HRManagement\Http\Controllers\LeaveApplications\LeaveApplicationsController::class, "storeLeaveApplication"])->name("hr_leave_applications_store");
        Route::get('edit/{id}',[\Modules\HRManagement\Http\Controllers\LeaveApplications\LeaveApplicationsController::class, "editLeaveApplication"])->name("hr_leave_application_edit");
        Route::post('update/{id}',[\Modules\HRManagement\Http\Controllers\LeaveApplications\LeaveApplicationsController::class, "updateLeaveApplication"])->name("hr_leave_application_update");
        Route::get('delete/{id}',[\Modules\HRManagement\Http\Controllers\LeaveApplications\LeaveApplicationsController::class, "destroyLeaveApplication"])->name("hr_leave_application_delete");
        // Ajax Calls
        Route::post('emp-policy-data',[\Modules\HRManagement\Http\Controllers\LeaveApplications\LeaveApplicationsController::class, "getEmpPolicyData"])->name("get_emp_policy_data");
        Route::post('emp-leave-calculations',[\Modules\HRManagement\Http\Controllers\LeaveApplications\LeaveApplicationsController::class, "getEmpLeaveCalculations"])->name("get_emp-leave-calculations");

    });
    Route::group(['prefix' => 'leave-policy/'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\LeavePolicy\LeavePolicyController::class, "viewLeavePolicies"])->name("leave_policy");
        Route::get("add/leave-policy", [\Modules\HRManagement\Http\Controllers\LeavePolicy\LeavePolicyController::class, "createLeavePolicy"])->name("leave_policy_add");
        Route::post("add/", [\Modules\HRManagement\Http\Controllers\LeavePolicy\LeavePolicyController::class, "storeLeavePolicy"])->name("hr_leave_policy_store");
//        Route::get("policy-record/{id}", [\Modules\HRManagement\Http\Controllers\LeavePolicy\LeavePolicyController::class, "leavePolicyRecord"])->name("leave_policy_record");
        Route::get("edit/{id}", [\Modules\HRManagement\Http\Controllers\LeavePolicy\LeavePolicyController::class, "editLeavePolicy"])->name("hr_leave_policy_edit");
        Route::post("update", [\Modules\HRManagement\Http\Controllers\LeavePolicy\LeavePolicyController::class, "updateLeavePolicy"])->name("hr_leave_policy_update");
        Route::get("delete/{id}", [\Modules\HRManagement\Http\Controllers\LeavePolicy\LeavePolicyController::class, "destroyLeavePolicy"])->name("hr_leave_policy_delete");
    });
    Route::group(['prefix' => 'leave-policy-records/'], function () {
        Route::get("{id}", [\Modules\HRManagement\Http\Controllers\LeavePolicyRecords\LeavePolicyRecordsController::class, "viewLeavePolicyRecord"])->name("leave_policy_record");
        Route::post("add/policy-record/{id}", [\Modules\HRManagement\Http\Controllers\LeavePolicyRecords\LeavePolicyRecordsController::class, "storeLeavePolicyRecord"])->name("hr_leave_policy_record_add");
        Route::get("edit/{record_id}", [\Modules\HRManagement\Http\Controllers\LeavePolicyRecords\LeavePolicyRecordsController::class, "editLeavePolicyRecord"])->name("hr_leave_policy_record_edit");
        Route::post("update/{id}", [\Modules\HRManagement\Http\Controllers\LeavePolicyRecords\LeavePolicyRecordsController::class, "updateLeavePolicyRecord"])->name("hr_leave_policy_record_update");
        Route::get("delete/{record_id}/{id}", [\Modules\HRManagement\Http\Controllers\LeavePolicyRecords\LeavePolicyRecordsController::class, "destroyLeavePolicyRecord"])->name("hr_leave_policy_record_delete");

    });
    Route::group(['prefix' => 'salaries/'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\EmployeeSalary\EmployeeSalaryController::class, "viewSalaries"])->name("hr_salaries");
    });
    Route::group(['prefix' => 'overtimes/'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\Overtime\OvertimeController::class, "viewOvertimes"])->name("hr_overtimes");
        Route::post("add/", [\Modules\HRManagement\Http\Controllers\Overtime\OvertimeController::class, "storeOvertime"])->name("hr_overtimes_store");
        Route::get("edit/{id}", [\Modules\HRManagement\Http\Controllers\Overtime\OvertimeController::class, "editOvertime"])->name("hr_overtimes_edit");
        Route::post("update/", [\Modules\HRManagement\Http\Controllers\Overtime\OvertimeController::class, "updateOvertime"])->name("hr_overtimes_update");
        Route::get("delete/{id}", [\Modules\HRManagement\Http\Controllers\Overtime\OvertimeController::class, "destroyOvertime"])->name("hr_overtimes_delete");

        //ajax calls
        Route::get("get/timesheets/{id}", [\Modules\HRManagement\Http\Controllers\Overtime\OvertimeController::class, "getTimesheets"])->name("hr_overtimes_get_timesheets");
    });
    Route::group(['prefix' => 'taxes/'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\Taxes\TaxesController::class, "viewTaxes"])->name("hr_taxes");
        Route::post("add", [\Modules\HRManagement\Http\Controllers\Taxes\TaxesController::class, "storeTax"])->name("hr_taxes_store");
        Route::get("edit/{id}", [\Modules\HRManagement\Http\Controllers\Taxes\TaxesController::class, "editTax"])->name("hr_taxes_edit");
        Route::post("update", [\Modules\HRManagement\Http\Controllers\Taxes\TaxesController::class, "updateTax"])->name("hr_taxes_update");
        Route::get("delete/{id}", [\Modules\HRManagement\Http\Controllers\Taxes\TaxesController::class, "destroyTax"])->name("hr_taxes_delete");
    });
    Route::group(['prefix' => 'teams/'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\Team\TeamsController::class, "viewTeams"])->name("hr_teams");
        Route::post("add", [\Modules\HRManagement\Http\Controllers\Team\TeamsController::class, "storeTeam"])->name("hr_teams_store");
        Route::get("edit/{id}", [\Modules\HRManagement\Http\Controllers\Team\TeamsController::class, "editTeam"])->name("hr_teams_edit");
        Route::post("update", [\Modules\HRManagement\Http\Controllers\Team\TeamsController::class, "updateTeam"])->name("hr_teams_update");
        Route::get("delete/{id}", [\Modules\HRManagement\Http\Controllers\Team\TeamsController::class, "destroyTeam"])->name("hr_teams_delete");

    });
    Route::group(['prefix' => 'team-members/{id}/'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\Team\TeamMembersController::class, "viewTeamMembers"])->name("hr_team_members");
        Route::post("add", [\Modules\HRManagement\Http\Controllers\Team\TeamMembersController::class, "storeTeamMembers"])->name("hr_team_members_store");
        Route::get("delete/{member_id}", [\Modules\HRManagement\Http\Controllers\Team\TeamMembersController::class, "destroyTeamMember"])->name("hr_team_members_delete");
        Route::get("make/{member_id}", [\Modules\HRManagement\Http\Controllers\Team\TeamMembersController::class, "makeTeamLeader"])->name("hr_team_members_make_leader");
        Route::get("remove/{member_id}", [\Modules\HRManagement\Http\Controllers\Team\TeamMembersController::class, "removeTeamLeader"])->name("hr_team_members_remove_leader");
    });
    Route::group(['prefix' => 'timesheets/'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\Timesheets\TimesheetsController::class, "viewTimesheets"])->name("hr_timesheets");
        Route::get("add/", [\Modules\HRManagement\Http\Controllers\Timesheets\TimesheetsController::class, "addTimesheet"])->name("hr_timesheets_add");
        Route::post("add/", [\Modules\HRManagement\Http\Controllers\Timesheets\TimesheetsController::class, "storeTimesheet"])->name("hr_timesheets_store");
        Route::get("edit/{id}", [\Modules\HRManagement\Http\Controllers\Timesheets\TimesheetsController::class, "editTimesheet"])->name("hr_timesheets_edit");
        Route::post("update", [\Modules\HRManagement\Http\Controllers\Timesheets\TimesheetsController::class, "updateTimesheet"])->name("hr_timesheets_update");
        Route::get("delete/{id}", [\Modules\HRManagement\Http\Controllers\Timesheets\TimesheetsController::class, "destroyTimesheet"])->name("hr_timesheets_delete");
    });
    Route::group(['prefix' => 'leaves/'], function () {
        Route::get("", [\Modules\HRManagement\Http\Controllers\LeaveTypes\LeaveTypesController::class, "viewLeaveTypes"])->name("hr_leave_types");
        Route::post("add/", [\Modules\HRManagement\Http\Controllers\LeaveTypes\LeaveTypesController::class, "storeLeaveTypes"])->name("hr_leave_types_add");
        Route::get("edit/{id}", [\Modules\HRManagement\Http\Controllers\LeaveTypes\LeaveTypesController::class, "editLeaveTypes"])->name("hr_leave_types_edit");
        Route::post("update", [\Modules\HRManagement\Http\Controllers\LeaveTypes\LeaveTypesController::class, "updateLeaveTypes"])->name("hr_leave_types_update");
        Route::get("delete/{id}", [\Modules\HRManagement\Http\Controllers\LeaveTypes\LeaveTypesController::class, "destroyLeaveTypes"])->name("hr_leave_types_delete");
    });
});
