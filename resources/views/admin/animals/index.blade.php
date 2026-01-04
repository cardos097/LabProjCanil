<x-app-layout>
    <div class="max-w-6xl mx-auto p-4">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">Animais</h1>
            <a href="{{ route('admin.animals.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Adicionar
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white border rounded">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left p-3">Nome</th>
                        <th class="text-left p-3">Espécie</th>
                        <th class="text-left p-3">Status</th>
                        <th class="text-right p-3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($animals as $animal)
                        <tr class="border-t">
                            <td class="p-3 font-medium">{{ $animal->name }}</td>
                            <td class="p-3">{{ $animal->species }}</td>
                            <td class="p-3">
                                <span
                                    class="px-2 py-1 rounded text-xs {{ $animal->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $animal->status }}
                                </span>
                            </td>
                            <td class="p-3 text-right space-x-2">
                                <a href="{{ route('admin.animals.edit', $animal) }}"
                                    class="text-blue-600 hover:underline">Editar</a>

                                <form class="inline" method="POST" action="{{ route('admin.animals.destroy', $animal) }}"
                                    onsubmit="return confirm('Apagar este animal?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">Apagar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="p-3" colspan="4">Sem animais ainda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $animals->links() }}
        </div>
    </div>
</x-app-layout>