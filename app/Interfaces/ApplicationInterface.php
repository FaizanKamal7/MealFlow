<?php

namespace App\Interfaces;

interface ApplicationInterface
{
public function createApplication($appIcon,$appName,$description=null,$menu=null,$logs=null,$previousVersion=null,$currentVersion=null,$isActive=true);
}
