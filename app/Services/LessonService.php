<?php

namespace App\Services;

use App\Repositories\InterFaces\LessonRepositoryInterface;
use App\Models\LessonLocation;
use App\Models\LessonPrice;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Lesson;

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
                    ->addColumn('locations-list', function ($row) {
                        $listLocation = [];
                        if($row->lessonLocations) {
                            foreach ($row->lessonLocations as  $value) {
                                $locs[] = $value->locations->street;
                            }

                            return $listLocation[] =  $locs;
                        }
                    })
                    ->addColumn('price-list', function ($row) {
                        $listPrice = [];
                        if($row->lessonPrice) {
                            foreach ($row->lessonPrice as  $value) {
                                $prices[] = $value->prices->hours.'hr' . ' - ' . '$'.$value->prices->price;
                            }

                            return $listPrice[] =  $prices;
                        }
                    })
                    ->addColumn('lesson_status', function ($row) {
                        if ($row->status == 1) {
                            return '<h5><span class="badge badge-success">Active</a></h5>';
                           
                        } else {
                            return '<h5><span class="badge badge-danger">Inactive</a></h5>';
                        }
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('lessons.edit', encrypt($row->id)) . '" class="btn btn-sm btn-success">
                            <i class="fas fa-pencil-alt"></i></a>';
                        $btn .= '&nbsp';
                        $btn .= '<button class="btn btn-danger btn-sm delete-lesson" data-id="' . $row->id . '" data-url="' . route('lessons.destroy', $row->id) . '"><i class="fas fa-trash"></i></button>';

                        return $btn;
                    })
                    ->rawColumns(['locations-list' , 'lesson_status' , 'action'])
                    ->make(true);
        }

        return view('admin.lessons.index');
    }

    public function addLesson($data) {
        try {
            DB::beginTransaction();
            $saveLessonData = $this->lessonRepo->registerLesson($data);
            $lastLessonId = $saveLessonData->id;
            
            if( $saveLessonData && $data['location_id']) { 
                foreach ($data['location_id'] as $value) {
                    $locdata = [
                        'lesson_id' => $lastLessonId,
                        'location_id' => $value
                    ];
                    LessonLocation::create( $locdata);
                }
            }

            if( $saveLessonData && $data['pricing_id']) {
                foreach ($data['pricing_id'] as $val) {
                    $pridata = [
                        'lesson_id' => $lastLessonId,
                        'pricing_id' => $val
                    ];
                    LessonPrice::create($pridata);
                }
            }
            
            DB::commit();
            return $saveLessonData;

        } catch (\Exception  $exp) {
            DB::rollBack();
            Log::error("Getting some error while adding lesson =>" . $exp );
        }
    }

    public function getEditData($id) {
        return $this->lessonRepo->editLesson($id);
    }

    public function updateLesson($data, $id) {
        try {
            DB::beginTransaction();
            $lessonId = decrypt($id);
            $findLessonLocationData = LessonLocation::where('lesson_id' , $lessonId)->get();
            $findPriceLocationData = LessonPrice::where('lesson_id' , $lessonId)->get();
           
            if( $findLessonLocationData ) {
                foreach ($findLessonLocationData as $locations) {
                    LessonLocation::where('id', $locations->id)->delete();
                }
            }

            if( $findPriceLocationData ) {
                foreach ($findPriceLocationData as $price) {
                    LessonPrice::where('id', $price->id)->delete();
                }
            }

            $updateLesson = Lesson::find($lessonId)->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'status' => $data['status']
            ]);

            if( $updateLesson && $data['location_id']) { 
                foreach ($data['location_id'] as $value) {
                    $locdata = [
                        'lesson_id' => $lessonId,
                        'location_id' => $value
                    ];
                    LessonLocation::create( $locdata);
                }
            }

            if( $updateLesson && $data['pricing_id']) {
                foreach ($data['pricing_id'] as $val) {
                    $pridata = [
                        'lesson_id' => $lessonId,
                        'pricing_id' => $val
                    ];
                    LessonPrice::create($pridata);
                }
            }
            DB::commit();
            return $updateLesson;

        } catch (\Exception $ex) {
            DB::rollBack();
            Log::error("Getting some error while updating lesson =>" . $ex );
        }
    }
}

?>