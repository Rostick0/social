<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function getFriends(Request $request)
    {
        $user_id = auth()->id();
        $extends = $request->extend ?? [];

        $friends = Friend::with($extends)->where('user_id', $user_id)->paginate($request['limit']);

        return response()->json($friends);
    }
    public function unFriend($id)
    {
        $user_id = auth()->id();
        $friend_id = $id;

        if (!User::where(["id" => $friend_id])->first()) {
            return response()->json(['message' => "no person with current id"], 400);
        }

        if ($user_id == $friend_id) {
            return response(['message' => "it is forbidden to unfriend yourself"], 400);
        }

        $user = Friend::where(["user_id" => $user_id, "friend_id" => $friend_id])->firstOrFail();

        if (!$user) {
            return response([
                'message' => 'no friend with current id'
            ])->json($user);
        }

        $friend = Friend::where(["user_id" =>  $friend_id, "friend_id" => $user_id])->first();
        $friend['accepted'] = false;

        $user->delete();
        $friend->save();

        return response()->json(['message' => 'unfriending success']);
    }

    public function makeFriend($id)
    {
        $user_id = auth()->id();
        $friend_id = $id;

        if (!User::where(["id" => $friend_id])->first()) {
            return response()->json(['message' => "no person with current id"], 400);
        }

        if ($user_id == $friend_id) {
            return response()->json(['message' => "it is forbidden to friend yourself"], 400);
        }

        $foundFriend = Friend::where(["user_id" => $user_id, "friend_id" => $friend_id])->first();

        if ($foundFriend) {
            return response()->json([$foundFriend, "abob"]);
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
