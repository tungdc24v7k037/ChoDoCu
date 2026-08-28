<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Listing;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $conversations = Conversation::where(function ($query) use ($userId) {
                $query->where('buyer_id', $userId)
                    ->orWhere('seller_id', $userId);
            })
            ->with([
                'listing.primaryImage',
                'buyer',
                'seller',
                'lastMessage',
            ])
            ->latest('updated_at')
            ->get();

        return view('chat.index', compact('conversations'));
    }

    public function start(Listing $listing)
    {
        $buyerId = auth()->id();
        $sellerId = $listing->user_id;

        if ($buyerId == $sellerId) {
            return back();
        }

        $conversation = Conversation::firstOrCreate([
            'listing_id' => $listing->id,
            'buyer_id' => $buyerId,
            'seller_id' => $sellerId,
        ]);

        return redirect()->route('chat.show', $conversation->id);
    }

    public function show(Conversation $conversation)
{
    $userId = auth()->id();

    if (
        $conversation->buyer_id != $userId &&
        $conversation->seller_id != $userId
    ) {
        abort(403);
    }

    // Đánh dấu tin nhắn của người kia là đã đọc
    Message::where('conversation_id', $conversation->id)
        ->where('sender_id', '!=', $userId)
        ->where('is_read', 0)
        ->update([
            'is_read' => 1,
        ]);

    // Load conversation hiện tại
    $conversation->load([
        'listing.primaryImage',
        'buyer',
        'seller',
        'messages.sender',
    ]);

    // Danh sách conversation bên trái
    $conversations = Conversation::where(function ($query) use ($userId) {
            $query->where('buyer_id', $userId)
                ->orWhere('seller_id', $userId);
        })
        ->with([
            'listing.primaryImage',
            'buyer',
            'seller',
            'lastMessage',
        ])
        ->latest('updated_at')
        ->get();

    return view('chat.show', compact(
        'conversation',
        'conversations'
    ));
}

    public function send(Request $request, Conversation $conversation)
    {
        $userId = auth()->id();

        if (
            $conversation->buyer_id != $userId &&
            $conversation->seller_id != $userId
        ) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $userId,
            'message' => $request->message,
            'is_read' => 0,
        ]);

        $conversation->touch();

        return response()->json([
            'success' => true,
            'message' => [
                'text' => $message->message,
                'time' => $message->created_at->format('H:i'),
            ],
        ]);
    }
}