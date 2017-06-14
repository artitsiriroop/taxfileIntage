<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 20/4/2560
 * Time: 16:35 น.
 */

namespace AppBundle;

use Symfony\Component\HttpFoundation\File\UploadedFile;
class FileUploader
{

    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->targetDir, $fileName);

        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }

}