<?php

namespace Modules\FleetService\Interfaces;

interface VehicleInterface{
    public function createVehicle($registrationNumber,$engineNumber,$chassisNumber,$vehicleModel,$vehicleYear,$vehicleColor,$vehicleStatus,$vehicleTypeId,$vehiclePicture = null,$vehicleMileage,$registrationPicture = null,$registrationIssueDate,$registrationExpiryDate,$insurancePicture= null,$insuranceIssueDate,$insuranceExpiryDate,$municipalityPicture= null,$municipalityIssueDate,$municipalityExpiryDate,$apiUnitId,$qrCode);
    public function updateVehicle($id,$registrationNumber,$engineNumber,$chassisNumber,$vehicleModel,$vehicleYear,$vehicleColor,$vehicleStatus,$vehicleTypeId,$vehiclePicture = null,$vehicleMileage,$registrationPicture = null,$registrationIssueDate,$registrationExpiryDate,$insurancePicture= null,$insuranceIssueDate,$insuranceExpiryDate,$municipalityPicture= null,$municipalityIssueDate,$municipalityExpiryDate,$apiUnitId,$qrCode);
    public function updateVehicleFields($id,$fields);
    public function getVehicles();
    public function getVehicle($id);
    public function deleteVehicle($id);
    

    public function getVehicleByCriteria($field,$value);
}