<?php

namespace App\Helper;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Helper
{
    public static function getObjet($model, $request)
    {
        $data = $request->only($model->getFillable());
        $model->fill($data);
        return $model;
    }
    public static function saveImage($data_file, $path, $has_multiple = false, $disk)
    {
        if ($has_multiple) :
            $image = [];
            $time = Carbon::now()->timestamp;
            foreach ($data_file as $file) {
                $image_name = strtolower($file->getClientOriginalName());
                $image_full_name = $time . str_replace(" ", '', $image_name);
                $upload_path =  $path . '/';
                $image_url = $upload_path . $image_full_name;
                $file->storeAs($upload_path, $image_full_name);
                $image[] = $image_url;
            }
            return $image;
        else :
            $file = $data_file;
            $originalImageName = $file->getClientOriginalName();
            $originalName = Str::before($originalImageName, '.');
            $image_name = $file->getClientOriginalExtension();
            $filename = $originalName . Carbon::now()->timestamp . '.' . $image_name;
            $file->storeAs($path . '/', $filename, $disk);
            $filename = $path . '/' . $filename;


            return $filename;
        endif;
    }

    public static  function deleteOldImage($image, $disk = 'public')
    {
        Storage::disk($disk)->delete($image);

        // $path = storage_path($image);

        // if (Storage::disk('local')->has('public/',$path)) :
        //     Storage::delete($path);
        // endif;
    }
}