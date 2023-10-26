<?php

namespace App\Interfaces;

interface ApplicationModelInterface
{
    public function getAllApplicationModels();
    public function getApplicationModels($application_id);
    public function createApplicationModel($model_name, $app_id);
}
