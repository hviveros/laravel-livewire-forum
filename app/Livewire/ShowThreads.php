<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Thread;
use Livewire\Component;

class ShowThreads extends Component
{
    public $search = '';

    public function render()
    {
        
        $categories = Category::get();
        // Después de relacionar las Respuestas x Preguntas
        // Traerlas en la consulta, con un método propio de Laravel withCount
        // Básicamente: haz una consulta de todas las preguntas CONTANDO cuántas respuestas tengo

        // Con el buscador, se debe segmentar la consulta, se trabaja con query() y a partir de allí se realizan las configuraciones y condiciones
        $threads = Thread::query();
        $threads->where('title', 'like', "%$this->search%");
        $threads->withCount('replies');
        $threads->latest();

        return view('livewire.show-threads', [
            'categories' => $categories,
            'threads' => $threads->get(),
        ]);
    }
}
