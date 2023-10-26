<?php

namespace App\Repositories;

use App\Interfaces\ApplicationInterface;
use App\Models\Application;

class ApplicationRepository implements ApplicationInterface
{

    public function createApplication($appIcon, $appName, $description = null, $menu = null, $logs = null, $previousVersion = null, $currentVersion = null, $isActive = true)
    {
        $role = new Application([
            "app_icon" => $appIcon,
            "app_name" => $appName,
            "description" => $description,
            "is_active" => true,
        ]);

        $role->save();
        return $role;
    }

    public function updateApplication($id, $appIcon, $appName, $description = null, $isActive = true)
    {
        return Application::where(["id" => $id])->update([
            "app_icon" => $appIcon,
            "app_name" => $appName,
            "description" => $description,
            "is_active" => true,
        ]);
    }

    public function getApplications()
    {
        return Application::with('models')->get();
    }

    public function getApplication($id)
    {
        return Application::where(["id" => $id])->first();
    }

    public function getApplicationByName($name)
    {
        return Application::where(["app_name" => $name])->first();
    }

    public function deleteApplication($id)
    {
        return Application::where(["id" => $id])->delete();
    }

    public function getApplicationModels($application_id)
    {
        return Application::with('models')->find($application_id);
    }
}
