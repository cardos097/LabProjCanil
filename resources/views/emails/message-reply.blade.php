<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
    <div style="background-color: #f3f4f6; padding: 20px; border-radius: 8px;">
        <h2 style="color: #1f2937; margin-top: 0;">Resposta do Canil</h2>
        
        <div style="background-color: white; padding: 20px; border-radius: 8px; margin: 20px 0;">
            {!! nl2br(e($content)) !!}
        </div>

        <div style="color: #6b7280; font-size: 14px; margin-top: 20px;">
            <p>Obrigado por contactar o Canil de Portugal.</p>
            <hr style="border: none; border-top: 1px solid #e5e7eb;">
            <p style="margin: 10px 0; font-size: 12px;">
                <strong>Canil de Portugal</strong><br>
                Email: {{ config('mail.from.address') }}
            </p>
        </div>
    </div>
</div>
