<?php

return [
    'pixabay' => [
        'enabled' => true,
        'class'   => 'CamilleG\Stocks\Adapters\PixabayAdapter',
        'url'     => env('PIXABAY_URL'),
        'key'     => env('PIXABAY_API_KEY'),
    ],
];