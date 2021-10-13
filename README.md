# Property Scraper

This scraper has been created to track advertised houses on different Hungarian sites. Currently there are 4 sites supported.
When new or modified ads has been found, the scraper sends the list of the ads in email.

Usage:
`php artisan property:search`

No additional parameter is needed, as every filter is read from the `.env` file.
Example for the app specific part of the `.env` file:
```
SCRAPER_MAIL_RECIPIENTS="email-one@email.com,email-to@email.com"
SCRAPER_FILTER_AREA = 80-150
SCRAPER_FILTER_PRICE = 5000000-35000000
SCRAPER_FILTER_LOCATION = Miskolc,Eger
```

Tests has been created to verify site specific logic:
`php artisan test`
or
`vendor/bin/phpunit`
