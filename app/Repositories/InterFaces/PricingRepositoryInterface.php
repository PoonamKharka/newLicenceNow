<?php

namespace App\Repositories\InterFaces;

interface PricingRepositoryInterface {

    public function getAllPrices($req);
    public function registerLoation($data);
    public function updatePrice($data, $id);
}

?>