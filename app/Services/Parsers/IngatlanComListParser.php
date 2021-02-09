<?php

declare(strict_types=1);

namespace App\Services\Parsers;

use App\Models\ParsedProperty;
use App\Models\Sites\Sites;
use DOMWrap\Document;
use DOMWrap\Element;

/**
 * Ingatlan.com html parser
 */
class IngatlanComListParser
{
    /**
     * Parse the html of an Ingatlan.com site then create ParsedProperty objects
     *
     * @param string $html
     *
     * @return ParsedProperty[]
     */
    public function parse(string $html): array
    {
        $document = new Document();
        $document->html($html);

        /** @var Element[] $items */
        $items = $document->find('.listing__card');

        $properties = [];
        foreach ($items as $item) {
            $properties[] = $this->createParsedPropertyFromItem($item);
        }

        return array_map(
            function (ParsedProperty $property) {
                $property->name = '';
                $property->site = Sites::INGATLAN_COM;

                return $property;
            },
            $properties
        );
    }


    private function createParsedPropertyFromItem(Element $item): ParsedProperty
    {
        $property = new ParsedProperty();

        $links = $item->find('a')->toArray();
        foreach ($links as $link) {
            $this->fillFromLink($property, $link);
        }

        return $property;
    }


    private function fillFromLink(ParsedProperty $property, Element $link): void
    {
        if ($link->hasClass('listing__thumbnail')) {
            $this->fillImage($property, $link);
        } else {
            $this->fillProperties($property, $link);
        }
    }


    private function fillImage(ParsedProperty $property, Element $link): void
    {
        $property->image = $this->getImageUrl($link);
    }


    private function getImageUrl(Element $link): ?string
    {
        $images = $link->find('img')->toArray();
        $image = reset($images);

        return $image ? $image->attr('src') : null;
    }


    private function fillProperties(ParsedProperty $property, Element $link): void
    {
        $property->link = $this->getLink($link);
        $property->price = $this->getPrice($link);
        $property->place = $this->getPlace($link);
        $property->area = $this->getArea($link);
        $property->foreignId = $this->getForeignId($link);
    }


    private function getLink(Element $link): string
    {
        return $link->attr('href');
    }


    private function getPrice(Element $link): int
    {
        $priceText = $link->find('.price')->first()->getText();

        /** @var float $price */
        $price = preg_replace('/[^\d\.]/', '', $priceText);

        return (int)($price * 1000000);
    }


    private function getPlace(Element $link): string
    {
        return trim($link->find('.listing__address')->first()->getText());
    }


    private function getArea(Element $link): int
    {
        $area = $link->find('.listing__data--area-size')->first()->getText();

        return (int)trim(preg_replace('/\D/', '', $area));
    }


    private function getForeignId(Element $link): string
    {
        $url = $this->getLink($link);

        $parts = explode('/', $url);

        return end($parts);
    }
}
