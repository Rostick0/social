<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::orderByDesc('id')->paginate(20);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $post = Post::create([
            ...$data,
            'user_id' => auth()->id()
        ]);

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $post = Post::findOrFail($id);

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validated();

        Post::firstWhere([
            'id' => $id,
            'user_id' => auth()->id()
        ])
            ->update([
                ...$data,
            ]);

        $post = Post::find($id);

        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $post = Post::firstWhere([
            'id' => $id,
            'user_id' => auth()->id(),
        ])->destroy();

        return response()->json($post);
    }
}
