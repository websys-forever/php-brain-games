<?php

declare(strict_types=1);

namespace BrainGames\Games\Nod;

use function BrainGames\Cli\processGameFlow;
use function BrainGames\Games\Common\getGameData;

use const BrainGames\Games\Common\{RAND_MIN_NUMBER, RAND_MAX_NUMBER};

const GAME_DESCRIPTION = <<<MESSAGE
Find the greatest common divisor of given numbers.\n
MESSAGE;

/**
 * Run CLI application
 *
 * @return void
 */
function run()
{
    $getQuestionValues = function (): array {
        return [
            'num1' => rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER),
            'num2' => rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER)
        ];
    };

    $getRightAnswer = function (array $questionValues): int {
        return gcd($questionValues['num1'], $questionValues['num2']);
    };

    $getQuestionMessage = function ($questionValues): string {
        return implode(' ', $questionValues);
    };

    $gameData = getGameData($getQuestionValues, $getRightAnswer, $getQuestionMessage);

    processGameFlow(GAME_DESCRIPTION, $gameData);
}

/**
 * Get greatest common divisor
 *
 * @param int $a first number
 * @param int $b second number
 *
 * @return int
 */
function gcd(int $a, int $b): int
{
    return ($a % $b) ? gcd($b, $a % $b) : abs($b);
}
