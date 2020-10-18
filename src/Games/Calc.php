<?php

declare(strict_types=1);

namespace BrainGames\Games\Calc;

use function BrainGames\Engine\runEngine;

use const BrainGames\Engine\GAME_ROUNDS_COUNT;

const RAND_MIN_NUMBER = 1;
const RAND_MAX_NUMBER = 100;

const GAME_DESCRIPTION = 'What is the result of the expression?';

const OPERATIONS = ['+', '-', '*'];

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
        $randKey = array_rand(OPERATIONS);
        $operation = OPERATIONS[$randKey];

        $gameData[$i]['question'] = "{$num1} {$operation} {$num2}";
        $gameData[$i]['right_answer'] = getRightAnswer($num1, $num2, $operation);
    }

    runEngine(GAME_DESCRIPTION, $gameData);
}

function getRightAnswer(int $num1, int $num2, string $operation): int
{
    switch ($operation) {
        case '+':
            $result = $num1 + $num2;

            break;
        case '-':
            $result = $num1 - $num2;

            break;
        case '*':
            $result = $num1 * $num2;

            break;
    }

    return $result;
}
