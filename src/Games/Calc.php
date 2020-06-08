<?php

declare(strict_types=1);

namespace BrainGames\Games\Calc;

use const BrainGames\Common\{RAND_MIN_NUMBER, RAND_MAX_NUMBER};

const GAME_DESCRIPTION = <<<MESSAGE
What is the result of the expression?\n
MESSAGE;

const OPERATIONS = ['+', '-', '*'];

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
    $num1 = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);
    $num2 = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);
    $randKey = array_rand(OPERATIONS);
    $operation = OPERATIONS[$randKey];

    return [
        'num1' => $num1,
        'operation' => $operation,
        'num2' => $num2
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
    switch ($questionValues['operation']) {
        case '+':
            $result = $questionValues['num1'] + $questionValues['num2'];

            break;
        case '-':
            $result = $questionValues['num1'] - $questionValues['num2'];

            break;
        case '*':
            $result = $questionValues['num1'] * $questionValues['num2'];

            break;
    }

    return $result;
}

/**
 * Get question message
 *
 * @param $questionValues mixed question values
 *
 * @return string
 */
function getQuestionMessage($questionValues): string
{
    return implode(' ', $questionValues);
}
