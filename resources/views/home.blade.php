<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-3xl font-bold mb-2">Bem-vindo ao Canil</h1>
            <p class="text-gray-600 mb-6">
                Ajuda-nos a encontrar uma família para os nossos animais e a apoiar o nosso trabalho.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Agradecimento e Total de Doações - Compacto -->
                <div class="md:col-span-3 rounded-lg p-6 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 shadow-2xl relative overflow-hidden">
                    <!-- Padrão decorativo -->
                    <div class="absolute top-0 right-0 opacity-20">
                        <svg width="200" height="200" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="100" cy="100" r="100" fill="white"/>
                        </svg>
                    </div>

                    <div class="flex flex-col md:flex-row items-center justify-between gap-4 md:gap-6 relative z-10">
                        <!-- Texto e Total -->
                        <div class="flex-1 w-full md:w-auto">
                            <h2 class="font-bold text-2xl text-white mb-1">🙏 Obrigado pela Generosidade</h2>
                            <p class="text-blue-100 text-sm">Cada donativo ajuda-nos a cuidar melhor dos nossos animais.</p>
                        </div>

                        <!-- Stats -->
                        <div class="flex flex-col md:flex-row gap-3 md:gap-4 items-center w-full md:w-auto">
                            <div class="bg-white rounded-lg px-5 py-4 text-center min-w-max shadow-lg">
                                <p class="text-blue-600 text-xs font-bold uppercase tracking-wide">Total Doado</p>
                                <p class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">€{{ number_format($totalDonations, 2) }}</p>
                            </div>

                            <a href="{{ route('donations.form') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-lg transition-all duration-300 hover:shadow-xl whitespace-nowrap transform hover:scale-105 w-full md:w-auto text-center">
                                Doar Agora
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('animals.index') }}" class="border rounded-lg p-4 hover:bg-gray-50">
                    <h2 class="font-semibold text-lg">🐶 Adotar Animais</h2>
                    <p class="text-sm text-gray-600">Encontra o teu novo companheiro.</p>
                </a>

                <a href="{{ route('success_stories.index') }}" class="border rounded-lg p-4 hover:bg-gray-50">
                    <h2 class="font-semibold text-lg">🏆 Histórias de Sucesso</h2>
                    <p class="text-sm text-gray-600">Conhece adoções felizes e finais positivos.</p>
                </a>

                @auth
                    @if(Auth::user()->role !== 'admin')
                        <a href="{{ route('messages.index') }}" class="border rounded-lg p-4 hover:bg-gray-50">
                            <h2 class="font-semibold text-lg">📩 Contacte-nos</h2>
                            <p class="text-sm text-gray-600">Envia uma mensagem ao canil.</p>
                        </a>
                    @endif
                @else
                    <a href="{{ route('messages.index') }}" class="border rounded-lg p-4 hover:bg-gray-50">
                        <h2 class="font-semibold text-lg">📩 Contacte-nos</h2>
                        <p class="text-sm text-gray-600">Envia uma mensagem ao canil.</p>
                    </a>
                @endauth

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