<?php

namespace App\Mail;

use App\Models\Book;
use App\Models\Customer;
use App\Services\UrlService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class AbandonedCart extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

	public Collection $books;

    /**
     * Create a new message instance.
     */
    public function __construct(public Customer $customer)
    {
		$urlService = new UrlService();

		$this->books = Book::query()
			->inRandomOrder()
			->where('is_visible', true)
			->whereNotNull('cover')
			->take(2)
			->get();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '¿Olvidaste algo? 🤔☺️',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.cart.abandoned',
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
