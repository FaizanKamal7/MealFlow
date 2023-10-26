<?php

namespace App\Interfaces;

interface ApplicationInterface
{
    public function createApplication($appIcon, $appName, $description = null, $menu = null, $logs = null, $previousVersion = null, $currentVersion = null, $isActive = true);
    public function updateApplication($id, $appIcon, $appName, $description = null, $isActive = true);
    public function getApplications();
    public function getApplication($id);
    public function deleteApplication($id);
    public function getApplicationByName($name);
    public function getApplicationModels($application_id);
}
