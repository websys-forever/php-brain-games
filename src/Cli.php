<?php

declare(strict_types=1);

namespace BrainGames\Cli;

use function Cli\{out, prompt};
use function BrainGames\Games\Even\{getDescription, runGameProcess};

/**
 * Run CLI application
 *
 * @return void
 * @throws \Exception
 */
function run()
{
    try {
        out("Welcome to the Brain Games!\n");
        out(getDescription());

        $userName = prompt("May I have your name?");
        out("Hello, {$userName}\n");

        $result = runGameProcess($userName);
        out($result);
    } catch (\Throwable $e) {
        out("Error: {$e->getMessage()}\n");
        return $e->getCode();
    }
}
