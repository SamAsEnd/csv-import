<?php

namespace App\Commands;

use App\Models\Person;
use Illuminate\Support\Facades\File;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class CsvImportCustomCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'csv:import-custom {path}';

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
            $lazyCollection = File::lines($path)
                ->map(fn($str) => explode(';', $str))
                ->skip(1)
                ->mapInto(Person::class);

            $this->table(
                ['Name', 'Address', 'Phone', 'Tags', 'ID'],
                $lazyCollection->toArray()
            );
        } catch (Throwable $ex) {
            $this->error('File does not exist!', OutputInterface::VERBOSITY_NORMAL);

            return -1;
        }
    }
}
