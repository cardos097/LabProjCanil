<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Histórico de Doações') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Vê o histórico de todas as doações que fizeste ao canil.') }}
        </p>
    </header>

    <div class="mt-6">
        @if(isset($donations) && $donations->count() > 0)
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
                        @foreach($donations as $donation)
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
                        €{{ number_format($donations->sum('amount') / 100, 2) }}
                    </span>
                </div>
            </div>
        @else
            <div class="p-4 bg-gray-50 rounded text-center text-gray-600">
                {{ __('Ainda não fizeste nenhuma doação.') }}
            </div>
        @endif
    </div>
</section>
