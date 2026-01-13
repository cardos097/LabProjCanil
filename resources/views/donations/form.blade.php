<x-app-layout>
    <div class="max-w-2xl mx-auto p-4">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">❤️ Faça uma Doação</h1>
            <p class="text-gray-600">Ajuda-nos a cuidar dos animais. Toda a doação faz diferença.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800 border border-red-300">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
            <form method="POST" action="{{ route('donations.checkout') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="amount" class="block font-semibold text-gray-900 mb-2">Valor (€) *</label>
                    <input id="amount" type="number" name="amount_eur" min="1" step="1"
                        value="{{ old('amount_eur', 10) }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    <p class="text-sm text-gray-500 mt-2">✓ Mínimo: 1€ | Seguro com Stripe</p>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold px-6 py-3 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105">
                    💳 Doar com Stripe
                </button>
            </form>
        </div>
    </div>
</x-app-layout>