<?php

namespace App\Services;

use App\Repositories\InterFaces\AboutUsRepositoryInterface;
use Illuminate\Http\Request;

class AboutUsService
{
      protected $abtUsRep;

      public function __construct(AboutUsRepositoryInterface $aboutUsRepository)
      {
            $this->abtUsRep = $aboutUsRepository;
      }

      public function getAboutList($req){
            if($req->ajax()){
               $data = $this->abtUsRep->getAboutUsList($req);
               return datatables()->of($data)
                  ->addColumn('action', function ($row) {
                     $btn = '<a href="' . route('aboutus.edit', encrypt($row->id)) . '" class="btn btn-sm btn-success">
                        <i class="fas fa-pencil-alt"></i></a>';
                     $btn .= '&nbsp';
                     $btn .= '<button class="btn btn-danger btn-sm delete-aboutus" data-id="' . $row->id . '" data-url="' . route('aboutus.destroy', $row->id) . '"><i class="fas fa-trash"></i></button>';
      
                     return $btn;
                  })
                  ->rawColumns(['action'])
                  ->make(true);
            }
      
            return view('admin.aboutus.index'); 
      }

      public function profile()
      {
         return $this->abtUsRep->profile();
      }

      public function editRecord($id)
      {
         return $this->abtUsRep->editRecord($id);
      }

      public function store($request)
      {
         return $this->abtUsRep->store($request);
      }

      public function destroy($id)
      {
         return $this->abtUsRep->destroy($id);
      }
}
