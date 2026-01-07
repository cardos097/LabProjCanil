<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-3xl font-bold mb-2">Bem-vindo ao Canil</h1>
            <p class="text-gray-600 mb-6">
                Ajuda-nos a encontrar uma família para os nossos animais e a apoiar o nosso trabalho.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Donation call-to-action -->
                <div class="md:col-span-3 border rounded-lg p-4 bg-green-50 flex items-center justify-between">
                    <div>
                        <h2 class="font-semibold text-lg">❤️ Apoie o nosso trabalho</h2>
                        <p class="text-sm text-gray-600">As doações ajudam-nos a cuidar e a encontrar lar para mais
                            animais.</p>
                    </div>
                    <div>
                        <a href="{{ route('donations.form') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                            Doar agora
                        </a>
                    </div>
                </div>

                <a href="{{ route('success_stories.index') }}" class="border rounded-lg p-4 hover:bg-gray-50">
                    <h2 class="font-semibold text-lg">🏆 Histórias de Sucesso</h2>
                    <p class="text-sm text-gray-600">Conhece adoções felizes e finais positivos.</p>
                </a>

                <a href="{{ route('contact') }}" class="border rounded-lg p-4 hover:bg-gray-50">
                    <h2 class="font-semibold text-lg">📩 Contacte-nos</h2>
                    <p class="text-sm text-gray-600">Envia uma mensagem ao canil.</p>
                </a>

                @auth
                    <a href="{{ route('volunteers.create') }}" class="border rounded-lg p-4 hover:bg-gray-50">
                        <h2 class="font-semibold text-lg">🙋 Ser Voluntário</h2>
                        <p class="text-sm text-gray-600">Regista-te e ajuda-nos no dia-a-dia.</p>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="border rounded-lg p-4 hover:bg-gray-50">
                        <h2 class="font-semibold text-lg">🔐 Entrar / Registar</h2>
                        <p class="text-sm text-gray-600">Cria conta para comentar e voluntariar.</p>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</x-app-layout>