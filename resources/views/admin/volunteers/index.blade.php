<x-app-layout>
    <div class="max-w-6xl mx-auto p-4">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">Voluntários</h1>
            <a href="{{ route('admin.index') }}" class="underline text-sm">Voltar ao Admin</a>
        </div>

        <div class="overflow-x-auto bg-white border rounded">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left p-3">Utilizador</th>
                        <th class="text-left p-3">Disponibilidade</th>
                        <th class="text-left p-3">Habilidades</th>
                        <th class="text-left p-3">Estado</th>
                        <th class="text-left p-3">Data</th>
                        <th class="text-right p-3">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($volunteers as $volunteer)
                        <tr class="border-t">
                            <td class="p-3 font-medium">{{ $volunteer->user->name ?? '—' }}</td>
                            <td class="p-3">{{ $volunteer->availability ?? '—' }}</td>
                            <td class="p-3">{{ $volunteer->skills ?? '—' }}</td>
                            <td class="p-3">{{ $volunteer->status }}</td>
                            <td class="p-3">{{ $volunteer->created_at?->format('Y-m-d H:i') }}</td>

                            <td class="p-3 text-right">
                                @if($volunteer->status === 'pending')
                                    <form method="POST" action="{{ route('admin.volunteers.approve', $volunteer) }}"
                                        class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button
                                            class="bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white px-3 py-1 rounded">Aprovar</button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.volunteers.reject', $volunteer) }}"
                                        class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="bg-red-600 text-white px-3 py-1 rounded">Rejeitar</button>
                                    </form>
                                @else
                                    <span class="text-gray-500">Sem ações</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-3">Sem pedidos de voluntariado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $volunteers->links() }}
        </div>
    </div>
</x-app-layout>