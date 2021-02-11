<?php

namespace App\Console\Commands;

use App\Services\Parsers\NewPropertyParser;
use Illuminate\Console\Command;

class PropertySearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'property:search';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the search for new or update properties';

    private $newPropertyParser;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(NewPropertyParser $newPropertyParser)
    {
        parent::__construct();
        $this->newPropertyParser = $newPropertyParser;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $siteClasses = \Config::get('app.sites');

        $this->newPropertyParser->parse($siteClasses);
    }
}
