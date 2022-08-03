<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\MessageResouce;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function store(Request $request, User $user)
    {
        $userId = Auth::id();
        $contactId = $user->id;

        $text = $request->validate([
            'text' => ['required']
        ]);

        $data = array_merge($text,['sender_id' => $userId], ['receiver_id' => $contactId]);

        $message = Message::create($data)->fresh();
        $message->load('sender','receiver');

        broadcast(new SendMessage($message));

        return MessageResouce::make($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    public function  messageUser(Request $request, User $user)
    {
        $userId = Auth::id();
        $contactId = $user->id;

        $messages = Message::query()
            ->with('receiver','sender')
            // get chat of user and contact
            ->where(function ($query) use($userId, $contactId){
                // where the authenticated user and the contact user
                    $query->where('sender_id', $userId)
                    ->where('receiver_id', $contactId);
                })
            // or  the contact user and authenticated user
            ->orWhere(function ($query) use($userId, $contactId){
                $query->where('sender_id', $contactId)
                    ->where('receiver_id', $userId);
            })
            ->orderBy('id')
            ->get();


        return new MessageCollection($messages);
    }
}
