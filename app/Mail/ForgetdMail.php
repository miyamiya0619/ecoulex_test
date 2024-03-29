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
        $contentText = "
        この度は、当工業会LPサイトお問合せサイトへの掲載申込ありがとうございます。
        貴社情報の管理者アカウントへの登録が完了しました。パスワードは以下になります。
        {$this->newPassword}
        
        事務局では、貴社の基本情報の登録のみをしておりますので、
        ①会員企業管理画面にログインいただき早めに必要事項の登録作業をお願いいたします。
        ※ 工事種類の登録については、初めに事務局の方で「防水工事 | ウレタン防水」を登録しておりますので、
        それ以外で登録掲載希望の工種がありましたら追加して下さい。また検索の際に工事種類のわからない方用に「調査、診断 | 防水劣化調査、診断」も登録してあります。
        ②登録方法はマニュアルをご確認ください。
        
        ①会員企業管理画面に下記からログイン願います。
        ログインはこちらをクリック【ここにログインアドレス入る】
        
        ②マニュアルは
        こちらをクリック【ここにマニュアルのアドレスが入る】
        
        --------------------------------------------
        107-0051　東京都港区元赤坂1-2-7　
        赤坂Kタワー7階　
        シーカ・ジャパン㈱内
        一般社団法人エコ・ウレックス工業会
        事務局　石井敏夫
        Tel(03)6434-7457   Fax(03)6434-7473
        メールアドレス　info@eco-ulex.com
        --------------------------------------------
    ";

    return new Content(
        text: $contentText
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