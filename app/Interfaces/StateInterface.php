<?php

namespace App\Interfaces;

interface StateInterface
{
    public function update($id, $data);
    public function getAllStates();
    public function getStatesOfCountry($country_id);
}
