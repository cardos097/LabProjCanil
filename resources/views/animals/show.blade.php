<x-app-layout>
    <div class="max-w-3xl mx-auto p-4">
        <h1 class="text-2xl font-bold">{{ $animal->name }}</h1>
        <p class="text-gray-600 mb-4">
            {{ $animal->species }} • {{ $animal->breed ?? 'Sem raça' }}
        </p>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-3 rounded bg-red-100">
                {{ session('error') }}
            </div>
        @endif

        <p class="mb-6">{{ $animal->description }}</p>

        {{-- ===================== ADOTAR ===================== --}}
        <div class="mb-8 border rounded p-4">
            <h2 class="text-lg font-semibold mb-2">Pedir adoção</h2>

            @auth
                @if($animal->status === 'available' && !$animal->adoption)
                    <form method="POST" action="{{ route('adoptions.store', $animal) }}" class="space-y-2">
                        @csrf

                        <div>
                            <label class="block font-medium">Mensagem (opcional)</label>
                            <textarea name="notes" class="w-full border rounded p-2" rows="3"
                                placeholder="Ex: Tenho espaço, experiência com animais, rotina, etc...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                            Submeter pedido de adoção
                        </button>
                    </form>
                @elseif($animal->status === 'adopted')
                    <div class="p-3 rounded bg-yellow-100">
                        Este animal já foi adotado.
                    </div>
                @else
                    <div class="p-3 rounded bg-yellow-100">
                        Já existe um pedido de adoção pendente para este animal.
                    </div>
                @endif
            @else
                <div class="p-3 rounded bg-gray-100">
                    <a class="underline" href="{{ route('login') }}">Faz login</a> para pedir adoção.
                </div>
            @endauth
        </div>

        {{-- ===================== COMENTÁRIOS ===================== --}}
        <div class="border rounded p-4">
            <h2 class="text-xl font-semibold mb-2">Comentários</h2>

            @auth
                <form method="POST" action="{{ route('comments.store', $animal) }}" class="mb-4 space-y-2">
                    @csrf

                    <div>
                        <label class="block font-medium">Comentário</label>
                        <textarea name="content" required class="w-full border rounded p-2" rows="3"
                            placeholder="Escreve o teu comentário...">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium">Rating (opcional)</label>
                        <input type="number" name="rating" min="1" max="5" class="border rounded p-2 w-24" placeholder="1-5"
                            value="{{ old('rating') }}">
                        @error('rating')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                        Submeter comentário
                    </button>
                </form>
            @else
                <p class="mb-4 text-gray-600">
                    <a class="underline" href="{{ route('login') }}">Faz login</a> para comentar.
                </p>
            @endauth

            <div class="space-y-3">
                @forelse($animal->comments as $comment)
                    <div class="border rounded p-3">
                        <div class="text-sm text-gray-600">
                            {{ $comment->user->name ?? 'Utilizador' }}
                            @if($comment->rating)
                                • ⭐ {{ $comment->rating }}/5
                            @endif
                            • {{ $comment->created_at->diffForHumans() }}
                        </div>

                        <p class="mt-1">{{ $comment->content }}</p>

                        @auth
                            @if(auth()->id() === $comment->user_id || auth()->user()->role === 'admin')
                                <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 text-sm">Apagar</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                @empty
                    <p>Sem comentários.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>