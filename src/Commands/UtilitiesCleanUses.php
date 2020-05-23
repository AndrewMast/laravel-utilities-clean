<?php

namespace AndrewMast\Laravel\Utilities\Clean\Commands;

class UtilitiesCleanUses extends UtilitiesClean {
    /**
     * The name of the console command.
     *
     * @var string
     */
    protected $name = 'util:clean-uses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans and sorts use statements';

    /**
     * The completion message (%d = count, %s = file type)
     *
     * @var string
     */
    protected $message = 'Cleaned the use statements in %d %s files.';

    /**
     * Cleans the provided content
     *
     * @param  string  $content
     * @return string
     */
    protected function clean(string $content) {
        return preg_replace_callback('/(?:\r?\nuse [^;]+;)+/', fn($matches) => $this->sortUses($matches[0]), $content);
    }

    /**
     * Sorts the provided uses
     *
     * @param  string  $uses
     * @return string
     */
    protected function sortUses(string $uses) {
        preg_match_all('/use ([^;]+);/', $uses, $matches);

        return collect($matches[1])
            ->sort(function($a, $b) {
                if (substr($a, 0, 2) === '{{') {
                    $a = '0000' . $a;
                }

                if (substr($b, 0, 2) === '{{') {
                    $b = '0000' . $b;
                }

                return $a <=> $b;
            })
            ->map(fn($s) => sprintf("\nuse %s;", $s))
            ->implode('');
    }
}
