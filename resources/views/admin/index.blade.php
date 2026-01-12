<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Painel de Administração</h1>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Animais -->
            <a href="{{ route('admin.animals.index') }}" class="border rounded p-5 hover:bg-gray-50 transition">
                <div class="text-lg font-semibold">🐶 Animais</div>
                <div class="text-sm text-gray-600 mt-1">
                    Adicionar, editar e remover animais
                </div>
            </a>

            <!-- Histórias de Sucesso -->
            @if(Route::has('admin.stories.index'))
                <a href="{{ route('admin.stories.index') }}" class="border rounded p-5 hover:bg-gray-50 transition">
                    <div class="text-lg font-semibold">🏆 Histórias de Sucesso</div>
                    <div class="text-sm text-gray-600 mt-1">
                        Criar e gerir histórias
                    </div>
                </a>
            @else
                <div class="border rounded p-5 bg-gray-50 text-gray-500">
                    <div class="text-lg font-semibold">🏆 Histórias de Sucesso</div>
                    <div class="text-sm mt-1">Em breve</div>
                </div>
            @endif

            <!-- Adoções -->
            @if(Route::has('admin.adoptions.index'))
                <a href="{{ route('admin.adoptions.index') }}" class="border rounded p-5 hover:bg-gray-50 transition">
                    <div class="text-lg font-semibold">📄 Adoções</div>
                    <div class="text-sm text-gray-600 mt-1">
                        Aprovar / rejeitar pedidos
                    </div>
                </a>
            @else
                <div class="border rounded p-5 bg-gray-50 text-gray-500">
                    <div class="text-lg font-semibold">📄 Adoções</div>
                    <div class="text-sm mt-1">Em breve</div>
                </div>
            @endif

            <!-- Voluntários -->
            @if(Route::has('admin.volunteers.index'))
                <a href="{{ route('admin.volunteers.index') }}" class="border rounded p-5 hover:bg-gray-50 transition">
                    <div class="text-lg font-semibold">🤝 Voluntários</div>
                    <div class="text-sm text-gray-600 mt-1">
                        Aprovar / rejeitar pedidos
                    </div>
                </a>
            @else
                <div class="border rounded p-5 bg-gray-50 text-gray-500">
                    <div class="text-lg font-semibold">🤝 Voluntários</div>
                    <div class="text-sm mt-1">Em breve</div>
                </div>
            @endif

            <!-- Doações -->
            <div class="border rounded p-5 bg-green-50">
                <div class="text-lg font-semibold">💰 Doações Totais</div>
                <div class="text-2xl font-bold text-green-600 mt-1">
                    €{{ number_format($totalDonations, 2) }}
                </div>
                <div class="text-sm text-gray-600 mt-1">
                    Total arrecadado
                </div>
            </div>

        </div>
    </div>
</x-app-layout>