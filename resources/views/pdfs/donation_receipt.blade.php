Comprovativo de Doação

Nome do Doador: {{ $donation->user ? $donation->user->name : 'Anônimo' }}
Email: {{ $donation->user ? $donation->user->email : 'N/A' }}
Valor Doado: €{{ number_format($donation->amount / 100, 2) }}
Data da Doação: {{ $donation->created_at->format('Y-m-d H:i') }}

Obrigado pela sua doação ao Canil de Portugal!

_______________________________
Canil de Portugal