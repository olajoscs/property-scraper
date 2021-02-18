<?php

declare(strict_types=1);

namespace Tests\Unit\DunaHouse;

use App\Models\ParsedProperty;
use App\Services\Parsers\DunaHouseListParser;
use PHPUnit\Framework\TestCase;
use Tests\Unit\SamePropertyModelAssert;

/**
 *
 */
class DunaHouseListParserTest extends TestCase
{
    use SamePropertyModelAssert;

    public function test_parse_list_page_properties(): void
    {
        $parser = new DunaHouseListParser();
        $html = file_get_contents(__DIR__ . '/fixtures/dh-hu-list-page.html');

        $expedtedParsedProducts = $this->getExpectedParsedProducts();
        $parsedList = $parser->parse($html);

        $this->assertSameModels($expedtedParsedProducts, $parsedList->parsedProperties);
        $this->assertFalse($parsedList->hasNextPage);
    }


    public function test_parse_list_page_properties_with_prev_and_next_page(): void
    {
        $parser = new DunaHouseListParser();
        $html = file_get_contents(__DIR__ . '/fixtures/dh-hu-list-page-with-next-prev-page.html');

        $parsedList = $parser->parse($html);

        $this->assertTrue($parsedList->hasNextPage);
    }


    public function test_parse_list_page_properties_with_prev_page(): void
    {
        $parser = new DunaHouseListParser();
        $html = file_get_contents(__DIR__ . '/fixtures/dh-hu-list-page-with-prev-page.html');

        $parsedList = $parser->parse($html);

        $this->assertFalse($parsedList->hasNextPage);
    }


    public function test_parse_list_page_properties_with_next_page(): void
    {
        $parser = new DunaHouseListParser();
        $html = file_get_contents(__DIR__ . '/fixtures/dh-hu-list-page-with-next-page.html');

        $parsedList = $parser->parse($html);

        $this->assertTrue($parsedList->hasNextPage);
    }


