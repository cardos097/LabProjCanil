<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Histórias de Sucesso</h1>

        @forelse($stories as $story)
            <div class="mb-6 border-b pb-4">
                <h2 class="text-xl font-semibold">{{ $story->title }}</h2>

                @if($story->animal)
                    <p class="text-sm text-gray-600 mb-1">
                        Animal: {{ $story->animal->name }}
                    </p>
                @endif

                @if($story->photo)
                    <img src="{{ asset('storage/' . $story->photo) }}" class="my-2 rounded max-h-64">
                @endif

                <p>{{ $story->content }}</p>
            </div>
        @empty
            <p>Sem histórias publicadas.</p>
        @endforelse
    </div>
</x-app-layout>
