<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Comentários e Avaliações</h1>

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

        @auth
            <div class="mb-8 border rounded p-4 bg-gray-50">
                <h2 class="text-xl font-semibold mb-4">Deixar um Comentário</h2>

                <form method="POST" action="{{ route('comments.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block font-medium mb-1">Animal *</label>
                        <select name="animal_id" class="w-full border rounded p-2" required>
                            <option value="">Selecionar um animal...</option>
                            @foreach($animals as $animal)
                                <option value="{{ $animal->id }}" @selected(old('animal_id') == $animal->id)>
                                    {{ $animal->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('animal_id')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Comentário *</label>
                        <textarea name="content" required class="w-full border rounded p-2" rows="4"
                            placeholder="Partilha a tua opinião...">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Avaliação (opcional)</label>
                        <div class="flex gap-3">
                            @for($i = 1; $i <= 5; $i++)
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }} class="mr-2">
                                    <span class="text-lg font-semibold px-3 py-1 border rounded hover:bg-gray-200">{{ $i }}</span>
                                </label>
                            @endfor
                        </div>
                        @error('rating')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                        Submeter Comentário
                    </button>
                </form>
            </div>
        @else
            <div class="mb-8 p-4 rounded bg-gray-100">
                <a class="text-blue-600 hover:underline" href="{{ route('login') }}">Faz login</a> para deixar um comentário.
            </div>
        @endauth

        <div class="space-y-4">
            <h2 class="text-2xl font-semibold">Comentários Recentes</h2>

            @forelse($comments as $comment)
                <div class="border rounded p-4 bg-white">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="font-semibold">{{ $comment->user->name ?? 'Utilizador' }}</p>
                            @if($comment->animal)
                                <p class="text-sm text-gray-600">sobre <strong>{{ $comment->animal->name }}</strong></p>
                            @endif
                        </div>
                        <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>

                    @if($comment->rating)
                        <div class="mb-2 inline-block bg-yellow-100 px-3 py-1 rounded">
                            <span class="font-semibold text-lg">{{ $comment->rating }}/5</span>
                        </div>
                    @endif

                    <p class="text-gray-700 mb-3">{{ $comment->content }}</p>

                    @auth
                        @if(auth()->id() === $comment->user_id || auth()->user()->role === 'admin')
                            <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 text-sm hover:underline">Apagar</button>
                            </form>
                        @endif
                    @endauth
                </div>
            @empty
                <p class="text-gray-600">Sem comentários ainda. Sê o primeiro a deixar um!</p>
            @endforelse

            @if($comments->hasPages())
                <div class="mt-6">
                    {{ $comments->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
