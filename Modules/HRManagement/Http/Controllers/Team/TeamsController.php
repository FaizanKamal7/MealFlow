<?php

namespace Modules\HRManagement\Http\Controllers\Team;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Modules\HRManagement\Interfaces\DepartmentInterface;
use Modules\HRManagement\Interfaces\EmployeesInterface;
use Modules\HRManagement\Interfaces\TeamMembersInterface;
use Modules\HRManagement\Interfaces\TeamsInterface;
use Symfony\Component\HttpFoundation\Response;

class TeamsController extends Controller
{
    // Meta Data
    private DepartmentInterface $departmentsRepository;
    private EmployeesInterface $employeesRepository;
    private TeamsInterface $teamsRepository;
    private TeamMembersInterface $teamMembersRepository;

    public function __construct(DepartmentInterface $departmentsRepository, TeamMembersInterface $teamMembersRepository, TeamsInterface $teamsRepository, EmployeesInterface $employeesRepository)
    {
        $this->departmentsRepository = $departmentsRepository;
        $this->employeesRepository = $employeesRepository;
        $this->teamMembersRepository = $teamMembersRepository;
        $this->teamsRepository = $teamsRepository;
    }
    //View

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function viewTeams()
    {
        abort_if(Gate::denies('view_team'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {

            $teams = $this->teamsRepository->getTeams();
            $employees = $this->employeesRepository->getEmployees();
            $departments = $this->departmentsRepository->getDepartments();
            return view('hrmanagement::teams.teams', ["teams" => $teams, "departments" => $departments, "employees" => $employees]);
        } catch (Exception $exception) {
            Log::error($exception);
            return view('hrmanagement::teams.teams')->with('error', 'Something went wrong');
        }
    }

    //Add

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeTeam(Request $request)
    {
        abort_if(Gate::denies('add_team'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {

            $team_name = $request->get('team_name');
            $department = $request->get('department');
            $description = $request->get('description');
            $team = $this->teamsRepository->createTeam(teamName: $team_name, description: $description, departmentId: $department);
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route('hr_teams')->with('error', "Something went wrong while adding team");
        }
        try {
            $team_members = $request->get('team_members');
            if (sizeof($team_members) > 0) {
                foreach ($team_members as $member) {
                    $this->teamMembersRepository->createTeamMember(teamId: $team->id, employeeId: $member);
                }
            }
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route('hr_teams')->with('error', "Something went wrong while adding members");
        }
        return redirect()->route('hr_teams')->with('success', "Team and Members added successfully");

    }

    //Edit

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function editTeam($id)
    {
        abort_if(Gate::denies('edit_team'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {

            $team = $this->teamsRepository->getTeam($id);
            $departments = $this->departmentsRepository->getDepartments();
            return response()->json(["team" => $team, "departments" => $departments], 200);
        } catch (Exception $exception) {
            Log::error($exception);
            return response()->json(["team" => Null], 400);

        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function updateTeam(Request $request)
    {
        abort_if(Gate::denies('update_team'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $id = $request->get('id');
            $team_name = $request->get('edit_team_name');
            $description = $request->get('edit_description');
            $department = $request->get('edit_department');
            $this->teamsRepository->updateTeam(id: $id, teamName: $team_name, description: $description, departmentId: $department);
            return redirect()->route('hr_teams')->with('success', "Team updated successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route('hr_teams')->with('error', "Something went wrong");
        }
    }

    //Delete

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyTeam($id)
    {
        abort_if(Gate::denies('delete_team'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $this->teamsRepository->deleteTeam($id);
            return redirect()->route('hr_teams')->with('success', "Team deleted successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route('hr_teams')->with('error', "Something went wrong");
        }
    }
}
