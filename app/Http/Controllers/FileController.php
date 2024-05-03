<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function download(Request $request)
    {
        // dd(decrypt($request->f));
        $path = decrypt($request->f);

        if ($path == null) {
            abort(404);
        }

        if (Storage::exists($path)) {
            // $content = Storage::get($path);
            return response()->download(Storage::path($path));
            abort(404);
        } else {
            abort(404);
        }
    }

    public function preview(Request $request)
    {
        $path = decrypt($request->f);

        if ($path == null) {
            abort(404);
        }

        if (Storage::exists($path)) {
            return Storage::response($path);
            // return Storage::get($path);
        }

        dd($path);
    }
}
