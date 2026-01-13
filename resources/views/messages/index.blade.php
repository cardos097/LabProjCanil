<x-app-layout>
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Mensagens</h1>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2 text-left">De</th>
                        <th class="border p-2 text-left">Assunto</th>
                        <th class="border p-2 text-left">Data</th>
                        <th class="border p-2 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $message)
                        <tr class="hover:bg-gray-100 border-b">
                            <td class="border p-2">
                                <div>{{ $message->name ?? ($message->user?->name ?? 'Anónimo') }}</div>
                                @if($message->email)
                                    <div class="text-sm text-gray-600">{{ $message->email }}</div>
                                @endif
                            </td>
                            <td class="border p-2">{{ $message->subject }}</td>
                            <td class="border p-2 text-sm text-gray-600">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                            <td class="border p-2 text-center">
                                <a href="{{ route('admin.messages.show', $message) }}" class="text-blue-600 hover:underline">Ver</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="border p-4 text-center text-gray-600">Nenhuma mensagem recebida.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="mt-6">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
