<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadFIle
{

    public function updateOrInsertMorpOne($file_field, $model)
    {
        if (request()->has($file_field)) {

            $file = $this->base64UploadFile(request()->profile, true);

            if ($file['file_name']) {
                $model->file()->create([
                    'url'       => $file['file_name'], 
                    'type'      => $file_field, 
                    'mime_type' => $file['mime_type']
                ]);
            }
        }
    }


    public function updateOrInsertMorphMany($image_fillable, $model)
    {
        foreach($image_fillable as $file_field)
        {
            if (request()->has($file_field))
            {
                foreach(request()->$file_field as $img)
                {
                    $file = $this->base64UploadFile($img, true);
                    if($file['file_name'])
                    {
                        $model->file()->create([
                            'url'       => $file['file_name'], 
                            'type'      => $file_field, 
                            'mime_type' => $file['mime_type']
                        ]);
                    }
                }
            }
        }
    }

    /**
     * This method used to convert single string base64 to file 
     * and upload file to amazon storage 
     * @param string provide string base64 unlimited size
     * @return string|null as filename|null
     *  with all file pdf xlsx xls png jpg.....
     */


    public function base64UploadFile($base64_image_req, $with_mime_type = false)
    {
        // decode string to file system
        if ($base64_image_req) :
            @list(, $file_data) = explode(';', $base64_image_req);
            @list(, $file_data) = explode(',', $file_data);

            $base64_file = base64_decode($file_data);

            // \Log::info(mime_content_type($base64_image_req));
            // convert base 64 to mime-type Ex: xlsx, pdf ...
            $mime = $this->mimeTypeMap(mime_content_type($base64_image_req));
            
            // generate file name after decode
            $file_name = md5($base64_image_req . time()) . '.' . "$mime";

            // Locattion Store File
            // Storage::disk(config('const.filePath'))->put(config('const.filePath.original') . '/' . $file_name, $base64_file);
            // \Log::info($file_name);

        endif;
        if ($with_mime_type) {
            return [
                "file_name" => $file_name ?? '',
                "mime_type" => $mime ?? ''
            ];
        }
        return $file_name ?? '';
    }

    public function mimeTypeMap($mime)
    {
        $mime_map = config('mimeMap.map');
        return isset($mime_map[$mime]) === true ? $mime_map[$mime] : false;
    }
}
