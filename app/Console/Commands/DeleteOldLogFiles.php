<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use OlajosCs\DateProvider\DateProvider;

class DeleteOldLogFiles extends Command
{
    private const PROTECTED = [
        '.', '..'//, '.gitignore', 'laravel.log',
    ];

    private const TTL = '3 days';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old log files';

    /**
     * @var DateProvider
     */
    private $dateProvider;


    public function __construct(DateProvider $dateProvider)
    {
        parent::__construct();
        $this->dateProvider = $dateProvider;
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $logFilePath = storage_path('logs');
        $directory = dir($logFilePath);
        $limit = $this->dateProvider->getNow()->modify('-' . self::TTL);

        while ($item = $directory->read()) {
            if (in_array($item, self::PROTECTED, true)) {
                continue;
            }

            $fileName = $logFilePath .'/'. $item;

            $fileTime = (new \DateTimeImmutable)->setTimestamp(\File::lastModified($fileName));

            if ($fileTime <= $limit) {
                \File::delete($fileName);
            }
        }
    }
}
