<?php

namespace App\Repositories\Repository;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Repositories\InterFaces\AboutUsRepositoryInterface;

class AboutUsRepository implements AboutUsRepositoryInterface
{

    public function getAboutUsList($req) {
        return AboutUs::all();
    }

    public function profile()
    {
        $abtUs = AboutUs::first(); 
        return view('admin.aboutus.create', compact('abtUs'));
    }

    public function editRecord($id)
    {
        $id = decrypt($id);
        $editFormData = AboutUs::findOrFail($id); 
        return $editFormData;
    }

    public function store(Request $request)
    {
        if ($request->id) {
            $checkExistingRecord = AboutUs::findOrFail($request->id);
            $storeData = $checkExistingRecord->update($request->all());
        } else {
            $storeData = AboutUs::create($request->all());
        }
    
        return $storeData;
    }

    public function destroy($id) {
        $data = AboutUs::findOrFail($id); 
        return $data->delete();
    }
}
