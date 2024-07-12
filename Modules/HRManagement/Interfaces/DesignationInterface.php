<?php

namespace Modules\HRManagement\Interfaces;

interface DesignationInterface
{
public function createDesignation($name,$parentDesignationId=null);
public function updateDesignation($id,$name=null,$parentDesignationId=null);
public function getDesignations();
public function getDesignation($id);
public function deleteDesignation($id);
}
