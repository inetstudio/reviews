<?php

return [

    /*
     * Расширение файла конфигурации app/config/filesystems.php
     * добавляет локальные диски для хранения лого сайтов
     */

    'reviews_sites' => [
        'driver' => 'local',
        'root' => storage_path('app/public/reviews/sites/'),
        'url' => env('APP_URL').'/storage/reviews/sites/',
        'visibility' => 'public',
    ],

];
