<?php

namespace ZakariaYacineBoucetta\LaravelFormBuilder\Commands;

use Illuminate\Console\Command;

class LaravelFormBuilderCommand extends Command
{
    public $signature = 'laravel-form-builder';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
