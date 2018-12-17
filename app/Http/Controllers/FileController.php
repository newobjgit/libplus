<?php

namespace App\Http\Controllers;
use App\Book;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function downloadFile(Request $request)
    {
        $path=storage_path().'\app';
        $file = $request->link;
        $filepath = $path.$file;
        return Response::download($filepath);

    }

    public function uploadFile(Request $request)
    {

        if ($request->file('link')) {

            $file = $request->file('link');
            $upload_folder = '\public\\';
            $filename = $file->getClientOriginalName();
            $path = $upload_folder.$filename;

            Storage::putFileAs($upload_folder, $file, $filename);

            $filesize = Storage::size($path);
            $ext = File::extension($path);

            $arr = ['filesize' => $filesize, 'ext' => $ext, 'path' => $path];

            return $arr;
        }

    }
}
