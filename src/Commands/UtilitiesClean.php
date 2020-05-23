<?php

namespace AndrewMast\Laravel\Utilities\Clean\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputOption;

abstract class UtilitiesClean extends Command {
    /**
     * The completion message (%d = count, %s = file type)
     *
     * @var string
     */
    protected $message = 'Cleaned %d %s files.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $this->info(sprintf(
            $this->message,
            $this->cleanFiles('app'),
            'php'
        ));

        if ($this->option('stubs')) {
            $this->callSilent('stub:publish');

            $this->info(sprintf(
                $this->message,
                $this->cleanFiles('stubs', 'stub'),
                'stub'
            ));
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return [
            new InputOption('stubs', null, InputOption::VALUE_NONE, 'Whether to publish and include stubs in the clean'),
        ];
    }

    /**
     * Cleans the provided files
     *
     * @param  string  $dir
     * @param  string  $extension
     * @return int
     */
    protected function cleanFiles(string $dir, string $extension = 'php') {
        $files = File::allFiles(base_path($dir));

        $count = 0;

        foreach ($files as $file) {
            if ($file->getExtension() === $extension) {
                file_put_contents(
                    $file->getPathname(),
                    $this->clean(str_replace("\r\n", "\n", file_get_contents($file->getPathname())))
                );

                $count++;
            }
        }

        return $count;
    }

    /**
     * Cleans the provided content
     *
     * @param  string  $content
     * @return string
     */
    protected function clean(string $content) {
        return $content;
    }
}
