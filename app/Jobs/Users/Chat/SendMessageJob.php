<?php

namespace App\Jobs\Users\Chat;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Chat\Chat_room;
use App\Models\Chat\Chat_message;

class SendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $validator;

    public function __construct($validator)
    {
        $this->validator = $validator;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $chat_room = Chat_room::find($this->validator['room_id']);
        $this->validator['to_id'] = $chat_room->child_id;

        $message = Chat_message::create($this->validator);

        $chat_room->last_message_id = $message->id;
        if($this->validator['from_id'] == $chat_room->unread_parent_count) {
            $chat_room->unread_child_count = $chat_room->unread_child_count+1;
            $chat_room->unread_parent_count = 0;
        }else{
            $chat_room->unread_parent_count = $chat_room->unread_parent_count+1;
            $chat_room->unread_child_count = 0;
        }

        $chat_room->save();

    }
}
