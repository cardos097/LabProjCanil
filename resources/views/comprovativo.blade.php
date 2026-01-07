<x-app-layout>
    <div style="text-align: center; padding: 20px;">
        <h1>Comprovativo de Pagamento</h1>
        <p><strong>Nome:</strong> {{ $nome }}</p>
        <p><strong>Valor:</strong> {{ number_format($valor, 2, ',', '.') }} USD</p>
        <p><strong>Data do Pagamento:</strong> {{ $data }}</p>
        <p><strong>ID do Pagamento:</strong> {{ $paymentId }}</p>
    </div>
</x-app-layout>