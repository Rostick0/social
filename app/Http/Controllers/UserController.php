<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index(UserRequest $request)
    {
        $users = [];

        if (count($request["extend"]) > 0) {
            $users = User::with($request["extend"])->firstWhere([
                'id'=>auth()->user()->id,
            ]);
        } else {
            $users = User::firstWhere([
                'id'=>auth()->user()->id,
            ]);
        }

        return response()->json($users);
    }

}
