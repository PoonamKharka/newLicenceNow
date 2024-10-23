<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ImageUploadService
{

   
    public function uploadImage(UploadedFile $image, string $folder)
    {
        
         $path = $folder . '/' . time() . '_' . $image->getClientOriginalName();
             
        Storage::disk('public')->put($path, file_get_contents($image));
        return $path;
    }
    public function uploadImages(array $images, string $folder)
    {
        $paths = [];

        foreach ($images as $image) {
            
            if ($image instanceof UploadedFile) {
                $path = $folder . '/' . time() . '_' . $image->getClientOriginalName();

                Storage::disk('public')->put($path, file_get_contents($image));
                $paths[] = $path;
            }
        }
        return $paths;
    }
}