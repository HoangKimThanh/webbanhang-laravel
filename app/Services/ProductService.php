<?php

namespace App\Services;

class ProductService
{
    public static function handleUploadedImage($image)
    {
        if (!is_null($image)) {
            $imageName = date('Y-m-d-H-i-s') . str_replace(' ', '-', $image->getClientOriginalName());
            $image->move(public_path('img/uploads'), $imageName);

            return $imageName;
        }

        return null;
    }

    public static function handleMultipleImages($images)
    {
        $images_description = "";
        if (!is_null($images)) {
            foreach ($images as $image) {
                $imageName = date('Y-m-d-H-i-s') . str_replace(' ', '-', $image->getClientOriginalName());
                $image->move(public_path('img/uploads'), $imageName);

                if ($images_description === "")
                    $images_description .= $imageName;
                else
                    $images_description .= " " . $imageName;
            }
        }

        return $images_description;
    }
}
