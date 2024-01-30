<?php

namespace App\Livewire;

use App\Models\Reply;
use Livewire\Component;

class ShowReply extends Component
{
    public Reply $reply;
    public $body = '';
    public $is_creating = false;

    public function postReplyChild()
    {
        if ( ! is_null($this->reply->reply_id) ) return;

        // validate
        $this->validate(['body' => 'required']);

        // create
        auth()->user()->replies()->create([
            'reply_id' => $this->reply->id,
            'thread_id' => $this->reply->thread->id,
            'body' => $this->body
        ]);

        // refresh
        $this->is_creating = false;
        $this->body = '';
    }

    public function render()
    {
        return view('livewire.show-reply');
    }
}
