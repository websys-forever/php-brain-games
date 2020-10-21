<?php

declare(strict_types=1);

namespace BrainGames\Engine;

use function Cli\line;
use function Cli\prompt;

const GAME_ROUNDS_COUNT = 3;

/**
 * Process game flow
 *
 * @param $gameDescription string game's description
 * @param $gameRounds      array  game's data (questions messages and right answers)
 *
 * @return bool
 */
function runEngine(string $gameDescription, array $gameRounds): bool
{
    line("Welcome to the Brain Games!");
    line("{$gameDescription}");

    $userName = prompt("May I have your name?");
    line("Hello, {$userName}");

    foreach ($gameRounds as ['question' => $question, 'right_answer' => $rightAnswer]) {
        $receivedAnswer = prompt("Question: {$question}");

        if ($rightAnswer == $receivedAnswer) {
            line("Correct!");
        } else {
            line("'{$receivedAnswer}' is wrong answer ;(. Correct answer was '{$rightAnswer}'.");
            line("Let's try again, {$userName}!");

            return false;
        }
    }

    line("Congratulations, {$userName}!");

    return true;
}
