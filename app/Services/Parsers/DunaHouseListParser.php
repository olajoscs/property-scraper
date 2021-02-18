<?php

declare(strict_types=1);

namespace App\Services\Parsers;

use App\Models\ParsedProperty;
use App\Models\ParsedPropertyList;
use App\Models\Sites\DunaHouse;
use DOMWrap\Document;
use DOMWrap\Element;

/**
 * DunaHouse html parser
 */
class DunaHouseListParser implements ListParser
{
    public function parse(string $html): ParsedPropertyList
    {
        $document = new Document();
        $document->html($html);

        /** @var Element[] $items */
        $items = $document->find('.propertyListItem');

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

        $property->site = DunaHouse::getSite();
        $property->link = $this->getUrl($item);
        $property->foreign_id = $this->getForeignId($property->link);
        $property->image = $this->getImage($item);
        $property->name = $this->getName($item);
        $property->price = $this->getPrice($item);
        $property->area = $this->getArea($item);
        $property->place = $property->name;

        return $property;
    }


    private function getUrl(Element $item)
    {
        /** @var Element[] $links */
        $links = $item->find('.moreDetailsBox a')->toArray();

        $link = reset($links);

        $href = $link->getAttribute('href');

        $parts = explode('/', $href);
        array_pop($parts);

        return implode('/', $parts);
    }


    private function getForeignId(string $url): string
    {
        $parts = explode('/', $url);

        return array_pop($parts);
    }


    private function getImage(Element $item): string
    {
        /** @var Element[] $images */
        $images = $item->find('.picBox a img')->toArray();

        $image = reset($images);

        return $image->getAttribute('src');
    }


    private function getName(Element $item): string
    {
        /** @var Element[] $h2s */
        $h2s = $item->find('h2')->toArray();

        $h2 = reset($h2s);

        return trim($h2->getText());
    }


    private function getPrice(Element $item): int
    {
        /** @var Element[] $prices */
        $prices = $item->find('.priceBox span')->toArray();

        $price = reset($prices);

        return (int)preg_replace('/\D/', '', $price->getText());
    }


    private function getArea(Element $item): int
    {
        /** @var Element[] $sizes */
        $sizes = $item->find('li.size .value')->toArray();

        $size = reset($sizes);

        return (int)preg_replace(['/\<sup\>2\<\/sup\>/', '/\D/'], '', $size->getHtml());
    }


    private function hasNextPageLink(Document $document): bool
    {
        /** @var Element[] $paginations */
        $paginations = $document->find('.propertypagination')->toArray();
        $pagination = reset($paginations);

        /** @var Element[] $buttons */
        $buttons = $pagination->find('button')->toArray();
        $nextButtons = array_filter(
            $buttons,
            function (Element $button) {
                return stripos($button->getText(), 'Következő') !== false && !$button->hasAttribute('disabled');
            }
        );

        return count($nextButtons) > 0;
    }
}
