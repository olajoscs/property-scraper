<?php

declare(strict_types=1);

namespace Tests\Unit\IngatlanCom;

use App\Models\ParsedProperty;
use App\Services\Parsers\IngatlanComListParser;
use PHPUnit\Framework\TestCase;

/**
 * Test the parser of the ingatlan.com
 */
class IngatlanComListParserTest extends TestCase
{
    public function test_parse_list_page_properties(): void
    {
        $parser = new IngatlanComListParser();
        $html = file_get_contents(__DIR__ . '/fixtures/ingatlan-com-list-page.html');

        $expedtedParsedProducts = $this->getExpectedParsedProducts();
        $parsedList = $parser->parse($html);

        $this->assertSameModels($expedtedParsedProducts, $parsedList->parsedProperties);
        $this->assertFalse($parsedList->hasNextPage);
    }


    public function test_parse_list_page_properties_with_prev_and_next_page(): void
    {
        $parser = new IngatlanComListParser();
        $html = file_get_contents(__DIR__ . '/fixtures/ingatlan-com-list-page-with-next-prev-page.html');

        $expedtedParsedProducts = $this->getExpectedParsedProducts();
        $parsedList = $parser->parse($html);

        $this->assertSameModels($expedtedParsedProducts, $parsedList->parsedProperties);
        $this->assertTrue($parsedList->hasNextPage);
    }


    public function test_parse_list_page_properties_with_prev_page(): void
    {
        $parser = new IngatlanComListParser();
        $html = file_get_contents(__DIR__ . '/fixtures/ingatlan-com-list-page-with-prev-page.html');

        $expedtedParsedProducts = $this->getExpectedParsedProducts();
        $parsedList = $parser->parse($html);

        $this->assertSameModels($expedtedParsedProducts, $parsedList->parsedProperties);
        $this->assertFalse($parsedList->hasNextPage);
    }


    public function test_parse_list_page_properties_with_next_page(): void
    {
        $parser = new IngatlanComListParser();
        $html = file_get_contents(__DIR__ . '/fixtures/ingatlan-com-list-page-with-next-page.html');

        $expedtedParsedProducts = $this->getExpectedParsedProducts();
        $parsedList = $parser->parse($html);

        $this->assertSameModels($expedtedParsedProducts, $parsedList->parsedProperties);
        $this->assertTrue($parsedList->hasNextPage);
    }


    /**
     * Assert that the attributes of the models are same
     *
     * @param ParsedProperty[] $expected
     * @param ParsedProperty[] $actual
     *
     * @return void
     */
    protected function assertSameModels(array $expected, array $actual): void
    {
        $this->assertSame(
            array_map(
                function (ParsedProperty $property) {
                    return (array)$property;
                },
                $expected
            ),
            array_map(
                function (ParsedProperty $property) {
                    return (array)$property;
                },
                $actual
            )
        );
    }


