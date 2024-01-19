<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Thread;
use Livewire\Component;

class ShowThreads extends Component
{
    public $search = '';
    public $category = '';

    // Una función propia que se activará con un clic
    public function filterByCategory($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        
        $categories = Category::get();
        // Después de relacionar las Respuestas x Preguntas
        // Traerlas en la consulta, con un método propio de Laravel withCount
        // Básicamente: haz una consulta de todas las preguntas CONTANDO cuántas respuestas tengo

        // Con el buscador, se debe segmentar la consulta, se trabaja con query() y a partir de allí se realizan las configuraciones y condiciones
        $threads = Thread::query();
        $threads->where('title', 'like', "%$this->search%");

        // Filtrado por categorías
        // Si hay algo en la variable $category, se alterará la consulta $threads
        // sería agregar un nuevo where a la consulta
        if ($this->category) {
            $threads->where('category_id', $this->category);
        }

        $threads->withCount('replies');
        $threads->latest();

        return view('livewire.show-threads', [
            'categories' => $categories,
            'threads' => $threads->get(),
        ]);
    }
}
