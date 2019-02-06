<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Document;

class PublishDocument extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // school name 
        // sender
        // receivers
        // subject
        return $this
            ->subject("เอกสารจาก {$this->document->school->name}")
            ->view('mail.share-document')
            ->with([
                'document' => $this->document
            ]);
    }
}
