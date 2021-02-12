<?php

declare(strict_types=1);

namespace App\Services;

use Psr\Log\LoggerInterface;

/**
 *
 */
class CliLogger implements LoggerInterface
{
    public function emergency($message, array $context = [])
    {
        \Log::emergency($message, $context);
    }


    public function alert($message, array $context = [])
    {
        \Log::alert($message, $context);
    }


    public function critical($message, array $context = [])
    {
        \Log::critical($message, $context);
    }


    public function error($message, array $context = [])
    {
        \Log::error($message, $context);
    }


    public function warning($message, array $context = [])
    {
        \Log::warning($message, $context);
    }


    public function notice($message, array $context = [])
    {
        \Log::notice($message, $context);
    }


    public function info($message, array $context = [])
    {
        \Log::info($message, $context);
    }


    public function debug($message, array $context = [])
    {
        \Log::debug($message, $context);
    }


    public function log($level, $message, array $context = [])
    {
        \Log::log($level, $message, $context);
    }

}