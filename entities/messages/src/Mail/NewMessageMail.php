<?php

namespace InetStudio\Reviews\Messages\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;
use InetStudio\Reviews\Messages\Contracts\Mail\NewMessageMailContract;

/**
 * Class NewMessageMail.
 */
class NewMessageMail extends Mailable implements NewMessageMailContract
{
    use SerializesModels;

    /**
     * @var MessageModelContract
     */
    protected $message;

    /**
     * NewMessageMail constructor.
     *
     * @param MessageModelContract $message
     */
    public function __construct(MessageModelContract $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        $subject = config('app.name').' | '.((config('reviews_messages.mails_admins.subject')) ? config('reviews_messages.mails_admins.subject') : 'Новый отзыв');
        $headers = (config('reviews_messages.mails_admins.headers')) ? config('reviews_messages.mails_admins.headers') : [];

        $to = config('reviews_messages.mails_admins.to');

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->to($to, '')
            ->subject($subject)
            ->withSwiftMessage(function ($message) use ($headers) {
                $messageHeaders = $message->getHeaders();

                foreach ($headers as $header => $value) {
                    $messageHeaders->addTextHeader($header, $value);
                }
            })
            ->view('admin.module.reviews.messages::mails.message_admins', ['message' => $this->message]);
    }
}
