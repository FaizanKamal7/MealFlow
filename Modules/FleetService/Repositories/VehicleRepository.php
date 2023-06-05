<?php

namespace Modules\FleetService\Repositories;
use Modules\FleetService\Entities\Vehicle;
use Modules\FleetService\Interfaces\VehicleInterface;


class VehicleRepository implements VehicleInterface{


 /**
 * @param string $id
 * @param string|null $api_unit_id
 * @param string $registration_number
 * @param string|null $vehicle_picture
 * @param string|null $engine_number
 * @param string|null $chassis_number
 * @param string|null $vehicle_model_id
 * @param string|null $year
 * @param string|null $color
 * @param string|null $qr_code
 * @param string|null $insurance_picture
 * @param string|null $insurance_issue_date (in Y-m-d format)
 * @param string|null $insurance_expiry_date (in Y-m-d format)
 * @param string|null $municipality_picture
 * @param string|null $municipality_issue_date (in Y-m-d format)
 * @param string|null $municipality_expiry_date (in Y-m-d format)
 * @param string|null $registration_picture
 * @param string|null $registration_issue_date (in Y-m-d format)
 * @param string|null $registration_expiry_date (in Y-m-d format)
 * @param string $status (default: 'available')
 * @param int $mileage (default: 0)
 * @param int|null $maintenance_interval
 * @param string|null $vehicle_type_id
 * @param \Illuminate\Support\Carbon|null $created_at
 * @param \Illuminate\Support\Carbon|null $updated_at
 */

 public function createVehicle($registrationNumber,$engineNumber,$chassisNumber,$vehicleModelID,$vehicleYear,$vehicleColor,$vehicleStatus,$vehicleTypeId,$vehiclePicture = null,$vehicleMileage,$registrationPicture = null,$registrationIssueDate,$registrationExpiryDate,$insurancePicture= null,$insuranceIssueDate,$insuranceExpiryDate,$municipalityPicture= null,$municipalityIssueDate,$municipalityExpiryDate,$apiUnitId,$qrCode= null)
 {
   $vehicle = Vehicle::create([
      'api_unit_id' => $apiUnitId,
      'registration_number' => $registrationNumber,
      'vehicle_picture' => $vehiclePicture,
      'engine_number' => $engineNumber,
      'chassis_number' => $chassisNumber,
      'vehicle_model_id' => $vehicleModelID,
      'year' => $vehicleYear,
      'color' => $vehicleColor,
      'qr_code'=>$qrCode,
      'insurance_picture' => $insurancePicture,
      'insurance_issue_date' => $insuranceIssueDate,
      'insurance_expiry_date' => $insuranceExpiryDate,
      'municipality_picture' => $municipalityPicture,
      'municipality_issue_date' => $municipalityIssueDate,
      'municipality_expiry_date' => $municipalityExpiryDate,
      'Registration_picture' => $registrationPicture,
      'Registration_issue_date' => $registrationIssueDate,
      'Registration_expiry_date' => $registrationExpiryDate,
      'status' => $vehicleStatus,
      'mileage' => $vehicleMileage,
      'vehicle_type_id' => $vehicleTypeId,
  ]);
  $vehicle->save();
  return $vehicle;

 }

 public function getVehicles(){
   return Vehicle::all();
 }
 public function getVehicle($id){
  return Vehicle::find($id);
 }

 public function getVehicleByCriteria($field,$value){
    return Vehicle::getByCriteria($field,$value);
 }
}