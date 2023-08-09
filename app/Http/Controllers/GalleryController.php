<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gallery\GalleryCreate;
use App\Models\File;
use App\Models\Gallery;
use Illuminate\Http\Request;


class GalleryController extends Controller
{
    public function getPhotos(Request $request)
    {
        $extends = $request['extend'];
        $filters = empty($request['filter']) ? null : $request['filter'];

        $photos = Gallery::where($filters)->with($extends)->paginate($request["limit"]);

        return response()->json($photos);
    }

    public function addPhoto(GalleryCreate $request)
    {
        $user_id = auth()->id();

        $photoRow = File::createAndSaveInStorage($request->photo);

        $gallery = Gallery::create([
            'user_id' => $user_id,
            'photo_id' => $photoRow->id
        ]);

        return response()->json($gallery);
    }
    // public function addPhoto(Request $request)
    // {
    //     $user_id = auth()->id();

    //     $photoRows = [];

    //     if ($request->has('photo')) {
    //         if (is_array($request->photo)){
    //             $photoRows = File::bulkCreateAndSaveInStorage($request->photo);
    //         }
    //         else {
    //             $photoRows[] = File::createAndSaveInStorage($request->photo);
    //         }
    //     }

    //     $gallery = [];

    //     foreach ($photoRows as $photoRow) {
    //         $gallery[] = Gallery::create([
    //             'user_id' => $user_id,
    //             'photo_id' => $photoRow->id
    //         ]);
    //     }

    //     return response()->json($gallery);
    // }
}
