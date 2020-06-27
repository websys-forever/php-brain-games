<?php

declare(strict_types=1);

namespace BrainGames\Games\Progression;

use function BrainGames\Cli\processGameFlow;
use function BrainGames\Games\Common\getGameData;

use const BrainGames\Games\Common\{RAND_MIN_NUMBER};

const RAND_MAX_NUMBER = 10;
const PROGRESSION_LENGTH = 10;

const GAME_DESCRIPTION = <<<MESSAGE
What number is missing in the progression?\n
MESSAGE;

/**
 * Run CLI application
 *
 * @return void
 */
function run()
{
    $getQuestionValues = function (): array {
        $firstProgressionNumber = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);
        $progressionDifference = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);

        $progression = getProgression($firstProgressionNumber, $progressionDifference);

        return [
            'progression' => $progression,
            'hidden_value_index' => array_rand($progression)
        ];
    };

    $getRightAnswer = function (array $questionValues): int {
        $hiddenValueIndex = $questionValues['hidden_value_index'];
        $rightAnswer = $questionValues['progression'][$hiddenValueIndex];

        return $rightAnswer;
    };

    $getQuestionMessage = function ($questionValues): string {
        $hiddenValueIndex = $questionValues['hidden_value_index'];
        $questionValues['progression'][$hiddenValueIndex] = '..';

        return implode(' ', $questionValues['progression']);
    };

    $gameData = getGameData($getQuestionValues, $getRightAnswer, $getQuestionMessage);

    processGameFlow(GAME_DESCRIPTION, $gameData);
}

/**
 * Get progression
 *
 * @param int $firstProgressionNumber first progression's number
 * @param int $progressionDifference  progression's difference
 *
 * @return array
 */
function getProgression(int $firstProgressionNumber, int $progressionDifference): array
{
    for ($i = 0; $i < PROGRESSION_LENGTH; $i += 1) {
        $progression[$i] = $firstProgressionNumber + $progressionDifference * $i;
    }

    return $progression;
}
