<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\TeamMembers;
use Modules\HRManagement\Interfaces\TeamMembersInterface;

class TeamMembersRepository implements TeamMembersInterface
{

    /**
     * @param $teamId
     * @param $employeeId
     * @param $isLeader
     * @return mixed
     */
    public function createTeamMember($teamId, $employeeId, $isLeader = false)
    {
        $teamMember = new TeamMembers([
            "team_id"=>$teamId,
            "employee_id"=>$employeeId,
            "is_leader"=>$isLeader
        ]);

        return $teamMember->save();
    }

    /**
     * @param $id
     * @param $teamId
     * @param $employeeId
     * @param $isLeader
     * @return mixed
     */
    public function updateTeamMember($id, $teamId = null, $employeeId = null, $isLeader = null)
    {
        $teamMember = TeamMembers::find($id);
        if ($teamId){
            $teamMember->team_id= $teamId;
        }
        if ($employeeId){
            $teamMember->employee_id=$employeeId;
        }
        $teamMember->is_leader = $isLeader;
        return $teamMember->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTeamMember($id)
    {
        return TeamMembers::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteTeamMember($id)
    {
        return TeamMembers::where(["id"=>$id])->delete();
    }

    /**
     * @return mixed
     */
    public function getTeamMembers()
    {
        return TeamMembers::all();
    }

    /**
     * @param $teamId
     * @return mixed
     */
    public function getTeamMembersByTeam($teamId)
    {
        return TeamMembers::where(["team_id"=>$teamId])->get();
    }

    /**
     * @param $employeeId
     * @return mixed
     */
    public function getTeamMembersByEmployee($employeeId)
    {
        return TeamMembers::where(["employee_id"=>$employeeId])->get();
    }


}
