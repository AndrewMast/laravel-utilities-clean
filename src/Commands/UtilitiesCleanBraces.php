<?php

namespace AndrewMast\Laravel\Utilities\Clean\Commands;

class UtilitiesCleanBraces extends UtilitiesClean {
    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $name = 'util:clean-braces';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes whitespace and new lines before curly braces';

    /**
     * The completion message (%d = count, %s = file type)
     *
     * @var string
     */
    protected $message = 'Cleaned the braces in %d %s files.';

    /**
     * Cleans the provided content
     *
     * @param  string  $content
     * @return string
     */
    protected function clean(string $content) {
        return preg_replace('/[^\S\n]*\n[^\S\n]*{(\s+)/', ' {$1', $content);
    }
}
