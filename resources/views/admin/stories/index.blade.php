<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Histórias de Sucesso</h1>

        <!-- Botão para adicionar nova história -->
        <a href="{{ route('admin.stories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Adicionar Nova História
        </a>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($stories as $story)
                <div class="border rounded p-4">
                    <h2 class="font-semibold text-lg">{{ $story->title }}</h2>
                    <p class="text-sm text-gray-600">{{ \Illuminate\Support\Str::limit($story->content, 80) }}</p>
                    <div class="mt-2">
                        <a href="{{ route('admin.stories.show', $story) }}" class="text-blue-600">Ver Detalhes</a>
                    </div>
                </div>
            @empty
                <p>Não há histórias de sucesso para exibir.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
