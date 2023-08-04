<?php

namespace App\Http\Controllers;

use App\Http\Requests\File\FileRequest;
use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Request;


class FileController extends Controller
{
    public function upload(FileRequest $request)
    {
        $request->validated();
        
        $file = request()->file('file');

        if (!$file) {
            return response()->json([
                'message' => 'file is required'
            ], 400);
        }

        $fileRow = File::createAndSaveInStorage($file);

        return response()->json($fileRow);
    }

    public function deleteById($id)
    {
        $fileRow = File::where([
            'id' => $id,
        ])->first();

        if (!$fileRow) {
            return response()->json(['success' => false, 'message' => 'File not found']);
        }

        $filePath = storage_path('app\\public\\images\\' . $fileRow['file_name']);

        if (!file_exists($filePath)) {
            return response()->json(['success' => false, 'message' => 'File not found']);
        }

        $fileRow->delete();
        unlink($filePath);

        return response()->json(['success' => true]);
    }
}
