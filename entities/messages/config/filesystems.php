<?php

return [

    /*
     * Расширение файла конфигурации app/config/filesystems.php
     * добавляет локальный диск для хранения изображений отзывов
     */

    'reviews_messages' => [
        'driver' => 'local',
        'root' => storage_path('app/public/reviews/messages'),
        'url' => env('APP_URL').'/storage/reviews/messages',
        'visibility' => 'public',
    ],

];
