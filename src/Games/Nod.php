<?php

declare(strict_types=1);

namespace BrainGames\Games\Nod;

use function BrainGames\Engine\runGamesEngine;

use const BrainGames\Engine\GAME_ROUNDS_COUNT;

const RAND_MIN_NUMBER = 1;
const RAND_MAX_NUMBER = 100;

const GAME_DESCRIPTION = 'Find the greatest common divisor of given numbers.';

/**
 * Run CLI application
 *
 * @return void
 */
function run()
{
    $gameData = [];
    for ($i = 0; $i < GAME_ROUNDS_COUNT; ++$i) {
        $num1 = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);
        $num2 = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);

        $gameData[$i]['question'] = "{$num1} {$num2}";
        $gameData[$i]['right_answer'] = gcd($num1, $num2);
    }

    runGamesEngine(GAME_DESCRIPTION, $gameData);
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
