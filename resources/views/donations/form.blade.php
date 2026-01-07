<x-app-layout>
    <div class="max-w-xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-2">Doação ao Canil</h1>
        <p class="text-gray-600 mb-6">
            Ajuda-nos a cuidar dos animais. O pagamento é feito via Stripe (modo de testes).
        </p>

        @if ($errors->any())
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="border rounded p-4">
            <form method="POST" action="{{ route('donations.checkout') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="amount" class="block font-medium">Valor (€)</label>
                    <input id="amount" type="number" name="amount_eur" min="1" step="1"
                        value="{{ old('amount_eur', 10) }}" class="w-full border rounded p-2" required>
                    <p class="text-sm text-gray-500 mt-1">Mínimo: 1€</p>
                </div>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white px-4 py-2 rounded">
                    Doar com Stripe
                </button>
            </form>
        </div>
    </div>
</x-app-layout>