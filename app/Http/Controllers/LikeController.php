<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function getGalleryLikes(Request $request, $id)
    {
        $photo_id = $id;

        $extends = $request['extend'];
        $filters = empty($request['filter']) ? null : $request['filter'];

        $comments = Like::where($filters)->where(['photo_id' => $photo_id])->with($extends)->paginate($request["limit"]);

        return response()->json($comments);
    }
    public function likeGallery(Request $request, $id)
    {
        $photo_id = $id;

        $comment = Like::create([
            "photo_id" => $photo_id,
        ]);

        return response()->json($comment);
    }
    public function deleteGalleryLike(Request $request, $id)
    {
        $comment_id = $id;

        $fileRow = Like::firstWhere([
            'id' => $comment_id,
            'user_id' => auth()->id()
        ]);

        $fileRow->delete();

        return response()->json($fileRow);
    }
}
