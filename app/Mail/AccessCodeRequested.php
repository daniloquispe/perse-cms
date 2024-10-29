<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccessCodeRequested extends Mailable
{
    use Queueable, SerializesModels;

	public string $firstName;

    /**
     * Create a new message instance.
     */
    public function __construct(public string $accessCode, public string $email)
    {
		// Existing customer?
		$customer = Customer::query()
			->select('first_name')
			->where('email', $this->email)
			->first();

		$this->firstName = $customer ? ($customer->first_name ?? $this->email) : $this->email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Su clave de acceso es {$this->accessCode}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.auth.access-code',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
