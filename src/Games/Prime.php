<?php

declare(strict_types=1);

namespace BrainGames\Games\Prime;

use function BrainGames\Engine\runEngine;

use const BrainGames\Engine\GAME_ROUNDS_COUNT;

const RAND_MIN_NUMBER = 1;
const RAND_MAX_NUMBER = 100;

const GAME_DESCRIPTION = 'Answer "yes" if given number is prime. Otherwise answer "no".';

/**
 * Run CLI application
 *
 * @return void
 */
function run()
{
    $gameData = [];
    for ($i = 0; $i < GAME_ROUNDS_COUNT; ++$i) {
        $num = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);

        $gameData[$i]['question'] = (string) $num;
        $gameData[$i]['right_answer'] = isPrime($num) ? 'yes' : 'no';
    }

    runEngine(GAME_DESCRIPTION, $gameData);
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
    if ($num == 2) {
        return true;
    }

    $isEven = $num % 2 === 0;
    if ($num < 2 || $isEven) {
        return false;
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
