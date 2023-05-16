<?php

namespace Modules\HRManagement\Http\Controllers\Departments;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\HRManagement\Interfaces\DepartmentInterface;
use Modules\HRManagement\Interfaces\EmployeeDepartmentInterface;
use Modules\HRManagement\Interfaces\EmployeesInterface;
use Symfony\Component\HttpFoundation\Response;

class DepartmentsController extends Controller
{
    // Meta Data
    private DepartmentInterface $departmentRepository;
    private EmployeesInterface $employeesRepository;

    private EmployeeDepartmentInterface $employeeDepartmentsRepository;
    /**
     * @param DepartmentInterface $departmentRepository
     * @param EmployeesInterface $employeesRepository
     */
    public function __construct(DepartmentInterface $departmentRepository, EmployeesInterface $employeesRepository, EmployeeDepartmentInterface $employeeDepartmentsRepository)
    {
        $this->departmentRepository = $departmentRepository;
        $this->employeesRepository = $employeesRepository;
        $this->employeeDepartmentsRepository = $employeeDepartmentsRepository;
    }

    // View
    /**
     * Display a listing of the resource.

     */
    public function viewDepartments()
    {
//        abort_if(Gate::denies('view_department'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try{
            $departments = $this->departmentRepository->getDepartments();
            $employees = $this->employeesRepository->getEmployees();
            return view('hrmanagement::departments.departments',["departments"=>$departments, "employees"=>$employees]);
        }
        catch (Exception $exception){
            Log::error($exception);
            return view('hrmanagement::departments.departments')-with('error', "Something went wrong");
        }
    }
    // Add
    /**
     * Store a newly created resource in storage.
     * @param Request $request

     */
    public function storeDepartment(Request $request)
    {
        abort_if(Gate::denies('add_department'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $name = $request->get("department_name");
            $department = $this->departmentRepository->createDepartment(departmentName: $name);
            if($request->filled('manager'))
            {
                $manager = $request->get('manager');
                $department_member = $this->employeeDepartmentsRepository->createEmployeeDepartment(employeeId: $manager,departmentId: $department->id,isManager: true);
            }
            return redirect()->route("hr_departments")->with("success", "Department added successfully");
        }
        catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("hr_departments")->with("error", "Something went wrong! Contact support");
        }
    }

    /**
     * Show the specified resource.
     * @param int $id

     */
    public function showDepartment($id)
    {
        return view('hrmanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id

     */
    public function editDepartment($id)
    {
        abort_if(Gate::denies('edit_department'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $department = $this->departmentRepository->getDepartment($id);
            return response()->json(["department"=>$department], 200);
        }
        catch (Exception $exception){
            Log::error($exception);
            return response()->json(["department"=>null], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id

     */
    public function updateDepartment(Request $request)
    {
        abort_if(Gate::denies('update_department'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $name = $request->get("department_name");
            $this->departmentRepository->updateDepartment($request->get("id"), $name);
            return redirect()->route("hr_departments")->with("success", "Department updated successfully");
        }catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("hr_departments")->with("error", "Something went wrong! Contact support");
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id

     */
    public function destroyDepartment($id)
    {
        abort_if(Gate::denies('delete_department'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->departmentRepository->deleteDepartment($id);
            return redirect()->route("hr_departments")->with("success", "Department deleted successfully");
        }catch (Exception $exception){
            Log::error($exception);
            return redirect()->route("hr_departments")->with("error", "Something went wrong! Contact support");
        }
    }
}
