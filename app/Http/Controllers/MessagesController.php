<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getLoadLatestMessages(Request $request)
    {
        if (!$request->user_id) {
            return;
        }
        $messages = Message::where(function ($query) use ($request) {
            $query->where('from_user', Auth::user()->id)->where('to_user', $request->user_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('from_user', $request->user_id)->where('to_user', Auth::user()->id);
        })->orderBy('created_at', 'DESC')->limit(10)->get();
        $return = [];
        foreach ($messages->reverse() as $message) {
            $return[] = view('message-line')->with('message', $message)->render();
        }
        return response()->json(['state' => 1, 'messages' => $return]);
    }

    /**
     * postSendMessage
     *
     * @param Request $request
     */
    public function postSendMessage(Request $request)
    {
        if (!$request->to_user || !$request->message) {
            return;
        }

        $message = new Message();

        $message->from_user = Auth::user()->id;

        $message->to_user = $request->to_user;

        if ($request->message != '' && $request->message != null && $request->message != 'null') {

            $message->content = $request->message;
        }

        if (isset($request['image']) && $request->hasFile("image")) {
            $file = $request->file('image');
            $filename = md5(uniqid()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $message->image = $filename;
        }

        if (isset($request['video']) && $request->hasFile("video")) {
            $file = $request->file('video');
            $filename = md5(uniqid()) . "." . $file->getClientOriginalExtension();
            $file->move(public_path('videos'), $filename);
            $message->video = $filename;
        }

        $message->save();


        // prepare the message object along with the relations to send with the response
        $message = Message::with(['fromUser', 'toUser'])->find($message->id);

        // fire the event
        \event(new MessageSent($message));

        return response()->json(['state' => 1, 'message' => $message]);
    }

    public function getOldMessages(Request $request)
    {
        if (!$request->old_message_id || !$request->to_user)
            return;

        $message = Message::find($request->old_message_id);

        $previousMessages = $this->getPreviousMessages($request, $message);

        $return = [];

        $noMoreMessages = true;

        if ($previousMessages->count() > 0) {

            foreach ($previousMessages as $message) {

                $return[] = view('message-line')->with('message', $message)->render();
            }

            $noMoreMessages = !($this->getPreviousMessages($request, $previousMessages[$previousMessages->count() - 1])->count() > 0);
        }

        return response()->json(['state' => 1, 'messages' => $return, 'no_more_messages' => $noMoreMessages]);
    }

    private function getPreviousMessages(Request $request, $message)
    {
        $previousMessages = Message::where(function ($query) use ($request, $message) {
            $query->where('from_user', Auth::user()->id)
                ->where('to_user', $request->to_user)
                ->where('created_at', '<', $message->created_at);
        })
            ->orWhere(function ($query) use ($request, $message) {
                $query->where('from_user', $request->to_user)
                    ->where('to_user', Auth::user()->id)
                    ->where('created_at', '<', $message->created_at);
            })
            ->orderBy('created_at', 'DESC')->limit(10)->get();

        return $previousMessages;
    }
}
