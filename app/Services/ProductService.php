<?php

namespace App\Services;

class ProductService {
    public function handleUploadedImage($image)
    {
        if (!is_null($image)) {
            $imageName = date('Y-m-d-H-i-s') . str_replace(' ', '-', $image->getClientOriginalName());
            $image->move(public_path('img/uploads'), $imageName);

            return $imageName;
        }

        return null;
    }

    public function handleMultipleImages($images)
    {
        $images_description = "";
        if (!is_null($images)) {
            foreach ($images as $image) {
                $imageName = date('Y-m-d-H-i-s') . str_replace(' ', '-', $image->getClientOriginalName());
                $image->move(public_path('img/uploads'), $imageName);

                $images_description .= $imageName . " ";
            }
        }

        return $images_description;
    }
}