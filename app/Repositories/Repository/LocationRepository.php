<?php

namespace App\Repositories\Repository;

use App\Repositories\InterFaces\LocationRepositoryInterface;
use App\Models\Location;
use App\Models\User;

class LocationRepository implements  LocationRepositoryInterface {

    /** Get list of all location */
    public function getListOfLocations($req){
        if ($req->ajax()) {
            $locationData = Location::select('*');
            return datatables()->of($locationData)
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('location.edit', encrypt($row)) . '" class="btn btn-sm btn-success">
                        <i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '&nbsp';
                    $btn .= '<button class="btn btn-danger btn-sm delete-location" data-id="' . $row->id . '" data-url="' . route('location.destroy', $row->id) . '"><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.location.index');
    }

    /** register or create new location */
    public function registerLoation($data) {
        return Location::create($data);
    }

    public function updateLocation($data, $id)
    {
        $encodedId = decrypt($id);
        $findLocation = Location::find($encodedId)->update($data);
        return $findLocation;
    }
}

?>