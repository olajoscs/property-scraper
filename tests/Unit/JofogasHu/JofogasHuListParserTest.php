<?php

declare(strict_types=1);

namespace Tests\Unit\JofogasHu;

use App\Models\ParsedProperty;
use App\Services\Parsers\JofogasHuListParser;
use PHPUnit\Framework\TestCase;
use Tests\Unit\SamePropertyModelAssert;

/**
 * Test the parser of the ingatlan.com
 */
class JofogasHuListParserTest extends TestCase
{
    use SamePropertyModelAssert;

    public function test_parse_list_page_properties(): void
    {
        $parser = new JofogasHuListParser();
        $html = file_get_contents(__DIR__ . '/fixtures/jofogas-hu-list-page.html');

        $expedtedParsedProducts = $this->getExpectedParsedProducts();
        $parsedList = $parser->parse($html);

        $this->assertSameModels($expedtedParsedProducts, $parsedList->parsedProperties);
        $this->assertFalse($parsedList->hasNextPage);
    }


    public function test_parse_list_page_properties_with_prev_and_next_page(): void
    {
        $parser = new JofogasHuListParser();
        $html = file_get_contents(__DIR__ . '/fixtures/jofogas-hu-list-page-with-next-prev-page.html');

        $parsedList = $parser->parse($html);

        $this->assertTrue($parsedList->hasNextPage);
    }


    public function test_parse_list_page_properties_with_prev_page(): void
    {
        $parser = new JofogasHuListParser();
        $html = file_get_contents(__DIR__ . '/fixtures/jofogas-hu-list-page-with-prev-page.html');

        $parsedList = $parser->parse($html);

        $this->assertFalse($parsedList->hasNextPage);
    }


    public function test_parse_list_page_properties_with_next_page(): void
    {
        $parser = new JofogasHuListParser();
        $html = file_get_contents(__DIR__ . '/fixtures/jofogas-hu-list-page-with-next-page.html');

        $parsedList = $parser->parse($html);

        $this->assertTrue($parsedList->hasNextPage);
    }


    private function getExpectedParsedProducts(): array
    {
        return [
            ParsedProperty::make(
                [
                    'foreign_id' => '82961066',
                    'name' => 'Soltész Nagy Kálmán utca',
                    'place' => 'Borsod-Abaúj-Zemplén  , Miskolc',
                    'link' => 'https://ingatlan.jofogas.hu/borsod_abauj_zemplen/82961066.htm',
                    'site' => 'ingatlan.jofogas.hu',
                    'image' => 'https://img.jofogas.hu/images/Soltesz_Nagy_Kalman_utca_908031882819160.jpg',
                    'price' => 28500000,
                    'area' => 150,
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '112582799',
                    'name' => 'Vasgyári temető közelében',
                    'place' => 'Borsod-Abaúj-Zemplén  , Miskolc',
                    'link' => 'https://ingatlan.jofogas.hu/borsod_abauj_zemplen/112582799.htm',
                    'site' => 'ingatlan.jofogas.hu',
                    'image' => 'https://img.jofogas.hu/images/Vasgyari_temeto_kozeleben_795591882839478.jpg',
                    'price' => 19900000,
                    'area' => 150,
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '113519612',
                    'name' => 'Eladó Miskolc Perecesen 150 m2-es 2 szintes szigetelt családiház',
                    'place' => 'Borsod-Abaúj-Zemplén  , Miskolc  , Pereces',
                    'link' => 'https://ingatlan.jofogas.hu/borsod_abauj_zemplen/113519612.htm',
                    'site' => 'ingatlan.jofogas.hu',
                    'image' => 'https://img.jofogas.hu/images/Elado_Miskolc_Perecesen_150_m2_es_2_szintes_szigetelt_csaladihaz_550871850192298.jpg',
                    'price' => 24900000,
                    'area' => 150,
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '110490962',
                    'name' => 'Eladó 150 nm-es ház Miskolc',
                    'place' => 'Borsod-Abaúj-Zemplén  , Miskolc  , Tatárdomb',
                    'link' => 'https://ingatlan.jofogas.hu/borsod_abauj_zemplen/110490962.htm',
                    'site' => 'ingatlan.jofogas.hu',
                    'image' => 'https://img.jofogas.hu/images/Elado_150_nm_es_haz_Miskolc_411611882865382.jpg',
                    'price' => 22500000,
                    'area' => 150,
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '39520043',
                    'name' => 'Miskolc, eladó családi ház',
                    'place' => 'Borsod-Abaúj-Zemplén  , Miskolc  , Újgyőri főtér',
                    'link' => 'https://ingatlan.jofogas.hu/borsod_abauj_zemplen/39520043.htm',
                    'site' => 'ingatlan.jofogas.hu',
                    'image' => 'https://img.jofogas.hu/images/Miskolc__elado_csaladi_haz_347611440473895.jpg',
                    'price' => 31500000,
                    'area' => 150,
                ]
            ),
            ParsedProperty::make(
                [
                    'foreign_id' => '109218299',
                    'name' => 'Miskolcon eladó egy 4 szobás családi ház !',
                    'place' => 'Borsod-Abaúj-Zemplén  , Miskolc  , Belváros',
                    'link' => 'https://ingatlan.jofogas.hu/borsod_abauj_zemplen/109218299.htm',
                    'site' => 'ingatlan.jofogas.hu',
                    'image' => 'https://img.jofogas.hu/images/Miskolcon_elado_egy_4_szobas_csaladi_haz___447551869508392.jpg',
                    'price' => 33000000,
                    'area' => 150,
                ]
            ),
        ];
    }
}