<?php

namespace App\Repositories\Repository;

use App\Repositories\InterFaces\LessonRepositoryInterface;
use App\Models\Lesson;
use App\Models\Location;
use App\Models\Price;

class LessonRepository implements LessonRepositoryInterface {

    /** Get list of all lessons */
    public function getAllLessons($req) {
        return Lesson::select('*')->with(['lessonLocations', 'lessonLocations.locations' , 'lessonPrice' , 'lessonPrice.prices']);
       
    }


    /** Get list of all location */
    public function registerLesson($req){
        $insertData = Lesson::create($req);
        return $insertData;
    }

    /** This function is to get edit form data */
    public function editLesson($id) {
        $lessonId = decrypt($id);
        $allotedLocations = [];
        $allotedPrice = [];
        $findData = Lesson::find($lessonId)->with(['lessonLocations', 'lessonPrice'])->first();
        // if( $findData ) {
        //     foreach( $findData->lessonLocations as $locationArr) {
        //         $allotedLocations[] = [  $locationArr->location_id ];
        //     }

        //     foreach( $findData->lessonPrice as $priceArr) {
        //         $allotedPrice[] = [  $priceArr->pricing_id ];
        //     }
        // }
 
        //$locations = Location::whereNotIn('id', $allotedLocations)->get();
        //$prices = Price::whereNotIn('id', $allotedPrice)->get();
        $locations = Location::get();
        $prices = Price::get();
        return view('admin.lessons.edit', compact('findData' ,'locations', 'prices'));
    }

    /** Get list of all location */
    public function updateLesson( $data, $id ) {
        $lessonId = decrypt($id);
        $selectedLessonData = Lesson::find($lessonId)->with('lessonLocations', 'lessonPrice')->get();
        return $selectedLessonData;
    }
}