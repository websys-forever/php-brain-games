<?php

declare(strict_types=1);

namespace BrainGames\Games\Prime;

use function BrainGames\Cli\processGameFlow;
use const BrainGames\Common\{RAND_MIN_NUMBER, RAND_MAX_NUMBER};

const GAME_DESCRIPTION = <<<MESSAGE
Answer "yes" if given number is prime. Otherwise answer "no".\n
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
        return isPrime($questionNumber) ? 'yes' : 'no';
    };

    $questionMessage = function ($questionNumber): string {
        return (string) $questionNumber;
    };

    processGameFlow(GAME_DESCRIPTION, $questionNumber, $rightAnswer, $questionMessage);
}

/**
 * Check that number is prime
 *
 * @param $number int
 *
 * @return bool
 */
function isPrime(int $number): bool
{
    if ($number == 2) {
        return true;
    }
    if ($number % 2 == 0) {
        return false;
    }

    $i = 3;
    $numberSquareRoot = (int) sqrt($number);
    while ($i <= $numberSquareRoot) {
        if ($number % $i == 0) {
            return false;
        }
        $i += 2;
    }

    return true;
}
