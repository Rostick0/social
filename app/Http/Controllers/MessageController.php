<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(int $chat_id)
    {
        $have_chat = Chat::where([
            'id' => $chat_id,
            'user_id' => auth()->id()
        ]);

        if (!$have_chat) return response()->json(['message' => 'Нет доступа'], 403);

        $data = Message::where([
            'chat_id' => $chat_id
        ])->paginate(100);

        return response()->json($data);
    }

    public function store(StoreMessageRequest $request)
    {
        $data = $request->validated();

        $message = Message::create($data);

        return response()->json($message);
    }

    public function update(UpdateMessageRequest $request, int $id)
    {
        $data = $request->validated();

        Message::where([
            'id' => $id,
            'user_id' => auth()->id()
        ])->update($data);

        $message = Message::where([
            'id' => $id,
            'user_id' => auth()->id()
        ]);

        if (!$message) return response()->json(['message' => 'Нет доступа'], 403);

        return response()->json($message);
    }


    public function destroy(int $id)
    {
        $data = Message::firstWhere([
            'id' => $id,
            'user_id' => auth()->id(),
        ])->destroy();

        return response()->json($data);
    }
}
