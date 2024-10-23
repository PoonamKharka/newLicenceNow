<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ImageUploadService
{

   
    public function uploadImage(UploadedFile $image, string $folder)
    {
        
        $fileName = time() . '_' . $image->getClientOriginalName();
        $path = $folder . '/' . $fileName;
        Storage::disk('public')->put($path, file_get_contents($image));
        $filePath = Storage::url($path);        
        return config('app.baseUrl').$filePath; 
    }
    public function uploadImages(array $images, string $folder)
    {
        $paths = [];

        foreach ($images as $image) {
            
            if ($image instanceof UploadedFile) {
                $path = $folder . '/' . time() . '_' . $image->getClientOriginalName();

                Storage::disk('public')->put($path, file_get_contents($image));
                $filePath = Storage::url( $path);
                $paths[] = config('app.baseUrl') . $path;
            }
        }
        return $paths;
    }
}