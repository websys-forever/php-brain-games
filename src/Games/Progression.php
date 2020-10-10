<?php

declare(strict_types=1);

namespace BrainGames\Games\Progression;

use function BrainGames\Cli\processGameFlow;

const RAND_MIN_NUMBER = 1;
const RAND_MAX_NUMBER = 10;
const PROGRESSION_LENGTH = 10;
const GAME_ROUNDS_COUNT = 3;

const GAME_DESCRIPTION = 'What number is missing in the progression?';

/**
 * Run CLI application
 *
 * @return void
 */
function run()
{
    $getRightAnswer = function (array $progression, int $hiddenValueIndex): int {
        return $progression[$hiddenValueIndex];
    };

    $getQuestion = function (array $progression, int $hiddenValueIndex): string {
        $progression[$hiddenValueIndex] = '..';

        return implode(' ', $progression);
    };

    $gameData = [];
    for ($i = 0; $i < GAME_ROUNDS_COUNT; ++$i) {
        $firstNumber = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);
        $progressionDifference = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);

        $progression = getProgression($firstNumber, $progressionDifference);
        $hiddenValueIndex = array_rand($progression);

        $gameData[$i]['question'] = $getQuestion($progression, $hiddenValueIndex);
        $gameData[$i]['right_answer'] = $getRightAnswer($progression, $hiddenValueIndex);
    }

    processGameFlow(GAME_DESCRIPTION, $gameData);
}

/**
 * Get progression
 *
 * @param int $firstNumber           first progression's number
 * @param int $progressionDifference progression's difference
 *
 * @return array
 */
function getProgression(int $firstNumber, int $progressionDifference): array
{
    $progression = [];
    for ($i = 0; $i < PROGRESSION_LENGTH; $i += 1) {
        $progression[$i] = $firstNumber + $progressionDifference * $i;
    }

    return $progression;
}
