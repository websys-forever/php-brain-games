<?php

declare(strict_types=1);

namespace BrainGames\Games\Progression;

use function BrainGames\Engine\runEngine;

use const BrainGames\Engine\GAME_ROUNDS_COUNT;

const RAND_MIN_NUMBER = 1;
const RAND_MAX_NUMBER = 10;
const PROGRESSION_LENGTH = 10;

const GAME_DESCRIPTION = 'What number is missing in the progression?';

/**
 * Run CLI application
 *
 * @return void
 */
function run()
{
    $gameData = [];
    for ($i = 0; $i < GAME_ROUNDS_COUNT; ++$i) {
        $firstNumber = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);
        $progressionDifference = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);

        $progression = getProgression($firstNumber, $progressionDifference);
        $hiddenValueIndex = array_rand($progression);

        $gameData[$i]['right_answer'] = $progression[$hiddenValueIndex];

        $progression[$hiddenValueIndex] = '..';
        $gameData[$i]['question'] = implode(' ', $progression);
    }

    runEngine(GAME_DESCRIPTION, $gameData);
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
