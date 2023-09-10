<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadFileRequest;

class UploadFileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UploadFileRequest $request)
    {
        $path = $request->file('file')->storePublicly('public/images');
        return response()->json([
            'path' => $path,
        ]);
    }
}
