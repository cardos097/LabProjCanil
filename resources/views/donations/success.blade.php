<x-app-layout>
    <div class="max-w-xl mx-auto p-4">
        <div class="p-4 rounded bg-green-100 text-green-900 border border-green-200">
            <h1 class="text-2xl font-bold mb-2">Obrigado pela doação! ✅</h1>
            <p>Pagamento concluído com sucesso (modo de testes).</p>
        </div>

        <div class="mt-6 flex gap-3">
            <a href="/doar"
                class="bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white px-4 py-2 rounded">
                Fazer outra doação
            </a>

            @if(!empty($paymentIntentId))
                <a href="{{ route('comprovativo.download', ['paymentId' => $paymentIntentId]) }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                    Baixar comprovativo (PDF)
                </a>
            @endif

            <a href="/" class="bg-gray-200 text-gray-900 px-4 py-2 rounded">
                Voltar à home
            </a>
        </div>
    </div>
</x-app-layout>