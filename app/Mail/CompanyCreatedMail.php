<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompanyCreatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private Company $company;
    public string|null $logoBase64;

    /**
     * Create a new message instance.
     */
    public function __construct($company)
    {
        $this->company = $company;
        $this->logoBase64 = $this->encodeLogoToBase64($company->logo);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Company Created',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.company_created',
            with: [
                'company' => $this->company,
                'logoBase64' => $this->logoBase64,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    private function encodeLogoToBase64(string|null $logoPath): string|null
    {
        if(empty($logoPath)) {
            return null;
        }

        $path = storage_path('app/public/logos/' . $logoPath);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);

        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}
