<?php

return [
    /*
     * Настройки писем
     */

    'mails_admins' => [
        'send' => false,
        'to' => [],
        'subject' => 'Новый отзыв',
        'headers' => [],
    ],

    'queue' => [
        'enable' => false,
        'name' => 'reviews_notify'
    ],

    'reviewable' => [

    ],
];
