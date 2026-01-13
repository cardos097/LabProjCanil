<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">💰 Histórico de Doações</h1>
            <p class="text-gray-600">Todos os registos de doações recebidas</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
            @if($donations->isEmpty())
                <div class="p-8 text-center">
                    <p class="text-gray-600 text-lg">Nenhuma doação registada ainda.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Utilizador</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Email</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Montante</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Status</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donations as $donation)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        @if($donation->user)
                                            {{ $donation->user->name }}
                                        @else
                                            <span class="text-gray-500">Anónimo</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        @if($donation->user)
                                            {{ $donation->user->email }}
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-green-600">
                                        €{{ number_format($donation->amount / 100, 2) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        @if($donation->status === 'completed' || $donation->status === 'paid')
                                            <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                                ✓ Concluída
                                            </span>
                                        @elseif($donation->status === 'pending')
                                            <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">
                                                ⏳ Pendente
                                            </span>
                                        @elseif($donation->status === 'failed')
                                            <span class="inline-block px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                                                ✗ Falhou
                                            </span>
                                        @else
                                            <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">
                                                {{ ucfirst($donation->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $donation->created_at->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $donations->links() }}
                </div>
            @endif
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-6 border border-green-200">
                <div class="text-sm text-gray-600 mb-2">Total Concluído</div>
                <div class="text-3xl font-bold text-green-600">
                    €{{ number_format($donations->where('status', 'completed')->sum('amount') / 100 + $donations->where('status', 'paid')->sum('amount') / 100, 2) }}
                </div>
            </div>

            <div class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-lg p-6 border border-yellow-200">
                <div class="text-sm text-gray-600 mb-2">Doações Pendentes</div>
                <div class="text-3xl font-bold text-yellow-600">
                    {{ $donations->where('status', 'pending')->count() }}
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg p-6 border border-blue-200">
                <div class="text-sm text-gray-600 mb-2">Total de Doações</div>
                <div class="text-3xl font-bold text-blue-600">
                    {{ $donations->count() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
