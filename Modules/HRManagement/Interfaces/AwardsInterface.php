<?php

namespace Modules\HRManagement\Interfaces;

interface AwardsInterface
{
  public function createAward($title,$icon=null,$description=null,$amount=null);
  public function editAward($id,$title,$icon=null,$description=null,$amount=null);
  public function getAwards();
  public function getAward($id);
  public function deleteAward($id);
}
