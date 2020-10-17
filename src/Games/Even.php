<?php

declare(strict_types=1);

namespace BrainGames\Games\Even;

use function BrainGames\Engine\runGamesEngine;

use const BrainGames\Engine\GAME_ROUNDS_COUNT;

const RAND_MIN_NUMBER = 1;
const RAND_MAX_NUMBER = 10;

const GAME_DESCRIPTION = 'Answer "yes" if the number is even, otherwise answer "no".';

/**
 * Run CLI application
 *
 * @return void
 */
function run()
{
    $gameData = [];
    for ($i = 0; $i < GAME_ROUNDS_COUNT; ++$i) {
        $num = rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);

        $gameData[$i]['question'] = (string) $num;
        $gameData[$i]['right_answer'] = (($num % 2) === 0) ? 'yes' : 'no';
    }

    runGamesEngine(GAME_DESCRIPTION, $gameData);
}
