<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Volunteer;
use Barryvdh\DomPDF\Facade\Pdf;

class VolunteerApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $volunteer;

    /**
     * Create a new message instance.
     */
    public function __construct(Volunteer $volunteer)
    {
        $this->volunteer = $volunteer;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pedido de Voluntariado Aprovado',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            text: 'emails.volunteer_approved_text',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $pdf = Pdf::loadView('pdfs.volunteer_certificate', ['volunteer' => $this->volunteer]);

        return [
            \Illuminate\Mail\Mailables\Attachment::fromData(fn () => $pdf->output(), 'comprovativo_voluntariado.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
