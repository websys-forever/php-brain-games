<?php

declare(strict_types=1);

namespace BrainGames\Games\Even;

use function BrainGames\Cli\processGameFlow;

use const BrainGames\Common\{RAND_MIN_NUMBER, RAND_MAX_NUMBER};

const GAME_DESCRIPTION = <<<MESSAGE
Answer "yes" if the number is even, otherwise answer "no".\n
MESSAGE;

/**
 * Run CLI application
 *
 * @return void
 */
function run()
{
    $questionNumber = function (): int {
        return rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);
    };
    $rightAnswer = function (int $questionNumber): string {
        return ($questionNumber % 2) === 0 ? 'yes' : 'no';
    };
    $questionMessage = function ($questionNumber): string {
        return (string) $questionNumber;
    };

    processGameFlow(GAME_DESCRIPTION, $questionNumber, $rightAnswer, $questionMessage);
}