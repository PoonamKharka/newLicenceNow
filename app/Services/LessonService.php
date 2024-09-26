<?php

namespace App\Services;

use App\Repositories\InterFaces\LessonRepositoryInterface;

class LessonService {

    protected $lessonRepo;
      
    public function __construct(LessonRepositoryInterface $lessonRepo)
    {
        $this->lessonRepo = $lessonRepo;
    }

    public function getAllLesson($req) {
        if($req->ajax()){
            $data = $this->lessonRepo->getAllLessons($req);
            return datatables()->of($data)
                    ->editColumn('status', function ($row) {
                        if ($row->status == 1) {
                            return '<h5><span class="badge badge-success">Active</a></h5>';
                        } else {
                            return '<h5><span class="badge badge-warning">Draft</a></h5>';
                        }
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('lessons.edit', encrypt($row)) . '" class="btn btn-sm btn-success">
                            <i class="fas fa-pencil-alt"></i></a>';
                        $btn .= '&nbsp';
                        $btn .= '<button class="btn btn-danger btn-sm delete-location" data-id="' . $row->id . '" data-url="' . route('lessons.destroy', $row->id) . '"><i class="fas fa-trash"></i></button>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.lessons.index');
    }

    public function addLesson($data) {
        return $this->lessonRepo->registerLesson($data);
    }

    public function updateLesson($data, $id) {
        //return $this->lessonRepo->updateLocation($data, $id);
    }
}

?>