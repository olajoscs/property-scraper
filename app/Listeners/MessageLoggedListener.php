<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Log\Events\MessageLogged;
use Illuminate\Queue\InteractsWithQueue;
use Symfony\Component\Console\Output\ConsoleOutput;

class MessageLoggedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(MessageLogged $event)
    {
        if (app()->runningInConsole()) {
            $output = new ConsoleOutput();
            $output->writeln($event->message);
        }
    }
}
