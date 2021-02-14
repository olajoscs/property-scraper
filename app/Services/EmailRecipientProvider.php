<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Provides the recipients who should get email notification about new properties
 */
class EmailRecipientProvider
{
    private $recipients;


    /**
     * Return the recipients who should get email notification about new properties
     *
     * @return string[]
     */
    public function getAll(): array
    {
        if ($this->recipients === null) {
            $this->populatInnerCache();
        }

        return $this->recipients;
    }


    private function populatInnerCache(): void
    {
        $recipients = \Config::get('propertyscraper.mail_recipients');

        $this->recipients = explode(',', $recipients);
    }
}