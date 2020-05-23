<?php

namespace AndrewMast\Laravel\Utilities\Clean\Commands;

class UtilitiesCleanAll extends UtilitiesClean {
    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $name = 'util:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs all of the cleans';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $this->callClean('braces');
        $this->callClean('uses');
    }

    /**
     * Runs a clean command
     *
     * @param  string  $command
     * @return void
     */
    public function callClean(string $command) {
        $this->call(
            sprintf('util:clean-%s', $command),
            $this->option('stubs') ? ['--stubs' => true] : []
        );
    }
}
