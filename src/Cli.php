<?php

declare(strict_types=1);

namespace BrainGames\Cli;

use function Cli\{out, prompt};

use const BrainGames\Games\Common\{GAME_STEPS_COUNT, CORRECT_ANSWER_MESSAGE};

/**
 * Process game flow
 *
 * @param $gameDescription string game's description
 * @param $gameData        array game's data (questions messages and right answers)
 *
 * @return void
 */
function processGameFlow(string $gameDescription, array $gameData)
{
    out("Welcome to the Brain Games!\n");
    out($gameDescription);

    $userName = prompt("May I have your name?");
    out("Hello, {$userName}\n");

    $errorAnswer = false;
    $step = 0;
    while ($step < GAME_STEPS_COUNT && false === $errorAnswer) {
        $receivedAnswer = prompt("Question: {$gameData[$step]['question_message']}");

        if ($gameData[$step]['right_answer'] == $receivedAnswer) {
            ++$step;

            out(CORRECT_ANSWER_MESSAGE);
        } else {
            $errorAnswer = true;
        }
    }

    $result = $errorAnswer ?
        "'{$receivedAnswer}' is wrong answer ;(. Correct answer was '{$gameData[$step]['right_answer']}'.
 Let's try again, {$userName}!\n"
        : "Congratulations, {$userName}!\n";

    out($result);
}
