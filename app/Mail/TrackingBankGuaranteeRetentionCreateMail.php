<?php

namespace App\Mail;

use App\Enums\TrackingType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TrackingBankGuaranteeRetentionCreateMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $trackingBankGuarantee;
    public $type;
    public function __construct($trackingBankGuarantee)
    {
        $this->trackingBankGuarantee = $trackingBankGuarantee;

    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $this->type = match ((int) $this->trackingBankGuarantee->type) {
            TrackingType::BB => 'BB',
            TrackingType::PB => 'PB',
            TrackingType::RETENTION => 'Retention',
            TrackingType::CUSTOM_MARGIN => 'Custom Margin'
        };

        return new Envelope(

            subject: 'New ' . $this->type . ' for ' . $this->trackingBankGuarantee->project_name . ' has created.',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'backend.email.tracking-bank-guarantee-retention-create',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
