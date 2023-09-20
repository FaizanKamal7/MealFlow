<?php

namespace Modules\HRManagement\Http\Controllers\Employees;

use App\Models\User;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\HRManagement\Http\Helper\Helper;
use Modules\HRManagement\Interfaces\BanksInterface;
use Modules\HRManagement\Interfaces\DepartmentInterface;
use Modules\HRManagement\Interfaces\DesignationInterface;
use Modules\HRManagement\Interfaces\EmployeeDepartmentInterface;
use Modules\HRManagement\Interfaces\EmployeeMediaInterface;
use Modules\HRManagement\Interfaces\EmployeeSalaryInterface;
use Modules\HRManagement\Interfaces\EmployeesInterface;
use Modules\HRManagement\Interfaces\LeavePolicyInterface;
use Modules\HRManagement\Interfaces\TaxesInterface;
use Modules\HRManagement\Interfaces\TeamMembersInterface;
use Modules\HRManagement\Interfaces\TeamsInterface;
use Symfony\Component\HttpFoundation\Response;

class EmployeesController extends Controller
{

    // Meta data
    private EmployeesInterface $employeesRepository;
    private DepartmentInterface $departmentRepository;
    private DesignationInterface $designationRepository;
    private TeamsInterface $teamsRepository;
    private EmployeeDepartmentInterface $employeeDepartmentRepository;
    private BanksInterface $banksRepository;
    private TeamMembersInterface $teamMembersRepository;
    private EmployeeSalaryInterface $salaryRepository;
    private EmployeeMediaInterface $employeeMediaRepository;
    private LeavePolicyInterface $leavePolicy;
    private TaxesInterface $taxesRepository;

    /**
     * @param EmployeesInterface $employeesRepository
     * @param DepartmentInterface $departmentRepository
     * @param DesignationInterface $designationRepository
     * @param TeamsInterface $teamsRepository
     * @param EmployeeDepartmentInterface $employeeDepartmentRepository
     * @param BanksInterface $banksRepository
     * @param TeamMembersInterface $teamMembersRepository
     * @param EmployeeSalaryInterface $salaryRepository
     * @param EmployeeMediaInterface $employeeMediaRepository
     * @param LeavePolicyInterface $leavePolicy
     * @param TaxesInterface $taxesRepository
     */
    public function __construct(EmployeesInterface $employeesRepository, DepartmentInterface $departmentRepository, DesignationInterface $designationRepository, TeamsInterface $teamsRepository, EmployeeDepartmentInterface $employeeDepartmentRepository, BanksInterface $banksRepository, TeamMembersInterface $teamMembersRepository, EmployeeSalaryInterface $salaryRepository, EmployeeMediaInterface $employeeMediaRepository, LeavePolicyInterface $leavePolicy, TaxesInterface $taxesRepository)
    {
        $this->employeesRepository = $employeesRepository;
        $this->departmentRepository = $departmentRepository;
        $this->designationRepository = $designationRepository;
        $this->teamsRepository = $teamsRepository;
        $this->employeeDepartmentRepository = $employeeDepartmentRepository;
        $this->banksRepository = $banksRepository;
        $this->teamMembersRepository = $teamMembersRepository;
        $this->salaryRepository = $salaryRepository;
        $this->employeeMediaRepository = $employeeMediaRepository;
        $this->leavePolicy = $leavePolicy;
        $this->taxesRepository = $taxesRepository;
    }

