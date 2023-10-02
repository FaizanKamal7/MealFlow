<?php

namespace App\Interfaces;

interface CountryInterface
{
    public function update($id, $data);
    public function getAllCountries();
    public function getAllActiveCountries();
    public function getAllCountryStateCities();
    public function getCountryWithItsLocations();

}
