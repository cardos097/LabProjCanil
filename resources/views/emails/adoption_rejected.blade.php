<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido de Adoção Rejeitado</title>
</head>
<body>
    <h1>Pedido de Adoção Rejeitado</h1>
    <p>Olá {{ $adoption->user->name }},</p>
    <p>Lamentamos informar que sua solicitação de adoção para o animal {{ $adoption->animal->name }} foi rejeitada.</p>
    @if($reason)
        <p><strong>Motivo:</strong> {{ $reason }}</p>
    @endif
    <p>Obrigado pelo interesse em adotar.</p>
    <p>Atenciosamente,<br>Canil de Portugal</p>
</body>
</html>
