<?php

declare(strict_types=1);

namespace Tests\Unit\OtthonCentrum;

use App\Models\ParsedProperty;
use App\Services\Parsers\OtthonCentrumListParser;
use PHPUnit\Framework\TestCase;
use Tests\Unit\SamePropertyModelAssert;

/**
 *
 */
class OtthonCentrumListParserTest extends TestCase
{
    use SamePropertyModelAssert;

    public function test_parse_list_page_properties(): void
    {
        $parser = new OtthonCentrumListParser();
        $html = file_get_contents(__DIR__ . '/fixtures/oc-hu-list-page.html');

        $expedtedParsedProducts = $this->getExpectedParsedProducts();
        $parsedList = $parser->parse($html);

        $this->assertSameModels($expedtedParsedProducts, $parsedList->parsedProperties);
        $this->assertFalse($parsedList->hasNextPage);
    }


    public function test_parse_list_page_properties_with_prev_and_next_page(): void
    {
        $parser = new OtthonCentrumListParser();
        $html = file_get_contents(__DIR__ . '/fixtures/oc-hu-list-page-with-next-prev-page.html');

        $parsedList = $parser->parse($html);

        $this->assertTrue($parsedList->hasNextPage);
    }


    public function test_parse_list_page_properties_with_prev_page(): void
    {
        $parser = new OtthonCentrumListParser();
        $html = file_get_contents(__DIR__ . '/fixtures/oc-hu-list-page-with-prev-page.html');

        $parsedList = $parser->parse($html);

        $this->assertFalse($parsedList->hasNextPage);
    }


    public function test_parse_list_page_properties_with_next_page(): void
    {
        $parser = new OtthonCentrumListParser();
        $html = file_get_contents(__DIR__ . '/fixtures/oc-hu-list-page-with-next-page.html');

        $parsedList = $parser->parse($html);

        $this->assertTrue($parsedList->hasNextPage);
    }


    private function getExpectedParsedProducts(): array
    {
        return [
            ParsedProperty::make([
                'foreign_id' => "H424398",
                'name' => "Miskolcon, a Magashegyen, erdei környezetben, 4 szobás, 120nm-es családi ház + garzon lakás eladó BRUTÁLIS ÁRON!",
                'place' => "Miskolc Vargahegy",
                'link' => "/ingatlanok/H424398",
                'site' => "OtthonCentrum",
                'image' => "https://i2.oc.hu/realestate_images/340x255/crop/p36987430_lm90ltgj.jpg?v=1",
                'price' => 18500000,
                'area' => 120,
            ]),
            ParsedProperty::make([
                'foreign_id' => "H414462",
                'name' => "Miskolc  Andor u.  eladó egy felújítandó, 140 m2-es, 4 szobás tégla családi ház!",
                'place' => "Miskolc Győri kapu",
                'link' => "/ingatlanok/H414462",
                'site' => "OtthonCentrum",
                'image' => "https://i1.oc.hu/realestate_images/340x255/crop/p34948674_n4fs8pti.jpg?v=1",
                'price' => 19900000,
                'area' => 140,
            ]),
            ParsedProperty::make([
                'foreign_id' => "H418983",
                'name' => "Bulgárföldön eladó tégla építésű családi ház",
                'place' => "Miskolc Bulgárföld",
                'link' => "/ingatlanok/H418983",
                'site' => "OtthonCentrum",
                'image' => "https://i1.oc.hu/realestate_images/340x255/crop/p35825261_cauiuc5o.jpg?v=1",
                'price' => 31500000,
                'area' => 92,
            ]),
            ParsedProperty::make([
                'foreign_id' => "H421418",
                'name' => "Eladó tégla ikerház a Vasgyárban !",
                'place' => "Miskolc Vasgyár",
                'link' => "/ingatlanok/H421418",
                'site' => "OtthonCentrum",
                'image' => "https://i1.oc.hu/realestate_images/340x255/crop/p36336368_qbqrwcqg.jpg?v=1",
                'price' => 11950000,
                'area' => 81,
            ]),
            ParsedProperty::make([
                'foreign_id' => "H416104",
                'name' => "Miskolc Diósgyőrben eladó 4 szobás családi ház",
                'place' => "Miskolc Diósgyőr",
                'link' => "/ingatlanok/H416104",
                'site' => "OtthonCentrum",
                'image' => "https://i1.oc.hu/realestate_images/340x255/crop/p35245795_0nkcj9s0.jpg?v=1",
                'price' => 26900000,
                'area' => 120,
            ]),
            ParsedProperty::make([
                'foreign_id' => "H414486",
                'name' => "Eladó családi ház Miskolcon a Győri kapuban ! CSALÁDOSOK FIGYELEM!",
                'place' => "Miskolc Győri kapu",
                'link' => "/ingatlanok/H414486",
                'site' => "OtthonCentrum",
                'image' => "https://i1.oc.hu/realestate_images/340x255/crop/p34963521_iueqsvd2.jpg?v=1",
                'price' => 25900000,
                'area' => 110,
            ]),
            ParsedProperty::make([
                'foreign_id' => "H390410",
                'name' => "Miskolc Győri kapui, újszerű, 4 szobás családi ház várja új tulajdonosát!",
                'place' => "Miskolc Győri kapu",
                'link' => "/ingatlanok/H390410",
                'site' => "OtthonCentrum",
                'image' => "https://i0.oc.hu/realestate_images/340x255/crop/p30363173_pcj9l0jd.jpg?v=18",
                'price' => 21800000,
                'area' => 101,
            ]),
            ParsedProperty::make([
                'foreign_id' => "U0039116",
                'name' => "Újépítésű családi ház a Bodótetőn",
                'place' => "Miskolc Bodótető",
                'link' => "/ingatlanok/U0039116",
                'site' => "OtthonCentrum",
                'image' => "https://i2.oc.hu/realestate_images/340x255/crop/p34845368_fzmsx1y9.jpg?v=1",
                'price' => 33500000,
                'area' => 112,
            ]),
        ];
    }
}