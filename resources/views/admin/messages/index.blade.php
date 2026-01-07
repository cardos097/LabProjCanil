<x-app-layout>
    <div class="max-w-6xl mx-auto p-4">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">📨 Mensagens</h1>

            <a href="{{ route('admin.index') }}" class="text-sm underline">
                Voltar ao Admin
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
                        <th class="text-left p-3">Email</th>
                        <th class="text-left p-3">Assunto</th>
                        <th class="text-left p-3">Data</th>
                        <th class="text-right p-3">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($messages as $message)
                        <tr class="border-t">
                            <td class="p-3">{{ $message->name ?? '—' }}</td>
                            <td class="p-3">{{ $message->email ?? '—' }}</td>
                            <td class="p-3 font-medium">{{ $message->subject }}</td>
                            <td class="p-3 text-gray-500">
                                {{ $message->created_at->format('Y-m-d H:i') }}
                            </td>
                            <td class="p-3 text-right space-x-2">
                                <a href="{{ route('admin.messages.show', $message) }}" class="text-blue-600 underline">
                                    Ver
                                </a>

                                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" class="inline"
                                    onsubmit="return confirm('Apagar esta mensagem?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 underline">
                                        Apagar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">
                                Nenhuma mensagem recebida.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $messages->links() }}
        </div>
    </div>
</x-app-layout>