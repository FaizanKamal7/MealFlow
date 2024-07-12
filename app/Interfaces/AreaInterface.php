<?php

namespace App\Interfaces;

interface AreaInterface
{
    public function add($data);
    public function getAllAreas();
    public function getWhere($where);
    public function getWhereSingle($where);
    public function getAreasOfCity($city_id);
    public function updateOrInsertAreaIfAttributeExist($attribute, $value, $data);
    public function searchArea($searchTerm);
    public function searchAreaFirst($searchTerm);
    public function getAreaById($id);
    public function createArea($name, $city_id, $coordinates = null, $geoname_id = null);

    // =============================================================================================
    // ===============================  A P I   F U N C T I O N S   ================================
    // =============================================================================================
    public function getFormattedAreas();
}
