<?php

namespace Modules\HRManagement\Http\Controllers\EmployeeSalary;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\HRManagement\Interfaces\EmployeeSalaryInterface;
use Modules\HRManagement\Interfaces\EmployeesInterface;
use Symfony\Component\HttpFoundation\Response;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    private EmployeesInterface $employeesRepository;
    private EmployeeSalaryInterface $employeeSalaryRepository;

    /**
     * @param EmployeesInterface $employeesRepository
     */
    public function __construct(EmployeesInterface $employeesRepository,EmployeeSalaryInterface $employeeSalaryRepository)
    {
        $this->employeesRepository = $employeesRepository;
        $this->employeeSalaryRepository = $employeeSalaryRepository;
    }


    public function viewSalaries()
    {
//        abort_if(Gate::denies('view_employee_salary'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employees = $this->employeeSalaryRepository->getAllEmployeeSalary();
        return view('hrmanagement::salaries.salaries',["employees"=>$employees]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('hrmanagement::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('hrmanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('hrmanagement::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
