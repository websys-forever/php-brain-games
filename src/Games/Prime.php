<?php

declare(strict_types=1);

namespace BrainGames\Games\Prime;

use function BrainGames\Cli\processGameFlow;
use function BrainGames\Games\Common\getGameData;

use const BrainGames\Games\Common\{RAND_MIN_NUMBER, RAND_MAX_NUMBER};

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
    $getQuestionNumber = function (): int {
        return rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);
    };

    $getRightAnswer = function (int $questionNumber): string {
        return isPrime($questionNumber) ? 'yes' : 'no';
    };

    $getQuestionMessage = function ($questionNumber): string {
        return (string) $questionNumber;
    };

    $gameData = getGameData($getQuestionNumber, $getRightAnswer, $getQuestionMessage);

    processGameFlow(GAME_DESCRIPTION, $gameData);
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
    if ($number < 2 || $number % 2 == 0) {
        return false;
    }

    if ($number == 2) {
        return true;
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
