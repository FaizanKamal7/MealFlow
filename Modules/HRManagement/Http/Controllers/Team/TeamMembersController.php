<?php

namespace Modules\HRManagement\Http\Controllers\Team;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\HRManagement\Interfaces\EmployeesInterface;
use Modules\HRManagement\Interfaces\TeamMembersInterface;
use Modules\HRManagement\Interfaces\TeamsInterface;

class TeamMembersController extends Controller
{
    // Meta Data
    private EmployeesInterface $employeesRepository;
    private TeamsInterface $teamsRepository;
    private TeamMembersInterface $teamMembersRepository;

    public function __construct(EmployeesInterface $employeesRepository, TeamsInterface $teamsRepository, TeamMembersInterface $teamMembersRepository)
    {
        $this->teamsRepository = $teamsRepository;
        $this->teamMembersRepository = $teamMembersRepository;
        $this->employeesRepository = $employeesRepository;
    }

    // View

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function viewTeamMembers($id)
    {
        try {
            $team_members = $this->teamMembersRepository->getTeamMembersByTeam($id);
            $team_members = $team_members->sortBy('is_leader')->reverse();
            $team = $this->teamsRepository->getTeam($id);
            $employees = $this->employeesRepository->getEmployees();
            return view('hrmanagement::teams.team_members', ["team_members" => $team_members, "team" => $team, "employees" => $employees]);
        } catch (Exception $exception) {
            Log::error($exception);
            return view('hrmanagement::teams.team_members')->with('error', "Something went wrong");

        }
    }
    // Add

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function storeTeamMembers(Request $request, $id)
    {
        try {
            $team_members = $request->get('team_member_members');
            if (sizeof($team_members) > 0) {
                foreach ($team_members as $member) {
                    $this->teamMembersRepository->createTeamMember(teamId: $id, employeeId: $member);
                }
            }
            return redirect()->route('hr_team_members', ["id" => $id])->with('success', "Members added successfully");
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route('hr_team_members', ["id" => $id])->with('error', "Something went wrong");
        }
    }
    // Edit , make & remove Leader

    /**
     * Show the specified resource.
     * @param int $id
     */
    public function makeTeamLeader($team_id, $member_id)
    {
        try{
            $team_member = $this->teamMembersRepository->getTeamMember($member_id);
            $this->teamMembersRepository->updateTeamMember(id: $team_member->id, teamId: $team_member->team_id, employeeId: $team_member->employee_id, isLeader: true);
            return redirect()->route('hr_team_members', ["id" => $team_id])->with('success', "Manager added successfully");
        }
        catch (Exception $exception){
            Log::error($exception);
            return redirect()->route('hr_team_members', ["id" => $team_id])->with('error', "Something went wrong");

        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     */
    public function removeTeamLeader($team_id, $member_id)
    {
        try{
            $team_member = $this->teamMembersRepository->getTeamMember($member_id);
            $this->teamMembersRepository->updateTeamMember(id: $team_member->id, teamId: $team_member->team_id, employeeId: $team_member->employee_id, isLeader: false);
            return redirect()->route('hr_team_members', ["id" => $team_id])->with('success', "Manager removed successfully");
        }
        catch (Exception $exception){
            Log::error($exception);
            return redirect()->route('hr_team_members', ["id" => $team_id])->with('error', "Something went wrong");

        }
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

    // Delete

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroyTeamMember($team_id, $id)
    {
        try {
            if (count($this->teamMembersRepository->getTeamMembersByTeam($team_id)) == 1) {
                return redirect()->route('hr_team_members', ["id" => $team_id])->with('error', "Team must have at least 1 member.");
            } else {
                $this->teamMembersRepository->deleteTeamMember($id);
                return redirect()->route('hr_team_members', ["id" => $team_id])->with('success', "Member deleted successfully");
            }
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->route('hr_team_members', ["id" => $team_id])->with('error', "Something went wrong");
        }
    }
}
