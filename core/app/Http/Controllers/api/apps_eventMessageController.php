<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\eventPushNotification;
use App\Model\chat_handler;
use App\Model\chat_deleted;
use App\Model\chat_message;
use App\Model\chat_room;
use App\User;
use DB;

class apps_eventMessageController extends Controller
{
    private $notify;

    public function __construct()
    {
        //defining our middleware for this controller
        $this->notify = new eventPushNotification();
        
    }

    function fetch_chat_room(Request $request){

        $user_id = $request->input('user_id');
        $chat_room = chat_handler::with('chatroom', 'chatroom.last_message')->where('user_id', $user_id)->get();

        if(count($chat_room) > 0)
            return $chat_room;
        else 
        	return "empty";
    }

    function fetch_selected_chat(Request $request) {

        $chat_room_id = $request->input('chat_room_id');
        $user_id = $request->input('user_id');
        $selected_user_id = $request->input('selected_user_id');
        $found = false;

        if(empty($chat_room_id)){
            $indexed_result = DB::select("SELECT room_id, GROUP_CONCAT(user_id SEPARATOR '-') as rooms FROM `event_chat_handler` GROUP BY room_id");

            $combined_forward = $user_id . '-' . $selected_user_id;
            $combined_backward = $selected_user_id . '-' . $user_id;

            if(count($indexed_result) > 0){

                foreach ($indexed_result as $key => $value) {
                    if($combined_forward == $value->rooms || $combined_backward == $value->rooms){
                        $chat_room_id = $value->room_id;
                        $found = true;
                        break;
                    }
                }
                
            }
        } else{

            $found = true;

        }

        if($found){

            return $this->fetch_message($chat_room_id, $user_id);

        } else {
            $chat_room_id = $this->create_chat_room($request->input('selected_user_id'),$request->input('user_id'));
            return $this->fetch_message($chat_room_id, $user_id);
        }

        
    }

    private function fetch_message($chat_room_id, $user_id){

        $deleted_msg = chat_deleted::where('user_id', $user_id)->pluck('msg_id');

        if(chat_handler::where('user_id', $user_id)->where('room_id', $chat_room_id)->exists())
                $message = chat_message::with('user')->where('chat_room_id', $chat_room_id)->whereNotIn('id', $deleted_msg)->get();
        else $message = null;

        $this->touch_chat_rooms($user_id, $chat_room_id);

        if(count($message) > 0)
            return json_encode(['status' => 'success', 'data' => $message, 'chat_room_id' => $chat_room_id]);
        else 
            return json_encode(['status' => 'empty', 'chat_room_id' => $chat_room_id]);

    }

    private function create_chat_room($selected_user_id, $user_id){

        $room = new chat_room();
        $room->name = 'Testing';
        $room->member_count = 2;
        $room->save();

        $chat_handler = new chat_handler();
        $chat_handler->room_id = $room->id;
        $chat_handler->user_id = $user_id;
        $chat_handler->room_name = $this->get_user_name($selected_user_id);
        $chat_handler->save();

        $chat_handler = new chat_handler();
        $chat_handler->room_id = $room->id;
        $chat_handler->user_id = $selected_user_id;
        $chat_handler->room_name = $this->get_user_name($user_id);
        $chat_handler->save();

        return $room->id;

    }

    function get_user_name($id){
        $user = User::find($id);
        return $user->name;
    }

    function send_message(Request $request){

        $user_id = $request->input('user_id');
        $room_id = $request->input('chat_room_id');
        $message = $request->input('message');

        $newMessage = new chat_message();
        $newMessage->chat_room_id = $room_id;
        $newMessage->user_id = $user_id;
        $newMessage->message = $message;
        $newMessage->save();
        
        $room = chat_room::find($room_id);

        $info = array();
        $info['chat_room'] = chat_handler::with('chatroom', 'chatroom.last_message')->where('user_id', $user_id)->get();
        $info['message'] = chat_message::with('user', 'room')->where('chat_room_id', $room_id)->orderBy('created_at', 'desc')->first();
        $info['category'] = 'chat';

        $user_ids = chat_handler::where('room_id', $room_id)->get();
        $this->touch_chat_rooms($user_id, $room_id);

        foreach ($user_ids as $data) {

            if($data['user_id'] != $user_id){
                
                $content = 'New Message in '. $room->name;

                $info['action_type'] = 'message';
                $info['room_id'] = $room_id;

                $this->notify->send_to_specific($content,$data['user_id'],$info);
            }

        }

        return compact('info');

    }

    public function touch_chat_room(Request $request){
        $user_id = $request->input('user_id');
        $room_id = $request->input('chat_room_id');
        $this->touch_chat_rooms($user_id, $room_id);
    }

    function touch_chat_rooms($user_id, $room_id){

        $id = chat_handler::where('user_id', $user_id)->where('room_id', $room_id);
        $touch = chat_handler::find($id->value('id'));
        $touch->touch();

    }

}
