<?php

declare(strict_types=1);

namespace BrainGames\Games\Progression;

use function BrainGames\Cli\processGameFlow;
use const BrainGames\Common\{RAND_MIN_NUMBER};

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
    $questionValues = function (): array {
        $progression = getProgression();

        return [
            'progression' => $progression,
            'hidden_value_index' => array_rand($progression)
        ];
    };

    $rightAnswer = function (array $questionValues): int {
        $hiddenValueIndex = $questionValues['hidden_value_index'];
        $rightAnswer = $questionValues['progression'][$hiddenValueIndex];

        return $rightAnswer;
    };

    $questionMessage = function ($questionValues): string {
        $hiddenValueIndex = $questionValues['hidden_value_index'];
        $questionValues['progression'][$hiddenValueIndex] = '..';

        return implode(' ', $questionValues['progression']);
    };

    processGameFlow(GAME_DESCRIPTION, $questionValues, $rightAnswer, $questionMessage);
}

/**
 * Get progression
 *
 * @return array
 */
function getProgression(): array
{
    $firstProgressionNumber = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);
    $progression[1] = $firstProgressionNumber;
    $progressionDifference = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);

    for ($i = 2; $i <= PROGRESSION_LENGTH; $i += 1) {
        $progressionValue = $progression[$i - 1] + $progressionDifference;
        $progression[$i] = $progressionValue;
    }

    return $progression;
}
