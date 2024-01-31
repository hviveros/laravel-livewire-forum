<div>
    <div class="rounded-md bg-gradient-to-r from-slate-800 to slate-900 hover:to-slate-800 mb-4">
        <div class="p-4 flex gap-4">
            <div>
                {{-- Se trabaja con la pregunta, que pertenece a un usuario y a este se le aplica el método avatar() --}}
                <img src="{{ $reply->user->avatar() }}" alt="{{ $reply->user->name }}" class="rounded-md">
            </div>
            <div class="w-full">
                <p class="mb-2 text-blue-600 font-semibold text-xs">
                    {{ $reply->user->name }}
                </p>

                {{-- formularios --}}
                @if ($is_editing)                    
                    {{-- Si la variable $is_editing está en true, aparezca el formulario y no muestre la respuesta --}}
                    <form wire:submit.prevent="updateReply" class="mt-4">
                        <input type="text" placeholder="Escribe una respuesta"
                        class="bg-slate-800 border-1 border-slate-900 rounded-md w-full p-3 text-white/60 text-xs"
                        wire:model="body"
                        >
                    </form>
                @else
                    {{-- Si no se está editando, debería mostrar la respuesta --}}
                    <p class="text-white/60 text-xs">{{ $reply->body }}</p>
                @endif

                @if ($is_creating)                    
                    {{-- Si la variable $is_creating está en true, aparezca el formulario --}}
                    <form wire:submit.prevent="postReplyChild" class="mt-4">
                        <input type="text" placeholder="Escribe una respuesta"
                        class="bg-slate-800 border-1 border-slate-900 rounded-md w-full p-3 text-white/60 text-xs"
                        wire:model="body"
                        >
                    </form>
                @endif

                <p class="mt-4 text-white/60 text-xs gap-2 justify-end">
                    @if (is_null($reply->reply_id))
                    {{-- Cuando se haga clic, no recargar la página (prevent), y trabajar con la variable is_creating en $toggle --}}
                    <a href="#" wire:click.prevent="$toggle('is_creating')" class="hover:text-white">Responder</a>
                    @endif
                    <a href="#" wire:click.prevent="$toggle('is_editing')" class="hover:text-white">Editar</a>
                </p>
            </div>
        </div>
    </div>

    {{-- Respuestas hijas --}}
    {{-- Cómo de aquí es llamado otro componente --}}
    @foreach ($reply->replies as $item)
        <div class="ml-8">
            @livewire('show-reply', ['reply' => $item], key('reply-'.$item->id))
        </div>
    @endforeach
</div>

{{-- Do your work, then step back. --}}
