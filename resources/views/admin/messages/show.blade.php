<x-app-layout>
    <div class="max-w-3xl mx-auto p-4">
        <div class="mb-6">
            <a href="{{ route('admin.messages.index') }}" class="text-blue-600 hover:underline">&larr; Voltar</a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-3 rounded bg-red-100">
                {{ session('error') }}
            </div>
        @endif

        <!-- Detalhes da Mensagem -->
        <div class="border rounded p-4 mb-6 bg-white">
            <h1 class="text-2xl font-bold mb-4">{{ $message->subject }}</h1>

            <div class="mb-4 pb-4 border-b">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 text-sm">De:</p>
                        <p class="font-semibold">{{ $message->name ?? ($message->user?->name ?? 'Anónimo') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Email:</p>
                        <p class="font-semibold">{{ $message->email ?? ($message->user?->email ?? 'N/A') }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-gray-600 text-sm">Data:</p>
                    <p class="text-gray-600">{{ $message->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="mb-6">
                <p class="text-gray-700 whitespace-pre-wrap">{{ $message->message }}</p>
            </div>

            <!-- Botões de Ação -->
            <div class="flex gap-3">
                <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" class="inline" onsubmit="return confirm('Apagar esta mensagem?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        Apagar
                    </button>
                </form>

                <button type="button" onclick="document.getElementById('reply-form').style.display = document.getElementById('reply-form').style.display === 'none' ? '' : 'none'" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Responder
                </button>
            </div>
        </div>

        <!-- Formulário de Resposta -->
        <div id="reply-form" style="display: none;" class="border rounded p-4 bg-gray-50">
            <h2 class="text-xl font-semibold mb-4">Enviar Resposta</h2>

            <form method="POST" action="{{ route('admin.messages.reply', $message) }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block font-medium mb-2">Resposta *</label>
                    <textarea name="reply" required class="w-full border rounded p-3" rows="6"
                        placeholder="Escreva a sua resposta aqui...">{{ old('reply') }}</textarea>
                    @error('reply')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Enviar Resposta
                    </button>
                    <button type="button" onclick="document.getElementById('reply-form').style.display = 'none'"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>