<x-app-layout>
    <div class="max-w-6xl mx-auto p-4">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">🐾 Animais para Adoção</h1>
            <p class="text-gray-600">Encontra o teu novo companheiro e muda a sua vida</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($animals as $animal)
                <a href="{{ route('animals.show', $animal) }}" class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-2xl transition-all duration-300 bg-white border border-gray-200 hover:border-blue-300">
                    <div class="relative h-48 overflow-hidden bg-gray-100">
                        @if($animal->photo)
                            <img src="{{ asset('storage/' . $animal->photo) }}" alt="{{ $animal->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-4xl">🐕</div>
                        @endif
                        <div class="absolute top-3 right-3 bg-{{ $animal->status === 'Disponível' ? 'green' : 'red' }}-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            {{ $animal->status }}
                        </div>
                    </div>
                    <div class="p-4">
                        <h2 class="font-bold text-lg text-gray-900 mb-1">{{ $animal->name }}</h2>
                        <p class="text-sm text-gray-600 mb-3">{{ $animal->species }} • {{ $animal->breed ?? 'Sem raça' }}</p>
                        
                        <div class="flex gap-2 mb-3 text-xs text-gray-600">
                            <span class="bg-gray-100 px-2 py-1 rounded">♂️ {{ $animal->gender }}</span>
                            <span class="bg-gray-100 px-2 py-1 rounded">📅 {{ $animal->age }} anos</span>
                        </div>
                        
                        <p class="text-sm text-gray-700 leading-relaxed">{{ \Illuminate\Support\Str::limit($animal->description, 100) }}</p>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 to-indigo-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-600 text-lg">Sem animais disponíveis no momento.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
