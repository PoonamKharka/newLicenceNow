<?php

namespace App\Repositories\InterFaces;

interface LocationRepositoryInterface {

    public function getListOfLocations($req);
    public function registerLoation($data);
    public function updateLocation($data, $id);
}

?>