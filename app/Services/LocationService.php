<?php

namespace App\Services;

use App\Repositories\InterFaces\LocationRepositoryInterface;

class LocationService {

    protected $locationRepo;
      
    public function __construct(LocationRepositoryInterface $locationRepo)
    {
        $this->locationRepo = $locationRepo;
    }

    public function getAllLocation($req) {
        return $this->locationRepo->getListOfLocations($req);
    }

    public function addLocation($data) {
        return $this->locationRepo->registerLoation($data);
    }

    public function updateLocation($data, $id) {
        return $this->locationRepo->updateLocation($data, $id);
    }
}

?>