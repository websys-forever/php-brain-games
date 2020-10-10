<?php

declare(strict_types=1);

namespace BrainGames\Games\Prime;

use function BrainGames\Cli\processGameFlow;

const RAND_MIN_NUMBER = 1;
const RAND_MAX_NUMBER = 100;
const GAME_ROUNDS_COUNT = 3;

const GAME_DESCRIPTION = 'Answer "yes" if given number is prime. Otherwise answer "no".';

/**
 * Run CLI application
 *
 * @return void
 */
function run()
{
    $getRightAnswer = function (int $num): string {
        return isPrime($num) ? 'yes' : 'no';
    };

    $getQuestion = function ($num): string {
        return (string) $num;
    };

    $gameData = [];
    for ($i = 0; $i < GAME_ROUNDS_COUNT; ++$i) {
        $num = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);

        $gameData[$i]['question'] = $getQuestion($num);
        $gameData[$i]['right_answer'] = $getRightAnswer($num);
    }

    processGameFlow(GAME_DESCRIPTION, $gameData);
}

/**
 * Check that number is prime
 *
 * @param $num int
 *
 * @return bool
 */
function isPrime(int $num): bool
{
    if ($num < 2
        || $num % 2 === 0
    ) {
        return false;
    }

    if ($num == 2) {
        return true;
    }

    $i = 3;
    $numberSquareRoot = (int) sqrt($num);
    while ($i <= $numberSquareRoot) {
        if ($num % $i == 0) {
            return false;
        }
        $i += 2;
    }

    return true;
}
