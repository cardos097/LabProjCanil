<!-- resources/views/admin/stories/show.blade.php -->

<x-app-layout>
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Detalhes da História de Sucesso</h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <h2 class="text-xl font-semibold">{{ $story->title }}</h2>
                <p class="text-sm text-gray-600">{{ \Illuminate\Support\Str::limit($story->content, 100) }}</p>
            </div>

            @if($story->photo)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $story->photo) }}" alt="Imagem da História"
                        class="w-full max-w-md mx-auto">
                </div>
            @endif

            <div class="mb-4">
                <strong>Animal:</strong> {{ $story->animal->name ?? 'Não especificado' }}
            </div>

            <div class="mb-4">
                <strong>Publicado:</strong> {{ $story->published ? 'Sim' : 'Não' }}
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.stories.edit', $story) }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded">Editar</a>
                <form method="POST" action="{{ route('admin.stories.destroy', $story) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>