    private function getExpectedParsedProducts(): array
    {
        return [
            ParsedProperty::make(
                [
                    'foreign_id' => '31944392',
                    'image' => 'https://ot.ingatlancdn.com/19/6b/31944392_204459752_m.jpg',
                    'link' => '/31944392',
                    'price' => 24900000,
                    'place' => 'Holdfény utca, Nyékládháza',
                    'area' => 80,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '31939569',
                    'image' => 'https://ot.ingatlancdn.com/51/73/31939569_204405447_m.jpg',
                    'link' => '/31939569',
                    'price' => 35000000,
                    'place' => 'Nyékládháza, Napospart',
                    'area' => 95,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '30646900',
                    'image' => 'https://ot.ingatlancdn.com/e1/47/30646900_190325407_m.jpg',
                    'link' => '/30646900',
                    'price' => 19500000,
                    'place' => 'Nyékládháza',
                    'area' => 94,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '31963686',
                    'image' => 'https://ot.ingatlancdn.com/09/5d/31963686_204665201_m.jpg',
                    'link' => '/31963686',
                    'price' => 27600000,
                    'place' => 'Miskolc, Szirma',
                    'area' => 100,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '31904064',
                    'image' => 'https://ot.ingatlancdn.com/97/03/31904064_203951027_m.jpg',
                    'link' => '/31904064',
                    'price' => 31900000,
                    'place' => 'Táncsics Mihály utca, Nyékládháza',
                    'area' => 95,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '31770322',
                    'image' => 'https://ot.ingatlancdn.com/78/94/31770322_202374434_m.jpg',
                    'link' => '/31770322',
                    'price' => 24900000,
                    'place' => 'Nyékládháza',
                    'area' => 80,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '32030441',
                    'image' => null,
                    'link' => '/32030441',
                    'price' => 34900000,
                    'place' => 'Mohostó utca, Miskolc',
                    'area' => 140,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '32017369',
                    'image' => 'https://ot.ingatlancdn.com/5e/f7/32017369_205275994_m.jpg',
                    'link' => '/32017369',
                    'price' => 12900000,
                    'place' => 'Mályi',
                    'area' => 89,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '32016974',
                    'image' => 'https://ot.ingatlancdn.com/7f/ce/32016974_205271798_m.jpg',
                    'link' => '/32016974',
                    'price' => 12900000,
                    'place' => 'Mályi',
                    'area' => 89,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '31972585',
                    'image' => 'https://ot.ingatlancdn.com/80/29/31972585_204772961_m.jpg',
                    'link' => '/31972585',
                    'price' => 31900000,
                    'place' => 'Mályi',
                    'area' => 95,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '31948795',
                    'image' => 'https://ot.ingatlancdn.com/85/d8/31948795_204504725_m.jpg',
                    'link' => '/31948795',
                    'price' => 29900000,
                    'place' => 'Mályi',
                    'area' => 95,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '31935553',
                    'image' => 'https://ot.ingatlancdn.com/7e/17/31935553_204355834_m.jpg',
                    'link' => '/31935553',
                    'price' => 24900000,
                    'place' => 'Nyékládháza',
                    'area' => 80,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '31927629',
                    'image' => 'https://ot.ingatlancdn.com/41/e3/31927629_204261946_m.jpg',
                    'link' => '/31927629',
                    'price' => 27600000,
                    'place' => 'Miskolc, Szirma',
                    'area' => 100,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '31882396',
                    'image' => 'https://ot.ingatlancdn.com/fc/4d/31882396_204223978_m.jpg',
                    'link' => '/31882396',
                    'price' => 19500000,
                    'place' => 'Mályi',
                    'area' => 135,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '31754723',
                    'image' => 'https://ot.ingatlancdn.com/76/b3/31754723_202196946_m.jpg',
                    'link' => '/31754723',
                    'price' => 31900000,
                    'place' => 'Mályi',
                    'area' => 95,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '31732957',
                    'image' => 'https://mt.ingatlancdn.com/61/62/117244687_m_0.jpg',
                    'link' => '/31732957',
                    'price' => 35000000,
                    'place' => 'Rákóczi utca, Mályi',
                    'area' => 108,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '31673955',
                    'image' => 'https://ot.ingatlancdn.com/2a/bd/31673955_201317494_m.jpg',
                    'link' => '/31673955',
                    'price' => 9490000,
                    'place' => 'Széchenyi utca, Szirmabesenyő',
                    'area' => 107,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '31615847',
                    'image' => 'https://ot.ingatlancdn.com/e1/81/31615847_200693888_m.jpg',
                    'link' => '/31615847',
                    'price' => 15900000,
                    'place' => 'Mályi, Üdülőterület',
                    'area' => 100,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '31484191',
                    'image' => 'https://ot.ingatlancdn.com/7a/32/31484191_199254799_m.jpg',
                    'link' => '/31484191',
                    'price' => 19800000,
                    'place' => 'Szirmabesenyő',
                    'area' => 90,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
        ];
    }
}