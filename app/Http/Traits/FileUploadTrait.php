<?php

namespace App\Http\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Storage;

trait FileUploadTrait
{
    public function uploadFile(UploadedFile $file,$folder,$preFilename=NULL,$baseFolder='public',$allowedFileExtension=['jpeg','jpg','png','svg']){
        $fileExtension = $file->getClientOriginalExtension();
        $validate = in_array($fileExtension,$allowedFileExtension);
        if ($validate){

            $filename = $this->generateFileName($preFilename,$fileExtension);

            if ($this->moveToServer($baseFolder,$folder,$filename,$file)){
                return $filename;
            }
        }
        return false;
    }

    public function generateFileName($preFilename,$fileExtension){

        if ($preFilename != NULL){
            $filename = $preFilename."_".time().'_'.Str::upper(Str::random(5)).'.'.$fileExtension;
        }else{
            $filename = time().'_'.Str::upper(Str::random(5)).'.'.$fileExtension;
        }

        return $filename;
    }

    public function moveToServer($baseFolder,$folder,$filename,$file){

        if ($baseFolder == 'storage'){
            Storage::disk('public')->putFileAs($folder,$file,$filename);
            return true;
        }else{
            $file->move(public_path() .'/'. $folder, $filename);
            return true;
        }
    }

    public function removeFile($path, $file)
    {
        if ($path == 'storage') {
            \Illuminate\Support\Facades\Storage::disk('public')->delete(str_replace('/storage/','',$file));
        } else {
            if (file_exists($path)){
                unlink($path);
            }
        }
    }
}
