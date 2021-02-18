<?php

declare(strict_types=1);

namespace Tests\Unit\OtthonCentrum;

use App\Models\Filters\AreaFilter;
use App\Models\Filters\OtthonCentrum\OtthonCentrumAreaFilter;
use App\Models\Filters\OtthonCentrum\OtthonCentrumLocationFilter;
use App\Models\Filters\OtthonCentrum\OtthonCentrumPriceFilter;
use App\Models\Filters\LocationFilter;
use App\Models\Filters\PriceFilter;
use App\Services\UrlGenerators\OtthonCentrumUrlGenerator;
use PHPUnit\Framework\TestCase;

class OtthonCentrumUrlGeneratorTest extends TestCase
{
    /**
     * @var OtthonCentrumUrlGenerator
     */
    private $generator;


    public function test_empty(): void
    {
        $filters = [];
        $expected = 'https://oc.hu/ingatlanok/lista/felhasznalas:elado/tipus:house/';

        $this->assertSame($expected, $this->generator->generate(1, ...$filters));
    }


    public function test_full(): void
    {
        $filters = [
            new OtthonCentrumAreaFilter(new AreaFilter(80, 150)),
            new OtthonCentrumPriceFilter(new PriceFilter(5000000, 35000000)),
            new OtthonCentrumLocationFilter(new LocationFilter('Miskolc', 'Szirmabesenyő', 'Mályi', 'Nyékládháza', 'Sajóvámos')),
        ];

        $expected = 'https://oc.hu/ingatlanok/lista/felhasznalas:elado/tipus:house/netto-alapterulet:80~150/ar:5~35/hely-ertek:miskolc,szirmabesenyo,malyi,nyekladhaza,sajovamos/hely-id:miskolc,szirmabesenyo,malyi,nyekladhaza,sajovamos';

        $this->assertSame($expected, $this->generator->generate(1, ...$filters));
    }


    public function test_empty_page_3(): void
    {
        $filters = [];
        $expected = 'https://oc.hu/ingatlanok/lista/felhasznalas:elado/tipus:house/?page=3';

        $this->assertSame($expected, $this->generator->generate(3, ...$filters));
    }


    public function test_full_page_3(): void
    {
        $filters = [
            new OtthonCentrumAreaFilter(new AreaFilter(80, 150)),
            new OtthonCentrumPriceFilter(new PriceFilter(5000000, 35000000)),
            new OtthonCentrumLocationFilter(new LocationFilter('Miskolc', 'Szirmabesenyő', 'Mályi', 'Nyékládháza', 'Sajóvámos')),
        ];

        $expected = 'https://oc.hu/ingatlanok/lista/felhasznalas:elado/tipus:house/netto-alapterulet:80~150/ar:5~35/hely-ertek:miskolc,szirmabesenyo,malyi,nyekladhaza,sajovamos/hely-id:miskolc,szirmabesenyo,malyi,nyekladhaza,sajovamos?page=3';

        $this->assertSame($expected, $this->generator->generate(3, ...$filters));
    }


    protected function setUp(): void
    {
        parent::setUp();

        $this->generator = new OtthonCentrumUrlGenerator();
    }
}