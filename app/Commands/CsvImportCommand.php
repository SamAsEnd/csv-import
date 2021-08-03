<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;
use League\Csv\Exception;
use League\Csv\Reader;
use Symfony\Component\Console\Output\OutputInterface;

class CsvImportCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'csv:import {path}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Import a CSV file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = $this->argument('path');

        try {
            $csv = Reader::createFromPath($path);
            $csv->setHeaderOffset(0);

            $header = $csv->getHeader();
            $records = collect($csv->getRecords())
                ->map(fn($arr) => array_map('trim', $arr))
                ->toArray();

            $this->table($header, $records);
        } catch (Exception $ex) {
            $this->error('File does not exist!', OutputInterface::VERBOSITY_NORMAL);

            return -1;
        }
    }
}
