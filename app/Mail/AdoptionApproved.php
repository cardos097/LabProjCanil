<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Adoption;
use Barryvdh\DomPDF\Facade\Pdf;

class AdoptionApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $adoption;

    /**
     * Create a new message instance.
     */
    public function __construct(Adoption $adoption)
    {
        $this->adoption = $adoption;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Adoção Aprovada - Comprovativo',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            text: 'emails.adoption_approved_text',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $pdf = Pdf::loadView('pdfs.adoption_certificate', ['adoption' => $this->adoption]);

        return [
            \Illuminate\Mail\Mailables\Attachment::fromData(fn () => $pdf->output(), 'comprovativo_adocao.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
