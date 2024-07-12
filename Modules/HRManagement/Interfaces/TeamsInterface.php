<?php

namespace Modules\HRManagement\Interfaces;

interface TeamsInterface
{
public function createTeam($teamName,$description=null,$status="active",$departmentId=null);
public function updateTeam($id,$teamName=null,$description=null,$status=null,$departmentId=null);
public function getTeams();
public function getTeam($id);
public function getTeamsByDepartment($departmentId);
public function deleteTeam($id);
}
