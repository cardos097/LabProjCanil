<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">📩 Mensagem</h1>

            <a href="{{ route('admin.messages.index') }}" class="text-sm underline">
                Voltar às Mensagens
            </a>
        </div>

        <div class="bg-white border rounded p-6 space-y-4">
            <div>
                <div class="text-sm text-gray-500">Nome</div>
                <div class="font-medium">{{ $message->name ?? '—' }}</div>
            </div>

            <div>
                <div class="text-sm text-gray-500">Email</div>
                <div class="font-medium">{{ $message->email ?? '—' }}</div>
            </div>

            <div>
                <div class="text-sm text-gray-500">Assunto</div>
                <div class="font-medium">{{ $message->subject }}</div>
            </div>

            <div>
                <div class="text-sm text-gray-500">Mensagem</div>
                <div class="border rounded p-3 bg-gray-50 whitespace-pre-line">
                    {{ $message->message }}
                </div>
            </div>

            <div class="text-sm text-gray-500">
                Enviada em {{ $message->created_at->format('Y-m-d H:i') }}
            </div>

            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}"
                onsubmit="return confirm('Apagar esta mensagem?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-600 text-white px-4 py-2 rounded">
                    Apagar mensagem
                </button>
            </form>
        </div>
    </div>
</x-app-layout>