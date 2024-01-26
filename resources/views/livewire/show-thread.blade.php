<div class="max-w-4xl mx-auto px-4 sm:px6 lg:px-8 py-12">

    <div class="rounded-md bg-gradient-to-r from-slate-800 to slate-900 mb-4">
        <div class="p-4 flex gap-4">
            <div>
                {{-- Se trabaja con la pregunta, que pertenece a un usuario y a este se le aplica el método avatar() --}}
                <img src="{{ $thread->user->avatar() }}" alt="{{ $thread->user->name }}" class="rounded-md">
            </div>
            <div class="w-full">
                <h2 class="mb-4 flex items-start justify-between">
                    <a href="{{ route('thread', $thread) }}" class="text-xl font-semibold text-white/90">
                        {{ $thread->title }}
                    </a>
                    <span class="rounded-full text-xs py-2 px-4 capitalize" style="color:{{ $thread->category->color }}; border:1px solid {{ $thread->category->color }}">
                        {{ $thread->category->name }}
                    </span>
                </h2>
                <p class="mb-4 text-blue-600 font-semibold text-xs">
                    {{ $thread->user->name }}
                    {{-- Nótese los métodos que se pueden aplicar en la vista --}}
                    <span class="text-white/90">{{ $thread->created_at->diffForHumans(); }}</span>
                </p>
                <p class="text-white/60">
                    {{ $thread->body }}
                </p>
            </div>
        </div>
    </div>

    {{-- respuestas --}}
    {{-- Cómo de aquí es llamado otro componente --}}
    @foreach ($replies as $reply)
        @livewire('show-reply', ['reply' => $reply], key('reply-'.$reply->id))
    @endforeach

    {{-- formulario --}}
    <form wire:submit.prevent="postReply">
        <input type="text" placeholder="Escribe una respuesta"
            class="bg-slate-800 border-0 rounded-md w-full p-3 text-white/60 text-xs"
            wire:model="body"
        >
    </form>

    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
</div>
