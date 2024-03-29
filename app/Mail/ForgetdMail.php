<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;
 
class ForgetdMail extends Mailable
{
    use Queueable, SerializesModels;
    public $newPassword;
    /**
     * Create a new message instance.
     */
    public function __construct($newPassword)
    {
        //
        $this->newPassword = $newPassword;
    }
 
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $from    = new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $subject = 'エコ・ウレックス工業会LPサイトお問い合わせ管理画面登録のお知らせ';
 
        return new Envelope(
            from: $from,
            subject: $subject,
        );
    }
 
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            text: 'emails.member', // プレーンテキストで送信
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