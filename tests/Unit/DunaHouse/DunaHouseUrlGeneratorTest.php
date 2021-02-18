<?php

declare(strict_types=1);

namespace Tests\Unit\DunaHouse;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\DunaHouse\DunaHouseAreaFilter;
use App\Models\Filters\DunaHouse\DunaHouseLocationFilter;
use App\Models\Filters\DunaHouse\DunaHousePriceFilter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\PriceFilter;
use App\Services\UrlGenerators\DunaHouseUrlGenerator;
use PHPUnit\Framework\TestCase;

/**
 *
 */
class DunaHouseUrlGeneratorTest extends TestCase
{
    /**
     * @var DunaHouseUrlGenerator
     */
    private $generator;


    public function test_empty(): void
    {
        $filters = [];
        $expected = 'https://dh.hu/elado-ingatlan/haz/-/-/-/-';

        $this->assertSame($expected, $this->generator->generate(1, ...$filters));
    }


    public function test_full(): void
    {
        $filters = [
            new DunaHouseAreaFilter(new AreaFilter(80, 150)),
            new DunaHousePriceFilter(new PriceFilter(5000000, 35000000)),
            new DunaHouseLocationFilter(new LocationFilter('Miskolc', 'Miskolc Szirma', 'Szirmabesenyő', 'Mályi', 'Nyékládháza', 'Sajóvámos')),
        ];

        $expected = 'https://dh.hu/elado-ingatlan/haz/miskolc+miskolc-szirma+szirmabesenyo+malyi+nyekladhaza+sajovamos/-/5-35-mFt/80-150-m2';

        $this->assertSame($expected, $this->generator->generate(1, ...$filters));
    }


    public function test_empty_page_3(): void
    {
        $filters = [];
        $expected = 'https://dh.hu/elado-ingatlan/haz/-/-/-/-/oldal-3';

        $this->assertSame($expected, $this->generator->generate(3, ...$filters));
    }


    public function test_full_page_3(): void
    {
        $filters = [
            new DunaHouseAreaFilter(new AreaFilter(80, 150)),
            new DunaHousePriceFilter(new PriceFilter(5000000, 35000000)),
            new DunaHouseLocationFilter(new LocationFilter('Miskolc', 'Miskolc Szirma', 'Szirmabesenyő', 'Mályi', 'Nyékládháza', 'Sajóvámos')),
        ];

        $expected = 'https://dh.hu/elado-ingatlan/haz/miskolc+miskolc-szirma+szirmabesenyo+malyi+nyekladhaza+sajovamos/-/5-35-mFt/80-150-m2/oldal-3';

        $this->assertSame($expected, $this->generator->generate(3, ...$filters));
    }


    protected function setUp(): void
    {
        parent::setUp();

        $this->generator = new DunaHouseUrlGenerator();
    }
}