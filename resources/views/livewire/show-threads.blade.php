<div class="max-w-7xl mx-auto px-4 sm:px6 lg:px-8 flex gap-10 py-12">

    <div class="w-64">
        <a href="{{ route('threads.create') }}" class="block w-full py-4 mb-10 bg-gradient-to-r from-blue-600 to-blue-700 hover:to-blue-600 text-white/90 font-bold text-xs text-center rounded-md">Preguntar</a>
        <ul>
            @foreach($categories as $category)
            <li class="mb-2">
                <a href="#" wire:click.prevent="filterByCategory('{{ $category->id }}')" class="p-2 rounded flex bg-slate-800 items-center gap-2 text-white/60 hover:text-white font-semibold text-xs capitalize">
                    <span class="w-2 h-2 rounded-full" style="background-color: {{ $category->color }}"></span>
                    {{ $category->name }}
                </a>
            </li>
            @endforeach

            <li class="mb-2">
                <a href="#" wire:click.prevent="filterByCategory('')" class="p-2 rounded flex bg-slate-800 items-center gap-2 text-white/60 hover:text-white font-semibold text-xs capitalize">
                    <span class="w-2 h-2 rounded-full" style="background-color: #000"></span>
                    Todos los resultados
                </a>
            </li>
        </ul>
    </div>
    <div class="w-full">
        {{-- formulario --}}
        <form class="mb-4">
            <input type="text" placeholder="// ..."
                class="bg-slate-800 border-0 rounded-md w-1/3 p-3 text-white/60 text-xs"
                wire:model.live="search"
            >
        </form>

        @foreach($threads as $thread)
        <div class="rounded-md bg-gradient-to-r from-slate-800 to slate-900 hover:to-slate-800 mb-4">
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
                    <p class="flex items-center justify-between w-full text-xs">
                        <span class="text-blue-600 font-semibold">
                            {{ $thread->user->name }}
                            {{-- Nótese los métodos que se pueden aplicar en la vista --}}
                            <span class="text-white/90">{{ $thread->created_at->diffForHumans(); }}</span>
                        </span>
                        <span class="text-slate-700 flex items-center gap-1">
                            
                            <svg data-slot="icon" class="h-4" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"></path>
                              </svg>

                            {{ $thread->replies_count; }}
                            {{-- Hacemos una operación ternaria para ver si colocamos 's' al final de la palabra 'Respuesta' --}}
                            Respuesta{{ $thread->replies_count !== 1 ? 's' : '' }}
                            
                            {{-- Política de Autorización --}}
                            @can('update', $thread)
                            |
                                <a href="{{ route('threads.edit', $thread) }}" class="hover:text-white/90">Editar</a>
                            @endcan
                        </span>
                    </p>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

</div>
