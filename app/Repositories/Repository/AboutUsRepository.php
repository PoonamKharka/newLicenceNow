<?php

namespace App\Repositories\Repository;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Repositories\InterFaces\AboutUsRepositoryInterface;

class AboutUsRepository implements AboutUsRepositoryInterface
{

    public function profile()
    {
        $abtUs = AboutUs::first(); 
        return view('admin.aboutus.profile', compact('abtUs'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $abtUsId = $request->input('id');

        if ($abtUsId) {
            // Update existing record
            $abtUs = AboutUs::find($abtUsId);

            if ($abtUs) {
                $abtUs->title = $request->input('title');
                $abtUs->description = $request->input('description');
                $abtUs->save();
                return redirect()->route('aboutus.create')->with('success', 'Data updated successfully.');
            } else {
                return back()->with('error', 'Data not found.');
            }
        } else {
            // Create new record
            AboutUs::create([
                'title' => $request->input('title'),
                'description' => $request->input('description')
            ]);
            return redirect()->route('aboutus.create')->with('success', 'Data created successfully.');
        }
    }
}
