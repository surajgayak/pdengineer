<?php

namespace App\Mail;

use App\Enums\TrackingType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TrackingbankGuaranteeRetentionRefundedStatusMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $trackingBank;
    public $type;
    public $authUser;
    public function __construct($trackingBank,$authUser)
    {
        $this->trackingBank = $trackingBank;
        $this->authUser = $authUser;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $this->type = match ((int) $this->trackingBank->type) {
            TrackingType::BB => 'BB',
            TrackingType::PB => 'PB',
            TrackingType::RETENTION => 'Retention',
            TrackingType::CUSTOM_MARGIN => 'Custom Margin'
        };
        return new Envelope(
            subject: $this->type . ' has Refunded',
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
            view: 'backend.email.tracking-bank-guarantee-retention-refunded-status',
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
