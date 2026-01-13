<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <a href="{{ route('success_stories.index') }}" class="text-blue-600 hover:text-blue-700 mb-4 inline-block">← Voltar</a>

        <div class="rounded-lg shadow-md overflow-hidden bg-white border border-gray-200">
            @if($story->photo)
                <div class="w-full h-96 overflow-hidden bg-gray-100">
                    <img src="{{ asset('storage/' . $story->photo) }}" alt="{{ $story->title }}" class="w-full h-full object-cover">
                </div>
            @endif
            
            <div class="p-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $story->title }}</h1>
                
                @if($story->animal)
                    <p class="text-lg text-blue-600 font-semibold mb-4">
                        🐾 Animal: <a href="{{ route('animals.show', $story->animal) }}" class="hover:text-blue-700">{{ $story->animal->name }}</a>
                    </p>
                @endif

                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                    <span class="text-sm text-gray-500">Publicado em {{ $story->created_at->format('d/m/Y') }}</span>
                    @if($story->user)
                        <span class="text-sm text-gray-600">Por {{ $story->user->name }}</span>
                    @endif
                </div>

                <div class="text-lg text-gray-700 leading-relaxed whitespace-pre-wrap mb-8">
                    {{ $story->content }}
                </div>

                @auth
                    @if(Auth::user()->role === 'admin')
                        <div class="flex gap-3 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.stories.edit', $story) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Editar
                            </a>
                            <form method="POST" action="{{ route('admin.stories.destroy', $story) }}" onsubmit="return confirm('Tem a certeza que quer eliminar esta história?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>
