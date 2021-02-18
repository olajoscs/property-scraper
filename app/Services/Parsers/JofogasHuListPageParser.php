<?php

declare(strict_types=1);

namespace App\Services\Parsers;

use App\Models\ParsedProperty;
use App\Models\ParsedPropertyList;
use App\Models\Sites\JofogasHu;
use DOMWrap\Document;
use DOMWrap\Element;

/**
 * Ingatlan.jofogas.hu html parser
 */
class JofogasHuListPageParser implements ListParser
{
    public function parse(string $html): ParsedPropertyList
    {
        $document = new Document();
        $document->html($html);

        /** @var Element[] $items */
        $items = $document->find('.reListItem');

        $properties = [];
        foreach ($items as $item) {
            $properties[] = $this->createParsedPropertyFromItem($item);
        }

        $hasNextPage = $this->hasNextPageLink($document);

        return new ParsedPropertyList($properties, $hasNextPage);
    }


    private function createParsedPropertyFromItem(Element $item): ParsedProperty
    {
        $property = new ParsedProperty();

        $property->site = JofogasHu::getSite();
        $property->foreign_id = $this->getForeignId($item);
        $property->link = $this->getUrl($item);
        $property->image = $this->getImage($item);
        $property->name = $this->getName($item);
        $property->price = $this->getPrice($item);
        $property->area = $this->getArea($item);
        $property->place = $this->getPlace($item);

        return $property;
    }


    private function getForeignId(Element $item): string
    {
        $idAttribute = $item->getAttribute('id');

        return preg_replace('/\D/', '', $idAttribute);
    }


    private function getUrl(Element $item): string
    {
        $urls = array_map(
            function (Element $element) {
                return $element->getAttribute('href');
            },
            $item->find('.imageBox a')->toArray()
        );

        $url = reset($urls);

        $parts = explode('/', $url);
        $idPart = array_pop($parts);

        preg_match('/\d+\.htm/', $idPart, $result);

        if (count($result) === 0) {
            return $url;
        }

        return implode('/', array_merge($parts, $result));
    }


    private function getImage(Element $item): ?string
    {
        $images = array_map(
            function (Element $element) {
                return $element->getAttribute('content');
            },
            $item->find('meta[itemprop|="image"]')->toArray()
        );

        return count($images) > 0 ? reset($images) : null;
    }


    private function getName(Element $item): string
    {
        $names = array_map(
            function (Element $element) {
                return $element->getAttribute('content');
            },
            $item->find('meta[itemprop|="name"]')->toArray()
        );

        return reset($names);
    }


    private function getPrice(Element $item): int
    {
        $prices = $item->find('.price-value')->toArray();

        return (int)reset($prices)->getAttribute('content');
    }


    private function getArea(Element $item): int
    {
        $areas = $item->find('.sizeRooms')->toArray();
        $areaContainer = reset($areas);
        $sizes = $areaContainer->find('.size')->toArray();

        $size = reset($sizes);

        return (int)preg_replace('/\D/', '', $size->getText());
    }


    private function getPlace(Element $item): string
    {
        $cityNames = $item->find('.cityname')->toArray();

        return trim(reset($cityNames)->getText());
    }


    private function hasNextPageLink(Document $document): bool
    {
        $rightLinks = $document->find('.ad-list-pager-item-next')->toArray();

        $filteredRightLInks = array_filter(
            $rightLinks,
            function (ELement $item) {
                return $item->hasAttr('href');
            }
        );

        return count($filteredRightLInks) > 0;
    }
}
