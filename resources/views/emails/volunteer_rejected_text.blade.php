Pedido de Voluntariado Rejeitado

Olá {{ $volunteer->user->name }},

Lamentamos informar que seu pedido de voluntariado foi rejeitado.

@if($reason)
Motivo: {{ $reason }}
@endif

Obrigado pelo interesse.

Atenciosamente,
Canil de Portugal