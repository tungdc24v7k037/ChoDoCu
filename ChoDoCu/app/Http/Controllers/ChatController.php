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
                'lastMessage'
            ])
            ->latest('updated_at')
            ->get();

        return view('chat.index', compact('conversations'));
    }

    public function start(Listing $listing)
    {
        $buyerId = auth()->id();
        $sellerId = $listing->user_id;

        // Không cho tự chat với chính mình
        abort_if($buyerId === $sellerId, 403);

        $conversation = Conversation::firstOrCreate([
            'listing_id' => $listing->id,
            'buyer_id' => $buyerId,
            'seller_id' => $sellerId,
        ]);

        return redirect()->route(
            'chat.show',
            $conversation
        );
    }

    public function show(Conversation $conversation)
    {
        $userId = auth()->id();

        abort_unless(
            $conversation->buyer_id === $userId ||
            $conversation->seller_id === $userId,
            403
        );

        $conversation->load([
            'listing.primaryImage',
            'buyer',
            'seller',
            'messages.sender'
        ]);

        Message::where('conversation_id', $conversation->id)
            ->where('sender_id', '!=', $userId)
            ->update([
                'is_read' => true
            ]);

        $conversations = Conversation::where(function ($query) use ($userId) {
                $query->where('buyer_id', $userId)
                    ->orWhere('seller_id', $userId);
            })
            ->with([
                'listing.primaryImage',
                'buyer',
                'seller',
                'lastMessage'
            ])
            ->latest('updated_at')
            ->get();

        return view('chat.show', compact(
            'conversation',
            'conversations'
        ));
    }

    public function send(
        Request $request,
        Conversation $conversation
    ) {
        $userId = auth()->id();

        abort_unless(
            $conversation->buyer_id === $userId ||
            $conversation->seller_id === $userId,
            403
        );

        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $userId,
            'message' => $request->message,
        ]);

        $conversation->touch();

        return redirect()->route(
            'chat.show',
            $conversation
        );
    }
}