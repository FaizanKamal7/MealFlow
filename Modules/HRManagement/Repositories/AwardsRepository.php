<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\Awards;
use Modules\HRManagement\Interfaces\AwardsInterface;

class AwardsRepository implements AwardsInterface
{

    /**
     * @param $title
     * @param $icon
     * @param $description
     * @param $amount
     * @return mixed
     */
    public function createAward($title, $icon = null, $description = null, $amount = null)
    {
        $award = new Awards([
            "title"=>$title,
            "icon"=>$icon,
            "description"=>$description,
            "amount"=>$amount
        ]);

        return $award->save();
    }

    /**
     * @param $id
     * @param $title
     * @param $icon
     * @param $description
     * @param $amount
     * @return mixed
     */
    public function editAward($id, $title, $icon = null, $description = null, $amount = null)
    {
        $award = Awards::findOrFail($id);
        if ($title != null){
            $award->title=$title;
        }
        if ($icon != null){
            $award->icon=$icon;
        }
        $award->description=$description;
        $award->amount=$amount;

        return $award->save();
    }

    /**
     * @return mixed
     */
    public function getAwards()
    {
       return Awards::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getAward($id)
    {
        return Awards::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteAward($id)
    {
        return Awards::where(["id"=>$id])->delete();
    }
}