    private function getExpectedParsedProducts(): array
    {
        return [
            ParsedProperty::make([
                'foreign_id' => "HZ011626",
                'name' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'place' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'link' => "/ingatlan/HZ011626",
                'site' => "DunaHouse",
                'image' => "https://cdn2.fs2.matrixhu.com/storage/production/fileID/5ff84537f4de3a6594570423/fileVersionID/propertyPageImageNoCrop/fileVersionKey/AwODcwNmEwMmQxOTI5Y2",
                'price' => 29900000,
                'area' => 100,
            ]),
            ParsedProperty::make([
                'foreign_id' => "HZ525581",
                'name' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'place' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'link' => "/ingatlan/HZ525581",
                'site' => "DunaHouse",
                'image' => "https://cdn8.fs2.matrixhu.com/storage/production/fileID/5fc4470ff4de3a33b3001869/fileVersionID/propertyPageImageNoCrop/fileVersionKey/I5ZTk4ZTQ4MGVkMzQyMD",
                'price' => 19900000,
                'area' => 150,
            ]),
            ParsedProperty::make([
                'foreign_id' => "HZ525007",
                'name' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'place' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'link' => "/ingatlan/HZ525007",
                'site' => "DunaHouse",
                'image' => "https://cdn10.fs2.matrixhu.com/storage/production/fileID/5fc56d56f4de3a0bc5705564/fileVersionID/propertyPageImageNoCrop/fileVersionKey/YyOGQ3NDIzMTJkMjZhZW",
                'price' => 13990000,
                'area' => 80,
            ]),
            ParsedProperty::make([
                'foreign_id' => "HZ523361",
                'name' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Nyékládháza",
                'place' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Nyékládháza",
                'link' => "/ingatlan/HZ523361",
                'site' => "DunaHouse",
                'image' => "https://cdn9.fs2.matrixhu.com/storage/production/fileID/5fc5d70bf4de3a062b023ea0/fileVersionID/propertyPageImageNoCrop/fileVersionKey/k0ZTMwM2E2Y2I4YzdkYj",
                'price' => 24900000,
                'area' => 120,
            ]),
            ParsedProperty::make([
                'foreign_id' => "HZ522518",
                'name' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc - Miskolctapolcai barlangfürdő közelében",
                'place' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc - Miskolctapolcai barlangfürdő közelében",
                'link' => "/ingatlan/HZ522518",
                'site' => "DunaHouse",
                'image' => "https://cdn5.fs2.matrixhu.com/storage/production/fileID/5fc5af6cf4de3a06095b740a/fileVersionID/propertyPageImageNoCrop/fileVersionKey/QyNjY3ODM0ZjM4OGE2Zj",
                'price' => 33700000,
                'area' => 80,
            ]),
            ParsedProperty::make([
                'foreign_id' => "HZ521047",
                'name' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'place' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'link' => "/ingatlan/HZ521047",
                'site' => "DunaHouse",
                'image' => "https://cdn3.fs2.matrixhu.com/storage/production/fileID/5fc5c021f4de3a061238194f/fileVersionID/propertyPageImageNoCrop/fileVersionKey/E2MDdkODQ3ZDJiMDhiYW",
                'price' => 22500000,
                'area' => 150,
            ]),
            ParsedProperty::make([
                'foreign_id' => "HZ514756",
                'name' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'place' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'link' => "/ingatlan/HZ514756",
                'site' => "DunaHouse",
                'image' => "https://cdn8.fs2.matrixhu.com/storage/production/fileID/5fc5c971f4de3a05402fc863/fileVersionID/propertyPageImageNoCrop/fileVersionKey/Y4ZWY5MGU4ODYwYzNmOG",
                'price' => 23900000,
                'area' => 100,
            ]),
            ParsedProperty::make([
                'foreign_id' => "HZ514737",
                'name' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'place' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'link' => "/ingatlan/HZ514737",
                'site' => "DunaHouse",
                'image' => "https://cdn10.fs2.matrixhu.com/storage/production/fileID/5fc5bbd0f4de3a061e3bf0c3/fileVersionID/propertyPageImageNoCrop/fileVersionKey/UzNmU3YTYyYjMxMjkxZW",
                'price' => 14500000,
                'area' => 96,
            ]),
            ParsedProperty::make([
                'foreign_id' => "HZ503891",
                'name' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'place' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'link' => "/ingatlan/HZ503891",
                'site' => "DunaHouse",
                'image' => "https://cdn1.fs2.matrixhu.com/storage/production/fileID/5fc5c63bf4de3a05ee0ff4c4/fileVersionID/propertyPageImageNoCrop/fileVersionKey/IwYTUxOWE1OGI0YWJjZW",
                'price' => 13990000,
                'area' => 81,
            ]),
            ParsedProperty::make([
                'foreign_id' => "HZ342728",
                'name' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'place' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'link' => "/ingatlan/HZ342728",
                'site' => "DunaHouse",
                'image' => "https://cdn5.fs2.matrixhu.com/storage/production/fileID/5fc565acf4de3a08be45999d/fileVersionID/propertyPageImageNoCrop/fileVersionKey/ZkNjJmYjIwYjA3ODA2Mz",
                'price' => 30000000,
                'area' => 105,
            ]),
            ParsedProperty::make([
                'foreign_id' => "HZ474204",
                'name' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'place' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'link' => "/ingatlan/HZ474204",
                'site' => "DunaHouse",
                'image' => "https://cdn7.fs2.matrixhu.com/storage/production/fileID/5fc502c8f4de3a07da4a3622/fileVersionID/propertyPageImageNoCrop/fileVersionKey/MyYzgxOGQzNDk2MDBhMj",
                'price' => 29900000,
                'area' => 120,
            ]),
            ParsedProperty::make([
                'foreign_id' => "HZ417797",
                'name' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'place' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'link' => "/ingatlan/HZ417797",
                'site' => "DunaHouse",
                'image' => "https://cdn7.fs2.matrixhu.com/storage/production/fileID/5fc5cdf6f4de3a06300044f3/fileVersionID/propertyPageImageNoCrop/fileVersionKey/ExODRiNjhhYzhjZTA0Nj",
                'price' => 7990000,
                'area' => 90,
            ]),
            ParsedProperty::make([
                'foreign_id' => "HZ408761",
                'name' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'place' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'link' => "/ingatlan/HZ408761",
                'site' => "DunaHouse",
                'image' => "https://cdn9.fs2.matrixhu.com/storage/production/fileID/5fc5b19af4de3a061f7f3e69/fileVersionID/propertyPageImageNoCrop/fileVersionKey/I0OTI0YTYyZmU5MDk5OG",
                'price' => 28500000,
                'area' => 150,
            ]),
            ParsedProperty::make([
                'foreign_id' => "DH194482",
                'name' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'place' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'link' => "/ingatlan/DH194482",
                'site' => "DunaHouse",
                'image' => "https://dh.hu/files/uploads/d947260c1368c9eb30fb75b1d3f37dd6/medium/3.jpg",
                'price' => 23500000,
                'area' => 100,
            ]),
            ParsedProperty::make([
                'foreign_id' => "DH417744",
                'name' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'place' => "Eladó Ház, Borsod-Abaúj-Zemplén megye, Miskolc",
                'link' => "/ingatlan/DH417744",
                'site' => "DunaHouse",
                'image' => "https://dh.hu/files/uploads/3f02fbef17305e038e740db4f4e2f795/medium/k3.jpg",
                'price' => 29900000,
                'area' => 120,
            ]),
        ];
    }
}