<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function edit(Thread $thread)
    {
        $this->authorize('update', $thread);
        
        $categories = Category::get();

        return view('thread.edit', compact('categories', 'thread'));
    }

    // Actualizar qué? lo que se envíe en $request, qué cosa? la pregunta
    public function update(Request $request, Thread $thread)
    {
        // Llamamos a la política de autorización creada en App \ Policies \ ThreadPolicy.php
        $this->authorize('update', $thread);

        // Primero validar
        $request->validate([
            'category_id'  => 'required',
            'title'        => 'required',
            'body'         => 'required'
        ]);

        $thread->update($request->all());

        return redirect()->route('thread', $thread);
    }

    public function create(Thread $thread)
    {
        $categories = Category::get();

        return view('thread.create', compact('categories', 'thread'));
    }

    public function store(Request $request)
    {
        // Primero validar
        $request->validate([
            'category_id'  => 'required',
            'title'        => 'required',
            'body'         => 'required'
        ]);

        // Creación a partir del usuario logueado
        auth()->user()->threads()->create($request->all());

        return redirect()->route('dashboard');
    }
}
