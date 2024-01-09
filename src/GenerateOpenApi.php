<?php

namespace Dedoc\Scramble;

use Dedoc\Scramble\Generator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class GenerateOpenApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scramble:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate OpenAPI documentation';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Started generating OpenAPI documentation...');

        Cache::forget('openapi');

        $generator = app(Generator::class)->generate();
        
        Cache::forever('openapi', $generator);

        $this->info('OpenAPI documentation generated successfully.');

        return 0;
    }
}