<?php

return [
    'default' => env('LOG_CHANNEL', 'stack'),  // Will default to 'stack' unless changed

    'channels' => [
        'stack' => [
            'driver' => 'null',  // Disable the stack logging channel
        ],
    ],
];