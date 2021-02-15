<?php

declare(strict_types=1);

namespace Tests\Unit\JofogasHu;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\JofogasHu\JofogasHuAreaFilter;
use App\Models\Filters\JofogasHu\JofogasHuLocationFilter;
use App\Models\Filters\JofogasHu\JofogasHuPriceFilter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\PriceFilter;
use App\Services\UrlGenerators\JofogasHuUrlGenerator;
use PHPUnit\Framework\TestCase;

class JofogasHuUrlGeneratorTest extends TestCase
{

    /**
     * @var JofogasHuUrlGenerator
     */
    private $generator;


    public function test_empty(): void
    {
        $filters = [];
        $expected = 'https://ingatlan.jofogas.hu/haz';

        $this->assertSame($expected, $this->generator->generate(1, ...$filters));
    }


    public function test_full(): void
    {
        $filters = [
            new JofogasHuAreaFilter(new AreaFilter(80, 150)),
            new JofogasHuPriceFilter(new PriceFilter(5000000, 35000000)),
            new JofogasHuLocationFilter(new LocationFilter('Miskolc', 'Miskolc Szirma', 'Szirmabesenyő', 'Mályi', 'Nyékládháza', 'Sajóvámos')),
        ];

        $expected = 'https://ingatlan.jofogas.hu/borsod-abauj-zemplen/miskolc+miskolc-szirma+szirmabesenyo+malyi+nyekladhaza+sajovamos/haz?min_size=80&max_size=150&min_price=5000000&max_price=35000000';

        $this->assertSame($expected, $this->generator->generate(1, ...$filters));
    }


    public function test_empty_page_3(): void
    {
        $filters = [];
        $expected = 'https://ingatlan.jofogas.hu/haz?o=3';

        $this->assertSame($expected, $this->generator->generate(3, ...$filters));
    }


    public function test_full_page_3(): void
    {
        $filters = [
            new JofogasHuAreaFilter(new AreaFilter(80, 150)),
            new JofogasHuPriceFilter(new PriceFilter(5000000, 35000000)),
            new JofogasHuLocationFilter(new LocationFilter('Miskolc', 'Miskolc Szirma', 'Szirmabesenyő', 'Mályi', 'Nyékládháza', 'Sajóvámos')),
        ];

        $expected = 'https://ingatlan.jofogas.hu/borsod-abauj-zemplen/miskolc+miskolc-szirma+szirmabesenyo+malyi+nyekladhaza+sajovamos/haz?min_size=80&max_size=150&min_price=5000000&max_price=35000000&o=3';

        $this->assertSame($expected, $this->generator->generate(3, ...$filters));
    }


    protected function setUp(): void
    {
        parent::setUp();

        $this->generator = new JofogasHuUrlGenerator();
    }
}