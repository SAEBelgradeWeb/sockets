<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageEvent;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function store(Request $request)
    {
//        $request->validate([
//            'message' => 'required|string|max:255',
//        ]);

        Chat::create([
            'message' => $request->chat_message,
        ]);


        ChatMessageEvent::dispatch($request->chat_message);

        return redirect()->back();
    }
}
