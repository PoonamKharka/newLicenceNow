<?php

namespace App\Repositories\InterFaces;

interface LessonRepositoryInterface {

    public function getAllLessons($req);
    public function registerLesson($data);
    public function editLesson($id);
    public function updateLesson($data, $id);
}

?>