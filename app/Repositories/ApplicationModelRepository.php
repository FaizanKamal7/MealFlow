<?php

namespace App\Repositories;

use App\Interfaces\ApplicationModelInterface;
use App\Models\Application;
use App\Models\ApplicationModel;

class ApplicationModelRepository implements ApplicationModelInterface
{

    public function getAllApplicationModels()
    {
        return ApplicationModel::all();
    }

    public function getApplicationModels($application_id)
    {
        $application = Application::with('models')->find($application_id);
        return response()->json(['models' => $application->models]);
    }


    public function createApplicationModel($model_name, $app_id)
    {
        $application_model = new ApplicationModel([
            "model_name" => $model_name,
            "app_id" => $app_id,
        ]);

        $application_model->save();
        return $application_model;
    }
}
