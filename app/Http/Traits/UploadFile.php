<?php

namespace App\Http\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait UploadFile
{

    public function uploadFile($request, $folder)
    {

        $file = $request;
        $originalName = $file->getClientOriginalName();

        if (preg_match('/\.[^.]+\./', $originalName)) {
            throw new Exception(trans('general.notAllowedAction'), 403);
        }

        $fileName = Str::random(32);
        $mime_type = $file->getClientOriginalExtension();;
        $type = explode('/', $mime_type);

        $path = $file->storeAs($folder, $fileName . '.' . end($type), 'public');
        return $path;
    }
}
