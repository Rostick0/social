<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index(UserRequest $request)
    {
        $users = [];

        $perPage = $request->perPage;
        $page = $request->page;

        if (count($request["extend"]) > 0) {
            $users = User::with($request["extend"])->where([
                'id'=>auth()->user()->id,
            ])->first();
        } else {
            $users = User::where([
                'id'=>auth()->user()->id,
            ])->first();
        }

        return response()->json($users);
    }
}
