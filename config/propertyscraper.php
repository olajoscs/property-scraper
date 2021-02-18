<?php

return [
    /*
     *
     */
    'mail_recipients' => env('SCRAPER_MAIL_RECIPIENTS', 'olajocs@gmail.com'),

    /*
     *
     */
    'sites' => [
        \App\Models\Sites\IngatlanCom::class,
        \App\Models\Sites\JofogasHu::class,
        \App\Models\Sites\DunaHouse::class,
        \App\Models\Sites\OtthonCentrum::class,
    ]
];