    // View
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function viewEmployees()
    {
        abort_if(Gate::denies('view_employee'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employees = $this->employeesRepository->getEmployees();
        $departments = $this->departmentRepository->getDepartments();
        $designations = $this->designationRepository->getDesignations();
        $teams = $this->teamsRepository->getTeams();

        return view('hrmanagement::employees.employees', ["employees" => $employees, "departments" => $departments, "designations" => $designations, "teams" => $teams]);
    }

    // Add
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function addEmployee()
    {
        abort_if(Gate::denies('add_employee'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employees = $this->employeesRepository->getEmployees();
        $departments = $this->departmentRepository->getDepartments();
        $designations = $this->designationRepository->getDesignations();
        $teams = $this->teamsRepository->getTeams();
        $leavePolicy = $this->leavePolicy->getLeavePolicies();
        $taxes = $this->taxesRepository->getTaxes();
        return view('hrmanagement::employees.add_employee', ["employees" => $employees, "departments" => $departments, "designations" => $designations, "teams" => $teams, "leavePolicy" => $leavePolicy, "taxes" => $taxes]);
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeEmployee(Request $request)
    {

        try {
            // Personal Info
            $first_name = $request->get("first_name");
            $last_name = $request->get("last_name");
            $picture = null;
            $hire_date = $request->get("hire_date");
            $probation_period_start = $request->get("probation_period_start");
            $probation_period_end = $request->get("probation_period_end");
            $country = $request->get("country");
            $city = $request->get("city");
            $marital_status = $request->get("marital_status");
            $personal_email_address = $request->get("personal_email_address");
            $personal_phone_number = $request->get("personal_phone_number");
            $company_email_address = $request->get("company_email_address");
            $company_phone_number = $request->get("company_phone_number");
            // Employment
            $departments = $request->get("department");
            $designation = $request->get("designation");
            $employee_type = $request->get("employee_type");
            $contract_start_date = $request->get("contract_start_date");
            $contract_end_date = $request->get("contract_end_date");
            $duty_start_time = $request->get("duty_start_time");
            $duty_end_time = $request->get("duty_end_time");
            $agreement_file = null;
           

            // Bank Details
            $bank_name = $request->get("bank_name");
            $account_title = $request->get("account_title");
            $account_number = $request->get("account_number");
            $iban = $request->get("iban");
            $swift_code = $request->get("swift_code");
            $sort_code = $request->get("sort_code");
            $account_currency = $request->get("account_currency");
            // Salary
            $basic_salary = $request->get("basic_salary");
            $salary_cycle = $request->get("cycle");
            $taxable = $request->get("taxable");
            $tax_class = $request->get("tax_id");
            // Leave Policy
            $leave_policy = $request->get("leave_policy");
            // User Settings
            $create_user = $request->get("create_user");
            $password = $request->get("password");
            // Teams
            $team = $request->get("team");

            // create user
            $user_id = null;
            if ($password == null) {
                $password = Str::random(8);
            }
            if ($create_user) {
                $user = new User([
                    "name" => $first_name . " " . $last_name,
                    "email" => $company_email_address,
                    "password" => Hash::make($password),
                    "is_active" => true,
                ]);
                $user->save();
                $user = User::where(["email" => $company_email_address])->first();
                $user_id = $user->id;
            }

            // create employee
            if ($file = $request->file("picture")) {
                $helper = new Helper();
                $picture = $helper->storeFile($file, "employees");
            }
            $employee = $this->employeesRepository->createEmployee(firstName: $first_name, lastName: $last_name, personalEmailAddress: $personal_email_address, personalPhoneNumber: $personal_phone_number, companyEmailAddress: $company_email_address, companyPhoneNumber: $company_phone_number, picture: $picture, city: $city, country: $country, maritalStatus: $marital_status, hireDate: $hire_date, probationStartDate: $probation_period_start, probationEndDate: $probation_period_end, designationId: $designation, leavePolicyId: $leave_policy, employeeType: $employee_type, contractStartDate: $contract_start_date, contractEndDate: $contract_end_date, duty_start_time:$duty_end_time, duty_end_time:$duty_end_time, userId: $user_id);

            // create employee media
            if ($file = $request->file("agreement_file")) {
                $helper = new Helper();
                $agreement_file = $helper->storeFile($file, "employees");
                $this->employeeMediaRepository->createEmployeeMedia($agreement_file, $employee->id, "Agreement File");
            }
            // create emp dept
            foreach ($departments as $department) {
                $this->employeeDepartmentRepository->createEmployeeDepartment(employeeId: $employee->id, departmentId: $department);
            }

            // create bank
            $this->banksRepository->createBank(bankName: $bank_name, employeeId: $employee->id, iban: $iban, accountTitle: $account_title, accountNumber: $account_number, swiftCode: $swift_code, sortCode: $sort_code, accountCurrency: $account_currency);

            // create salary
            if ($taxable == null) {
                $taxable = false;
            }
            $this->salaryRepository->createEmployeeSalary(basicSalary: $basic_salary, cycle: $salary_cycle, employeeId: $employee->id, taxable: $taxable, taxId: $tax_class);
            // create team
            if ($team) {
                $this->teamMembersRepository->createTeamMember(teamId: $team, employeeId: $employee->id);
            }
            return redirect()->route("hr_employees")->with("success", "Employee added successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            error_log("error ".$exception);
            return redirect()->route("hr_employees")->with("error", "Something went wrong! Contact support");
        }
    }
    // Edit
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function editEmployee($id)
    {
        abort_if(Gate::denies('edit_employee'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employee = $this->employeesRepository->getEmployee($id);
        $departments = $this->departmentRepository->getDepartments();
        $designations = $this->designationRepository->getDesignations();
        $teams = $this->teamsRepository->getTeams();
        $leavePolicy = $this->leavePolicy->getLeavePolicies();
        $taxes = $this->taxesRepository->getTaxes();
        $employeeMedia = $this->employeeMediaRepository->getEmployeeMediaWithType(employeeId: $id,type: "Agreement File");

        return view('hrmanagement::employees.edit_employees', ["employee" => $employee, "departments" => $departments, "designations" => $designations, "teams" => $teams, "leavePolicy" => $leavePolicy, "taxes" => $taxes, "employeeMedia"=>$employeeMedia]);

    }
    /**
     * Update the specified resource in storage.
     */
    public function updatePersonalInformation(Request $request)
    {
        abort_if(Gate::denies('update_employee'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $first_name = $request->get("first_name");
            $last_name = $request->get("last_name");
            $picture = null;
            $hire_date = $request->get("hire_date");
            $probation_period_start = $request->get("probation_period_start");
            $probation_period_end = $request->get("probation_period_end");
            $country = $request->get("country");
            $city = $request->get("city");
            $marital_status = $request->get("marital_status");
            $personal_email_address = $request->get("personal_email_address");
            $personal_phone_number = $request->get("personal_phone_number");
            $company_email_address = $request->get("company_email_address");
            $company_phone_number = $request->get("company_phone_number");
            if ($file = $request->file("picture")) {
                $helper = new Helper();
                $picture = $helper->storeFile($file, "employees");
            }
            $this->employeesRepository->updateEmployeePersonalInformation(id: $request->get('employee_id'), firstName: $first_name, lastName: $last_name, personalEmailAddress: $personal_email_address, personalPhoneNumber: $personal_phone_number, companyEmailAddress: $company_email_address, companyPhoneNumber: $company_phone_number, picture: $picture, city: $city, country: $country, maritalStatus: $marital_status, hireDate: $hire_date, probationStartDate: $probation_period_start, probationEndDate: $probation_period_end);
            return redirect()->route("hr_employees")->with("success", "Employee personal information updated successfully");
        } catch (Exception $exception) {
            log::error($exception);
            return redirect()->route("hr_employees")->with("error", "Something went wrong! Please Contact Support");
        }
    }
    public function updateEmployment(Request $request)
    {
        abort_if(Gate::denies('update_employee'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $designation = $request->get("designation");
            $employee_type = $request->get("employee_type");
            $contract_start = $request->get('contract_start_date');
            $contract_end = $request->get('contract_end_date');
            $this->employeesRepository->updateEmployment(id: $request->get('employee_id'), designationId: $designation, employType: $employee_type, contractStart: $contract_start, contractEnd: $contract_end);
            // update employee media
            if ($file = $request->file("agreement_file")) {
                $helper = new Helper();
                $agreement_file = $helper->storeFile($file, "employees");
                $employee_media = $this->employeeMediaRepository->getEmployeeMediaWithType(employeeId: $request->get('employee_id'),type: "Agreement File");
                if($employee_media){
                    $this->employeeMediaRepository->updateEmployeeMedia(id: $employee_media->id, path: $agreement_file, employeeId: $request->get('employee_id'), type: "Agreement File");
                }
                else{
                    $this->employeeMediaRepository->createEmployeeMedia($agreement_file, $request->get('employee_id'), "Agreement File");
                }
            }
            return redirect()->route("hr_employees")->with("success", "Employee personal information updated successfully");
        } catch (Exception $exception) {
            log::error($exception);
            return redirect()->route("hr_employees")->with('error', 'Something went wrong! Please Contact Support');
        }
    }
    public function updateBankDetails(Request $request)
    {
        abort_if(Gate::denies('update_employee'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $bank_name = $request->get('bank_name');
            $account_title = $request->get('account_title');
            $account_number = $request->get('account_number');
            $iban = $request->get('iban');
            $swift_code = $request->get('swift_code');
            $sort_code = $request->get('sort_code');
            $account_currency = $request->get('account_currency');
            $this->employeesRepository->updateEmployeeBank(id: $request->get('employee_id'), bankName: $bank_name, accountTitle: $account_title, accountNumber: $account_number, iban: $iban, swiftCode: $swift_code, sortCode: $sort_code, accountCurrency: $account_currency);
            return redirect()->route("hr_employees")->with("success", "Employee bank details updated successfully");
        } catch (Exception $exception) {
            log::error($exception);
            return redirect()->route('hr_employees')->with('error', 'Something went wrong! Please Contact Support');
        }
    }

    public function updateSalary(Request $request)
    {
        abort_if(Gate::denies('update_employee'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $basic_salary = $request->get('basic_salary');
            $cycle = $request->get('cycle');
            $taxable = $request->get('taxable');
            if($taxable){
                error_log(" taxable true");
                $tax_id = $request->get('tax_id');
            }
            else{

                error_log(" taxable false");
                $taxable = false;
                $tax_id = null;
            }


            $this->employeesRepository->updateSalary(id: $request->get('employee_id'), basicSalary: $basic_salary, salaryCycle: $cycle, taxable: $taxable, taxClass: $tax_id);
            return redirect()->route('hr_employees')->with('success', "Employee Salary Updated Successfully");
        } catch (Exception $exception) {
            error_log("error :".$exception);
            log::error($exception);
            return redirect()->route('hr_employees')->with('error', 'Something went wrong! Please Contact Support');
        }
    }

    public function updateLeavePolicy(Request $request)
    {
        abort_if(Gate::denies('update_employee'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $leave_policy = $request->get('leave_policy');
            $this->employeesRepository->updateLeavePolicy(id: $request->get('employee_id'), leavePolicy: $leave_policy);
            return redirect()->route('hr_employees')->with('success', "Employee leave policy updated successfully");
        } catch (Exception $exception) {
            log::error($exception);
            return redirect()->route('hr_employees')->with('error', "Something went wrong! Please Contact Support");
        }
    }

    public function updateUserSettings(Request $request, $id)
    {
        //
    }

    public function updateTeam(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyEmployee($id)
    {
        abort_if(Gate::denies('delete_employee'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->employeesRepository->deleteEmployee($id);
            return redirect()->route("hr_employees")->with("success", "Employee deleted successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route("hr_employees")->with("error", "Something went wrong! Contact support");
        }
    }

}
