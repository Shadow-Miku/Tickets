<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function reply(Request $request) // User reply field: (commentary)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'comentary' => 'required|string|max:255',
        ]);

        $chat = Chat::findOrFail($request->chat_id);
        $chat->comentary = $request->comentary;
        $chat->save();

        return redirect()->route('user/tickets')->with('success', 'Reply sent successfully');
    }

    public function answer(Request $request) // Assistant reply field: (answer)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'answer' => 'required|string|max:255',
        ]);

        $chat = Chat::findOrFail($request->chat_id);
        $chat->answer = $request->answer;
        $chat->save();

        return redirect()->route('assistant/tickets')->with('success', 'Reply sent successfully');
    }

    public function observation(Request $request) // Admin reply field: (obervation)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'observation' => 'required|string|max:255',
        ]);

        $chat = Chat::findOrFail($request->chat_id);
        $chat->observation = $request->observation;
        $chat->save();

        return redirect()->route('admin.assignedtickets')->with('success', 'Obervation sent successfully');
    }

}
