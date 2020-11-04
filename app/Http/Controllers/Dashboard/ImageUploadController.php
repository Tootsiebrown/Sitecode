<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $this->validate($request, [
            'cms_image' => 'mimes:jpeg,bmp,png,svg',
            'path' => 'required|max:64',
        ]);

        $placementPath = 'public/uploads/' . $request->input('path');
        $filePath = $request->file('image')->store($placementPath);

        $filename = substr($filePath, strlen($placementPath) + 1);

        return Response::json([
            'path' => '/storage/uploads/' . $request->input('path') . '/' . $filename,
            'filename' => substr($filePath, strlen($placementPath) + 1),
        ]);
    }
}
