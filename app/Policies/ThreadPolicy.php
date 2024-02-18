<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;

class ThreadPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // Con esto controlamos el acceso de nuestros usuarios a las preguntas
    public function update(User $user, Thread $thread)
    {
        return $user->id === $thread->user_id; // Esto debería devolver true o false
    }
}
