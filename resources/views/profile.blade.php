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

        <div class="bg-white p-6 rounded shadow mt-6">
            <h2 class="text-xl font-semibold mb-4">Histórico de Doações</h2>
            @if($user->donations()->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2 px-4">Data</th>
                                <th class="text-left py-2 px-4">Valor</th>
                                <th class="text-left py-2 px-4">Moeda</th>
                                <th class="text-left py-2 px-4">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->donations()->orderByDesc('created_at')->get() as $donation)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4">
                                        {{ $donation->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="py-3 px-4 font-semibold">
                                        {{ number_format($donation->amount / 100, 2, ',', '.') }}
                                    </td>
                                    <td class="py-3 px-4">
                                        {{ strtoupper($donation->currency) }}
                                    </td>
                                    <td class="py-3 px-4">
                                        @if($donation->status === 'completed')
                                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded text-sm">
                                                Concluída
                                            </span>
                                        @elseif($donation->status === 'pending')
                                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded text-sm">
                                                Pendente
                                            </span>
                                        @else
                                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded text-sm">
                                                {{ $donation->status }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6 pt-4 border-t">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total doado:</span>
                        <span class="text-2xl font-bold text-green-600">
                            €{{ number_format($user->donations()->sum('amount') / 100, 2) }}
                        </span>
                    </div>
                </div>
            @else
                <p class="text-gray-600">Ainda não fizeste nenhuma doação.</p>
            @endif
        </div>
    </div>
</x-app-layout>