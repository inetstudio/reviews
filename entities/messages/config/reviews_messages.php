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
        'name' => 'reviews_notify',
    ],

    'reviewable' => [

    ],

    'images' => [
        'quality' => 100,
        'conversions' => [
            'message' => [
                'message' => [
                    'default' => [
                        [
                            'name' => 'message_admin',
                            'size' => [
                                'width' => 140,
                            ],
                        ],
                        [
                            'name' => 'message_front',
                            'fit' => [
                                'width' => 300,
                                'height' => 300,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
