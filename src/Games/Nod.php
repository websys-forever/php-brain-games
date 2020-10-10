<?php

declare(strict_types=1);

namespace BrainGames\Games\Nod;

use function BrainGames\Cli\processGameFlow;

const RAND_MIN_NUMBER = 1;
const RAND_MAX_NUMBER = 100;
const GAME_ROUNDS_COUNT = 3;

const GAME_DESCRIPTION = 'Find the greatest common divisor of given numbers.';

/**
 * Run CLI application
 *
 * @return void
 */
function run()
{
    $getRightAnswer = function (int $num1, int $num2): int {
        return gcd($num1, $num2);
    };

    $getQuestion = function (int $num1, int $num2): string {
        return "{$num1} {$num2}";
    };

    $gameData = [];
    for ($i = 0; $i < GAME_ROUNDS_COUNT; ++$i) {
        $num1 = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);
        $num2 = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);

        $gameData[$i]['question'] = $getQuestion($num1, $num2);
        $gameData[$i]['right_answer'] = $getRightAnswer($num1, $num2);
    }

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
