<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function download(Request $request)
    {
        if ($request->f == null) {
            abort(404);
        }

        $path = decrypt($request->f);

        if (Storage::exists($path)) {
            // $content = Storage::get($path);
            return response()->download(Storage::path($path));
            // abort(404);
        } else {
            abort(404);
        }
    }

    public function preview(Request $request)
    {
        if ($request->f == null) {
            abort(404);
        }

        $path = decrypt($request->f);

        if (Storage::exists($path)) {
            return Storage::response($path);
        }
    }

    public function profilePicture(Request $request)
    {
        if ($request->f == null) {
            return asset('images/undraw_profile_1.svg');
            // abort(404);
        }

        $path = decrypt($request->f);

        if (Storage::exists($path)) {
            return Storage::response($path);
        }
    }
}
