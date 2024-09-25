<?php

namespace App\Services;

use App\Repositories\InterFaces\PricingRepositoryInterface;

class PricingService {

    protected $priceRepo;
      
    public function __construct(PricingRepositoryInterface $priceRepo)
    {
        $this->priceRepo = $priceRepo;
    }

    public function getAllPrices($req) {

        if($req->ajax()) {
            
            $data = $this->priceRepo->getAllPrices($req);
            return datatables()->of($data)
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('price.edit', encrypt($row)) . '" class="btn btn-sm btn-success">
                            <i class="fas fa-pencil-alt"></i></a>';
                        $btn .= '&nbsp';
                        $btn .= '<button class="btn btn-danger btn-sm delete-location" data-id="' . $row->id . '" data-url="' . route('price.destroy', $row->id) . '"><i class="fas fa-trash"></i></button>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        }
        
        return view('admin.pricing.index');
    }

    public function addPrice($data) {
        return $this->priceRepo->registerLoation($data);
    }

    public function updatePrice($data, $id) {
        return $this->priceRepo->updatePrice($data, $id);
    }

}

?>