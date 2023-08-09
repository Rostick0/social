<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index(UserRequest $request)
    {
        $extend = $request["extend"];
        $limit = $request->limit;

        $users = User::with($extend)->paginate($limit);

        return response()->json($users);
    }
}
