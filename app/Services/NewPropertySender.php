<?php

declare(strict_types=1);

namespace App\Services;

use App\Mail\NewPropertiesFoundMail;
use App\Models\Property;
use App\Repositories\PropertyRepository;
use Illuminate\Support\Collection;
use Psr\Log\LoggerInterface;

/**
 * Send emails about new properties
 */
class NewPropertySender
{
    private $propertyRepository;
    private $logger;
    private $siteProvider;
    private $emailRecipientProvider;


    public function __construct(PropertyRepository $propertyRepository, LoggerInterface $logger, SiteProvider $siteProvider, EmailRecipientProvider $emailRecipientProvider)
    {
        $this->propertyRepository = $propertyRepository;
        $this->logger = $logger;
        $this->siteProvider = $siteProvider;
        $this->emailRecipientProvider = $emailRecipientProvider;
    }


    /**
     * Send emails about new properties
     *
     * @return void
     */
    public function send(): void
    {
        $properties = $this->propertyRepository->findNewProperties();

        if ($properties->count() === 0) {
            $this->logger->info('No new property found, not sending email');
            return;
        }

        $this->logger->info($properties->count() . ' new property found, sending emails');

        $groupedProperties = $this->groupProperties($properties);
        $this->sendEmails($groupedProperties);
        $this->savePropertySending($groupedProperties);
    }


    /**
     * Group the new properties by site
     *
     * @param Collection $properties
     *
     * @return Property[][]|Collection
     */
    private function groupProperties(Collection $properties): Collection
    {
        return $properties->mapToGroups(function(Property $property) {
            return [$property->site => $property];
        });
    }


    /**
     * Send the emails about the properties
     *
     * @param Collection $groupedProperties
     *
     * @return void
     */
    private function sendEmails(Collection $groupedProperties): void
    {
        foreach ($this->emailRecipientProvider->getAll() as $recipient) {
            \Mail::to($recipient)->send(new NewPropertiesFoundMail($groupedProperties, $this->siteProvider));
        }
    }


    /**
     * Save that the properties were sent
     *
     * @param Collection $groupedProperties
     *
     * @return void
     */
    private function savePropertySending(Collection $groupedProperties): void
    {
        $groupedProperties->each(function (Collection $collection) {
            $collection->each(function (Property $property) {
                $property->sendable = false;
            });

            $this->propertyRepository->save(...$collection->all());
        });
    }
}
