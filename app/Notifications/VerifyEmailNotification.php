<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;

class VerifyEmailNotification extends VerifyEmail
{
    use Queueable;

    /**
     * @param [type] $url
     * @return MailMessage
     */
    protected function buildMailMessage($url): MailMessage
    {
        Log::info('send for email', [
            'method' => __METHOD__,
            'url' => $url,
        ]);

        return (new MailMessage())
            ->markdown('email.user_info.verify-email')
            ->subject(__('mail.verify_email.subject'))
            ->line(__('mail.verify_email.greet'))
            ->line(__('mail.verify_email.notice_apply'))
            ->action(__('mail.verify_email.action'), $url)
            ->line(__('mail.verify_email.expire'))
            ->line(__('mail.verify_email.expire_guide'))
            ->line(__('mail.verify_email.notice'));
    }

    /**
     * @param [type] $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable): string
    {
        Log::info('make auth url', [
            'method' => __METHOD__,
            'notifiable' => $notifiable,
            'id' => $notifiable->getKey(),
        ]);

        return sprintf(
            config('app.front_url').'/verify-email?token=%s',
            $notifiable->emailVerificationToken->token,
        );
    }
}
