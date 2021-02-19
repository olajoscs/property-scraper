<?php

return [
    /*
     * Recipients who should get email notifications about the properties
     */
    'mail_recipients' => env('SCRAPER_MAIL_RECIPIENTS', 'olajocs@gmail.com'),

    /*
     * Sites which should be scraped
     */
    'sites' => [
        \App\Models\Sites\IngatlanCom::class,
        \App\Models\Sites\JofogasHu::class,
        \App\Models\Sites\DunaHouse::class,
        \App\Models\Sites\OtthonCentrum::class,
    ],

    /*
     * Filters which should be applied
     */
    'filters' => [
        // example: Miskolc,Nyíregyháza
        'location' => env('SCRAPER_FILTER_LOCATION', ''),

        // example: 1000000-35000000
        'price' => env('SCRAPER_FILTER_PRICE', ''),

        // example: 80-150
        'area' => env('SCRAPER_FILTER_AREA', ''),
    ],
];