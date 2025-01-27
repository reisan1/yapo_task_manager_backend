<?php

return [
    'channels' => [
        'single' => [
            'driver' => 'single',
            'path' => '/tmp/lumen-'.date('Y-m-d').'.log',
            'level' => 'debug',
        ],
    ],
];