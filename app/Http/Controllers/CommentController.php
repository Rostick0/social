<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getGalleryComments(Request $request, $id)
    {
        $photo_id = $id;

        $extends = $request['extend'];
        $filters = empty($request['filter']) ? null : $request['filter'];

        $comments = Comment::where($filters)->where(['photo_id' => $photo_id])->with($extends)->paginate($request["limit"]);

        return response()->json($comments);
    }
    public function commentGallery(Request $request, $id)
    {
        $content  = $request["content"];
        $photo_id = $id;

        $comment = Comment::create([
            "photo_id" => $photo_id,
            "content" => $content,
        ]);

        return response()->json($comment);
    }
    public function deleteGalleryComment(Request $request, $id)
    {
        $comment_id = $id;

        $fileRow = Comment::firstWhere([
            'id' => $comment_id,
            'user_id' => auth()->id()
        ]);

        $fileRow->delete();

        return response()->json($fileRow);
    }
}
