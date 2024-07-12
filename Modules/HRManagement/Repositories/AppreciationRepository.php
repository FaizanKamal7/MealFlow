<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\Appreciation;
use Modules\HRManagement\Interfaces\AppreciationInterface;

class AppreciationRepository implements AppreciationInterface
{

    /**
     * @param $date
     * @param $employeeId
     * @param $note
     * @param $picture
     * @param $amount
     * @param $awardId
     * @return mixed
     */
    public function createAppreciation($date, $employeeId, $note = null, $picture = null, $amount = null, $awardId = null)
    {
        $appreciation = new Appreciation([
            "date"=>$date,
            "note"=>$note,
            "picture"=>$picture,
            "amount"=>$amount,
            "award_id"=>$awardId,
            "employee_id"=>$employeeId,
        ]);

        return $appreciation->save();
    }

    /**
     * @param $id
     * @param $date
     * @param $employeeId
     * @param $note
     * @param $picture
     * @param $amount
     * @param $awardId
     * @return mixed
     */
    public function updateAppreciation($id, $date = null, $employeeId = null, $note = null, $picture = null, $amount = null, $awardId = null)
    {
        $appreciation = Appreciation::findOrFail($id);
        $appreciation->note=$note;
        if($date){
            $appreciation->date=$date;
        }
        if($employeeId){
            $appreciation->employee_id=$employeeId;
        }
        if($picture){
            $appreciation->picture=$picture;
        }
        if($amount){
            $appreciation->amount=$amount;
        }
        if($awardId){
            $appreciation->award_id=$awardId;
        }

        return $appreciation->save();
    }

    /**
     * @return mixed
     */
    public function getAppreciations()
    {
        return Appreciation::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getAppreciation($id)
    {
        return Appreciation::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteAppreciation($id)
    {
       return Appreciation::where(["id"=>$id])->delete();
    }
}
