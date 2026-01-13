<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">⚙️ Painel de Administração</h1>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Animais -->
            <a href="{{ route('admin.animals.index') }}" class="group rounded-lg p-6 bg-white shadow-md hover:shadow-xl transition-all duration-300 border border-gray-200 hover:border-blue-300 hover:translate-y-[-4px]">
                <div class="text-3xl mb-3">🐶</div>
                <div class="text-lg font-bold text-gray-900 mb-1">Animais</div>
                <div class="text-sm text-gray-600">Adicionar, editar e remover animais</div>
            </a>

            <!-- Histórias de Sucesso -->
            @if(Route::has('admin.stories.index'))
                <a href="{{ route('admin.stories.index') }}" class="group rounded-lg p-6 bg-white shadow-md hover:shadow-xl transition-all duration-300 border border-gray-200 hover:border-blue-300 hover:translate-y-[-4px]">
                    <div class="text-3xl mb-3">🏆</div>
                    <div class="text-lg font-bold text-gray-900 mb-1">Histórias de Sucesso</div>
                    <div class="text-sm text-gray-600">Criar e gerir histórias</div>
                </a>
            @else
                <div class="rounded-lg p-6 bg-gray-50 shadow-sm border border-gray-200">
                    <div class="text-3xl mb-3">🏆</div>
                    <div class="text-lg font-bold text-gray-900 mb-1">Histórias de Sucesso</div>
                    <div class="text-sm text-gray-500">Em breve</div>
                </div>
            @endif

            <!-- Adoções -->
            @if(Route::has('admin.adoptions.index'))
                <a href="{{ route('admin.adoptions.index') }}" class="group rounded-lg p-6 bg-white shadow-md hover:shadow-xl transition-all duration-300 border border-gray-200 hover:border-blue-300 hover:translate-y-[-4px]">
                    <div class="text-3xl mb-3">📄</div>
                    <div class="text-lg font-bold text-gray-900 mb-1">Adoções</div>
                    <div class="text-sm text-gray-600">Aprovar / rejeitar pedidos</div>
                </a>
            @else
                <div class="rounded-lg p-6 bg-gray-50 shadow-sm border border-gray-200">
                    <div class="text-3xl mb-3">📄</div>
                    <div class="text-lg font-bold text-gray-900 mb-1">Adoções</div>
                    <div class="text-sm text-gray-500">Em breve</div>
                </div>
            @endif

            <!-- Voluntários -->
            @if(Route::has('admin.volunteers.index'))
                <a href="{{ route('admin.volunteers.index') }}" class="group rounded-lg p-6 bg-white shadow-md hover:shadow-xl transition-all duration-300 border border-gray-200 hover:border-blue-300 hover:translate-y-[-4px]">
                    <div class="text-3xl mb-3">🤝</div>
                    <div class="text-lg font-bold text-gray-900 mb-1">Voluntários</div>
                    <div class="text-sm text-gray-600">Aprovar / rejeitar pedidos</div>
                </a>
            @else
                <div class="rounded-lg p-6 bg-gray-50 shadow-sm border border-gray-200">
                    <div class="text-3xl mb-3">🤝</div>
                    <div class="text-lg font-bold text-gray-900 mb-1">Voluntários</div>
                    <div class="text-sm text-gray-500">Em breve</div>
                </div>
            @endif

            <!-- Mensagens -->
            @if(Route::has('admin.messages.index'))
                <a href="{{ route('admin.messages.index') }}" class="group rounded-lg p-6 bg-white shadow-md hover:shadow-xl transition-all duration-300 border border-gray-200 hover:border-blue-300 hover:translate-y-[-4px]">
                    <div class="text-3xl mb-3">💬</div>
                    <div class="text-lg font-bold text-gray-900 mb-1">Mensagens</div>
                    <div class="text-sm text-gray-600">Ver e responder mensagens</div>
                </a>
            @else
                <div class="rounded-lg p-6 bg-gray-50 shadow-sm border border-gray-200">
                    <div class="text-3xl mb-3">💬</div>
                    <div class="text-lg font-bold text-gray-900 mb-1">Mensagens</div>
                    <div class="text-sm text-gray-500">Em breve</div>
                </div>
            @endif

            <!-- Doações -->
            <a href="{{ route('admin.donations.index') }}" class="group rounded-lg p-6 bg-gradient-to-br from-green-50 to-emerald-50 shadow-md hover:shadow-xl transition-all duration-300 border border-green-200 hover:border-green-300 hover:translate-y-[-4px]">
                <div class="text-3xl mb-3">💰</div>
                <div class="text-lg font-bold text-gray-900 mb-1">Doações</div>
                <div class="text-3xl font-bold text-green-600 mt-3">
                    €{{ number_format($totalDonations, 2) }}
                </div>
                <div class="text-sm text-gray-600 mt-2">
                    Ver histórico completo
                </div>
            </a>

            <!-- Utilizadores -->
            <a href="{{ route('admin.users.index') }}" class="group rounded-lg p-6 bg-white shadow-md hover:shadow-xl transition-all duration-300 border border-gray-200 hover:border-blue-300 hover:translate-y-[-4px]">
                <div class="text-3xl mb-3">👥</div>
                <div class="text-lg font-bold text-gray-900 mb-1">Utilizadores</div>
                <div class="text-sm text-gray-600">Gerir permissões e contas</div>
            </a>

        </div>
    </div>
</x-app-layout>