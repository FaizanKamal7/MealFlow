<?php

namespace App\Repositories;

use App\Interfaces\ApplicationModelInterface;
use App\Models\Application;
use App\Models\ApplicationModel;

class ApplicationModelRepository implements ApplicationModelInterface
{

    public function getApplicationModels()
    {
        return ApplicationModel::all();
    }
}
