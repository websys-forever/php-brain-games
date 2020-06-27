<?php

declare(strict_types=1);

namespace BrainGames\Games\Even;

use function BrainGames\Cli\processGameFlow;
use function BrainGames\Games\Common\{getGameData};

use const BrainGames\Games\Common\{RAND_MIN_NUMBER, RAND_MAX_NUMBER};

const GAME_DESCRIPTION = <<<MESSAGE
Answer "yes" if the number is even, otherwise answer "no".\n
MESSAGE;

/**
 * Run CLI application
 *
 * @return void
 */
function run()
{
    $getQuestionNumber = function (): int {
        return rand(RAND_MIN_NUMBER, RAND_MAX_NUMBER);
    };
    $getRightAnswer = function (int $questionNumber): string {
        return ($questionNumber % 2) === 0 ? 'yes' : 'no';
    };
    $getQuestionMessage = function ($questionNumber): string {
        return (string) $questionNumber;
    };

    $gameData = getGameData($getQuestionNumber, $getRightAnswer, $getQuestionMessage);

    processGameFlow(GAME_DESCRIPTION, $gameData);
}
