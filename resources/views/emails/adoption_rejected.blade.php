&lt;!DOCTYPE html&gt;
&lt;html lang="pt"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
    &lt;title&gt;Pedido de Adoção Rejeitado&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;h1&gt;Pedido de Adoção Rejeitado&lt;/h1&gt;
    &lt;p&gt;Olá {{ $adoption->user->name }},&lt;/p&gt;
    &lt;p&gt;Lamentamos informar que sua solicitação de adoção para o animal {{ $adoption->animal->name }} foi rejeitada.&lt;/p&gt;
    @if($reason)
        &lt;p&gt;&lt;strong&gt;Motivo:&lt;/strong&gt; {{ $reason }}&lt;/p&gt;
    @endif
    &lt;p&gt;Obrigado pelo interesse em adotar.&lt;/p&gt;
    &lt;p&gt;Atenciosamente,&lt;br&gt;Canil de Portugal&lt;/p&gt;
&lt;/body&gt;
&lt;/html&gt;