<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

class FixStyle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:style';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs php-cs-fixer and barryvdh/laravel-ide-helper';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /**
         * @see https://github.com/stechstudio/Laravel-PHP-CS-Fixer
         * @see https://github.com/barryvdh/laravel-ide-helper
         */
        $commands = [
            ['cmd' => 'ide-helper:generate', 'args' => []],
            ['cmd' => 'ide-helper:meta', 'args' => []],
            ['cmd' => 'ide-helper:models', 'args' => ['--nowrite' => true]],
            ['cmd' => 'fixer:fix', 'args' => []]
        ];

        $this->withProgressBar($commands, function ($command) {
            $this->call($command['cmd'], $command['args']);
        });

        return 0;
    }
}
