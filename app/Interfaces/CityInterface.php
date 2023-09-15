<?php

namespace App\Interfaces;

interface CityInterface
{

    public function update($id, $data);
    public function get($id);
    public function getAllCities();
    public function getCitiesOfState($state_id);
    public function searchCity($search_term);

    //getSearchCities added to implement searchcity method
    public function getSearchCities($query);

}
