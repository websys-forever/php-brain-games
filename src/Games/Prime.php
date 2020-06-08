<?php

declare(strict_types=1);

namespace BrainGames\Games\Prime;

use const BrainGames\Common\{RAND_MIN_NUMBER, RAND_MAX_NUMBER};

const GAME_DESCRIPTION = <<<MESSAGE
Answer "yes" if given number is prime. Otherwise answer "no".\n
MESSAGE;

/**
 * Get game's description
 *
 * @return string
 */
function getDescription(): string
{
    return GAME_DESCRIPTION;
}

/**
 * Get random number
 *
 * @return int
 */
function getQuestionValues(): int
{
    return rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);
}

/**
 * Get game's right answer
 *
 * @param int $questionNumber question's values
 *
 * @return string
 */
function getRightAnswer(int $questionNumber): string
{
    return isPrime($questionNumber) ? 'yes' : 'no';
}

/**
 * Get question message
 *
 * @param $questionNumber mixed question values
 *
 * @return string
 */
function getQuestionMessage($questionNumber): string
{
    return (string) $questionNumber;
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
