<?php

declare(strict_types=1);

namespace BrainGames\Games\Nod;

use const BrainGames\Common\{RAND_MIN_NUMBER, RAND_MAX_NUMBER};

const GAME_DESCRIPTION = <<<MESSAGE
Find the greatest common divisor of given numbers.\n
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
 * Get game's question
 *
 * @return array
 */
function getQuestionValues(): array
{
    return [
        'num1' => rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER),
        'num2' => rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER)
    ];
}

/**
 * Get game's right answer
 *
 * @param array $questionValues question's values
 *
 * @return int
 */
function getRightAnswer(array $questionValues): int
{
    return gcd($questionValues['num1'], $questionValues['num2']);
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
