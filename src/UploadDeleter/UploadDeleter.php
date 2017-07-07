<?php

/**
 * Created by PhpStorm.
 * User: TonyMalto
 * Date: 01/07/2017
 * Time: 12:32
 */

namespace Alaska\UploadDeleter;

class UploadDeleter
{


    public function deleteFileByName($fileName)
    {
       $file_path =  __DIR__ . '/../../web' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $fileName;
       unlink($file_path);

    }


}