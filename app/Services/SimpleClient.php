<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Client which gets the content of an url with file_get_contents
 */
class SimpleClient implements Client
{
    public function get(string $url): string
    {
        return file_get_contents($url);
    }
}