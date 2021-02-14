<?php

namespace App\Console\Commands;

use App\Services\NewPropertySender;
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
    private $newPropertySender;


    public function __construct(NewPropertyParser $newPropertyParser, NewPropertySender $newPropertySender)
    {
        parent::__construct();
        $this->newPropertyParser = $newPropertyParser;
        $this->newPropertySender = $newPropertySender;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->newPropertyParser->parse();
        $this->newPropertySender->send();
    }
}
