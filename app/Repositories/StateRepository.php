<?php

namespace App\Repositories;

use App\Interfaces\StateInterface;
use App\Models\State;

class StateRepository implements StateInterface
{

    public function update($id, $data)
    {
        return State::where('id', $id)->update($data);
    }

    public function getAllStates()
    {
        return State::all();
    }

    public function getStatesOfCountry($country_id)
    {
        return State::where(["country_id" => $country_id, "active_status" => 1])->get();
    }
}
