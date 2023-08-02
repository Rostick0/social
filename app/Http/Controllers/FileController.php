<?php

namespace App\Http\Controllers;

use App\Http\Requests\File\FileRequest;
use App\Models\File;
use App\Utils\FileUtils;

class FileController extends Controller
{
    public function index()
    {
        $files = File::limit(5)->get();

        return response()->json($files);
    }
    public function create(FileRequest $request)
    {
        $data = $request->validated();

        $file = new FileUtils($data["file"]);
        $file->saveInStorage();

        $fileRow = File::create([
            'name' => $file->uniqueName,
            'link' => $file->link,
            'size' => $file->size,
        ]);

        return response()->json($fileRow);
    }
}
