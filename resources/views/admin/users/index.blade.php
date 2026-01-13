<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">👥 Gerir Utilizadores</h1>
            <p class="text-gray-600">Administrar permissões e contas de utilizadores</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800 border border-red-300">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
            @if($users->isEmpty())
                <div class="p-8 text-center">
                    <p class="text-gray-600 text-lg">Nenhum utilizador encontrado.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Nome</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Email</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Função</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Atividade</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Registado</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                        {{ $user->name }}
                                        @if($user->id === Auth::id())
                                            <span class="text-xs text-blue-600">(tu)</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $user->email }}
                                        @if($user->email_verified_at)
                                            <span class="text-green-600 text-xs">✓</span>
                                        @else
                                            <span class="text-yellow-600 text-xs">⚠ Não verificado</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        @if($user->role === 'admin')
                                            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">
                                                👑 Admin
                                            </span>
                                        @else
                                            <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-semibold">
                                                👤 Utilizador
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <div class="flex gap-2 text-xs">
                                            <span title="Adoções">🐕 {{ $user->adoptions_count }}</span>
                                            <span title="Donativos">💰 {{ $user->donations_count }}</span>
                                            <span title="Comentários">💬 {{ $user->comments_count }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex gap-2">
                                            @if($user->id !== Auth::id())
                                                <!-- Toggle Admin -->
                                                <form method="POST" action="{{ route('admin.users.toggleAdmin', $user) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if($user->role === 'admin')
                                                        <button type="submit" class="px-3 py-1 rounded bg-gray-600 hover:bg-gray-700 text-white text-xs font-semibold transition-colors">
                                                            Remover Admin
                                                        </button>
                                                    @else
                                                        <button type="submit" class="px-3 py-1 rounded bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold transition-colors">
                                                            Promover Admin
                                                        </button>
                                                    @endif
                                                </form>

                                                <!-- Delete User -->
                                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Tens a certeza que queres eliminar este utilizador? Esta ação não pode ser revertida.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-semibold transition-colors">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-xs text-gray-500 italic">—</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $users->links() }}
                </div>
            @endif
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-6 border border-blue-200">
                <div class="text-sm text-gray-600 mb-2">Total de Utilizadores</div>
                <div class="text-3xl font-bold text-blue-600">
                    {{ $users->total() }}
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg p-6 border border-purple-200">
                <div class="text-sm text-gray-600 mb-2">Administradores</div>
                <div class="text-3xl font-bold text-purple-600">
                    {{ $users->where('role', 'admin')->count() }}
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-6 border border-green-200">
                <div class="text-sm text-gray-600 mb-2">Utilizadores Comuns</div>
                <div class="text-3xl font-bold text-green-600">
                    {{ $users->where('role', 'user')->count() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
