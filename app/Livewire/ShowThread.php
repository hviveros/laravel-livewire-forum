<?php

namespace App\Livewire;

use App\Models\Thread;
use Livewire\Component;

class ShowThread extends Component
{
    
    public Thread $thread;
    public $body = '';

    public function postReply()
    {
        // validate
        $this->validate(['body' => 'required']);

        // create
        auth()->user()->replies()->create([
            'thread_id' => $this->thread->id,
            'body' => $this->body
        ]);

        // refresh
        $this->body = '';
    }

    // Aquí se hizo fue consultar a las respuestas de esta pregunta
    public function render()
    {
        return view('livewire.show-thread', [
            'replies' => $this->thread->replies()->get()
        ]);
    }
}
