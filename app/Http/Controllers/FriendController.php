<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function create(Request $request)
    {

        // TMP
        $user_id = 8;
        $friend_id = $request->friend_id;

        if ($user_id == $friend_id) {
            return response(['message'=>"Нельзя добавить в друзья себя"],400);
        }

        $user = Friend::where("user_id", $user_id)->where("friend_id", $friend_id)->with(["user", "friend"])->first();

        if ($user) {
            return response()->json($user);
        }

        $friendIsAccept = false;
        $friend = Friend::where("user_id", $friend_id)->where("friend_id", $user_id)->first();
        if ($friend) {
            $friendIsAccept = true;
            $friend->accepted = true;
            $friend->save();
        }

        $user = Friend::create([
            'user_id' => $user_id,
            'friend_id' => $friend_id,
            'accepted' => $friendIsAccept
        ]);

        return response()->json($user);
    }
}
