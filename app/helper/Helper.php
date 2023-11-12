<?php


namespace App\helper;
use Intervention\Image\Facades\Image;


class Helper
{
    public static function uploadFile ($fileObject, $directory, $width, $height, $existFileUrl = null)
    {
        if ($fileObject)
        {
            if ($existFileUrl)
            {
                if (file_exists($existFileUrl))
                {
                    unlink($existFileUrl);
                }
            }
            $position = strpos($fileObject, ';');
            $subString = substr($fileObject, 0, $position);
            $extension = explode('/', $subString)[1];
            $fileName = time().rand(10, 1000).".".$extension;
            $fileDirectory ='admin/assets/images/upload-images/' . $directory.'/';

            // Ensure the directory exists
            if (!file_exists($fileDirectory)) {
                mkdir($fileDirectory, 0755, true);
            }
            $fileUrl = $fileDirectory.$fileName;
                $img = Image::make($fileObject);
                $img->resize($width, $height);
                $img->save($fileUrl);
        } else {
            if ($existFileUrl)
            {
                $fileUrl = $existFileUrl;
            } else {
                $fileUrl = null;
            }
        }
        return $fileUrl;
    }
}