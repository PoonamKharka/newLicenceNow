<?php

namespace App\Repositories\Repository;

use App\Repositories\InterFaces\PricingRepositoryInterface;
use App\Models\Price;

class PricingRepository implements PricingRepositoryInterface {

    /** Get list of all prices */
    public function getAllPrices($req){
        $list = Price::select('*');
        return $list;
    }
    
    /** add new  prices */
    public function registerLoation($req){
        return Price::create($req);
    }

    /** update price*/
    public function updatePrice($data, $id)
    {
        $encodedId = decrypt($id);
        $findPrice = Price::find($encodedId)->update($data);
        return $findPrice;
    }
}