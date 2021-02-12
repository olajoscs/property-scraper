<?php

declare(strict_types=1);

namespace Tests\Unit\IngatlanCom;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\IngatlanCom\IngatlanComAreaFilter;
use App\Models\Filters\IngatlanCom\IngatlanComLocationFilter;
use App\Models\Filters\IngatlanCom\IngatlanComPriceFilter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\PriceFilter;
use App\Services\UrlGenerators\IngatlanComUrlGenerator;
use PHPUnit\Framework\TestCase;

class IngatlanComUrlGeneratorTest extends TestCase
{
    /**
     * @var IngatlanComUrlGenerator
     */
    private $generator;


    public function test_empty(): void
    {
        $filters = [];
        $expected = 'https://ingatlan.com/lista/elado+haz';

        $this->assertSame($expected, $this->generator->generate(1, ...$filters));
    }


    public function test_full(): void
    {
        $filters = [
            new IngatlanComAreaFilter(new AreaFilter(80, 150)),
            new IngatlanComPriceFilter(new PriceFilter(5000000, 35000000)),
            new IngatlanComLocationFilter(new LocationFilter('Miskolc', 'Miskolc Szirma', 'Szirmabesenyő', 'Mályi', 'Nyékládháza', 'Sajóvámos')),
        ];

        $expected = 'https://ingatlan.com/lista/80-150-m2+5-35-mFt+miskolc+miskolc-szirma+szirmabesenyo+malyi+nyekladhaza+sajovamos+elado+haz';

        $this->assertSame($expected, $this->generator->generate(1, ...$filters));
    }


    public function test_empty_page_3(): void
    {
        $filters = [];
        $expected = 'https://ingatlan.com/lista/elado+haz?page=3';

        $this->assertSame($expected, $this->generator->generate(3, ...$filters));
    }


    public function test_full_page_3(): void
    {
        $filters = [
            new IngatlanComAreaFilter(new AreaFilter(80, 150)),
            new IngatlanComPriceFilter(new PriceFilter(5000000, 35000000)),
            new IngatlanComLocationFilter(new LocationFilter('Miskolc', 'Miskolc Szirma', 'Szirmabesenyő', 'Mályi', 'Nyékládháza', 'Sajóvámos')),
        ];

        $expected = 'https://ingatlan.com/lista/80-150-m2+5-35-mFt+miskolc+miskolc-szirma+szirmabesenyo+malyi+nyekladhaza+sajovamos+elado+haz?page=3';

        $this->assertSame($expected, $this->generator->generate(3, ...$filters));
    }


    protected function setUp(): void
    {
        parent::setUp();

        $this->generator = new IngatlanComUrlGenerator();
    }
}
