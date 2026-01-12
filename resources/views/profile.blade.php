<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Meu Perfil</h1>

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-2">Informações Pessoais</h2>
            <p><strong>Nome:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Função:</strong> {{ $user->role }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow mt-6">
            <h2 class="text-xl font-semibold mb-4">Animais Adotados</h2>
            @if($adoptedAnimals->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($adoptedAnimals as $animal)
                        <div class="border rounded p-4">
                            @if($animal->photo)
                                <img src="{{ asset('storage/' . $animal->photo) }}" alt="{{ $animal->name }}" class="w-full h-32 object-cover rounded mb-2">
                            @endif
                            <h3 class="font-bold">{{ $animal->name }}</h3>
                            <p>{{ $animal->species }} - {{ $animal->breed }}</p>
                            <p class="text-sm text-gray-600">Adotado em: {{ $animal->adopted_at ? $animal->adopted_at->format('d/m/Y') : 'Data não disponível' }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p>Você ainda não adotou nenhum animal.</p>
            @endif
        </div>
    </div>
</x-app-layout>