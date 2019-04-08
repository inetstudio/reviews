<?php

namespace InetStudio\Reviews\Messages\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use InetStudio\Reviews\Messages\Contracts\Mail\NewItemMailContract;
use InetStudio\Reviews\Messages\Contracts\Models\MessageModelContract;

/**
 * Class NewItemMail.
 */
class NewItemMail extends Mailable implements NewItemMailContract
{
    use SerializesModels;

    /**
     * @var MessageModelContract
     */
    protected $item;

    /**
     * NewItemMail constructor.
     *
     * @param  MessageModelContract  $item
     */
    public function __construct(MessageModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        $subject = config('app.name').' | '.config('reviews_messages.mails_admins.subject', 'Новый отзыв');
        $headers = config('reviews_messages.mails_admins.headers', []);

        $to = config('reviews_messages.mails_admins.to');

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->to($to, '')
            ->subject($subject)
            ->withSwiftMessage(function ($item) use ($headers) {
                $itemHeaders = $item->getHeaders();

                foreach ($headers as $header => $value) {
                    $itemHeaders->addTextHeader($header, $value);
                }
            })
            ->view('admin.module.reviews.messages::mails.message_admins', ['item' => $this->item]);
    }
}
