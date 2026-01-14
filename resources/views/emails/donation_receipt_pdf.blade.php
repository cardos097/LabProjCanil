<!DOCTYPE html>
<html>
<head>
    <title>Comprovativo de Doação</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        h1 { color: #333; }
    </style>
</head>
<body>
    <h1>Comprovativo de Doação</h1>
    <p>Obrigado pela sua doação ao Canil de Portugal!</p>
    <p><strong>Valor doado:</strong> €{{ number_format($donation->amount / 100, 2, ',', '.') }}</p>
    <p><strong>Data:</strong> {{ $donation->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>ID da Transação:</strong> {{ $donation->id }}</p>
</body>
</html>