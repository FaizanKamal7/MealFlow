<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\Teams;
use Modules\HRManagement\Interfaces\TeamsInterface;

class TeamsRepository implements TeamsInterface
{

    /**
     * @param $teamName
     * @param $description
     * @param $status
     * @param $departmentId
     * @return mixed
     */
    public function createTeam($teamName, $description = null, $status = "active", $departmentId = null)
    {
       $team = new Teams([
           "team_name"=>$teamName,
           "description"=>$description,
           "status"=>$status,
           "department_id"=>$departmentId
       ]);
        $team->save();
       return $team;
        }

    /**
     * @param $id
     * @param $teamName
     * @param $description
     * @param $status
     * @param $departmentId
     * @return mixed
     */
    public function updateTeam($id, $teamName = null, $description = null, $status = null, $departmentId = null)
    {
        $team = Teams::find($id);
        $team->description = $description;
        if ($teamName){
            $team->team_name = $teamName;
        }
        if ($status){
            $team->status  =$status;
        }
        if ($departmentId){
            $team->department_id = $departmentId;
        }
        return $team->save();
    }

    /**
     * @return mixed
     */
    public function getTeams()
    {
        return Teams::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTeam($id)
    {
        return Teams::find($id);
    }

    /**
     * @param $departmentId
     * @return mixed
     */
    public function getTeamsByDepartment($departmentId)
    {
        return Teams::where(["department_id"=>$departmentId])->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteTeam($id)
    {
       return Teams::where(["id"=>$id])->delete();
    }
}
