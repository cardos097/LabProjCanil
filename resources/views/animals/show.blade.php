<x-app-layout>
    <div class="max-w-3xl mx-auto p-4">
        <h1 class="text-2xl font-bold">{{ $animal->name }}</h1>
        <p class="text-gray-600 mb-4">
            {{ $animal->species }} • {{ $animal->breed ?? 'Sem raça' }}
        </p>

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

        <p class="mb-6">{{ $animal->description }}</p>

        {{-- ===================== ADOTAR ===================== --}}
        <div class="mb-8 border rounded p-4">
            <h2 class="text-lg font-semibold mb-2">Pedir adoção</h2>

            @auth
                @if($animal->status === 'Disponível' && !$animal->adoption)
                    <form method="POST" action="{{ route('adoptions.store', $animal) }}" class="space-y-2">
                        @csrf

                        <div>
                            <label class="block font-medium">Mensagem (opcional)</label>
                            <textarea name="notes" class="w-full border rounded p-2" rows="3"
                                placeholder="Ex: Tenho espaço, experiência com animais, rotina, etc...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                            Submeter pedido de adoção
                        </button>
                    </form>
                @elseif($animal->status === 'Adotado')
                    <div class="p-3 rounded bg-yellow-100">
                        Este animal já foi adotado.
                    </div>
                @else
                    <div class="p-3 rounded bg-yellow-100">
                        Já existe um pedido de adoção pendente para este animal.
                    </div>
                @endif
            @else
                <div class="p-3 rounded bg-gray-100">
                    <a class="underline" href="{{ route('login') }}">Faz login</a> para pedir adoção.
                </div>
            @endauth
        </div>
    </div>
</x-app-layout>