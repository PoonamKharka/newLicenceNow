<?php
namespace App\Services;

use App\Repositories\InterFaces\FaqContentRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\FaqContent;

class FaqContentService
{
    protected $repo;

    public function __construct(FaqContentRepositoryInterface $faqContentRepository)
    {
        $this->repo = $faqContentRepository;
    }

    public function store($data)
    {
        $getData = FaqContent::first();
        if($getData) {
            $dataExist = FaqContent::findOrFail($data['id']);
            $result = $dataExist->update($data);
        } else {
            $result = $this->repo->store($data);
        }
        return $result;
    }
}

?>