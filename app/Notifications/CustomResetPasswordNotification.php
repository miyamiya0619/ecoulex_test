<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordNotification extends ResetPasswordNotification
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('パスワードリセットリクエストを受け取りました。')
            ->action('パスワードリセット', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('リクエストを無視していただける場合は、何もする必要はありません。');
    }
}
