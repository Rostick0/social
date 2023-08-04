<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function updateProfile(ProfileUpdateRequest $request)
    {
        $request->validated();

        return response()->json( $request->validated());
        $photo_id = null;
        if ($request['photo']){
           $file = File::createAndSaveInStorage($request['photo']);
           $photo_id = $file->id;
        }

        $data = [
            'name' => $request['name'],
            'surname' => $request['surname'],
            'patronymic' => $request['patronymic'],
            'status' => $request['status'],
            'age' => $request['age'],
            'photo_id' => $photo_id,
            'email' => $request['email'],
        ];

        $user = User::firstWhere('id',auth()->id())->update($data);

        return response()->json($user);
    }
}
