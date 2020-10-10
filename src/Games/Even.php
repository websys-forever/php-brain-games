<?php

declare(strict_types=1);

namespace BrainGames\Games\Even;

use function BrainGames\Cli\processGameFlow;

const RAND_MIN_NUMBER = 1;
const RAND_MAX_NUMBER = 10;
const GAME_ROUNDS_COUNT = 3;

const GAME_DESCRIPTION = 'Answer "yes" if the number is even, otherwise answer "no".';

/**
 * Run CLI application
 *
 * @return void
 */
function run()
{
    $getRightAnswer = function (int $num): string {
        return ($num % 2) === 0 ? 'yes' : 'no';
    };
    $getQuestion = function (int $num): string {
        return (string) $num;
    };

    $gameData = [];
    for ($i = 0; $i < GAME_ROUNDS_COUNT; ++$i) {
        $num = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);

        $gameData[$i]['question'] = $getQuestion($num);
        $gameData[$i]['right_answer'] = $getRightAnswer($num);
    }

    processGameFlow(GAME_DESCRIPTION, $gameData);
}
