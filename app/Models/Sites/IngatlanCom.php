<?php

declare(strict_types=1);

namespace App\Models\Sites;

use App\Services\Parsers\IngatlanComListParser;
use App\Services\UrlGenerators\IngatlanComUrlGenerator;

/**
 *
 */
class IngatlanCom
{
    private $parser;
    private $urlGenerator;


    public function __construct(IngatlanComListParser $parser, IngatlanComUrlGenerator $urlGenerator)
    {
        $this->parser = $parser;
        $this->urlGenerator = $urlGenerator;
    }
}