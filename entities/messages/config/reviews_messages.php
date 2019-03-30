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
                'review' => [
                    'default' => [
                        [
                            'name' => 'review_admin',
                            'fit' => [
                                'width' => 140,
                                'height' => 140,
                            ],
                        ],
                        [
                            'name' => 'review_front',
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
