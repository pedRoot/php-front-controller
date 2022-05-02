<?php

namespace Ptorres\PhpMvcComposer\lib;

use Error;

class UtilImage
{
    public static function storeImage(array $fileImage): string
    {
        try {
            $targetDir = "public/upload";

            $extarr = explode('.', $fileImage["name"]);
            $filename = $extarr[sizeof($extarr) - 2];
            $extensionOfImage = $extarr[sizeof($extarr) - 1];

            // TODO
            // Validaciones correspondientes a la carga de la imagen
            //
            // Validar strtolower(pathinfo($target_file,PATHINFO_EXTENSION))
            // Validar getImagesize($fileImage)

            $newFileName = md5(Date('Ymdgi') . $filename) . '.' . $extensionOfImage;
            $targetFile = $targetDir . $newFileName;

            move_uploaded_file($fileImage["tmp_name"], $targetFile);
            return $newFileName;
        } catch (\Throwable $th) {
            throw $th;
            error_log($th);
        }
    }
}
