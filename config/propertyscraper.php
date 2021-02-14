<?php

return [
    'mail_recipients' => env('SCRAPER_MAIL_RECIPIENTS', 'olajocs@gmail.com'),

    'sites' => [
        \App\Models\Sites\IngatlanCom::class
    ]
];