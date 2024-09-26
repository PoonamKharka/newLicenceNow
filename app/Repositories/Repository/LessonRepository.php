<?php

namespace App\Repositories\Repository;

use App\Repositories\InterFaces\LessonRepositoryInterface;
use App\Models\Lesson;

class LessonRepository implements LessonRepositoryInterface {

    /** Get list of all lessons */
    public function getAllLessons($req){
        return Lesson::select('*');
    }


    /** Get list of all location */
    public function registerLesson($req){
        return Lesson::create($req);
    }


    /** Get list of all location */
    public function updateLesson( $data, $id ){

    }
}