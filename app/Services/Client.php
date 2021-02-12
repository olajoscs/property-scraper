<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Client which gets the content of an url
 */
interface Client
{
    /**
     * Return the content of the url
     *
     * @param string $url
     *
     * @return string
     */
    public function get(string $url): string;
}