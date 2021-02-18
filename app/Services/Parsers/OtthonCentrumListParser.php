<?php

declare(strict_types=1);

namespace App\Services\Parsers;

use App\Models\ParsedProperty;
use App\Models\ParsedPropertyList;
use App\Models\Sites\OtthonCentrum;
use DOMWrap\Document;
use DOMWrap\Element;

/**
 * OtthonCentrum html parser
 */
class OtthonCentrumListParser implements ListParser
{
    public function parse(string $html): ParsedPropertyList
    {
        $document = new Document();
        $document->html($html);

        /** @var Element[] $items */
        $items = $document->find('.real-estate-list li');

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

        $property->site = OtthonCentrum::getSite();
        $property->link = $this->getUrl($item);
        $property->foreign_id = $this->getForeignId($property->link);
        $property->image = $this->getImage($item);
        $property->name = $this->getName($item);
        $property->price = $this->getPrice($item);
        $property->area = $this->getArea($item);
        $property->place = $this->getPlace($item);

        return $property;
    }


    private function getUrl(Element $item)
    {
        /** @var Element[] $links */
        $links = $item->find('.estate-list-item')->toArray();

        $link = reset($links);

        $href = $link->getAttribute('href');

        return substr($href, 0, strpos($href, '?'));
    }


    private function getForeignId(string $url): string
    {
        $parts = explode('/', $url);

        return array_pop($parts);
    }


    private function getImage(Element $item): ?string
    {
        /** @var Element[] $images */
        $images = $item->find('.estate-img')->toArray();

        $image = reset($images);

        if (!$image) {
            return null;
        }

        return $image->getAttribute('data-lazy-back');
    }


    private function getName(Element $item): string
    {
        /** @var Element[] $links */
        $links = $item->find('.estate-list-item')->toArray();

        $link = reset($links);

        return trim($link->getAttribute('title'));
    }


    private function getPrice(Element $item): int
    {
        /** @var Element[] $prices */
        $prices = $item->find('.estate-price')->toArray();

        $price = reset($prices);

        $priceString = trim($price->getText());
        $priceString = preg_replace('/[^\d,]/', '', $priceString);
        $priceString = str_replace(',', '.', $priceString);
        $price= (float)$priceString;

        return (int)($price * 1000000);
    }


    private function getArea(Element $item): int
    {
        /** @var Element[] $sizes */
        $sizes = $item->find('.estate-size')->toArray();

        $size = reset($sizes);

        $sizeString = trim($size->getText());
        $sizeString = preg_replace('/\sm2/', '', $sizeString);

        return (int)$sizeString;
    }


    public function getPlace(Element $item): string
    {
        /** @var Element[] $locations */
        $locations = $item->find('.estate-title-new')->toArray();

        $location = reset($locations);

        return trim(preg_replace('/\s{2,}/', ' ', $location->getText()));
    }


    private function hasNextPageLink(Document $document): bool
    {
        /** @var Element[] $paginations */
        $paginations = $document->find('#pagination')->toArray();

        $pagination = reset($paginations);

        $nextLinks = $pagination->find('.next a')->toArray();

        return count($nextLinks) > 0;
    }
}
