<?php

namespace App\Mail;

use App\Models\Sites\Site;
use App\Services\SiteProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class NewPropertiesFoundMail extends Mailable
{
    use Queueable, SerializesModels;

    private $groupedProperties;
    private $siteProvider;


    public function __construct(Collection $groupedProperties, SiteProvider $siteProvider)
    {
        $this->groupedProperties = $groupedProperties;
        $this->siteProvider = $siteProvider;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $linkGenerator = function (string $link, Site $site) {
            if (strpos($link, 'https') !== false) {
                return $link;
            }

            return $site::getDomain() . $link;
        };

        return $this
            ->from(\Config::get('mail.from.address'), \Config::get('mail.from.name'))
            ->subject(__('mail.new_properties_found_title', ['count' => $this->countPropertes()]))
            ->with('groupedProperties', $this->groupedProperties)
            ->with('sites', $this->siteProvider->getAll())
            ->with('linkGenerator', $linkGenerator)
            ->view('mail.new-properties-found');
    }


    private function countPropertes(): int
    {
        $count = 0;
        foreach ($this->groupedProperties as $groupedProperty) {
            $count += count($groupedProperty);
        }

        return $count;
    }
}
