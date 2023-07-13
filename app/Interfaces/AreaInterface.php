<?php

namespace App\Interfaces;

interface AreaInterface
{
    public function add($data);
    public function getAllAreas();
    public function getWhere($where);
    public function getWhereSingle($where);
    public function getAreasOfCity($city_id);
}
