<x-app-layout>
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Animais para adoção</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @forelse($animals as $animal)
                <a href="{{ route('animals.show', $animal) }}" class="border rounded-lg p-4 hover:bg-gray-50">
                    <h2 class="font-semibold text-lg">{{ $animal->name }}</h2>
                    <p class="text-sm text-gray-600">{{ $animal->species }} • {{ $animal->breed ?? 'Sem raça' }}</p>
                    <p class="text-sm mt-2">{{ \Illuminate\Support\Str::limit($animal->description, 80) }}</p>
                </a>
            @empty
                <p>Sem animais disponíveis.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>