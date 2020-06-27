<?php

declare(strict_types=1);

namespace BrainGames\Games\Common;

const RAND_MIN_NUMBER = 1;
const RAND_MAX_NUMBER = 100;
const GAME_STEPS_COUNT = 3;
const CORRECT_ANSWER_MESSAGE = "Correct!\n";

function getGameData(
    callable $getQuestionValues,
    callable $getRightAnswer,
    callable $getQuestionMessage
) {
    $gameData = [];
    for ($i = 0; $i < GAME_STEPS_COUNT; ++$i) {
        $questionValues = $getQuestionValues();
        $gameData[$i]['question_message'] = $getQuestionMessage($questionValues);
        $gameData[$i]['right_answer'] = $getRightAnswer($questionValues);
    }

    return $gameData;
}
