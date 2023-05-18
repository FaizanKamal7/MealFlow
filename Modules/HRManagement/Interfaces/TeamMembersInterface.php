<?php

namespace Modules\HRManagement\Interfaces;

interface TeamMembersInterface
{
public function createTeamMember($teamId,$employeeId,$isLeader=false);
public function updateTeamMember($id,$teamId=null,$employeeId=null,$isLeader=null);
public function getTeamMember($id);
public function deleteTeamMember($id);
public function getTeamMembers();
public function getTeamMembersByTeam($teamId);
public function getTeamMembersByEmployee($employeeId);

}
