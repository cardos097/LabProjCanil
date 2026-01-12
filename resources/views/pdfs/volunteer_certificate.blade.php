Comprovativo de Voluntariado

Nome do Voluntário: {{ $volunteer->user->name }}
Email: {{ $volunteer->user->email }}
Disponibilidade: {{ $volunteer->availability }}
Habilidades: {{ $volunteer->skills }}
Notas: {{ $volunteer->notes }}
Data da Aprovação: {{ $volunteer->updated_at->format('Y-m-d') }}

Este documento comprova que o voluntariado foi aprovado.

_______________________________
Canil de Portugal