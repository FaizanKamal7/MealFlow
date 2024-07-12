<?php

namespace Modules\HRManagement\Repositories;

use Modules\HRManagement\Entities\Taxes;
use Modules\HRManagement\Interfaces\TaxesInterface;

class TaxesRepository implements TaxesInterface
{

    /**
     * @param $name
     * @param $amountPercentage
     * @return mixed
     */
    public function createTax($name, $amountPercentage)
    {
        $tax = new Taxes([
            "name"=>$name,
            "amount_percentage"=>$amountPercentage
        ]);

        return $tax->save();
    }

    /**
     * @param $id
     * @param $name
     * @param $amountPercentage
     * @return mixed
     */
    public function updateTax($id, $name = null, $amountPercentage = null)
    {
       $tax = Taxes::find($id);
       if ($name){
           $tax->name = $name;
       }
       if ($amountPercentage){
           $tax->amount_percentage = $amountPercentage;
       }

       return $tax->save();
    }

    /**
     * @return mixed
     */
    public function getTaxes()
    {
        return Taxes::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTax($id)
    {
        return Taxes::find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteTax($id)
    {
        return Taxes::where(["id"=>$id])->delete();
    }
}
