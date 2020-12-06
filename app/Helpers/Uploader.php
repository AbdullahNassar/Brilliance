<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class Uploader
{
    public static function upload($file,$path)
    {
        $extension = $file->getClientOriginalExtension();

        $oldFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        $fileName = $oldFileName .'-'. Str::random(10).'.'.$extension;

        $file->move($path,$fileName);

        return $fileName;
    }
}