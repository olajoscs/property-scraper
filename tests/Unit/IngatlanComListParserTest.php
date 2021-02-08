<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Property;
use App\Services\Parsers\IngatlanComListParser;
use Tests\TestCase;

/**
 * Test the parser of the ingatlan.com
 */
class IngatlanComListParserTest extends TestCase
{
    /**
     * @var string
     */
    private $html;


    public function test(): void
    {
        $parser = new IngatlanComListParser();

        $expected = [
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/19/6b/31944392_204459752_m.jpg',
                    'link' => '/nyekladhaza/elado+haz/csaladi-haz/31944392',
                    'price' => 24900000,
                    'place' => 'Holdfény utca, Nyékládháza',
                    'area' => 80,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/51/73/31939569_204405447_m.jpg',
                    'link' => '/nyekladhaza-napospart/elado+haz/csaladi-haz/31939569',
                    'price' => 35000000,
                    'place' => 'Nyékládháza, Napospart',
                    'area' => 95,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/e1/47/30646900_190325407_m.jpg',
                    'link' => '/nyekladhaza/elado+haz/csaladi-haz/30646900',
                    'price' => 19500000,
                    'place' => 'Nyékládháza',
                    'area' => 94,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/09/5d/31963686_204665201_m.jpg',
                    'link' => '/miskolc-szirma/elado+haz/csaladi-haz/31963686',
                    'price' => 27600000,
                    'place' => 'Miskolc, Szirma',
                    'area' => 100,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/97/03/31904064_203951027_m.jpg',
                    'link' => '/nyekladhaza/elado+haz/csaladi-haz/31904064',
                    'price' => 31900000,
                    'place' => 'Táncsics Mihály utca, Nyékládháza',
                    'area' => 95,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/78/94/31770322_202374434_m.jpg',
                    'link' => '/nyekladhaza/elado+haz/csaladi-haz/31770322',
                    'price' => 24900000,
                    'place' => 'Nyékládháza',
                    'area' => 80,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => null,
                    'link' => '/miskolc-szirma/elado+haz/csaladi-haz/32030441',
                    'price' => 34900000,
                    'place' => 'Mohostó utca, Miskolc',
                    'area' => 140,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/5e/f7/32017369_205275994_m.jpg',
                    'link' => '/malyi/elado+haz/csaladi-haz/32017369',
                    'price' => 12900000,
                    'place' => 'Mályi',
                    'area' => 89,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/7f/ce/32016974_205271798_m.jpg',
                    'link' => '/malyi/elado+haz/csaladi-haz/32016974',
                    'price' => 12900000,
                    'place' => 'Mályi',
                    'area' => 89,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/80/29/31972585_204772961_m.jpg',
                    'link' => '/malyi/elado+haz/sorhaz/31972585',
                    'price' => 31900000,
                    'place' => 'Mályi',
                    'area' => 95,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/85/d8/31948795_204504725_m.jpg',
                    'link' => '/malyi/elado+haz/sorhaz/31948795',
                    'price' => 29900000,
                    'place' => 'Mályi',
                    'area' => 95,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/7e/17/31935553_204355834_m.jpg',
                    'link' => '/nyekladhaza/elado+haz/csaladi-haz/31935553',
                    'price' => 24900000,
                    'place' => 'Nyékládháza',
                    'area' => 80,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/41/e3/31927629_204261946_m.jpg',
                    'link' => '/miskolc-szirma/elado+haz/csaladi-haz/31927629',
                    'price' => 27600000,
                    'place' => 'Miskolc, Szirma',
                    'area' => 100,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/fc/4d/31882396_204223978_m.jpg',
                    'link' => '/malyi/elado+haz/csaladi-haz/31882396',
                    'price' => 19500000,
                    'place' => 'Mályi',
                    'area' => 135,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/76/b3/31754723_202196946_m.jpg',
                    'link' => '/malyi/elado+haz/csaladi-haz/31754723',
                    'price' => 31900000,
                    'place' => 'Mályi',
                    'area' => 95,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://mt.ingatlancdn.com/61/62/117244687_m_0.jpg',
                    'link' => '/malyi/elado+haz/sorhaz/31732957',
                    'price' => 35000000,
                    'place' => 'Rákóczi utca, Mályi',
                    'area' => 108,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/2a/bd/31673955_201317494_m.jpg',
                    'link' => '/szirmabesenyo/elado+haz/csaladi-haz/31673955',
                    'price' => 9490000,
                    'place' => 'Széchenyi utca, Szirmabesenyő',
                    'area' => 107,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/e1/81/31615847_200693888_m.jpg',
                    'link' => '/malyi-uduloterulet/elado+haz/konnyuszerkezetes-haz/31615847',
                    'price' => 15900000,
                    'place' => 'Mályi, Üdülőterület',
                    'area' => 100,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
            Property::make(
                [
                    'image' => 'https://ot.ingatlancdn.com/7a/32/31484191_199254799_m.jpg',
                    'link' => '/szirmabesenyo/elado+haz/csaladi-haz/31484191',
                    'price' => 19800000,
                    'place' => 'Szirmabesenyő',
                    'area' => 90,
                    'name' => '',
                    'site' => 'ingatlan.com',
                ]
            ),
        ];

        $parsed = $parser->parse($this->html);

        $this->assertSameModels($expected, $parsed);
    }


    protected function setUp(): void
    {
        parent::setUp();
        $this->html = file_get_contents(__DIR__ . '/fixtures/ingatlan-com-list-page.html');
    }
}