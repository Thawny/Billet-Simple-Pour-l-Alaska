<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 01/07/2017
 * Time: 12:32
 */

namespace Alaska\ImageManager;

class ImageManager
{


    public function deleteFileByName($fileName)
    {
       $file_path =  __DIR__ . '/../../web' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $fileName;
       unlink($file_path);

    }

//    public function getImageFileByName($fileName)
//    {
//        $file_path =  __DIR__ . '/../../web' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $fileName;
//        return file_get_contents($file_path);
//
//    }


}