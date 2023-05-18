<?php

namespace Modules\HRManagement\Http\Controllers\Departments;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\HRManagement\Interfaces\DepartmentInterface;
use Modules\HRManagement\Interfaces\EmployeeDepartmentInterface;
use Modules\HRManagement\Interfaces\EmployeesInterface;

class DepartmentMembersController extends Controller
{
    // Meta Data
    private DepartmentInterface $departmentsRepository;
    private EmployeesInterface $employeesRepository;
    private EmployeeDepartmentInterface $employeeDepartmentsRepository;

    public function __construct(DepartmentInterface $departmentsRepository, EmployeesInterface $employeesRepository, EmployeeDepartmentInterface $employeeDepartmentsRepository)
    {
        $this->departmentsRepository = $departmentsRepository;
        $this->employeesRepository = $employeesRepository;
        $this->employeeDepartmentsRepository = $employeeDepartmentsRepository;
    }

    // View

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function viewDepartmentMembers($department_id)
    {
        $department_members = $this->employeeDepartmentsRepository->getEmployeeDepartmentsByDpt(departmentId: $department_id);
        $department_members = $department_members->sortBy('is_manager')->reverse();
        $department = $this->departmentsRepository->getDepartment(id: $department_id);
        $employees = $this->employeesRepository->getEmployees();
        return view('hrmanagement::departments.department_members', ["department_members" => $department_members, "department" => $department, "employees" => $employees]);
    }


    // Add

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeDepartmentMembers(Request $request, $department_id)
    {
        try {
            $department_members = $request->get('department_member_members');
            if (sizeof($department_members) > 0) {
                foreach ($department_members as $member) {
                    $this->employeeDepartmentsRepository->createEmployeeDepartment(employeeId: $member, departmentId: $department_id);
                }
            }
            return redirect()->route('hr_department_members', ['id' => $department_id])->with('success', "Members added successfully");

        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route('hr_department_members', ['id' => $department_id])->with('error', "Something went wrong");
        }
    }

    // Edit

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function makeDepartmentManager($department_id, $member_id)
    {
        try {
            $department_member = $this->employeeDepartmentsRepository->getEmployeeDepartment($member_id);
            $this->employeeDepartmentsRepository->updateEmployeeDepartment(id: $member_id, employeeId: $department_member->employee_id, departmentId: $department_member->department_id, isManager: true);
            return redirect()->route('hr_department_members', ['id' => $department_id])->with('success', "Manager added successfully");
        } catch (Exception $exception) {
            Log::error($exception);

            error_log("in make ".$exception);
            return redirect()->route('hr_department_members', ['id' => $department_id])->with('error', "Something went wrong");
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function removeDepartmentManager($department_id, $member_id)
    {
        try{
            $department_member = $this->employeeDepartmentsRepository->getEmployeeDepartment($member_id);
            $this->employeeDepartmentsRepository->updateEmployeeDepartment(id: $member_id, employeeId: $department_member->employee_id, departmentId: $department_member->department_id, isManager: false);
            return redirect()->route('hr_department_members', ['id' => $department_id])->with('success', "Manager removed successfully");

        } catch (Exception $exception) {
            Log::error($exception);
            error_log("in remove ".$exception);
            return redirect()->route('hr_department_members', ['id' => $department_id])->with('error', "Something went wrong");
        }
    }

    // Delete

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyDepartmentMember($department_id, $id)
    {
        $this->employeeDepartmentsRepository->deleteEmployeeDepartment($id);
        return redirect()->route('hr_department_members', ['id' => $department_id])->with('success', "Members deleted successfully");

    }
}
