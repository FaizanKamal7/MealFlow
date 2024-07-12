<?php

namespace Modules\HRManagement\Interfaces;

interface AppreciationInterface
{
    public function createAppreciation($date,$employeeId,$note=null,$picture=null,$amount=null,$awardId=null);
    public function updateAppreciation($id,$date=null,$employeeId=null,$note=null,$picture=null,$amount=null,$awardId=null);
    public function getAppreciations();
    public function getAppreciation($id);
    public function deleteAppreciation($id);
}
