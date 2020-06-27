<?php

declare(strict_types=1);

namespace BrainGames\Games\Calc;

use function BrainGames\Cli\processGameFlow;
use function BrainGames\Games\Common\{getGameData};

use const BrainGames\Games\Common\{RAND_MIN_NUMBER, RAND_MAX_NUMBER};

const GAME_DESCRIPTION = <<<MESSAGE
What is the result of the expression?\n
MESSAGE;

const OPERATIONS = ['+', '-', '*'];

/**
 * Run CLI application
 *
 * @return void
 */
function run()
{
    $getQuestionValues = function (): array {
        $num1 = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);
        $num2 = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);
        $randKey = array_rand(OPERATIONS);
        $operation = OPERATIONS[$randKey];

        return [
            'num1' => $num1,
            'operation' => $operation,
            'num2' => $num2
        ];
    };

    $getRightAnswer = function (array $questionValues): int {
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
    };

    $getQuestionMessage = function ($questionValues): string {
        return implode(' ', $questionValues);
    };

    $gameData = getGameData($getQuestionValues, $getRightAnswer, $getQuestionMessage);

    processGameFlow(GAME_DESCRIPTION, $gameData);
}
