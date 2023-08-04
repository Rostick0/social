<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class File extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function createAndSaveInStorage(UploadedFile $file)
    {
        $size = $file->getSize();
        $mime_type = $file->getClientMimeType();
        $extension = $file->extension();

        $unique_name = uniqid() . "." . $extension;
        $original_name = $file->getClientOriginalName();

        $link = url('storage/images/' . $unique_name);

        $fileRow = File::create([
            'size' => $size,
            'mime_type' => $mime_type,
            'extension' => $extension,
            'file_name' => $unique_name,
            'original_name' => $original_name,
            'link' => $link
        ]);

        $file->move(storage_path('app/public/images'), $unique_name);

        return $fileRow;
    }
}

// $files = array();
// if ($request->file('files')) {
//     foreach ($request->file('files') as $key => $file) {
//         $size = $file->getSize();
//         $mime_type = $file->getClientMimeType();
//         $extension = $file->extension();

//         $unique_name = uniqid() . "." . $extension;
//         $original_name = $file->getClientOriginalName();

//         $link = url('storage/images/' . $unique_name);

//         $files[] = [
//             'size' => $size,
//             'mime_type' => $mime_type,
//             'extension' => $extension,
//             'unique_name' => $unique_name,
//             'original_name' => $original_name,
//             'link' => $link
//         ];

//         $file->move(storage_path('app/public/images'), $unique_name);
//     }
// };

// foreach ($files as $file) {
//     File::create([
//         'file_name' => $file['unique_name'],
//         'original_name' => $file['original_name'],
//         'extension' => $file['extension'],
//         'mime_type' => $file['mime_type'],
//         'link' => $file['link'],
//         'size' => $file['size'],
//     ]);
// }

// return response()->json($files);
