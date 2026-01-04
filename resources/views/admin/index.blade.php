<x-app-layout>
    <div class="max-w-6xl mx-auto p-4">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">Painel de Administração</h1>

            <a href="{{ route('admin.animals.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Adicionar Animal
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            {{-- Animais --}}
            <a href="{{ route('admin.animals.index') }}" class="p-4 rounded border hover:bg-gray-50">
                <div class="font-semibold text-lg">Animais</div>
                <div class="text-sm text-gray-600">Adicionar, editar e apagar animais</div>
                <div class="mt-3 text-blue-600 font-medium">Gerir →</div>
            </a>

            {{-- Adoções (vamos criar depois) --}}
            <div class="p-4 rounded border bg-gray-50 opacity-80">
                <div class="font-semibold text-lg">Adoções</div>
                <div class="text-sm text-gray-600">Aprovar / rejeitar pedidos</div>
                <div class="mt-3 text-gray-500 font-medium">Em breve</div>
            </div>

            {{-- Mensagens (vamos criar depois) --}}
            <div class="p-4 rounded border bg-gray-50 opacity-80">
                <div class="font-semibold text-lg">Mensagens</div>
                <div class="text-sm text-gray-600">Ver e gerir mensagens de contacto</div>
                <div class="mt-3 text-gray-500 font-medium">Em breve</div>
            </div>

            {{-- Histórias de sucesso (vamos criar depois) --}}
            <div class="p-4 rounded border bg-gray-50 opacity-80">
                <div class="font-semibold text-lg">Histórias de Sucesso</div>
                <div class="text-sm text-gray-600">Criar/editar histórias publicadas</div>
                <div class="mt-3 text-gray-500 font-medium">Em breve</div>
            </div>

        </div>
    </div>
</x-app-layout>