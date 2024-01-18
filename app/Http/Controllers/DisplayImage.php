<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class DisplayImage extends Controller
{
    public function displayImage(Request $filename)
    {
        if (!$filename->folder) {
            abort(404);
        }
        if (!Storage::disk('public')->exists("$filename->folder/$filename->uri")) {
            abort(404);
        }
        return Storage::disk('public')->response("$filename->folder/$filename->uri");
    }
}
